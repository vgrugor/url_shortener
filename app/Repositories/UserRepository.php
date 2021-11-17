<?php

namespace App\Repositories;

use App\Models\User;
use \Laravel\Socialite\Two\User as SUser;
use App\Repositories\Contracts\IUserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository implements IUserRepository
{
    public function getUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function addNewUser(SUser $user): User
    {
        $newUser = new User();
        $newUser->name = $user->getNickname();
        $newUser->email = $user->getEmail();
        $newUser->password = Hash::make(Str::random(8));
        $newUser->remember_token = $user->token;
        $newUser->save();

        return $newUser;
    }

    public function updateUserToken(User $user, string $token): void
    {
        $user->remember_token = $token;
        $user->save();
    }
}
