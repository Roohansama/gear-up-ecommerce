@extends('layouts.app')

@section('content')
    <div class="w-full mx-auto p-6  overflow-scroll py-8 px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between">
            <h1 class="text-2xl font-bold mb-6">Categories</h1>
            <button id="add-category-row"
                    class="mb-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                + Add Category
            </button>
        </div>

        <!-- Placeholder for new input row -->
        <div id="new-category-row"></div>

        <div class="space-y-3 mb-6 bg-white rounded shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 text-gray-600 text-sm uppercase">
                <tr>
                    <th class="px-6 py-3 text-left">#</th>
                    <th class="px-6 py-3 text-left">Name</th>
                </tr>
                </thead>
                <tbody id="category-list-body">
                @foreach ($categories as $category)
                    <tr>
                        <td class="px-4 py-2 ">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-4 py-2">
                            <div class="p-3 text-gray-700">
                                {{ $category->name }}
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addButton = document.getElementById('add-category-row');
            const rowContainer = document.getElementById('new-category-row');
            const categoryListBody = document.getElementById('category-list-body');
            const iteration = {{($categories->count())+1}};


                let
            inputAdded = false;

            addButton.addEventListener('click', () => {
                if (inputAdded) return;

                const inputRow = document.createElement('div');
                inputRow.className = "flex items-center justify-between space-x-2";
                inputRow.innerHTML = `
<form id="add-category-row" method="POST" action="{{route('category.store')}}" class="flex items-center justify-between">
@csrf
                <button id="delete-row"
                     class="px-3 py-2 bg-red-600 text-white rounded hover:bg-red-700" type="button">X</button>
            <input type="text" id="new-category-name" name="name" placeholder="Enter category name"
                        class="border rounded px-3 py-2 w-full">
                 <button id="save-category"
                     class="px-3 py-2 bg-green-600 text-white rounded hover:bg-green-700" type="submit">Save</button>
     </form>
`;

                rowContainer.appendChild(inputRow);
                inputAdded = true;

                inputRow.querySelector('#delete-row').addEventListener('click', () => {
                    inputRow.remove();
                    inputAdded = false;
                });
            });

        {{--document.getElementById('save-category').addEventListener('click', () => {--}}
                {{--    const name = document.getElementById('new-category-name').value;--}}

                {{--    if (!name.trim()) {--}}
                {{--        alert('Category name is required');--}}
                {{--        return;--}}
                {{--    }--}}

                {{--    fetch("{{ route('category.store') }}", {--}}
                {{--        method: 'POST',--}}
                {{--        headers: {--}}
                {{--            'Content-Type': 'application/json',--}}
                {{--            'X-CSRF-TOKEN': '{{ csrf_token() }}'--}}
                {{--        },--}}
                {{--        body: JSON.stringify({name})--}}
                {{--    });--}}
                //                         .then(res => res.json())
                //                         .then(data => {
                //                             if (data.success) {
                //                                 const row = document.createElement('tr');
                //                                 const newIndex = categoryListBody.rows.length+1;
                //                                 row.className = "p-3 rounded text-gray-700 bg-green-50";
                //                                 row.innerHTML = `
                //     <td class="px-4 py-2 border">${newIndex}</td>
                //     <td class="px-4 py-2 border">
                //         <div class="p-3 text-gray-700">${data.category.name}</div>
                //     </td>
                // `;
                //                                 categoryListBody.appendChild(row);
                //                                 rowContainer.innerHTML = '';
                //                                 inputAdded = false;
                //                             } else {
                //                                 alert('Error saving category');
                //                             }
                //                         });
                //                 });
        });
    </script>
@endsection
