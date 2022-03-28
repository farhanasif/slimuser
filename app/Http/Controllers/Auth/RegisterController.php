<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo ='/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function showRegistrationForm(){
          return view('auth.register');
      }

      public function userRegister(Request $request){
          $this->validate($request,[
              'name'=>'required|min:4',
              'email'=>'required|email|unique:users,email',
              'password'=>'required|min:6',
              'phone'=>'required',
              'address'=>'required'
          ]);
          //Save data into the database
          $user=new User();
          $user->name=$request->name;
          $user->email=$request->email;
          //$user->password=bcrypt($request->password;
          $user->password=Hash::make($request->password);
          $user->phone=$request->phone;
          $user->address=$request->address;
          $user->status=1;
          $user->role='admin';
          $user->save();

        return redirect()->route('showLoginForm')->with('success','You Have Successfully Registered!');
      }
}
