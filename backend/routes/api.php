<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    ContratoController,
    ImovelController,
    InitController
};


Route::get('/', [InitController::class, 'index']);

Route::apiResource('imoveis', ImovelController::class);
Route::apiResource('contratos', ContratoController::class)->only(['show','store']);
