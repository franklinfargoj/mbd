<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SocietyOfferLetter;
use App\MasterLayout;

class SocietyTripatiteController extends Controller
{
    /**
     * Shows tripatite application form.
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show_tripatite_self($id){
        $society_details = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
        $layouts = MasterLayout::all();
        $routes=array();

       // dd(app('router')->has('show_tripatite_self'));
        // dd($society_details);
        return view('frontend.society.tripatite.show_tripatite_self', compact('society_details', 'id', 'layouts'));
    }

    public function show_tripatite_dev($id){
        $society_details = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
        $layouts = MasterLayout::all();
         dd($society_details);
        return view('frontend.society.tripatite.show_tripatite_dev', compact('society_details', 'id', 'layouts'));
    }
}
