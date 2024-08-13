<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\ProductCategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('product_categories', [ProductCategoryController::class, 'index']);
Route::get('product_categories_all', [ProductCategoryController::class, 'get_all']);
Route::get('product_categories/{id}', [ProductCategoryController::class, 'show']);
Route::post('product_categories', [ProductCategoryController::class, 'store']);
Route::put('product_categories/{id}', [ProductCategoryController::class, 'update']);
Route::delete('product_categories/{id}', [ProductCategoryController::class, 'destroy']);

Route::get('product', [ProductController::class, 'index']);
Route::get('product_vw', [ProductController::class, 'get_vw_product']);
Route::get('product/{id}', [ProductController::class, 'show']);
Route::post('product', [ProductController::class, 'store']);
Route::put('product/{id}', [ProductController::class, 'update']);
Route::delete('product/{id}', [ProductController::class, 'destroy']);

Route::get('product_variants', [ProductVariantController::class, 'index']);
Route::get('product_variants_get/{id}', [ProductVariantController::class, 'get_product']);
Route::get('product_variants/{id}', [ProductVariantController::class, 'show']);
Route::post('product_variants', [ProductVariantController::class, 'store']);
Route::put('product_variants/{id}', [ProductVariantController::class, 'update']);
Route::delete('product_variants/{id}', [ProductVariantController::class, 'destroy']);

Route::get('cart', [CartController::class, 'index']);
Route::get('cart/{id}', [CartController::class, 'show']);
Route::post('cart', [CartController::class, 'store']);
Route::put('cart/{id}', [CartController::class, 'update']);
Route::delete('cart/{id}', [CartController::class, 'destroy']);

Route::post('checkout/{id}', [CheckoutController::class, 'checkout_cart']);
Route::post('invoice', [CheckoutController::class, 'get_invoice']);
Route::get('invoice_all', [CheckoutController::class, 'get_all_invoice']);
Route::post('invoice_vw', [CheckoutController::class, 'get_vw_invoice']);

Route::post('cart_vw', [CartController::class, 'get_vw_cart']);
Route::post('checkout_vw', [CartController::class, 'get_vw_cart_checkout']);
