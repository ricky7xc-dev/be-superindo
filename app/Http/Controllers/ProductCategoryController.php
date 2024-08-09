<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function index() {
        $categories = ProductCategory::paginate(5);
        return response()->json($categories);
    }

    public function get_all() {
        $categories = ProductCategory::all();
        return response()->json($categories);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'active' => 'boolean',
            'created_user' => 'string|max:255',
        ]);

        $category = ProductCategory::create([
            'name' => $request->name,
            'active' => $request->active ?? true,
            'created_user' => $request->created_user,
            'created_date' => now(),
        ]);

        return response()->json([
            'message' => 'Product category created successfully.',
            'data' => $category,
        ], 201);
    }

    public function show($id) {
        $category = ProductCategory::findOrFail($id);
        return response()->json($category);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'active' => 'boolean',
            'updated_user' => 'string|max:255',
        ]);

        $category = ProductCategory::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'active' => $request->active,
            'updated_user' => $request->updated_user,
            'updated_date' => now(),
        ]);

        return response()->json([
            'message' => 'Product category updated successfully.',
            'data' => $category,
        ]);
    }

    public function destroy($id) {
        $category = ProductCategory::findOrFail($id);
        $category->delete();

        return response()->json([
            'message' => 'Product category deleted successfully.',
        ]);
    }
}
