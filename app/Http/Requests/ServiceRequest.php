<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'event' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'client_id' => 'required'
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
            'event.required' => 'No has escrito un evento',
            'date_start.required' => 'No has seleccionado una fecha de inicio',
            'event.required' => 'No has seleccionado una fecha de terminación',
            'client_id' => 'No has seleccionado un cliente'
        ];
    }
}
