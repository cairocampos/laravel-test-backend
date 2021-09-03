<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    InitController,
    ContratoController,
    ImovelController,
    CepController,
};


Route::get('/', [InitController::class, 'index']);

Route::apiResource('imoveis', ImovelController::class);
Route::apiResource('contratos', ContratoController::class)->only(['show','store']);
Route::apiResource('cep', CepController::class)->only(['index']);
