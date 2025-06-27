<?php

namespace App\Http\Controllers;

use App\Events\CartNotificationEvent;
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
        $total = session()->get('total');
//        $total = 0;
//        if ($cart) {
//            foreach ($cart as $product) {
//                $total += $product['price'] * $product['quantity'];
//            }
//        }
        return view('store.cart', compact(['cart', 'total']));
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

        broadcast(new CartNotificationEvent($cart,$productId));

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        session()->put('cart', $cart);
        session()->put('total', $total);

        return response()->json([
            'message' => 'Product added to cart successfully!',
            'cart' => $cart
        ]);
    }

    //on quantity change
    public function updateCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');


        if ($product_id && $quantity) {
            $cart = session()->get('cart');
            $cart[$product_id]['quantity'] += $quantity;
            session()->put('cart', $cart);
            return response()->json([
                'message' => 'Cart updated successfully!',
                'cart' => $cart
            ]);
        }
        return response()->json(
            ['message' => 'Cart not updated!'],
        );

    }

    //after quantity change, recalculate totals and return partial view
    public function getCartPartial(){
        $cart = session('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        session()->put('total', $total);

        if(count($cart) == 0){
            session()->forget('cart');
            session()->forget('total');
            return view('store.partials.empty-cart');
        }else{
            return view('store.partials.cart-items', compact('cart', 'total'));
        }
    }

    //remove item from cart and return
    public function removeItem(Request $request){
        try {
            $product_id = $request->input('product_id');

            $cart = session()->get('cart');
            if(isset($cart[$product_id])){
                unset($cart[$product_id]);
                session()->put('cart', $cart);
                if(count($cart) == 0){
                    return redirect()->route('store.cart');
                }
            }
            return response()->json([
                'message' => 'Product removed from cart successfully!',
                'cart' => $cart
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showCheckout(){
        $cart = session()->get('cart');
        $total = session()->get('total');
//        dd($total);
        return view('store.checkout', ['cart' => $cart, 'total' => $total]);
    }

    public function showCartModal(Request $request){

        try{
            $data = $request->input('data');

//            return $data;

//            return view ('store.partials.empty-cart')->render();
            return view('store.partials.header-cart-button', compact('data'))->render();

        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }


    }

}
