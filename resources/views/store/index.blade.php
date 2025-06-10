@extends('layouts.store.app')

@section('content')
    <div class="flex flex-col space-y-4 w-full ">
        <div class="flex flex-row min-w-full min-h-24 bg-neutral-700 px-72 py-5 text-white">
            <span class="w-2/5"></span>
            <h3 class="flex w-2/5 items-center">HOME / SHOP / COMPUTERS</h3>
            <div class="flex w-1/5 items-center justify-end">
                <select name="sort" id="sort" class="w-2/3 bg-neutral-500 p-2 rounded-full">
                    <option value="1">Sort by popularity</option>
                </select>
            </div>

        </div>
        <div class="flex flex-row w-full px-72">
            <div class="flex flex-col w-3/12">
                <h3>filters and stuff here</h3>
            </div>
            <div class="flex flex-col w-9/12">
                <div class="grid grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <div class="rounded-lg p-4 shadow hover:shadow-lg transition">
                            <img src="{{asset('storage/'.$product->image_path)}}" alt="{{ $product->name }}"
                                 class="w-full h-40 object-cover mb-2">
                            <h4 class="font-semibold text-lg">{{ $product->name }}</h4>
                            <span class="font-bold text-blue-600">${{ $product->price }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
