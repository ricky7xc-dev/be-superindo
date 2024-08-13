<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Invoice;
use App\Models\VwInvoice;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function generateInvoiceCode()
    {
        $latestInvoice = Invoice::orderBy('id', 'desc')->first();

        if (!$latestInvoice) {
            return 'INV-001';
        }

        $latestCode = $latestInvoice->code;
        $number = (int)str_replace('INV-', '', $latestCode);
        $newCode = 'INV-' . str_pad($number + 1, 3, '0', STR_PAD_LEFT);

        return $newCode;
    }

    public function generateInvoice(Request $request)
    {
        // Step 2a: Generate a unique invoice code
        $invoiceCode = $this->generateInvoiceCode(); // Menggunakan $this->

        // Step 2b: Create a new invoice
        $invoice = Invoice::create([
            'code' => $invoiceCode,
            'status' => $request->status,
            'user_id' => $request->user_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'payment_proof' => $request->payment_proof,
            'payment_method' => $request->payment_method,
            'created_user' => $request->created_user,
            // Tambahkan field lain yang diperlukan
        ]);

        // Step 2c: Update cart items for the user
        Cart::where('user_id', $request->user_id)
            ->where('status', 'cart')
            ->update([
                'invoice_id' => $invoice->id,
                'status' => 'checkout',
            ]);

        return $invoice;
    }

    public function checkout_cart(Request $request)
    {
        $invoice = $this->generateInvoice($request); // Menggunakan $this->

        return response()->json($invoice);
    }

    public function get_invoice(Request $request) {
        // Fetch ProductVariants where product_id matches the given $id and paginate the results
        $product_variants = Invoice::where('user_id', $request->user_id)->paginate(5);
        
        // Return the paginated results as a JSON response
        return response()->json($product_variants);
    }

    public function get_vw_invoice(Request $request) {
        // Fetch ProductVariants where product_id matches the given $id and paginate the results
        $product_variants = VwInvoice::where('user_id', $request->user_id)->paginate(5);
        
        // Return the paginated results as a JSON response
        return response()->json($product_variants);
    }

    public function get_all_invoice() {
        $categories = VwInvoice::paginate(200);
        return response()->json($categories);
    }
}
