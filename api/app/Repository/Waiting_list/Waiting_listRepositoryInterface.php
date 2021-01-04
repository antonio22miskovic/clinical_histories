<?php

namespace App\Repository\Waiting_list;

use App\Models\Waiting_list;

interface Waiting_listRepositoryInterface
{

    public function getAllModels(int $user);

    public function filterPatient(int $ci);

    public function deleteByCi($ci);

}