<?php

namespace App\Http\Controllers\api\Medical_record;

use App\Http\Controllers\Controller;
use App\Http\Resources\Medical_record as Medical_recordResource;
use App\Http\Resources\Medical_recordCollection;
use App\Repository\Medical_record\Medical_recordRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Medical_recordController extends Controller
{
	private $repository;
    private $user;

    public function __construct(Medical_recordRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->middleware(['jwt.specialist']);
        $this->user = Auth::guard('api')->user();
    }

    public function index()
    {
        return response()->json(
            new Medical_recordCollection($this->repository->getAll()),
            200 // state HTTP
        );
    }

    public function store(Medical_recordRequest $request)
    {
        try {

                $medical_record = $this->repository->createOrUpdateFromRequest();
                return response()->json(
                    new Medical_recordResource($medical_record),
                    200 // state HTTP
             );

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }

    }

    public function update(Medical_recordRequest $request, int $id)
    {
        try{
                $medical_record = $this->repository->createOrUpdateFromRequest($id);
                return response()->json(
                    [
                        'message' => 'Los datos de la historia clinica se an actualizado con exito ',
                        'data' => new Medical_recordResource($medical_record)
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
            new Medical_recordResource($this->repository->findOneByPrimary($id)),
            200 // state HTTP
        );
    }

    public function destroy($id)
    {
        $medical_record = $this->repository->deleteByPrimary($id);
        return response()->json(
            [
                'message' => 'el paciente fue eliminado correctamente'],
                200
        );
    }

}
