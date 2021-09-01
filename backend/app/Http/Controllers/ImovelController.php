<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateImovelRequest;
use App\Repositories\ImovelRepository;
use Illuminate\Http\Request;

class ImovelController extends Controller
{
    private $repository;

    public function __construct(ImovelRepository $repo)
    {
        $this->repository = $repo;
    }
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->repository->list($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateImovelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateImovelRequest $request)
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
        $response = $this->repository->show($id);
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->repository->delete($id);
        return $response;
    }
}
