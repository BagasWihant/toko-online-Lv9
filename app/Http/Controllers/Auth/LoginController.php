<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected function authenticated(Request $request, $user)
    {
        if (Auth::user()->role == '01') {
            return redirect('admin/dashboard')->with('pesan', 'Selamat datang');
        } else {
            return redirect('/')->with('pesan', 'Berhasil Login');
        }
    }

    public function loginGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginGoogleCallback()
    {
        try {

            $google = Socialite::driver('google')->user();
        } catch (\Throwable $th) {
            return $th;
        }

        $user = User::firstOrCreate(
            [
                'email' => $google->email,
            ],
            [
                'name' => $google->name,
                'password' => 0,
                'email_verified_at' => now()
            ]
        );
        auth()->login($user, true);
        return redirect()->route('home');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
