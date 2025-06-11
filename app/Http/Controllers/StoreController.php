<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(){
        $products = Product::all();
        $images = ProductImage::all()->groupBy('product_id')->toArray();
//        dd($images[1][0]);
        return view('store.index', compact(['products', 'images']));
    }

    public function showProduct($slug){
        try{
            $product = Product::where('slug', $slug)->first();
            $images = ProductImage::where('product_id', $product->id)->get();
            return view('store.show', compact(['product', 'images']));
        }catch(\Exception $e){
            flash()->error($e->getMessage());
            return redirect()->back();
        }
    }
}
