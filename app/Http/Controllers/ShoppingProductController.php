<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Auth;
use App\Models\Cart;

class ShoppingProductController extends Controller
{
    public function index(){
        return Inertia::render('Product/Index',[
            'product' => [],
            'cartCount' => Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0]);
    }

    public function addtocart(Request $request, $id){

        $cartItem = Cart::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $id,
            ],
            [
                'quantity' => \DB::raw('quantity + ' . $request->quantity),
            ]
        );
        
        return redirect()->back()->with([
            'success' => 'Product added ',
            'cartCount' => Cart::where('user_id', Auth::id())->count()
        ]);
    }
}
