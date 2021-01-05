<?php

namespace App\Repository\Medical_consultation;

use App\Models\Medical_consultation;
use App\Models\Patient;
use App\Repository\BaseRepository;
use App\Repository\Medical_consultation\Medical_consultationRepositoryInterface;

class Medical_consultationRepository extends BaseRepository implements Medical_consultationRepositoryInterface
{
    protected $model = Medical_consultation::class;

    public function CreateConstultation($request)
    {

    	$result = $this->model::create([
            'user_id'           => $request['user'],
            'medical_record_id' => $request['medical_record'],
         ]);

    	return $result;

    }

    public function getAllModels($id)
    {
        $patient = Patient::find($id)->medical_record;
        return $this->model::where('medical_record_id',$patient->id)->paginate($this->request->query('per_page', 10));
    }

    public function getIdConsulta($id)
    {
        $consulta = $this->model::find($id);
        $diseases = []; 
        $medical_treatments = [];
        foreach ($consulta->diagnosis as $value) {
            foreach ($value->diseases as $val) {
                $diseases[] = $val; 
                foreach ($val->medical_treatments as $va) {
                    $medical_treatments[] = $va;
                }
            }
        }
        return [ 
            'consulta' => $consulta,
            'diseases' => $diseases,
            'medicamentos' => $medical_treatments

        ];
    }

}