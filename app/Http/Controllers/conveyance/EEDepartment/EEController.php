<?php

namespace App\Http\Controllers\conveyance\EEDepartment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EEController extends Controller
{
	public function SalePriceCalculation(Request $request,$applicationId){

		$data = ConveyanceSalePriceCalculation::where('application_id',$applicationId)->first();
		dd($data);
	}
}
