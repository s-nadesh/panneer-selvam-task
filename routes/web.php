<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::resource('posts', PostController::class)
    ->only(['index', 'create', 'store', 'edit', 'update','destroy']);


Route::get('/users/datatable', [UserController::class, 'getUsers'])->name('users.datatable');

Route::get('/dashboard', [HomeController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {   

    Route::resource('users', UserController::class);

    Route::resource('categorys', CategoryController::class);

    Route::resource('products', ProductController::class);
    Route::delete('/product-image/{image}', [ProductController::class, 'deleteimage'])->name('product_img.delete');

    
    Route::get('/placeorder', [OrderController::class, 'index'])->name('placeorder');
    Route::get('/get-products/{category_id}', [OrderController::class, 'getProducts']);
    Route::post('/order-store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/orders', [OrderController::class, 'orderlist'])->name('order.index');
    Route::get('/ordersshow/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::get('order/{id}/invoice',[OrderController::class,'donwloadinvoice'])->name('order.invoice');
    Route::get('orders/{id}/edit', [OrderController::class, 'edit'])->name('order.edit');
    Route::post('orders/{id}', [OrderController::class, 'update'])->name('order.update');

    Route::get('tags/suggestion', [TagController::class, 'suggestion']);

    Route::resource('roles', RoleController::class)->middleware('auth','role:admin');


});



require __DIR__.'/auth.php';

Auth::routes();



