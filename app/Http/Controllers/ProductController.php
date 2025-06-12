<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ProductImage;

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

    public function storeProduct(Request $request, $id = null)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
            'images.*' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048', // Validate each file
        ]);

        try {
            if ($id != null) {
                $product = Product::find($id);
                $product->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'sale_price' => $request->sale_price,
                    'sku' => $request->sku,
                    'stock' => $request->stock,
                    'category_id' => $request->category_id,
                ]);

                // If new images are uploaded, handle them
                if ($request->hasFile('images')) {
                    $this->storeImages($request->file('images'), $product->id);
                }

                flash()->success('Product updated successfully!');
            } else {
                $slug = Str::slug($request->name);
                $originalSlug = $slug;
                $counter = 1;

                while (Product::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter++;
                }

                $product = Product::create([
                    'name' => $request->name,
                    'description' => $request->description ?? null,
                    'slug' => $slug,
                    'price' => $request->price,
                    'sale_price' => $request->sale_price,
                    'stock' => $request->stock,
                    'sku' => $request->sku ?? null,
                    'category_id' => $request->category_id,
                ]);

                // Handle uploaded images
                if ($request->hasFile('images')) {
                    $this->storeImages($request->file('images'), $product->id);
                }

                flash()->success('Product added successfully!');
            }

            return to_route('product.index');
        } catch (\Exception $exception) {
            flash()->error($exception->getMessage());
            return redirect()->back();
        }
    }

/**
 * Store multiple images for a product.
 *
 * @param array $images
 * @param int $productId
 */
protected function storeImages($images, $productId)
{
    foreach ($images as $image) {
        $path = $image->store('products', 'public'); // Store in storage/app/public/products
        ProductImage::create([
            'product_id' => $productId,
            'image_path' => $path,
        ]);
    }
}

//    public function editProductForm($id){
//        try{
//
//        }catch(\Exception $exception){
//            flash()->error($exception->getMessage());
//            return redirect()->back();
//        }
//    }

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
