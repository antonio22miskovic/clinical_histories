<?php

namespace App\Repository\User;

use App\Models\Medical_consultation;
use App\Models\User;
use App\Repository\BaseRepository;
use App\Repository\User\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model = User::class;

    public function getAllModels(){
        return $this->model::orderByDesc('id')
                    ->where('rol_id','>', 1)
                ->paginate(
                        $this->request->query('per_page', 10)
                    );
    }

    public function getDataUserAuth($id)
    {
        $user = User::find($id);
        $user->medical_Consultations;
        $user->specialists;
        return response()->json($user);
    }

     public function UpdateBySpecialistUser($data)
     {  
        $user = $this->model::find($data['id']);
        $user->specialist_id = $data['specialist'];
        $user->save();
        return $user;
     }

     public function showByPatientsByIdUser(int $id)
     {
        return Medical_consultation::where('user_id',$id)
                ->join('medical_records', 'medical_consultations.medical_record_id', '=' ,'medical_records.id')
                ->join('patients', 'medical_records.patient_id', '=' ,'patients.id')
                ->select('patients.*')
                ->paginate($this->request->query('per_page', 10));
     }
}
