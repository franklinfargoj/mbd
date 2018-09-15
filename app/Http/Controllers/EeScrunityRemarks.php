<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EeScrunityRemarks extends Controller
{
    public function ScrunityRemarks(){
        return view('admin.ee.scrunity-remarks');
    }
}
