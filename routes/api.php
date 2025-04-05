<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// login
Route::post('/login', [ApiAuthController::class, 'login']);

// refresh-token
Route::post('/refresh-token', [ApiAuthController::class, 'refreshToken'])->middleware('auth:sanctum');

// unidades
require __DIR__ . '/unidades.php';

// servidor efetivo
require __DIR__ . '/servidor-efetivo.php';

// servidor temporário
require __DIR__ . '/servidor-temporario.php';

// lotacoes
require __DIR__ . '/lotacoes.php';

// fotos
require __DIR__ . '/fotos.php';
