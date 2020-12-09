<?php

namespace App\Repository\Quota;

use App\Models\Quota;
use App\Repository\BaseRepository;
use App\Repository\Quota\QuotaRepositoryInterface;
use Tymon\JWTAuth\JWT;

class QuotaRepository extends BaseRepository implements QuotaRepositoryInterface
{
    protected $model = Quota::class;
    // protected $user =  Auth::user();

    // public function GetUserQuotas(){
    // 	return response()->json($this->user);
    // }
}
