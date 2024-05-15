<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Faker\Provider\UserAgent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AuthenticatedTokenController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => Rule::requiredIf(
                str_contains($request->userAgent(), 'mobile')
            )
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {

            return response([
                'email' => ['As credenciais fornecidas estão incorretas.'],
            ], 422);
        }

        $token = $user->createToken(
            $request->userAgent(),
            ['*'],
            now()->startOfDay()->addYear()
        )->plainTextToken;

        return response(new UserResource($user->withAccessToken($token)), 200);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }
}
