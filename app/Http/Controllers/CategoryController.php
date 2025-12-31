<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Category;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\DataTables\CategoryDataTable;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $CategoryDataTable)
    {
        return $CategoryDataTable->render('categorys.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category)
    {
         
        return  view('categorys.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $url = "";
        
        if($request->hasFile('category_img')){
            
            $file = $request->file('category_img');
            $extension = time().'.'.$file->getClientOriginalExtension();
            $url = Storage::disk('public')->putFileAs('category_imgs',$file, $extension);
        }

        $category = Category::create([
            'name' => $request->name,
        ]);
        $this->syncTags($category, $request->tags);

        $category->images()->create([
                        'path' => $extension
                    ]);

        return redirect()->route('categorys.index')->with('success', 'Category created succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categorys.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $tags = $category->tags->pluck('name')->map(fn ($tag) => [
        'value' => $tag
    ]);
        return view('categorys.edit', compact('category','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {

        $category_img = "";
        if($request->hasFile('category_img')){ 
            if($category->images->first()->path){   
                Storage::disk('public')->delete('category_imgs/'.$category->images->first()->path);
                $category->images()->delete();
            }
            $file = $request->file('category_img');
            $category_img = time() . '.' . $file->getClientOriginalExtension();

            Storage::disk('public')->putFileAs('category_imgs', $file, $category_img);

            $category->images()->create([
                        'path' => $category_img
                    ]);
        }
        $this->syncTags($category, $request->tags);
        $category->update(['name'=> $request->name]);

        return redirect()->route('categorys.index')->with('success','Category was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return redirect()
                ->route('categorys.index')
                ->with('error', 'Cannot delete category. It is assigned to products.');
        }


        $category->delete();
        return redirect()->route('categorys.index')->with('success', 'category deleted!');
    }

    private function syncTags($model, $tagsJson)
    {
        if (!$tagsJson) return;

        $tags = json_decode($tagsJson, true);

        $tagIds = collect($tags)->map(function ($tag) {
            return Tag::firstOrCreate([
                'name' => $tag['value']
            ])->id;
        });

        $model->tags()->sync($tagIds);
    }

    public function suggestion(Request $request){
        $data = $request->get('q');

        return Tag::where('name','like',"%{$data}%")->limit(10)->get()->map(fn($q)=>['value'=>$q->name]);
    }
}
