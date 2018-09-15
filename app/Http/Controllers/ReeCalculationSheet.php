<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReeCalculationSheet extends Controller
{
    public function CalculationSheet(){
        return view('admin.ree.calculation-sheet');
    }
}
