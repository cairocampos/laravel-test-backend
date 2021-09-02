<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Imovel;
use Illuminate\Http\Request;

class InitController extends Controller
{
    public function index()
    {
        return [
            (new Contrato())->getTable() => [
                'tipo_pessoas' => [
                    Contrato::TIPO_PESSOA_FISICA,
                    Contrato::TIPO_PESSOA_JURIDICA,
                ]
            ],
            (new Imovel())->getTable() => [
                'status' => Imovel::STATUS
            ]
        ];
    }
}
