<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;


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
    Route::get('/product/add', [ProductController::class, 'showProductForm'])->name('product.add');
    Route::post('/product/store', [ProductController::class, 'storeProduct'])->name('product.store');

    //category routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');

});
