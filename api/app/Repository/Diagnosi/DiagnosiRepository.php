<?php

namespace App\Repository\Diagnosi;

use App\Models\Diagnosi;
use App\Repository\BaseRepository;
use App\Repository\Diagnosi\DiagnosiRepositoryInterface;

class DiagnosiRepository extends BaseRepository implements DiagnosiRepositoryInterface
{
    protected $model = Diagnosi::class;
}
