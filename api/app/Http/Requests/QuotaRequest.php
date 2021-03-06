<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuotaRequest extends FormRequest
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
            'quota'         => "required",
            'specialist_id' => "required",
        ];
    }

    public function messages()
    {

        return [

            'quota.required'         => 'debe asignar una quota ',
            'specialist_id.required' => 'se debe tener un especialista asignado'

        ];

    }

}
       