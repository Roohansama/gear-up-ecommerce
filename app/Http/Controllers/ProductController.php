<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showProductForm(){
        return view('admin.product.product-form');
    }
}
