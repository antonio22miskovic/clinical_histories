<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\PatientCollection;
use App\Http\Resources\Patient as PatientResource;
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
        $this->middleware(['jwt.specialist']);
        $this->user = Auth::guard('api')->user();
    }

    public function index()
    {
        return response()->json(
            new PatientCollection($this->repository->getAll()),
            200 // state HTTP
        );
    }

    public function store(Request $request)
    {
        try {
                $request->validate([
                    'sex' => "required",
                    'first_name' => "required",
                    'last_name' => "required",
                    'ci' => "required",
                    'civil_status' => "required",
                    'birthdate' => "required",
                    'weight' => "required"
                ],[
                    'sex.required' => 'Debe introducir un genero',
                    'first_name.required' => 'Por Favor Introduzca el Nombre',
                    'last_name.required' => 'Por Favor Introduzca el Apellido',
                    'ci.required' => 'Por Favor Introduzca el numero de Cedula' ,
                    'civil_status.required' => 'Debe Introducir el estado civil',
                    'birthdate.required' => 'Introduzca la fecha de nacimiento',
                    'weight.required' => 'introduzca el peso del paciente'
                ]);
                $patient = $this->repository->createOrUpdateFromRequest();
                return response()->json(
                    [
                        'message' => 'patient registrada exitosamente',
                        'data' => new PatientResource($patient)
                    ],
                    200 // state HTTP
             );

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }


    }

    public function update(Request $request, int $id)
    {
        try{
                $request->validate([
                    'sex' => "required",
                    'first_name' => "required",
                    'last_name' => "required",
                    'ci' => "required",
                    'civil_status' => "required",
                    'birthdate' => "required",
                    'weight' => "required"
                ],[
                    'sex.required' => 'Debe introducir un genero',
                    'first_name.required' => 'Por Favor Introduzca el Nombre',
                    'last_name.required' => 'Por Favor Introduzca el Apellido',
                    'ci.required' => 'Por Favor Introduzca el numero de Cedula' ,
                    'civil_status.required' => 'Debe Introducir el estado civil',
                    'birthdate.required' => 'Introduzca la fecha de nacimiento',
                    'weight.required' => 'introduzca el peso del paciente'
                ]);

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
}
