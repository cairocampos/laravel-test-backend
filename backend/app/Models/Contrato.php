<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_pessoa',
        'cpf_cnpj',
        'email_contratante',
        'nome_contratante',
        'imovel_id'
    ];

    const TIPO_PESSOA_FISICA = 'pf';
    const TIPO_PESSOA_JURIDICA = 'pj';

    public function imovel()
    {
        return $this->belongsTo(Imovel::class);
    }

    public function setCpfCnpjAttribute($value)
    {
        $documento = preg_replace('/\D/', '', $value);

        $this->attributes['cpf_cnpj'] = $documento;
    }
}
