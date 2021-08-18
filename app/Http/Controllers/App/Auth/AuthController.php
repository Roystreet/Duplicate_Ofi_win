<?php
namespace App\Http\Controllers\App\Auth;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Validator, Redirect, Response, File;
use App\User;
use Socialite;


class AuthController extends AppBaseController
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->user();
        $user    = $this->createUser($getInfo, $provider);
        auth()->login($user);
        return  redirect()->route('home');
    }

    function createUser($getInfo, $provider)
    {
        $user = User::where('provider_id', $getInfo->id)->first();
        return $user;
    }
}
