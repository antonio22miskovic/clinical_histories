<?php

namespace App\Repository\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getAllModels();
    public function getDataUserAuth(int $id);
    public function UpdateBySpecialistUser($data);
    public function showByPatientsByIdUser(int $id);
}