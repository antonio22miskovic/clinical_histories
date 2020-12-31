<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosi extends Model
{
    use HasFactory;
    protected $fillable = ['medical_consultation_id'];

    // relaciones
    public function diseases()
    {
    	return $this->hasMany('App\Models\Disease');
    }

     public function medical_consultation()
    {
    	return $this->belongsTo('App\Models\Medical_consultation');
    }

     public function medical_treatments()
    {
    	return $this->hasMany('App\Models\Medical_treatment');
    }
}
