<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipmentRequest extends FormRequest
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
            'description' => 'required',
            'serial' => 'required',
            'stock' => 'required|numeric',
            'brand_id' => 'required'
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
            'description.required' => 'No has escrito una descripción',
            'serial.required' => 'No has escrito un número de serie',
            'stock.required' => 'No has escrito una cantidad',
            'brand_id.required' => 'No has seleccionado una marca'
        ];
    }
}
