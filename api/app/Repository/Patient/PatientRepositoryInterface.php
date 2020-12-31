<?php

namespace App\Repository\Patient;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;

interface PatientRepositoryInterface
{
    public function getAllModels($user);
     public function storePatientMedicalRecord($values, $user);
}