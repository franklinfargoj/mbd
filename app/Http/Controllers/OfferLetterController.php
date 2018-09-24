<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfferLetterController extends Controller
{
    public function OfferLetterDoc(){
        return view('admin.offer-letter.index');
    }
}