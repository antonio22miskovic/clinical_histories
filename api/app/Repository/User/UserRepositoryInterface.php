<?php

namespace App\Repository\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getAllModels();
    public function getDataUserAuth(int $id);
}