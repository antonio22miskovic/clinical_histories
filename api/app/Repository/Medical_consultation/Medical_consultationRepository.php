<?php

namespace App\Repository\Medical_consultation;

use App\Models\Medical_consultation;
use App\Repository\BaseRepository;
use App\Repository\Medical_consultation\Medical_consultationRepositoryInterface;

class Medical_consultationRepository extends BaseRepository implements Medical_consultationRepositoryInterface
{
    protected $model = Medical_consultation::class;

    public function CreateConstultation($request){

    	$result = $this->model::create([
            'user_id'           => $request['user'],
            'medical_record_id' => $request['medical_record'],
         ]);

    	return $result;

    }

}