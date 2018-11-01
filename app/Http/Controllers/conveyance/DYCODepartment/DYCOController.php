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
use App\conveyance\ScAgreementTypeMasterModel;
use App\conveyance\ScAgreementTypeStatus;
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

    // draft sale and lease deed Agreement
    public function saleLeaseAgreement(Request $request,$applicationId){

        $data = scApplication::with(['scApplicationLog'])->where('id',$applicationId)->first();
        $draftSaleId  = $this->common->getScAgreementId(config('commanConfig.scAgreements.draft_sale_agreement'));       
        $draftLeaseId  = $this->common->getScAgreementId(config('commanConfig.scAgreements.draft_lease_agreement'));

        $data->DraftSaleAgreement  = $this->common->getScAgreement($draftSaleId,$applicationId);
        $data->DraftLeaseAgreement = $this->common->getScAgreement($draftLeaseId,$applicationId);

        $is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer');
        $status = $this->common->getCurrentStatus($applicationId);

        $data->AgreementComments = ScAgreementComments::with('Roles')->where('application_id',$applicationId)->whereNotNull('remark')->get();

        if ($is_view && $status->status_id == config('commanConfig.applicationStatus.in_process')) {
            $route = 'admin.conveyance.dyco_department.sale_lease_agreement';
        }else{
            $route = 'admin.conveyance.common.view_draft_sale_lease_agreements';
        }

        return view($route,compact('data','is_view','status'));
    }

    public function saveAgreement(Request $request){

        $applicationId   = $request->applicationId;
        $sale_agreement  = $request->file('sale_agreement');   
        $lease_agreement = $request->file('lease_agreement'); 

        
        $sale_folder_name  = "sale_deed_agreement";
        $lease_folder_name = "lease_deed_agreement";
        
        if ($sale_agreement) {
            $sale_extension  = $sale_agreement->getClientOriginalExtension(); 
            $sale_file_name  = time().'_sale_'.$applicationId.'.'.$sale_extension; 
            $sale_file_path  = $sale_folder_name.'/'.$sale_file_name; 
            $draftSaleId     = $this->common->getScAgreementId(config('commanConfig.scAgreements.draft_sale_agreement'));

            if ($sale_extension == "pdf"){
                
                $sale_upload = $this->CommonController->ftpFileUpload($sale_folder_name,$request->file('sale_agreement'),$sale_file_name); 
                $saleData = $this->common->getScAgreement($draftSaleId,$applicationId);

                if ($saleData){
                    $this->common->updateScAgreement($applicationId,$draftSaleId,$sale_file_path);
                }else{
                    $this->common->createScAgreement($applicationId,$draftSaleId,$sale_file_path);               
                }
                $status = 'success';
            }            
        } 
        if ($lease_agreement) {

            $lease_extension = $lease_agreement->getClientOriginalExtension(); 
            $lease_file_name = time().'_lease_'.$applicationId.'.'.$lease_extension;
            $lease_file_path = $lease_folder_name.'/'.$lease_file_name;
            $draftLeaseId = $this->common->getScAgreementId(config('commanConfig.scAgreements.draft_lease_agreement'));
            
            if ($lease_extension == "pdf") {

                $lease_upload = $this->CommonController->ftpFileUpload($lease_folder_name,$request->file('lease_agreement'),$lease_file_name);
                $leaseData = $this->common->getScAgreement($draftLeaseId,$applicationId);
                if ($leaseData){
                    $this->common->updateScAgreement($applicationId,$draftLeaseId,$lease_file_path);                    
                }else{
                    $this->common->createScAgreement($applicationId,$draftLeaseId,$lease_file_path);
                }
                $status = 'success';                
            }            
        }

        if ($request->remark){
          $this->common->ScAgreementComment($applicationId,$request->remark);  
        }
        
        if (isset($status) && $status == 'success'){
            return back()->with('success', 'Agreements uploaded successfully.'); 
        } else{
            return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
        }        
    }

    public function ApprovedSaleLeaseAgreement(Request $request,$applicationId){

        $approvedSaleId  = $this->common->getScAgreementId(config('commanConfig.scAgreements.approve_sale_agreement'));
        $approvedLeaseId = $this->common->getScAgreementId(config('commanConfig.scAgreements.approve_lease_agreement'));        
        $data = scApplication::with(['scApplicationLog'])->where('id',$applicationId)->first();
        
        $data->ApprovedSaleAgreement  = $this->common->getScAgreement($approvedSaleId,$applicationId);
        $data->ApprovedLeaseAgreement = $this->common->getScAgreement($approvedLeaseId,$applicationId);

        return view('admin.conveyance.dyco_department.approved_sale_lease_agreement',compact('data'));      
    }    

    public function StampedSaleLeaseAgreement(Request $request,$applicationId){
    
        $data = scApplication::with(['scApplicationLog'])->where('id',$applicationId)->first();

        $StampSaleId  = $this->common->getScAgreementId(config('commanConfig.scAgreements.stamp_sale_agreement'));
        $StampLeaseId = $this->common->getScAgreementId(config('commanConfig.scAgreements.stamp_lease_agreement'));

        $data->StampSaleAgreement  = $this->common->getScAgreement($StampSaleId,$applicationId);
        $data->StampLeaseAgreement = $this->common->getScAgreement($StampLeaseId,$applicationId);                

        dd($data);
        // return view('admin.conveyance.dyco_department.approved_sale_lease_agreement',compact('data'));      
    } 

    public function SignedSaleLeaseAgreement(Request $request,$applicationId){
    
        $data = scApplication::with(['scApplicationLog'])->where('id',$applicationId)->first();

        $SignSaleId  = $this->common->getScAgreementId(config('commanConfig.scAgreements.stamp_sign_sale_agreement'));
        $SignLeaseId = $this->common->getScAgreementId(config('commanConfig.scAgreements.stamp_sign_lease_agreement'));

        $data->StampSignSaleAgreement  = $this->common->getScAgreement($SignSaleId,$applicationId);
        $data->StampSignLeaseAgreement = $this->common->getScAgreement($SignLeaseId,$applicationId);

        $is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer');
        $status = $this->common->getCurrentStatus($applicationId);  
        
        $data->AgreementComments = ScAgreementComments::with('Roles')->where('application_id',$applicationId)->whereNotNull('remark')->get();  

        if ($is_view && $status->status_id == config('commanConfig.applicationStatus.in_process')) {
            $route = 'admin.conveyance.dyco_department.stamp_sign_agreements';
        }else{
            $route = 'admin.conveyance.common.view_stamp_sign_agreements';
        }                          

        return view($route,compact('data','is_view','status'));      
    }

    public function SaveStampSignAgreement(Request $request){

        $applicationId   = $request->applicationId;
        $sale_agreement  = $request->file('sale_agreement');   
        $lease_agreement = $request->file('lease_agreement'); 

        
        $sale_folder_name  = "Stamp_Sign_Sale_deed_agreement";
        $lease_folder_name = "Stamp_Sign_Lease_deed_agreement";
        
        if ($sale_agreement) {
            
            $sale_extension  = $sale_agreement->getClientOriginalExtension(); 
            $sale_file_name  = time().'_sale_'.$applicationId.'.'.$sale_extension; 
            $sale_file_path  = $sale_folder_name.'/'.$sale_file_name; 
            $stampSignSaleId = $this->common->getScAgreementId(config('commanConfig.scAgreements.stamp_sign_sale_agreement'));
            $stampSignLeaseId = $this->common->getScAgreementId(config('commanConfig.scAgreements.stamp_sign_lease_agreement'));

            if ($sale_extension == "pdf"){
                
                $sale_upload = $this->CommonController->ftpFileUpload($sale_folder_name,$request->file('sale_agreement'),$sale_file_name); 
                $saleData = $this->common->getScAgreement($stampSignSaleId,$applicationId);

                if ($saleData){
                    $this->common->updateScAgreement($applicationId,$stampSignSaleId,$sale_file_path);
                }else{
                    $this->common->createScAgreement($applicationId,$stampSignSaleId,$sale_file_path);               
                }
                $status = 'success';
            }            
        } 
        if ($lease_agreement) {

            $lease_extension = $lease_agreement->getClientOriginalExtension(); 
            $lease_file_name = time().'_lease_'.$applicationId.'.'.$lease_extension;
            $lease_file_path = $lease_folder_name.'/'.$lease_file_name;
           
            
            if ($lease_extension == "pdf") {

                $lease_upload = $this->CommonController->ftpFileUpload($lease_folder_name,$request->file('lease_agreement'),$lease_file_name);
                $leaseData = $this->common->getScAgreement($stampSignLeaseId,$applicationId);
                if ($leaseData){
                    $this->common->updateScAgreement($applicationId,$stampSignLeaseId,$lease_file_path);                    
                }else{
                    $this->common->createScAgreement($applicationId,$stampSignLeaseId,$lease_file_path);
                }
                $status = 'success';                
            }            
        }

        if ($request->remark){
          $this->common->ScAgreementComment($applicationId,$request->remark);  
        }
        
        if (isset($status) && $status == 'success'){
            return back()->with('success', 'Agreements uploaded successfully.'); 
        } else{
            return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
        }         

    }  

    public function RegisterSaleLeaseAgreement(Request $request,$applicationId){
    
        $data = scApplication::with(['scApplicationLog'])->where('id',$applicationId)->first();

        $RegSaleId  = $this->common->getScAgreementId(config('commanConfig.scAgreements.stamp_sign_sale_agreement'));
        $RegLeaseId = $this->common->getScAgreementId(config('commanConfig.scAgreements.stamp_sign_lease_agreement'));

        $data->RegisterSaleAgreement  = $this->common->getScAgreement($RegSaleId,$applicationId);
        $data->RegisterLeaseAgreement = $this->common->getScAgreement($RegLeaseId,$applicationId);

        $is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer');
        $status = $this->common->getCurrentStatus($applicationId);  
        
        $data->AgreementComments = ScAgreementComments::with('Roles')->where('application_id',$applicationId)->whereNotNull('remark')->get();                 

        return view('admin.conveyance.dyco_department.register_sale_lease_agreements',compact('data','status'));      
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

    // NOC for conveyance
    public function conveyanceNOC(Request $request,$applicationId){
        $data = scApplication::with(['scApplicationLog'])->where('id',$applicationId)->first();    
        return view('admin.conveyance.dyco_department.conveyance_noc',compact('data'));
    }
}

