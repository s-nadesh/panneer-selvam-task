<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Inertia\Inertia;
use Auth;

class CartController extends Controller
{
    public function getCartItems()
    {
        if (!Auth::check()) {
            return response()->json(['items' => [], 'total' => 0]);
        }
        
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'product_id' => $item->product_id,
                    'name' => $item->product->name,
                    'price' => $item->product->price,
                    'image_url' => 'sddds',
                    'quantity' => $item->quantity,
                    'subtotal' => $item->product->price * $item->quantity,
                ];
            });
        
        $total = $cartItems->sum('subtotal');
        
        return response()->json([
            'items' => $cartItems,
            'total' => $total,
            'itemCount' => $cartItems->sum('quantity'),
        ]);
    }

    function removecartItem($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('id', $id)
                        ->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart'
        ]);
    }


    function updatecartItem(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('id', $id)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Cart item updated'
        ]);
    }
}
