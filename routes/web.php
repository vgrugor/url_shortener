<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/dashboard', [\App\Http\Controllers\UrlShortenerController::class, 'getShortUrl'])->name('get-short-url');

require __DIR__.'/auth.php';

Route::get('/auth/redirect', [\App\Http\Controllers\GitHubLoginController::class, 'redirectGitHub'])
    ->name('redirectGitHub');

Route::get('/auth/callback', [\App\Http\Controllers\GitHubLoginController::class, 'callbackGitHub']);

