<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Diagnosi extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'medical_consultation' => $this->medical_consultation_id,
            'hospitalization'      => $this->hospitalization
        ];
    }
}
