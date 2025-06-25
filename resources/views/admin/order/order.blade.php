@extends('layouts.admin.app')

@section('content')
    <div class="w-full container overflow-scroll mx-auto mt-5">
        <div class="flex flex-col-reverse px-2 md:px-0 md:flex-row space-y-2 md:space-y-0 md:space-x-2">
            <div class="w-full md:w-4/6 border-1 border-gray-300 shadow-md rounded-lg p-2" id="order-list">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Orders</h1>
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
                                    <td class="px-6 py-4 text-sm text-gray-700">{{$order->created_at->format('F j, Y') }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                    <span class="py-1 px-2 rounded text-white
                                    {{ $order->order_status == 'pending' ? 'bg-yellow-500' :
                                ($order->order_status == 'confirmed' ? 'bg-green-600' :
                                ($order->order_status == 'cancelled' ? 'bg-red-600' : 'bg-gray-500')) }}">
                                        {{ ucfirst($order->order_status) }}
                                    </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm space-x-2">
                                        <button
                                           class="text-blue-500 hover:underline cursor-pointer" onclick="loadOrderDetailSub({{$order->id}})">Open</button>
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
            <div class="w-full md:w-2/6 border-1 border-gray-300 shadow-md rounded-lg p-2" id="order-details">
                @include('admin.order.order-details-sub')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // const order_raw = button.dataset.order;
        // const order = JSON.parse(order_raw);

        function loadOrderDetailSub(order_id){

            axios.post('/order/sub',{
                order_id,
            }).then(response => {
                document.getElementById('order-details').innerHTML = response.data;
            }).catch(error => {
                console.error('Failed to load order details:', error);
            })

        }
    </script>

@endpush
