<?php

namespace App\Repository\Antecedente;

use App\Models\Antecedente;
use Illuminate\Database\Eloquent\Model;

interface AntecedenteRepositoryInterface
{
	public function getAllModels(int $id);
	public function StoreAntecedente($request);
}