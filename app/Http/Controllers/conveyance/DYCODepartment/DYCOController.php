<?php

namespace App\Http\Controllers\conveyance\DYCODepartment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\conveyance\conveyanceCommonController;
use App\Http\Controllers\Common\CommonController;
// use App\conveyance\ConveyanceChecklistScrutiny;
use App\conveyance\scApplication;
use App\conveyance\ScApplicationAgreements;
use App\ApplicationStatusMaster;
use App\conveyance\ScAgreementComments;
use App\conveyance\ScChecklistMaster;
use App\conveyance\ScChecklistScrutinyStatus;
use App\conveyance\ScAgreementTypeMasterModel;
use App\conveyance\ScAgreementTypeStatus;
use App\conveyance\scApplicationLog;
use Config;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Storage;
use Auth;

class DYCOController extends Controller
{
    public function __construct()
    {
        $this->common = new conveyanceCommonController();
        $this->CommonController = new CommonController();
        $this->SaleAgreement  = config('commanConfig.scAgreements.sale_deed_agreement');
        $this->LeaseAgreement = config('commanConfig.scAgreements.lease_deed_agreement');
    }   

    //display checklist and office note page
    public function showChecklist(Request $request,$applicationId){

        $data = scApplication::with('ConveyanceSalePriceCalculation')->where('id',$applicationId)->first();
        $type = '1';
        $language_id = '2';
        $checklist = ScChecklistMaster::with(['checklistStatus' => function ($q) use ($applicationId) {
            $q->where('application_id', $applicationId);
        }])->where('type_id',$type)->where('language_id',$language_id)->get();

        $is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer');
        $data->status = $this->common->getCurrentStatus($applicationId,$data->sc_application_master_id);

        if ($is_view && $data->status->status_id == config('commanConfig.applicationStatus.Draft_sale_&_lease_deed')) {
            $route = 'admin.conveyance.dyco_department.checklist_office_note';
        }else{
            $route = 'admin.conveyance.common.view_checklist_office_note';
        }

        //get dycdo note from sc document status table
        $document  = config('commanConfig.documents.dycdo_note');
        $documentId = $this->common->getDocumentId($document,$data->sc_application_master_id);
        $dycdo_note = $this->common->getDocumentStatus($applicationId,$documentId);
        
        return view($route,compact('data','checklist','dycdo_note'));
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
            $file_name = time().'_dycdo_note_'.$applicationId.'.'.$file->getClientOriginalExtension();

            $extension = $file->getClientOriginalExtension();
            $folder_name = "conveyance_dycdo_note";

            if ($extension == "pdf"){
                $path = $folder_name.'/'.$file_name;
                $delete = Storage::disk('ftp')->delete($request->old_file_name);
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$file,$file_name);

                // save document to sc document status table
                $document  = config('commanConfig.documents.dycdo_note');
                $this->common->uploadDocumentStatus($applicationId,$document,$path);

                return back()->with('success','Note uploaded successfully.');                         
            } else {
                return back()->with('pdf_error', 'Invalid type of file uploaded (only pdf allowed).');
            }
        }         
    }

    // draft sale and lease deed Agreement
    public function saleLeaseAgreement(Request $request,$applicationId){

        $data = scApplication::with(['scApplicationLog','ConveyanceSalePriceCalculation'])
        ->where('id',$applicationId)->first();
        
        $Applicationtype= $data->sc_application_master_id;
        // add $this->SaleAgreement
        $SaleAgreement  = config('commanConfig.scAgreements.sale_deed_agreement');
        $LeaseAgreement = config('commanConfig.scAgreements.lease_deed_agreement');
        $Agreementstatus = ApplicationStatusMaster::where('status_name','=','Draft')->value('id');
      
        $draftSaleId   = $this->common->getScAgreementId($SaleAgreement,$Applicationtype);
        $draftLeaseId  = $this->common->getScAgreementId($LeaseAgreement,$Applicationtype);

        $data->DraftSaleAgreement  = $this->common->getScAgreement($draftSaleId,$applicationId,$Agreementstatus);
        $data->DraftLeaseAgreement = $this->common->getScAgreement($draftLeaseId,$applicationId,$Agreementstatus);

        $is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer');
        $data->status = $this->common->getCurrentStatus($applicationId,$data->sc_application_master_id);

        $data->AgreementComments = ScAgreementComments::with('Roles')->where('application_id',$applicationId)->where('agreement_type_id',$Applicationtype)->whereNotNull('remark')->get();

        $data->folder = $this->common->getCurrentRoleFolderName();

        if ($is_view && $data->status->status_id == config('commanConfig.applicationStatus.Draft_sale_&_lease_deed')) {
            $route = 'admin.conveyance.dyco_department.sale_lease_agreement';
        }else{
            $route = 'admin.conveyance.common.view_draft_sale_lease_agreements';
        }
        return view($route,compact('data','is_view','status'));
    }

    //save draft lease and sale Agreement
    public function saveAgreement(Request $request){

        $applicationId   = $request->applicationId;
        $sale_agreement  = $request->file('sale_agreement');   
        $lease_agreement = $request->file('lease_agreement'); 
        
        $data = scApplication::where('id',$applicationId)->first();        
        $Applicationtype= $data->sc_application_master_id;

        //add $this->SaleAgreement
        $SaleAgreement  = config('commanConfig.scAgreements.sale_deed_agreement');
        $LeaseAgreement = config('commanConfig.scAgreements.lease_deed_agreement');  
        $Agrstatus = ApplicationStatusMaster::where('status_name','=','Draft')->value('id');          

        $sale_folder_name  = "Draft_Sale_Deed_Agreement";
        $lease_folder_name = "Draft_Lease_Deed_Agreement";
        
        if ($sale_agreement) {
            $sale_extension  = $sale_agreement->getClientOriginalExtension(); 
            $sale_file_name  = time().'_sale_'.$applicationId.'.'.$sale_extension; 
            $sale_file_path  = $sale_folder_name.'/'.$sale_file_name; 
            $draftSaleId     = $this->common->getScAgreementId($SaleAgreement,$Applicationtype);
           

            if ($sale_extension == "pdf"){
                Storage::disk('ftp')->delete($request->oldSaleFile);
                $sale_upload = $this->CommonController->ftpFileUpload($sale_folder_name,$sale_agreement,$sale_file_name); 
                $saleData = $this->common->getScAgreement($draftSaleId,$applicationId,$Agrstatus);

                if ($saleData){
                    $this->common->updateScAgreement($applicationId,$draftSaleId,$sale_file_path,$Agrstatus);
                }else{
                    $this->common->createScAgreement($applicationId,$draftSaleId,$sale_file_path,$Agrstatus);               
                }
                $status = 'success';
            }            
        } 
        if ($lease_agreement) {

            $lease_extension = $lease_agreement->getClientOriginalExtension(); 
            $lease_file_name = time().'_lease_'.$applicationId.'.'.$lease_extension;
            $lease_file_path = $lease_folder_name.'/'.$lease_file_name;
            $draftLeaseId = $this->common->getScAgreementId($LeaseAgreement,$Applicationtype);
            if ($lease_extension == "pdf") {
                
                Storage::disk('ftp')->delete($request->oldLeaseFile);
                $lease_upload = $this->CommonController->ftpFileUpload($lease_folder_name,$lease_agreement,$lease_file_name);
                $leaseData = $this->common->getScAgreement($draftLeaseId,$applicationId,$Agrstatus);
               
                if ($leaseData){
                    $this->common->updateScAgreement($applicationId,$draftLeaseId,$lease_file_path,$Agrstatus);                    
                }else{
                    $this->common->createScAgreement($applicationId,$draftLeaseId,$lease_file_path,$Agrstatus);
                }
                $status = 'success';                
            }            
        }

        if ($request->remark){
          $this->common->ScAgreementComment($applicationId,$request->remark,$Applicationtype);  
        }
        
        if (isset($status) && $status == 'success'){
            return back()->with('success', 'Agreements uploaded successfully.'); 
        } else{
            return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
        }        
    }

    public function ApprovedSaleLeaseAgreement(Request $request,$applicationId){

        $data = scApplication::with('ConveyanceSalePriceCalculation')->where('id',$applicationId)->first();
        $Applicationtype= $data->sc_application_master_id;
        $Agreementstatus = ApplicationStatusMaster::where('status_name','=','Approved')->value('id');

        $approvedSaleId   = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype);
        $approvedLeaseId  = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype);    

        $data->ApprovedSaleAgreement  = $this->common->getScAgreement($approvedSaleId,$applicationId,$Agreementstatus);
        $data->ApprovedLeaseAgreement = $this->common->getScAgreement($approvedLeaseId,$applicationId,$Agreementstatus);                    
        $data->is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer'); 
        $data->status = $this->common->getCurrentStatus($applicationId,$data->sc_application_master_id);   

        $data->AgreementComments = ScAgreementComments::with('Roles')->where('application_id',$applicationId)->where('agreement_type_id',$Applicationtype)->whereNotNull('remark')->get();  

        $data->folder = $this->common->getCurrentRoleFolderName();

        if ($data->is_view && $data->status->status_id == config('commanConfig.applicationStatus.Aproved_sale_&_lease_deed')) {
            $route = 'admin.conveyance.dyco_department.approved_sale_lease_agreement';
        }else{
            $route = 'admin.conveyance.common.view_approved_sale_lease_agreement';
        }   

        return view($route,compact('data'));      
    } 

    //save Approved lease and sale Agreement
    public function saveApprovedAgreement(Request $request){
        
        $applicationId   = $request->applicationId;
        $sale_agreement  = $request->file('sale_agreement');   
        $lease_agreement = $request->file('lease_agreement'); 
    
        $data = scApplication::where('id',$applicationId)->first();           
        $Applicationtype= $data->sc_application_master_id; 
       
        $sale_folder_name  = "Approved_sale_deed_agreement";
        $lease_folder_name = "Approved_lease_deed_agreement";

        $Agrstatus = ApplicationStatusMaster::where('status_name','=','Approved')->value('id'); 
        
        if ($sale_agreement) {
            $sale_extension  = $sale_agreement->getClientOriginalExtension(); 
            $sale_file_name  = time().'_sale_'.$applicationId.'.'.$sale_extension; 
            $sale_file_path  = $sale_folder_name.'/'.$sale_file_name; 
            $SaleId = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype);
            
            if ($sale_extension == "pdf"){
                
                Storage::disk('ftp')->delete($request->oldSaleFile);
                $sale_upload = $this->CommonController->ftpFileUpload($sale_folder_name,$sale_agreement,$sale_file_name); 
                $saleData = $this->common->getScAgreement($SaleId,$applicationId,$Agrstatus);

                if ($saleData){
                    $this->common->updateScAgreement($applicationId,$SaleId,$sale_file_path,$Agrstatus);
                }else{
                    $this->common->createScAgreement($applicationId,$SaleId,$sale_file_path,$Agrstatus);               
                }
                $status = 'success';
            }            
        } 
        if ($lease_agreement) {

            $lease_extension = $lease_agreement->getClientOriginalExtension(); 
            $lease_file_name = time().'_lease_'.$applicationId.'.'.$lease_extension;
            $lease_file_path = $lease_folder_name.'/'.$lease_file_name;
            $LeaseId = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype);
            
            if ($lease_extension == "pdf") {

                Storage::disk('ftp')->delete($request->oldLeaseFile);
                $lease_upload = $this->CommonController->ftpFileUpload($lease_folder_name,$lease_agreement,$lease_file_name);

                $leaseData = $this->common->getScAgreement($LeaseId,$applicationId,$Agrstatus);
                if ($leaseData){
                    $this->common->updateScAgreement($applicationId,$LeaseId,$lease_file_path,$Agrstatus);                    
                }else{
                    $this->common->createScAgreement($applicationId,$LeaseId,$lease_file_path,$Agrstatus);
                }
                $status = 'success';                
            }            
        }

        if ($request->remark){
          $this->common->ScAgreementComment($applicationId,$request->remark,$Applicationtype);  
        }
        
        if (isset($status) && $status == 'success'){
            return back()->with('success', 'Agreements uploaded successfully.'); 
        } else{
            return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
        }        
    }       

    public function StampedSaleLeaseAgreement(Request $request,$applicationId){
    
        $data = scApplication::with('ConveyanceSalePriceCalculation')->where('id',$applicationId)->first();
        $Applicationtype= $data->sc_application_master_id;
        $Agreementstatus = ApplicationStatusMaster::where('status_name','=','Stamped')->value('id');
        $data->status = $this->common->getCurrentStatus($applicationId,$data->sc_application_master_id);

        $StampSaleId  = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype,$Agreementstatus);
        $StampLeaseId = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype,$Agreementstatus);

        $data->StampSaleAgreement  = $this->common->getScAgreement($StampSaleId,$applicationId,$Agreementstatus);
        $data->StampLeaseAgreement = $this->common->getScAgreement($StampLeaseId,$applicationId,$Agreementstatus);

        $data->AgreementComments = ScAgreementComments::with('Roles')->where('application_id',$applicationId)->where('agreement_type_id',$Applicationtype)->whereNotNull('remark')->get();   

        $data->folder = $this->common->getCurrentRoleFolderName(); 

        $data->is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer'); 
        $data->status = $this->common->getCurrentStatus($applicationId,$data->sc_application_master_id);                     
        return view('admin.conveyance.common.view_stamp_duty_agreement',compact('data'));      
    } 

    public function SignedSaleLeaseAgreement(Request $request,$applicationId){
    
        $data = scApplication::with('ConveyanceSalePriceCalculation')->where('id',$applicationId)->first();
        $Applicationtype= $data->sc_application_master_id;
        $Agreementstatus = ApplicationStatusMaster::where('status_name','=','Stamped_Signed')->value('id');

        $SignSaleId  = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype,$Agreementstatus);
        $SignLeaseId = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype,$Agreementstatus);

        $data->StampSignSaleAgreement  = $this->common->getScAgreement($SignSaleId,$applicationId,$Agreementstatus);
        $data->StampSignLeaseAgreement = $this->common->getScAgreement($SignLeaseId,$applicationId,$Agreementstatus);

        $is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer');
        $status = $this->common->getCurrentStatus($applicationId,$data->sc_application_master_id);  
   
        $data->AgreementComments = ScAgreementComments::with('Roles')->where('application_id',$applicationId)->where('agreement_type_id',$Applicationtype)->whereNotNull('remark')->get(); 

        $data->folder = $this->common->getCurrentRoleFolderName();

        if ($is_view && $status->status_id == config('commanConfig.applicationStatus.Stamped_signed_sale_&_lease_deed')) {
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
        
        $data = scApplication::where('id',$applicationId)->first();
        $Applicationtype= $data->sc_application_master_id; 
        $Agrstatus = ApplicationStatusMaster::where('status_name','=','Stamped_Signed')->value('id');

        if ($sale_agreement) {
            
            $sale_extension  = $sale_agreement->getClientOriginalExtension(); 
            $sale_file_name  = time().'_sale_'.$applicationId.'.'.$sale_extension; 
            $sale_file_path  = $sale_folder_name.'/'.$sale_file_name; 
            $stampSignSaleId = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype);
            $stampSignLeaseId = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype);

            if ($sale_extension == "pdf"){
                Storage::disk('ftp')->delete($request->oldSaleFile);
                $sale_upload = $this->CommonController->ftpFileUpload($sale_folder_name,$sale_agreement,$sale_file_name); 
                $saleData = $this->common->getScAgreement($stampSignSaleId,$applicationId,$Agrstatus);

                if ($saleData){
                    $this->common->updateScAgreement($applicationId,$stampSignSaleId,$sale_file_path,$Agrstatus);
                }else{
                    $this->common->createScAgreement($applicationId,$stampSignSaleId,$sale_file_path,$Agrstatus);               
                }
                $status = 'success';
            }            
        } 
        if ($lease_agreement) {

            $lease_extension = $lease_agreement->getClientOriginalExtension(); 
            $lease_file_name = time().'_lease_'.$applicationId.'.'.$lease_extension;
            $lease_file_path = $lease_folder_name.'/'.$lease_file_name;
           
            
            if ($lease_extension == "pdf") {
                Storage::disk('ftp')->delete($request->oldSaleFile);
                $lease_upload = $this->CommonController->ftpFileUpload($lease_folder_name,$lease_agreement,$lease_file_name);
                $leaseData = $this->common->getScAgreement($stampSignLeaseId,$applicationId,$Agrstatus);
                if ($leaseData){
                    $this->common->updateScAgreement($applicationId,$stampSignLeaseId,$lease_file_path,$Agrstatus);                    
                }else{
                    $this->common->createScAgreement($applicationId,$stampSignLeaseId,$lease_file_path,$Agrstatus);
                }
                $status = 'success';                
            }            
        }

        if ($request->remark){
          $this->common->ScAgreementComment($applicationId,$request->remark,$Applicationtype);  
        }
        
        if (isset($status) && $status == 'success'){
            return back()->with('success', 'Agreements uploaded successfully.'); 
        } else{
            return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
        }         

    }  

    public function RegisterSaleLeaseAgreement(Request $request,$applicationId){
    
        $data = scApplication::with(['scApplicationLog','ConveyanceSalePriceCalculation'])
        ->where('id',$applicationId)->first();
        $Applicationtype= $data->sc_application_master_id;
        $Agreementstatus = ApplicationStatusMaster::where('status_name','=','Stamped_Signed')->value('id');        

        $RegSaleId  = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype,$Agreementstatus);
        $RegLeaseId = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype,$Agreementstatus);

        $data->RegisterSaleAgreement  = $this->common->getScAgreement($RegSaleId,$applicationId,$Agreementstatus);
        $data->RegisterLeaseAgreement = $this->common->getScAgreement($RegLeaseId,$applicationId,$Agreementstatus);

        $is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer');
        $data->status = $this->common->getCurrentStatus($applicationId,$data->sc_application_master_id);  
        
        $data->AgreementComments = ScAgreementComments::with('Roles')->where('application_id',$applicationId)->where('agreement_type_id',$Applicationtype)->whereNotNull('remark')->get();    

        $data->folder = $this->common->getCurrentRoleFolderName(); 
        $data->is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer'); 
        $data->status = $this->common->getCurrentStatus($applicationId,$data->sc_application_master_id);

        if ($data->is_view && $data->status->status_id == config('commanConfig.applicationStatus.in_process')) {
            $route = 'admin.conveyance.dyco_department.register_sale_lease_agreements';
        }else{
            $route = 'admin.conveyance.common.view_register_sale_lease_agreements';
        }                              

        return view($route,compact('data','status'));      
    }       
 
    public function saveForwardApplication(Request $request){
    
        $forwardData = $this->common->forwardApplication($request); 
        return redirect('/conveyance')->with('success','Application send successfully..');
    }

    // NOC for conveyance
    public function conveyanceNOC(Request $request,$applicationId){

        $data = scApplication::with(['scApplicationLog','ConveyanceSalePriceCalculation'])->where('id',$applicationId)->first();  
        $data->is_view = session()->get('role_name') == config('commanConfig.dyco_engineer'); 
        $data->status = $this->common->getCurrentStatus($applicationId,$data->sc_application_master_id); 
        return view('admin.conveyance.dyco_department.conveyance_noc',compact('data'));
    }

    //send application to society
    public function SendToSociety(Request $request){

        $applicationId = $request->applicationId; 
        $data = scApplication::with(['societyApplication','societyApplication.roleUser','ConveyanceSalePriceCalculation'])->where('id',$applicationId)->first();
        
        $to_role_id = $data->societyApplication->roleUser->role_id;    
        $to_user_id = $data->societyApplication->roleUser->id;  

            $application = [[
                'application_id' => $request->applicationId,
                'user_id'        => Auth::user()->id,
                'role_id'        => session()->get('role_id'),
                'status_id'      => config('commanConfig.applicationStatus.forwarded'),
                'society_flag'   => '0',
                'application_master_id' => $data->sc_application_master_id,
                'to_user_id'     => $to_user_id,
                'to_role_id'     => $to_role_id,
                'created_at'     => Carbon::now(),
            ],
            [
                'application_id' => $request->applicationId,
                'user_id'       => $to_user_id,
                'role_id'       => $to_role_id,
                'status_id'     => $data->application_status,
                'society_flag'  => '1',
                'application_master_id' => $data->sc_application_master_id,
                'to_user_id'    => null,
                'to_role_id'    => null,
                'created_at'    => Carbon::now(),
            ],
            ];
            scApplicationLog::insert($application); 
            return back()->with('success','Application Send Successfully.');        
    }
}

