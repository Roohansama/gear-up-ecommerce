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
            class="flex flex-col md:flex-row w-full mb-5 px-4 sm:px-6 lg:px-24 xl:px-72 space-y-6 md:space-y-0 md:space-x-6">

            <!-- Sidebar Filters -->
            <div class="hidden md:flex flex-col w-3/12 space-y-4 select-none">
                <a href="{{route('store.index')}}" class="text-lg text-gray-600 font-semibold">BROWSE</a>
                <div class="bg-neutral-200 w-1/12 min-h-1"></div>
                <div class="flex flex-col space-y-2">
                    <div class="flex flex-row justify-between">
                        <h1>Categories</h1>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="gray" id="filter-svg" class="size-5 cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </div>
                    <div class="flex flex-row space-x-2 hidden" id="filter-content">
                        <div class="h-full w-1 bg-neutral-200"></div>
                        <div class="flex flex-col space-y-2">
                            @foreach($categories as $category)
                                <a href="{{route('store.index', $category->name)}}" class="text-md text-gray-500 capitalize">{{$category->name}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Add filter content here -->
            </div>

            <!-- Product Grid -->
            <div class="w-full md:w-9/12">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                    @if(isset($products))
                        @foreach ($products as $product)
                            <a href="{{route('product.show',$product->slug)}}">
                                <div class="rounded-lg p-4 hover:shadow-lg transition bg-white">
                                    <img src="{{ asset('storage/' . $images[$product->id][0]['image_path']) }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-40 object-cover mb-3 rounded-md">
                                    <p class=" text-base mb-1 truncate">{{ $product->name }}</p>
                                    <div class="flex flex-row font-semibold mb-4"><span class="flex text-md align-top">Rs</span><span
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
    <script>
        var filter = document.getElementById('filter-svg');
        filter.addEventListener('click', function () {
            var filterContent = document.getElementById('filter-content');
            filterContent.classList.toggle('hidden');
        });
    </script>
@endsection
