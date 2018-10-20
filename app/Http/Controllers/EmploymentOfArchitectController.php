<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmploymentOfArchitectController extends Controller
{
    public function index(){
        return view('employment_of_architect.form1');
    }
}
