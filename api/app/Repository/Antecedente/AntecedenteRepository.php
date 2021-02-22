<?php

namespace App\Repository\Antecedente;

use App\Models\Antecedente;
use App\Repository\BaseRepository;
use App\Repository\Antecedente\AntecedenteRepositoryInterface;

class AntecedenteRepository extends BaseRepository implements AntecedenteRepositoryInterface
{
    protected $model = Antecedente::class;

     public function getAllModels($id) //paginación con repository
    {
        return  $this->model->where('patient_id',$id)
                ->paginate($this->request->query('per_page', 10));

    }

    public function StoreAntecedente($request)
    {
        try {

        	foreach ($request['array'] as $value) {

            	$this->model::create([
                    'name'  => $value['name'],
                    'description' => $value['description'],
                    'patient_id'  => $request['patient']
                ]);

        	}
            return true;

        } catch (Exception $e) {

            return false;
        }

    }
}