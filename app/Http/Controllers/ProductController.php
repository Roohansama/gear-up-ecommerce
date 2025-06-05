<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }
    public function showProductForm(){
        $categories = Category::all();
        return view('admin.product.product-form', compact('categories'));
    }

    public function storeProduct(Request $request){

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ]);

        try{
            $slug = Str::slug($request->name);
            $originalSlug = $slug;
            $counter = 1;

            while (Product::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }

            $path = null;

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('products', 'public'); // stored in storage/app/public/products
            }

            Product::create([
                'name' => $request->name,
                'description' => $request->description ?? null,
                'slug' => $slug,
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'stock' => $request->stock,
                'sku' => $request->sku ?? null,
                'image_path' => $path ?? null,
                'category_id' => $request->category_id,
            ]);

            flash()->success('Product added successfully!');
            return to_route('product.index');

        }catch (\Exception $exception){
            flash()->error($exception->getMessage());
            return redirect()->back();
        }

    }
}
