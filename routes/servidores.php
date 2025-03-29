<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EfetivoServidorController;
use App\Http\Controllers\ServidorTemporarioController;

// servidores efetivos
Route::middleware('auth:sanctum')->group(function () {

    Route::get('servidores-efetivos', [EfetivoServidorController::class, 'index'])->middleware('ability:view-servidores-efetivos');
    Route::get('servidores-efetivos/{servidorEfetivo}', [EfetivoServidorController::class, 'show'])->middleware('ability:view-servidores-efetivos');    
    Route::post('servidores-efetivos', [EfetivoServidorController::class, 'store'])->middleware('ability:create-servidores-efetivos');
    Route::put('servidores-efetivos/{servidorEfetivo}', [EfetivoServidorController::class, 'update'])->middleware('ability:update-servidores-efetivos');

});

//servidores temporários
Route::middleware('auth:sanctum')->group(function () {

    Route::get('servidores-temporarios', [ServidorTemporarioController::class, 'index'])->middleware('ability:view-servidores-temporarios');
    Route::get('servidores-temporarios/{servidorTemporario}', [ServidorTemporarioController::class, 'show'])->middleware('ability:view-servidores-temporarios');
    Route::post('servidores-temporarios', [ServidorTemporarioController::class, 'store'])->middleware('ability:create-servidores-temporarios');
    Route::put('servidores-temporarios/{servidorTemporario}', [ServidorTemporarioController::class, 'update'])->middleware('ability:update-servidores-temporarios');

});