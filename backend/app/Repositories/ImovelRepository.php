<?php

namespace App\Repositories;

use App\Http\Resources\ImovelResource;
use App\Models\Imovel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ImovelRepository
{
    const STATUS_DISPONIVEL = 0;
    const STATUS_CONTRATADO = 1;

    const STATUS = [
        self::STATUS_DISPONIVEL => 'Disponível',
        self::STATUS_CONTRATADO => 'Contratado',
    ];

    const ORDER_BY = ['email_proprietario', 'cidade'];


    public function list(Request $request)
    {
        $orderBy = in_array($request->orderBy, self::ORDER_BY) ? $request->orderBy : null;
        $sortedBy = in_array($request->sortedBy, ['asc', 'desc']) ? $request->sortedBy : "desc";

        $imoveis = Imovel::when($orderBy, function ($query, $orderBy) use ($sortedBy) {
            return $query->orderBy($orderBy, $sortedBy);
        })->paginate();

        return ImovelResource::collection($imoveis);
    }

    public function create(array $params)
    {
        try {
            $imovel = Imovel::create($params);

            return response()->json([
                'message' => 'Cadastro efetuado com sucesso.',
                'data'    => new ImovelResource($imovel)
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return server_error();
        }
    }

    public function show($id)
    {
        try {
            $imovel = Imovel::findOrFail($id);

            return response([
                'data' => new ImovelResource($imovel)
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            if($e instanceof ModelNotFoundException) {
                return not_found();
            }

            return server_error();
        }
    }

    public function delete($id)
    {
        try {
            $imovel = Imovel::findOrFail($id);
            $imovel->delete();

            return response([
                'message' => 'Registro removido com sucesso.'
            ], Response::HTTP_OK);

        } catch (\Exception $e) {
            if($e instanceof ModelNotFoundException) {
                return not_found();
            }

            return server_error();
        }
    }
}