<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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

            'sex'          => "required",
            'first_name'   => "required|string|min:1|max:30",
            'last_name'    => "required|string|min:1|max:30",
            'ci'           => "required|unique:patients".$this->id,
            'civil_status' => "required",
            'birthdate'    => "required",
            'weight'       => "required"
// Rule::unique('clients')->ignore($this->id)
        ];
    }

    public function messages()
    {

        return [

            'sex.required'         => 'Debe introducir un genero',
            'first_name.required'  => 'Por Favor Introduzca el Nombre',
            'first_name.string'    => 'el nombre no puede contener numeros',
            'first_name.min'       => 'en el nombre no puede contener un solo caracter',
            'first_name.max'       => 'el nombre no puede contener mas de 30 caracteres ',
            'last_name.required'   => 'Por Favor Introduzca el Apellido',
            'last_name.string'     => 'el apellido no puede contener numeros',
            'last_name.min'        => 'el apellido no puede contener un solo caracter',
            'last_name.max'        => 'el apellido no puede contener mas de 30 caracteres ',
            'ci.required'          => 'Por Favor Introduzca el numero de Cedula',
            'ci.unique'            => 'esta cedula ya se encuentra registrada por favor verifique',
            'civil_status.required'=> 'Debe Introducir el estado civil',
            'birthdate.required'   => 'Introduzca la fecha de nacimiento',
            'weight.required'      => 'introduzca el peso del paciente'

        ];

    }

}
