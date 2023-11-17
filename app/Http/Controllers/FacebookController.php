<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function loginwithFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function cbFacebook()
    {
        $user = Socialite::driver('facebook')->user();

        dd($user);

        $userWhere = User::updateOrCreate([
            'twitter_id' => $user->id,
        ], [
            'name' => $user->name,
            'email' => $user->email,
            'two_factor_secret' => $user->token,
            'profile_photo_path' => $user->avatar,
            'password' => encrypt('admin545454')
        ]);

        Auth::login($userWhere);

        return redirect('/dashboard');
    }
}
