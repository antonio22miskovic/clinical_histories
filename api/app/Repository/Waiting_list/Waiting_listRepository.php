<?php

namespace App\Repository\Waiting_list;

use App\Http\Resources\Waiting_listCollection;
use App\Models\Patient;
use App\Models\Quota;
use App\Models\Waiting_list;
use App\Repository\BaseRepository;
use App\Repository\Waiting_list\Waiting_listRepositoryInterface;
use Carbon\Carbon;

class Waiting_listRepository extends BaseRepository implements Waiting_listRepositoryInterface
{
    protected $model = Waiting_list::class;

    public function getAllModels($user) #paginación con repository
    {

        $quotaToday = Quota::where('specialist_id',$user->specialist->id)
                            ->where('date', Carbon::now()->toDateString())
                            ->first();
        if (is_null($quotaToday)) {
            return null;
        }
        return $this->model::where('quota_id',$quotaToday->id)
                    ->paginate(
                        $this->request->query('per_page', 10)
                    );
    }

    public function filterPatient($ci)
    {
       return Patient::where('ci', $ci)->first();
    }

    public function deleteByCi($ci)
    {
        $patient = $this->model->where('identification_card',$ci)->first();
        $patient->delete();
        return true;
    }

    public function StoreList($value)
    {
        // return $value;
        try {
            $fecha_actual = new \DateTime('NOW');
            $horas_minutes = $fecha_actual->format('H:i:s');
            $dias_evaluar = 30;
            for ($i=0; $i < $dias_evaluar; $i++) {
                if ($i >= 1) {// evaluar primera vuelta
                    $fecha_actual = $fecha_actual.' '.$horas_minutes;
                    $fecha_actual = new \DateTime($fecha_actual);
                    $fecha_actual = $fecha_actual->modify('+24 hours');
                    $fecha_actual = $fecha_actual->format('Y-m-d');
                }else{
                    $fecha_actual = $fecha_actual->format('Y-m-d');
                }

                $quota = Quota::where('specialist_id',intval($value['specialist_id']))
                              ->where('date',$fecha_actual)
                                ->first();
                if (is_null($quota)) {
                    if (($i + 1) === $dias_evaluar) {
                        return ['quota_is_null' => 'quotas no disponibles'];
                    }
                }else{
                    if ($quota->quota > 0) { // resto de la quota
                        $resta = $quota->quota - 1;
                        $quota->quota = $resta;
                        $quota->save();
                        $wl = $this->model::create([
                            'identification_card' => $value['identification_card'],
                            'quota_id' => $quota->id
                        ]);
                        return ['quota' => $quota,  'wl' => $wl];
                    }
                }
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
