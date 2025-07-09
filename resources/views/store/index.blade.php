@extends('layouts.store.app')

@section('content')
    <div class="flex flex-col space-y-4 w-full">
        @include('store.breadcrumbs')
        <div
            class="container mx-auto flex flex-col md:flex-row w-full mb-5 space-y-6 md:space-y-0 md:space-x-6">

            @include('store.filter')

            <!-- Product Grid -->
            <div class="w-full md:w-9/12">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 leading-none">
                    @if(isset($products))
                        @foreach ($products as $product)
                            <a href="{{route('product.show',$product->slug)}}">
                                <div class="rounded-lg p-4 hover:shadow-lg transition bg-white">
                                    <img src="{{ asset('storage/' . $images[$product->id][0]['image_path']) }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-40 object-fit mb-3 rounded-md">
                                    <p class=" mb-1 text-center ">{{ $product->name }}</p>
                                    <div class="flex flex-row font-[500] mb-4 justify-center"><span
                                            class="flex text-md align-top">Rs</span><span
                                            class="text-md">{{number_format($product->price)  }}</span></div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <h1>Product not found</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
