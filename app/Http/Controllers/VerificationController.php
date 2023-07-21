<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use App\Models\User;

class VerificationController extends Controller
{
    public function verify2FACode(Request $request)
    {
        $user = auth()->user();

        if (!$user instanceof User || !$user->google2fa_secret) {
            return false;
        }

        $securityCode = $request->input('2fa_code');
        $google2fa = new Google2FA();
        $is2FAVerified = $google2fa->verifyKey($user->google2fa_secret, $securityCode);

        return $is2FAVerified;
    }
}
