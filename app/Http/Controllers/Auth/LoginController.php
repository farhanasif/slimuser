<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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


    public function profile(){
        return view('profile.profile');
    }

    public function updateProfile(Request $request){
        $validated = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],
        ]);

        # check if user profile image is null, then validate
        if (auth()->user()->image == null) {
             $validate_image = Validator::make($request->all(), [
                'image' => ['required', 'image', 'max:1000']
            ]);
             # check if their is any error in image validation
            if ($validate_image->fails()) {
                return response()->json(['code' => 400, 'msg' => $validate_image->errors()->first()]);
            }
        }

        # check if their is any error
        if ($validated->fails()) {
            return response()->json(['code' => 400, 'msg' => $validated->errors()->first()]);
        }

        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;


        if ($image = $request->file('image')){
        $extension = $request->file('image')->getClientOriginalExtension();
        $imageName = time().".".$extension;
        $path = public_path('assets/images');
        $image->move($path, $imageName);

        if(file_exists('assets/images/'.$user->image) AND !empty($user->image)){
            unlink('assets/images/'.$user->image);
        }
        $user->image = $imageName;
        // dd('ok');
        }else{
            $user->image = $user->image;
        }
        $user->save();
        return response()->json(['code' => 200, 'msg' => 'profile updated successfully.']);
    }


    public function updatePasswordForm(){
        return view('profile.password_update');
    }


    function updatePassword(Request $request){
           //Validate form
           $validator = \Validator::make($request->all(),[
               'oldpassword'=>[
                   'required', function($attribute, $value, $fail){
                       if( !\Hash::check($value, Auth::user()->password) ){
                           return $fail(__('The current password is incorrect'));
                       }
                   },
                   'min:6',
                   'max:30'
                ],
                'newpassword'=>'required|string|min:6|max:30|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/', 
                'cnewpassword'=>'required|same:newpassword'
            ],[
                'oldpassword.required'=>'Enter your current password',
                'oldpassword.min'=>'Old password must have atleast 6 characters',
                'oldpassword.max'=>'Old password must not be greater than 30 characters',
                'newpassword.required'=>'Enter new password',
                'newpassword.min'=>'New password must have atleast 6 characters',
                'newpassword.max'=>'New password must not be greater than 30 characters',
                'newpassword.regex'=>'New password must contain at least one lowercase letter',
                'newpassword.regex'=>'New password must contain at least one uppercase letter',
                'newpassword.regex'=>'New password must contain at least one digit',
                'newpassword.regex'=>'New password must contain a special character',
                'cnewpassword.required'=>'ReEnter your new password',
                'cnewpassword.same'=>'New password and Confirm new password must match'
            ]);

           if( !$validator->passes() ){
               return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
           }else{
                
            $update = User::find(Auth::user()->id)->update(['password'=>\Hash::make($request->newpassword)]);

            if(!$update ){
                return response()->json(['status'=>0,'msg'=>'Something went wrong, Failed to update password in db']);
            }else{
                return response()->json(['status'=>1,'msg'=>'Your password has been changed successfully']);
            }
           }
       }
}
