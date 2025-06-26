@extends('layouts.admin.app')

@section('content')
    <div class="container overflow-scroll mx-auto mt-5">
        <div class="flex flex-col space-y-8">
            <h1 class="text-2xl font-bold">{{$order->order_number}}</h1>
            <div class="flex flex-col md:flex-row w-full space-x-8">
                <div class="flex flex-col w-full md:w-1/2 space-y-2">
                    <div class="flex flex-row w-full border-b-1 border-gray-300">
                        <div class="w-1/2">
                            <h2>Order no.</h2>
                        </div>
                        <div class="w-1/2">
                            <h2>{{$order->order_number}}</h2>
                        </div>
                    </div>
                    <div class="flex flex-row w-full border-b-1 border-gray-300">
                        <div class="w-1/2">
                            <h2>Order Status</h2>
                        </div>
                        <div class="w-1/2">
                            <h2>{{$order->order_status}}</h2>
                        </div>
                    </div>
                    <div class="flex flex-row w-full border-b-1 border-gray-300">
                        <div class="w-1/2">
                            <h2>Shipping method</h2>
                        </div>
                        <div class="w-1/2">
                            <h2>{{$order->order_status}}</h2>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col w-full md:w-1/2 space-y-2">
                    <div class="flex flex-row w-full border-b-1 border-gray-300">
                        <div class="w-1/2">Order Date</div>
                        <div class="w-1/2">{{$order->created_at->format('i F Y')}}</div>
                    </div>
                    <div class="flex flex-row w-full border-b-1 border-gray-300">
                        <div class="w-1/2">Shipping Date</div>
                        <div class="w-1/2">{{$order->order_number}}</div>
                    </div>
                    <div class="flex flex-row w-full border-b-1 border-gray-300">
                        <div class="w-1/2">Payment method</div>
                        <div class="w-1/2">{{$order->order_number}}</div>
                    </div>
                </div>
            </div>
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
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="text-gray-600 text-sm capitalize">
                <tr>
                    <th class="px-6 py-3 text-left">Sku</th>
                    <th class="px-6 py-3 text-left">Product Name</th>
                    <th class="px-6 py-3 text-left">Color</th>
                    <th class="px-6 py-3 text-left">Price</th>
                    <th class="px-6 py-3 text-left">Qty</th>
                    <th class="px-6 py-3 text-left">Total</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @if(isset($orders))
                    @forelse($orders as $order)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                {{ $order->order_number ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $order->first_name.' '.$order->last_name }}</td>
                            @php
                                $total = 0 ;
                                foreach ($order->orderItems as $item)
                                    {
                                       $itemTotal = $item->price * $item->quantity;
                                       $total += $itemTotal;
                                    }
                            @endphp
                            <td class="px-6 py-4 text-sm text-gray-700 font-semibold">{{$total}}/-</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{$order->created_at->format('F j, Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                    <span class="py-1 px-2 rounded text-white
                                    {{ $order->order_status == 'pending' ? 'bg-yellow-500' :
                                ($order->order_status == 'confirmed' ? 'bg-green-600' :
                                ($order->order_status == 'cancelled' ? 'bg-red-600' : 'bg-gray-500')) }}">
                                        {{ ucfirst($order->order_status) }}
                                    </span>
                            </td>
                            <td class="flex px-6 py-4 text-sm space-x-4">
                                <button
                                    class="text-blue-500 hover:underline cursor-pointer" onclick="loadOrderDetailSub({{$order->id}})">Open</button>
                                <a href="{{route('order.show', $order->id)}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                </a>

                                {{--                                        <form method="POST" action="{{route('order.delete',$order->id)}}"--}}
                                {{--                                              class="inline-block"--}}
                                {{--                                              onsubmit="return confirm('Delete this product?')">--}}
                                {{--                                            @csrf--}}
                                {{--                                            <button class="text-red-500 hover:underline cursor-pointer" type="submit">--}}
                                {{--                                                Delete--}}
                                {{--                                            </button>--}}
                                {{--                                        </form>--}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                No products found.
                            </td>
                        </tr>
                    @endforelse
                @endif
                </tbody>
            </table>

        </div>
    </div>
@endsection
