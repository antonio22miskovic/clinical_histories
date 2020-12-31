<?php

namespace App\Repository\Medical_record;

use App\Models\Medical_record;
use App\Repository\BaseRepository;
use App\Repository\Medical_record\Medical_recordRepositoryInterface;

class Medical_recordRepository extends BaseRepository implements Medical_recordRepositoryInterface
{
    protected $model = Medical_record::class;

    public function showMedicalRecordPatient($id)
    {
    	$result = $this->model->where('patient_id', $id)->first();
    	if (is_null($result)) {
    		return response()->json(null);
    	}
    	return $result;
    }
}
