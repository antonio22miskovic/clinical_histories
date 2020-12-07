<?php

namespace App\Http\Controllers\api\Quota;

use App\Http\Controllers\Controller;
use App\Http\Resources\Quota as QuotaResource;
use App\Http\Resources\QuotaCollection;
use App\Repository\Quota\QuotaRepositoryInterface;
use Illuminate\Http\Request;

class QuotaController extends Controller
{
	private $repository;

    public function __construct(QuotaRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return response()->json(
            new QuotaCollection($this->repository->getAll()),
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
                'data' => new QuotaResource($quota)
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
                'data' => new QuotaResource($quota)
            ],
            200 // state HTTP
        );
    }

    public function show($id)
    {
        return response()->json(
            new QuotaResource($this->repository->findOneByPrimary($id)),
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

}
