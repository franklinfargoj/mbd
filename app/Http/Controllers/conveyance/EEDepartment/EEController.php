<?php

namespace App\Http\Controllers\conveyance\EEDepartment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\conveyance\ConveyanceSalePriceCalculation;
use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\conveyance\conveyanceCommonController;
use App\conveyance\scApplication;
use Storage;

class EEController extends Controller
{
    public function __construct()
    {
        $this->CommonController = new CommonController();       
        $this->conveyance 		= new conveyanceCommonController();       
    }

	public function SalePriceCalculation(Request $request,$applicationId){
	
		$data = scApplication::with('ConveyanceSalePriceCalculation')->where('id',$applicationId)->first();
        $data->status = $this->conveyance->getCurrentStatus($applicationId);
        $is_view = session()->get('role_name') == config('commanConfig.ee_junior_engineer');
        if ($is_view && $data->status->status_id == '1'){
            $route = 'admin.conveyance.ee_department.sale_price_calculation';
        }else{
            $route = 'admin.conveyance.common.view_ee_sale_price_calculation';   
        }
		return view($route, compact('data'));
	}

	public function SaveCalculationData(Request $request){
		$applicationId = $request->application_id;
		$arrData = $request->all();
		unset($arrData['_token'],$arrData['pump_house'],$arrData['completion_date']);
		ConveyanceSalePriceCalculation::updateOrCreate([ 'application_id' => $applicationId],$arrData);
		ConveyanceSalePriceCalculation::where('application_id',$applicationId)
		->update(['completion_date' 			=> date('Y-m-d',strtotime($request->completion_date)), 
				  'pump_house'      			=> $request->pump_house,
				  'chawl_no' 					=> $request->chawl_no,
				  'consisting' 					=> $request->consisting,
				  'project_of' 					=> $request->project_of,
				  'ts_under' 					=> $request->ts_under,
				  'situated_at' 				=> $request->situated_at,
				  'construction_cost' 			=> $request->construction_cost,
				  'land_premiun_infrastructure' => $request->land_premiun_infrastructure
				]);


		return back()->with('success','Data submitted successfully.');
	}

	public function SaveDemarcationPlan(Request $request){
		
		$applicationId = $request->application_id;

        if ($request->file('demarcation_plan')){

            $file 		 = $request->file('demarcation_plan');
            $file_name 	 = time().'_demarcation_plan_'.$applicationId.'.'.$file->getClientOriginalExtension();
            $extension 	 = $file->getClientOriginalExtension();
            $folder_name = "demarcation_plan";

            if ($extension == "pdf"){
            	Storage::disk('ftp')->delete($request->oldFileName);
                $path 	= $folder_name.'/'.$file_name;
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$file,$file_name);
                ConveyanceSalePriceCalculation::where('application_id',$applicationId)
                ->update(['demarcation_map' => $path]);
                   
                return back()->with('success','Demarcation Map uploaded successfully.');                         
            } else {
                return back()->with('pdf_error', 'Invalid type of file uploaded (only pdf allowed).');
            }

        } 				
	}

	public function SaveCoveringLetter(Request $request){
		
		$applicationId = $request->application_id;

        if ($request->file('covering_letter')){

            $file 		 = $request->file('covering_letter');
            $file_name 	 = time().'_covering_letter_'.$applicationId.'.'.$file->getClientOriginalExtension();
            $extension 	 = $file->getClientOriginalExtension();
            $folder_name = "EE_Covering_Letter";

            if ($extension == "pdf"){
            	Storage::disk('ftp')->delete($request->oldFileName);
                $path 	= $folder_name.'/'.$file_name;
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$file,$file_name);
                ConveyanceSalePriceCalculation::where('application_id',$applicationId)
                ->update(['ee_covering_letter' => $path]);
                   
                return back()->with('success','Covering Letter uploaded successfully.');                         
            } else {
                return back()->with('pdf_error', 'Invalid type of file uploaded (only pdf allowed).');
            }

        } 				
	}	

	public function forwardApplication(Request $request,$applicationId){

		$data = $this->conveyance->getForwardApplicationData($applicationId);
        $data->status = $this->conveyance->getCurrentStatus($applicationId);
		return view('admin.conveyance.ee_department.forward_application', compact('data'));
	}

    public function sendForwardApplication(Request $request){

        $data = $this->conveyance->forwardApplication($request);   
        return redirect('/conveyance')->with('success','Application send successfully.');
    }
}
