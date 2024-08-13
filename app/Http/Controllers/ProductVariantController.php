<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariant;

class ProductVariantController extends Controller
{
    public function index() {
        $product_variants = ProductVariant::paginate(8);
        return response()->json($product_variants);
    }

    public function get_product($id) {
        // Fetch ProductVariants where product_id matches the given $id and paginate the results
        $product_variants = ProductVariant::where('product_id', $id)->paginate(5);
        
        // Return the paginated results as a JSON response
        return response()->json($product_variants);
    }

    public function store(Request $request) {
        $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'image_location' => 'required|string|max:255',
            'qty' => 'required|integer',
            'price' => 'required|string|max:255',
            'product_id' => 'required|integer',
            'active' => 'boolean',
            'created_user' => 'string|max:255',
        ]);

        $product_variants = ProductVariant::create([
            'code' => $request->code,
            'image_location' => $request->image_location,
            'plu' => $request->plu,
            'name' => $request->name,
            'product_id' => $request->product_id,
            'price' => $request->price,
            'qty' => $request->qty,
            'active' => $request->active ?? true,
            'created_user' => $request->created_user,
            'created_date' => now(),
        ]);

        return response()->json([
            'message' => 'Product Variant created successfully.',
            'data' => $product_variants,
        ], 201);
    }

    public function show($id) {
        $product_variants = ProductVariant::findOrFail($id);
        return response()->json($product_variants);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'image_location' => 'required|string|max:255',
            'qty' => 'required|integer',
            'price' => 'required|string|max:255',
            'product_id' => 'required|integer',
            'active' => 'boolean',
            'updated_user' => 'string|max:255',
        ]);

        $product_variants = ProductVariant::findOrFail($id);
        $product_variants->update([
            'code' => $request->code,
            'image_location' => $request->image_location,
            'plu' => $request->plu,
            'name' => $request->name,
            'product_id' => $request->product_id,
            'price' => $request->price,
            'qty' => $request->qty,
            'active' => $request->active ?? true,
            'updated_user' => $request->updated_user,
            'updated_date' => now(),
        ]);

        return response()->json([
            'message' => 'Product Variant updated successfully.',
            'data' => $product_variants,
        ]);
    }

    public function destroy($id) {
        $product_variants = ProductVariant::findOrFail($id);
        $product_variants->delete();

        return response()->json([
            'message' => 'Product Variant deleted successfully.',
        ]);
    }
}
