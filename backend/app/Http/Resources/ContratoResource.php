<?php

namespace App\Http\Resources;

use App\Models\Imovel;
use Illuminate\Http\Resources\Json\JsonResource;

class ContratoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'imovel' => [
                'status_label' => Imovel::STATUS[$this->imovel->status],
                'rua' => $this->imovel->rua,
                'numero' => $this->imovel->numero,
                'complemento' => $this->imovel->complemento,
                'bairro' => $this->imovel->bairro,
                'cidade' => $this->imovel->cidade,
                'estado' => $this->imovel->estado,
            ]
        ]+parent::toArray($request);
    }
}
