<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Auth;
use App\Models\Cart;

class CheckoutController extends Controller
{
    public function index(){
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();

        $cartquantity = $cart->sum( fn ($item)=> $item->product->price * $item->quantity);
        return Inertia::render('Checkout/Index', [
            'items' => $cart,
            'total' => $cartquantity
        ]);
    }
}
