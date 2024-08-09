<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            // 'role' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)
                    ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Login successful',
                'user' => $user
            ]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}

