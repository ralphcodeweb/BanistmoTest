<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


use Illuminate\Http\Request;

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


    //Hago un Override del metodo login
    public function login(Request $request)
    {

        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {

            return response()->json([
                'authUser' => auth()->user(),
                'code'     => 401,
                'message' => 'Crendencial Inválida'
            ]);
        }

        $accessToken = auth()->user()->createToken(bcrypt('authUser'))->accessToken;

        return response()->json([
            'user' => auth()->user(),
            'access_token' => $accessToken,
            'message' => 'Login Satisfactorio',
            'code' => 200
        ]);

    }

    public function authenticated(Request $request, $user)
    {
        return response()->json($user);
    }

    public function loggedOut(Request $request){

        return response()->json(null);
    }
}
