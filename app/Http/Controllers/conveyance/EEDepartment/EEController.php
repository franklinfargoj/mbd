<?php

namespace App\Http\Controllers\conveyance\EEDepartment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\conveyance\ConveyanceSalePriceCalculation;
use App\conveyance\scApplication;

class EEController extends Controller
{
	public function SalePriceCalculation(Request $request,$applicationId){
	
		$data = scApplication::with('ConveyanceSalePriceCalculation')->where('id',$applicationId)->first();

		return view('admin.conveyance.ee_department.sale_price_calculation', compact('html','header_data','getData','folder_name','data'));
	}

	public function SaveCalculationData(Request $request){

		$applicationId = $request->application_id;
		$arrData = $request->all();
		unset($arrData['_token'],$arrData['pump_house'],$arrData['completion_date']);
		ConveyanceSalePriceCalculation::updateOrCreate(['application_id'=>$applicationId],$arrData);
		dd($arrData);
	}
}
