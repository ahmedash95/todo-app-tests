<?php

namespace App\Http\Controllers;

use App\Social;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class TwitterConnectController extends Controller
{
    public function connect()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function callback(Request $request)
    {
        $user = Socialite::driver('twitter')->user();

        $request->user()->social()->updateOrCreate([
            'platform' => Social::PLATFORM_TWITTER,
        ], [
            'token' => $user->token,
            'secret' => $user->tokenSecret,
        ]);

        session()->flash('status', 'Your twitter account has been linked!');

        return redirect()->route('todo.index');
    }
}
