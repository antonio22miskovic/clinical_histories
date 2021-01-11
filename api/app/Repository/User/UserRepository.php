<?php

namespace App\Repository\User;

use App\Models\User;
use App\Repository\BaseRepository;
use App\Repository\User\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model = User::class;

    public function getAllModels(){
        return $this->model::orderByDesc('id')
                ->paginate(
                        $this->request->query('per_page', 10)
                    );
    }

    public function getDataUserAuth($id)
    {
        $user = User::find($id);
        $user->medical_Consultations;
        $user->specialists;
        return response()->json($user);
    }
}
