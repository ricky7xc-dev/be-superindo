<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\VwProduct;

class ProductController extends Controller
{
    public function index() {
        $categories = Product::paginate(5);
        return response()->json($categories);
    }

    public function get_vw_product() {
        $categories = VwProduct::paginate(5);
        return response()->json($categories);
    }

    public function store(Request $request) {
        $request->validate([
            'plu' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'product_category_id' => 'required|integer',
            'active' => 'boolean',
            'created_user' => 'string|max:255',
        ]);

        $product = Product::create([
            'plu' => $request->plu,
            'name' => $request->name,
            'product_category_id' => $request->product_category_id,
            'active' => $request->active ?? true,
            'created_user' => $request->created_user,
            'created_date' => now(),
        ]);

        return response()->json([
            'message' => 'Product created successfully.',
            'data' => $product,
        ], 201);
    }

    public function show($id) {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'plu' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'product_category_id' => 'required|integer',
            'active' => 'boolean',
            'updated_user' => 'string|max:255',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'plu' => $request->plu,
            'name' => $request->name,
            'product_category_id' => $request->product_category_id,
            'active' => $request->active ?? true,
            'updated_user' => $request->updated_user,
            'updated_date' => now(),
        ]);

        return response()->json([
            'message' => 'Product updated successfully.',
            'data' => $product,
        ]);
    }

    public function destroy($id) {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully.',
        ]);
    }
}
