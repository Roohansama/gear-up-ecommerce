@extends('layouts.store.app')

@section('content')
    <div class="h-screen w-full overflow-auto">
        <div class="container mx-auto flex flex-col md:flex-row">
            <div class="flex flex-col w-full space-y-5 md:w-3/5 py-5 md:py-10 px-3 md:px-0">
                <h1 class="uppercase text-2xl font-semibold">billing details</h1>
                <form action="{{route('store.place-order')}}" id="checkout_form" method="post" class="space-y-5">
                    @csrf
                    <div class="flex flex-row w-full space-x-8">
                        <div class="flex flex-col w-1/2 space-y-2">
                            <label for="first_name" class="font-semibold ">First Name</label>
                            <input type="text" name="first_name" class="border-1 border-gray-300 w-full h-9 shadow2xl">
                        </div>
                        <div class="flex flex-col w-1/2 space-y-2">
                            <label for="second_name" class="font-semibold">Second Name</label>
                            <input type="text" name="second_name" class="border-1 border-gray-300 w-full h-9">
                        </div>
                    </div>

                    <div class="flex flex-row w-full space-x-8">
                        <div class="flex flex-col w-1/2 space-y-2">
                            <label for="address_1" class="font-semibold">Street Address 1</label>
                            <input type="text" name="address_1" class="border-1 border-gray-300 w-full h-9">
                        </div>
                        <div class="flex flex-col w-1/2 space-y-2">
                            <label for="address_2" class="font-semibold">Address 2</label>
                            <input type="text" name="address_2" class="border-1 border-gray-300 w-full h-9">
                        </div>
                    </div>

                    <div class="flex flex-row w-full">
                        <div class="flex flex-col w-full space-y-2">
                            <label for="city" class="font-semibold ">Town City</label>
                            <input type="text" name="city" class="border-1 border-gray-300 w-full h-9">
                        </div>
                    </div>

                    <div class="flex flex-row w-full">
                        <div class="flex flex-col w-full  space-y-2">
                            <label for="country" class="font-semibold ">State/Country</label>
                            <input type="text" name="country" class="border-1 border-gray-300 w-full h-9">
                        </div>
                    </div>

                    <div class="flex flex-row w-full">
                        <div class="flex flex-col w-full  space-y-2">
                            <label for="postcode" class="font-semibold">Postcode / ZIP</label>
                            <input type="text" name="postcode" class="border-1 border-gray-300 w-full h-9">
                        </div>
                    </div>

                    <div class="flex flex-col w-full space-y-2">
                        <label for="phone" class="font-semibold ">Phone</label>
                        <input type="text" name="phone" class="border-1 border-gray-300 w-full h-9">
                    </div>

                    <div class="flex flex-row w-full">
                        <div class="flex flex-col w-full space-y-2">
                            <label for="email" class="font-semibold">Email Address</label>
                            <input type="text" name="email" class="border-1 border-gray-300 w-full h-9">
                        </div>
                    </div>

                    <div class="flex flex-row-reverse w-full justify-end">
                        <label for="different_shipping_address" class="px-3 font-semibold text-lg">Ship to a different address?</label>
                        <input type="checkbox" name="different_shipping_address" class="border-1 border-gray-300">
                    </div>

                    <div class="flex flex-row w-full">
                        <div class="flex flex-col w-full space-y-2">
                            <label for="order_notes"  class="font-semibold">Order Notes (optional)</label>
                            <textarea name="order_notes" id="" rows="10" class="border-1 border-gray-300 w-full resize-none"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="flex flex-col w-full md:w-2/5 py-5 md:py-10 px-3 md:pl-10">
                <div class="flex flex-col w-full border-2 h-1/2 p-7">
                    <h1 class="py-2 uppercase font-semibold text-xl">Your Order</h1>
                    <div class="flex justify-between py-2 uppercase font-semibold">
                        <h1>Product</h1>
                        <h1>Sub Total</h1>
                    </div>
                    <div class="min-h-1 bg-gray-200"></div>
                    @if(isset($cart))
                        @foreach($cart as $c)
                            <div class="flex justify-between py-2">
                                <h1>{{$c['name']}} x {{$c['quantity']}}</h1>
                                <h1 class="font-semibold">{{$c['price']}}</h1>
                            </div>
                        @endforeach
                    @endif
                    <div class="min-h-0.5 bg-gray-200"></div>

{{--                    <div class="flex justify-between py-2">--}}
{{--                        <h1>{{}}</h1>--}}
{{--                        <h1>price</h1>--}}
{{--                    </div>--}}
{{--                    <div class="min-h-0.5 bg-gray-200"></div>--}}

                    <div class="flex justify-between py-2">
                        <h1>Total</h1>
                        <h1 class="font-semibold">{{$total ?? 'N/A'}}</h1>
                    </div>
                    <div class="min-h-1 bg-gray-200"></div>

                    <button type="submit" form="checkout_form" class="bg-amber-300 uppercase text-lg text-white py-2 px-3 mt-5 hover:bg-amber-400 cursor-pointer">Place Order</button>
                </div>
            </div>
        </div>
    </div>

@endsection
