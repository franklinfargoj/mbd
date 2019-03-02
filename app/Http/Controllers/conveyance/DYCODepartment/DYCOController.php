<?php

namespace App\Http\Controllers\conveyance\DYCODepartment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\conveyance\conveyanceCommonController;
use App\Http\Controllers\conveyance\renewalCommonController;
use App\Http\Controllers\Common\CommonController;
// use App\conveyance\ConveyanceChecklistScrutiny;
use App\conveyance\scApplication;
use App\conveyance\ScApplicationAgreements;
use App\conveyance\RenewalApplication;
use App\ApplicationStatusMaster;
use App\conveyance\ScAgreementComments;
use App\conveyance\ScChecklistMaster;
use App\conveyance\ScChecklistScrutinyStatus;
use App\conveyance\ScAgreementTypeMasterModel;
use App\conveyance\ScAgreementTypeStatus;
use App\conveyance\scApplicationLog;
use App\conveyance\RenewalDocumentStatus;
use App\conveyance\RenewalApplicationLog;
use App\conveyance\scRegistrationDetails;
use Config;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Storage;
use Auth;
use PDF;
use DB;
use Mpdf\Mpdf;

class DYCOController extends Controller
{
    public function __construct()
    {
        $this->common = new conveyanceCommonController();
        $this->CommonController = new CommonController();
        $this->renewal = new renewalCommonController();
        $this->SaleAgreement  = config('commanConfig.scAgreements.sale_deed_agreement');
        $this->LeaseAgreement = config('commanConfig.scAgreements.lease_deed_agreement');
    }   

