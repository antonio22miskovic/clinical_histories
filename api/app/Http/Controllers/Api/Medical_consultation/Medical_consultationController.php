<?php

namespace App\Http\Controllers\Api\Medical_consultation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Medical_consultationRequest;
use App\Http\Resources\Medical_consultation as Medical_consultationResource;
use App\Http\Resources\Medical_consultationCollection;
use App\Repository\Medical_consultation\Medical_consultationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Medical_consultationController extends Controller
{

	private $repository;
    private $user;

    public function __construct(Medical_consultationRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->middleware(['jwt.specialist']);
        $this->user = Auth::guard('api')->user();
    }

    public function index()
    {
        return response()->json(
            new Medical_consultationCollection($this->repository->getAll()),
            200 // state HTTP
        );
    }

    public function store(Medical_consultationRequest $request)
    {
        try {
                $values = [
                    'user'           =>  $this->user->id,
                    'medical_record' =>  $request['medical_record_id']
                ];

                $medical_consultation = $this->repository->CreateConstultation($values);
                return response()->json(
                    new Medical_consultationResource($medical_consultation),
                    200 // state HTTP
             );

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }

    }

    public function update(Medical_consultationRequest $request, int $id)
    {
        try{
                $medical_consultation = $this->repository->createOrUpdateFromRequest($id);
                return response()->json(
                    [
                        'message' => 'los datos de la consulta medica fueron actualizados con exito',
                        'data' => new Medical_consultationResource($medical_consultation)
                    ],
                    200 // state HTTP
                );
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        return response()->json(
            new Medical_consultationResource($this->repository->findOneByPrimary($id)),
            200 // state HTTP
        );
    }

    public function destroy($id)
    {
        $medical_consultation = $this->repository->deleteByPrimary($id);
        return response()->json(
            [
                'message' => 'la consulta medica fue eliminada con exito'],
                200
        );
    }

}
