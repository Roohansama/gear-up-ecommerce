@extends('layouts.store.app')

@section('content')
        <div class="flex flex-col divide-x-2 divide-neutral-300">
            @if(isset($cart_data))
                @include('store.partials.mini-cart-items')
            @else
                @include('store.partials.mini-empty-cart')
            @endif
        </div>
@endsection
