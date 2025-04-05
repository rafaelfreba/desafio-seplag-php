<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FotoPessoaController;

// fotos
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/upload/{id}/foto', [FotoPessoaController::class, 'upload'])
    ->middleware('ability:upload-fotos');

    Route::get('/pessoa/{id}/foto', [FotoPessoaController::class, 'getFoto'])
    ->middleware('ability:view-fotos');
});
