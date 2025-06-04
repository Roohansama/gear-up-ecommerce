@extends('layouts.app')

@section('content')
    <div class="w-full mx-50 mt-10 p-6 bg-white rounded shadow">

        <h1 class="text-2xl font-bold mb-6">Categories</h1>

        <div id="category-list" class="space-y-3 mb-6">
            @foreach ($categories as $category)
                <div class="p-3 border rounded text-gray-700 bg-gray-50">
                    {{ $category->name }}
                </div>
            @endforeach
        </div>

        <button id="add-category-row"
                class="mb-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            + Add Category
        </button>

        <!-- Placeholder for new input row -->
        <div id="new-category-row"></div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addButton = document.getElementById('add-category-row');
            const rowContainer = document.getElementById('new-category-row');
            const categoryList = document.getElementById('category-list');

            let inputAdded = false;

            addButton.addEventListener('click', () => {
                if (inputAdded) return;

                const inputRow = document.createElement('div');
                inputRow.className = "flex items-center space-x-2";
                inputRow.innerHTML = `
            <input type="text" id="new-category-name" placeholder="Enter category name"
                   class="border rounded px-3 py-2 w-full">
            <button id="save-category"
                class="px-3 py-2 bg-green-600 text-white rounded hover:bg-green-700">Save</button>
        `;

                rowContainer.appendChild(inputRow);
                inputAdded = true;

                document.getElementById('save-category').addEventListener('click', () => {
                    const name = document.getElementById('new-category-name').value;

                    if (!name.trim()) {
                        alert('Category name is required');
                        return;
                    }

                    fetch("{{ route('category.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ name })
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                const newItem = document.createElement('div');
                                newItem.className = "p-3 border rounded text-gray-700 bg-green-50";
                                newItem.innerText = data.category.name;
                                categoryList.appendChild(newItem);
                                rowContainer.innerHTML = '';
                                inputAdded = false;
                            } else {
                                alert('Error saving category');
                            }
                        });
                });
            });
        });
    </script>
@endsection
