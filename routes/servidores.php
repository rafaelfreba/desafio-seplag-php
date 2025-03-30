<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServidorController;

Route::middleware('auth:sanctum')->group(function () {

    Route::get('servidores/efetivos/{unid_id?}', [ServidorController::class, 'index'])
    ->middleware('ability:view-servidores')->name('efetivos');
    
    Route::get('servidores/efetivo/{servidor}', [ServidorController::class, 'show'])
    ->middleware('ability:view-servidores')->name('efetivo');    
    
    Route::get('servidores/temporarios/{unid_id?}', [ServidorController::class, 'index'])
    ->middleware('ability:view-servidores')->name('temporarios');
    
    Route::get('servidores/temporario/{servidor}', [ServidorController::class, 'show'])
    ->middleware('ability:view-servidores')->name('temporario');    

    Route::post('servidores', [ServidorController::class, 'store'])
    ->middleware('ability:create-servidores');

    Route::put('servidores/{servidor}', [ServidorController::class, 'update'])
    ->middleware('ability:update-servidores');

});