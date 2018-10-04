<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

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

    public function logout(Request $request)
    {   
        $role_name = $request->session()->get('role_name');
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();
        if($role_name === 'society'){
            return redirect('/society_offer_letter');
        }else{
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
            if(strrpos(Session::get('_previous')['url'], 'captcha') == false){
                return redirect('/society_offer_letter')->with('error', "Please enter valid credentials");
            }
            // Authentication passed...
            return redirect('/home');
        }
        else
        {
            if(strrpos(Session::get('_previous')['url'], 'society.') == false){
                return redirect('/society_offer_letter')->with('error', "Please enter valid credentials");
            }else{
                return redirect('/login-user')->with('error', "Please enter valid credentials");
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
}
