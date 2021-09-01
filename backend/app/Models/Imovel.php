<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imovel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "imoveis";

    protected $fillable = [
        'email_proprietario',
        'rua',
        'bairro',
        'numero',
        'complemento',
        'cidade',
        'estado',
        'cor',
        'numero',
        'total_divisoes'
    ];

    protected $attributes = [
        'status' => 0
    ];

    public function contrato()
    {
        return $this->hasOne(Contrato::class);
    }
}