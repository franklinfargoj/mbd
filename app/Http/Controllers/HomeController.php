<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with(['roles'])->where('id', Auth::user()->id)->first();
        $roles = array_get($user, 'roles')->first();
        $role_name = $roles->name;

        if($role_name == "LM")
        {
            return redirect('/village_detail');
        }

        abort(404);

    }
}
