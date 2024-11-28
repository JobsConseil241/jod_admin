<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            $user = User::find(Auth::user()->id); // On peut utiliser Auth::user() directement ici
            $user_check = $user->whereNull('google2fa_secret')->where('mfa_is_active', true)->first();

            if ($user_check) {
                // Initialise Google 2FA
                $google2fa = app('pragmarx.google2fa');

                // Génère la clé secrète
                $google2fa_secret = $google2fa->generateSecretKey();

                $user->google2fa_secret = $google2fa_secret;
                $user->save();

                // Génère le QR code
                $QR_Image = $google2fa->getQRCodeInline(
                    config('app.name'),
                    $user->email,
                    $google2fa_secret
                );

                return view('auth.google2fa', ['QR_Image' => $QR_Image, 'secret' => $google2fa_secret, 'registered' => $user]);
            }

            // Si 2FA est déjà activé, redirige vers la vérification du code Google 2FA
            if ($user->mfa_is_active) {
                return redirect()->route('verify.2fa');
            }

            if (Auth::user() && Session::get('personnalToken') == null) {
                $personnalToken = $user->createToken("od_web", ['*'], now()->addDay())->plainTextToken;
                Session::put('personnalToken', $personnalToken);
            }

            return $this->sendLoginResponse($request);
        }

        // Si la tentative de connexion échoue
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }


    public function two_fa(Request $request) {}
}
