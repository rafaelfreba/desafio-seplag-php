<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->plainTextToken,
            'token_type' => 'Bearer',
            'expires_in' => 300,
            'expires_at' => $this->accessToken->expires_at,
            'abilities' => $this->accessToken->abilities
        ];
    }
}
