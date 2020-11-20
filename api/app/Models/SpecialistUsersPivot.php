<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialistUsersPivot extends Model
{
    use HasFactory;
    protected $table = 'specialist_user';
    protected $fillable = ['user_id', 'specialist_id'];
}
