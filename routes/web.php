<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ShoppingProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard',[
        'username' => 'PANNEER'
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('posts', PostController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::get('posts/estimate',[PostController::class, 'estimate'])->name('page.estimate');
    Route::post('estimate/store',[PostController::class, 'estimatestore'])->name('estimate.store');


    Route::get('/product', [ShoppingProductController::class, 'Index'])->name('product.index');
    Route::post('/product/{id}/add-to-cart',[ShoppingProductController::class, 'addtocart'])->name('product.add-to-cart');

     Route::get('/cart/items', [CartController::class, 'getCartItems'])->name('cart.items');
     Route::delete('/cart/item/{id}', [CartController::class, 'removecartItem'])->name('cart.item.remove');
     Route::put('/cart/item/{id}', [CartController::class, 'updatecartItem'])->name('cart.item.update');
     Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');


});

require __DIR__.'/auth.php';
