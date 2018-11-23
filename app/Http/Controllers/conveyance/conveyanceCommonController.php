<?php

namespace App\Http\Controllers\conveyance;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\CommonController;
use App\conveyance\scApplication;
use App\conveyance\scApplicationLog;
use App\conveyance\SocietyConveyanceDocumentMaster;
use App\conveyance\SocietyConveyanceDocumentStatus;
use App\ApplicationStatusMaster;
use App\conveyance\ScAgreementComments;
use App\conveyance\scApplicationType;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use App\Role;
use Carbon\Carbon;
use Config;
use App\User;
use Storage;
use Auth;

class conveyanceCommonController extends Controller
{	 
    public function __construct()
    {
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
        $this->CommonController = new CommonController();
    }

    public function index(Request $request, Datatables $datatables){

        $data = $this->listApplicationData($request);
        $typeId = scApplicationType::where('application_type','=','Conveyance')->value('id');
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

            // dd($data);
        if ($datatables->getRequest()->ajax()) {

            return $datatables->of($data)
                ->editColumn('rownum', function ($data) {
                    static $i = 0; $i++; return $i;
                })

                ->editColumn('radio', function ($data) {
                    $url = route('conveyance.view_application', $data->id);
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

                    $status = $data->scApplicationLog->status_id;

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
                ->rawColumns(['radio','society_name', 'Status', 'building_name', 'societyApplication.address','date','typeId'])
                ->make(true);

        }  

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.conveyance.common.index', compact('html','header_data','getData','folder_name'));         

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

        $conveyanceId = scApplicationType::where('application_type','=','Conveyance')->value('id');

		$applicationData = scApplication::with(['ConveyanceSalePriceCalculation','applicationLayoutUser','societyApplication','scApplicationLog' => function($q) use($conveyanceId) {
	        	$q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'))
	            ->where('application_master_id', $conveyanceId)
	            ->orderBy('id', 'desc');
		}])

        ->whereHas('scApplicationLog', function ($q) use($conveyanceId) {
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'))
                ->where('application_master_id', $conveyanceId)
                ->orderBy('id', 'desc');
        });

        $applicationData = $applicationData->orderBy('sc_application.id', 'desc')->get();
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
        $data = scApplication::where('id',$applicationId)->first();
        $data->folder = $this->getCurrentRoleFolderName();
        $data->conveyance_map = $this->getArchitectSrutiny($applicationId,$data->sc_application_master_id);
        return view('admin.conveyance.common.view_application',compact('data'));
    }             

    //revert application child id
    public function getRevertApplicationChildData(){
        
        $role_id = Role::where('id',Auth::user()->role_id)->first();
        $result  = json_decode($role_id->conveyance_child_id);
        $child   = "";
        
        if ($result){
            $child = User::with(['roles','LayoutUser' => function($q){
                $q->where('layout_id', session('layout_id'));
            }])
            ->whereHas('LayoutUser' ,function($q){
                $q->where('layout_id', session('layout_id'));
            })
            ->whereIn('role_id',$result)->get();            
        }
        return $child;        
    }   
    
    //forward Application parent Id 

     public function getForwardApplicationParentData(){
        
        $role_id = Role::where('id',Auth::user()->role_id)->first();
        $result  = json_decode($role_id->conveyance_parent_id);
        $parent  = "";

        if ($result){
            $parent = User::with(['roles','LayoutUser' => function($q){
                $q->where('layout_id', session('layout_id'));
            }])
            ->whereHas('LayoutUser' ,function($q){
                $q->where('layout_id', session('layout_id'));
            })
            ->whereIn('role_id',$result)->get();            
        }
        return $parent;
    }

    // forward and revert application
    public function forwardApplication($request){
        
        $Scstatus = "";
        $data = scApplication::where('id',$request->applicationId)->first();
        $applicationStatus = $data->application_status;
        $masterId = $data->sc_application_master_id;

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
        else {
            if (isset($applicationStatus)){
                $Tostatus = $applicationStatus;
            }else{
                $Tostatus = config('commanConfig.applicationStatus.in_process');                
            }
        }
        foreach($request->to_user_id as $to_user_id){
            $user_data = User::find($to_user_id);

            $application = [[
                'application_id' => $request->applicationId,
                'user_id'        => Auth::user()->id,
                'role_id'        => session()->get('role_id'),
                'status_id'      => $status,
                'to_user_id'     => $to_user_id,
                'to_role_id'     => $user_data->role_id,
                'remark'         => $request->remark,
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
                'application_master_id' => $masterId,
                'created_at'    => Carbon::now(),
            ],
            ];

            scApplicationLog::insert($application); 
            if ($Scstatus != ""){
                scApplication::where('id',$request->applicationId)->where('sc_application_master_id',$masterId)
                ->update(['application_status' => $Tostatus]);                    
            }
        }    
    }

    public function getForwardApplicationData($applicationId){

        $data = scApplication::with('societyApplication','ConveyanceSalePriceCalculation')
        ->where('id',$applicationId)->first();
        $data->society_role_id = Role::where('name', config('commanConfig.society_offer_letter'))->value('id');
        $data->status = $this->getCurrentStatus($applicationId,$data->sc_application_master_id);
        $data->parent = $this->getForwardApplicationParentData();
        $data->child  = $this->getRevertApplicationChildData();
        return $data;        
    }

    // get current status of application
    public function getCurrentStatus($application_id,$masterId)
    {
        $current_status = scApplicationLog::where('application_id', $application_id)
            ->where('application_master_id',$masterId)
            ->where('user_id', Auth::user()->id)
            ->where('role_id', session()->get('role_id'))
            ->orderBy('id', 'desc')->first();
   
        return $current_status;
    }

    //view ee documents in readonly format
    public function ViewEEDocuments($applicationId){
        
        $data = scApplication::with('ConveyanceSalePriceCalculation')->where('id',$applicationId)->first();
        $data->folder = $this->getCurrentRoleFolderName();
        $data->conveyance_map = $this->getArchitectSrutiny($applicationId,$data->sc_application_master_id);
        return view('admin.conveyance.common.view_ee_sale_price_calculation', compact('data'));
    }


    //view documents in readonly format
    public function ViewDocuments($applicationId){
        $data = scApplication::where('id',$applicationId)->first();
        $data->folder = $this->getCurrentRoleFolderName();
        $documents = SocietyConveyanceDocumentMaster::with(['sc_document_status' => function($q) use($data) { $q->where('application_id', $data->id)->get(); }])->where('application_type_id', $data->sc_application_master_id)->where('society_flag', '1')->where('language_id', '2')->get();
        $documents_uploaded = SocietyConveyanceDocumentStatus::where('application_id', $data->id)->get();
        $data->conveyance_map = $this->getArchitectSrutiny($applicationId,$data->sc_application_master_id);
//        dd($documents);
        return view('admin.conveyance.common.view_documents', compact('data', 'documents', 'documents_uploaded'));
    }


    //get folder name to display action blade as per role id
    public function getCurrentRoleFolderName(){

        if (session()->get('role_name') == config('commanConfig.ee_junior_engineer') || config('commanConfig.ee_deputy_engineer') || config('commanConfig.ee_branch_head')){
            $folder = 'ee_department';
        }        
        if (session()->get('role_name') == config('commanConfig.dycdo_engineer') || session()->get('role_name') == config('commanConfig.dyco_engineer')){
            $folder = 'dyco_department';
        }         
        if (session()->get('role_name') == config('commanConfig.junior_architect') || session()->get('role_name') == config('commanConfig.senior_architect') || session()->get('role_name') == config('commanConfig.architect')){
            $folder = 'architect_department';
        }        
        if (session()->get('role_name') == config('commanConfig.estate_manager')){
            $folder = 'em_department';
        }         
        if (session()->get('role_name') == config('commanConfig.co_engineer') || session()->get('role_name') == config('commanConfig.joint_co') ){
            $folder = 'co_department';
        } 
        return $folder;       
    }  

    // get logs of Society
    public function getLogsOfSociety($applicationId,$masterId)
    {
        $roles = array(config('commanConfig.society_offer_letter'));

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $societyRoles = Role::whereIn('name', $roles)->pluck('id');
        $ocietylogs  = scApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('society_flag','=','1')->where('application_master_id',$masterId)->whereIn('role_id', $societyRoles)->whereIn('status_id', $status)->get();
        // dd($societyRoles);

        return $ocietylogs;
    }     

    // get logs of DYCO dept
    public function getLogsOfDYCODepartment($applicationId,$masterId)
    {

        $roles = array(config('commanConfig.dycdo_engineer'), config('commanConfig.dyco_engineer'));

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $dycoRoles = Role::whereIn('name', $roles)->pluck('id');
        $dycologs  = scApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)
        ->where('application_master_id',$masterId)->whereIn('role_id', $dycoRoles)->whereIn('status_id', $status)->get();

        return $dycologs;
    } 

    // get logs of EE dept
    public function getLogsOfEEDepartment($applicationId,$masterId)
    {

        $roles = array(config('commanConfig.ee_junior_engineer'), config('commanConfig.ee_deputy_engineer'), config('commanConfig.ee_branch_head'));

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $eeRoles = Role::whereIn('name', $roles)->pluck('id');
        $eelogs  = scApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('application_master_id',$masterId)->whereIn('role_id', $eeRoles)->whereIn('status_id', $status)->get();

        return $eelogs;
    }

    // get logs of Architect dept
    public function getLogsOfArchitectDepartment($applicationId,$masterId)
    {

        $roles = array(config('commanConfig.junior_architect'), config('commanConfig.senior_architect'), config('commanConfig.architect'));
        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $ArchitectRoles = Role::whereIn('name', $roles)->pluck('id');
        $Architectlogs  = scApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('application_master_id',$masterId)->whereIn('role_id', $ArchitectRoles)->whereIn('status_id', $status)->get();

        return $Architectlogs;
    }

    // get logs of CO and JTCO dept
    public function getLogsOfCODepartment($applicationId,$masterId)
    {
        $roles = array(config('commanConfig.co_engineer'), config('commanConfig.joint_co'));
        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $coRoles = Role::whereIn('name', $roles)->pluck('id');
        $cologs  = scApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('application_master_id',$masterId)->whereIn('role_id', $coRoles)->whereIn('status_id', $status)->get();

        return $cologs;
    }

    // get agreement as per agreement type id
    public function getScAgreement($typeId,$applicationId,$status){
      
        $agreement = SocietyConveyanceDocumentStatus::where('document_id',$typeId)->where('status_id',$status)->where('application_id',$applicationId)->first();
        return $agreement;
    } 

    // get agreement id as per agreement name
    public function getScAgreementId($documentName,$type){

        $typeId = SocietyConveyanceDocumentMaster::where('document_name',$documentName)->where('application_type_id',$type)->value('id');
        return $typeId;
    } 

    // insert sc agreements as per type
    public function createScAgreement($applicationId,$typeId,$filePath,$Agreementstatus){
        
        $ArrData[] = array('application_id'       => $applicationId,
                            'document_id'         => $typeId, 
                            'document_path'       => $filePath,
                            'status_id'           => $Agreementstatus,
                            'user_id'             => Auth::Id());   

        $data = SocietyConveyanceDocumentStatus::insert($ArrData); 
        return $data;          
    }

    // update sc agreements
    public function updateScAgreement($applicationId,$typeId,$filePath,$status){

        $data = SocietyConveyanceDocumentStatus::where('application_id',$applicationId)->where('document_id',$typeId)->where('status_id',$status)->where('user_id',Auth::Id())->update(['document_path' => $filePath]);

        return $data;
    } 

    //insert comment for agreement
    public function ScAgreementComment($applicationId,$remark,$type){

        $comments[] = array('application_id' => $applicationId,
                            'user_id'        => Auth::Id(),
                            'role_id'        => session()->get('role_id'),
                            'agreement_type_id' => $type,
                            'remark'         => $remark);
        
        $remark  = ScAgreementComments::insert($comments);
        return $remark;
    }

    public function SaveAgreementComments(Request $request){

        $applicationId = $request->application_id;
        $remark        = $request->remark;
        $masterId      = scApplication::where('id',$applicationId)->value('sc_application_master_id');  
        $result        = $this->ScAgreementComment($applicationId,$remark,$masterId);
        return back()->with('success','data save Successfully.');
    } 

    // conveyance Architect scrutiny remark
    public function ArchitectScrutinyRemark(Request $request, $applicationId){
        
        $data = scApplication::with('societyApplication')->where('id',$applicationId)->first();
        $data->status = $this->getCurrentStatus($applicationId,$data->sc_application_master_id);
        $data->folder  = $this->getCurrentRoleFolderName();
        
        //get architect_conveyance_map from sc document status table
        $document  = config('commanConfig.documents.architect_conveyance_map');
        $documentId = $this->getDocumentId($document,$data->sc_application_master_id);
        $data->conveyance_map = $this->getDocumentStatus($applicationId,$documentId);        

        return view('admin.conveyance.architect_department.scrutiny_remark',compact('data'));
    }  

    // save conveyance Architect scrutiny remark
    public function SaveArchitectScrutinyRemark(Request $request){
        
        $applicationId = $request->applicationId;
        $file = $request->file('conveyance_map');

        if ($file) {
            
            $extension  = $file->getClientOriginalExtension(); 
            $folder_name = 'Conveyance_Architect_map';
            $file_name  = time().'_map_'.$applicationId.'.'.$extension; 
            $file_path  = $folder_name.'/'.$file_name; 
            
            if ($extension == "pdf"){    
                Storage::disk('ftp')->delete($request->oldFileName);            
                $sale_upload = $this->CommonController->ftpFileUpload($folder_name,$file,$file_name);

                // save document to sc document status table
                $document  = config('commanConfig.documents.architect_conveyance_map');
                $this->uploadDocumentStatus($applicationId,$document,$file_path);                
                   
                return back()->with('success','Conveyance map uploaded successfully.');                 
            }  else{
                return back()->with('error','Invalid type of file uploaded (only pdf allowed).'); 
            }          
        }         
    }

    //common forward page for DYCO dept, Architect 
    public function commonForward(Request $request,$applicationId){

      $data          = $this->getForwardApplicationData($applicationId);
      $data->folder  = $this->getCurrentRoleFolderName();
      $societyLogs   = $this->getLogsOfSociety($applicationId,$data->sc_application_master_id);
      $dycoLogs      = $this->getLogsOfDYCODepartment($applicationId,$data->sc_application_master_id);
      $eelogs        = $this->getLogsOfEEDepartment($applicationId,$data->sc_application_master_id);
      $Architectlogs = $this->getLogsOfArchitectDepartment($applicationId,$data->sc_application_master_id);
      $cologs        = $this->getLogsOfCODepartment($applicationId,$data->sc_application_master_id);
      $data->conveyance_map = $this->getArchitectSrutiny($applicationId,$data->sc_application_master_id);
      
      $this->getAllSaleLeaseAgreement($data,$applicationId,$data->sc_application_master_id);

      if (session()->get('role_name') == config('commanConfig.co_engineer') || session()->get('role_name') == config('commanConfig.joint_co')){
        $route = 'admin.conveyance.co_department.forward_application';

      } elseif (session()->get('role_name') == config('commanConfig.dyco_engineer') || session()->get('role_name') == config('commanConfig.dycdo_engineer')){

             $route = 'admin.conveyance.dyco_department.forward_application';
        }     
        else{
        $route = 'admin.conveyance.common.forward_application';
      }
      return view($route,compact('data','dycoLogs','eelogs','Architectlogs','cologs'));         
    }

    public function saveForwardApplication(Request $request){
        $forwardData = $this->forwardApplication($request); 
        return redirect('/conveyance')->with('success','Application sent successfully.');
    } 

    public function getAllSaleLeaseAgreement($data,$applicationId,$masterId){

        $SaleAgreement  = config('commanConfig.scAgreements.sale_deed_agreement');
        $LeaseAgreement = config('commanConfig.scAgreements.lease_deed_agreement');

        $SaleId  = $this->getScAgreementId($SaleAgreement,$masterId);
        $LeaseId = $this->getScAgreementId($LeaseAgreement,$masterId);

        $DraftStatus = ApplicationStatusMaster::where('status_name','=','Draft')->value('id');
        $ApprovedStatus = ApplicationStatusMaster::where('status_name','=','Approved')->value('id');

        $data->DraftSaleAgreement    = $this->getScAgreement($SaleId,$applicationId,$DraftStatus);
        $data->DraftLeaseAgreement   = $this->getScAgreement($LeaseId,$applicationId,$DraftStatus);
        $data->ApprovedSaleAgreement = $this->getScAgreement($SaleId,$applicationId,$ApprovedStatus);
        $data->ApprovedLeaseAgreement = $this->getScAgreement($LeaseId,$applicationId,$ApprovedStatus);
        
        return $data;
    }  

    //add document to sc_document status
    public function uploadDocumentStatus($applicationId,$document,$documentPath){
        
        $masterId   = scApplication::where('id',$applicationId)->value('sc_application_master_id');
        $documentId = SocietyConveyanceDocumentMaster::where('document_name',$document)
        ->where('application_type_id',$masterId)->value('id');
        
        $DocumentStatus = SocietyConveyanceDocumentStatus::where('application_id',$applicationId)->where('document_id',$documentId)->where('user_id',Auth::Id())->first();

        if(Session::get('role_name') == config('commanConfig.society_offer_letter')){
            $society_flag = 1;
        }else{
            $society_flag = 0;
        }
        if (!$DocumentStatus){
            $DocumentStatus = new SocietyConveyanceDocumentStatus();
        }
        $DocumentStatus->application_id = $applicationId;
        $DocumentStatus->user_id        = Auth::Id();
        $DocumentStatus->society_flag    = $society_flag;
        $DocumentStatus->document_id    = $documentId;
        $DocumentStatus->document_path  = $documentPath;
        $DocumentStatus->save();

        return $DocumentStatus;
    } 

    //fetch documents from sc_document status
    public function getDocumentStatus($applicationId,$typeId){

        $document = SocietyConveyanceDocumentStatus::where('document_id',$typeId)->where('application_id',$applicationId)->first();
        return $document;        
    }  

    // get document id as per document name
    public function getDocumentId($documentName,$type){

        $typeId = SocietyConveyanceDocumentMaster::where('document_name',$documentName)->where('application_type_id',$type)->value('id');
        return $typeId;
    }

    // get document id as per document name
    public function getDocumentIds($documentNames,$type){

        $typeId = SocietyConveyanceDocumentMaster::with(['sc_document_status'])->whereIn('document_name',$documentNames)->where('application_type_id',$type)->get();
        return $typeId;
    }

    //get architect_conveyance_map 
    public function getArchitectSrutiny($applicationId, $masterId){
            
        $document  = config('commanConfig.documents.architect_conveyance_map');
        $documentId = $this->getDocumentId($document,$masterId);
        $conveyance_map = $this->getDocumentStatus($applicationId,$documentId); 
        return $conveyance_map;       
    }
}
