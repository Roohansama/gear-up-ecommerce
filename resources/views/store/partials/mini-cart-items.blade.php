@extends('layouts.store.app')
@section('content')
    @foreach($cart_data as $cart)
        <div class="flex flex-row font-semibold">
            <div class="flex">
                <img src="{{asset('/storage/products/sample.jpg')}}" alt="" class="w-20 h-20">
            </div>
            <div class="flex flex-col">
                <h1>{{$carta['name']}}</h1>
                <h1 class="text-sm">{{$cart['quantity'].' x '.$cart['price']}}</h1>
            </div>
        </div>
    @endforeach

@endsection
