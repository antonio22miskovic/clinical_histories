<?php

namespace App\Http\Controllers\Api\Antecedente;

use App\Http\Controllers\Controller;
use App\Http\Resources\Antecedente as AntecedenteResource;
use App\Http\Resources\AntecedenteCollection;
use App\Repository\Antecedente\AntecedenteRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AntecedenteController extends Controller
{
	private $repository;
    private $user;

    public function __construct(AntecedenteRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->middleware(['jwt.specialist']);
        $this->user = Auth::guard('api')->user();
    }

    public function index($id)
    {
        return response()->json(
            new AntecedenteCollection($this->repository->getAllModels($id)),
            200 // state HTTP
        );
    }

    public function store(Request $request)
    {
        $Antecedente = $this->repository->StoreAntecedente($request);
        if ($Antecedente === true) {

            return response()->json(
                [
                    'message' => 'Antecedente registrado correctamente',
                    'data' => true
                ],
                 200 // state HTTP
             );

        }else{

            return response()->json(
                [
                    'message' => 'Hubo un problema',
                    'data' => false
                ],
                 500 // state HTTP
             );
        }
    }

    public function update(Request $request, int $id)
    {

        $Antecedente = $this->repository->createOrUpdateFromRequest($id);
        return response()->json(
            [
                'message' => 'Antecedente Actualizado con exito',
                'data' => new AntecedenteResource($Antecedente)
            ],
            200 // state HTTP
        );
    }

    public function show($id)
    {
        return response()->json(
            new AntecedenteResource($this->repository->findOneByPrimary($id)),
            200 // state HTTP
        );
    }

    public function destroy($id)
    {
        $antecedente = $this->repository->deleteByPrimary($id);
        return response()->json(
            [
                'message' => 'Antecedente eliminado correctamente'
            ],
            200
        );
    }

}
