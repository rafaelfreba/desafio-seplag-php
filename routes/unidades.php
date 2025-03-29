<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnidadeController;

// unidades
Route::middleware('auth:sanctum')->group(function () {

    Route::get('unidades', [UnidadeController::class, 'index'])->middleware('ability:view-unidades');
    Route::get('unidades/{unidade}', [UnidadeController::class, 'show'])->middleware('ability:view-unidades');
    Route::post('unidades', [UnidadeController::class, 'store'])->middleware('ability:create-unidades');
    Route::put('unidades/{unidade}', [UnidadeController::class, 'update'])->middleware('ability:update-unidades');

});