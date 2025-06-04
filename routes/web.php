<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


route::get('/csrf', function () {
    return csrf_token();
});

Route::get('/login', function(){
    return view('auth.login');
});

Route::get('/register', function(){
    return view('auth.register');
});


Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware('auth:web');

Route::group(['middleware' => 'auth:web'], function () {
    route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::get('/product/add', [ProductController::class, 'showProductForm'])->name('product.add');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
});
