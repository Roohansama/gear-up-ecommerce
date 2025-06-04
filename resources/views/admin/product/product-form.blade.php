@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white shadow rounded-lg mt-10">
        <h2 class="text-2xl font-semibold mb-6">Add New Product</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label class="block font-medium mb-1">Product Name</label>
                <input type="text" name="name" class="w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- Description -->
            <div>
                <label class="block font-medium mb-1">Description</label>
                <textarea name="description" rows="4" class="w-full border-gray-300 rounded-md shadow-sm"
                          required></textarea>
            </div>

            <!-- Price -->
            <div>
                <label class="block font-medium mb-1">Price ($)</label>
                <input type="number" name="price" step="0.01" class="w-full border-gray-300 rounded-md shadow-sm"
                       required>
            </div>

            <!-- Stock -->
            <div>
                <label class="block font-medium mb-1">Stock</label>
                <input type="number" name="stock" class="w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- Category -->
            <div>
                <label class="block font-medium mb-1">Category</label>
                <select name="category_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="">Select Category</option>
{{--                    @if(isset($categories))--}}
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
{{--                    @endif--}}
                </select>
            </div>

            <!-- Image -->
            <div>
                <label class="block font-medium mb-1">Product Image</label>
                <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                   file:rounded-md file:border-0 file:text-sm file:font-semibold
                   file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
            </div>

            <!-- Submit -->
            <div class="pt-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Add Product
                </button>
            </div>
        </form>
    </div>
@endsection


