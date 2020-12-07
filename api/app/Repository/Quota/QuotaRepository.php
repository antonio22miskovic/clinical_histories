<?php

namespace App\Repository\Quota;

use App\Models\Quota;
use App\Repository\BaseRepository;
use App\Repository\Quota\QuotaRepositoryInterface;

class QuotaRepository extends BaseRepository implements QuotaRepositoryInterface
{
    protected $model = Quota::class;
}
