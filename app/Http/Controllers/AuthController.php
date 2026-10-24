<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function registerUser(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'number' => 'required|max:255',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
           'name' => $validatedData['name'],
           'email' => $validatedData['email'],
           'number' => $validatedData['number'],
            'password' => Hash::make($validatedData['password']),
        ]);
        Log::info($user->email . ' created an account');

        return response()->json([
            'message' => 'user created successfully',
            'user' => $user,
        ]);
    }


}
