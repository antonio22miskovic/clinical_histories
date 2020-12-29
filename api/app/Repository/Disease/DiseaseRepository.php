<?php

namespace App\Repository\Disease;

use App\Models\Disease;
use App\Repository\BaseRepository;
use App\Repository\Disease\DiseaseRepositoryInterface;

class DiseaseRepository extends BaseRepository implements DiseaseRepositoryInterface
{
    protected $model = Disease::class;
}
