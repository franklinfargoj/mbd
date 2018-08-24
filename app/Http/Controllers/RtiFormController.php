<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class RtiFormController extends Controller
{
    public function showFrontendForm()
    {
        if(Session::has('fronendLoginId'))
        {
            return view('frontendRtiForm');
        }
        else{
            return redirect('/');
        }
    }
}
