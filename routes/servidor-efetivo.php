<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServidorEfetivoController;

// servidores efetivos
Route::middleware('auth:sanctum')->group(function () {

    Route::get('servidores-efetivos', [ServidorEfetivoController::class, 'index'])
    ->middleware('ability:view-servidores-efetivos');

    Route::get('servidores-efetivos/{id}', [ServidorEfetivoController::class, 'show'])
    ->middleware('ability:view-servidores-efetivos');

    Route::post('servidores-efetivos', [ServidorEfetivoController::class, 'store'])
    ->middleware('ability:create-servidores-efetivos');

    Route::put('servidores-efetivos/{id}', [ServidorEfetivoController::class, 'update'])
    ->middleware('ability:update-servidores-efetivos');

});
