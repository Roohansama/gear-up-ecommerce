<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $id = Category::create([
            'name' => $validated['name'],
            'created_at' => now(),
            'updated_at' => now(),
        ])->get('id');


        return response()->json([
            'success' => true,
            'category' => [
                'id' => $id,
                'name' => $validated['name'],
            ]
        ]);
    }
}
