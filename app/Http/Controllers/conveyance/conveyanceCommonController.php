<?php

namespace App\Http\Controllers\conveyance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\CommonController;
use App\conveyance\scApplication;
use App\conveyance\scApplicationLog;
use Yajra\DataTables\DataTables;
use App\Role;
use Carbon\Carbon;
use Config;
use App\User;
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
                    return '<span>'.$data->societyApplication->address.'</span>';
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
                ->rawColumns(['radio','society_name', 'Status', 'building_name', 'society_address','date','eeApplicationSociety.address'])
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

    public function ViewApplication(Request $request,$applicationId){
        
        $data = $this->listApplicationData($request); 
        if (session()->get('role_name') == config('commanConfig.ee_junior_engineer')){
            $data->folder = 'ee_department';
        }        
        else if (session()->get('role_name') == config('commanConfig.dycdo_engineer') || session()->get('role_name') == config('commanConfig.dyco_engineer')){
            $data->folder = 'dyco_department';
        }        
        else if (session()->get('role_name') == config('commanConfig.estate_manager')){
            $data->folder = 'em_department';
        }

        $data->id = $applicationId;
        return view('admin.conveyance.common.view_application',compact('data'));
    }             

	// list all data
    public function listApplicationData($request){

		$applicationData = scApplication::with(['applicationLayoutUser','societyApplication','scApplicationLog' => function($q) {
	        	$q->where('user_id', Auth::user()->id)
	            ->where('role_id', session()->get('role_id'))
	            ->orderBy('id', 'desc');
		}])

        ->whereHas('scApplicationLog', function ($q) {
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'))
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

    public function getForwardApplicationChildData(){
        
        $role_id = Role::where('id',Auth::user()->role_id)->first();
        $result = json_decode($role_id->conveyance_child_id);
        $child = "";
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

    // forward and revert application
    public function forwardApplication($request){
 
        if ($request->check_status == 1) {
            $status = config('commanConfig.applicationStatus.forwarded');
        }else{
            $status = config('commanConfig.applicationStatus.reverted');
        } 
            $application = [[
                'application_id' => $request->applicationId,
                'user_id'        => Auth::user()->id,
                'role_id'        => session()->get('role_id'),
                'status_id'      => $status,
                'to_user_id'     => $request->to_user_id,
                'to_role_id'     => $request->to_role_id,
                'remark'         => $request->remark,
                'created_at'     => Carbon::now(),
            ],
            [
                'application_id' => $request->applicationId,
                'user_id'       => $request->to_user_id,
                'role_id'       => $request->to_role_id,
                'status_id'     => config('commanConfig.applicationStatus.in_process'),
                'to_user_id'    => null,
                'to_role_id'    => null,
                'remark'        => $request->remark,
                'created_at'    => Carbon::now(),
            ],
            ];

            scApplicationLog::insert($application);      
    }

    public function getForwardApplicationData($applicationId){

        $data = scApplication::with('societyApplication')->where('id',$applicationId)->first();
        $data->child = $this->getForwardApplicationChildData();
        return $data;        
    }
}
