<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;

    protected $fillable = [
    	'name',
    	'description',
    	'specialist_id',
    ];

    //relaciones
    public function diagnosis()
    {
    	return $this->belongsToMany('App\Models\Diagnosi');
    }

     public function specialist()
    {
    	return $this->belongsTo('App\Models\Specialist');
    }

    public function medical_treatments()
    {
    	return $this->hasMany('App\Models\Medical_treatment');
    }

}
