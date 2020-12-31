<?php

namespace App\Http\Controllers\Api\Disease;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiseaseRequest;
use App\Http\Resources\Disease as DiseaseResource;
use App\Http\Resources\DiseaseCollection;
use App\Repository\Disease\DiseaseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiseaseController extends Controller
{

	private $repository;
    private $user;

    public function __construct(DiseaseRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->middleware(['jwt.specialist']);
        $this->user = Auth::guard('api')->user();
    }

    public function index()
    {
        return response()->json(
            new DiseaseCollection($this->repository->getAll()),
            200 // state HTTP
        );
    }

    public function store(Request $request)
    {
        try {
            $disease = $this->repository->createDisease($request,$this->user);
            return response()->json(
                    $disease
             );
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function update(Request $request, int $id)
    {

        $disease = $this->repository->createOrUpdateFromRequest($id);
        return response()->json(
            [
                'message' => 'diagnostico realizado correctamente',
                'data' => new DiseaseResource($disease)
            ],
            200 // state HTTP
        );
    }

    public function show($id)
    {
        return response()->json(
            new DiseaseResource($this->repository->findOneByPrimary($id)),
            200 // state HTTP
        );
    }

    public function destroy($id)
    {
        $disease = $this->repository->deleteByPrimary($id);
        return response()->json(
            [
                'message' => 'el diagnostico fue eliminado correctamente'],
                200
        );
    }
}
