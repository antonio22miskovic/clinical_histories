<?php

namespace App\Repository\Medical_treatment;

use App\Models\Medical_treatment;
use App\Repository\BaseRepository;
use App\Repository\Medical_treatment\Medical_treatmentRepositoryInterface;

class Medical_treatmentRepository extends BaseRepository implements Medical_treatmentRepositoryInterface
{
    protected $model = Medical_treatment::class;


}
