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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('unidades', [UnidadeController::class, 'index'])->middleware('ability:view-unidades');
    Route::get('unidades/{unidade}', [UnidadeController::class, 'show'])->middleware('ability:view-unidades');
    Route::post('unidades', [UnidadeController::class, 'store'])->middleware('ability:create-unidades');
    Route::put('unidades/{unidade}', [UnidadeController::class, 'update'])->middleware('ability:update-unidades');
    Route::delete('unidades/{unidade}', [UnidadeController::class, 'destroy'])->middleware('ability:delete-unidades');
});
