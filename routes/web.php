<?php

use App\Http\Controllers\GitHubLoginController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\UrlShortenerController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('/auth/redirect', [GitHubLoginController::class, 'redirectGitHub'])
    ->name('redirectGitHub');

Route::get('/auth/callback', [GitHubLoginController::class, 'callbackGitHub']);

Route::middleware('auth')->group(function () {
    Route::post('/', [UrlShortenerController::class, 'getShortUrl'])
        ->name('get-short-url');

    Route::view('/', 'dashboard')
        ->name('dashboard');

    Route::get('/{shortKey}/{secretKey}', [RedirectController::class, 'secretRedirect']);

    Route::get('/{shortKey}', [RedirectController::class, 'redirect']);
});
