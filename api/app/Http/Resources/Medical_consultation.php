<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Medical_consultation extends JsonResource
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

            'id'                => $this->id,
            'user'              => $this->user_id,
            'medical_record'    => $this->medical_record_id,
            'fecha'             => Carbon::parse($this->created_at)->format('Y-m-d')

        ];
    }
}
