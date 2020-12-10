<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'rol_id',
        'specialist_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     //funciones para jwt
    public  function  getJWTIdentifier() {
        return  $this->getKey();
    }
    public  function  getJWTCustomClaims() {
        return [];
    }
    // fin funciones para jwt

    // relaciones
    public function rol()
    {
        return $this->belongsTo('App\Models\Rol');
    }

    public function medical_Consultations()
    {
        return $this->hasMany('App\Models\Medical_consultation');
    }

    public function specialist()
    {
        return $this->belongsTo('App\Models\Specialist');
    }
}
