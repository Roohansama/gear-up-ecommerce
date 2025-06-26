@extends('layouts.admin.app')

@section('content')
    <div class="container overflow-scroll mx-auto my-5">
        <div class="flex flex-col space-y-8">
            {{--order details--}}
            <h1 class="text-2xl font-bold">{{$order->order_number}}</h1>
            <div class="flex flex-col md:flex-row w-full space-x-8">
                <div class="flex flex-col w-full md:w-1/2 border-b-1 border-gray-300 space-y-2 divide-y divide-gray-300">
                    <div class="flex flex-row w-full p-2">
                        <div class="w-1/2">
                            <h2>Order no.</h2>
                        </div>
                        <div class="w-1/2">
                            <h2>{{$order->order_number}}</h2>
                        </div>
                    </div>
                    <div class="flex flex-row w-full p-2">
                        <div class="w-1/2">
                            <h2>Order Status</h2>
                        </div>
                        <div class="w-1/2">
                            <h2>{{$order->order_status}}</h2>
                        </div>
                    </div>
                    <div class="flex flex-row w-full p-2">
                        <div class="w-1/2">
                            <h2>Shipping method</h2>
                        </div>
                        <div class="w-1/2">
                            <h2>{{$order->order_status}}</h2>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col w-full md:w-1/2 border-b-1 border-gray-300 space-y-2 divide-y divide-gray-300">
                    <div class="flex flex-row w-full p-2">
                        <div class="w-1/2">Order Date</div>
                        <div class="w-1/2">{{$order->created_at->format('i F Y')}}</div>
                    </div>
                    <div class="flex flex-row w-full p-2">
                        <div class="w-1/2">Shipping Date</div>
                        <div class="w-1/2">{{$order->order_number}}</div>
                    </div>
                    <div class="flex flex-row w-full p-2">
                        <div class="w-1/2">Payment method</div>
                        <div class="w-1/2">{{$order->order_number}}</div>
                    </div>
                </div>
            </div>
            {{--address--}}
            <div class="flex flex-col md:flex-row w-full space-x-8">
                <div class="flex flex-col w-full md:w-1/2 space-y-2 capitalize">
                    <h2 class="font-semibold uppercase">Billing Address</h2>
                    <p>{{$order->address_1}}</p>
                    <p>{{$order->city}}</p>
                    <p>{{$order->country}}</p>
                    <p>{{$order->postcode}}</p>
                </div>
                <div class="flex flex-col w-full md:w-1/2 space-y-2 capitalize">
                    <h2 class="font-semibold uppercase">Shipping Address</h2>
                    <p>{{$order->address_1}}</p>
                    <p>{{$order->city}}</p>
                    <p>{{$order->country}}</p>
                    <p>{{$order->postcode}}</p>
                </div>
            </div>
            {{--items--}}
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="text-gray-600  capitalize">
                <tr>
                    <th class="px-6 py-3 text-left">Sku</th>
                    <th class="px-6 py-3 text-left">Product Name</th>
                    <th class="px-6 py-3 text-left">Color</th>
                    <th class="px-6 py-3 text-left">Price</th>
                    <th class="px-6 py-3 text-left">Qty</th>
                    <th class="px-6 py-3 text-left">Item total</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                @if(isset($order))
                    @forelse($order->orderItems as $item)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                {{ $item->product_name ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">--</td>
                            <td class="px-6 py-4 text-sm text-gray-700 font-semibold">{{$item->price}}/-</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{$item->quantity}}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{$item->quantity*$item->price}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                No products found.
                            </td>
                        </tr>
                    @endforelse
                    <tr class="border-b border-gray-300">
                        <td colspan="4"></td>
                        <td>Total</td>
                        <td class="px-6 py-4 text-sm text-gray-700 font-semibold">{{$total.'/-'}}</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
