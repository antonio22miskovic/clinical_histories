<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosiDiseasesPivot extends Model
{
    use HasFactory;
    protected $table = 'diagnosi_disease';
    protected $fillable = ['diagnosi_id','disease_id'];
}
