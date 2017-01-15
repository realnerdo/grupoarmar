<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ];
    }

    /**
     * Custom validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'No has escrito un nombre',
            'username.required' => 'No has escrito un usuario',
            'username.unique' => 'Ese nombre de usuario ya existe',
            'email.required' => 'No has escrito un correo electrónico',
            'email.email' => 'No has escrito un correo electrónico válido',
            'email.unique' => 'Ese correo electrónico ya existe',
            'password.required' => 'No has escrito una contraseña',
            'password.confirmed' => 'Las contrasñeas no coinciden'
        ];
    }
}
