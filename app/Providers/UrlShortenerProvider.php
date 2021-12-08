<?php

namespace App\Providers;

use App\Services\Auth\Contracts\IAuthenticator;
use App\Services\Shortener\Contracts\IShortUrlGenerator;
use App\Services\Auth\GitHubAuthenticator;
use App\Services\Shortener\ShortUrlGenerator;
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
