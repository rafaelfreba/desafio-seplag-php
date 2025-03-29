<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function attemptLogin(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }
}