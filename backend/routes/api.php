<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    ContratoController,
    ImovelController
};


Route::apiResource('imoveis', ImovelController::class);
Route::apiResource('contratos', ContratoController::class)->only(['show','store']);