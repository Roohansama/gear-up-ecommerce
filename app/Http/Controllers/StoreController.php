<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index($category_name = null){
        if($category_name == null){
            $products = Product::all();
        }else{
            $products = Product::leftjoin('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.*', 'categories.name as category_name')
                ->where('categories.name', $category_name)
                ->get();
        }
        $images = ProductImage::all()->groupBy('product_id')->toArray();
        $categories = Category::all();
//        dd($images[1][0]);
        return view('store.index', compact(['products', 'images', 'categories']));
    }

    public function showProduct($slug){
        try{
            $product = Product::where('slug', $slug)->first();
            if($product == null){
                flash()->error('Product not found');
                return redirect()->back();
            }
            $images = ProductImage::where('product_id', $product->id)->get();
            return view('store.show', compact(['product', 'images']));
        }catch(\Exception $e){
            flash()->error($e->getMessage());
            return redirect()->back();
        }
    }
}
