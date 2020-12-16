<?php

namespace App\Providers;
use App\Repository\BaseRepository;
use App\Repository\BaseRepositoryInterface;
use App\Repository\Patient\PatientRepository;
use App\Repository\Patient\PatientRepositoryInterface;
use App\Repository\Quota\QuotaRepository;
use App\Repository\Quota\QuotaRepositoryInterface;
use App\Repository\Specialist\SpecialistRepository;
use App\Repository\Specialist\SpecialistRepositoryInterface;
use App\Repository\Waiting_list\Waiting_listRepository;
use App\Repository\Waiting_list\Waiting_listRepositoryInterface;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(QuotaRepositoryInterface::class, QuotaRepository::class);
        $this->app->bind(SpecialistRepositoryInterface::class, SpecialistRepository::class);
        $this->app->bind(Waiting_listRepositoryInterface::class, Waiting_listRepository::class);
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
    }
}
