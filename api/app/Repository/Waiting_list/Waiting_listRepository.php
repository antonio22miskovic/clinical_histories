<?php

namespace App\Repository\Waiting_list;

use App\Http\Resources\Waiting_listCollection;
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

        return $this->model::where('quota_id',$quotaToday->id)
                    ->paginate(
                        $this->request->query('per_page', 12)
                    );
    }
}
