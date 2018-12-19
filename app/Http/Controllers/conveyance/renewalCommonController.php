<?php

namespace App\Http\Controllers\conveyance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\conveyance\conveyanceCommonController;
use App\Http\Controllers\Common\CommonController;
use App\conveyance\scApplicationType;
use App\conveyance\scApplication;
use Illuminate\Support\Facades\Session;
use App\conveyance\RenewalApplication;
use App\conveyance\RenewalDocumentStatus;
use App\conveyance\RenewalAgreementComments;
use App\conveyance\RenewalApplicationLog;
use App\conveyance\RenewalEEScrutinyDocuments;
use App\conveyance\RenewalArchitectScrutinyDocuments;
use App\conveyance\SocietyConveyanceDocumentMaster;
use App\conveyance\scRegistrationDetails;
use App\ApplicationStatusMaster;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Role;
use Config;
use Storage;
use App\User;
use Auth;
use File;
use DB; 

class renewalCommonController extends Controller
{
    public function __construct()
    {
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
        $this->CommonController = new CommonController();
        $this->conveyance = new conveyanceCommonController();
    }

    public function index(Request $request, Datatables $datatables){
        $data = $this->listApplicationData($request);
        
        $columns = [
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'societyApplication.name','name' => 'societyApplication.name','title' => 'Society Name'],
            ['data' => 'societyApplication.building_no','name' => 'societyApplication.building_no','title' => 'building No'],
            ['data' => 'societyApplication.address','name' => 'societyApplication.address','title' => 'Address', 'class' => 'datatable-address'],
            ['data' => 'Status','name' => 'Status','title' => 'Status'],
        ];

