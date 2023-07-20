<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PragmaRX\Google2FAQRCode\Google2FA;

class TwoFactorAuthentication
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        // Enable Two-Factor Authentication for all newly registered users
        $user->enableTwoFactorAuthentication();

        $this->guard()->login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
