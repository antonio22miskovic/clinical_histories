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
    	'diagnosi_id',
    	'disease_id',

    ];

    // relaciones

    public function diagnosi()
    {
    	return $this->belongsTo('App\Models\Diagnosi');
    }

      public function disease()
    {
    	return $this->belongsTo('App\Models\Disease');
    }


}
