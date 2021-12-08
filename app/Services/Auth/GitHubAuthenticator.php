<?php

namespace App\Services\Auth;

use App\Repositories\Contracts\IUserRepository;
use App\Services\Auth\Contracts\IAuthenticator;
use Illuminate\Support\Facades\Auth;
use \Laravel\Socialite\Two\User;

class GitHubAuthenticator implements IAuthenticator
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function auth(User $user): void
    {
        $userFromDB = $this->userRepository->getUserByEmail($user->email);

        if (!$userFromDB) {
            $newUser = $this->userRepository->addNewUser($user);
            Auth::login($newUser, $remember = true);
        } else {
            $this->userRepository->updateUserToken($userFromDB, $user->token);
            Auth::login($userFromDB, $remember = true);
        }
    }
}
