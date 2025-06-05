@extends('layouts.app')

@section('content')
    <div class="w-full mx-50 mt-10 p-6 bg-white rounded shadow overflow-scroll">

        <h1 class="text-2xl font-bold mb-6">Categories</h1>
        <button id="add-category-row"
                class="mb-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            + Add Category
        </button>

        <!-- Placeholder for new input row -->
        <div id="new-category-row"></div>

        <div class="space-y-3 mb-6 ">
            <table class="w-full border-collapse">
                <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Name</th>
                </tr>
                </thead>
                <tbody id="category-list-body">
                @foreach ($categories as $category)
                    <tr>
                        <td class="px-4 py-2 border">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-4 py-2 border">
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
            const iteration = {{($categories->count())+1}}

                let
            inputAdded = false;

            addButton.addEventListener('click', () => {
                if (inputAdded) return;

                const inputRow = document.createElement('div');
                inputRow.className = "flex items-center space-x-2";
                inputRow.innerHTML = `
<form id="add-category-row" method="POST" action="{{route('category.store')}}">
@csrf
       <input type="text" id="new-category-name" name="name" placeholder="Enter category name"
                   class="border rounded px-3 py-2 w-full">
            <button id="save-category"
                class="px-3 py-2 bg-green-600 text-white rounded hover:bg-green-700">Save</button>
</form>
        `;

                rowContainer.appendChild(inputRow);
                inputAdded = true;

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
        });
    </script>
@endsection
