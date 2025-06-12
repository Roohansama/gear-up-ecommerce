@extends('layouts.store.app')

@section('content')
    <div class="flex flex-col space-y-4 w-full">
        <div
            class="flex flex-col md:flex-row items-center justify-between w-full min-h-24 bg-neutral-700 text-white px-4 md:px-8 lg:px-24 xl:px-72 py-4 md:py-5 space-y-3 md:space-y-0">
            <!-- Empty Spacer (for alignment on desktop) -->
            <span class="hidden md:block md:w-2/5"></span>

            <!-- Breadcrumb -->
            <h3 class="text-sm md:text-base text-center md:text-left md:w-2/5">
                HOME / SHOP / COMPUTERS
            </h3>

            <!-- Sort Dropdown -->
            <div class="w-full md:w-1/5 flex justify-center md:justify-end">
                <select name="sort" id="sort"
                        class="w-2/3 md:w-full bg-neutral-500 p-2 rounded-full text-sm focus:outline-none">
                    <option value="1">Sort by popularity</option>
                    <!-- Add more sort options if needed -->
                </select>
            </div>
        </div>

        <div
            class="flex flex-col md:flex-row w-full px-4 sm:px-6 lg:px-24 xl:px-72 space-y-6 md:space-y-0 md:space-x-6">

            <!-- Sidebar Filters -->
            <div class="hidden md:flex flex-col w-3/12">
                <h3 class="text-lg font-semibold mb-4">Filters</h3>
                <!-- Add filter content here -->
            </div>

            <!-- Product Grid -->
            <div class="w-full md:w-9/12">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @if(isset($products))
                        @foreach ($products as $product)
                            <a href="{{route('product.show',$product->slug)}}">
                                <div class="rounded-lg p-4 shadow hover:shadow-lg transition bg-white">
                                    <img src="{{ asset('storage/' . $images[$product->id][0]['image_path']) }}" alt="{{ $product->name }}"
                                         class="w-full h-40 object-cover mb-3 rounded-md">
                                    <p class=" text-base mb-1 truncate">{{ $product->name }}</p>
                                    <span class="font-semibold text-sm md:text-base">${{ $product->price }}</span>
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
