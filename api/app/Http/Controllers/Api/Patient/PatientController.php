<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Http\Resources\Medical_consultation as Medical_consultationResource;
use App\Http\Resources\Medical_record as Medical_recordResource;
use App\Http\Resources\Patient as PatientResource;
use App\Http\Resources\PatientCollection;
use App\Models\Medical_consultation;
use App\Models\Medical_record;
use App\Repository\Patient\PatientRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    private $repository;
    private $user;

    public function __construct(PatientRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->middleware('jwt.specialist');
        $this->user = Auth::guard('api')->user();
    }

    public function index()
    {
        return response()->json(
            new PatientCollection($this->repository->getAllModels($this->user)),
            200 // state HTTP
        );
    }
    public function store(PatientRequest $request)
    {
        try {

                $patient = $this->repository->createOrUpdateFromRequest();//creamos el pacient
                $result  = $this->repository->storePatientMedicalRecord($patient, $this->user);
                return response()->json(
                    [
                        'message' => 'patient registrada exitosamente',
                        'data'    => new PatientResource($patient),
                        // 'consulta'=> new Medical_consultationResource($result['consulta'])
                    ],
                    200 // state HTTP
             );

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }

    }

    public function update(PatientRequest $request, int $id)
    {
        try{
                $patient = $this->repository->createOrUpdateFromRequest($id);
                return response()->json(
                    [
                        'message' => 'Los datos del paciente han sido actualizados correctamente',
                        'data' => new PatientResource($patient)
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
            new PatientResource($this->repository->findOneByPrimary($id)),
            200 // state HTTP
        );
    }

    public function destroy($id)
    {
        $patient = $this->repository->deleteByPrimary($id);
        return response()->json(
            [
                'message' => 'el paciente fue eliminado correctamente'],
                200
        );
    }

    public function getPatient($consulta)
    {
        return response()->json(
           new PatientResource($this->repository->getByConsulta($consulta)),
           200
        );
    }
}
