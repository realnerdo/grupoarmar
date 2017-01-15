<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'phone' => 'required',
            'email' => 'required|email',
            'company' => 'required',
            'trade_name' => 'required',
            'rfc' => 'required',
            'address' => 'required',
            'zipcode' => 'required'
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
            'phone.required' => 'No has escrito un teléfono',
            'email.required' => 'No has escrito un correo electrónico',
            'email.email' => 'No has escrito un correo electrónico válido',
            'company.required' => 'No has escrito una empresa',
            'trade_name.required' => 'No has escrito un nombre comercial',
            'rfc.required' => 'No has escrito un R.F.C.',
            'address.required' => 'No has escrito una dirección',
            'zipcode.required' => 'No has escrito un código postal'
        ];
    }
}
