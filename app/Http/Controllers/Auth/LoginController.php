<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\RefreshToken;

use Illuminate\Http\Response;

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
        $this->middleware('guest')->except('logout');
    }




    /**
     * Rewrite logout method
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @author Luke Lin
     */
    public function logout(\Illuminate\Http\Request $request)
    {
        // API use revoke token no redirect, no sessions
//        $this->guard()->logout();
        try {
            if (env('APP_DEBUG')) {
//            Log::info(['Logout:', $request->user()->token()]);
//                Log::info(['Session:', $request->session()->all()]);
            }

            $aReturn = [];
            if ($request->user()) {
                $aReturn = ["success" => true, "data" => $request->user()->token()['id']];
                $request->user()->token()->revoke();

                $request->user()->tokens->each(function ($token, $key) {
                    RefreshToken::where('access_token_id', $token->id)->delete();
                    $token->delete();
                });

            }
//            $request->session()->flush();
//            $request->session()->invalidate();

//        $request->session()->regenerateToken(true);
//            $request->session()->regenerate(true);

            return response()->json($aReturn);

//        return $this->loggedOut($request) ?: redirect('/');
        } catch (Exception $e) {
            return response()->json($e->getMessage());

        }
    }
}
