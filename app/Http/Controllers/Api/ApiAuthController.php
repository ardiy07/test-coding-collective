<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    /**
     * Handle user login and token generation.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        // Validate the incoming login request.
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the credentials are invalid.
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'Email or password is incorrect',
            ], 401);
        }

        // Generate a new authentication token for the user.
        $token = $request->user()->createToken('auth_token')->plainTextToken;

        // Update user status to active after successful login.
        $user = $request->user();
        $user->status = 'active';
        $user->save();

        // Return a success response with the token.
        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token,
        ], 200);
    }

    /**
     * Handle user logout and invalidate session and tokens.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        // Check if the user is authenticated.
        if (!$request->user()) {
            return response()->json([
                'status' => false,
                'message' => 'User not authenticated',
            ], 401);
        }

        // Update user status to inactive before logout.
        $user = $request->user();
        $user->status = 'inactive';
        $user->save();

        // Invalidate session and delete the current access token.
        $request->session()->invalidate(); 
        $request->user()->currentAccessToken()->delete();

        // Return a success response after logout.
        return response()->json([
            'status' => true,
            'message' => 'Logout successful',
        ], 200);
    }
}
