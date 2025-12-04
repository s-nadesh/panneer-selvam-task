<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\DataTables\ProductsDataTable;

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
    public function create()
    {
        $category = Category::all();
        return view('products.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ]);

        $insertedid= Product::create([
                        'category_id' => $request->category_id,
                        'name' => $request->name,
                        'price' => $request->price,
                        'quantity' => $request->quantity,
                        'description' => $request->description,
                    ]);

        if($insertedid->id){

            $productimage = "";

            if($request->hasFile('product_img')){
                
                $file = $request->file('product_img');
                $productimage = time() . '.' . $file->getClientOriginalExtension();

                Storage::disk('public')->putFileAs('product_img', $file, $productimage);
            }
            
            ProductImage::create([
                'image'=> $productimage,
                'product_id' => $insertedid->id,
                
            ]);
        }
        return redirect()->route('products.index')->with('success', 'Product created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $category = Category::all();
        return view('products.edit', compact('product','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ]);

        $product->update([
                        'category_id' => $request->category_id,
                        'name' => $request->name,
                        'price' => $request->price,
                        'quantity' => $request->quantity,
                        'description' => $request->description,
                    ]);

        $productimage = "";

        if($request->hasFile('product_img')){
            
            $file = $request->file('product_img');
            $productimage = time() . '.' . $file->getClientOriginalExtension();

            Storage::disk('public')->putFileAs('product_img', $file, $productimage);
        }
        
         $product->productimage()->updateOrCreate(
            ['product_id' => $product->id],
            [
                'image' => $productimage
            ]
        );
        
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
}
