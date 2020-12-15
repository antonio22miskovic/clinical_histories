<?php

namespace App\Http\Controllers\Api\Waiting_list;

use App\Http\Controllers\Controller;
use App\Http\Resources\Waiting_list as Waiting_listResource;
use App\Http\Resources\Waiting_listCollection;
use App\Repository\Waiting_list\Waiting_listRepository;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class Waiting_listController extends Controller
{
    private $repository;
    private $user;

    public function __construct(Waiting_listRepository $repository)
    {
        $this->repository = $repository;
        $this->user = JWTAuth::parseToken()->authenticate();
        $this->middleware(['jwt.specialist']);
    }

    public function index()
    {
        return response()->json( 
            new Waiting_listCollection($this->repository->getAllModels($this->user)),
            200
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'identification_card' => "required",
        ],[
            'identification_card.required' => ' debe introducir su numero de cedula'
        ]);
        $waiting_list = $this->repository->createOrUpdateFromRequest();
        return response()->json(
            [
                'message' => 'waiting_list registrada exitosamente',
                'data' => new Waiting_listResource($waiting_list)
            ],
             200 // state HTTP
         );
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'identification_card' => "required",
        ],[
            'identification_card.required' => ' debe introducir su numero de cedula'
        ]);
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

    public function destroy($id)
    {
        $waiting_list = $this->repository->deleteByPrimary($id);
        return response()->json(
            [
                'message' => 'el registro fue eliminado correctamente'
            ],
            200
        );
    }
}
