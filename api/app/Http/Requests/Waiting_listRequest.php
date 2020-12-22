<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Waiting_listRequest extends FormRequest
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

            'identification_card' => "required",

        ];

    }

    public function messages()
    {
        return [

            'identification_card.required' => ' debe introducir su numero de cedula'

        ];

    }
}
