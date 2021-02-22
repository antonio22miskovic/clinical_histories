<?php

namespace App\Http\Controllers\Api\Waiting_list;

use App\Http\Controllers\Controller;
use App\Http\Requests\Waiting_listRequest;
use App\Http\Resources\Patient as PatientResource;
use App\Http\Resources\Quota as QuotaResource;
use App\Http\Resources\Waiting_list as Waiting_listResource;
use App\Http\Resources\Waiting_listCollection;
use App\Repository\Waiting_list\Waiting_listRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class Waiting_listController extends Controller
{
    private $repository;
    private $user;

    public function __construct(Waiting_listRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('jwt.specialist', ['except' => ['store']]);
        $this->user = Auth::guard('api')->user();
    }

    public function index()
    {
        $data = $this->repository->getAllModels($this->user);
        if (is_null($data)) {
            return null;
        }
        return response()->json(
            new Waiting_listCollection($data),
            200
        );
    }

    public function store(Waiting_listRequest $request)
    {
        $waiting_list = $this->repository->StoreList($request);
        if (isset($waiting_list['quota_is_null'])) {
            return response()->json(['quota_is_null' => true],200);
        }
        // return $waiting_list;
        return response()->json(
            [
                'message' => 'su fecha para la consulta es correcta',
                'wl' => new Waiting_listResource($waiting_list['wl']),
                'quota' => new QuotaResource($waiting_list['quota'])
            ],
             200 // state HTTP
         );
    }

    public function update(Waiting_listRequest $request, int $id)
    {

        $waiting_list = $this->repository->createOrUpdateFromRequest($id);
        return response()->json(
            [
                'message' => 'se actualizo el registro en la lista correctamente',
                'data' => new Waiting_listResource($waiting_list)
            ],
            200 // state HTTP
        );
    }

    public function show($id)
    {
        return response()->json(
            new Waiting_listResource($this->repository->findOneByPrimary($id)),
            200 // state HTTP
        );
    }

    public function destroy($ci)
    {
        $waiting_list = $this->repository->deleteByCi($ci);
        return response()->json(
            [
                'message' => 'paciente eliminado de la lista de espera exitosamente'
            ],
            200
        );
    }

    public function detectPatient($ci)
    {
        $validate = $this->repository->filterPatient($ci);

        if (is_null($validate)) {
            return response()->json(null,200);
        }
        return response()->json(
            new PatientResource($validate),
            200
        );
    }

}
