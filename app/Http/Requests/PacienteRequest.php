<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PacienteRequest extends Request
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
            'nombres' => 'required|min:2|max:30',
            'apPaterno' => 'required',
            'apMaterno' => 'required',
            'dni' => 'required|unique:pacientes|min:8|max:8',
            'direccion' => 'required',
            'telefono' => '',
            'edad' => 'required|between:1,120',
            'sexo' => 'required',
        ];
    }
}
