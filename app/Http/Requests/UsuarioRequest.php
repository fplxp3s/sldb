<?php

namespace sldb\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:tb_usuario',
            'password' => 'required|string|min:6|confirmed',
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
            'name.required' => 'O campo :attribute é obrigatório',
            'email.required' => 'O campo :attribute é obrigatório',
            'email.unique' => 'O :attribute informado já está cadastrado',
            'email.email' => 'Favor informar um email válido',
            'password.required' => 'O campo :attribute é obrigatório',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres',
            'password.confirmed' => 'As senhas digitadas são diferentes',
        ];
    }
}
