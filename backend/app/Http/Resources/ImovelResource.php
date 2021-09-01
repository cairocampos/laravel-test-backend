<?php

namespace App\Http\Resources;

use App\Repositories\ImovelRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class ImovelResource extends JsonResource
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
            'status_label' => ImovelRepository::STATUS[$this->status]
        ]+parent::toArray($request);
    }
}
