<?php

namespace App\Http\Controllers\api\Quota;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuotaRequest;
use App\Http\Resources\Quota as QuotaResource;
use App\Http\Resources\QuotaCollection;
use App\Repository\Quota\QuotaRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class QuotaController extends Controller
{
	private $repository;
    private $user;

    public function __construct(QuotaRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->middleware(['jwt.specialist']);
        $this->user = Auth::guard('api')->user();
    }

    public function index()
    {
        return response()->json(
            new QuotaCollection($this->repository->getAll()),
            200 // state HTTP
        );
    }

    public function store(QuotaRequest $request)
    {
        $quota = $this->repository->createOrUpdateFromRequest();
        return response()->json(
            [
                'message' => 'quota registrada exitosamente',
                'data' => new QuotaResource($quota)
            ],
             200 // state HTTP
         );
    }

    public function update(QuotaRequest $request, int $id)
    {

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
