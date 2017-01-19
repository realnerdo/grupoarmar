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
            'equipment_detail_id' => 'required',
            'reason' => 'required',
            'description' => 'required',
            'perform_date' => 'required',
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
            'equipment_detail_id.required' => 'No has seleccionado un equipo',
            'reason.required' => 'No has escrito un motivo o causa',
            'description.required' => 'No has escrito una descripción',
            'perform_date.required' => 'No has seleccionado una fecha de realización',
            'responsible.required' => 'No has escrito un encargado de mantenimiento',
            'supplier_id.required' => 'No has seleccionado un proveedor'
        ];
    }
}
