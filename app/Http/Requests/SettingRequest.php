<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'title' => 'required',
            'owner' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required'
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
            'title.required' => 'No has escrito un título',
            'owner.required' => 'No has escrito un propietario',
            'email.required' => 'No has escrito un correo electrónico',
            'email.email' => 'No has escrito un correo electrónico vlálido',
            'phone.required' => 'No has escrito un teléfono',
            'address.required' => 'No has escrito una dirección'
        ];
    }
}
