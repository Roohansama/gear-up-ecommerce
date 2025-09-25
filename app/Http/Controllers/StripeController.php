<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function placeCharge(Request $request){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $charge = $stripe->charges->create([
            'amount' => $request->amount,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Order Placed'
        ]);

//        dd($charge);
    }
}
