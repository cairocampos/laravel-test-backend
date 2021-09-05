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
        'cep',
        'rua',
        'bairro',
        'numero',
        'complemento',
        'cidade',
        'estado',
        'cor',
        'total_divisoes'
    ];

    protected $attributes = [
        'status' => 0
    ];

    const STATUS_DISPONIVEL = 0;
    const STATUS_CONTRATADO = 1;

    const STATUS = [
        'disponivel' => self::STATUS_DISPONIVEL,
        'contratado' => self::STATUS_CONTRATADO,
    ];

    const ORDER_BY = ['email_proprietario', 'status'];

    public function contrato()
    {
        return $this->hasOne(Contrato::class);
    }
}
