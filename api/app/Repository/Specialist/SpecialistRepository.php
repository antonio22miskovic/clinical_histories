<?php

namespace App\Repository\Specialist;

use App\Models\Specialist;
use App\Repository\BaseRepository;
use App\Repository\Specialist\SpecialistRepositoryInterface;

class SpecialistRepository extends BaseRepository implements SpecialistRepositoryInterface
{
    protected $model = Specialist::class;
}
