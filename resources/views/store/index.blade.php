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
                                <a href="{{route('store.index', ['category' => $category->name])}}"
                                   class="text-md text-gray-500 capitalize">{{$category->name}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{--                PRICE RANGE FILTER--}}
                <div class="w-full max-w-md mx-auto">
                    <form action="{{route('store.index')}}" method="get">
                        <h3 class="text-lg font-semibold mb-4">Price Range</h3>
                        <div class="relative h-10">
                            <!-- Track -->
                            <div
                                class="absolute top-1/2 left-0 right-0 h-1 bg-gray-300 rounded transform -translate-y-1/2"></div>

                            <!-- Selected Range Highlight -->
                            <div id="range-selected"
                                 class="absolute top-1/2 h-1 bg-blue-500 rounded transform -translate-y-1/2 z-0">
                            </div>

                            <!-- Min Handle -->
                            <input type="range" id="min-range" name="min_range" min="0" max="1000" value="{{ request('min', 0) }}"
                                   class="absolute top-1/4 w-full pointer-events-none appearance-none z-10 bg-transparent
           [&::-webkit-slider-thumb]:pointer-events-auto
           [&::-webkit-slider-thumb]:h-4 [&::-webkit-slider-thumb]:w-4
           [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-blue-500
           [&::-webkit-slider-thumb]:appearance-none
           [&::-moz-range-thumb]:pointer-events-auto
           [&::-moz-range-thumb]:h-4 [&::-moz-range-thumb]:w-4
           [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:bg-blue-500"/>

                            <!-- Max Handle -->
                            <input type="range" id="max-range" name="max_range" min="0" max="1000" value="{{ request('max', 1000) }}"
                                   class="absolute top-1/4 w-full pointer-events-none appearance-none z-10 bg-transparent
           [&::-webkit-slider-thumb]:pointer-events-auto
           [&::-webkit-slider-thumb]:h-4 [&::-webkit-slider-thumb]:w-4
           [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-blue-500
           [&::-webkit-slider-thumb]:appearance-none
           [&::-moz-range-thumb]:pointer-events-auto
           [&::-moz-range-thumb]:h-4 [&::-moz-range-thumb]:w-4
           [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:bg-blue-500"/>
                        </div>

                        <!-- Display values -->
                        <div class="flex justify-between mt-2 text-sm text-gray-700">
                            <div class="flex flex-row w-half">
                                <button type="submit">Filter</button>
                            </div>
                            <div class="flex flex-row w-half space-x-1">
                                <span id="min-value">Rs0</span>
                                <span>—</span>
                                <span id="max-value">Rs1000</span>
                            </div>
                        </div>
                    </form>
                </div>
                {{--                END OF PRICE RANGE FILTER--}}
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

    {{--    PRICE SLIDER JS--}}
    <script>
        const minRange = document.getElementById("min-range");
        const maxRange = document.getElementById("max-range");
        const minValue = document.getElementById("min-value");
        const maxValue = document.getElementById("max-value");
        const selectedRange = document.getElementById("range-selected");

        const updateRange = () => {
            let min = parseInt(minRange.value);
            let max = parseInt(maxRange.value);

            if (min > max - 50 && min > 0) {
                min = max - 50;
                minRange.value = min;
            }

            if (max < min + 50) {
                max = min + 50;
                maxRange.value = max;
            }

            minValue.textContent = `Rs${min}`;
            maxValue.textContent = `Rs${max}`;

            const percentMin = (min / 1000) * 100;
            const percentMax = (max / 1000) * 100;

            selectedRange.style.left = percentMin + "%";
            selectedRange.style.right = (100 - percentMax) + "%";
        };

        minRange.addEventListener("input", updateRange);
        maxRange.addEventListener("input", updateRange);

        updateRange();
    </script>
@endsection
