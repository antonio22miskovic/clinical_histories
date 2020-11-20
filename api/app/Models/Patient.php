<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [

    	'sex',
    	'first_name',
    	'last_name',
        'phone',
    	'ci',
    	'civil_status',
    	'birthdate',
    	'weight'

    ];

    // relaciones

    public function medical_record()
    {
        return $this->hasOne('App\Models\Medical_record');
    }

}
