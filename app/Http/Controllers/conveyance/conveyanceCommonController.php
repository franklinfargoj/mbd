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
use App\LanguageMaster;
use App\Role;
use App\SocietyOfferLetter;
use Carbon\Carbon;
use Config;
use App\User;
use Storage;
use Auth;
use DB;
use App\conveyance\ScChecklistMaster;
use App\conveyance\ScChecklistScrutinyStatus;
use App\Http\Controllers\conveyance\renewalCommonController;

class conveyanceCommonController extends Controller
{	 
    public function __construct()
    {
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
        $this->CommonController = new CommonController();
        $this->SaleAgreement  = config('commanConfig.scAgreements.sale_deed_agreement');
        $this->LeaseAgreement = config('commanConfig.scAgreements.lease_deed_agreement');
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


        if ($datatables->getRequest()->ajax()) {

            return $datatables->of($data)
                ->editColumn('rownum', function ($data) {
                    static $i = 0; $i++; return $i;
                })

                ->editColumn('radio', function ($data) {
                    $url = route('conveyance.view_application', encrypt($data->id));
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
                            $config_array = array_flip(config('commanConfig.conveyance_status'));
                            $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                            return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$status) .' m-badge--wide">'.$value.'</span>';
                        }
                    }else{
                        $config_array = array_flip(config('commanConfig.conveyance_status'));

                        $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                        return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$status) .' m-badge--wide">'.$value.'</span>';
                    }

                })
                ->rawColumns(['radio','societyApplication.name', 'societyApplication.building_no', 'societyApplication.address', 'date','Status'])
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

	// list all  data
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

        if($request->submitted_at_from)
        {
            $applicationData=$applicationData->where(\DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),'>=',date('Y-m-d',strtotime($request->submitted_at_from)));
        }

        if($request->submitted_at_to)
        {
            $applicationData=$applicationData->where(\DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),'<=',date('Y-m-d',strtotime($request->submitted_at_to)));
        }        

        $applicationData = $applicationData->orderBy('sc_application.id', 'desc')->get();
        $listArray = [];
        if ($request->update_status) {

            foreach ($applicationData as $app_data) {
                if ($app_data->scApplicationLog->status_id == $request->update_status) {
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
        $data = scApplication::where('id',$applicationId)->first();
        $data->folder = $this->getCurrentRoleFolderName();
        $data->conveyance_map = $this->getArchitectSrutiny($applicationId,$data->sc_application_master_id);
        $document_id = $this->getDocumentId(config('commanConfig.documents.em_conveyance.stamp_conveyance_application'), $data->sc_application_master_id);
        $document = SocietyConveyanceDocumentStatus::where('document_id', $document_id)
        ->where('society_flag',1)->where('application_id',$applicationId)->first();
        $data->em_document = $this->getEMNoDueCertificate($data->sc_application_master_id,$applicationId);

        return view('admin.conveyance.common.view_application',compact('data', 'document'));
    } 

    //revert application child id
    public function getRevertApplicationChildData($societyId){
        
        $SocietyOfferLetter = SocietyOfferLetter::find($societyId);
        $society_user_id = $SocietyOfferLetter->user_id;
        $society_user = User::where('id',$society_user_id)->get();        
        
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
        if(session()->get('role_name') == config('commanConfig.dyco_engineer') && $child != "")
        {
            $child = $child->merge($society_user);
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
        $toUsers = "";
        $data = scApplication::where('id',$request->applicationId)->first();
        $applicationStatus = $data->application_status;
        $masterId = $data->sc_application_master_id;

        $dycdoId =  Role::where('name',config('commanConfig.dycdo_engineer'))->value('id');  
        $dycoId  =  Role::where('name',config('commanConfig.dyco_engineer'))->value('id'); 
         
        if ($request->check_status == 1) {
            $status = config('commanConfig.conveyance_status.forwarded'); 
            $toUsers = $request->to_user_id;        
        }else{
            $status = config('commanConfig.conveyance_status.reverted');
            $toUsers = $request->to_child_id;
        }
        
        if ((session()->get('role_name') == config('commanConfig.ee_branch_head') || session()->get('role_name') == config('commanConfig.estate_manager') ) && $request->to_role_id == $dycdoId) {
            $Tostatus = config('commanConfig.conveyance_status.Draft_sale_&_lease_deed');
            $Scstatus = $Tostatus;

        } elseif (session()->get('role_name') == config('commanConfig.joint_co') && $request->to_role_id == $dycdoId){
            
            if ($applicationStatus == config('commanConfig.conveyance_status.Draft_sale_&_lease_deed')){
                $Tostatus = config('commanConfig.conveyance_status.Aproved_sale_&_lease_deed');
                $Scstatus = $Tostatus;

            }elseif($applicationStatus == config('commanConfig.conveyance_status.Stamped_sale_&_lease_deed')){
                $Tostatus = config('commanConfig.conveyance_status.Stamped_signed_sale_&_lease_deed');
                $Scstatus = $Tostatus;
                
            }else{
                $Tostatus = $applicationStatus;
                $Scstatus = $Tostatus;
            }
        }elseif((session()->get('role_name') == config('commanConfig.dycdo_engineer') && $request->to_role_id == $dycoId)){
            if ($applicationStatus == config('commanConfig.conveyance_status.Aproved_sale_&_lease_deed')){

                $Tostatus = config('commanConfig.conveyance_status.Send_society_to_pay_stamp_duty');
                $Scstatus = $Tostatus;

            }elseif($applicationStatus == config('commanConfig.conveyance_status.Stamped_signed_sale_&_lease_deed')){
                
                $Tostatus = config('commanConfig.conveyance_status.Send_society_for_registration_of_sale_&_lease');
                $Scstatus = $Tostatus; 

            }elseif($applicationStatus == config('commanConfig.conveyance_status.Registered_sale_&_lease_deed')){
                
                $Tostatus = config('commanConfig.conveyance_status.NOC_Issued');
                $Scstatus = $Tostatus;                
            }
            else{
                $Tostatus = $applicationStatus;
                $Scstatus = $Tostatus;
            }
        }
        else {
                $Tostatus = $applicationStatus;               
            }

            // if reverted to society 
            if ($request->society_flag == '1'){
             $Tostatus = config('commanConfig.conveyance_status.pending'); 

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
                'application_master_id' => $masterId,
                'society_flag'   => '0',
                'is_active'      => 1,
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
                'society_flag'   => $request->society_flag,
                'is_active'      => 1,
                'created_at'    => Carbon::now(),
            ],
            ];

            DB::beginTransaction();
            try{
            scApplicationLog::where('application_id',$request->applicationId)
                ->whereIn('user_id', [Auth::user()->id,$to_user_id ])
                ->update(array('is_active' => 0)); 

            // dd($application);
            scApplicationLog::insert($application); 
           
                if ($Scstatus != ""){
                              
                    scApplication::where('id',$request->applicationId)->where('sc_application_master_id',$masterId)
                    ->update(['application_status' => $Tostatus, 'sent_to_society' => '0']);                     
                }
            DB::commit();    
            }catch (\Exception $ex) {
                 
                DB::rollback();
            }
        }    
    }

    public function getForwardApplicationData($applicationId){

        $data = scApplication::with('societyApplication','ConveyanceSalePriceCalculation')
        ->where('id',$applicationId)->first();
        $data->society_role_id = Role::where('name', config('commanConfig.society_offer_letter'))->value('id');
        $data->status = $this->getCurrentStatus($applicationId,$data->sc_application_master_id);
        $data->parent = $this->getForwardApplicationParentData();
        $data->child  = $this->getRevertApplicationChildData($data->society_id);
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
        
        $applicationId = decrypt($applicationId);
        $data = scApplication::with('ConveyanceSalePriceCalculation')->where('id',$applicationId)->first();
        $data->folder = $this->getCurrentRoleFolderName();
        $data->conveyance_map = $this->getArchitectSrutiny($applicationId,$data->sc_application_master_id);
        $data->em_document = $this->getEMNoDueCertificate($data->sc_application_master_id,$applicationId);
        return view('admin.conveyance.common.view_ee_sale_price_calculation', compact('data'));
    }


    //view society documents in readonly format
    public function ViewSocietyDocuments($applicationId){
        
        $applicationId = decrypt($applicationId);
        $data = scApplication::where('id',$applicationId)->first();
        $data->folder = $this->getCurrentRoleFolderName();
        $mLanguage = LanguageMaster::where('language','=','marathi')->value('id');
        $documents = SocietyConveyanceDocumentMaster::with(['sc_document_status' => function($q) use($data) { $q->where('application_id', $data->id)->get(); }])->where('application_type_id', $data->sc_application_master_id)->where('society_flag', '1')->where('language_id', $mLanguage)->get();
        // $documents_uploaded = SocietyConveyanceDocumentStatus::where('application_id', $data->id)->get();
        $data->conveyance_map = $this->getArchitectSrutiny($applicationId,$data->sc_application_master_id);
        $data->em_document = $this->getEMNoDueCertificate($data->sc_application_master_id,$applicationId);
       
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
        if (session()->get('role_name') == config('commanConfig.la_engineer')){
            $folder = 'la_department';
        }
        return $folder;       
    }  

    // get logs of Society
    // public function getLogsOfSociety($applicationId,$masterId)
    // {
    //     $roles = array(config('commanConfig.society_offer_letter'));

    //     $status = array(config('commanConfig.conveyance_status.forwarded'), config('commanConfig.conveyance_status.reverted'));

    //     $societyRoles = Role::whereIn('name', $roles)->pluck('id');
    //     $ocietylogs  = scApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('society_flag','=','1')->where('application_master_id',$masterId)->whereIn('role_id', $societyRoles)->whereIn('status_id', $status)->get();
    //     return $ocietylogs;
    // }     

    // // get logs of DYCO dept
    // public function getLogsOfDYCODepartment($applicationId,$masterId)
    // {

    //     $roles = array(config('commanConfig.dycdo_engineer'), config('commanConfig.dyco_engineer'));

    //     $status = array(config('commanConfig.conveyance_status.forwarded'), config('commanConfig.conveyance_status.reverted'));

    //     $dycoRoles = Role::whereIn('name', $roles)->pluck('id');
    //     $dycologs  = scApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)
    //     ->where('application_master_id',$masterId)->whereIn('role_id', $dycoRoles)->whereIn('status_id', $status)->get();

    //     return $dycologs;
    // } 

    // // get logs of EE dept
    // public function getLogsOfEEDepartment($applicationId,$masterId)
    // {

    //     $roles = array(config('commanConfig.ee_junior_engineer'), config('commanConfig.ee_deputy_engineer'), config('commanConfig.ee_branch_head'));

    //     $status = array(config('commanConfig.conveyance_status.forwarded'), config('commanConfig.conveyance_status.reverted'));

    //     $eeRoles = Role::whereIn('name', $roles)->pluck('id');
    //     $eelogs  = scApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('application_master_id',$masterId)->whereIn('role_id', $eeRoles)->whereIn('status_id', $status)->get();

    //     return $eelogs;
    // }

    // // get logs of Architect dept
    // public function getLogsOfArchitectDepartment($applicationId,$masterId)
    // {

    //     $roles = array(config('commanConfig.junior_architect'), config('commanConfig.senior_architect'), config('commanConfig.architect'));
    //     $status = array(config('commanConfig.conveyance_status.forwarded'), config('commanConfig.conveyance_status.reverted'));

    //     $ArchitectRoles = Role::whereIn('name', $roles)->pluck('id');
    //     $Architectlogs  = scApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('application_master_id',$masterId)->whereIn('role_id', $ArchitectRoles)->whereIn('status_id', $status)->get();

    //     return $Architectlogs;
    // }

    // // get logs of CO and JTCO dept
    // public function getLogsOfCODepartment($applicationId,$masterId)
    // {
    //     $roles = array(config('commanConfig.co_engineer'), config('commanConfig.joint_co'));
    //     $status = array(config('commanConfig.conveyance_status.forwarded'), config('commanConfig.conveyance_status.reverted'));

    //     $coRoles = Role::whereIn('name', $roles)->pluck('id');
    //     $cologs  = scApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('application_master_id',$masterId)->whereIn('role_id', $coRoles)->whereIn('status_id', $status)->get();

    //     return $cologs;
    // }

    // // get logs of EM dept
    // public function getLogsOfEMDepartment($applicationId,$masterId)
    // {
    //     $roles = array(config('commanConfig.estate_manager'));
    //     $status = array(config('commanConfig.conveyance_status.forwarded'), config('commanConfig.conveyance_status.reverted'));

    //     $emRoles = Role::whereIn('name', $roles)->pluck('id');
    //     $emlogs  = scApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('application_master_id',$masterId)->whereIn('role_id', $emRoles)->whereIn('status_id', $status)->get();

    //     return $emlogs;
    // }

    // // get logs of LA dept
    // public function getLogsOfLADepartment($applicationId,$masterId)
    // {
    //     $roles = array(config('commanConfig.legal_advisor'));
    //     $status = array(config('commanConfig.conveyance_status.forwarded'), config('commanConfig.conveyance_status.reverted'));

    //     $laRoles = Role::whereIn('name', $roles)->pluck('id');
    //     $lalogs  = scApplicationLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('application_master_id',$masterId)->whereIn('role_id', $laRoles)->whereIn('status_id', $status)->get();

    //     return $lalogs;
    // }        

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
        
        $applicationId = decrypt($applicationId);
        $data = scApplication::with('societyApplication')->where('id',$applicationId)->first();
        $data->status = $this->getCurrentStatus($applicationId,$data->sc_application_master_id);
        $data->folder  = $this->getCurrentRoleFolderName();
        
        //get architect_conveyance_map from sc document status table
        $document  = config('commanConfig.documents.architect_conveyance_map');
        $documentId = $this->getDocumentId($document,$data->sc_application_master_id);
        $data->conveyance_map = $this->getDocumentStatus($applicationId,$documentId); 
        $data->em_document = $this->getEMNoDueCertificate($data->sc_application_master_id,$applicationId);
        $data->status = $this->getCurrentStatus($applicationId,$data->sc_application_master_id);       

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
      
      $applicationId = decrypt($applicationId);  
      $data          = $this->getForwardApplicationData($applicationId);
      $data->folder  = $this->getCurrentRoleFolderName();
      // $societyLogs   = $this->getLogsOfSociety($applicationId,$data->sc_application_master_id);
      // $dycoLogs      = $this->getLogsOfDYCODepartment($applicationId,$data->sc_application_master_id);
      // $eelogs        = $this->getLogsOfEEDepartment($applicationId,$data->sc_application_master_id);
      // $Architectlogs = $this->getLogsOfArchitectDepartment($applicationId,$data->sc_application_master_id);
      // $cologs        = $this->getLogsOfCODepartment($applicationId,$data->sc_application_master_id);
      // $emlogs        = $this->getLogsOfEMDepartment($applicationId,$data->sc_application_master_id);
      // $lalogs        = $this->getLogsOfLADepartment($applicationId,$data->sc_application_master_id);

      $remarkHistory = $this->getRemarkHistory($applicationId,$data->sc_application_master_id);
      $data->conveyance_map = $this->getArchitectSrutiny($applicationId,$data->sc_application_master_id);
      $data->em_document = $this->getEMNoDueCertificate($data->sc_application_master_id,$applicationId);
      
      $this->getAllSaleLeaseAgreement($data,$applicationId,$data->sc_application_master_id);

      if (session()->get('role_name') == config('commanConfig.co_engineer') || session()->get('role_name') == config('commanConfig.joint_co')){
        $route = 'admin.conveyance.co_department.forward_application';

      } elseif (session()->get('role_name') == config('commanConfig.dyco_engineer') || session()->get('role_name') == config('commanConfig.dycdo_engineer')){
             $route = 'admin.conveyance.dyco_department.forward_application';

        }elseif (session()->get('role_name') == config('commanConfig.ee_branch_head') || session()->get('role_name') == config('commanConfig.ee_deputy_engineer') || session()->get('role_name') == config('commanConfig.ee_junior_engineer') ) {

             $route = 'admin.conveyance.ee_department.forward_application';
        }      
        else{
        $route = 'admin.conveyance.common.forward_application';
      }
      
      return view($route,compact('data','remarkHistory'));          
    }

    public function getRemarkHistory($applicationId,$masterId)
    {
        $status = array(config('commanConfig.conveyance_status.forwarded'), config('commanConfig.conveyance_status.reverted'));

        $logs  = scApplicationLog::with(['getRoleName', 'getRole'])->where('application_id',$applicationId)->where('application_master_id',$masterId)->orderBy('id','DESC')->whereIn('status_id', $status)->get();

        return $logs;
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
    public function uploadDocumentStatus($applicationId,$document,$documentPath, $status=NULL){
        
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
        $DocumentStatus->status_id        = $status;
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
    public function getDocumentIds($documentNames, $type, $application_id=NULL){

        $typeId = SocietyConveyanceDocumentMaster::with(['sc_document_status' => function($q) use($application_id){
            $q->where('application_id', $application_id)->orderBy('id', 'desc');
        }])->whereIn('document_name',$documentNames)->where('application_type_id',$type)->get();

        return $typeId;
    }

    //get architect_conveyance_map 
    public function getArchitectSrutiny($applicationId, $masterId){
            
        $document  = config('commanConfig.documents.architect_conveyance_map');
        $documentId = $this->getDocumentId($document,$masterId);
        $conveyance_map = $this->getDocumentStatus($applicationId,$documentId); 
        return $conveyance_map;       
    }

    /**
     * Displays the sale & lease deed agreements riders forms.
     *Author: Amar Prajapati
     * @param  int  $applicationId
     * @return \Illuminate\Http\Response
     */
    public function la_agreement_riders($applicationId){

        $sc_application = scApplication::with(['sc_form_request', 'societyApplication', 'applicationLayout', 'scApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->where('id', $applicationId)->first();
        $documents_req = array(
            config('commanConfig.documents.society.Sale Deed Agreement'),
            config('commanConfig.documents.society.Lease Deed Agreement')
        );
        $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Conveyance'))->value('id');
        $document_ids = $this->getDocumentIds($documents_req, $application_type);
        $uploaded_document_ids = [];
        $documents_remaining_ids = [];
        foreach($document_ids as $document_id){
            $documents[str_replace(' ', '_', strtolower($document_id->document_name))] = $document_id->document_name;
            if($document_id->sc_document_status !== null){
                $uploaded_document_ids[str_replace(' ', '_', strtolower($document_id->document_name))] = $document_id;
            }else{
                $documents_remaining_ids[str_replace(' ', '_', strtolower($document_id->document_name))] = $document_id;
            }
        }

        $sc_agreement_comment = ScAgreementComments::with('scAgreementId')->get();
        $data = $sc_application;
//        dd($sc_application);
        return view('admin.conveyance.la_department.sale_lease_deed', compact('sc_application', 'documents', 'uploaded_document_ids', 'documents_remaining_ids', 'sc_agreement_comment', 'data'));
    }

    /**
     * Uploads the sale & lease deed agreements riders.
     *Author: Amar Prajapati
     * @param  int  $applicationId
     * @return \Illuminate\Http\Response
     */
    public function upload_la_agreement_riders(Request $request){
        
        $applicationId = $request->application_id;   
        $data = scApplication::where('id',$applicationId)->first();           
        $Applicationtype= $data->sc_application_master_id; 

        if ($request->riders){
            $update_arr = array(
                'riders' => $request->riders
            );
            $updated_rides = scApplication::where('id', $request->application_id)->update($update_arr);
        }

        if ($request->remark){
          $this->ScAgreementComment($applicationId,$request->remark,$Applicationtype);  
        }
        return back()->with('success', 'Submitted successfully.');

        // if($updated_rides == 1){
        //     return redirect()->route('conveyance.la_agreement_riders', $request->application_id);
        // }

        //changes made to save remark and riders for LA (BHAVANA)

    }

    public function show_checklist(Request $request,$applicationId){

        $applicationId = decrypt($applicationId);
        $data = scApplication::with('ConveyanceSalePriceCalculation')->where('id',$applicationId)->first();
        $type = '1';
        $language_id = '2';
        $checklist = ScChecklistMaster::with(['checklistStatus' => function ($q) use ($applicationId) {
            $q->where('application_id', $applicationId);
        }])->where('type_id',$type)->where('language_id',$language_id)->get();

        $is_view = session()->get('role_name') == config('commanConfig.dycdo_engineer');
        $data->status = $this->getCurrentStatus($applicationId,$data->sc_application_master_id);
        $data->conveyance_map = $this->getArchitectSrutiny($applicationId,$data->sc_application_master_id);

        if ($is_view && $data->status->status_id == config('commanConfig.conveyance_status.Draft_sale_&_lease_deed')) {
            $route = 'admin.conveyance.dyco_department.checklist_office_note';
        }else{
            $route = 'admin.conveyance.common.view_checklist_office_note';
        }

        //get dycdo note from sc document status table
        $document  = config('commanConfig.documents.dycdo_note');
        $documentId = $this->getDocumentId($document,$data->sc_application_master_id);
        $dycdo_note = $this->getDocumentStatus($applicationId,$documentId);

        return view($route,compact('data','checklist','dycdo_note'));
    }

    // draft sale sign and lease deed Agreement view only for JTCO
    public function DraftSignsaleLeaseAgreement(Request $request,$applicationId){

        $applicationId = decrypt($applicationId);
        $data = scApplication::with(['scApplicationLog','ConveyanceSalePriceCalculation'])
        ->where('id',$applicationId)->first();
        $Applicationtype= $data->sc_application_master_id;
        $Agreementstatus = ApplicationStatusMaster::where('status_name','=','Draft')->value('id');
      
        $draftSaleId   = $this->getScAgreementId($this->SaleAgreement,$Applicationtype);
        $draftLeaseId  = $this->getScAgreementId($this->LeaseAgreement,$Applicationtype);

        $data->DraftSaleAgreement  = $this->getScAgreement($draftSaleId,$applicationId,$Agreementstatus);
        $data->DraftLeaseAgreement = $this->getScAgreement($draftLeaseId,$applicationId,$Agreementstatus);

        //draft and sign status
        $signstatus = ApplicationStatusMaster::where('status_name','=','Draft_Sign')->value('id');
        $signSaleId   = $this->getScAgreementId($this->SaleAgreement,$Applicationtype);
        $signLeaseId  = $this->getScAgreementId($this->LeaseAgreement,$Applicationtype);    

        $data->SignSaleAgreement  = $this->getScAgreement($signSaleId,$applicationId,$signstatus);
        $data->SignLeaseAgreement = $this->getScAgreement($signLeaseId,$applicationId,$signstatus);        

        $is_view = session()->get('role_name') == config('commanConfig.joint_co');
        $is_la = session()->get('role_name') == config('commanConfig.la_engineer');
        $data->status = $this->getCurrentStatus($applicationId,$data->sc_application_master_id);

        $data->AgreementComments = ScAgreementComments::with('Roles')->where('application_id',$applicationId)->where('agreement_type_id',$Applicationtype)->whereNotNull('remark')->get();

        $data->folder = $this->getCurrentRoleFolderName();
        $data->conveyance_map = $this->getArchitectSrutiny($applicationId,$data->sc_application_master_id);

        if ($is_view && $data->status->status_id == config('commanConfig.conveyance_status.Draft_sale_&_lease_deed')) {
            $route = 'admin.conveyance.co_department.draft_sign_sale_lease';
        }
        else if($is_la && $data->status->status_id == config('commanConfig.conveyance_status.Draft_sale_&_lease_deed')){

            $route = 'admin.conveyance.la_department.sale_lease_deed';
        }else{
            $route = 'admin.conveyance.common.view_draft_sign_sale_lease';
        }
       
        return view($route,compact('data','is_view','status'));
    }    

    //save draft sign lease and sale Agreement by JTCO
    public function SaveDraftSignAgreement(Request $request){
        
        $applicationId   = $request->applicationId;
        $sale_agreement  = $request->file('sale_agreement');   
        $lease_agreement = $request->file('lease_agreement'); 

        $data = scApplication::where('id',$applicationId)->first(); 
        $Applicationtype= $data->sc_application_master_id; 
       
        $sale_folder_name  = "Conveyance_Draft_Sign_Sale_Agreement";
        $lease_folder_name = "Conveyance_Draft_Sign_Lease_Agreement";

        $Agrstatus = ApplicationStatusMaster::where('status_name','=','Draft_Sign')->value('id'); 
         
        if ($sale_agreement) {
            $sale_extension  = $sale_agreement->getClientOriginalExtension(); 
            $sale_file_name  = time().'_sale_'.$applicationId.'.'.$sale_extension; 
            $sale_file_path  = $sale_folder_name.'/'.$sale_file_name; 
            $SaleId = $this->getScAgreementId($this->SaleAgreement,$Applicationtype);
            
            if ($sale_extension == "pdf"){
                
                Storage::disk('ftp')->delete($request->oldSaleFile);
                $sale_upload = $this->CommonController->ftpFileUpload($sale_folder_name,$sale_agreement,$sale_file_name); 
                $saleData = $this->getScAgreement($SaleId,$applicationId,$Agrstatus);

                if ($saleData){
                    $this->updateScAgreement($applicationId,$SaleId,$sale_file_path,$Agrstatus);
                }else{
                    $this->createScAgreement($applicationId,$SaleId,$sale_file_path,$Agrstatus);               
                }
                $status = 'success';
            }            
        } 
        if ($lease_agreement) {

            $lease_extension = $lease_agreement->getClientOriginalExtension(); 
            $lease_file_name = time().'_lease_'.$applicationId.'.'.$lease_extension;
            $lease_file_path = $lease_folder_name.'/'.$lease_file_name;
            $LeaseId = $this->getScAgreementId($this->LeaseAgreement,$Applicationtype);
            
            if ($lease_extension == "pdf") {

                Storage::disk('ftp')->delete($request->oldLeaseFile);
                $lease_upload = $this->CommonController->ftpFileUpload($lease_folder_name,$lease_agreement,$lease_file_name);

                $leaseData = $this->getScAgreement($LeaseId,$applicationId,$Agrstatus);
                if ($leaseData){
                    $this->updateScAgreement($applicationId,$LeaseId,$lease_file_path,$Agrstatus);                    
                }else{
                    $this->createScAgreement($applicationId,$LeaseId,$lease_file_path,$Agrstatus);
                }
                $status = 'success';                
            }            
        }

        if ($request->remark){
          $this->ScAgreementComment($applicationId,$request->remark,$Applicationtype);  
          $status = 'success';
        }
        
        if (isset($status) && $status == 'success'){
            return back()->with('success', 'Uploaded Successfully.'); 
        } else{
            return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
        }        
    }  

    //get em no due certificate
    public function getEMNoDueCertificate($masterId,$applicationId){
        
        $em_doc = config('commanConfig.no_dues_certificate.db_columns.upload');
        $docId = $this->getDocumentId($em_doc,$masterId);
        $em_document = $this->getDocumentStatus($applicationId,$docId);
        return $em_document;
    }

    // Dashboard for conveyance start header_remove

    public function displayDashboard(){

        $conveyanceDashboard = $this->ConveyanceDashboard();
        $conveyanceRoles     = $this->getConveyanceRoles();
        $pendingApplications = $this->getApplicationPendingAtDepartment();

        //renewal dashboard

        $renewal = new renewalCommonController();

        $renewalDashboard    = $renewal->RenewalDashboard();
        $renewalRoles     = $renewal->getRenewalRoles();
        $renewalPendingApplications = $renewal->getApplicationPendingAtDepartment(); 
        // dd($renewalPendingApplications);             
        
        return view('admin.conveyance.common.dashboard',compact('conveyanceDashboard','conveyanceRoles','pendingApplications','renewalDashboard','renewalRoles','renewalPendingApplications'));
    }    

    public function ConveyanceDashboard(){

        $role_id = session()->get('role_id');
        $user_id = Auth::id();
        $applicationData = $this->getApplicationData($role_id,$user_id);
        $parentName      = $this->getParentName();
        $statusCount     = $this->getApplicationStatusCount($applicationData,$parentName);

        return $statusCount;
    } 

    public function getConveyanceRoles(){

        $is_view = array(config('commanConfig.dycdo_engineer'),config('commanConfig.dyco_engineer'),config('commanConfig.ee_junior_engineer'),config('commanConfig.ee_branch_head'),config('commanConfig.ee_deputy_engineer'),config('commanConfig.estate_manager'),config('commanConfig.co_engineer'),config('commanConfig.joint_co'),config('commanConfig.legal_advisor'),config('commanConfig.junior_architect'),config('commanConfig.senior_architect'),config('commanConfig.architect'));

        return $is_view;

    } 

    public function getApplicationData($role_id,$user_id){
        
        $applicationData = scApplication::with([
            'scApplicationLog' => function ($q) use ($role_id,$user_id) {
                $q->where('user_id', $user_id)
                    ->where('role_id', $role_id)
                    ->where('society_flag', 0)
                    ->where('is_active',1)
                    ->orderBy('id', 'desc');
            }])
            ->whereHas('scApplicationLog', function ($q) use ($role_id,$user_id) {
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
        }else if ($role_name == config('commanConfig.la_engineer')){
            $parent_name = 'CO Engineer';
        }

        return $parent_name;   
    }

    public function getApplicationStatusCount($applicationData,$parentName){
        
        $sendForApproval = $totalPending = $sendToSocietycount = $forwardApplication = $sendForStampDuty = $sendForRegistration = $nocIssued = $revertApplication =$inprocess = $draft = $approve = $stamp = $stampSign = $registered = $noc= $StampDuty = $Registration = 0 ;
        
        $role_name   = session()->get('role_name');
        $can_revert  = $this->displayRevertVisibleRole($role_name);
        $can_forward = $this->displayForwardVisibleRole($role_name);
        $statusArr   = $this->getAllStatus(); 
        
        foreach ($applicationData as $application){
            
            $status = $application['sc_application_log']['status_id'];            
            $sendForApprovalCondition = ($application['application_status'] != $statusArr['inprocess'] && $status == 
                $statusArr['forwarded'] && $application['sent_to_society'] == 0);

            $applicationForwarded = ($application['application_status'] == $statusArr['inprocess'] && $status == 
                $statusArr['forwarded'] && $application['sent_to_society'] == 0 && $can_forward);

            $applicationReverted    = ($status == $statusArr['reverted'] && $can_revert);
            $sendToSocietyCondition = $status == $statusArr['forwarded'] && ($application['sent_to_society'] == 1);
            $sendForStampDutyCondition = ($status == $statusArr['forwarded'] && ($application['sent_to_society'] == 1 && $application['application_status'] == $statusArr['stampDuty']));            

            $sendForRegistrationCondition = ($status == $statusArr['forwarded'] && ($application['sent_to_society'] == 1 && $application['application_status'] == $statusArr['sendForRegistration']));

            $nocIssuedCondition = ($status == $statusArr['forwarded'] && ($application['sent_to_society'] == 1 && $application['application_status'] == $statusArr['noc']));

            $inprocessCondition = ($status == $statusArr['inprocess']);
            $draftCondition     = ($status == $statusArr['draft']);
            $approveCondition   = ($status == $statusArr['approve']);
            $stampCondition     = ($status == $statusArr['stamp']);
            $stampSignCondition = ($status == $statusArr['stampSign']);
            $registerCondition  = ($status == $statusArr['registered']);
            $RegistrationCondition = ($status == $statusArr['sendForRegistration'] && $application['sent_to_society'] == 0);

            $payDutyCondition = ($status == $statusArr['stampDuty'] && $application['sent_to_society'] == 0);
            $nocCondition = ($status == $statusArr['noc'] && $application['sent_to_society'] == 0);

            switch ($status)
            {                
                case $sendForApprovalCondition      : $sendForApproval       += 1; break;
                case $sendForStampDutyCondition     : $sendForStampDuty      += 1; break;
                case $sendForRegistrationCondition  : $sendForRegistration   += 1; break;
                case $nocIssuedCondition            : $nocIssued             += 1; break;
                case $applicationForwarded          : $forwardApplication    += 1; break;
                case $applicationReverted           : $revertApplication     += 1; break;

                case $inprocessCondition     : $inprocess        += 1; break;
                case $draftCondition         : $draft            += 1; break;
                case $approveCondition       : $approve          += 1; break;
                case $stampCondition         : $stamp            += 1; break;
                case $stampSignCondition     : $stampSign        += 1; break;
                case $registerCondition      : $registered       += 1; break;
                case $RegistrationCondition  : $Registration     += 1; break;
                case $payDutyCondition       : $StampDuty        += 1; break;
                case $nocCondition           : $noc              += 1; break;
                default:
                ; break;
            }
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
            $separation['NOC Issued']            = $noc; 

            $totalPending =  $totalPending + $Registration + $StampDuty +  $noc;  
        }

        //send to society Bifergation
        $sendToSociety['Send For Stamp Duty']    = $sendForStampDuty;
        $sendToSociety['Send For Registration'] = $sendForRegistration;
        $sendToSociety['NOC Issued']            = $nocIssued;

        $sendToSocietycount = $sendForRegistration + $sendForStampDuty + $nocIssued;
        
        $totalApplication = count($applicationData);

        $count['Total No of Applications'][0] = $totalApplication;
        $count['Total No of Applications'][1] = 'conveyance';
        $count['Applications Pending'][0]     = $totalPending;
        $count['Applications Pending'][1]     = 'pending';
        $count['Draft Sale & Lease Deed sent for Approval'][0] = $sendForApproval;
        $count['Draft Sale & Lease Deed sent for Approval'][1] = 'conveyance?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');
        $count['Sent to Society'][0] = $sendToSocietycount;
        $count['Sent to Society'][1] = 'sendToSociety';

        if ($can_forward){
            if ($parentName != ""){
                
                $count['Applications Forwarded to '.$parentName][0] = $forwardApplication;
                $count['Applications Forwarded to '.$parentName][1] = 'conveyance?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');                

            }else{
                $count['Applications Forwarded'][0] = $forwardApplication;
                $count['Applications Forwarded'][1] = 'conveyance?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded'); 
            }
        }    

        if ($can_revert){
                
                $count['Applications Reverted'][0] = $revertApplication;
                $count['Applications Reverted'][1] = 'conveyance?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.reverted');             
        }
        $dashboard = array($count,$separation,$sendToSociety);

        return $dashboard;
    } 

    public function getApplicationPendingAtDepartment(){
       
       $dycdoRoles     = $this->CommonController->getDYCDORoles();
       $eeRoles        = $this->CommonController->getEERoles1();
       $emRoles        = $this->CommonController->getEMRoles();
       $jtcoRoles      = $this->CommonController->getJTCORoles();
       $coRoles        = $this->CommonController->getCORoles();
       $laRoles        = $this->CommonController->getLARoles();
       $architectRoles = $this->CommonController->getArchitectRoles();

       $pendingAtDYCDO     = $this->pendingApplicationCount($dycdoRoles);
       $pendingAtEE        = $this->pendingApplicationCount($eeRoles);
       $pendingAtEM        = $this->pendingApplicationCount($emRoles);
       $pendingAtJTCO      = $this->pendingApplicationCount($jtcoRoles);
       $pendingAtCO        = $this->pendingApplicationCount($coRoles);
       $pendingAtLA        = $this->pendingApplicationCount($laRoles);
       $pendingAtArchitect = $this->pendingApplicationCount($architectRoles);

       $pendingAtDepartments = array();
       $pendingAtDepartments['Applications pending At DYCO']     = $pendingAtDYCDO;
       $pendingAtDepartments['Applications pending At EE']        = $pendingAtEE;
       $pendingAtDepartments['Applications pending At Architect'] = $pendingAtArchitect;
       $pendingAtDepartments['Applications pending At EM']        = $pendingAtEM;
       $pendingAtDepartments['Applications pending At JTCO']      = $pendingAtJTCO;
       $pendingAtDepartments['Applications pending At CO']        = $pendingAtCO;
       $pendingAtDepartments['Applications pending At LA']        = $pendingAtLA;

       return $pendingAtDepartments; 
    }

    public function pendingApplicationCount($roles){

        $status = array(config('commanConfig.conveyance_status.in_process'),config('commanConfig.conveyance_status.Draft_sale_&_lease_deed'),config('commanConfig.conveyance_status.Aproved_sale_&_lease_deed'),config('commanConfig.conveyance_status.Stamped_sale_&_lease_deed'),config('commanConfig.conveyance_status.Stamped_signed_sale_&_lease_deed'),config('commanConfig.conveyance_status.Registered_sale_&_lease_deed'),config('commanConfig.conveyance_status.Send_society_to_pay_stamp_duty'),config('commanConfig.conveyance_status.Send_society_for_registration_of_sale_&_lease'),config('commanConfig.conveyance_status.NOC_Issued'));

        $count = scApplicationLog::where('is_active',1)
            ->whereIn('status_id',$status)
            ->whereIn('role_id',$roles)
            ->get()->count();

        return $count;    
    }

    public function displayForwardVisibleRole($role_name){

        $roles = ($role_name == config('commanConfig.dyco_engineer') || $role_name == config('commanConfig.ee_deputy_engineer') || $role_name == config('commanConfig.ee_branch_head') || $role_name == config('commanConfig.senior_architect') || $role_name == config('commanConfig.architect') || $role_name == config('commanConfig.ee_junior_engineer') || $role_name == config('commanConfig.junior_architect') || $role_name == config('commanConfig.dycdo_engineer') || $role_name == config('commanConfig.estate_manager'));

        return  $roles; 
    }

    public function displayRevertVisibleRole($role_name){

        $roles = ($role_name == config('commanConfig.dyco_engineer') || $role_name == config('commanConfig.ee_deputy_engineer') || $role_name == config('commanConfig.ee_branch_head') || $role_name == config('commanConfig.senior_architect') || $role_name == config('commanConfig.architect') || $role_name == config('commanConfig.co_engineer') || $role_name == config('commanConfig.joint_co'));
        return  $roles;
    }

    public function getAllStatus(){

        $status['inprocess'] = config('commanConfig.conveyance_status.in_process');
        $status['forwarded'] = config('commanConfig.conveyance_status.forwarded');
        $status['reverted']  = config('commanConfig.conveyance_status.reverted');
        $status['draft'] = config('commanConfig.conveyance_status.Draft_sale_&_lease_deed');
        $status['approve'] = config('commanConfig.conveyance_status.Aproved_sale_&_lease_deed');
        $status['stampDuty'] = config('commanConfig.conveyance_status.Send_society_to_pay_stamp_duty');
        $status['stamp'] = config('commanConfig.conveyance_status.Stamped_sale_&_lease_deed');
        $status['stampSign'] = config('commanConfig.conveyance_status.Stamped_signed_sale_&_lease_deed');
        $status['sendForRegistration'] = config('commanConfig.conveyance_status.Send_society_for_registration_of_sale_&_lease');
        $status['registered'] = config('commanConfig.conveyance_status.Registered_sale_&_lease_deed');
        $status['noc'] = config('commanConfig.conveyance_status.NOC_Issued');

        return $status;
    }    
}      
