<?php

namespace App\Http\Controllers;

use App\Http\Requests\CepRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CepController extends Controller
{
    public function index(CepRequest $request)
    {
        $cep = $request->cep;
        $response =  Http::get("https://viacep.com.br/ws/$cep/json/");
        return $response->json();
    }
}
