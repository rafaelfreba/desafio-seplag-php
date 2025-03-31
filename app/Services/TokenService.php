<?php

namespace App\Services;

use App\Models\User;
use Laravel\Sanctum\NewAccessToken;

class TokenService
{
    public function generateToken(User $user): NewAccessToken
    {
        $abilities = $user->is_admin ? ['*'] : [
            'view-unidades',
            'view-servidores-temporarios',
            'view-servidores-efetivos',
            'view-lotacoes'
        ];
        // $expiration = now()->addMinutes(5);

        // return $user->createToken('auth-token', $abilities, $expiration);
        return $user->createToken('auth-token', $abilities);
    }

    public function refreshToken(User $user): NewAccessToken
    {
        $user->currentAccessToken()->delete();
        return $this->generateToken($user);
    }
}
