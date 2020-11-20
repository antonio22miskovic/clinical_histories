<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical_consultation extends Model
{
    use HasFactory;
    protected $fillable = [
    	'user_id',
    	'medical_record_id',
    ];

    //relaciones
    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

    public function diagnosis()
    {
    	return $this->hasMany('App\Models\Diagnosi');
    }

    public function medical_record()
    {
    	return $this->belongsTo('App\Models\Medical_record');
    }
}
