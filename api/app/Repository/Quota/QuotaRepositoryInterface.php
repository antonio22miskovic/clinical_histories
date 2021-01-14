<?php

namespace App\Repository\Quota;

use App\Models\Quota;
use Illuminate\Database\Eloquent\Model;

interface QuotaRepositoryInterface
{
    public function getAllModels();
    public function UpdateQuota($request);
}