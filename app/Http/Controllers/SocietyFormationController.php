<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SocietyFormationController extends Controller
{
    public function index()
    {
        return view('frontend.society.society_formation.index');
    }
}
