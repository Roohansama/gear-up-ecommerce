<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with('orderItems')->get();

        return view('admin.order.order', compact('orders', ));
    }

    public function showOrder($id){
        $order = Order::with('orderItems')->where('id', $id)->first();

        $total = 0 ;
        foreach ($order->orderItems as $item)
        {
            $itemTotal = $item->price * $item->quantity;
            $total += $itemTotal;
        }

        return view('admin.order.order-details', compact('order', 'total'));

    }

    public function showOrderSub(Request $request){

        $id = $request->order_id; // cast to object for easier blade access

        $order_sub = Order::with('orderItems')->where('id', $id)->first();
        $product_images = ProductImage::all()->groupBy('product_id')->toArray();

        $total = 0 ;
        foreach ($order_sub->orderItems as $item)
        {
            $itemTotal = $item->price * $item->quantity;
            $total += $itemTotal;
        }

        return view('admin.order.order-details-sub', compact('order_sub','total','product_images'))->render();
    }

    public function PlaceOrder(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'address_1' => 'string|max:255',
            'address_2' => 'nullable|string|max:255',
            'city' => 'string|max:255',
            'country' => 'string|max:255',
            'postcode' => 'string|max:20',
            'phone' => 'string|max:20',
            'email' => 'email|max:255',
            'order_notes' => 'nullable|string',
        ]);

        try {

            $cart = session()->get('cart');

            $order_id = Order::max('id') + 1;

            $validated['order_number'] = 'GUE-' . str_pad($order_id, 6, '0', STR_PAD_LEFT);
            $validated['order_status'] = 'pending';

            Order::create($validated);

            foreach ($cart as $product_id => $item) {
                OrderItem::create([
                    'order_id' => $order_id,
                    'product_id' => $product_id,
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            }

            flash()->success('Order Placed successfully!');

            session()->forget('cart');
            return redirect()->to('index');
        } catch (\Exception $e) {
            flash()->error($e->getMessage());
            return redirect()->back();
        }

    }
}
