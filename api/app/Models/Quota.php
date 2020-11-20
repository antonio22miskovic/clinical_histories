<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quota extends Model
{
    use HasFactory;

    protected $fillable = [

    	'quota',
    	'specialist_id',
    	'date'

    ];

    //relaciones
    public function specialist()
    {
    	return $this->belongsTo('App\Models\Specialist');
    }

     public function waiting_lists()
    {
    	return $this->hasMany('App\Models\Waiting_list');
    }

}
