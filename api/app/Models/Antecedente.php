<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antecedente extends Model
{
    use HasFactory;
    protected $fillable = [  'name' , 'description', 'patient_id' ];

    // relaciones


}
