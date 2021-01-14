<?php

namespace App\Repository\Specialist;

use App\Models\Quota;
use App\Models\Specialist;
use App\Repository\BaseRepository;
use App\Repository\Specialist\SpecialistRepositoryInterface;

class SpecialistRepository extends BaseRepository implements SpecialistRepositoryInterface
{
    protected $model = Specialist::class;

    public function getSpecialistByCreateQuota()
    {   

        $specialists = $this->model::all();
        $data = [];
        foreach ($specialists as $specialist) {
            $array = $specialist->quotas;
                if (count($array) <= 0) {
                    $data[] = $specialist;
                } 
        }
         return $data;
    }
}
