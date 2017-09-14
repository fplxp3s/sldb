<?php

namespace sldb\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LojaRequest extends FormRequest
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
            'razao_social' => 'required|string|max:60',
            'nome_fantasia' => 'required|string|max:60',
            'nome_representante' => 'required|string|max:60',
            'cpf_representante' => 'required|string|max:15',
            'cnpj' => 'required|string|max:21',
            'cidade' => 'required|string',
            'estado' => 'required|string',
            'bairro' => 'required|string',
            'endereco' => 'required|string',
            'telefone' => 'required|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [

        ];
    }
}
