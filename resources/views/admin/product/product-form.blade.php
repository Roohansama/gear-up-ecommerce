@extends('layouts.admin.app')

@section('content')
    <div class="w-full overflow-scroll mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-semibold mb-6">
            {{$id ? 'Edit' : 'Add New'}}
            Product</h2>

        <form method="POST" action="{{ route('product.store', $id ?? null) }}" enctype="multipart/form-data"
              class="space-y-6 bg-white shadow rounded-lg py-8 px-4 sm:px-6 lg:px-8">
            @csrf

            <!-- Name -->
            <div>
                <label class="block font-medium mb-1">Product Name</label>
                <input type="text" name="name" value="{{$id ? $product->name : null}}"
                       class="w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- Description -->
            <div class="prose">
                <label class="block font-medium mb-1">Description</label>
                <input id="description" type="hidden" name="description" value="{{ old('description', $product->description ?? '') }}">
                <trix-editor input="description" class="trix-content mt-1 block w-full border border-gray-300 rounded-md shadow-sm"></trix-editor>
            </div>

            <!-- Price -->
            <div>
                <label class="block font-medium mb-1">Price ($)</label>
                <input type="number" name="price" step="0.01" class="w-full border-gray-300 rounded-md shadow-sm"
                       value="{{$id ? $product->price : null}}"
                       required>
            </div>

            <!-- Sale Price -->
            <div>
                <label class="block font-medium mb-1">Sale Price ($)</label>
                <input type="number" name="sale_price" step="0.01" class="w-full border-gray-300 rounded-md shadow-sm"
                       value="{{$id ? $product->sale_price : null}}"
                       required>
            </div>

            <!-- Sku -->
            <div>
                <label class="block font-medium mb-1">Sku</label>
                <input type="text" name="sku" step="0.01" class="w-full border-gray-300 rounded-md shadow-sm"
                       value="{{$id ? $product->sku : null}}"
                       required>
            </div>

            <!-- Stock -->
            <div>
                <label class="block font-medium mb-1">Stock</label>
                <input type="number" name="stock" class="w-full border-gray-300 rounded-md shadow-sm"
                       value="{{$id ? $product->stock : null}}" required>
            </div>

            <!-- Category -->
            <div>
                <label class="block font-medium mb-1">Category</label>
                <select name="category_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="">Select Category</option>
                    @if(isset($categories))
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ (isset($product) && $product->category_id == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <!-- Image -->
            <div>
                <label class="block font-medium mb-1">Product Image</label>
                @if(isset($product) && $product->image_path)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="Current Image"
                             class="w-32 h-32 object-cover rounded-md">
                    </div>
                @endif
                <input type="file" name="images[]" multiple class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                   file:rounded-md file:border-0 file:text-sm file:font-semibold
                   file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
            </div>

            <!-- Submit -->
            <div class="pt-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    {{$id ? 'Edit' : 'Add'}} Product
                </button>
            </div>
        </form>
    </div>
@endsection