    //display checklist and office note page
    public function showChecklist(Request $request,$applicationId){
        $applicationId = decrypt($applicationId);
        $data = scApplication::with('ConveyanceSalePriceCalculation')->where('id',$applicationId)->first();
        $type = '1';
        $language_id = '2';
        $checklist = ScChecklistMaster::with(['checklistStatus' => function ($q) use ($applicationId) {
            $q->where('application_id', $applicationId);
        }])->where('type_id',$type)->where('language_id',$language_id)->get();

        $is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer');
        $data->status = $this->common->getCurrentStatus($applicationId,$data->sc_application_master_id);
        $data->conveyance_map = $this->common->getArchitectSrutiny($applicationId,$data->sc_application_master_id);
        
        if ($is_view && $data->status->status_id != config('commanConfig.conveyance_status.forwarded') && $data->status->status_id != config('commanConfig.conveyance_status.reverted') && $data->status->status_id != config('commanConfig.conveyance_status.Registered_sale_&_lease_deed')) {
            $route = 'admin.conveyance.dyco_department.checklist_office_note';
        }else{
            $route = 'admin.conveyance.common.view_checklist_office_note';
        }
        $data->folder = $this->common->getCurrentRoleFolderName();
        //get dycdo note from sc document status table
        $document  = config('commanConfig.documents.dycdo_note');
        $documentId = $this->common->getDocumentId($document,$data->sc_application_master_id);
        $dycdo_note = $this->common->getDocumentStatus($applicationId,$documentId);
        // dd($applicationId);
        //get em no due certificate
        $data->em_document = $this->common->getEMNoDueCertificate($data->sc_application_master_id,$applicationId);           
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

        $applicationId = decrypt($applicationId);
        $data = scApplication::with(['scApplicationLog','ConveyanceSalePriceCalculation','societyApplication'])
        ->where('id',$applicationId)->first();
        
        $Applicationtype= $data->sc_application_master_id;
        $Agreementstatus = ApplicationStatusMaster::where('status_name','=','Draft')->value('id');
      
        $draftSaleId   = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype);
        $draftLeaseId  = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype);

        $data->DraftSaleAgreement  = $this->common->getScAgreement($draftSaleId,$applicationId,$Agreementstatus);
        $data->DraftLeaseAgreement = $this->common->getScAgreement($draftLeaseId,$applicationId,$Agreementstatus);       

        $is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer');
        $data->status = $this->common->getCurrentStatus($applicationId,$data->sc_application_master_id);

        $data->AgreementComments = ScAgreementComments::with('Roles')->where('application_id',$applicationId)->where('agreement_type_id',$Applicationtype)->whereNotNull('remark')->get();

        $data->folder = $this->common->getCurrentRoleFolderName();
        $data->conveyance_map = $this->common->getArchitectSrutiny($applicationId,$data->sc_application_master_id);
        $data->em_document = $this->common->getEMNoDueCertificate($data->sc_application_master_id,$applicationId);

        //generated draft and text sale and lease agreement

        $draft = ApplicationStatusMaster::where('status_name','=','generate_draft')->value('id');
        $text = ApplicationStatusMaster::where('status_name','=','text')->value('id');
        $data->DraftGeneratedSale = $this->common->getScAgreement($draftSaleId,$applicationId,$draft);
        $data->textSaleAgreement = $this->common->getScAgreement($draftSaleId,$applicationId,$text);
        $data->DraftGeneratedLease = $this->common->getScAgreement($draftLeaseId,$applicationId,$draft);
        $data->textLeaseAgreement = $this->common->getScAgreement($draftLeaseId,$applicationId,$text);
    
        if(isset($data->textSaleAgreement->document_path)){
            $saleContent = Storage::disk('ftp')->get($data->textSaleAgreement->document_path);
        }else{
            $saleContent = "";

        }if(isset($data->textLeaseAgreement->document_path)){
            $leaseContent = Storage::disk('ftp')->get($data->textLeaseAgreement->document_path);
        }else{
            $leaseContent = "";
        }
        if ($is_view && $data->status->status_id == config('commanConfig.conveyance_status.Draft_sale_&_lease_deed')) {
            $route = 'admin.conveyance.dyco_department.sale_lease_agreement';
        }else{
            $route = 'admin.conveyance.common.view_draft_sale_lease_agreements';
        }
        // dd($route);
        return view($route,compact('data','is_view','status','saleContent','leaseContent'));
    }

    //save draft lease and sale Agreement
    public function saveAgreement(Request $request){
        // dd($request);
        $applicationId   = $request->applicationId;
        $sale_agreement  = $request->file('sale_agreement');   
        $lease_agreement = $request->file('lease_agreement'); 
        
        $data = scApplication::where('id',$applicationId)->first();        
        $Applicationtype= $data->sc_application_master_id;

        $Agrstatus = ApplicationStatusMaster::where('status_name','=','Draft')->value('id');          

        $sale_folder_name  = "Conveyance_Draft_Sale_Agreement";
        $lease_folder_name = "Conveyance_Draft_Lease_Agreement";
        
        if ($sale_agreement) {
            $sale_extension  = $sale_agreement->getClientOriginalExtension(); 
            $sale_file_name  = time().'_sale_'.$applicationId.'.'.$sale_extension; 
            $sale_file_path  = $sale_folder_name.'/'.$sale_file_name; 
            $draftSaleId     = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype);
           

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
            $draftLeaseId = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype);
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
            return back()->with('success', 'Agreement Uploaded Successfully.'); 
        } else{
            return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
        }        
    }

    public function ApprovedSaleLeaseAgreement(Request $request,$applicationId){

        $applicationId = decrypt($applicationId);
        $data = scApplication::with('ConveyanceSalePriceCalculation')->where('id',$applicationId)->first();
        $Applicationtype= $data->sc_application_master_id;

        //Aprove status 
        $Agreementstatus = ApplicationStatusMaster::where('status_name','=','Approved')->value('id');
        
        $approvedSaleId   = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype);
        $approvedLeaseId  = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype);    

        $data->ApprovedSaleAgreement  = $this->common->getScAgreement($approvedSaleId,$applicationId,$Agreementstatus);
        $data->ApprovedLeaseAgreement = $this->common->getScAgreement($approvedLeaseId,$applicationId,$Agreementstatus);

        //draft and sign status
        $signstatus = ApplicationStatusMaster::where('status_name','=','Draft_Sign')->value('id');
        $signSaleId   = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype);
        $signLeaseId  = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype);    

        $data->SignSaleAgreement  = $this->common->getScAgreement($signSaleId,$applicationId,$signstatus);
        $data->SignLeaseAgreement = $this->common->getScAgreement($signLeaseId,$applicationId,$signstatus); 

        //draft status
        $draftSatus = ApplicationStatusMaster::where('status_name','=','Draft')->value('id');
        $draftSaleId   = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype);
        $draftLeaseId  = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype);    

        $data->draftSaleAgreement  = $this->common->getScAgreement($draftSaleId,$applicationId,$draftSatus);
        $data->draftLeaseAgreement = $this->common->getScAgreement($draftLeaseId,$applicationId,$draftSatus);         

        $data->is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer'); 
        $data->status = $this->common->getCurrentStatus($applicationId,$data->sc_application_master_id);   

        $data->AgreementComments = ScAgreementComments::with('Roles')->where('application_id',$applicationId)->where('agreement_type_id',$Applicationtype)->whereNotNull('remark')->get();  

        $data->folder = $this->common->getCurrentRoleFolderName();
        $data->conveyance_map = $this->common->getArchitectSrutiny($applicationId,$data->sc_application_master_id);

        // get draft stamp duty Letter
        $draft  = config('commanConfig.scAgreements.conveyance_draft_stamp_duty_letter');        
        $draftId = $this->common->getScAgreementId($draft,$data->sc_application_master_id); 
        $data->draftStampLetter = $this->common->getScAgreement($draftId,$applicationId,NULL); 

        // get Approve stamp duty Letter
        $stamp  = config('commanConfig.scAgreements.conveyance_stamp_duty_letter'); 
        $stampId = $this->common->getScAgreementId($stamp,$data->sc_application_master_id); 
        $data->approveStampLetter = $this->common->getScAgreement($stampId,$applicationId,NULL);
        $data->em_document = $this->common->getEMNoDueCertificate($data->sc_application_master_id,$applicationId);

        if ($data->is_view && $data->status->status_id != config('commanConfig.conveyance_status.forwarded') && $data->status->status_id != config('commanConfig.conveyance_status.reverted') ) {
            
            $route = 'admin.conveyance.dyco_department.approved_sale_lease_agreement';
        }else{
            $route = 'admin.conveyance.common.view_approved_sale_lease_agreement';
        }   
      
        return view($route,compact('data'));      
    } 

    //save Approved lease and sale Agreement by dycdo
    public function saveApprovedAgreement(Request $request){
        
        $applicationId   = $request->applicationId;
        $sale_agreement  = $request->file('sale_agreement');   
        $lease_agreement = $request->file('lease_agreement'); 
    
        $data = scApplication::where('id',$applicationId)->first();           
        $Applicationtype= $data->sc_application_master_id; 
       
        $sale_folder_name  = "Conveyance_Approved_sale_agreement";
        $lease_folder_name = "Conveyance_Approved_lease_agreement";

        $Agrstatus = ApplicationStatusMaster::where('status_name','=','Approved')->value('id'); 
        
        if ($sale_agreement) {
            $sale_extension  = $sale_agreement->getClientOriginalExtension(); 
            $sale_file_name  = time().'_sale_'.$applicationId.'.'.$sale_extension; 
            $sale_file_path  = $sale_folder_name.'/'.$sale_file_name; 
            $SaleId = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype);
            
            if ($sale_extension == "pdf"){
                
                // Storage::disk('ftp')->delete($request->oldSaleFile);
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

                // Storage::disk('ftp')->delete($request->oldLeaseFile);
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
            scApplication::where('id',$applicationId)->update(['approved_by_dycdo' => '1']);
            return back()->with('success', 'Agreements uploaded successfully.'); 
        } else{
            return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
        }        
    }       

    public function StampedDutySaleLeaseAgreement(Request $request,$applicationId){
       
        $applicationId = decrypt($applicationId);
        $data = scApplication::with('ConveyanceSalePriceCalculation')->where('id',$applicationId)->first();
        $Applicationtype = $data->sc_application_master_id;
        $Agreementstatus = ApplicationStatusMaster::where('status_name','=','Stamped')->value('id');
        $data->status = $this->common->getCurrentStatus($applicationId,$data->sc_application_master_id);

        $StampSaleId  = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype,$Agreementstatus);
        $StampLeaseId = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype,$Agreementstatus);

        $data->StampSaleAgreement  = $this->common->getScAgreement($StampSaleId,$applicationId,$Agreementstatus);
        $data->StampLeaseAgreement = $this->common->getScAgreement($StampLeaseId,$applicationId,$Agreementstatus);

        // get resoluation and undertaking
        $resolutionDoc  = config('commanConfig.documents.society.sc_resolution');
        $resolutionId = $this->common->getScAgreementId($resolutionDoc,$Applicationtype);
        $data->resolution = $this->common->getScAgreement($resolutionId,$applicationId,NULL);        

        $Doc1  = config('commanConfig.documents.society.sc_undertaking');
        $docId = $this->common->getScAgreementId($Doc1,$Applicationtype);
        $data->undertaking = $this->common->getScAgreement($docId,$applicationId,NULL);

        //get stamp duty agreement uploaded by dycdo
        $Agreementstatus1 = ApplicationStatusMaster::where('status_name','=','Stamp_by_dycdo')->value('id');
        $StampSaleId1  = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype,$Agreementstatus1);
        $StampLeaseId1 = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype,$Agreementstatus1);
        
        $data->StampSaleByDycdo  = $this->common->getScAgreement($StampSaleId1,$applicationId,$Agreementstatus1);
        $data->StampLeaseByDycdo = $this->common->getScAgreement($StampLeaseId1,$applicationId,$Agreementstatus1);

        //get stamp duty agreement uploaded by JTCO
        $Agreementstatus2 = ApplicationStatusMaster::where('status_name','=','Stamp_by_jtco')->value('id');
        $StampSaleId2  = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype,$Agreementstatus2);
        $StampLeaseId2 = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype,$Agreementstatus);
        
        $data->StampSaleByJtco  = $this->common->getScAgreement($StampSaleId2,$applicationId,$Agreementstatus2);
        $data->StampLeaseByJtco = $this->common->getScAgreement($StampLeaseId2,$applicationId,$Agreementstatus2);        
        $data->AgreementComments = ScAgreementComments::with('Roles')->where('application_id',$applicationId)->where('agreement_type_id',$Applicationtype)->whereNotNull('remark')->get();  

        $data->folder = $this->common->getCurrentRoleFolderName(); 
        $data->conveyance_map = $this->common->getArchitectSrutiny($applicationId,$data->sc_application_master_id);
        $data->em_document = $this->common->getEMNoDueCertificate($data->sc_application_master_id,$applicationId);
          
        $data->is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer'); 
        $data->status = $this->common->getCurrentStatus($applicationId,$data->sc_application_master_id);


        if ((session()->get('role_name') == config('commanConfig.dycdo_engineer') || session()->get('role_name') == config('commanConfig.joint_co')) && $data->status->status_id == config('commanConfig.conveyance_status.Stamped_sale_&_lease_deed') ) {

            $route = 'admin.conveyance.common.stamp_duty_agreement';
        }else{
            $route = 'admin.conveyance.common.view_stamp_duty_agreement';
        } 
        
        return view($route,compact('data'));      
    } 

    public function SignedSaleLeaseAgreement(Request $request,$applicationId){
        
        $applicationId = decrypt($applicationId);
        $data = scApplication::with('ConveyanceSalePriceCalculation')->where('id',$applicationId)->first();
        $Applicationtype= $data->sc_application_master_id;
        $Agreementstatus = ApplicationStatusMaster::where('status_name','=','Stamped_Signed')->value('id');

        $SignSaleId  = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype,$Agreementstatus);
        $SignLeaseId = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype,$Agreementstatus);

        $data->StampSignSaleAgreement  = $this->common->getScAgreement($SignSaleId,$applicationId,$Agreementstatus);
        $data->StampSignLeaseAgreement = $this->common->getScAgreement($SignLeaseId,$applicationId,$Agreementstatus);

        $is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer');
        $status = $this->common->getCurrentStatus($applicationId,$data->sc_application_master_id);

        //get stamp duty agreement uploaded by JTCO
        $Agreementstatus2 = ApplicationStatusMaster::where('status_name','=','Stamp_by_jtco')->value('id');
        $StampSaleId2  = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype,$Agreementstatus2);
        $StampLeaseId2 = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype,$Agreementstatus);
        
        $data->StampSaleByJtco  = $this->common->getScAgreement($StampSaleId2,$applicationId,$Agreementstatus2);
        $data->StampLeaseByJtco = $this->common->getScAgreement($StampLeaseId2,$applicationId,$Agreementstatus2);       

         //get stamp duty agreement uploaded by DYCDO
        $Agreementstatus3 = ApplicationStatusMaster::where('status_name','=','Stamp_by_dycdo')->value('id');
        $StampSaleId3  = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype,$Agreementstatus3);
        $StampLeaseId3 = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype,$Agreementstatus3);
        
        $data->StampSaleBydyco  = $this->common->getScAgreement($StampSaleId3,$applicationId,$Agreementstatus3);
        $data->StampLeaseBydyco = $this->common->getScAgreement($StampLeaseId3,$applicationId,$Agreementstatus3);

        //get stamp duty uploaded by society
        $Agreementstatus = ApplicationStatusMaster::where('status_name','=','Stamped')->value('id');

        $StampSaleId  = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype,$Agreementstatus);
        $StampLeaseId = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype,$Agreementstatus);

        $data->StampSaleAgreement  = $this->common->getScAgreement($StampSaleId,$applicationId,$Agreementstatus);
        $data->StampLeaseAgreement = $this->common->getScAgreement($StampLeaseId,$applicationId,$Agreementstatus); 

         //get stamp sign agreement
        $Agreementstatus3 = ApplicationStatusMaster::where('status_name','=','Stamped_Signed')->value('id');
        $StampSaleId3  = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype,$Agreementstatus3);
        $StampLeaseId3= $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype,$Agreementstatus);
        
        $data->StampSignSale  = $this->common->getScAgreement($StampSaleId3,$applicationId,$Agreementstatus3);
        $data->StampSignLease = $this->common->getScAgreement($StampLeaseId3,$applicationId,$Agreementstatus3);     

        $data->AgreementComments = ScAgreementComments::with('Roles')->where('application_id',$applicationId)->where('agreement_type_id',$Applicationtype)->whereNotNull('remark')->get(); 

        $data->folder = $this->common->getCurrentRoleFolderName();
        $data->conveyance_map = $this->common->getArchitectSrutiny($applicationId,$data->sc_application_master_id);
        $data->em_document = $this->common->getEMNoDueCertificate($data->sc_application_master_id,$applicationId);


        if ($is_view && $status->status_id == config('commanConfig.conveyance_status.Stamped_signed_sale_&_lease_deed')) {
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
        
        $sale_folder_name  = "Conveyance_Stamp_Sign_Sale_agreement";
        $lease_folder_name = "Conveyance_Stamp_Sign_Lease_agreement";
        
        $data = scApplication::where('id',$applicationId)->first();
        $Applicationtype= $data->sc_application_master_id; 
        $Agrstatus = ApplicationStatusMaster::where('status_name','=','Stamped_Signed')->value('id');

        if ($sale_agreement) {
            
            $sale_extension  = $sale_agreement->getClientOriginalExtension(); 
            $sale_file_name  = time().'_sale_'.$applicationId.'.'.$sale_extension; 
            $sale_file_path  = $sale_folder_name.'/'.$sale_file_name; 
            $stampSignSaleId = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype);

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
            $stampSignLeaseId = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype);
               
            if ($lease_extension == "pdf") {
                Storage::disk('ftp')->delete($request->oldLeaseFile);
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
            scApplication::where('id',$applicationId)->update(['stamp_by_dycdo' => '1']);
            return back()->with('success', 'Agreements uploaded successfully.'); 
        } else{
            return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
        }         

    }  

    public function RegisterSaleLeaseAgreement(Request $request,$applicationId){
        
        $applicationId = decrypt($applicationId);
        $data = scApplication::with(['scApplicationLog','ConveyanceSalePriceCalculation'])
        ->where('id',$applicationId)->first();
        $Applicationtype= $data->sc_application_master_id;
        $Agreementstatus = ApplicationStatusMaster::where('status_name','=','Register')->value('id');        

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
        $data->conveyance_map = $this->common->getArchitectSrutiny($applicationId,$data->sc_application_master_id);
        $data->em_document = $this->common->getEMNoDueCertificate($data->sc_application_master_id,$applicationId);

        //get Registered Agreement details
        $SaleId  = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype,NULL);
        $LeaseId  = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype,NULL);
        $data->sale_registration = scRegistrationDetails::where('application_id',$applicationId)
        ->where('agreement_type_id',$SaleId)->first();
        $data->lease_registration = scRegistrationDetails::where('application_id',$applicationId)
        ->where('agreement_type_id',$LeaseId)->first();
        
        // dd($data);
        if ($data->is_view && $data->status->status_id == config('commanConfig.conveyance_status.Registered_sale_&_lease_deed')) {
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

        $applicationId = decrypt($applicationId);
        $data = scApplication::with(['scApplicationLog','ConveyanceSalePriceCalculation'])->where('id',$applicationId)->first();  
        $data->is_view = session()->get('role_name') == config('commanConfig.dyco_engineer'); 
        $data->status = $this->common->getCurrentStatus($applicationId,$data->sc_application_master_id); 
        $data->conveyance_map = $this->common->getArchitectSrutiny($applicationId,$data->sc_application_master_id);
        $masterId = $data->sc_application_master_id;
        $Applicationtype= $data->sc_application_master_id;
        $data->AgreementComments = ScAgreementComments::with('Roles')->where('application_id',$applicationId)->where('agreement_type_id',$Applicationtype)->whereNotNull('remark')->get();

        //get draft NOC
        $draft  = config('commanConfig.scAgreements.conveynace_draft_NOC');        
        $draftId = $this->common->getScAgreementId($draft,$masterId);
        $data->draftNOC = $this->common->getScAgreement($draftId,$applicationId,NULL);        

        //get uploaded NOC
        $noc  = config('commanConfig.scAgreements.conveynace_uploaded_NOC');        
        $nocId = $this->common->getScAgreementId($noc,$masterId);
        $data->NOC = $this->common->getScAgreement($nocId,$applicationId,NULL);
        $data->em_document = $this->common->getEMNoDueCertificate($data->sc_application_master_id,$applicationId);

        return view('admin.conveyance.dyco_department.conveyance_noc',compact('data'));
    }

    public function GenerateConveyanceNOC(Request $request,$applicationId){
        
        $applicationId = decrypt($applicationId);
        $data = scApplication::with(['societyApplication'])->where('id',$applicationId)
        ->first();
        $Applicationtype= $data->sc_application_master_id;
        //get Registered Agreement details
        $SaleId  = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype,NULL);
        $LeaseId  = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype,NULL);
        $data->sale_registration = scRegistrationDetails::where('application_id',$applicationId)
        ->where('agreement_type_id',$SaleId)->first();
        $data->lease_registration = scRegistrationDetails::where('application_id',$applicationId)
        ->where('agreement_type_id',$LeaseId)->first();

        return view('admin.conveyance.dyco_department.generate_noc',compact('data'));        
    }

    public function saveDraftNOC(Request $request){
        
        $id = $request->applicationId;
        $masterId = scApplication::where('id',$id)->value('sc_application_master_id');
        $draft  = config('commanConfig.scAgreements.conveynace_draft_NOC');        
        $draftId = $this->common->getScAgreementId($draft,$masterId);
        
        $content = str_replace('_', "", $_POST['ckeditorText']);
        $folder_name = 'Conveynace_Draft_NOC';

        $header_file = view('admin.REE_department.offer_letter_header');        
        $footer_file = view('admin.REE_department.offer_letter_footer');
        // $pdf = \App::make('dompdf.wrapper');
        $pdf = new Mpdf();

        $pdf->autoScriptToLang = true;
        $pdf->autoLangToFont = true;

        $pdf->SetHTMLHeader($header_file);
        $pdf->SetHTMLFooter($footer_file);
        $pdf->WriteHTML($content);        
    
        $fileName = time().'_draft_noc_'.$id.'.pdf';
        $filePath = $folder_name."/".$fileName;

        if (!(Storage::disk('ftp')->has($folder_name))) {            
            Storage::disk('ftp')->makeDirectory($folder_name, $mode = 0777, true, true);
        } 
        Storage::disk('ftp')->put($filePath, $pdf->Output($fileName, 'S'));
        $draftLetter = $this->common->getScAgreement($draftId,$id,NULL);
       
        if ($draftLetter){
            $this->common->updateScAgreement($id,$draftId,$filePath,NULL);                    
        }else{
            $this->common->createScAgreement($id,$draftId,$filePath,NULL);
        }
        
        //text offer letter

        $text  = config('commanConfig.scAgreements.conveynace_text_NOC');
        $textId = $this->common->getScAgreementId($text,$masterId);

        $folder_name1 = 'Conveynace_Text_NOC';

        if (!(Storage::disk('ftp')->has($folder_name1))) {            
            Storage::disk('ftp')->makeDirectory($folder_name1, $mode = 0777, true, true);
        }        
        $file_nm =  time()."_text_noc_".$id.'.txt';
        $filePath1 = $folder_name1."/".$file_nm;

        Storage::disk('ftp')->put($filePath1, $content);

        $textLetter = $this->common->getScAgreement($textId,$id,NULL);
       
        if ($textLetter){
            $this->common->updateScAgreement($id,$textId,$filePath1,NULL);                    
        }else{
            $this->common->createScAgreement($id,$textId,$filePath1,NULL);
        } 
        $applicationId = encrypt($request->applicationId);
        return redirect('conveyance_noc/'.$applicationId)->with('success', 'NOC Generated Successfully..');        
    }

    public function saveUploadedNOC(Request $request){
        
        $applicationId = $request->applicationId;
        $masterId = scApplication::where('id',$applicationId)->value('sc_application_master_id');
        $nocDOC  = config('commanConfig.scAgreements.conveynace_uploaded_NOC');
        
        $file  = $request->file('NOC');
        $folder_name  = "Conveyance_uploaded_NOC";

        if ($file) {
            $extension  = $file->getClientOriginalExtension(); 
            $file_name  = time().'_noc_'.$applicationId.'.'.$extension; 
            $file_path  = $folder_name.'/'.$file_name; 
            $nocId = $this->common->getScAgreementId($nocDOC,$masterId);

            if ($extension == "pdf"){
                
                Storage::disk('ftp')->delete($request->oldNOC);
                $upload = $this->CommonController->ftpFileUpload($folder_name,$file,$file_name); 
                $Data = $this->common->getScAgreement($nocId,$applicationId,NULL);

                if ($Data){
                    $this->common->updateScAgreement($applicationId,$nocId,$file_path,NULL);
                }else{
                    $this->common->createScAgreement($applicationId,$nocId,$file_path,NULL);               
                }
                $status = 'success';
            } else{
                $status = 'error';
            }           
        }else{
            $status = 'error';    
        } 

        if (isset($status) && $status == 'success'){
            return back()->with('success', 'NOC uploaded successfully.'); 
        } else{
            return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
        }                 
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
                'status_id'      => config('commanConfig.conveyance_status.forwarded'),
                'society_flag'   => '0',
                'application_master_id' => $data->sc_application_master_id,
                'to_user_id'     => $to_user_id,
                'to_role_id'     => $to_role_id,
                'is_active'      => 1,
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
                'is_active'     => 1,
                'created_at'    => Carbon::now(),
            ],
            ];

            DB::beginTransaction();
            try{
                scApplicationLog::where('application_id',$applicationId)
                ->whereIn('user_id', [Auth::user()->id,$to_user_id ])
                ->update(array('is_active' => 0));                
            
                scApplicationLog::insert($application); 
                scApplication::where('id',$applicationId)->where('sc_application_master_id',$data->sc_application_master_id)
                    ->update(['application_status' => $data->application_status, 'sent_to_society' => 1]);

                DB::commit();    
            }catch (\Exception $ex) {
                DB::rollback();
            }
            return back()->with('success','Application Send Successfully.');        
    }

    //save stamp duty agreements by dycdo and jtco
    public function SaveStampDutyAgreement(Request $request){

        $applicationId   = $request->application_id;
        $sale_agreement  = $request->file('sale_agreement');   
        $lease_agreement = $request->file('lease_agreement'); 
        
        $data = scApplication::where('id',$applicationId)->first();           
        $Applicationtype= $data->sc_application_master_id; 
       
        $sale_folder_name  = "Conveyance_stamp_duty_sale_agreement";
        $lease_folder_name = "Conveyance_stamp_duty_lease_agreement";

        $Agrstatus = "";
        
        if(session()->get('role_name') == config('commanConfig.dycdo_engineer')){
            $Agrstatus = ApplicationStatusMaster::where('status_name','=','Stamp_by_dycdo')->value('id');
        }
        else{
            $Agrstatus = ApplicationStatusMaster::where('status_name','=','Stamp_by_jtco')->value('id');
        } 

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
          $status = 'success'; 
        }
        
        if (isset($status) && $status == 'success'){
            return back()->with('success', 'Submitted Successfully.'); 
        } else{
            return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
        }                         
    } 

    public function saveConveyanceStampDuty(Request $request){
        
        $applicationId = $request->applicationId;
        $masterId = scApplication::where('id',$applicationId)->value('sc_application_master_id');
        $stamp  = config('commanConfig.scAgreements.conveyance_stamp_duty_letter');
        $file  = $request->file('stamp_letter');
        $folder_name  = "Conveyance_Stamp_Duty_Letter";

        if ($file) {
            $extension  = $file->getClientOriginalExtension(); 
            $file_name  = time().'_stamp_'.$applicationId.'.'.$extension; 
            $file_path  = $folder_name.'/'.$file_name; 
            $letterId = $this->common->getScAgreementId($stamp,$masterId);
   
            if ($extension == "pdf"){
                
                Storage::disk('ftp')->delete($request->oldStamp);
                $upload = $this->CommonController->ftpFileUpload($folder_name,$file,$file_name); 
                $Data = $this->common->getScAgreement($letterId,$applicationId,NULL);

                if ($Data){
                    $this->common->updateScAgreement($applicationId,$letterId,$file_path,NULL);
                }else{
                    $this->common->createScAgreement($applicationId,$letterId,$file_path,NULL);               
                }
                $status = 'success';
            } else{
                $status = 'error';
            }           
        }else{
            $status = 'error';    
        } 

        if (isset($status) && $status == 'success'){
            return back()->with('success', 'Stamp duty Letter uploaded successfully.'); 
        } else{
            return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
        }                 
    }

    // generate stamp duty letter in ckeditor for conveyance Application
    public function GenerateConveyanceStampDuty(Request $request,$applicationId){

        $applicationId = decrypt($applicationId);
        $data = scApplication::with(['societyApplication'])->where('id',$applicationId)->first();
        return view('admin.conveyance.dyco_department.generate_stamp_duty_letter',compact('applicationId','data'));
    }

    // save draft and text stamp duty letter for conveyance Application
    public function saveDraftConveyanceStampDuty(Request $request){

        $id = $request->applicationId;
        $masterId = scApplication::where('id',$id)->value('sc_application_master_id');
        $draft  = config('commanConfig.scAgreements.conveyance_draft_stamp_duty_letter');        
        $draftId = $this->common->getScAgreementId($draft,$masterId);
        // dd($draftId);    
        $content = str_replace('_', "", $_POST['ckeditorText']);
        $folder_name = 'Conveyance_Draft_Stamp_duty_Letter';

        $header_file = view('admin.REE_department.offer_letter_header');        
        $footer_file = view('admin.REE_department.offer_letter_footer');

        $pdf = new Mpdf();
        // $pdf = \App::make('dompdf.wrapper');
        $pdf->autoScriptToLang = true;
        $pdf->autoLangToFont = true;

        $pdf->SetHTMLHeader($header_file);
        $pdf->SetHTMLFooter($footer_file);
        $pdf->WriteHTML($content);
        
        $fileName = time().'_draft_stamp_duty_letter_'.$id.'.pdf';
        $filePath = $folder_name."/".$fileName;

        if (!(Storage::disk('ftp')->has($folder_name))) {            
            Storage::disk('ftp')->makeDirectory($folder_name, $mode = 0777, true, true);
        } 
        Storage::disk('ftp')->put($filePath, $pdf->Output($fileName, 'S'));

        $draftLetter = $this->common->getScAgreement($draftId,$id,NULL);
        if ($draftLetter){
            // dd($filePath);
            $this->common->updateScAgreement($id,$draftId,$filePath,NULL);                    
        }else{

            $this->common->createScAgreement($id,$draftId,$filePath,NULL);
        }

        //text offer letter

        $text  = config('commanConfig.scAgreements.conveyance_text_stamp_duty_letter');
        $textId = $this->common->getScAgreementId($text,$masterId);

        $folder_name1 = 'Conveyance_Text_Stamp_duty_Letter';

        if (!(Storage::disk('ftp')->has($folder_name1))) {            
            Storage::disk('ftp')->makeDirectory($folder_name1, $mode = 0777, true, true);
        }        
        $file_nm =  time()."_text_stamp_duty_letter_".$id.'.txt';
        $filePath1 = $folder_name1."/".$file_nm;

        Storage::disk('ftp')->put($filePath1, $content);

        $textLetter = $this->common->getScAgreement($textId,$id,NULL);
       
        if ($textLetter){
            $this->common->updateScAgreement($id,$textId,$filePath1,NULL);                    
        }else{
            $this->common->createScAgreement($id,$textId,$filePath1,NULL);
        } 

        $applicationId = encrypt($request->applicationId);
        return redirect('approved_sale_lease_agreement/'.$applicationId)->with('success', 'Stamp Duty Letter generated successfully..');                      
    }              

    // Renewal start here

    public function saveRenewalAgreement(Request $request){
        
        $applicationId   = $request->applicationId;  
        $file = $request->file('lease_agreement'); 
        $LeaseAgreement = config('commanConfig.scAgreements.renewal_lease_deed_agreement');
        
        $data = RenewalApplication::where('id',$applicationId)->first();        
        $Applicationtype = $data->application_master_id;

        $Agrstatus = ApplicationStatusMaster::where('status_name','=','Draft')->value('id');          
        $folderName = "renewal_prepare_Lease_Agreement";
        
        if ($file) {

            $extension = $file->getClientOriginalExtension(); 
            $fileName = time().'_lease_'.$applicationId.'.'.$extension;
            $path = $folderName.'/'.$fileName;

            $draftLeaseId = $this->common->getScAgreementId($LeaseAgreement,$Applicationtype);
            
            if ($extension == "pdf") {
                
                Storage::disk('ftp')->delete($request->oldLeaseFile);
                $this->CommonController->ftpFileUpload($folderName,$file,$fileName);
                $leaseData = $this->renewal->getRenewalAgreement($draftLeaseId,$applicationId,$Agrstatus);
               
                if ($leaseData){
                    $this->renewal->updateRenewalAgreement($applicationId,$draftLeaseId,$path,$Agrstatus);                    
                }else{
                    $this->renewal->createRenewalAgreement($applicationId,$draftLeaseId,$path,$Agrstatus);
                }
                $status = 'success';                
            }            
        }
        if ($request->remark){
          $this->renewal->renewalAgreementComment($applicationId,$request->remark,$Applicationtype);  
        }
        
        if (isset($status) && $status == 'success'){
            return back()->with('success', 'Agreements uploaded successfully.'); 
        } else{
            return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
        }         
    }

    //save Renewal Approve Lease Agreement
    public function saveApproveRenewalAgreement(Request $request){
        
        $applicationId   = $request->applicationId;  
        $file = $request->file('lease_agreement'); 
        $LeaseAgreement = config('commanConfig.scAgreements.renewal_lease_deed_agreement');  
        $data = RenewalApplication::where('id',$applicationId)->first();        
        $Applicationtype = $data->application_master_id;  
        
        $Agrstatus = ApplicationStatusMaster::where('status_name','=','Approved')->value('id');          
        $folderName = "renewal_Approve_Lease_Agreement";            

        if ($file) {
            $extension = $file->getClientOriginalExtension(); 
            $fileName = time().'_lease_'.$applicationId.'.'.$extension;
            $path = $folderName.'/'.$fileName;

            $LeaseId = $this->common->getScAgreementId($LeaseAgreement,$Applicationtype);
            
            if ($extension == "pdf") {
                
                Storage::disk('ftp')->delete($request->oldLeaseFile);
                $this->CommonController->ftpFileUpload($folderName,$file,$fileName);
                $leaseData = $this->renewal->getRenewalAgreement($LeaseId,$applicationId,$Agrstatus);
               
                if ($leaseData){
                    $this->renewal->updateRenewalAgreement($applicationId,$LeaseId,$path,$Agrstatus);                    
                }else{
                    $this->renewal->createRenewalAgreement($applicationId,$LeaseId,$path,$Agrstatus);
                }
                $status = 'success';                
            }            
        }
        if ($request->remark){
          $this->renewal->renewalAgreementComment($applicationId,$request->remark,$Applicationtype);  
        }
        
        if (isset($status) && $status == 'success'){
            return back()->with('success', 'Agreements uploaded successfully.'); 
        } else{
            return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
        }          
    }

    public function SendRenewalApplicationToSociety(Request $request){
        
        $applicationId = $request->applicationId; 
        $data = RenewalApplication::with(['societyApplication.roleUser'])->where('id',$applicationId)->first();
   
        $to_role_id = $data->societyApplication->roleUser->role_id;    
        $to_user_id = $data->societyApplication->roleUser->id;  

            $application = [[
                'application_id' => $request->applicationId,
                'user_id'        => Auth::user()->id,
                'role_id'        => session()->get('role_id'),
                'status_id'      => config('commanConfig.renewal_status.forwarded'),
                'society_flag'   => '0',
                'application_master_id' => $data->application_master_id,
                'to_user_id'     => $to_user_id,
                'to_role_id'     => $to_role_id,
                'is_active'      => 1,
                'created_at'     => Carbon::now(),
            ],
            [
                'application_id' => $request->applicationId,
                'user_id'       => $to_user_id,
                'role_id'       => $to_role_id,
                'status_id'     => $data->application_status,
                'society_flag'  => '1',
                'application_master_id' => $data->application_master_id,
                'to_user_id'    => null,
                'to_role_id'    => null,
                'is_active'     => 1,
                'created_at'    => Carbon::now(),
            ],
            ];

             
                RenewalApplicationLog::where('application_id',$applicationId)
                ->whereIn('user_id', [Auth::user()->id,$to_user_id ])
                ->update(['is_active' => 0]); 
                RenewalApplicationLog::insert($application); 

               RenewalApplication::where('id',$applicationId)->where('application_master_id',$data->application_master_id)
                ->update(['application_status' => $data->application_status,'sent_to_society' => 1]);            
            return back()->with('success','Application Send Successfully.');     
    }

    // generate stamp duty letter in ckeditor for Renewal Application
    public function GenerateStampDutyLetter(Request $request,$applicationId){
        $applicationId = decrypt($applicationId);
        $data = RenewalApplication::with(['societyApplication'])->where('id',$applicationId)->first();
        return view('admin.renewal.dyco_department.generate_stamp_duty_letter',compact('applicationId','data'));
    }

    // save draft and text stamp duty letter for Renewal Application
    public function saveRenewalDraftStampDuty(Request $request){
       
        $id = $request->applicationId;
        $masterId = RenewalApplication::where('id',$id)->value('application_master_id');
        $draft  = config('commanConfig.scAgreements.renewal_draft_stamp_duty_letter');        
        $draftId = $this->common->getScAgreementId($draft,$masterId);
        
        $content = str_replace('_', "", $_POST['ckeditorText']);
        $folder_name = 'Renewal_Draft_Stamp_duty_Letter';

        $header_file = view('admin.REE_department.offer_letter_header');        
        $footer_file = view('admin.REE_department.offer_letter_footer');

        $pdf = new Mpdf();
        // $pdf = \App::make('dompdf.wrapper');
        $pdf->autoScriptToLang = true;
        $pdf->autoLangToFont = true;

        $pdf->SetHTMLHeader($header_file);
        $pdf->SetHTMLFooter($footer_file);
        $pdf->WriteHTML($content);
    
        $fileName = time().'_draft_stamp_duty_letter_'.$id.'.pdf';
        $filePath = $folder_name."/".$fileName;

        if (!(Storage::disk('ftp')->has($folder_name))) {            
            Storage::disk('ftp')->makeDirectory($folder_name, $mode = 0777, true, true);
        } 
        Storage::disk('ftp')->put($filePath, $pdf->Output($fileName, 'S'));
        $draftLetter = $this->renewal->getRenewalAgreement($draftId,$id,NULL);
       
        if ($draftLetter){
            $this->renewal->updateRenewalAgreement($id,$draftId,$filePath,NULL);                    
        }else{
            $this->renewal->createRenewalAgreement($id,$draftId,$filePath,NULL);
        }

        //text offer letter

        $text  = config('commanConfig.scAgreements.renewal_text_stamp_duty_letter');
        $textId = $this->common->getScAgreementId($text,$masterId);

        $folder_name1 = 'Renewal_Text_Stamp_duty_Letter';

        if (!(Storage::disk('ftp')->has($folder_name1))) {            
            Storage::disk('ftp')->makeDirectory($folder_name1, $mode = 0777, true, true);
        }        
        $file_nm =  time()."_text_stamp_duty_letter_".$id.'.txt';
        $filePath1 = $folder_name1."/".$file_nm;

        Storage::disk('ftp')->put($filePath1, $content);

        $textLetter = $this->renewal->getRenewalAgreement($textId,$id,NULL);
       
        if ($textLetter){
            $this->renewal->updateRenewalAgreement($id,$textId,$filePath1,NULL);                    
        }else{
            $this->renewal->createRenewalAgreement($id,$textId,$filePath1,NULL);
        } 

        $applicationId = encrypt($request->applicationId);
        return redirect('approve_renewal_agreement/'.$applicationId)->with('success', 'Stamp Duty Letter generated successfully..');
        // return redirect('');                      
    }

    //save renewal uploaded stamp duty 
    public function saveRenewalStampDuty(Request $request){
        
        $file = $request->file('stamp_letter');
        $applicationId = $request->applicationId;
        $masterId = RenewalApplication::where('id',$applicationId)->value('application_master_id');
        if ($file) {
            $extension = $file->getClientOriginalExtension();

            if($extension == 'pdf'){
                $folderName = 'Renewal_Stamp_Duty_Letter';
                $fileName = time().'_stamp_letter_'.$applicationId.'.'.$extension;
                $filePath = $folderName."/".$fileName;
                $letter  = config('commanConfig.scAgreements.renewal_stamp_duty_letter');
                $letterId = $this->common->getScAgreementId($letter,$masterId);            
                
                $delete = Storage::disk('ftp')->delete($request->oldStamp);
                $this->CommonController->ftpFileUpload($folderName,$file,$fileName);

                $textLetter = $this->renewal->getRenewalAgreement($letterId,$applicationId,NULL);
                
                if ($textLetter){
                    $this->renewal->updateRenewalAgreement($applicationId,$letterId,$filePath,NULL);                    
                }else{
                    $this->renewal->createRenewalAgreement($applicationId,$letterId,$filePath,NULL);
                }
                $status =  'success';                           
            } else{
                $status =  'error'; 
            }           
        }else{
            $status =  'error';
        }

        if (isset($status) && $status == 'success'){
            return back()->with('success', 'Stamp Duty Letter uploaded successfully.'); 
        } else{
            return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
        }         
    } 

    // save generated conveyance sale and lease agreement 
    public function generateSaleLeaseAgreement(Request $request){
        // dd($request);
        $applicationId = $request->applicationId;
        $sale_folder_name  = "Conveyance_Draft_Sale_Agreement";
        $lease_folder_name = "Conveyance_Draft_Lease_Agreement";
        
        $data = scApplication::where('id',$applicationId)->first();
        $Applicationtype = $data->sc_application_master_id;
        $draft = ApplicationStatusMaster::where('status_name','=','generate_draft')->value('id');
        $text = ApplicationStatusMaster::where('status_name','=','text')->value('id');

        $id = $request->applicationId;
        if ($request->saleAgreement){
            $saleContent = str_replace('_', "", $request->saleAgreement);

        }if ($request->leaseAgreement){
            $leaseContent = str_replace('_', "", $request->leaseAgreement);
        }
        
        $pdf = new Mpdf();
        $pdf->autoScriptToLang = true;
        $pdf->autoLangToFont = true; 
        $header_file = view('admin.REE_department.offer_letter_header');        
        $footer_file = view('admin.REE_department.offer_letter_footer');

        if (isset($saleContent)){

            $saleId = $this->common->getScAgreementId($this->SaleAgreement,$Applicationtype);
            $saleData = $this->common->getScAgreement($saleId,$applicationId,$draft);
            $pdf->WriteHTML($header_file.$saleContent.$footer_file);
            $fileName = time().'draft_generated_sale_agreement_'.$id.'.pdf';
            $filePath = $sale_folder_name."/".$fileName;

            try{
                if (!(Storage::disk('ftp')->has($sale_folder_name))) {            
                    Storage::disk('ftp')->makeDirectory($sale_folder_name, $mode = 0777, true, true);
                } 
                if ($request->oldDraftSale){
                    Storage::disk('ftp')->delete($request->oldDraftSale);
                }
                Storage::disk('ftp')->put($filePath, $pdf->Output($fileName, 'S'));

                if ($saleData){
                        $this->common->updateScAgreement($applicationId,$saleId,$filePath,$draft);
                    }else{
                        $this->common->createScAgreement($applicationId,$saleId,$filePath,$draft);  
                }      
                
                //save sale agreement in text format

                $folder_name1 = 'Conveyance_Text_Sale_Agreement';

                if (!(Storage::disk('ftp')->has($folder_name1))) {            
                    Storage::disk('ftp')->makeDirectory($folder_name1, $mode = 0777, true, true);
                }        
                $file_nm =  time()."text_sale_agreement_".$id.'.txt';
                $filePath1 = $folder_name1."/".$file_nm;
                
                if ($request->oldTextSale){
                    Storage::disk('ftp')->delete($request->oldTextSale);
                }
                Storage::disk('ftp')->put($filePath1, $saleContent);

                $textSaleData = $this->common->getScAgreement($saleId,$applicationId,$text);
                if ($textSaleData){
                        $this->common->updateScAgreement($applicationId,$saleId,$filePath1,$text);
                    }else{
                        $this->common->createScAgreement($applicationId,$saleId,$filePath1,$text);  
                }                    

            }catch(Exception $e){
                
            }
        }        

        if (isset($leaseContent)){

            $leaseId = $this->common->getScAgreementId($this->LeaseAgreement,$Applicationtype);
            $leaseData = $this->common->getScAgreement($leaseId,$applicationId,$draft);
            $pdf->WriteHTML($header_file.$leaseContent.$footer_file);
            $fileName = time().'draft_generated_lease_agreement_'.$id.'.pdf';
            $filePath = $lease_folder_name."/".$fileName;

            try{
                if (!(Storage::disk('ftp')->has($lease_folder_name))) {            
                    Storage::disk('ftp')->makeDirectory($lease_folder_name, $mode = 0777, true, true);
                } 
                Storage::disk('ftp')->delete($request->oldDraftLease);
                Storage::disk('ftp')->put($filePath, $pdf->Output($fileName, 'S'));

                if ($leaseData){
                        $this->common->updateScAgreement($applicationId,$leaseId,$filePath,$draft);
                    }else{
                        $this->common->createScAgreement($applicationId,$leaseId,$filePath,$draft);  
                }      
                
                //save lease agreement in text format

                $folder_name1 = 'Conveyance_Text_Lease_Agreement';

                if (!(Storage::disk('ftp')->has($folder_name1))) {            
                    Storage::disk('ftp')->makeDirectory($folder_name1, $mode = 0777, true, true);
                }        
                $file_nm =  time()."text_lease_agreement_".$id.'.txt';
                $filePath1 = $folder_name1."/".$file_nm;
                Storage::disk('ftp')->delete($request->oldtextLease);
                Storage::disk('ftp')->put($filePath1, $leaseContent);

                $textSaleData = $this->common->getScAgreement($leaseId,$applicationId,$text);
                if ($textSaleData){
                        $this->common->updateScAgreement($applicationId,$leaseId,$filePath1,$text);
                    }else{
                        $this->common->createScAgreement($applicationId,$leaseId,$filePath1,$text);  
                }                    

            }catch(Exception $e){
                
            }
        }
    return back()->with('success', 'Agreements Generated Successfully.');
    }

    //generate renewal lease draft Agreement 
    public function generateLeaseAgreement(Request $request){

        $applicationId = $request->applicationId;
        $leaseContent = str_replace('_', "", $request->leaseAgreement);
        $LeaseAgreement = config('commanConfig.scAgreements.renewal_lease_deed_agreement');
        $data = RenewalApplication::where('id',$applicationId)->first(); 
        $Applicationtype = $data->application_master_id;

        $draft = ApplicationStatusMaster::where('status_name','=','generate_draft')->value('id');
        $text = ApplicationStatusMaster::where('status_name','=','text')->value('id'); 

        $folderName = "renewal_prepare_Lease_Agreement";
        $pdf = new Mpdf();
        $pdf->autoScriptToLang = true;
        $pdf->autoLangToFont = true; 
        $header_file = view('admin.REE_department.offer_letter_header');        
        $footer_file = view('admin.REE_department.offer_letter_footer');

        if (isset($leaseContent)){

            $leaseId = $this->common->getScAgreementId($LeaseAgreement,$Applicationtype);
            $leaseData = $this->renewal->getRenewalAgreement($leaseId,$applicationId,$draft);
            $pdf->WriteHTML($header_file.$leaseContent.$footer_file);
            $fileName = time().'draft_generated_lease_agreement_'.$applicationId.'.pdf';
            $filePath = $folderName."/".$fileName;

            try{
                if (!(Storage::disk('ftp')->has($folderName))) {            
                    Storage::disk('ftp')->makeDirectory($folderName, $mode = 0777, true, true);
                } 
                Storage::disk('ftp')->put($filePath, $pdf->Output($fileName, 'S'));

                if ($leaseData){
                        $this->renewal->updateRenewalAgreement($applicationId,$leaseId,$filePath,$draft);
                    }else{
                        $this->renewal->createRenewalAgreement($applicationId,$leaseId,$filePath,$draft);  
                }      
                
                //save sale agreement in text format

                $folder_name1 = 'Renewal_Text_Lease_Agreement';

                if (!(Storage::disk('ftp')->has($folder_name1))) {            
                    Storage::disk('ftp')->makeDirectory($folder_name1, $mode = 0777, true, true);
                }        
                $file_nm =  time()."text_lease_agreement_".$applicationId.'.txt';
                $filePath1 = $folder_name1."/".$file_nm;
                Storage::disk('ftp')->put($filePath1, $leaseContent);

                $textLeaseData = $this->renewal->getRenewalAgreement($leaseId,$applicationId,$text);
                if ($textLeaseData){
                        $this->renewal->updateRenewalAgreement($applicationId,$leaseId,$filePath1,$text);
                    }else{
                        $this->renewal->createRenewalAgreement($applicationId,$leaseId,$filePath1,$text);  
                }                    

            }catch(Exception $e){
                
            }
        }
        return back()->with('success', 'Agreements Generated Successfully.');
    }        
}
 
