<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showProductForm(){
        $categories = Category::all();
        return view('admin.product.product-form', compact('categories'));
    }

    public function storeProduct(Request $request){

    }
}
