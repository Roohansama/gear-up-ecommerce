@extends('layouts.store.app')

@section('content')
    <div class="h-screen w-full overflow-auto">
        <div class="container mx-auto flex flex-col md:flex-row">
            <div class="flex flex-col w-full md:w-3/5 space-y-5 py-5 md:py-10 px-3 md:px-0">
                <h1 class="uppercase text-2xl">billing details</h1>
                <div class="flex flex-row w-full space-x-8">
                    <div class="flex flex-col w-1/2">
                        <label for="first_name" class="font-semibold">First Name</label>
                        <input type="text" class="border-1 border-gray-300 w-full">
                    </div>
                    <div class="flex flex-col w-1/2">
                        <label for="second_name" class="font-semibold">Second Name</label>
                        <input type="text" class="border-1 border-gray-300 w-full">
                    </div>
                </div>

                <div class="flex flex-row w-full space-x-8">
                    <div class="flex flex-col w-1/2">
                        <label for="first_name" class="font-semibold">Street Address 1</label>
                        <input type="text" class="border-1 border-gray-300 w-full">
                    </div>
                    <div class="flex flex-col w-1/2">
                        <label for="second_name" class="font-semibold">Address 2</label>
                        <input type="text" class="border-1 border-gray-300 w-full">
                    </div>
                </div>

                <div class="flex flex-row w-full space-x-8">
                    <div class="flex flex-col w-full">
                        <label for="first_name" class="font-semibold">Town City</label>
                        <input type="text" class="border-1 border-gray-300 w-full">
                    </div>
                </div>

                <div class="flex flex-row w-full space-x-8">
                    <div class="flex flex-col w-full">
                        <label for="first_name" class="font-semibold">State/Country</label>
                        <input type="text" class="border-1 border-gray-300 w-full">
                    </div>
                </div>

                <div class="flex flex-row w-full space-x-8">
                    <div class="flex flex-col w-full">
                        <label for="second_name" class="font-semibold">Postcode / ZIP</label>
                        <input type="text" class="border-1 border-gray-300 w-full">
                    </div>
                </div>

                <div class="flex flex-col w-full">
                    <label for="second_name" class="font-semibold">Phone</label>
                    <input type="text" class="border-1 border-gray-300 w-full">
                </div>

                <div class="flex flex-row w-full space-x-8">
                    <div class="flex flex-col w-full">
                        <label for="second_name" class="font-semibold">Email Address</label>
                        <input type="text" class="border-1 border-gray-300 w-full">
                    </div>
                </div>

                <div class="flex flex-row-reverse w-full justify-end">
                    <label for="second_name" class="px-3 font-semibold text-lg">Ship to a different address?</label>
                    <input type="checkbox" class="border-1 border-gray-300">
                </div>

                <div class="flex flex-row w-full space-x-8">
                    <div class="flex flex-col w-full">
                        <label for="second_name" class="font-semibold">Order Notes (optional)</label>
                        <textarea name="" id="" rows="10" class="border-1 border-gray-300 w-full"></textarea>
                    </div>
                </div>
            </div>
            <div class="flex flex-col w-full md:w-2/5 py-5 md:py-10 px-3 md:pl-10">
                <div class="flex flex-col w-full border-2 h-1/2 p-5 ">
                    <h1 class="py-2 uppercase">Your Order</h1>
                    <div class="flex justify-between py-2 uppercase">
                        <h1>Product</h1>
                        <h1>Sub Total</h1>
                    </div>
                    <div class="min-h-1 bg-gray-200"></div>
                    <div class="flex justify-between py-2">
                        <h1>Product Name</h1>
                        <h1>price</h1>
                    </div>
                    <div class="min-h-0.5 bg-gray-200"></div>

                    <div class="flex justify-between py-2">
                        <h1>Sub Total</h1>
                        <h1>price</h1>
                    </div>
                    <div class="min-h-0.5 bg-gray-200"></div>

                    <div class="flex justify-between py-2">
                        <h1>Total</h1>
                        <h1>price</h1>
                    </div>
                    <div class="min-h-1 bg-gray-200"></div>

                    <button class="bg-amber-300 uppercase text-lg text-white py-2 px-3 mt-5 hover:bg-amber-400">Place Order</button>
                </div>

            </div>
        </div>
    </div>

@endsection
