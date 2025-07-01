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

            <div class="container mx-auto px-4 pt-16">
            <div
                class="flex flex-col md:flex-row w-full space-y-6 md:space-y-0 md:space-x-6">
                @if(isset($product))
                    <!-- Image Carousel -->
                    <div class="w-full md:min-w-5/12">
                        <div class="relative">
                            <img id="main-image" src="{{asset('storage/'. $images[0]['image_path'])}}"
                                 alt="Main Image"
                                 class="min-w-full h-96 object-fit shadow">
                        </div>
                        {{--                    <div id="zoom-lens"--}}
                        {{--                         class="w-96 h-96 absolute hidden group-hover:block border-2 border-gray-300 rounded-full pointer-events-none"></div>--}}

                        <!-- Thumbnails -->
                        <div class="flex gap-2 mt-4 h-30 overflow-x-auto items-center ">
                            @foreach ($images as $image)
                                <img src="{{ asset('storage/' . $image->image_path) }}"
                                     onclick="document.getElementById('mainImage').src = this.src" alt="image"
                                     class="w-30 h-20 object-fit cursor-pointer rounded opacity-60 hover:opacity-100 hover:-translate-y-1/12 hover:border hover:border-gray-300 transition duration-700">
                            @endforeach
                        </div>
                    </div>

                    <!-- Product Description -->
                    <div class="w-full md:min-w-7/12">
                        <h2 class="text-2xl font-bold mb-2">{{ $product->name}}</h2>
                        <div class="bg-neutral-300 w-1/12 min-h-1"></div>
                        <div class="flex flex-row font-semibold mb-4"><span
                                class="flex text-md align-top">Rs</span><span
                                class="text-xl">{{number_format($product->price)  }}</span></div>

                        <div class="prose text-gray-700 mb-4">
                            {!! $product->description !!}
                        </div>
                        <!-- Add to Cart / Buy Buttons -->
                        <button onclick="addToCart({{$product->id}})" type="button"
                                class="text-white px-6 py-2 rounded bg-amber-400 hover:bg-amber-500 mb-5 cursor-pointer">
                            Add to Cart
                        </button>
                    </div>
            </div>
            @else
                <h1>Product not found</h1>
            @endif
        </div>
    </div>
@endsection
@push('scripts')
    <script>

        function addToCart(productId) {
            axios.post('/cart/add', {
                product_id: productId,
                quantity: 1
            })
                .then(response => {
                    // alert(response.data.message);
                    // You can update cart UI here
                    // console.log(response.data.cart);
                })
                .catch(error => {
                    console.error('Error adding to cart:', error);
                });
        }
    </script>
@endpush
