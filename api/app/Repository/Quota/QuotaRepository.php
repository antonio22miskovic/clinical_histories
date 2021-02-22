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

    public function getAllModels()
    {
        return $this->model::orderBy('date', 'desc')->paginate($this->request->query('per_page', 10));
    }

    public function GetUserQuotas($id){
        $user = User::find($id)->specialists;
    	return response()->json($user);
    }

    public function UpdateQuota($request){
         $quota = $this->model::find($request['id']);
         $quota->quota = intval($request['quota']);
         $quota->save();
        return $quota;
    }

}
