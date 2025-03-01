<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CepRequest extends FormRequest
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
            'cep' => 'required|regex:/^([0-9]{8})$/'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'cep' => preg_replace('/\D/', '', $this->cep)
        ]);
    }
}
