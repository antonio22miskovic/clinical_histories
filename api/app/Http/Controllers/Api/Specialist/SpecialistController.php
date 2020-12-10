<?php

namespace App\Http\Controllers\Api\Specialist;

use App\Http\Controllers\Controller;
use App\Http\Resources\Specialist as SpecialistResource;
use App\Http\Resources\SpecialistCollection;
use App\Repository\Specialist\SpecialistRepository;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class SpecialistController extends Controller
{
	private $repository;
    private $user;

    public function __construct(SpecialistRepository $repository)
    {
        $this->repository = $repository;
        $this->user = JWTAuth::parseToken()->authenticate();
        $this->middleware(['jwt.specialist']);
    }

    public function index()
    {
        return response()->json(
            new SpecialistCollection($this->repository->getAll()),
            200 // state HTTP
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'quota' => "required",
            'specialist_id' => "required",
        ],[
            'quota.required' => 'debe asignar una quota ',
            'specialist_id.required' => 'se debe tener un especialista asignado'
        ]);
        $quota = $this->repository->createOrUpdateFromRequest();
        return response()->json(
            [
                'message' => 'quota registrada exitosamente',
                'data' => new SpecialistResource($quota)
            ],
             200 // state HTTP
         );
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'quota' => "required",
            'specialist_id' => "required",
        ],[
            'quota.required' => 'debe asignar una quota ',
            'specialist_id.required' => 'se debe tener un especialista asignado'
        ]);
        $quota = $this->repository->createOrUpdateFromRequest($id);
        return response()->json(
            [
                'message' => 'la quota se actualizo correctamente',
                'data' => new SpecialistResource($quota)
            ],
            200 // state HTTP
        );
    }

    public function show($id)
    {
        return response()->json(
            new SpecialistResource($this->repository->findOneByPrimary($id)),
            200 // state HTTP
        );
    }

    public function destroy($id)
    {
        $quota = $this->repository->deleteByPrimary($id);
        return response()->json(
            [
                'message' => 'la quota fue eliminado correctamente'],
                200
        );
    }

    public function AuthUserSpecialist(){ // return especialidad del usuario logueado

        return response()->json(
            new SpecialistResource($this->user->specialist),
            200 // state HTTP
        );
    }
}
