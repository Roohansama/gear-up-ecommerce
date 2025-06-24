@extends('layouts.admin.app')

@section('content')
    <div class="w-full overflow-scroll mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Products</h1>
            <button disabled
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition opacity-50">
                + Add Order
            </button>
        </div>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 text-gray-600 text-sm uppercase">
                <tr>
                    <th class="px-6 py-3 text-left">#</th>
                    <th class="px-6 py-3 text-left">Order No</th>
                    <th class="px-6 py-3 text-left">Customer Name</th>
                    <th class="px-6 py-3 text-left">Amount</th>
                    <th class="px-6 py-3 text-left">Date</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Actions</th>
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
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $order->created_at }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $order->order_status }}</td>
                                <td class="px-6 py-4 text-sm space-x-2">
                                    {{--                                <a href="{{route('order.edit', $order->id)}}"--}}
                                    {{--                                   class="text-blue-500 hover:underline">Edit</a>--}}
                                    <form method="POST" action="{{route('order.delete',$order->id)}}"
                                          class="inline-block"
                                          onsubmit="return confirm('Delete this product?')">
                                        @csrf
                                        <button class="text-red-500 hover:underline" type="submit">Delete</button>
                                    </form>
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
