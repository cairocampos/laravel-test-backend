<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_pessoa',
        'documento',
        'email_contratante',
        'nome_contratante',
        'imovel_id'
    ];

    public function imovel()
    {
        return $this->belongsTo(Imovel::class);
    }

    public function setDocumentoAttribute($value)
    {
        $documento = preg_replace("/([^(0-9)])/", "", $value);

        $this->attributes['documento'] = $documento;
    }
}
