<?php

namespace App\Http\Requests;

use App\Models\Contrato;
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
        $rules = [
            'imovel_id'         => 'required|exists:imoveis,id',
            'tipo_pessoa'       => ['required', Rule::in([
                Contrato::TIPO_PESSOA_FISICA,
                Contrato::TIPO_PESSOA_JURIDICA
            ])],
            'nome_contratante'  => 'required|string',
            'email_contratante' => 'required|email',
            'cpf_cnpj'          => ['required'],
        ];

        if(request('tipo_pessoa') == 'pf')
            $rules['cpf_cnpj'][] = 'regex:/^([0-9]{11})$/';
        elseif(request('tipo_pessoa') == 'pj')
            $rules['cpf_cnpj'][] = 'regex:/^([0-9]{14})$/';

        return $rules;
    }

    public function prepareForValidation()
    {
        $documento = preg_replace('/\D/', '', $this->cpf_cnpj);
        $this->merge([
            'cpf_cnpj'   => $documento,
            'tipo_pessoa' => strtolower($this->tipo_pessoa)
        ]);
    }

    public function messages() {
        return [
            'id_imovel.required' => 'É necessário informar um imovel.',
        ];
    }
}
