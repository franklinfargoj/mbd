<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EeForwardApplication extends Controller
{
    public function ForwardApplication(){
        return view('admin.ee_department.forward-application');
    }
}
