<?php

namespace App\Http\Controllers;

use App\Services\Auth\Contracts\IAuthenticator;
use Laravel\Socialite\Facades\Socialite;

class GitHubLoginController extends Controller
{
    private IAuthenticator $authenticator;

    public function __construct(IAuthenticator $gitHubAuthenticator)
    {
        $this->authenticator = $gitHubAuthenticator;
    }

    public function redirectGitHub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callbackGitHub()
    {
        $user = Socialite::driver('github')->user();
        $this->authenticator->auth($user);

        return redirect('/');
    }
}
