<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\DataTables\ProductsDataTable;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductsDataTable $dataTable)
    {
        return $dataTable->render('products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        $category = Category::all();
        
        return view('products.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {

        $insertedid= Product::create([
                        'category_id' => $request->category_id,
                        'name' => $request->name,
                        'price' => $request->price,
                        'quantity' => $request->quantity,
                        'description' => $request->description,
                    ]);

        if($insertedid->id){ 
            $this->syncTags($insertedid, $request->tags);
            $productimage = "";

            if($request->hasFile('product_img')){
                
               foreach($request->file('product_img') as $file){
                    $productimage = time() . '.' . $file->getClientOriginalExtension();

                    $path = Storage::disk('public')->putFileAs('product_img', $file, $productimage);

                    // ProductImage::create([
                    //     'image'=> $productimage,
                    //     'product_id' => $insertedid->id,
                        
                    // ]);
                    $insertedid->images()->create([
                        'path' => $productimage
                    ]);
                }
            }
            
            
        }
        return redirect()->route('products.index')->with('success', 'Product created!');
    }

    public function edit(Product $product)
    {
        $category = Category::all();
        $productimg = $product->images;
        $tags = $product->tags->pluck('name')->map(fn ($tag) => [
            'value' => $tag
        ]);
        return view('products.edit', compact('product','category','productimg','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        
        $product->update([
                        'category_id' => $request->category_id,
                        'name' => $request->name,
                        'price' => $request->price,
                        'quantity' => $request->quantity,
                        'description' => $request->description,
                    ]);

        $productimage = "";
        $this->syncTags($product, $request->tags);
        if($request->hasFile('product_img')){

            foreach ($product->images as $image) {
                Storage::disk('public')->delete('product_img/' . $image->path);
            }

            $product->images()->delete();
            
            foreach($request->file('product_img') as $file){
                $productimage = time() . '.' . $file->getClientOriginalExtension();

                Storage::disk('public')->putFileAs('product_img', $file, $productimage);

                $product->images()->create(
                    
                    [
                        'path' => $productimage
                    ]
                );
            }
        }
        
         
        
        return redirect()->route('products.index')->with('success', 'Product created!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'product deleted!');
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

}
