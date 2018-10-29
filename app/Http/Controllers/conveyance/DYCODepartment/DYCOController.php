<?php

namespace App\Http\Controllers\conveyance\DYCODepartment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\conveyance\conveyanceCommonController;
use App\Http\Controllers\Common\CommonController;
// use App\conveyance\ConveyanceChecklistScrutiny;
use App\conveyance\scApplication;
use App\conveyance\ScApplicationAgreements;
use App\conveyance\ScAgreementComments;
use App\conveyance\ScChecklistMaster;
use App\conveyance\ScChecklistScrutinyStatus;
use Config;
use Yajra\DataTables\DataTables;
use Storage;
use Auth;

class DYCOController extends Controller
{
    public function __construct()
    {
        $this->common = new conveyanceCommonController();
        $this->CommonController = new CommonController();
    }	

    //display checklist and office note page
    public function showChecklist(Request $request,$applicationId){

        $data = scApplication::where('id',$applicationId)->first();
        $type = '1';
        $language_id = '2';
        $checklist = ScChecklistMaster::with(['checklistStatus' => function ($q) use ($applicationId) {
            $q->where('application_id', $applicationId);
        }])->where('type_id',$type)->where('language_id',$language_id)->get();

        $is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer');
        $status = $this->common->getCurrentStatus($applicationId);
        
        if ($is_view && $status->status_id == config('commanConfig.applicationStatus.in_process')) {
            $route = 'admin.conveyance.dyco_department.checklist_office_note';
        }else{
            $route = 'admin.conveyance.common.view_checklist_office_note';
        }
        
    	return view($route,compact('data','checklist'));
    }

    // save/update checklist data
    public function storeChecklistData(Request $request){

        $applicationId = $request->application_id;
        $arrData = $request->all();
        unset($arrData['_token'],$arrData['application_id']);
        foreach($arrData as $key => $value){
            $exist = ScChecklistScrutinyStatus::where('application_id',$applicationId)->where('user_id',Auth::Id())
            ->where('checklist_id',$key)->first();
            if ($exist){
               $checklist = ScChecklistScrutinyStatus::where('application_id',$applicationId)->where('user_id',Auth::Id())
            ->where('checklist_id',$key)->update(['value' => $value]); 
            } else {
                $data = ['application_id' => $applicationId,
                'user_id' => Auth::Id(),
                'checklist_id' => $key,
                'value' => $value
                ];

                ScChecklistScrutinyStatus::Create($data);
            }
        }

        return back()->with('success','data save Successfully.');
    }

    public function uploadNote(Request $request){
      
        $applicationId = $request->application_id;
        if ($request->file('dycdo_note')){

            $file = $request->file('dycdo_note');
            $file_name = time().'_dycdo_note'.'.'.$file->getClientOriginalExtension();

            $extension = $file->getClientOriginalExtension();
            $folder_name = "conveyance_dycdo_note";

            if ($extension == "pdf"){
                $path = $folder_name.'/'.$file_name;
                $delete = Storage::disk('ftp')->delete($request->old_file_name);
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('dycdo_note'),$file_name);

                $note = ConveyanceChecklistScrutiny::where('application_id',$applicationId)
                ->update(['dyco_note' => $path]);
                   
                return back()->with('success','Note uploaded successfully.');                         
            } else {
                return back()->with('pdf_error', 'Invalid type of file uploaded (only pdf allowed).');
            }
        }         
    }

    public function saleLeaseAgreement(Request $request,$applicationId){

        $data = scApplication::with(['scApplicationAgreement','ScAgreementComments','ScAgreementComments.Roles','scApplicationLog'])->where('id',$applicationId)->first();
        // dd($data);
        return view('admin.conveyance.dyco_department.sale_lease_agreement',compact('data'));
    }

    public function saveAgreement(Request $request){
 
        $applicationId   = $request->applicationId;
        $sale_agreement  = $request->file('sale_agreement');   
        $lease_agreement = $request->file('lease_agreement'); 
        
        $sale_file_name  = time().'_sale_'.'.'.$sale_agreement->getClientOriginalExtension();  
        $lease_file_name = time().'_lease_'.'.'.$lease_agreement->getClientOriginalExtension();
        
        $sale_extension  = $sale_agreement->getClientOriginalExtension(); 
        $lease_extension = $lease_agreement->getClientOriginalExtension(); 
        
        $sale_folder_name  = "sale_deed_agreement";
        $lease_folder_name = "lease_deed_agreement";
        
        $sale_file_path  = $sale_folder_name.'/'.$sale_file_name;
        $lease_file_path = $lease_folder_name.'/'.$lease_file_name;

        if ($sale_agreement && $lease_agreement) {
            
            if ($sale_extension = $lease_extension == "pdf"){

                $sale_upload = $this->CommonController->ftpFileUpload($sale_folder_name,$request->file('sale_agreement'),$sale_file_name);    

                $lease_upload = $this->CommonController->ftpFileUpload($lease_folder_name,$request->file('lease_agreement'),$lease_file_name);

                    $fileData[] = array('draft_sale_agreement'  => $sale_file_path, 
                                        'draft_lease_agreement' => $lease_file_path,
                                        'application_id'        => $applicationId,
                                        'user_id'               => Auth::Id()); 

                    $comments[] = array('application_id' => $applicationId,
                                        'user_id'        => Auth::Id(),
                                        'role_id'        => session()->get('role_id'),
                                        'remark'         => $request->remark);

                    $data   = ScApplicationAgreements::insert($fileData); 
                    $remark = ScAgreementComments::insert($comments);

                    return back()->with('success', 'Agreements uploaded successfully.');         
            }else{
                return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
            }
        }
    }

    public function ApprovedSaleLeaseAgreement(Request $request,$applicationId){
    
        $data = scApplication::with(['scApplicationAgreement','ScAgreementComments','ScAgreementComments.Roles','scApplicationLog'])->where('id',$applicationId)->first();

        return view('admin.conveyance.dyco_department.approved_sale_lease_agreement',compact('data'));      
    }    

    public function StampedSaleLeaseAgreement(Request $request,$applicationId){
    
        $data = scApplication::with(['scApplicationAgreement','ScAgreementComments','ScAgreementComments.Roles','scApplicationLog'])->where('id',$applicationId)->first();

        dd($data);
        // return view('admin.conveyance.dyco_department.approved_sale_lease_agreement',compact('data'));      
    } 

    public function SignedSaleLeaseAgreement(Request $request,$applicationId){
    
        $data = scApplication::with(['scApplicationAgreement','ScAgreementComments','ScAgreementComments.Roles','scApplicationLog'])->where('id',$applicationId)->first();

        return view('admin.conveyance.dyco_department.stamp_sign_agreements',compact('data'));      
    }  

    public function RegisterSaleLeaseAgreement(Request $request,$applicationId){
    
        $data = scApplication::with(['scApplicationAgreement','ScAgreementComments','ScAgreementComments.Roles','scApplicationLog'])->where('id',$applicationId)->first();

        return view('admin.conveyance.dyco_department.register_sale_lease_agreements',compact('data'));      
    }       

    public function displayForwardApplication(Request $request,$applicationId){
      
      $data     = $this->common->getForwardApplicationData($applicationId);
      $dycoLogs = $this->common->getLogsOfDYCODepartment($applicationId);
      return view('admin.conveyance.dyco_department.forward_application',compact('data','dycoLogs'));          
    }
 
    public function saveForwardApplication(Request $request){
    
        $forwardData = $this->common->forwardApplication($request); 
        return redirect('/conveyance')->with('success','Application send successfully..');
    }
}

