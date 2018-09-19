<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\Department;
use App\Http\Requests\board\CreateBoardRequest;
use App\Http\Requests\board\UpdateBoardRequest;
use Yajra\DataTables\DataTables;
use Config;
use DomPDF;

class TestController extends Controller
{
	public function index()
    {
    	$pdf = DomPDF::loadView('frontend.society.test');
		//return $pdf->download('invoice.pdf');
    	 return view('frontend.society.test');
    }

    public function test(){
    	$pdf = App::make('dompdf.wrapper');
$pdf->loadHTML('<h1>मुंबई -४०००५१.</h1>');
return $pdf->stream();
    }
}