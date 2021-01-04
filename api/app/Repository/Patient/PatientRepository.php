<?php
namespace App\Repository\Patient;

use App\Models\Medical_consultation;
use App\Models\Medical_record;
use App\Models\Patient;
use App\Repository\BaseRepository;
use App\Repository\Patient\PatientRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class PatientRepository extends BaseRepository implements PatientRepositoryInterface
{
    protected $model = Patient::class;

    public function getAllModels($user) //paginación con repository
    {
        return  $this->model
                    ->join('medical_records', 'patients.id', '=' ,'medical_records.patient_id')
                    ->join('medical_consultations', 'medical_records.id', '=' ,'medical_consultations.medical_record_id')
                    ->where('medical_consultations.user_id', $user->id)
                    ->select('patients.*')
                    ->paginate($this->request->query('per_page', 10));
    }

    public function storePatientMedicalRecord($value, $user)
    {
        $record = Medical_record::create([
            'patient_id' => $value->id
        ]);

        $consulta = Medical_consultation::create([
                'user_id' => $user->id,
                'medical_record_id' => $record->id,
        ]);

        return
                [
                    'record'   =>  $record,
                    'consulta' =>  $consulta
                ];
    }

}