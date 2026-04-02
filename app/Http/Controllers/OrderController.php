<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use App\DataTables\OrdersDataTable;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\Orderplacedmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\OrderUpdateRequest;
use App\Http\Requests\OrderStoreRequest;

use App\Notifications\OrderPlacedNotification;


class OrderController extends Controller
{

    public function index()
    {
        $user = User::all();
        $categories = Category::all();
        $products = Product::all();
        return view('orders.add',compact('categories','products','user'));
    }

    public function edit($id)
    {
        $order = Order::with('items')->findOrFail($id);
        $categories = Category::all();
        $products = Product::all();
        $user = User::all();

        return view('orders.edit', compact('order','categories','products','user'));
    }


    public function store(OrderStoreRequest $request){
        
        $order = Order::create([
                            'total_amount' => $request->total_amount,
                            'discount' => $request->discount,
                            'final_amount' => $request->final_amount,
                            'user_id' => $request->user,
                            'ordering_date' => $request->ordering_date,
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

            //notification
            $order->user->notify((new OrderPlacedNotification($order))->delay(now()->addMinutes(5)));


        }catch(\Exception $e){
            return $e->message;
        }

        return redirect()->back()->with('success','Order Created successfully');
    }

    public function update(OrderUpdateRequest $request, $id)
    {
        $order = Order::findOrFail($id);

        // Update main order
        $order->update([
            'ordering_date' => $request->ordering_date,
            'user_id' => $request->user,
            'total_amount' => $request->total_amount,
            'discount' => $request->discount,
            'final_amount' => $request->final_amount,
        ]);

        // Remove old order items
        OrderItem::where('order_id', $order->id)->delete();

        // Insert new items
        foreach ($request->product_id as $key => $value) {
            OrderItem::create([
                'order_id' => $order->id,
                'category_id' => $request->category_id[$key],
                'product_id' => $value,
                'quantity' => $request->quantity[$key],
                'price' => $request->price[$key],
                'total' => $request->total[$key],
            ]);
        }

        return redirect()->route('order.index')->with('success', 'Order updated successfully');
    }


    public function orderlist(OrdersDataTable $OrderDataTable){
        return $OrderDataTable->render('orders.index');

    }

    public function getProducts($category_id){
        return Product::where('category_id', $category_id)->get();
    }

    public function show($id){
        $orders = Order::with('items','items.order','items.product','items.category')->where('id',$id)->first();

        return view('orders.show', compact('orders'));
    }

    public function donwloadinvoice($id){

        $order = Order::with('items.product', 'items.category', 'user')->findOrFail($id);

        $pdf = pdf::loadview('orders.invoice',compact('order'));

        return $pdf->download('Invoice.pdf');
    }
}
