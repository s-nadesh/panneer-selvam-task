<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Auth;
use Illuminate\Http\Request;
use App\DataTables\OrdersDataTable;

class OrderController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('orders.add',compact('categories','products'));
    }

    public function getProducts($category_id){
        return Product::where('category_id', $category_id)->get();
    }

    public function store(Request $request){
        
        $inserted_id = Order::create([
                            'total_amount' => $request->total_amount,
                            'discount' => $request->discount,
                            'final_amount' => $request->final_amount,
                            'user_id' => Auth::user()->id
                        ]);
        
        if($inserted_id->id){
            foreach($request->product_id as $key=>$value){
                OrderItem::create([
                    'order_id' => $inserted_id->id,
                    'category_id' => $request->category_id[$key],
                    'product_id' => $value,
                    'quantity' => $request->quantity[$key],
                    'price' => $request->price[$key],
                    'total' => $request->total[$key],
                ]);
            }
            
        }

        return redirect()->back()->with('success','Order Created successfully');
    }

    public function orderlist(OrdersDataTable $OrderDataTable){
        return $OrderDataTable->render('orders.index');

    }

    public function show(){
        $id = Auth::user()->id;
        $orders = Order::where('user_id',$id)->get();
        return view('orders.show', compact('orders'));
    }
}
