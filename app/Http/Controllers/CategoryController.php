<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
    public function create()
    {
        //
        return  view('categorys.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_img' => 'required'
        ]);

        $url = "";
        
        if($request->hasFile('category_img')){
            
            $file = $request->file('category_img');
            $extension = time().'.'.$file->getClientOriginalExtension();
            $url = Storage::disk('public')->putFileAs('category_imgs',$file, $extension);
        }

        Category::create([
            'name' => $request->name,
            'category_img' => $url
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
        return view('categorys.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category_img = "";
        if($request->hasFile('category_img')){
            if($category->category_img && Storage::exists('public/category_imgs/'. $request->category_img)){    
                Storage::disk('public')->delete('category_imgs/'.$user->profile_pic);
            }
            $file = $request->file('category_img');
            $category_img = time() . '.' . $file->getClientOriginalExtension();

            Storage::disk('public')->putFileAs('category_imgs', $file, $category_img);
        }

        $category->update(['name'=> $request->name, 'category_img'=>$category_img]);

        return redirect()->route('categorys.index')->with('success','Category was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categorys.index')->with('success', 'category deleted!');
    }
}
