@extends('layouts.store.app')

@section('content')

    <div class="w-full md:px-8 lg:px-24 xl:px-72 py-4 md:py-5">
        <div class="flex flex-col md:flex-row divide-x-2 space-y-5 md:space-y-0 divide-neutral-300">
            @if(isset($cart))
                <div class="flex flex-col w-full md:w-7/12 px-5 md:pr-10 space-y-2">
                    <table class="w-full border-b-2">
                        <thead class="border-b-3 border-gray-300">
                        <tr>
                            <th class="text-left flex-[4] uppercase">Product</th>
                            <th class="text-center flex-[2] uppercase">Price</th>
                            <th class="text-center flex-[2] uppercase">Quantity</th>
                            <th class="text-center flex-[2] uppercase">Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cart as $c)
                            <tr>
                                <td class="text-left flex-[4] text-ellipsis py-4 ">{{$c['name']}}</td>
                                <td class="text-center flex-[2] text-ellipsis py-4 font-semibold">Rs{{$c['price']}}</td>
                                <td class="text-center flex-[2] text-ellipsis py-4">{{$c['quantity']}}</td>
                                <td class="text-center flex-[2] text-ellipsis py-4 font-semibold">Rs{{$c['price']*$c['quantity']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a href="{{route('store.index')}}" class="border-2 text-center p-1 md:w-1/3 cursor-pointer hover:bg-neutral-600 hover:text-white transition-all duration-300">
                        ← CONTINUE SHOPPING
                    </a>
                </div>
                <div class="flex flex-col w-full md:w-5/12 px-5 md:pl-10">
                    <div class="mb-3 border-b-3 border-neutral-300">
                        <h1>CART TOTALS</h1>
                    </div>
                    <div class="flex flex-row py-2 justify-between border-b-2 border-neutral-300">
                        <p>Subtotal</p>
                        <p class="font-semibold">Rs{{$total}}</p>
                    </div>
                    <div class="flex flex-row py-2 justify-between border-b-2 border-neutral-300">
                        <p>Shipping</p>
                        <p>Calculate</p>
                    </div>
                    <div class="flex flex-row mb-4 py-2 justify-between border-b-3 border-neutral-300">
                        <p>Total</p>
                        <p class="font-semibold">Rs{{$total}}</p>
                    </div>
                    <button class="bg-amber-400 w-full p-2 text-white cursor-pointer">PROCEED TO CHECKOUT</button>
                </div>
            @endif
        </div>
    </div>
@endsection
