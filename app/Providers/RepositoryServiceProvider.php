<?php

namespace App\Providers;

use App\Repositories\Contracts\IStatisticRepository;
use App\Repositories\Contracts\IUrlRepository;
use App\Repositories\Contracts\IUserRepository;
use App\Repositories\StatisticRepository;
use App\Repositories\UrlRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IUrlRepository::class, UrlRepository::class);
        $this->app->bind(IStatisticRepository::class, StatisticRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
