<?php

namespace App\Services\Contracts;
use \Laravel\Socialite\Two\User;

interface IAuthenticator
{
    public function auth(User $user): void;
}
