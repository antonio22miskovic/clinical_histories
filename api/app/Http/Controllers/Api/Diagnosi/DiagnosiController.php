<?php

namespace App\Http\Controllers\Api\Diagnosi;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiagnosiRequest;
use App\Http\Resources\Diagnosi as DiagnosiResource;
use App\Http\Resources\DiagnosiCollection;
use App\Repository\Diagnosi\DiagnosiRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiagnosiController extends Controller
{

	private $repository;
    private $user;

    public function __construct(DiagnosiRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->middleware(['jwt.specialist']);
        $this->user = Auth::guard('api')->user();
    }

    public function index()
    {
        return response()->json(
            new DiagnosiCollection($this->repository->getAll()),
            200 // state HTTP
        );
    }

    public function store(DiagnosiRequest $request)
    {
        $diagnosi = $this->repository->createOrUpdateFromRequest();
        return response()->json(
            [
                'message' => 'diagnostico registrado correctamente',
                'data' => new DiagnosiResource($diagnosi)
            ],
             200 // state HTTP
         );
    }

    public function update(DiagnosiRequest $request, int $id)
    {

        $diagnosi = $this->repository->createOrUpdateFromRequest($id);
        return response()->json(
            [
                'message' => 'diagnostico realizado correctamente',
                'data' => new DiagnosiResource($diagnosi)
            ],
            200 // state HTTP
        );
    }

    public function show($id)
    {
        return response()->json(
            new DiagnosiResource($this->repository->findOneByPrimary($id)),
            200 // state HTTP
        );
    }

    public function destroy($id)
    {
        $diagnosi = $this->repository->deleteByPrimary($id);
        return response()->json(
            [
                'message' => 'el diagnostico fue eliminado correctamente'],
                200
        );
    }


}
