<?php 
namespace App\Repository\Patient;

use App\Models\Patient;
use App\Repository\BaseRepository;
use App\Repository\Patient\PatientRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class PatientRepository extends BaseRepository implements PatientRepositoryInterface
{
    protected $model = Patient::class;

    public function getAllModels($user) //paginación con repository
    {

        // $quotaToday = Quota::where('specialist_id',$user->specialist->id)
        //                     ->where('date', Carbon::now()->toDateString())
        //                     ->first();

        // return $this->model::where('quota_id',$quotaToday->id)
        //             ->paginate(
        //                 $this->request->query('per_page', 10)
        //             );
    }

}