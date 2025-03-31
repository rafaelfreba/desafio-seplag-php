<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LotacaoController;

// lotacoes
Route::middleware('auth:sanctum')->group(function () {

    Route::get('lotacoes', [LotacaoController::class, 'index'])
    ->middleware('ability:view-lotacoes');

    Route::get('lotacoes/{lotacao}', [LotacaoController::class, 'show'])
    ->middleware('ability:view-lotacoes');

    Route::post('lotacoes', [LotacaoController::class, 'store'])
    ->middleware('ability:create-lotacoes');

    Route::put('lotacoes/{lotacao}', [LotacaoController::class, 'update'])
    ->middleware('ability:update-lotacoes');

});