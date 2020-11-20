<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical_record extends Model
{
    use HasFactory;
    protected $fillable =['patient_id'];

    //relaciones
    public function medical_consultations()
    {
    	return $this->hasMany('App\Models\Medical_consultation');
    }

    public function patient()
    {
    	return $this->belongsTo('App\Models\Patient');
    }

  }
