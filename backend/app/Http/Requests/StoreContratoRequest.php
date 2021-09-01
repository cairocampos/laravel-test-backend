<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContratoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'imovel_id'         => 'required|exists:imoveis,id',
            'tipo_pessoa'       => 'required|in:pf,pj',
            'nome_contratante'  => 'required|string',
            'email_contratante' => 'required|email',
            'documento'         => 'required'
        ];
    }

    public function prepareForValidation()
    {
        $documento = preg_replace("/([^(0-9)])/", "", $this->documento);
        $this->merge([
            'documento' => $documento
        ]);
    }

    public function messages() {
        return [
            'id_imovel.required' => 'É necessário informar um imovel.',
        ];
    }
}
