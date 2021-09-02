<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateImovelRequest extends FormRequest
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
            'email_proprietario' => 'required|email',
            'cep'                => 'required|regex:/^([0-9]{8})$/',
            'rua'                => 'required|string',
            'complemento'        => 'nullable|string',
            'numero'             => 'required|string',
            'bairro'             => 'required|string',
            'cidade'             => 'required|string',
            'estado'             => 'required|string',
            'cor'                => 'nullable|string',
            'total_divisoes'     => 'required|integer'
        ];
    }

    public function prepareForValidation()
    {
        return [
            'cep' => preg_replace('/\D/', '', $this->cep)
        ];
    }
}
