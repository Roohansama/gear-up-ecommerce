<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StoreController;

route::get('/csrf', function () {
    return csrf_token();
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});


Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::group(['middleware' => 'auth:web'], function () {
    route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    //product routes
    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/add', [ProductController::class, 'showProductForm'])->name('product.add');
    Route::post('/product/store/{id?}', [ProductController::class, 'storeProduct'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'showProductForm'])->name('product.edit');
    Route::post('/product/delete/{id}', [ProductController::class, 'deleteProduct'])->name('product.delete');

    //category routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
    Route::post('/categories/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    //order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/view/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::post('/order/delete/{id}', [OrderController::class, 'delete'])->name('order.delete');

});

//USER Routes

Route::get('/index', [StoreController::class, 'index'])->name('store.index');
Route::get('/shop/{slug?}', [StoreController::class, 'showProduct'])->name('product.show');

Route::get('/cart', [StoreController::class, 'showCart'])->name('store.cart');
Route::post('/cart/add', [StoreController::class, 'addToCart'])->name('store.cart.add');
Route::post('/cart/update', [StoreController::class, 'updateCart'])->name('store.cart.update');
Route::get('/cart/partial', [StoreController::class, 'getCartPartial'])->name('store.cart.partial');
Route::post('/cart/remove-item', [StoreController::class, 'removeItem'])->name('store.cart.remove-item');

//show checkout
Route::get('/checkout', [StoreController::class, 'showCheckout'])->name('store.checkout');
//post checkout
Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('store.place-order');
