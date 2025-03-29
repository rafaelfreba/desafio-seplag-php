<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Services\TokenService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\TokenResource;
use App\Http\Requests\ApiLoginRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiAuthController extends Controller
{
    public function __construct(protected AuthService $authService, protected TokenService $tokenService) {}

    public function login(ApiLoginRequest $request): JsonResource | JsonResponse
    {
        if ($this->authService->attemptLogin($request->validated())) {

            $user = $request->user();

            $token = $this->tokenService->generateToken($user);

            return new TokenResource($token);
        }

        return response()->json(['message' => 'Credenciais inválidas'], 401);
    }

    public function refreshToken(Request $request): JsonResource
    {
        $user = $request->user();

        $token = $this->tokenService->refreshToken($user);

        return new TokenResource($token);
    }
}
