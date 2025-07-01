<div class="flex flex-col divide-x-2 divide-neutral-300 text-black">
    @foreach($cart_data as $cart)
        <div class="flex flex-row font-semibold">
            <div class="flex">
                <img src="{{asset('/storage/products/sample.jpg')}}" alt="" class="w-20 h-20">
            </div>
            <div class="flex flex-col">
                <h1>{{$cart['name']}}</h1>
                <h1 class="text-sm font-normal">{{$cart['quantity'].' x '.$cart['price']}}</h1>
            </div>
        </div>
    @endforeach
</div>

