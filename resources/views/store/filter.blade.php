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
            <h3 class="text-lg font-semibold mb-4">FILTER BY PRICE</h3>
            <div class="bg-neutral-200 w-1/12 min-h-1"></div>
            <div class="relative h-10">
                <!-- Track -->
                <div
                    class="absolute top-1/2 left-0 right-0 h-1 bg-gray-200 rounded transform -translate-y-1/2"></div>

                <!-- Selected Range Highlight -->
                <div id="range-selected"
                     class="absolute top-1/2 h-1 bg-neutral-400 rounded transform -translate-y-1/2 z-0">
                </div>

                <!-- Min Handle -->
                <input type="range" id="min-range" name="min_range" min="0" max="1000"
                       value="{{ request('min_range') ?? '0' }}"
                       class="absolute top-1/4 w-full pointer-events-none appearance-none z-10 bg-transparent
           [&::-webkit-slider-thumb]:pointer-events-auto
           [&::-webkit-slider-thumb]:h-4 [&::-webkit-slider-thumb]:w-4
           [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-neutral-600
           [&::-webkit-slider-thumb]:appearance-none
           [&::-moz-range-thumb]:pointer-events-auto
           [&::-moz-range-thumb]:h-4 [&::-moz-range-thumb]:w-4
           [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:bg-neutral-600"/>

                <!-- Max Handle -->
                <input type="range" id="max-range" name="max_range" min="0" max="1000"
                       value="{{ request('max_range') ?? '1000' }}"
                       class="absolute top-1/4 w-full pointer-events-none appearance-none z-10 bg-transparent
           [&::-webkit-slider-thumb]:pointer-events-auto
           [&::-webkit-slider-thumb]:h-4 [&::-webkit-slider-thumb]:w-4
           [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-neutral-600
           [&::-webkit-slider-thumb]:appearance-none
           [&::-moz-range-thumb]:pointer-events-auto
           [&::-moz-range-thumb]:h-4 [&::-moz-range-thumb]:w-4
           [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:bg-neutral-600"/>
            </div>

            <!-- Display values -->
            <div class="flex justify-between mt-2 text-sm text-gray-700">
                <div class="flex flex-row w-half">
                    <button type="submit" class="px-2 py-1 bg-neutral-500 text-white rounded-full cursor-pointer">FILTER</button>
                </div>
                <div class="flex flex-row w-half space-x-1">
                    <span>Price: </span>
                    <span id="min-value" class="font-semibold">Rs0</span>
                    <span>—</span>
                    <span id="max-value" class="font-semibold">Rs1000</span>
                </div>
            </div>
        </form>
    </div>
    {{--                END OF PRICE RANGE FILTER--}}
    <div>
        <a href="{{route('store.index')}}" class="px-2 py-1 bg-neutral-500 text-white rounded-full cursor-pointer">RESET FILTERS</a>
    </div>
</div>

{{--categories filter dropdown open close js--}}
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
