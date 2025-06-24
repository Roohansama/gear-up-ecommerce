@if(isset($order_sub))
    <div class="flex flex-col">
        <h1 class="text-2xl font-semibold">Order #{{ $order_sub->order_number }}</h1>
        <p class="text-sm">Order Date: {{ $order_sub->created_at->format('F j, Y')  }}</p>

        {{-- loop over $order->order_items if you have it --}}
    </div>
@else
    <div class="flex justify-center items-center h-full">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-30 opacity-30 animate-pulse">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
        </svg>
    </div>
@endif
