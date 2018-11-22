<?php

namespace App\Http\Controllers\conveyance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\CommonController;
use Yajra\DataTables\DataTables;
use App\Role;
use Carbon\Carbon;
use App\User;
use Storage;
use Auth;
use App\conveyance\SfApplication;
use App\conveyance\SfApplicationStatusLog;
use App\conveyance\SocietyConveyanceDocumentMaster;
use App\conveyance\SfDocumentStatus;
use App\conveyance\scApplicationType;
use App\ApplicationStatusMaster;

class FormationCommonController extends Controller
{
    public function __construct()
    {
        $this->list_num_of_records_per_page = config('commanConfig.list_num_of_records_per_page');
        $this->CommonController = new CommonController();
    }

    public function index(Request $request, Datatables $datatables){

        $data = $this->listApplicationData($request);
        $typeId = scApplicationType::where('application_type','=','Formation')->value('id');
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
                    $url = route('formation.view_application', ['id'=>encrypt($data->id)]);
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" name="application_id" onclick="geturl(this.value);" value="'.$url.'" ><span></span></label>';
                })  
                ->editColumn('application_no', function ($data) {

                    return $data->application_no;
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

                    $status = $data->sfApplicationLog->status_id;

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
                ->rawColumns(['radio','application_no','society_name', 'Status', 'building_name', 'societyApplication.address','date','typeId'])
                ->make(true);

        }  

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.formation.index', compact('html','header_data','getData','folder_name'));         

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

        $conveyanceId = scApplicationType::where('application_type','=',config('commanConfig.applicationType.Formation'))->value('id');

		$applicationData = SfApplication::with(['applicationLayoutUser','societyApplication','sfApplicationLog' => function($q) use($conveyanceId) {
	        	$q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'))
	            ->where('application_master_id', $conveyanceId)
	            ->orderBy('id', 'desc');
		}])

        ->whereHas('sfApplicationLog', function ($q) use($conveyanceId) {
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'))
                ->where('application_master_id', $conveyanceId)
                ->orderBy('id', 'desc');
        });

        $applicationData = $applicationData->orderBy('sf_applications.id', 'desc')->get();
        $listArray = [];

        if ($request->update_status) {

            foreach ($applicationData as $app_data) {
                if ($app_data->sfApplicationLog[0]->status_id == $request->update_status) {
                    $listArray[] = $app_data;
                }
            }
        } else {
            $listArray = $applicationData;
        } 
    
        return $listArray;       	
    }

    public function ViewApplication(Request $request,$applicationId){
        $disabled=1;
            $id = decrypt($applicationId);
            $sf_documents = SocietyConveyanceDocumentMaster::with(['sf_document_status' => function ($q) use ($id) {
                return $q->where(['application_id' => $id]);
            }])->where(['application_type_id' => 3])->get();
            $sf_application = SfApplication::find($id);
            return view('admin.formation.view_application', compact('sf_application', 'sf_documents','disabled'));

        //return view('admin.conveyance.common.view_application',compact('data'));
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
        //dd($result);
        $parent  = "";

        if ($result){
            $parent = User::with(['roles','LayoutUser' => function($q){
                $q->where('layout_id', session('layout_id'));
            }])
            ->whereHas('LayoutUser' ,function($q){
                $q->where('layout_id', session('layout_id'));
            })
            ->whereHas('roles' ,function($q){
                $q->where('name', config('commanConfig.estate_manager'));
            })
            ->whereIn('role_id',$result)->get();            
        }
        //dd($parent);
        return $parent;
    }

    // get current status of application
    public function getCurrentStatus($application_id,$masterId)
    {
        $current_status = SfApplicationStatusLog::where('application_id', $application_id)
            ->where('application_master_id',$masterId)
            ->where('user_id', Auth::user()->id)
            ->where('role_id', session()->get('role_id'))
            ->orderBy('id', 'desc')->first();
   
        return $current_status;
    }

    public function getForwardApplicationData($applicationId){
       // dd($applicationId);
        $data = SfApplication::with('societyApplication')
        ->where('id',$applicationId)->first();
        $data->society_role_id = Role::where('name', config('commanConfig.society_offer_letter'))->value('id');
        $data->status = $this->getCurrentStatus($applicationId,$data->sc_application_master_id);
        $data->parent = $this->getForwardApplicationParentData();
        $data->child  = $this->getRevertApplicationChildData();
        return $data;        
    }

    // get logs of DYCO dept
    public function getLogsOfDYCODepartment($applicationId,$masterId)
    {

        $roles = array(config('commanConfig.dycdo_engineer'), config('commanConfig.dyco_engineer'));

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $dycoRoles = Role::whereIn('name', $roles)->pluck('id');
        $dycologs  = SfApplicationStatusLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)
        ->where('application_master_id',$masterId)->whereIn('role_id', $dycoRoles)->whereIn('status_id', $status)->get();

        return $dycologs;
    } 

    // get logs of Society
    public function getLogsOfSociety($applicationId,$masterId)
    {
        $roles = array(config('commanConfig.society_offer_letter'));

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $societyRoles = Role::whereIn('name', $roles)->pluck('id');
        $ocietylogs  = SfApplicationStatusLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('society_flag','=','1')->where('application_master_id',$masterId)->whereIn('role_id', $societyRoles)->whereIn('status_id', $status)->get();
        // dd($societyRoles);

        return $ocietylogs;
    } 

    public function commonForward(Request $request,$applicationId){
        $applicationId=decrypt($applicationId);
        $sf_application = SfApplication::with('societyApplication')->where('id',$applicationId)->first();
        $data          = $this->getForwardApplicationData($applicationId);
        //dd($data);
        //$data->folder  = $this->getCurrentRoleFolderName();
        $societyLogs   = $this->getLogsOfSociety($applicationId,$data->sc_application_master_id);
        $dycoLogs      = $this->getLogsOfDYCODepartment($applicationId,$data->sc_application_master_id);
        //$eelogs        = $this->getLogsOfEEDepartment($applicationId,$data->sc_application_master_id);
        //$Architectlogs = $this->getLogsOfArchitectDepartment($applicationId,$data->sc_application_master_id);
        //$cologs        = $this->getLogsOfCODepartment($applicationId,$data->sc_application_master_id);
        
        //$this->getAllSaleLeaseAgreement($data,$applicationId,$data->sc_application_master_id);
  
        // if (session()->get('role_name') == config('commanConfig.co_engineer') || session()->get('role_name') == config('commanConfig.joint_co')){
        //   $route = 'admin.conveyance.co_department.forward_application';
  
        // } elseif (session()->get('role_name') == config('commanConfig.dyco_engineer') || session()->get('role_name') == config('commanConfig.dycdo_engineer')){
  
        //        $route = 'admin.conveyance.dyco_department.forward_application';
        //   }     
        //   else{
        //   $route = 'admin.conveyance.common.forward_application';
        // }
  
        return view('admin.formation.forward_application',compact('data','societyLogs','dycoLogs','sf_application'));         
      }

      public function saveForwardApplication(Request $request){
        //return $request->all();
        $forwardData = $this->forwardApplication($request); 
        return redirect()->route('get_sf_applications.index')->with('success','Application sent successfully.');
    }

    // forward and revert application
    public function forwardApplication($request){
        
        $Scstatus = "";
        $data = SfApplication::where('id',$request->applicationId)->first();
        $applicationStatus = $data->application_status;
        $masterId = $data->sc_application_master_id;

        $dycdoId =  Role::where('name',config('commanConfig.dycdo_engineer'))->value('id');  
        $dycoId =  Role::where('name',config('commanConfig.dyco_engineer'))->value('id'); 
         
        if ($request->check_status == 1) {
            $status = config('commanConfig.applicationStatus.forwarded');                
        }else{
            $status = config('commanConfig.applicationStatus.reverted');
        }
        $Tostatus = config('commanConfig.applicationStatus.in_process');
       
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

            SfApplicationStatusLog::insert($application); 
            if ($Scstatus != ""){
                SfApplication::where('id',$request->applicationId)->where('sc_application_master_id',$masterId)
                ->update(['application_status' => $Tostatus]);                    
            }
    }
}
