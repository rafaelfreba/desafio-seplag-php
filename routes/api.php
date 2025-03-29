<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\UnidadeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [ApiAuthController::class, 'login']);

Route::post('/refresh-token', [ApiAuthController::class, 'refreshToken'])->middleware('auth:sanctum');

// unidades
require __DIR__ . '/unidades.php';

// servidores
require __DIR__ . '/servidores.php';
