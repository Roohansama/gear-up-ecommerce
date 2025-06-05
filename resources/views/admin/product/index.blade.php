@extends('layouts.app')

@section('content')
    <div class="w-full mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Products</h1>
            <a href="{{ route('product.add') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Add Product
            </a>
        </div>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 text-gray-600 text-sm uppercase">
                <tr>
                    <th class="px-6 py-3 text-left">#</th>
                    <th class="px-6 py-3 text-left">Image</th>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Category</th>
                    <th class="px-6 py-3 text-left">Price</th>
                    <th class="px-6 py-3 text-left">Stock</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($products as $product)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product Image" class="w-20 h-20 object-cover">
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                            {{ $product->name }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ '$product->category->name' ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">${{ number_format($product->price, 2) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $product->stock }}</td>
                        <td class="px-6 py-4 text-sm space-x-2">
                            <a href=""
                               class="text-blue-500 hover:underline">Edit</a>
                            <form method="POST" action=""
                                  class="inline-block"
                                  onsubmit="return confirm('Delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:underline" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            No products found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
