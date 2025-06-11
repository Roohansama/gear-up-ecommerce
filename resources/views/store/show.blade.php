@extends('layouts.store.app')

@section('content')
    <div class="flex flex-col space-y-4 w-full">
        <div
                class="flex flex-col md:flex-row justify-center items-center w-full min-h-24 bg-neutral-700 text-white px-4 md:px-8 lg:px-24 xl:px-72 py-4 md:py-5 space-y-3 md:space-y-0">

            <!-- Breadcrumb -->
            <h3 class="text-sm md:text-base flex justify-center md:text-left w-full md:w-2/5">
                HOME / SHOP / COMPUTERS
            </h3>
        </div>


        <div
                class="flex flex-col md:flex-row w-full px-4 sm:px-6 lg:px-24 xl:px-72 space-y-6 md:space-y-0 md:space-x-6">
            @if(isset($product))
                <!-- Image Carousel -->
                <div class="w-full md:w-5/12">
                    <div class="relative">
                        <img id="mainImage" src="{{asset('storage/'. $images[0]['image_path'])}}"
                             alt="Main Image"
                             class="w-full h-96 object-fit rounded-lg shadow">
                    </div>

                    <!-- Thumbnails -->
                    <div class="flex gap-2 mt-4 h-30 overflow-x-auto items-center">
                        @foreach ($images as $image)
                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                 onclick="document.getElementById('mainImage').src = this.src" alt="image"
                                 class="w-20 h-20 object-fit cursor-pointer rounded opacity-60 hover:opacity-100 hover:-translate-y-1/12 hover:border hover:border-gray-300 transition duration-700">
                        @endforeach
                    </div>
                </div>

                <!-- Product Description -->
                <div class="w-full md:w-7/12">
                    <h2 class="text-2xl font-bold mb-2">{{ $product->name}}</h2>
                    <p class="text-gray-700 mb-4">{{ $product->description }}</p>
                    <p class="text-xl font-semibold mb-4">${{ $product->price }}</p>

                    <!-- Add to Cart / Buy Buttons -->
                    <button class="text-white px-6 py-2 rounded bg-amber-400 hover:bg-amber-500">
                        Add to Cart
                    </button>
                </div>

        </div>
        @else
            <h1>Product not found</h1>
        @endif

    </div>

@endsection
