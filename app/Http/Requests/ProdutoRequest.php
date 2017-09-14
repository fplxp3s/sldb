<?php

namespace sldb\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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
            'nome' => 'required|string',
            'descricao' => 'required|string',
            'preco' => 'required|numeric|between:0,9999.99',
            'quantidade' => 'required|integer',
            'foto' => 'image|mimes:jpeg,png|max:3000',
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
            'foto.image' => 'O arquivo precisa estar no formato jpg ou png e ter no maximo 3MBs.',
        ];
    }
}
