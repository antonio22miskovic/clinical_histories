<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Medical_treatment extends JsonResource
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
            
            'description' => $this->description,
            'medicine'    => $this->medicine,
            'diagnosi'    => $this->diagnosi_id,
            'disease'     => $this->disease_id,

        ];
    }
}       
