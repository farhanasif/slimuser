<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    private $errors=[];
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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // override
    protected function redirectTo(){
        return '/dashboard';
    }

    public function showLoginForm(){
        return view('auth/login');
        //return view('admin.auth.login') /*Same As*/;
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
    
        $auth=Auth::guard()->attempt($this->credentials($request));
        //dd($auth);
        if ($auth){
            // it will work after the login successful
            $user = Auth::guard()->getLastAttempted()/*get recent loged in user data*/;
            $status=false;
            /*status Check*/
            if ($user->status==1){
                $status=true;
            }else{
                $this->incrementLoginAttempts($request);
                $this->errors['status']= "You Are Not Active...Try Again yet!";
            }
            
            if ($status){
                return $this->sendLoginResponse($request);
            }else{
                $this->logout($request);
            }
            return redirect('/')
                ->withInput($request->only('email'))
                ->withErrors($this->errors);
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/');
    }
}
