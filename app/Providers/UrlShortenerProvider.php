<?php

namespace App\Providers;

use App\Services\Contracts\IAuthenticator;
use App\Services\Contracts\IShortUrlValidator;
use App\Services\Contracts\IShortUrlGenerator;
use App\Services\GitHubAuthenticator;
use App\Services\ShortUrlGenerator;
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
        $this->app->bind(IAuthenticator::class, GitHubAuthenticator::class);
        $this->app->bind(IShortUrlGenerator::class, ShortUrlGenerator::class);
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
