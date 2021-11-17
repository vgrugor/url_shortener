<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GitHubLoginController extends Controller
{
    public function redirectGitHub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callbackGitHub()
    {
        $user = Socialite::driver('github')->user();

        $userFromDB = User::where('email', $user->email)->first();

        if (!$userFromDB) {
            $newUser = new User();
            $newUser->name = $user->getNickname();
            $newUser->email = $user->getEmail();
            $newUser->password = Hash::make(Str::random(8));
            $newUser->remember_token = $user->token;
            $newUser->save();
            Auth::login($newUser);
        } else {
            $userFromDB->remember_token = $user->token;
            $userFromDB->save();
            Auth::login($userFromDB);
        }

        return redirect('/');
    }
}
