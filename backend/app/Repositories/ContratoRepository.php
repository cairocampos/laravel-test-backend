<?php

namespace App\Repositories;

use App\Http\Resources\ContratoResource;
use App\Models\Contrato;
use App\Models\Imovel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class ContratoRepository
{
    public function create(array $params)
    {
        try {
            $imovel = Imovel::find($params['imovel_id']);

            if(optional($imovel)->contrato) {
                return response()->json([
                    'message' => 'O imovel informado já foi contratado.'
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $contrato = Contrato::create($params);
            $contrato->load('imovel');

            return response()->json([
                'message' => 'Cadastro efetuado com sucesso.',
                'data'    => new ContratoResource($contrato)
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return server_error();
        }
    }

    public function show($id)
    {
        try {
            $contrato = Contrato::findOrFail($id);

            return response([
                'data' => new ContratoResource($contrato)
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            if($e instanceof ModelNotFoundException) {
                return not_found();
            }

            return server_error();
        }
    }
}
