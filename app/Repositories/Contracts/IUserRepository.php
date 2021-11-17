<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use \Laravel\Socialite\Two\User as SUser;

interface IUserRepository
{
    public function getUserByEmail(string $email): ?User;

    public function addNewUser(SUser $user): User;

    public function updateUserToken(User $user, string $token): void;
}
