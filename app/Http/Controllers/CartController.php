<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\VwCart;
use App\Models\VwCartCheckout;

class CartController extends Controller
{
    public function index() {
        $categories = Cart::paginate(200);
        return response()->json($categories);
    }

    public function get_vw_cart(Request $request) {
        $categories = VwCart::where('user_id', $request->user_id)->paginate(200);
        return response()->json($categories);
    }

    public function get_vw_cart_checkout(Request $request) {
        // Fetch ProductVariants where product_id matches the given $id and paginate the results
        $product_variants = VwCartCheckout::where('user_id', $request->user_id)->paginate(5);
        
        // Return the paginated results as a JSON response
        return response()->json($product_variants);
    }

    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required|integer',
            'product_variant_id' => 'required|integer',
            'qty' => 'required|integer',
            'status' => 'required|string|max:255',
            'created_user' => 'string|max:255',
        ]);

        $product = Cart::create([
            'user_id' => $request->user_id,
            'product_variant_id' => $request->product_variant_id,
            'qty' => $request->qty,
            'status' => $request->status,
            'created_user' => $request->created_user,
            'created_date' => now(),
        ]);

        return response()->json([
            'message' => 'Cart created successfully.',
            'data' => $product,
        ], 201);
    }

    public function show($id) {
        $product = Cart::findOrFail($id);
        return response()->json($product);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'user_id' => 'required|integer',
            'product_variant_id' => 'required|integer',
            'qty' => 'required|integer',
            'status' => 'required|string|max:255',
            'updated_user' => 'string|max:255',
        ]);

        $product = Cart::findOrFail($id);
        $product->update([
            'user_id' => $request->user_id,
            'product_variant_id' => $request->product_variant_id,
            'qty' => $request->qty,
            'status' => $request->status,
            'updated_user' => $request->updated_user,
            'updated_date' => now(),
        ]);

        return response()->json([
            'message' => 'Cart updated successfully.',
            'data' => $product,
        ]);
    }

    public function destroy($id) {
        $product = Cart::findOrFail($id);
        $product->delete();

        return response()->json([
            'message' => 'Cart deleted successfully.',
        ]);
    }
}
