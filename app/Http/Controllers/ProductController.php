<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Services\TagService;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Models\Image;
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
    public function store(ProductStoreRequest $request,TagService $tagService)
    {

        $insertedid= Product::create([
                        'category_id' => $request->category_id,
                        'name' => $request->name,
                        'price' => $request->price,
                        'quantity' => $request->quantity,
                        'description' => $request->description,
                    ]);

        if($insertedid->id){ 
            $tagService->sync($insertedid, $request->tags);
            $productimage = "";

            if($request->hasFile('product_img')){
                
               foreach($request->file('product_img') as $file){
                    $productimage = time() . '.' . $file->getClientOriginalExtension();

                    $path = Storage::disk('public')->putFileAs('product_img', $file, $productimage);

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
    public function update(ProductUpdateRequest $request, Product $product, TagService $tagService)
    {
        
        $product->update([
                        'category_id' => $request->category_id,
                        'name' => $request->name,
                        'price' => $request->price,
                        'quantity' => $request->quantity,
                        'description' => $request->description,
                    ]);

        $productimage = "";
        $tagService->sync($product, $request->tags);

        if($request->hasFile('product_img')){

            
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

    public function deleteimage(Image $image){
        
        Storage::disk('public')->delete('product_img/' . $image->path);
        $image->delete();

        return response()->json([
            'success' => true,
            'message' => 'Image deleted'
        ]);
    }


}
