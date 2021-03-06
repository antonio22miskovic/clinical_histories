<?php

namespace App\Http\Resources;

use App\Http\Resources\Specialist as SpecialistResourse;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'id'     => $this->id,
            'name'   => $this->name,
            'email'  => $this->email,
            'avatar' => $this->avatar,
            'rol'    => $this->rol_id,
            // 'specialist' => $this->specialist_id,
            'specialist' => new SpecialistResourse($this->specialist) 
        ];
    }
}
