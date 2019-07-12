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
use App\DataSheet;

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
	
	public function form()
	{
		return view('test.form');
	}

	public function postform(Request $request)
	{
		$this->validate($request, [
			'full_name' => 'required',
			'permanant_address' => 'required',
			'address_present'=>'required',
			'residing_in_staff_quarter'=>'required',
			'post'=>'required',
			'class'=>'required',
			'pay_scale'=>'required',
			'income_category_group'=>'required',
			'dob'=>'required',
			'date_of_appoinment_in_mhada'=>'required',
			'received_house_from_mhada'=>'required',
			'under_which_provosion'=>'required_if:received_house_from_mhada,==,1',
			'you_or_your_spouse_own_house'=>'required',
			'if_yes_name_of_the_city'=>'required_if:you_or_your_spouse_own_house,==,1',
			'requirement_of_house_by_mhada'=>'required',
			'preferable_city_1'=>'required',
			'preferable_city_2'=>'required',
			'preferable_city_3'=>'required'
		]);
		try
		{
			DataSheet::create($request->all());
			return redirect()->route('getform')->with([ 'success' => 'data uploaded successfully!!!!' ] );
		}catch(\Exception $e)
		{
			return redirect()->route('getform')->with([ 'failed' => 'Something Went Wrong' ] );
		}
		
	}
}