<?php

namespace App\Repository\Specialist;

use App\Models\Specialist;

interface SpecialistRepositoryInterface
{
    public function getSpecialistByCreateQuota();
}