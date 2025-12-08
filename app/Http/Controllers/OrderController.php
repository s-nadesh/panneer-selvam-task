<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Auth;
use Illuminate\Http\Request;
use App\DataTables\OrdersDataTable;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\Orderplacedmail;
use Illuminate\Support\Facades\Mail;

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
        
        $order = Order::create([
                            'total_amount' => $request->total_amount,
                            'discount' => $request->discount,
                            'final_amount' => $request->final_amount,
                            'user_id' => Auth::user()->id
                        ]);
        
        if($order->id){
            foreach($request->product_id as $key=>$value){
                OrderItem::create([
                    'order_id' => $order->id,
                    'category_id' => $request->category_id[$key],
                    'product_id' => $value,
                    'quantity' => $request->quantity[$key],
                    'price' => $request->price[$key],
                    'total' => $request->total[$key],
                ]);
            }
            
        }

        try{
            Mail::to($order->user->email)->send(new Orderplacedmail($order));
        }catch(\Exception $e){
            return $e->message;
        }

        return redirect()->back()->with('success','Order Created successfully');
    }

    public function orderlist(OrdersDataTable $OrderDataTable){
        return $OrderDataTable->render('orders.index');

    }

    public function show($id){
        // $id = Auth::user()->id;
        $orders = Order::with('items','items.order','items.product','items.category')->where('id',$id)->first();

        return view('orders.show', compact('orders'));
    }

    public function donwloadinvoice($id){

        $order = Order::with('items.product', 'items.category', 'user')->findOrFail($id);

        $pdf = pdf::loadview('orders.invoice',compact('order'));

        return $pdf->download('Invoice.pdf');
    }
}
