<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class HistorialRequest extends Request
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
          /*'dni' => 'required',
          'fechaHistorial' => 'required',
          'tiempoEnfermedad' => 'required',
          'formaInicio' => 'required',
          'curso' => 'required',
          'signos' => 'required',
          'relato' => 'required',
          'examenfisico' => 'required',
          'diagnostico' => 'required',
          'tratamiento' => 'required',     */     
      ];
    }
}
