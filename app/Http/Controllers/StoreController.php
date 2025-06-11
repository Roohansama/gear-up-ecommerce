<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('store.index', compact('products'));
    }

    public function showProduct($slug){
        try{

            $product = Product::where('slug', $slug)->firstOrFail();
            return view('store.show', compact('product'));
        }catch(\Exception $e){
            flash()->error($e->getMessage());
            return redirect()->back();
        }
    }
}
