<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        // 1. This checks the password/credentials against the DB
        $request->authenticate();

        // 2. Fetch the authenticated user instance
        $user = $request->user();

        // 3. Generate a pure stateless access token string
        $token = $user->createToken('auth_token')->plainTextToken;

        // 4. Return the token directly to Postman / your frontend
        return response()->json([
            'success' => true,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
            ]
        ], 200);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        // For a stateless API logout, revoke the token that made the request
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Token revoked successfully'
        ]);
    }
}
