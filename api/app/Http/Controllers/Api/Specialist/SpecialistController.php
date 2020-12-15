<?php

namespace App\Http\Controllers\Api\Specialist;

use App\Http\Controllers\Controller;
use App\Http\Resources\Quota as QuotaResource;
use App\Http\Resources\Specialist as SpecialistResource;
use App\Http\Resources\SpecialistCollection;
use App\Http\Resources\Waiting_listCollection;
use App\Models\Quota;
use App\Repository\Specialist\SpecialistRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpecialistController extends Controller
{
	private $repository;
    private $user;

    public function __construct(SpecialistRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['jwt.specialist']);
        $this->user = Auth::guard('api')->user();
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

        $quotaToday = Quota::where('specialist_id',$this->user->specialist->id)
                            ->where('date', Carbon::now()->toDateString())
                            ->first();
        return response()->json(
            [
                'specialist'   => new SpecialistResource($this->user->specialist),
                'quota'        => new QuotaResource($quotaToday)
            ],
            200
        );

    }
}
