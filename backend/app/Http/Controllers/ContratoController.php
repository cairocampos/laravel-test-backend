<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContratoRequest;
use App\Repositories\ContratoRepository;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    private $repository;

    public function __construct(ContratoRepository $repo)
    {
        $this->repository = $repo;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContratoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContratoRequest $request)
    {
        $response = $this->repository->create($request->validated());
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
