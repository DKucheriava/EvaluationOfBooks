<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use function Laravel\Prompts\password;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed'
            ]);


            $user = User::where('email', $validatedData['email'])->first();

            if ($user) {
                return response()->json(['message' => 'Email already exists'], 409);
            }

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password'])
            ]);

            return response()->json(['message' => 'Registration successful!'], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Validation error', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            \Log::error('Registration error: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred during registration: ' . $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user || !$user->verifyPassword($validatedData['password'])) {
            return response()->json(['message' => 'Error'], 401);
        }

        Auth::login($user);

        return response()->json(['message' => 'Login successful!', 'user' => $user]);
    }
}
