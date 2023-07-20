<?php
//
//namespace App\Http\Controllers\Auth;
//
//use App\Http\Controllers\Controller;
//use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Auth\EmailVerificationRequest;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Http\Request;
//use App\Models\User;
//use PragmaRX\Google2FAQRCode\Google2FA;
//
//class TwoFactorVerificationController extends Controller
//{
//    public function create()
//    {
//        return view('auth.register');
//    }
//
//    public function store(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
//            'password' => 'required|string|confirmed|min:8',
//        ]);
//
//        if ($validator->fails()) {
//            return redirect()->back()->withErrors($validator)->withInput();
//        }
//
//        $user = User::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => Hash::make($request->password),
//        ]);
//
//        $google2fa = new Google2FA();
//        $user->google2fa_secret = $google2fa->generateSecretKey();
//        $user->save();
//
//        Auth::login($user);
//
//        if ($user->hasTwoFactorAuthenticationEnabled()) {
//            return redirect()->route('verify.2fa');
//        } else {
//            return redirect(RouteServiceProvider::HOME);
//        }
//    }
//}
