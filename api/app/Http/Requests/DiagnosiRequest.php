<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiagnosiRequest extends FormRequest
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

            'medical_consultation_id'  => 'required',

        ];
    }

     public function messages()
    {

        return [

            'medical_consultation_id.required'  => 'debe vincularse a una consulta medica',

        ];

    }


}
