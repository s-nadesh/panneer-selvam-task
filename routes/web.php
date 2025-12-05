<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/users/datatable', [UserController::class, 'getUsers'])->name('users.datatable');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {        
    Route::resource('users', UserController::class);
    Route::resource('categorys', CategoryController::class);
    Route::resource('products', ProductController::class);
    
    Route::get('/placeorder', [OrderController::class, 'index'])->name('placeorder');
    Route::get('/get-products/{category_id}', [OrderController::class, 'getProducts']);
    Route::post('/order-store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/orders', [OrderController::class, 'orderlist'])->name('order.index');
    Route::get('/ordersshow', [OrderController::class, 'show'])->name('order.show');
});



require __DIR__.'/auth.php';

Auth::routes();



