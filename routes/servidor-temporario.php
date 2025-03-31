<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServidorTemporarioController;

// servidores temporarios
Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('servidores-temporarios', [ServidorTemporarioController::class, 'index'])
    ->middleware('ability:view-servidores-temporarios');

    Route::get('servidores-temporarios/{id}', [ServidorTemporarioController::class, 'show'])
    ->middleware('ability:view-servidores-temporarios');

    Route::post('servidores-temporarios', [ServidorTemporarioController::class, 'store'])
    ->middleware('ability:create-servidores-temporarios');

    Route::put('servidores-temporarios/{id}', [ServidorTemporarioController::class, 'update'])
    ->middleware('ability:update-servidores-temporarios');      

});