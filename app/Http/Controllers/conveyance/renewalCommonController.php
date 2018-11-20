<?php

namespace App\Http\Controllers\conveyance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\conveyance\conveyanceCommonController;
use App\Http\Controllers\Common\CommonController;
use App\conveyance\scApplicationType;
use App\conveyance\RenewalApplication;
use App\conveyance\RenewalDocumentStatus;
use App\conveyance\RenewalAgreementComments;
use App\conveyance\RenewalApplicationLog;
use App\conveyance\RenewalEEScrutinyDocuments;
use App\ApplicationStatusMaster;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Role;
use Config;
use Storage;
use Auth;

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
                    $url = route('renewal.view_application', $data->id);
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
                            $config_array = array_flip(config('commanConfig.applicationStatus'));
                            $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                            return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$status) .' m-badge--wide">'.$value.'</span>';
                        }
                    }else{
                        $config_array = array_flip(config('commanConfig.applicationStatus'));

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
        $applicationData = $applicationData->orderBy('renewal_application.id', 'desc')->get();
        $listArray = [];

        if ($request->update_status) {

            foreach ($applicationData as $app_data) {
                if ($app_data->scApplicationLog[0]->status_id == $request->update_status) {
                    $listArray[] = $app_data;
                }
            }
        } else {
            $listArray = $applicationData;
        } 
        return $listArray;       	
    }

    public function ViewApplication(Request $request,$applicationId){
        $data = RenewalApplication::where('id',$applicationId)->first();
        $data->folder = $this->conveyance->getCurrentRoleFolderName();

        return view('admin.renewal.common.view_application',compact('data'));
    }

    //prepare renewal lease Agreement
    public function PrepareRenewalAgreement(Request $request,$applicationId){

        $data = RenewalApplication::where('id',$applicationId)->first();
        $LeaseAgreement  = config('commanConfig.scAgreements.renewal_lease_deed_agreement');
        $Agreementstatus = ApplicationStatusMaster::where('status_name','=','Draft')->value('id');
        $LeaseId         = $this->conveyance->getScAgreementId($LeaseAgreement,$data->application_master_id);
        $data->renewalAgreement = $this->getRenewalAgreement($LeaseId,$applicationId,$Agreementstatus);
        $data->folder   = $this->conveyance->getCurrentRoleFolderName();

        $data->AgreementComments = RenewalAgreementComments::with('Roles')->where('application_id',$applicationId)->where('agreement_type_id',$data->application_master_id)->whereNotNull('remark')->get();
        
        $is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer');
        $data->status = $this->getCurrentStatus($applicationId,$data->application_master_id);

        if ($is_view && $data->status->status_id == config('commanConfig.applicationStatus.Draft_sale_&_lease_deed')) {
            $route = 'admin.renewal.dyco_department.draft_renewal_agreement';
        }else{
            $route = 'admin.renewal.common.view_draft_renewal_agreement';
        }

        return view($route,compact('data'));  
    }

    //Approve renewal lease Agreement
    public function ApproveRenewalAgreement(Request $request,$applicationId){
        
        $data = RenewalApplication::where('id',$applicationId)->first();
        $LeaseAgreement  = config('commanConfig.scAgreements.renewal_lease_deed_agreement');
        $Agreementstatus = ApplicationStatusMaster::where('status_name','=','Approved')->value('id');
        $LeaseId = $this->conveyance->getScAgreementId($LeaseAgreement,$data->application_master_id);
        $data->renewalAgreement = $this->getRenewalAgreement($LeaseId,$applicationId,$Agreementstatus);
        $data->folder = $this->conveyance->getCurrentRoleFolderName();  

        $data->AgreementComments = RenewalAgreementComments::with('Roles')->where('application_id',$applicationId)->where('agreement_type_id',$data->application_master_id)->whereNotNull('remark')->get(); 

        $is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer');
        $data->status = $this->getCurrentStatus($applicationId,$data->application_master_id);

        if ($is_view && $data->status->status_id == config('commanConfig.applicationStatus.Draft_sale_&_lease_deed')) {
            $route = 'admin.renewal.dyco_department.approve_renewal_agreement';
        }else{
            $route = 'admin.renewal.common.view_approve_renewal_agreement';
        }        

        return view($route,compact('data'));   
    }
    
    //stamp and sign Renewal lease Agreement
    public function StampRenewalAgreement(Request $request,$applicationId){
        
        $data = RenewalApplication::where('id',$applicationId)->first();
        $LeaseAgreement  = config('commanConfig.scAgreements.renewal_lease_deed_agreement');
        $Agreementstatus = ApplicationStatusMaster::where('status_name','=','Stamped_Signed')->value('id');
        $LeaseId = $this->conveyance->getScAgreementId($LeaseAgreement,$data->application_master_id);
        $data->renewalAgreement = $this->getRenewalAgreement($LeaseId,$applicationId,$Agreementstatus);
        $data->folder = $this->conveyance->getCurrentRoleFolderName(); 

        $data->AgreementComments = RenewalAgreementComments::with('Roles')->where('application_id',$applicationId)->where('agreement_type_id',$data->application_master_id)->whereNotNull('remark')->get();
        $is_view = session()->get('role_name') == config('commanConfig.co_engineer'); 
        $data->status = $this->getCurrentStatus($applicationId,$data->application_master_id); 

        if ($is_view && $data->status->status_id == config('commanConfig.applicationStatus.Stamped_signed_sale_&_lease_deed')) {
            
            $route = 'admin.renewal.co_department.stamp_renewal_agreement';
        }else{
            $route = 'admin.renewal.common.view_stamp_renewal_agreement';
        }           

        return view($route,compact('data'));
    }

    // save stamp and sign Renewal lease Agreement(from JTCO dept)
    public function saveStampRenewalAgreement(Request $request){

        $applicationId   = $request->applicationId;  
        $file = $request->file('lease_agreement'); 
        $LeaseAgreement = config('commanConfig.scAgreements.renewal_lease_deed_agreement');  
        $data = RenewalApplication::where('id',$applicationId)->first(); 
        $Applicationtype = $data->application_master_id;  
        
        $Agrstatus = ApplicationStatusMaster::where('status_name','=','Stamped_Signed')->value('id');          
        $folderName = "renewal_Stamp_Lease_Agreement"; 

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

        $data = $this->getForwardApplicationData($applicationId);
        $data->folder = $this->conveyance->getCurrentRoleFolderName();
        $data->status = $this->getCurrentStatus($applicationId,$data->application_master_id);
        $route = 'admin.renewal.dyco_department.forward_application';

         // scrutiny logs       
        $societyLogs   = $this->getLogsOfSociety($applicationId,$data->application_master_id);
        $dycoLogs      = $this->getLogsOfDYCODepartment($applicationId,$data->application_master_id);
        $eelogs        = $this->getLogsOfEEDepartment($applicationId,$data->application_master_id);
        $Architectlogs = $this->getLogsOfArchitectDepartment($applicationId,$data->application_master_id);
        $cologs        = $this->getLogsOfCODepartment($applicationId,$data->application_master_id);         
        // return view($route,compact('data','dycoLogs','eelogs','Architectlogs','cologs'));         
        return view($route,compact('data','societyLogs','dycoLogs','eelogs','Architectlogs','cologs'));         
    }  

    public function getForwardApplicationData($applicationId){

        $data = RenewalApplication::with('societyApplication')->where('id',$applicationId)->first();
        $data->society_role_id = Role::where('name', config('commanConfig.society_offer_letter'))->value('id');
        $data->status = $this->getCurrentStatus($applicationId,$data->sc_application_master_id);
        $data->parent = $this->conveyance->getForwardApplicationParentData();
        $data->child  = $this->conveyance->getRevertApplicationChildData();
       
        return $data;        
    }

    // forward and revert application
    public function saveForwardApplication(Request $request){
    
        $Scstatus = "";
        $data = RenewalApplication::where('id',$request->applicationId)->first();

        $applicationStatus = $data->application_status;
        $masterId = $data->application_master_id;

        $dycdoId =  Role::where('name',config('commanConfig.dycdo_engineer'))->value('id');  
        $dycoId =  Role::where('name',config('commanConfig.dyco_engineer'))->value('id'); 
         
        if ($request->check_status == 1) {
            $status = config('commanConfig.applicationStatus.forwarded');                
        }else{
            $status = config('commanConfig.applicationStatus.reverted');
        }
        
        if (session()->get('role_name') == config('commanConfig.ee_branch_head') && $request->to_role_id == $dycdoId) {
            $Tostatus = config('commanConfig.applicationStatus.Draft_sale_&_lease_deed');
            $Scstatus = $Tostatus;

        } elseif (session()->get('role_name') == config('commanConfig.joint_co') && $request->to_role_id == $dycdoId){
            
            if ($applicationStatus == config('commanConfig.applicationStatus.Draft_sale_&_lease_deed')){
                $Tostatus = config('commanConfig.applicationStatus.Aproved_sale_&_lease_deed');
                $Scstatus = $Tostatus;

            }elseif($applicationStatus == config('commanConfig.applicationStatus.Stamped_sale_&_lease_deed')){
                $Tostatus = config('commanConfig.applicationStatus.Stamped_signed_sale_&_lease_deed');
                $Scstatus = $Tostatus;
                
            }else{
                $Tostatus = $applicationStatus;
                $Scstatus = $Tostatus;
            }
        }elseif((session()->get('role_name') == config('commanConfig.dycdo_engineer') && $request->to_role_id == $dycoId)){
            if ($applicationStatus == config('commanConfig.applicationStatus.Aproved_sale_&_lease_deed')){

                $Tostatus = config('commanConfig.applicationStatus.Sent_society_to_pay_stamp_duety');
                $Scstatus = $Tostatus;

            }elseif($applicationStatus == config('commanConfig.applicationStatus.Stamped_signed_sale_&_lease_deed')){
                
                $Tostatus = config('commanConfig.applicationStatus.Sent_society_for_registration_of_sale_&_lease');
                $Scstatus = $Tostatus; 

            }elseif($applicationStatus == config('commanConfig.applicationStatus.Registered_sale_&_lease_deed')){
                
                $Tostatus = config('commanConfig.applicationStatus.NOC_Issued');
                $Scstatus = $Tostatus;                
            }
            else{

                $Tostatus = $applicationStatus;
                $Scstatus = $Tostatus;
            }
        }
            if (isset($applicationStatus)){
                $Tostatus = $applicationStatus;
            }else{
                $Tostatus = config('commanConfig.applicationStatus.in_process');                
            }

            $application = [[
                'application_id' => $request->applicationId,
                'user_id'        => Auth::user()->id,
                'role_id'        => session()->get('role_id'),
                'status_id'      => $status,
                'to_user_id'     => $request->to_user_id,
                'to_role_id'     => $request->to_role_id,
                'remark'         => $request->remark,
                'application_master_id' => $masterId,
                'created_at'     => Carbon::now(),
            ],
            [
                'application_id' => $request->applicationId,
                'user_id'       => $request->to_user_id,
                'role_id'       => $request->to_role_id,
                'status_id'     => $Tostatus,
                'to_user_id'    => null,
                'to_role_id'    => null,
                'remark'        => $request->remark,
                'application_master_id' => $masterId,
                'created_at'    => Carbon::now(),
            ],
            ];

            RenewalApplicationLog::insert($application); 
            if ($Scstatus != ""){
                RenewalApplicationLog::where('id',$request->applicationId)->where('sc_application_master_id',$masterId)
                ->update(['application_status' => $Tostatus]);                    
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

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $societyRoles = Role::whereIn('name', $roles)->pluck('id');
        $ocietylogs  = RenewalApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('society_flag','=','1')->where('application_master_id',$masterId)->whereIn('role_id', $societyRoles)->whereIn('status_id', $status)->get();

        return $ocietylogs;
    }      

    // get logs of DYCO dept
    public function getLogsOfDYCODepartment($applicationId,$masterId)
    {

        $roles = array(config('commanConfig.dycdo_engineer'), config('commanConfig.dyco_engineer'));
        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $dycoRoles = Role::whereIn('name', $roles)->pluck('id');
        $dycologs  = RenewalApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)
        ->where('application_master_id',$masterId)->whereIn('role_id', $dycoRoles)->whereIn('status_id', $status)->get();

        return $dycologs;
    } 

    // get logs of EE dept
    public function getLogsOfEEDepartment($applicationId,$masterId)
    {

        $roles = array(config('commanConfig.ee_junior_engineer'), config('commanConfig.ee_deputy_engineer'), config('commanConfig.ee_branch_head'));
        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $eeRoles = Role::whereIn('name', $roles)->pluck('id');
        $eelogs  = RenewalApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('application_master_id',$masterId)->whereIn('role_id', $eeRoles)->whereIn('status_id', $status)->get();

        return $eelogs;
    }

    // get logs of Architect dept
    public function getLogsOfArchitectDepartment($applicationId,$masterId)
    {

        $roles = array(config('commanConfig.junior_architect'), config('commanConfig.senior_architect'), config('commanConfig.architect'));
        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $ArchitectRoles = Role::whereIn('name', $roles)->pluck('id');
        $Architectlogs  = RenewalApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('application_master_id',$masterId)->whereIn('role_id', $ArchitectRoles)->whereIn('status_id', $status)->get();

        return $Architectlogs;
    }

    // get logs of CO and JTCO dept
    public function getLogsOfCODepartment($applicationId,$masterId)
    {
        $roles = array(config('commanConfig.co_engineer'), config('commanConfig.joint_co'));
        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

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
        
        $data = RenewalApplication::with('societyApplication')->where('id',$applicationId)->first();
        $data->documents = RenewalEEScrutinyDocuments::where('application_id',$applicationId)->get();
        return view('admin.renewal.ee_department.ee_scrutiny_remark', compact('data'));
    }                         
}
