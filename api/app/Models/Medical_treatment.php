<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical_treatment extends Model
{
    use HasFactory;
    protected $fillable = [

    	'description',
    	'medicine',
    	'disease_id',

    ];


      public function disease()
    {
    	return $this->belongsTo('App\Models\Disease');
    }


}
