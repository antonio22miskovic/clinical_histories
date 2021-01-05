<?php

namespace App\Repository\Medical_consultation;

use App\Models\Medical_consultation;
use Illuminate\Database\Eloquent\Model;

interface Medical_consultationRepositoryInterface
{
	public function CreateConstultation($request);

    public function getAllModels($id);

    public function getIdConsulta($id);
}