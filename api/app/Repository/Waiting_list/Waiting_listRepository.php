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
        $quota = Quota::where('specialist_id',$value['specialist_id'])
                ->first();
        if (is_null($quota)) {
              return ['quota_is_null' => 'quota no disponible para ese dia'];      
        } 
        // if ($quota->quota > 0) {
        //     $resta = $quota->quota - 1;
        //     $quota->quota = $resta;
        //     $quota->save();
        // }
        $wl = $this->model::create([
            'identification_card' => $value['identification_card'],
            'quota_id' => $quota->id
        ]);
        return ['quota' => $quota,  'wl' => $wl];
    }
}
