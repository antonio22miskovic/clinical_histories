<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waiting_list extends Model
{
    use HasFactory;
    protected $fillable =[

    	'identification_card',
    	'quota_id'

    ];

    //relaciones
     public function quota()
    {
    	return $this->belongsTo('App\Models\Quota');
    }
}
