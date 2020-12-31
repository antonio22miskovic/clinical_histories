<?php

namespace App\Repository\Disease;

use App\Models\Diagnosi;
use App\Models\Disease;
use App\Models\Medical_treatment;
use App\Repository\BaseRepository;
use App\Repository\Disease\DiseaseRepositoryInterface;

class DiseaseRepository extends BaseRepository implements DiseaseRepositoryInterface
{
    protected $model = Disease::class;

    public function createDisease($request,$user)
    {

        $diagnosi = Diagnosi::create([
            'medical_consultation_id' => $request['consulta']
        ]);// la creacion del diagnostico
        $push = [];
        foreach ($request['array'] as $item) {
        	$disease = $this->model->create([
            	'name'          => $item['name'],
            	'description'   => $item['description'],
            	'specialist_id' => $user->specialist->id,
            	'diagnosi_id'   => $diagnosi->id
        	]);
            $tratamiento = Medical_treatment::create([

                'description' => $item['descriptionMedicina'],
                'medicine'    => $item['medicina'],
                'disease_id'  => $disease->id,
            ]);
            $data = [];
            $data['disease'] = $disease;
            $data['tratamiento'] = $tratamiento;
            $push[] = $data;
        }
    	return $push;
    }

}
