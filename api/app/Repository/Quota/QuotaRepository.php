<?php

namespace App\Repository\Quota;

use App\Models\Quota;
use App\Repository\BaseRepository;
use App\Repository\Quota\QuotaRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class QuotaRepository extends BaseRepository implements QuotaRepositoryInterface
{
    protected $model = Quota::class;

    public function GetUserQuotas($id){
        $user = User::find($id)->specialists;
    	return response()->json($user);
    }
}
