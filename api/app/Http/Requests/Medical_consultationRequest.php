<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Medical_consultationRequest extends FormRequest
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

            'medical_record_id' => 'required',

        ];
    }

    public function messages()
    {

        return [

            'medical_record_id.required' => 'debe estar vinculado a una historia medica',

        ];

    }

}
