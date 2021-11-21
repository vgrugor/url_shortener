<?php

namespace App\Providers;

use App\Services\Contracts\IAuthenticator;
use App\Services\Contracts\IShortUrlValidator;
use App\Services\Contracts\IShortUrlGenerator;
use App\Services\GitHubAuthenticatorService;
use App\Services\ShortUrlGeneratorService;
use App\Services\ShortUrlValidator;
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
        $this->app->bind(IShortUrlGenerator::class, ShortUrlGeneratorService::class);
        $this->app->bind(IShortUrlValidator::class, ShortUrlValidator::class);
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
