<?php

namespace App\Repository\Disease;

use App\Models\Disease;
use Illuminate\Database\Eloquent\Model;

interface DiseaseRepositoryInterface
{
	public function createDisease($request,$user);
}