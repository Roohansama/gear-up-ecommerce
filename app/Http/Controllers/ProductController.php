<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(){
        $products = Product::LeftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->get();
        return view('admin.product.index', compact('products'));
    }
    public function showProductForm($id = null){
        $categories = Category::all();
        $product = null;

        if($id != null){
            $product = Product::where('products.id', $id)
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->first();
        }


        return view('admin.product.product-form', compact(['categories', 'id', 'product']));
    }

    public function storeProduct(Request $request, $id = null){

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ]);

        try{
            if($id != null){
                Product::where('id', $id)->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'sale_price' => $request->sale_price,
                    'sku' => $request->sku,
                    'stock' => $request->stock,
                    'category_id' => $request->category_id,
                ]);

                flash()->success('Product updated successfully!');
            }else{
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
            }
            return to_route('product.index');

        }catch (\Exception $exception){
            flash()->error($exception->getMessage());
            return redirect()->back();
        }
    }

    public function editProductForm($id){
        try{

        }catch(\Exception $exception){
            flash()->error($exception->getMessage());
            return redirect()->back();
        }
    }

    public function deleteProduct($id){
        try{
            Product::where('id', $id)->delete();
            flash()->success('Product deleted successfully!');
            return to_route('product.index');
        }catch(\Exception $exception){
            flash()->error($exception->getMessage());
            return redirect()->back();
        }
    }
}
