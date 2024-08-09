<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/api/upload_image', function (Request $request) {
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('images', 'public');
        return response()->json(['image_location' => $path]);
    }

    return response()->json(['error' => 'No image uploaded'], 400);
});