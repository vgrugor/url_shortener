<?php

namespace App\Providers;

use App\Services\Contracts\IAuthenticator;
use App\Services\Contracts\IUrlShortener;
use App\Services\GitHubAuthenticatorService;
use App\Services\ShortUrlGeneratorService;
use Illuminate\Support\ServiceProvider;

class UrlShortenerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IAuthenticator::class, GitHubAuthenticatorService::class);
        $this->app->bind(IUrlShortener::class, ShortUrlGeneratorService::class);
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
