@extends('layouts.store.app')

@section('content')
    <div class="flex flex-row w-full mx-40">
        <div class="flex flex-col w-3/12">
            <h3>filters and stuff here</h3>
        </div>
        <div class="flex flex-col w-9/12">
            <div class="grid grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="rounded-lg p-4 shadow hover:shadow-lg transition">
                        <img src="{{asset('storage/'.$product->image_path)}}" alt="{{ $product->name }}" class="w-full h-40 object-cover mb-2">
                        <h4 class="font-semibold text-lg">{{ $product->name }}</h4>
                        <p class="text-gray-600 text-sm mb-2">{{ $product->description }}</p>
                        <span class="font-bold text-blue-600">${{ $product->price }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
