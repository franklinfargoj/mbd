<?php

namespace App\Http\Controllers\conveyance\EEDepartment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\conveyance\ConveyanceSalePriceCalculation;
use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\conveyance\conveyanceCommonController;
use App\conveyance\scApplication;
use App\conveyance\RenewalApplication;
use App\conveyance\RenewalEEScrutinyDocuments;
use Storage; 
use Auth;

class EEController extends Controller
{
    public function __construct()
    {
        $this->CommonController = new CommonController();       
        $this->conveyance 		= new conveyanceCommonController();       
    }

	public function SalePriceCalculation(Request $request,$applicationId){
	
		$data = scApplication::with('ConveyanceSalePriceCalculation')->where('id',$applicationId)->first();
        $data->status = $this->conveyance->getCurrentStatus($applicationId,$data->sc_application_master_id);
        $is_view = session()->get('role_name') == config('commanConfig.ee_junior_engineer');
        
        if ($is_view && $data->status->status_id == config('commanConfig.applicationStatus.in_process')){

            $route = 'admin.conveyance.ee_department.sale_price_calculation';
        }else{
            $route = 'admin.conveyance.common.view_ee_sale_price_calculation'; 
            $data->folder = 'ee_department'; 
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

		$data     = $this->conveyance->getForwardApplicationData($applicationId);
        $dycoLogs = $this->conveyance->getLogsOfDYCODepartment($applicationId,$data->sc_application_master_id);
        $eelogs   = $this->conveyance->getLogsOfEEDepartment($applicationId,$data->sc_application_master_id);
        $Architectlogs   = $this->conveyance->getLogsOfArchitectDepartment($applicationId,$data->sc_application_master_id);
        
		return view('admin.conveyance.ee_department.forward_application',compact('data','dycoLogs','eelogs','Architectlogs'));
	}

    public function sendForwardApplication(Request $request){

        $data = $this->conveyance->forwardApplication($request);   
        return redirect('/conveyance')->with('success','Application send successfully.');
    }

    // Renewal

    // upload ee scrunity documents through ajax
    public function uploadRenewalScrutinyDocument(Request $request){
       
        $file = $request->file('file');
        $applicationId = $request->application_id;

        if ($file->getClientMimeType() == 'application/pdf') {

            $extension = $request->file('file')->getClientOriginalExtension();
            $folderName = 'Renewal_ee_scrunity_documents';
            $fileName = time().'_ee_scrutiny_'.$applicationId.'.'.$extension;

            $this->CommonController->ftpFileUpload($folderName,$file,$fileName);
            
            $Documents = new RenewalEEScrutinyDocuments();
            $Documents->application_id = $applicationId;
            $Documents->user_id = Auth::id();
            $Documents->document_path = $folderName.'/'.$fileName;
            $Documents->save();

            $status = 'success';  
        }else{
             $status = 'error';   
        }
        return $status;
    }

    //save scrunity data fil by EE
    public function SaveScrutinyRemark(Request $request){

        $applicationId = $request->application_id; 
        
        $data = RenewalApplication::where('id',$applicationId)->first();
        if ($data){
            RenewalApplication::where('id',$applicationId)->update(['change_in_use' => $request->change_in_use, 'change_in_structure' => $request->change_in_structure , 'encroachment' => $request->encroachment]);   
        }
        return back()->with('success','Data uploaded successfully.');

    }

    // delete ee scrutiny documents through ajax
    public function deleteRenewalScrutinyDocument(Request $request){
            
        if (isset($request->oldFile) && isset($request->key)){
            Storage::disk('ftp')->delete($request->oldFile);
            RenewalEEScrutinyDocuments::where('id',$request->key)->delete(); 
            $status = 'success';           
        }else{
             $status = 'error';
        }
        return $status;
    }
}
