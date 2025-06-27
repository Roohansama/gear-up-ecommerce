@if(isset($order_sub))
    <div class="flex flex-col space-y-4">
        <div class="flex text-xl font-semibold justify-between    ">
            <span class="flex space-x-4">
                 <h1>
                Order #{{ $order_sub->order_number }}
            </h1>
            <a href="{{route('order.show', $order_sub->id)}}" class="self-center" target="_blank">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      stroke="currentColor" class="size-5 cursor-pointer">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
        </svg>
            </a>
            </span>

            <button onclick="removeOrderSub()" class="cursor-pointer shadow-md rounded-lg border-1 p-1 border-gray-200 hover:scale-110 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="flex justify-between">
            <p class="text-gray-400 font-semibold">Payment</p>
            <p class="bg-green-500 text-white px-1.5 py-0.5 rounded">Completed</p>
        </div>
        <div class="flex justify-between">
            <p class="text-gray-400 font-semibold">Status</p>
            <p class="px-1.5 py-0.5 rounded text-white
                                    {{ $order_sub->order_status == 'pending' ? 'bg-yellow-500' :
                                ($order_sub->order_status == 'confirmed' ? 'bg-green-600' :
                                ($order_sub->order_status == 'cancelled' ? 'bg-red-600' : 'bg-gray-500')) }}">
                {{ ucfirst($order_sub->order_status) }}
            </p>
        </div>
        <div class="flex justify-between">
            <p class="text-gray-400 font-semibold">Customer</p>
            <p>{{$order_sub->first_name.' '.$order_sub->last_name }}</p>
        </div>
        <div class="flex justify-between">
            <p class="text-gray-400 font-semibold">Order Date</p>
            <p>{{$order_sub->created_at->format('F j, Y') }}</p>
        </div>
        <div class="flex justify-between">
            <p class="text-gray-400 font-semibold">Ship Date</p>
            <p>hmm</p>
        </div>
        <div class="flex flex-col space-y-3">
            <p class="text-gray-400 font-semibold">Order Notes</p>
            <textarea name="description" id="" rows="3" class="bg-gray-100 resize-none p-3 rounded-lg"
                      disabled>{{$order_sub->order_notes}}</textarea>
        </div>
        <div class="min-h-0.5 min-w-full bg-gray-200"></div>

        <div
            class="flex flex-col space-y-3 mb-4 border-1 border-gray-200 p-3 rounded-lg md:min-h-64 max-h-64 overflow-scroll">
            @foreach($order_sub->orderItems as $item)
                <div class="flex justify-between">
                    <div class="font-semibold flex space-x-2">
                        <span class="text-gray-400">{{$loop->iteration}}</span>
                        <span>
                            @if($product_images)
                                <img src="{{asset('storage/'.$product_images[$item->product_id][0]['image_path'])}}"
                                     alt="none" class="w-5 h-5 rounded-full">
                            @endif
                        </span>
                        <span>
                        {{ucfirst($item->product_name)}}
                        </span>
                    </div>
                    <p>{{$item->price}}
                        <span class="font-semibold">
                        {{'x'.$item->quantity}}
                    </span></p>
                </div>
                <div class="min-h-0.5 min-w-full bg-gray-200"></div>
            @endforeach
        </div>
        <div class="flex justify-between border-1 border-gray-200 p-3 rounded-lg">
            <p class=" font-semibold">Total</p>
            <p class="font-semibold">{{$total}}/-</p>
        </div>
    </div>
@else
    <div class="flex justify-center items-center h-full">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="size-30 opacity-30 animate-pulse">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636"/>
        </svg>
    </div>
@endif
