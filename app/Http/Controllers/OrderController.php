<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function PlaceOrder(Request $request){
        $validated = $request->validate([
            'first_name'   => 'string|max:255',
            'second_name'  => 'string|max:255',
            'address_1'    => 'string|max:255',
            'address_2'    => 'nullable|string|max:255',
            'city'         => 'string|max:255',
            'country'      => 'string|max:255',
            'postcode'     => 'string|max:20',
            'phone'        => 'string|max:20',
            'email'        => 'email|max:255',
            'order_notes'  => 'nullable|string',
        ]);

        try{

            $order_id = Order::create($validated)->id();
            $cart = session()->get('cart');


            foreach($cart as $product_id => $item){
                OrderItem::create([
                    'order_id' => $order_id,
                    'product_id' => $product_id,
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            }

            flash()->success('Order Placed successfully!');
            return redirect()->back();
        }catch(\Exception $e){
            flash()->error($e->getMessage());
            return redirect()->back();
        }

    }
}
