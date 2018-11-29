<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Session;

use App\User;

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

    /*use AuthenticatesUsers {
    logout as performLogout;
    }*/

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function test(Request $request)
    {
        dd($request->all());
    }

    public function check_user_email_duplicate(Request $request)
    {
        $user=User::where(['email'=>$request->email])->first();
        if($user)
        {
            $response=array(
                'status'=>1,
                'message'=>'Email Id already exist'
            );
        }else
        {
            $response=array(
                'status'=>0,
                'message'=>'Success'
            );
        }
        return response()->json($response);
    }   

    public function logout(Request $request)
    {
        $role_name = $request->session()->get('role_name');
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();
        if ($role_name === 'society') {
            return redirect('/society_offer_letter');
        } else if ($role_name === 'appointing_architect') {
            return redirect(route('appointing_architect.login'));
        }{
            return redirect('/login-user');
        }
    }

    protected function guard()
    {
        return Auth::guard();
    }

//    public function logout(Request $request)
    //    {
    ////        $this->performLogout($request);
    //        $this->guard()->logout();
    //
    //        $request->session()->invalidate();
    //
    //        return redirect('/login');
    //    }

    public function loginUser(Request $request)
    {
        $validateData = $request->validate([
            'captcha' => 'required|captcha',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
//            return redirect('/home');
             if (is_numeric(explode('/', explode('.', Session::get('_previous')['url'])[0])[2]) == true) {
                 // Authentication passed...
                 return redirect('/home');
             } else {
                 $role_name = Role::where('id', Auth::user()->role_id)->value('name');
                 if (explode('/', explode('.', Session::get('_previous')['url'])[0])[2] == 'society') {
                     // Authentication passed...
                     return redirect('/home');
                 } else {
                     if (!empty($role_name)) {
                         if ($role_name != 'society') {
                             // Authentication passed...
                             return redirect('/home');
                         } else {
                             return redirect('/login-user')->with('error', "Please enter valid credentials");
                         }
                     } else {
                         return redirect('/society_offer_letter')->with('error', "Please enter valid credentials");
                     }
                 }
             }

        } else {
//            return back()->with('error', "Please enter valid credentials");
//                        dd(Session::get('_previous')['url']);
//                        dd(explode('.', explode('/', "http://mhada.php-dev.in/login-user")[2])[0]);
             if (is_numeric(explode('.', explode('/', URL::previous())[2])[0]) == true) {
                 if (explode('/', URL::previous())[3] == 'society_offer_letter') {
                     return redirect('/society_offer_letter')->with('error', "Please enter valid credentials");
                 } else if (explode('/', URL::previous())[3] == 'appointing_architect') {
                     return redirect(route('appointing_architect.login'))->with('error', "Please enter valid credentials");
                 } else {

                     return redirect('/login-user')->with('error', "Please enter valid credentials");
                 }
             } else {
                 if (explode('/', explode('.', URL::previous())[2])[0] == 'society') {
                     return redirect('/society_offer_letter')->with('error', "Please enter valid credentials");
                 } else if (explode('/', explode('.', URL::previous())[2])[0] == 'appointing_architect') {
                     return redirect(route('appointing_architect.login'))->with('error', "Please enter valid credentials");
                 }{
                     return redirect('/login-user')->with('error', "Please enter valid credentials");
                 }
             }
        }
    }

    public function getLoginForm()
    {
        return view('auth.login');
    }

    public function getSocietyLoginForm()
    {
        return view('frontend.society.index');
    }

    public function getAppointingArchitectLoginForm()
    {
        return view('admin.architect.login');
    }
}
