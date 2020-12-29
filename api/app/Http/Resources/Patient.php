<?php

namespace App\Http\Resources;

use App\Http\Resources\Medical_record as Medical_recordResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Patient extends JsonResource
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

            'id'             => $this->id,
            'sex'            => $this->sex,
            'first_name'     => $this->first_name,
            'last_name'      => $this->last_name,
            'phone'          => $this->phone,
            'ci'             => $this->ci,
            'civil_status'   => $this->civil_status,
            'birthdate'      => $this->birthdate,
            'weight'         => $this->weight,
            // relaciones
            'medical_record' => new Medical_recordResource($this->medical_record)
        ];
    }
}