        if ($datatables->getRequest()->ajax()) {

            return $datatables->of($data)
                ->editColumn('rownum', function ($data) {
                    static $i = 0; $i++; return $i;
                })

                ->editColumn('radio', function ($data) {
                    $url = route('renewal.view_application', encrypt($data->id));
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" name="application_id" onclick="geturl(this.value);" value="'.$url.'" ><span></span></label>';
                })                              
                ->editColumn('societyApplication.name', function ($data) {

                    return $data->societyApplication->name;
                })
                ->editColumn('societyApplication.building_no', function ($data) {

                    return $data->societyApplication->building_no;
                })
                ->editColumn('societyApplication.address', function ($data) {

                    return "<span>".$data->societyApplication->address."</span>";
                })                
                ->editColumn('date', function ($data) {

                    return date(config('commanConfig.dateFormat'), strtotime($data->created_at));
                })

                ->editColumn('Status', function ($data) use ($request) {

                    $status = $data->RenewalApplicationLog->status_id;
                    if($request->update_status)
                    {
                        if($request->update_status == $status){
                            $config_array = array_flip(config('commanConfig.renewal_status'));
                            $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                            return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$status) .' m-badge--wide">'.$value.'</span>';
                        }
                    }else{
                        $config_array = array_flip(config('commanConfig.renewal_status'));

                        $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                        return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$status) .' m-badge--wide">'.$value.'</span>';
                    }

                })
                ->rawColumns(['radio','society_name', 'Status', 'building_name', 'societyApplication.address','date'])
                ->make(true);

        }  

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.renewal.common.index', compact('html','header_data','getData','folder_name'));         

    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"      => [1, "asc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    }

	// list all data
    public function listApplicationData($request){
       
        $renewalId = scApplicationType::where('application_type','=','Renewal')->value('id');
		$applicationData = RenewalApplication::with(['applicationLayoutUser','societyApplication','RenewalApplicationLog' => function($q) use($renewalId) {
	        	$q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'))
	            ->where('application_master_id', $renewalId)
	            ->orderBy('id', 'desc');
		}])

        ->whereHas('RenewalApplicationLog', function ($q) use($renewalId) {
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'))
                ->where('application_master_id', $renewalId)
                ->orderBy('id', 'desc');
        });

        if($request->submitted_at_from)
        {
            $applicationData=$applicationData->where(\DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),'>=',date('Y-m-d',strtotime($request->submitted_at_from)));
        }

        if($request->submitted_at_to)
        {
            $applicationData=$applicationData->where(\DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),'<=',date('Y-m-d',strtotime($request->submitted_at_to)));
        } 
                
        $applicationData = $applicationData->orderBy('renewal_application.id', 'desc')->get();
        $listArray = [];
        
        if ($request->update_status) {

            foreach ($applicationData as $app_data) {
                if ($app_data->RenewalApplicationLog->status_id == $request->update_status) {
                    $listArray[] = $app_data;
                }
            }
        } else {
            $listArray = $applicationData;
        } 
        return $listArray;       	
    }

    public function ViewApplication(Request $request,$applicationId){
       
        $applicationId = decrypt($applicationId);
        $data = RenewalApplication::where('id',$applicationId)->first();
        $data->folder = $this->conveyance->getCurrentRoleFolderName();
        $document_id = $this->conveyance->getDocumentId(config('commanConfig.documents.em_renewal.stamp_renewal_application'), $data->application_master_id);
        $document = RenewalDocumentStatus::where('document_id', $document_id)->where('application_id',$applicationId)->first();

        return view('admin.renewal.common.view_application',compact('data', 'document'));
    }

    //prepare renewal lease Agreement
    public function PrepareRenewalAgreement(Request $request,$applicationId){

        $applicationId = decrypt($applicationId);
        $data = RenewalApplication::where('id',$applicationId)->first();
        $LeaseAgreement  = config('commanConfig.scAgreements.renewal_lease_deed_agreement');
        $Agreementstatus = ApplicationStatusMaster::where('status_name','=','Draft')->value('id');
        $draft_sign = ApplicationStatusMaster::where('status_name','=','Draft_Sign')->value('id');
        $LeaseId  = $this->conveyance->getScAgreementId($LeaseAgreement,$data->application_master_id);
        $draftLeaseId  = $this->conveyance->getScAgreementId($LeaseAgreement,$data->application_master_id);
        $data->renewalAgreement = $this->getRenewalAgreement($LeaseId,$applicationId,$Agreementstatus);
        $data->DraftSignAgreement = $this->getRenewalAgreement($draftLeaseId,$applicationId,$draft_sign);
        $data->folder   = $this->conveyance->getCurrentRoleFolderName();

        $data->AgreementComments = RenewalAgreementComments::with('Roles')->where('application_id',$applicationId)->where('agreement_type_id',$data->application_master_id)->whereNotNull('remark')->get();
        
        $is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer');
        $data->status = $this->getCurrentStatus($applicationId,$data->application_master_id);

        if ($is_view && $data->status->status_id == config('commanConfig.renewal_status.Draft_Renewal_of_Lease_deed')) {
            $route = 'admin.renewal.dyco_department.draft_renewal_agreement';
        }else{
            $route = 'admin.renewal.common.view_draft_renewal_agreement';
        }
        return view($route,compact('data'));  
    }

    //Approve renewal lease Agreement
    public function ApproveRenewalAgreement(Request $request,$applicationId){
        
        // dd(date('Y-m-d', strtotime('+5 years')));
        $applicationId = decrypt($applicationId);    
        $data = RenewalApplication::where('id',$applicationId)->first();
        
        // draft    
        $LeaseAgreement  = config('commanConfig.scAgreements.renewal_lease_deed_agreement');
        $Agreementstatus = ApplicationStatusMaster::where('status_name','=','Draft')->value('id');
        $LeaseId = $this->conveyance->getScAgreementId($LeaseAgreement,$data->application_master_id);
        $data->renewalAgreement = $this->getRenewalAgreement($LeaseId,$applicationId,$Agreementstatus);

        // draft and sign
        $draft_sign = ApplicationStatusMaster::where('status_name','=','Draft_Sign')->value('id');
        $draftLeaseId = $this->conveyance->getScAgreementId($LeaseAgreement,$data->application_master_id);
        $data->DraftSignAgreement = $this->getRenewalAgreement($draftLeaseId,$applicationId,$draft_sign);

        // Approve
        $approve = ApplicationStatusMaster::where('status_name','=','Approved')->value('id');
        $approveLeaseId = $this->conveyance->getScAgreementId($LeaseAgreement,$data->application_master_id);
        $data->approveAgreement = $this->getRenewalAgreement($approveLeaseId,$applicationId,$approve);  

        $data->folder = $this->conveyance->getCurrentRoleFolderName();  
        
        $data->AgreementComments = RenewalAgreementComments::with('Roles')->where('application_id',$applicationId)->where('agreement_type_id',$data->application_master_id)->whereNotNull('remark')->get(); 

        $is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer');
        $data->status = $this->getCurrentStatus($applicationId,$data->application_master_id);

        //get Draft stamp duty letter 
        $draft  = config('commanConfig.scAgreements.renewal_draft_stamp_duty_letter');
        $draftId = $this->conveyance->getScAgreementId($draft,$data->application_master_id);
        $data->draftStampLetter = $this->getRenewalAgreement($draftId,$applicationId,NULL);

        //get upload stamp duty letter 
        $stamp  = config('commanConfig.scAgreements.renewal_stamp_duty_letter');
        $stampId = $this->conveyance->getScAgreementId($stamp,$data->application_master_id);
        $data->StampLetter = $this->getRenewalAgreement($stampId,$applicationId,NULL);


        if ($is_view)
            $route = 'admin.renewal.dyco_department.approve_renewal_agreement';
        else
            $route = 'admin.renewal.common.view_approve_renewal_agreement';

        return view($route,compact('data'));   
    }
    
    //stamp by dycdo Renewal lease Agreement
    public function StampRenewalAgreement(Request $request,$applicationId){
        
        $applicationId = decrypt($applicationId);
        $data = RenewalApplication::where('id',$applicationId)->first();
        $LeaseAgreement  = config('commanConfig.scAgreements.renewal_lease_deed_agreement');

        $Agreementstatus = ApplicationStatusMaster::where('status_name','=','Stamped')->value('id');
        $LeaseId = $this->conveyance->getScAgreementId($LeaseAgreement,$data->application_master_id);
        $data->StampAgreement = $this->getRenewalAgreement($LeaseId,$applicationId,$Agreementstatus);
        $data->folder = $this->conveyance->getCurrentRoleFolderName(); 

        // stamp_sign
        $stampStatus = ApplicationStatusMaster::where('status_name','=','Stamp_by_dycdo')->value('id');
        $stampId = $this->conveyance->getScAgreementId($LeaseAgreement,$data->application_master_id);
        $data->StampByDycdoAgreement = $this->getRenewalAgreement($stampId,$applicationId,$stampStatus);        
       
        $data->AgreementComments = RenewalAgreementComments::with('Roles')->where('application_id',$applicationId)->where('agreement_type_id',$data->application_master_id)->whereNotNull('remark')->get();
        $is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer'); 
        $data->status = $this->getCurrentStatus($applicationId,$data->application_master_id); 
        // dd($data->status);
        RenewalApplication::where('id',$applicationId)->update(['stamp_by_dycdo' => 1]);

        if ($is_view && $data->status->status_id == config('commanConfig.renewal_status.Stamp_Renewal_of_Lease_deed')) {
            
            $route = 'admin.renewal.dyco_department.stamp_renewal';
        }else{
            $route = 'admin.renewal.common.view_stamp_renewal';
        }           
        
        return view($route,compact('data'));
    }

    // save stamp and sign Renewal lease Agreement
    public function saveStampRenewalAgreement(Request $request){

        $applicationId   = $request->applicationId;  
        $file = $request->file('lease_agreement'); 
        $LeaseAgreement = config('commanConfig.scAgreements.renewal_lease_deed_agreement');  
        $data = RenewalApplication::where('id',$applicationId)->first(); 
        $Applicationtype = $data->application_master_id;  
        
        $Agrstatus = ApplicationStatusMaster::where('status_name','=','Stamp_by_dycdo')->value('id');          
        $folderName = "renewal_Stamp_Sign_Lease_Agreement"; 

        if ($file) {
            $extension = $file->getClientOriginalExtension(); 
            $fileName = time().'_lease_'.$applicationId.'.'.$extension;
            $path = $folderName.'/'.$fileName;


            $LeaseId = $this->conveyance->getScAgreementId($LeaseAgreement,$Applicationtype);
            
            if ($extension == "pdf") {
                
                Storage::disk('ftp')->delete($request->oldLeaseFile);
                $this->CommonController->ftpFileUpload($folderName,$file,$fileName);
                $leaseData = $this->getRenewalAgreement($LeaseId,$applicationId,$Agrstatus);
                   
                if ($leaseData){
                    $this->updateRenewalAgreement($applicationId,$LeaseId,$path,$Agrstatus);                    
                }else{
                    $this->createRenewalAgreement($applicationId,$LeaseId,$path,$Agrstatus);
                }
                $status = 'success';                
            }            
        } 
        
        //save remark    
        if ($request->remark){
          $this->renewalAgreementComment($applicationId,$request->remark,$Applicationtype);  
        }
        
        if (isset($status) && $status == 'success'){
            return back()->with('success', 'Agreements uploaded successfully.'); 
        } else{
            return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
        }                       
    }    

    public function StampSignRenewalAgreement(Request $request,$applicationId){
        
        $applicationId = decrypt($applicationId);
        $data = RenewalApplication::where('id',$applicationId)->first();
        $LeaseAgreement  = config('commanConfig.scAgreements.renewal_lease_deed_agreement');  

        $Agreementstatus = ApplicationStatusMaster::where('status_name','=','Stamped')->value('id');
        $LeaseId = $this->conveyance->getScAgreementId($LeaseAgreement,$data->application_master_id);
        $data->StampAgreement = $this->getRenewalAgreement($LeaseId,$applicationId,$Agreementstatus);
        $data->folder = $this->conveyance->getCurrentRoleFolderName(); 

        // stamp_by_dycdo
        $stampStatus = ApplicationStatusMaster::where('status_name','=','Stamp_by_dycdo')->value('id');
        $stampId = $this->conveyance->getScAgreementId($LeaseAgreement,$data->application_master_id);
        $data->StampByDycdoAgreement = $this->getRenewalAgreement($stampId,$applicationId,$stampStatus);  

        // stamp_sign
        $signStatus = ApplicationStatusMaster::where('status_name','=','Stamped_Signed')->value('id');
        $signId = $this->conveyance->getScAgreementId($LeaseAgreement,$data->application_master_id);
        $data->StampSignAgreement = $this->getRenewalAgreement($signId,$applicationId,$signStatus);

        // Stamped_Signed_by_dycdo
        $StampSignStatus = ApplicationStatusMaster::where('status_name','=','Stamped_Signed_by_dycdo')->value('id');
        $StampSignId = $this->conveyance->getScAgreementId($LeaseAgreement,$data->application_master_id);
        $data->StampSignByDycdo = $this->getRenewalAgreement($StampSignId,$applicationId,$StampSignStatus);                      
        $data->AgreementComments = RenewalAgreementComments::with('Roles')->where('application_id',$applicationId)->where('agreement_type_id',$data->application_master_id)->whereNotNull('remark')->get();
        $is_view = session()->get('role_name') == config('commanConfig.joint_co'); 
        $data->status = $this->getCurrentStatus($applicationId,$data->application_master_id); 

        if ($is_view && $data->status->status_id == config('commanConfig.renewal_status.Stamp_Renewal_of_Lease_deed')) {
            
            $route = 'admin.renewal.co_department.stamp_sign_renewal';
        }else{
            $route = 'admin.renewal.common.view_stamp_sign_renewal';
        }

        return view($route,compact('data'));                 
    }  

    // save stamp and sign Renewal lease Agreement
    public function SaveStampSignRenewalAgreement(Request $request){
        
        $applicationId   = $request->applicationId;  
        $file = $request->file('lease_agreement'); 
        $LeaseAgreement = config('commanConfig.scAgreements.renewal_lease_deed_agreement');  
        $data = RenewalApplication::where('id',$applicationId)->first(); 
        $Applicationtype = $data->application_master_id;  
        
        if (session()->get('role_name') == config('commanConfig.joint_co')){
            $Agrstatus = ApplicationStatusMaster::where('status_name','=','Stamped_Signed')->value('id');
        }else{
            $Agrstatus = ApplicationStatusMaster::where('status_name','=','Stamped_Signed_by_dycdo')->value('id');    
        }
                  
        $folderName = "renewal_Stamp_Sign_Lease_Agreement"; 

        if ($file) {
            $extension = $file->getClientOriginalExtension(); 
            $fileName = time().'_lease_'.$applicationId.'.'.$extension;
            $path = $folderName.'/'.$fileName;


            $LeaseId = $this->conveyance->getScAgreementId($LeaseAgreement,$Applicationtype);
            
            if ($extension == "pdf") {
                
                Storage::disk('ftp')->delete($request->oldLeaseFile);
                $this->CommonController->ftpFileUpload($folderName,$file,$fileName);
                $leaseData = $this->getRenewalAgreement($LeaseId,$applicationId,$Agrstatus);
                   
                if ($leaseData){
                    $this->updateRenewalAgreement($applicationId,$LeaseId,$path,$Agrstatus);                    
                }else{
                    $this->createRenewalAgreement($applicationId,$LeaseId,$path,$Agrstatus);
                }
                $status = 'success';                
            }            
        } 
        
        //save remark    
        if ($request->remark){
          $this->renewalAgreementComment($applicationId,$request->remark,$Applicationtype);  
        }
        
        if (isset($status) && $status == 'success'){
            return back()->with('success', 'Agreements uploaded successfully.'); 
        } else{
            return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
        }                       
    } 

    public function registeredRenewalAgreement(Request $request,$applicationId){

        $applicationId = decrypt($applicationId);
        $data = RenewalApplication::where('id',$applicationId)->first();
        $LeaseAgreement  = config('commanConfig.scAgreements.renewal_lease_deed_agreement');

        $Agreementstatus = ApplicationStatusMaster::where('status_name','=','Register')->value('id');
        $LeaseId = $this->conveyance->getScAgreementId($LeaseAgreement,$data->application_master_id);
        $data->RegisterAgreement = $this->getRenewalAgreement($LeaseId,$applicationId,$Agreementstatus);
        $data->folder = $this->conveyance->getCurrentRoleFolderName();    
        $data->status = $this->getCurrentStatus($applicationId,$data->application_master_id);
        $data->AgreementComments = RenewalAgreementComments::with('Roles')->where('application_id',$applicationId)->where('agreement_type_id',$data->application_master_id)->whereNotNull('remark')->get();

        //get Registered Agreement details
        $LeaseId  = $this->conveyance->getScAgreementId($LeaseAgreement,$data->application_master_id,NULL);
        $data->lease_registration = scRegistrationDetails::where('application_id',$applicationId)
        ->where('agreement_type_id',$LeaseId)->first();        
        
        return view('admin.renewal.common.registered_renewal',compact('data'));    
    }        

    // get agreement as per agreement type id
    public function getRenewalAgreement($typeId,$applicationId,$status){
      
        $agreement = RenewalDocumentStatus::where('document_id',$typeId)->where('status_id',$status)->where('application_id',$applicationId)->first();
        return $agreement;
    } 

    // insert sc agreements as per type
    public function createRenewalAgreement($applicationId,$typeId,$filePath,$Agreementstatus){
        
        $ArrData[] = array('application_id'       => $applicationId,
                            'document_id'         => $typeId, 
                            'document_path'       => $filePath,
                            'status_id'           => $Agreementstatus,
                            'user_id'             => Auth::Id());   

        $data = RenewalDocumentStatus::insert($ArrData); 
        return $data;          
    }

    // update sc agreements
    public function updateRenewalAgreement($applicationId,$typeId,$filePath,$status){

        $data = RenewalDocumentStatus::where('application_id',$applicationId)->where('document_id',$typeId)->where('status_id',$status)->where('user_id',Auth::Id())->update(['document_path' => $filePath]);

        return $data;
    } 

    //insert comment for agreement
    public function RenewalAgreementComment($applicationId,$remark,$type){

        $comments[] = array('application_id' => $applicationId,
                            'user_id'        => Auth::Id(),
                            'role_id'        => session()->get('role_id'),
                            'agreement_type_id' => $type,
                            'remark'         => $remark);
        
        $remark  = RenewalAgreementComments::insert($comments);
        return $remark;
    }

    //common forward application page
    public function commonForwardApplication(Request $request,$applicationId){

        $applicationId = decrypt($applicationId);
        $data = $this->getForwardApplicationData($applicationId);
        $data->folder = $this->conveyance->getCurrentRoleFolderName();
        $data->status = $this->getCurrentStatus($applicationId,$data->application_master_id);

         // scrutiny logs       
        $societyLogs   = $this->getLogsOfSociety($applicationId,$data->application_master_id);
        $dycoLogs      = $this->getLogsOfDYCODepartment($applicationId,$data->application_master_id);
        $eelogs        = $this->getLogsOfEEDepartment($applicationId,$data->application_master_id);
        $emlogs        = $this->getLogsOfEMDepartment($applicationId,$data->application_master_id);
        $Architectlogs = $this->getLogsOfArchitectDepartment($applicationId,$data->application_master_id);
        $cologs        = $this->getLogsOfCODepartment($applicationId,$data->application_master_id);

    if (session()->get('role_name') == config('commanConfig.dyco_engineer') || session()->get('role_name') == config('commanConfig.dycdo_engineer')){

            $route = 'admin.renewal.dyco_department.forward_application';
        }     
        else{
        $route = 'admin.renewal.common.forward_application';
      }    
                  
        return view($route,compact('data','societyLogs','dycoLogs','eelogs','Architectlogs','cologs','emlogs'));         
    }  

    public function getForwardApplicationData($applicationId){

        $data = RenewalApplication::with('societyApplication')->where('id',$applicationId)->first();
        $data->society_role_id = Role::where('name', config('commanConfig.society_offer_letter'))->value('id');
        $data->status = $this->getCurrentStatus($applicationId,$data->sc_application_master_id);
        $data->parent = $this->conveyance->getForwardApplicationParentData();
        $data->child  = $this->conveyance->getRevertApplicationChildData($data->society_id);
       
        return $data;        
    }

    // forward and revert application
    public function saveForwardApplication(Request $request){
         // dd($request);
        $Scstatus = "";
        $data = RenewalApplication::where('id',$request->applicationId)->first();

        $applicationStatus = $data->application_status;
        $masterId = $data->application_master_id;

        $dycdoId =  Role::where('name',config('commanConfig.dycdo_engineer'))->value('id');  
        $dycoId =  Role::where('name',config('commanConfig.dyco_engineer'))->value('id'); 
         
        if ($request->check_status == 1) {
            $status = config('commanConfig.renewal_status.forwarded');   
            $toUsers = $request->to_user_id;             
        }else{
            $status = config('commanConfig.renewal_status.reverted');
            $toUsers = $request->to_child_id;
        }
        
        if (session()->get('role_name') == config('commanConfig.ee_branch_head') && $request->to_role_id == $dycdoId) {
       
            $Tostatus = config('commanConfig.renewal_status.Draft_Renewal_of_Lease_deed');
            $Scstatus = $Tostatus;

        } elseif (session()->get('role_name') == config('commanConfig.joint_co') && $request->to_role_id == $dycdoId){
               
            if ($applicationStatus == config('commanConfig.renewal_status.Draft_Renewal_of_Lease_deed')){

                $Tostatus = config('commanConfig.renewal_status.Aproved_Renewal_of_Lease');
                $Scstatus = $Tostatus;
                
            } else if ($applicationStatus == config('commanConfig.renewal_status.Stamp_Renewal_of_Lease_deed')){

                $Tostatus = config('commanConfig.renewal_status.Stamp_Sign_Renewal_of_Lease_deed');
                $Scstatus = $Tostatus;
                
            }else{
                $Tostatus = $applicationStatus;
                $Scstatus = $Tostatus;
            }
        }elseif((session()->get('role_name') == config('commanConfig.dycdo_engineer') && $request->to_role_id == $dycoId)){
            if ($applicationStatus == config('commanConfig.renewal_status.Aproved_Renewal_of_Lease')){

                $Tostatus = config('commanConfig.renewal_status.Sent_society_to_pay_stamp_duety');
                $Scstatus = $Tostatus;

            }else if ($applicationStatus == config('commanConfig.renewal_status.Stamp_Sign_Renewal_of_Lease_deed')){

                $Tostatus = config('commanConfig.renewal_status.Send_society_for_registration_of_Lease_deed');
                $Scstatus = $Tostatus;

            } else{

                $Tostatus = $applicationStatus;
                $Scstatus = $Tostatus;
            }
        }else{
            $Tostatus = $applicationStatus;
        }

        foreach($toUsers as $to_user_id){
            $user_data = User::find($to_user_id);
          
            $application = [[
                'application_id' => $request->applicationId,
                'user_id'        => Auth::user()->id,
                'role_id'        => session()->get('role_id'),
                'status_id'      => $status,
                'to_user_id'     => $to_user_id,
                'to_role_id'     => $user_data->role_id,
                'remark'         => $request->remark,
                'is_active'      => 1,
                'application_master_id' => $masterId,
                'created_at'     => Carbon::now(),
            ],
            [
                'application_id' => $request->applicationId,
                'user_id'       => $to_user_id,
                'role_id'       => $user_data->role_id,
                'status_id'     => $Tostatus,
                'to_user_id'    => null,
                'to_role_id'    => null,
                'remark'        => $request->remark,
                'is_active'     => 1,
                'application_master_id' => $masterId,
                'created_at'    => Carbon::now(),
            ],
            ];
            
            DB::beginTransaction();
            try{
                
                RenewalApplicationLog::where('application_id',$request->applicationId)
                    ->whereIn('user_id', [Auth::user()->id,$to_user_id ])
                    ->update(array('is_active' => 0));  
                                  
                RenewalApplicationLog::insert($application); 
                
                if ($Scstatus != ""){
                    
                    RenewalApplication::where('id',$request->applicationId)->where('application_master_id',$masterId)
                    ->update(['application_status' => $Tostatus, 'sent_to_society' => 0]);                    
                }
             DB::commit();    
            }catch (\Exception $ex) {
                 
                DB::rollback();
            }
        }

        return back()->with('success','Application send successfully..');
    }     

    // get current status of application
    public function getCurrentStatus($application_id,$masterId)
    {
        $current_status = RenewalApplicationLog::where('application_id', $application_id)
            ->where('application_master_id',$masterId)
            ->where('user_id', Auth::user()->id)
            ->where('role_id', session()->get('role_id'))
            ->orderBy('id', 'desc')->first();
   
        return $current_status;
    }

    // get logs of Society
    public function getLogsOfSociety($applicationId,$masterId)
    {
        $roles = array(config('commanConfig.society_offer_letter'));

        $status = array(config('commanConfig.renewal_status.forwarded'), config('commanConfig.renewal_status.reverted'));

        $societyRoles = Role::whereIn('name', $roles)->pluck('id');
        $ocietylogs  = RenewalApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('society_flag','=','1')->where('application_master_id',$masterId)->whereIn('role_id', $societyRoles)->whereIn('status_id', $status)->get();

        return $ocietylogs;
    }      

    // get logs of DYCO dept
    public function getLogsOfDYCODepartment($applicationId,$masterId)
    {

        $roles = array(config('commanConfig.dycdo_engineer'), config('commanConfig.dyco_engineer'));
        $status = array(config('commanConfig.renewal_status.forwarded'), config('commanConfig.renewal_status.reverted'));

        $dycoRoles = Role::whereIn('name', $roles)->pluck('id');
        $dycologs  = RenewalApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)
        ->where('application_master_id',$masterId)->whereIn('role_id', $dycoRoles)->whereIn('status_id', $status)->get();

        return $dycologs;
    } 

    // get logs of EE dept
    public function getLogsOfEEDepartment($applicationId,$masterId)
    {

        $roles = array(config('commanConfig.ee_junior_engineer'), config('commanConfig.ee_deputy_engineer'), config('commanConfig.ee_branch_head'));
        $status = array(config('commanConfig.renewal_status.forwarded'), config('commanConfig.renewal_status.reverted'));

        $eeRoles = Role::whereIn('name', $roles)->pluck('id');
        $eelogs  = RenewalApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('application_master_id',$masterId)->whereIn('role_id', $eeRoles)->whereIn('status_id', $status)->get();

        return $eelogs;
    }

    // get logs of EM dept
    public function getLogsOfEMDepartment($applicationId,$masterId)
    {

        $roles = array(config('commanConfig.estate_manager'));
        $status = array(config('commanConfig.renewal_status.forwarded'), config('commanConfig.renewal_status.reverted'));

        $emRoles = Role::whereIn('name', $roles)->pluck('id');
        $emlogs  = RenewalApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)
        ->where('application_master_id',$masterId)->whereIn('role_id', $emRoles)->whereIn('status_id', $status)->get();

        return $emlogs;
    }     

    // get logs of Architect dept
    public function getLogsOfArchitectDepartment($applicationId,$masterId)
    {

        $roles = array(config('commanConfig.junior_architect'), config('commanConfig.senior_architect'), config('commanConfig.architect'));
        $status = array(config('commanConfig.renewal_status.forwarded'), config('commanConfig.renewal_status.reverted'));

        $ArchitectRoles = Role::whereIn('name', $roles)->pluck('id');
        $Architectlogs  = RenewalApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('application_master_id',$masterId)->whereIn('role_id', $ArchitectRoles)->whereIn('status_id', $status)->get();

        return $Architectlogs;
    }

    // get logs of CO and JTCO dept
    public function getLogsOfCODepartment($applicationId,$masterId)
    {
        $roles = array(config('commanConfig.co_engineer'), config('commanConfig.joint_co'));
        $status = array(config('commanConfig.renewal_status.forwarded'), config('commanConfig.renewal_status.reverted'));

        $coRoles = Role::whereIn('name', $roles)->pluck('id');
        $cologs  = RenewalApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('application_master_id',$masterId)->whereIn('role_id', $coRoles)->whereIn('status_id', $status)->get();

        return $cologs;
    } 

    public function SaveAgreementComments(Request $request){

        $applicationId = $request->application_id;
        $remark        = $request->remark;
        $masterId      = RenewalApplication::where('id',$applicationId)->value('application_master_id');  
        
        if ($remark){
            $result = $this->renewalAgreementComment($applicationId,$remark,$masterId);     
        } 
        return back()->with('success','Comments save Successfully.');             
    }

    //ee scrunity page
    public function RenewalEEScrunityRemark(Request $request,$applicationId){
        
        $applicationId = decrypt($applicationId);    
        $data = RenewalApplication::with('societyApplication')->where('id',$applicationId)->first();
        $data->documents = RenewalEEScrutinyDocuments::where('application_id',$applicationId)->get();
        $is_view = session()->get('role_name') == config('commanConfig.ee_junior_engineer');
        $status = $this->getCurrentStatus($applicationId,$data->application_master_id);
        $data->folder = $this->conveyance->getCurrentRoleFolderName();

        if ($is_view && $status->status_id == config('commanConfig.renewal_status.in_process')){
            $route = 'admin.renewal.ee_department.ee_scrutiny_remark';
        }else{
            $route = 'admin.renewal.common.view_ee_scrutiny_remark';
        }
        return view($route, compact('data'));
    }  

    // Architect scrutiny page
    public function RenewalArchitectScrunity(Request $request,$applicationId){

        $applicationId = decrypt($applicationId);
        $data = RenewalApplication::with('societyApplication')->where('id',$applicationId)->first();
        $data->documents = RenewalArchitectScrutinyDocuments::where('application_id',$applicationId)->get();

        $is_view = session()->get('role_name') == config('commanConfig.junior_architect');
        $status = $this->getCurrentStatus($applicationId,$data->application_master_id);
        $data->folder = $this->conveyance->getCurrentRoleFolderName();

        if ($is_view && $status->status_id == config('commanConfig.renewal_status.in_process')){
           $route = 'admin.renewal.architect_department.architect_scrutiny_remark';
        }else{
            $route = 'admin.renewal.common.view_architect_scrutiny_remark';
        }
        return view($route, compact('data'));
    } 

    public function uploadArchitectDocuments(Request $request){

        $file = $request->file('file');
        $applicationId = $request->application_id;

        if ($file->getClientMimeType() == 'application/pdf') {

            $extension = $request->file('file')->getClientOriginalExtension();
            $folderName = 'Renewal_Architect_documents';
            $fileName = time().'_architect_'.$applicationId.'.'.$extension;

            $this->CommonController->ftpFileUpload($folderName,$file,$fileName);
            
            $Documents = new RenewalArchitectScrutinyDocuments();
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

    // delete Architect scrutiny documents through ajax
    public function deleteRenewalArchitectDocument(Request $request){
       
        if (isset($request->oldFile) && isset($request->key)){
            Storage::disk('ftp')->delete($request->oldFile);
            RenewalArchitectScrutinyDocuments::where('id',$request->key)->delete(); 
            $status = 'success';           
        }else{
             $status = 'error';
        }
        return $status;
    }

    //save scrunity data fil by Architect
    public function SaveArchitectScrutinyRemark(Request $request){
        
        $applicationId = $request->application_id; 
        
        $data = RenewalApplication::where('id',$applicationId)->first();
        if ($data){
            RenewalApplication::where('id',$applicationId)->update(['is_sanctioned_oc' => $request->is_sanctioned_oc, 'sanctioned_comments' => $request->sanctioned_comments , 'is_additional_fsi' => $request->is_additional_fsi , 'additional_fsi_comments' => $request->additional_fsi_comments ]);   
        }
        return back()->with('success','Data uploaded successfully.');

    }

    //view documents in readonly format
    public function ViewSocietyDocuments(Request $request, $applicationId){
        
        $applicationId = decrypt($applicationId);
        $data = RenewalApplication::where('id',$applicationId)->first();
        $data->folder = $this->conveyance->getCurrentRoleFolderName();
        $documents = SocietyConveyanceDocumentMaster::with(['sr_document_status' => function($q) use($data) { $q->where('application_id', $data->id)->get(); }])->where('application_type_id', $data->application_master_id)->where('society_flag', '1')->where('document_name', '!=', 'stamp_renewal_application')->get();
        $documents_uploaded = RenewalDocumentStatus::where('application_id', $data->id)->get();   
        return view('admin.renewal.common.view_documents', compact('data', 'documents', 'documents_uploaded'));
    }

    // save draft and sign uploaded by JTCO
    public function saveDraftSignRenewalAgreement(Request $request){
       
        $applicationId   = $request->applicationId;  
        $file = $request->file('lease_agreement'); 
        $LeaseAgreement = config('commanConfig.scAgreements.renewal_lease_deed_agreement');
        
        $data = RenewalApplication::where('id',$applicationId)->first();        
        $Applicationtype = $data->application_master_id;

        $Agrstatus = ApplicationStatusMaster::where('status_name','=','Draft_Sign')->value('id');          
        $folderName = "renewal_prepare_Lease_Agreement";
        
        if ($file) {

            $extension = $file->getClientOriginalExtension(); 
            $fileName = time().'_lease_'.$applicationId.'.'.$extension;
            $path = $folderName.'/'.$fileName;

            $draftLeaseId = $this->conveyance->getScAgreementId($LeaseAgreement,$Applicationtype);
            if ($extension == "pdf") {
                
                Storage::disk('ftp')->delete($request->oldLeaseFile);
                $this->CommonController->ftpFileUpload($folderName,$file,$fileName);
                $leaseData = $this->getRenewalAgreement($draftLeaseId,$applicationId,$Agrstatus);
               
                if ($leaseData){
                    $this->updateRenewalAgreement($applicationId,$draftLeaseId,$path,$Agrstatus);                    
                }else{
                    $this->createRenewalAgreement($applicationId,$draftLeaseId,$path,$Agrstatus);
                }
                $status = 'success';                
            }            
        }
        if ($request->remark){
          $this->renewalAgreementComment($applicationId,$request->remark,$Applicationtype);  
        }
        
        if (isset($status) && $status == 'success'){
            return back()->with('success', 'Submitted successfully.'); 
        } else{
            return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
        }            
    }
 
    // get document id as per document name
    public function getDocumentIds($documentNames,$type){

        $typeId = SocietyConveyanceDocumentMaster::with(['sr_document_status'])->whereIn('document_name',$documentNames)->where('application_type_id',$type)->get();
        return $typeId;
    }

    /**
     * Displays the sale & lease deed agreements riders forms.
     *Author: Amar Prajapati
     * @param  int  $applicationId
     * @return \Illuminate\Http\Response
     */
    public function la_agreement_riders($applicationId){
//        dd($applicationId);
        $sc_application = RenewalApplication::with(['sr_form_request', 'societyApplication', 'applicationLayout', 'srApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->where('id', $applicationId)->first();
        $documents_req = array(
            config('commanConfig.documents.la_renewal.Lease Deed Agreement')
        );

        $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Renewal'))->value('id');
        $document_id = $this->conveyance->getDocumentId(config('commanConfig.documents.la_renewal.Lease Deed Agreement'), $application_type);
//        dd($document_id);
        $uploaded_document_ids = RenewalDocumentStatus::where('document_id', $document_id)->get();
        $sc_agreement_comment = RenewalAgreementComments::with('srAgreementId')->get();
        $data = $sc_application;
//        dd($uploaded_document_ids);
        return view('admin.renewal.la_department.sale_lease_deed', compact('sc_application','uploaded_document_ids', 'documents', 'document_id', 'sc_agreement_comment', 'data'));
    }

    /**
     * Uploads the sale & lease deed agreements riders.
     *Author: Amar Prajapati
     * @param  int  $applicationId
     * @return \Illuminate\Http\Response
     */
    public function upload_la_agreement_riders(Request $request){
        if($request->hasFile('document_path')){
//            dd($request->all());
            $file = $request->file('document_path');
            $file_name = time().$file->getFileName().'.'.$file->getClientOriginalExtension();
            $extension = $request->file('document_path')->getClientOriginalExtension();
            if ($extension == "pdf") {
                $time = time();
                $name = File::name($request->file('document_path')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                $folder_name = "la_agreements";
                $path = config('commanConfig.storage_server').'/'.$folder_name.'/'.$name;
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('document_path'),$name);

                $sc_document_status = new RenewalDocumentStatus;
                $sc_document_status_arr = array_flip($sc_document_status->getFillable());

                $sc_document_status_arr['application_id'] = $request->application_id;
                $sc_document_status_arr['user_id'] = Auth::user()->id;
                $sc_document_status_arr['society_flag'] = 0;
                $sc_document_status_arr['status_id'] = null;
                $sc_document_status_arr['document_id'] = $request->document_id;
                $sc_document_status_arr['document_path'] = $path;

                $inserted_document_log = RenewalDocumentStatus::create($sc_document_status_arr);

                if($inserted_document_log == true){
                    return redirect()->route('renewal.la_agreement_riders', $request->application_id);
                }

            }else{
                return redirect()->back()->with('error_uploaded_file', 'Invalid type of file uploaded (only pdf allowed)');
            }
        }else{
            $update_arr = array(
                'riders' => $request->remark
            );

            $updated_rides = RenewalApplication::where('id', $request->application_id)->update($update_arr);
            if($updated_rides == 1){
                return redirect()->route('renewal.la_agreement_riders', $request->application_id);
            }
        }
    }


    /**
     * Uploads document status.
     * Author: Amar Prajapati
     * @param  int  $applicationId, $document, $documentPath, $status
     * @return \Illuminate\Http\Response
     */
    public function uploadDocumentStatus($applicationId,$document,$documentPath, $status=NULL){

        $masterId   = RenewalApplication::where('id',$applicationId)->value('application_master_id');
        $documentId = SocietyConveyanceDocumentMaster::where('document_name',$document)
            ->where('application_type_id',$masterId)->value('id');

        $DocumentStatus = RenewalDocumentStatus::where('application_id',$applicationId)->where('document_id',$documentId)->where('user_id',Auth::Id())->first();

        if(Session::get('role_name') == config('commanConfig.society_offer_letter')){
            $society_flag = 1;
        }else{
            $society_flag = 0;
        }
        if (!$DocumentStatus){
            $DocumentStatus = new RenewalDocumentStatus();
        }

        $DocumentStatus->application_id = $applicationId;
        $DocumentStatus->user_id        = Auth::Id();
        $DocumentStatus->status_id        = $status;
        $DocumentStatus->society_flag    = $society_flag;
        $DocumentStatus->document_id    = $documentId;
        $DocumentStatus->document_path  = $documentPath;
        $DocumentStatus->save();

        return $DocumentStatus;
    }

    // Dashboard for Renewal start here

    public function RenewalDashboard(){

        $role_id = session()->get('role_id');
        $user_id = Auth::id();
        $applicationData = $this->getApplicationData($role_id,$user_id);
        $parentName      = $this->getParentName();
        $statusCount     = $this->getApplicationStatusCount($applicationData,$parentName);

        return $statusCount;
    } 

    public function getRenewalRoles(){

        $is_view = array(config('commanConfig.dycdo_engineer'),config('commanConfig.dyco_engineer'),config('commanConfig.ee_junior_engineer'),config('commanConfig.ee_branch_head'),config('commanConfig.ee_deputy_engineer'),config('commanConfig.estate_manager'),config('commanConfig.joint_co'),config('commanConfig.junior_architect'),config('commanConfig.senior_architect'),config('commanConfig.architect'));

        return $is_view;

    } 

    public function getApplicationData($role_id,$user_id){
        
        $applicationData = RenewalApplication::with([
            'renewalApplicationLog' => function ($q) use ($role_id,$user_id) {
                $q->where('user_id', $user_id)
                    ->where('role_id', $role_id)
                    ->where('society_flag', 0)
                    ->where('is_active',1)
                    ->orderBy('id', 'desc');
            }])
            ->whereHas('renewalApplicationLog', function ($q) use ($role_id,$user_id) {
                $q->where('user_id', $user_id)
                    ->where('role_id', $role_id)
                    ->where('society_flag', 0)
                    ->where('is_active',1)
                    ->orderBy('id', 'desc');
            })->get()->toArray();

        return $applicationData;
    }

    public function getParentName(){
        
        $parent_name = "";
        $role_name = session()->get('role_name');
        
        if ($role_name == config('commanConfig.dycdo_engineer')){
            $parent_name = 'DYCO Engineer';

        } else if ($role_name == config('commanConfig.ee_junior_engineer')){
            $parent_name = 'EE Deputy Engineer';
        } else if ($role_name == config('commanConfig.ee_deputy_engineer')){
            $parent_name = 'EE Engineer';
        } else if ($role_name == config('commanConfig.junior_architect')){
            $parent_name = 'Senior Architect';
        }else if ($role_name == config('commanConfig.senior_architect')){
            $parent_name = 'Architect Head';
        }

        return $parent_name;   
    }

    public function getApplicationStatusCount($applicationData,$parentName){
        
        $sendForApproval = $totalPending = $sendToSocietycount = $forwardApplication = $sendForStampDuty = $sendForRegistration = $nocIssued = $revertApplication =$inprocess = $draft = $approve = $stamp = $stampSign = $registered = $StampDuty = $Registration = 0 ;
                
        $role_name   = session()->get('role_name');
        $can_revert  = $this->displayRevertVisibleRole($role_name);
        $can_forward = $this->displayForwardVisibleRole($role_name);
        $statusArr   = $this->getAllStatus(); 
        
        foreach ($applicationData as $application){
            
            $status = $application['renewal_application_log']['status_id']; 

            $sendForApprovalCondition = ($application['application_status'] != $statusArr['inprocess'] && $status == 
                $statusArr['forwarded'] && $application['sent_to_society'] == 0);

            $applicationForwarded = (($application['application_status'] == $statusArr['inprocess'] || $application['application_status'] == $statusArr['registered']) && $status == 
                $statusArr['forwarded'] && $application['sent_to_society'] == 0 && $can_forward);

            $applicationReverted    = ($status == $statusArr['reverted'] && $can_revert);
            $sendToSocietyCondition = $status == $statusArr['forwarded'] && ($application['sent_to_society'] == 1);
            $sendForStampDutyCondition = ($status == $statusArr['forwarded'] && ($application['sent_to_society'] == 1 && $application['application_status'] == $statusArr['stampDuty']));            

            $sendForRegistrationCondition = ($status == $statusArr['forwarded'] && ($application['sent_to_society'] == 1 && $application['application_status'] == $statusArr['sendForRegistration']));

            $nocIssuedCondition = ($status == $statusArr['forwarded'] && ($application['sent_to_society'] == 1 && $application['application_status']));

            $inprocessCondition = ($status == $statusArr['inprocess']);
            $draftCondition     = ($status == $statusArr['draft']);
            $approveCondition   = ($status == $statusArr['approve']);
            $stampCondition     = ($status == $statusArr['stamp']);
            $stampSignCondition = ($status == $statusArr['stampSign']);
            $registerCondition  = ($status == $statusArr['registered']);
            $RegistrationCondition = ($status == $statusArr['sendForRegistration'] && $application['sent_to_society'] == 0);
           
            $payDutyCondition = ($status == $statusArr['stampDuty'] && $application['sent_to_society'] == 0);

            switch ($status)
            {                
                case $sendForApprovalCondition      : $sendForApproval       += 1; break;
                case $sendForStampDutyCondition     :  $sendForStampDuty      += 1; break;
                case $sendForRegistrationCondition  :  $sendForRegistration   += 1; break;
                // case $nocIssuedCondition            : $nocIssued             += 1; break;
                case $applicationForwarded          :  $forwardApplication    += 1; break;
                case $applicationReverted           :  $revertApplication     += 1; break;

                case $inprocessCondition     :  $inprocess        += 1; break;
                case $draftCondition         : $draft            += 1; break;
                case $approveCondition       : $approve          += 1; break;
                case $stampCondition         : $stamp            += 1; break;
                case $stampSignCondition     : $stampSign        += 1; break;
                case $registerCondition      : $registered       += 1; break;
                case $RegistrationCondition  : $Registration     += 1; break;
                case $payDutyCondition       : $StampDuty        += 1; break;
                default:
                ; break;
            }
           // print_r($forwardApplication);
        }
        
        $totalPending = $inprocess + $draft + $approve + $stamp + $stampSign + $registered; 

        //Application pending Bifergation    

        $separation['In Process']  = $inprocess;
        $separation['Draft']      = $draft;
        $separation['Approve']    = $approve;
        $separation['Stamp']      = $stamp;
        $separation['Stamp & Sign']  = $stampSign;
        $separation['Registered'] = $registered;


        if ($role_name == config('commanConfig.dyco_engineer')){
            $separation['send For Stamp Duty']     = $StampDuty;
            $separation['send For Registration']  = $Registration;

            $totalPending =  $totalPending + $Registration + $StampDuty;  
        }

        //send to society Bifergation
        $sendToSociety['Send For Stamp Duty']    = $sendForStampDuty;
        $sendToSociety['Send For Registration'] = $sendForRegistration;

        
        $sendToSocietycount = $sendForRegistration + $sendForStampDuty;
        
        $totalApplication = count($applicationData);

        $count['Total No of Applications'][0] = $totalApplication;
        $count['Total No of Applications'][1] = 'renewal';
        $count['Applications Pending'][0]     = $totalPending;
        $count['Applications Pending'][1]     = 'pending';
        $count['Draft Sale & Lease Deed sent for Approval'][0] = $sendForApproval;
        $count['Draft Sale & Lease Deed sent for Approval'][1] = 'renewal?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');
        $count['Sent to Society'][0] = $sendToSocietycount;
        $count['Sent to Society'][1] = 'sendToSociety';

        if ($can_forward){
            if ($parentName != ""){
                
                $count['Applications Forwarded to '.$parentName][0] = $forwardApplication;
                $count['Applications Forwarded to '.$parentName][1] = 'renewal?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');                

            }else{
                $count['Applications Forwarded'][0] = $forwardApplication;
                $count['Applications Forwarded'][1] = 'renewal?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded'); 
            }
        }    

        if ($can_revert){
                
                $count['Applications Reverted'][0] = $revertApplication;
                $count['Applications Reverted'][1] = 'renewal?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.reverted');             
        }
        $dashboard = array($count,$separation,$sendToSociety);
        return $dashboard;
    } 

    public function getApplicationPendingAtDepartment(){
       
       $dycdoRoles     = $this->CommonController->getDYCDORoles();
       $eeRoles        = $this->CommonController->getEERoles1();
       $emRoles        = $this->CommonController->getEMRoles();
       $jtcoRoles      = $this->CommonController->getJTCORoles();
       $architectRoles = $this->CommonController->getArchitectRoles();

       $pendingAtDYCDO     = $this->pendingApplicationCount($dycdoRoles);
       $pendingAtEE        = $this->pendingApplicationCount($eeRoles);
       $pendingAtEM        = $this->pendingApplicationCount($emRoles);
       $pendingAtJTCO      = $this->pendingApplicationCount($jtcoRoles);
       $pendingAtArchitect = $this->pendingApplicationCount($architectRoles);

       $pendingAtDepartments = array();
       $pendingAtDepartments['Applications pending At DYCO']     = $pendingAtDYCDO;
       $pendingAtDepartments['Applications pending At EE']        = $pendingAtEE;
       $pendingAtDepartments['Applications pending At Architect'] = $pendingAtArchitect;
       $pendingAtDepartments['Applications pending At EM']        = $pendingAtEM;
       $pendingAtDepartments['Applications pending At JTCO']      = $pendingAtJTCO;

       return $pendingAtDepartments; 
    }

    public function pendingApplicationCount($roles){

        $status = array(config('commanConfig.renewal_status.in_process'),config('commanConfig.renewal_status.Draft_Renewal_of_Lease_deed'),config('commanConfig.renewal_status.Aproved_Renewal_of_Lease'),config('commanConfig.renewal_status.Sent_society_to_pay_stamp_duety'),config('commanConfig.renewal_status.NOC_Generation'));

        $count = RenewalApplicationLog::where('is_active',1)
            ->whereIn('status_id',$status)
            ->whereIn('role_id',$roles)
            ->get()->count();

        return $count;    
    }

    public function displayForwardVisibleRole($role_name){

        $roles = ($role_name == config('commanConfig.dyco_engineer') ||$role_name == config('commanConfig.dycdo_engineer') || $role_name == config('commanConfig.ee_deputy_engineer') || $role_name == config('commanConfig.ee_branch_head') || $role_name == config('commanConfig.senior_architect') || $role_name == config('commanConfig.architect') || $role_name == config('commanConfig.ee_junior_engineer') || $role_name == config('commanConfig.junior_architect') || $role_name == config('commanConfig.dycdo_engineer') || $role_name == config('commanConfig.estate_manager'));

        return  $roles; 
    }

    public function displayRevertVisibleRole($role_name){

        $roles = ($role_name == config('commanConfig.dyco_engineer') || $role_name == config('commanConfig.ee_deputy_engineer') || $role_name == config('commanConfig.ee_branch_head') || $role_name == config('commanConfig.senior_architect') || $role_name == config('commanConfig.architect') || $role_name == config('commanConfig.joint_co'));
        return  $roles;
    }

    public function getAllStatus(){

        $status['inprocess'] = config('commanConfig.renewal_status.in_process');
        $status['forwarded'] = config('commanConfig.renewal_status.forwarded');
        $status['reverted']  = config('commanConfig.renewal_status.reverted');
        $status['draft']     = config('commanConfig.renewal_status.Draft_Renewal_of_Lease_deed');
        $status['approve']   = config('commanConfig.renewal_status.Aproved_Renewal_of_Lease');
        $status['stampDuty'] = config('commanConfig.renewal_status.Sent_society_to_pay_stamp_duety');
        $status['stamp']       = config('commanConfig.renewal_status.Stamp_Renewal_of_Lease_deed');
        $status['stampSign']       = config('commanConfig.renewal_status.Stamp_Sign_Renewal_of_Lease_deed');
        $status['sendForRegistration']  = config('commanConfig.renewal_status.Send_society_for_registration_of_Lease_deed');
        $status['registered']       = config('commanConfig.renewal_status.Registered_lease_deed');

        return $status;
    }     
}
