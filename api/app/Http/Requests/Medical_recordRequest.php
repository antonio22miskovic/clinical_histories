<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Medical_recordRequest extends FormRequest
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

            'patient_id' => 'required'

        ];
    }

    public function messages()
    {

        return [

           'patient_id.required' => 'la historia clinica debe estar vicnulado a un solo paciente'

        ];

    }

}
