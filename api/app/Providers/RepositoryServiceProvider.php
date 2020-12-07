<?php

namespace App\Providers;
use App\Repository\BaseRepository;
use App\Repository\BaseRepositoryInterface;
use App\Repository\Quota\QuotaRepository;
use App\Repository\Quota\QuotaRepositoryInterface;
use App\Repository\Specialist\SpecialistRepository;
use App\Repository\Specialist\SpecialistRepositoryInterface;
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
    }
}
