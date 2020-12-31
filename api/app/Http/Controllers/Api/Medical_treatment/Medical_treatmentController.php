<?php

namespace App\Http\Controllers\Api\Medical_treatment;

use App\Http\Controllers\Controller;
use App\Http\Resources\Medical_treatmentCollection;
use App\Http\Resources\Medical_treatment as Medical_treatmentResource;
use App\Repository\Medical_treatment\Medical_treatmentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Medical_treatmentController extends Controller
{
	private $repository;
    private $user;

    public function __construct(Medical_treatmentRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->middleware(['jwt.specialist']);
        $this->user = Auth::guard('api')->user();
    }

    public function index()
    {
        return response()->json(
            new Medical_treatmentCollection($this->repository->getAll()),
            200 // state HTTP
        );
    }

    public function store(Request $request)
    {
        try {

                $medical_treatment= $this->repository->createOrUpdateFromRequest();
                return response()->json(
                    new Medical_treatmentResource($medical_treatment),
                    200 // state HTTP
             );

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }

    }

    public function update(Request $request, int $id)
    {
        try{
                $medical_treatment = $this->repository->createOrUpdateFromRequest($id);
                return response()->json(
                    [
                        'message' => 'el tratamiento ah sido actualizado con exito ',
                        'data' => new Medical_treatmentResource($medical_treatment)
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
            new Medical_treatmentResource($this->repository->showMedicalRecordPatient($id)),
            200 // state HTTP
        );
    }

    public function destroy($id)
    {
        $medical_treatment = $this->repository->deleteByPrimary($id);
        return response()->json(
            [
                'message' => 'el tratameinto fue eliminado con exito'],
                200
        );
    }
}
