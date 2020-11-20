<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasFactory;

    protected $fillable = [

    	'name',
    	'description'

    ];

    //relaciones
    public function quotas()
    {
    	return $this->hasMany('App\Models\Quota');
    }

    public function diseases()
    {
    	return $this->hasMany('App\Models\Disease');
    }

    public function users()
    {
    	return $this->belongsToMany('App\Models\User');
    }

}
