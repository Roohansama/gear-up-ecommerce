<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $min_range = 0;
        $max_range = 1000;
        $query = Product::query();

        if ($request->has('category')) {
            $query->leftjoin('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.*', 'categories.name as category_name')
                ->where('categories.name', $request->category);
        }
        if ($request->has('min_range')) {
            $query->where('products.price', '>=', $request->min_range);
            $min_range = $request->min_range;
        }
        if ($request->has('max_range')) {
            $query->where('products.price', '<=', $request->max_range);
            $max_range = $request->max_range;
        }

        $products = $query->get();
        $images = ProductImage::all()->groupBy('product_id')->toArray();
        $categories = Category::all();

        return view('store.index', compact(['products', 'images', 'categories', 'min_range', 'max_range']));
    }

    public function showProduct($slug)
    {
        try {
            $product = Product::where('slug', $slug)->first();
            if ($product == null) {
                flash()->error('Product not found');
                return redirect()->back();
            }
            $images = ProductImage::where('product_id', $product->id)->get();
            return view('store.show', compact(['product', 'images']));
        } catch (\Exception $e) {
            flash()->error($e->getMessage());
            return redirect()->back();
        }
    }

    public function showCart()
    {
        $cart = session()->get('cart');
        $total = 0;
        if ($cart) {
            foreach ($cart as $product) {
                $total += $product['price'] * $product['quantity'];
            }
        }
        return view('store.cart', compact(['cart', 'total']));;
    }

    public function addToCart(Request $request)
    {

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $product = Product::findOrFail($productId);
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Product added to cart successfully!',
            'cart' => $cart
        ]);
    }

    public function updateCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');


        if ($product_id && $quantity) {
            $cart = session()->get('cart');
            $cart[$product_id]['quantity'] += $quantity;
            session()->put('cart', $cart);
//            session()->flash('success', 'Cart updated successfully');
            return response()->json([
                'message' => 'Cart updated successfully!',
                'cart' => $cart
            ]);
        }
        return response()->json(
            ['message' => 'Cart not updated!'],
        );

    }
}
