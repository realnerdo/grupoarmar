<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaintenanceRequest extends FormRequest
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
            'reason' => 'required',
            'description' => 'required',
            'perform_date' => 'required',
            'place' => 'required',
            'responsible' => 'required',
            'supplier_id' => 'required'
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
            'reason.required' => 'No has escrito un motivo o causa',
            'description.required' => 'No has escrito una descripción',
            'perform_date.required' => 'No has seleccionado una fecha de realización',
            'place.required' => 'No has escrito un lugar de mantenimiento',
            'responsible.required' => 'No has escrito un encargado de mantenimiento',
            'supplier_id.required' => 'No has seleccionado un proveedor'
        ];
    }
}
