<?php

namespace App\Http\Controllers\CODepartment;

use App\Department;
use App\Hearing;
use App\HearingSchedule;
use App\Http\Controllers\Dashboard\ArchitectLayoutDashboardController;
use App\Http\Controllers\Tripartite\TripartiteDashboardController;
use App\Role;
use App\RtiDepartmentUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\CommonController;
use Yajra\DataTables\DataTables;
use App\olSiteVisitDocuments;
use App\OlApplication;
use App\NocApplication;
use App\NocCCApplication;
use Carbon\Carbon;
use App\SocietyOfferLetter;
use App\OlSocietyDocumentsStatus;
use App\OlConsentVerificationDetails;
use App\OlDemarcationVerificationDetails;
use App\OlTitBitVerificationDetails;
use App\OlRelocationVerificationDetails;
use App\OlChecklistScrutiny;
use App\OlApplicationStatus;
use App\NocSrutinyQuestionMaster;
use App\NocReeScrutinyAnswer;
use App\NocApplicationStatus;
use App\NocCCApplicationStatus;
use App\OcApplication;
use App\OcApplicationStatusLog;
use App\OcSrutinyQuestionMaster;
use App\OcEEScrutinyAnswer;
use App\Http\Controllers\conveyance\conveyanceCommonController;
use App\Http\Controllers\SocietyNocController;
use App\Http\Controllers\SocietyNocforCCController;
use App\User;
use Config;
use Auth;
use DB;
use App\LayoutUser;
 
class COController extends Controller
{
    public function __construct()
    {
        $this->CommonController = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    public function index(Request $request, Datatables $datatables){


        $getData = $request->all();
        $columns = [
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address', 'class' => 'datatable-address'],
            ['data' => 'model','name' => 'model','title' => 'Model'],
            ['data' => 'Status','name' => 'Status','title' => 'Status'],
            // ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {

            $co_application_data = $this->CommonController->listApplicationData($request);

            return $datatables->of($co_application_data)
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++; return $i;
                })
                ->editColumn('radio', function ($co_application_data) {
                    $url = route('co.view_application', encrypt($co_application_data->id));
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="village_data_id"><span></span></label>';
                })
                ->editColumn('eeApplicationSociety.name', function ($co_application_data) {
                    return $co_application_data->eeApplicationSociety->name;
                })
                ->editColumn('eeApplicationSociety.building_no', function ($co_application_data) {
                    return $co_application_data->eeApplicationSociety->building_no;
                })
                ->editColumn('eeApplicationSociety.address', function ($co_application_data) {
                    return "<span>".$co_application_data->eeApplicationSociety->address."</span>";
                })
                ->editColumn('date', function ($co_application_data) {
                    return date(config('commanConfig.dateFormat'), strtotime($co_application_data->submitted_at));
                })
                // ->editColumn('actions', function ($co_application_data) use($request){
                //    return view('admin.co_department.action', compact('co_application_data', 'request'))->render();
                // })
                ->editColumn('model', function ($listArray) {
                    return $listArray->ol_application_master->model;
                })                 
                ->editColumn('Status', function ($listArray) use ($request) {
                    $status = $listArray->olApplicationStatusForLoginListing[0]->status_id;

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
                ->rawColumns(['radio','society_name', 'Status', 'building_name', 'society_address','date','actions','eeApplicationSociety.address'])
                ->make(true);
        }
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.co_department.index', compact('html','header_data','getData'));

    }


    public function revalidationApplicationList(Request $request, Datatables $datatables){
        $getData = $request->all();
        $columns = [
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address','class' => 'datatable-address', 'searchable' => false],
            // ['data' => 'model','name' => 'model','title' => 'Model'],
            ['data' => 'Status','name' => 'Status','title' => 'Status'],
            // ['data' => 'Model','name' => 'Model','title' => 'Model'],
            // ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];
        if ($datatables->getRequest()->ajax()) {

            //dd($request);
            $ree_application_data = $this->CommonController->listApplicationData($request,'reval');
            // dd($ree_application_data);
            // $ol_application = $this->CommonController->getOlApplication($ree_application_data->id);

            return $datatables->of($ree_application_data)
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++; return $i;
                })
                ->editColumn('radio', function ($ree_application_data) {
                    $url = route('co.view_reval_application', $ree_application_data->id);
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="village_data_id"><span></span></label>';
                })
                ->editColumn('eeApplicationSociety.name', function ($ree_application_data) {
                    return $ree_application_data->eeApplicationSociety->name;
                })
                ->editColumn('eeApplicationSociety.building_no', function ($ree_application_data) {
                    return $ree_application_data->eeApplicationSociety->building_no;
                })
                ->editColumn('eeApplicationSociety.address', function ($ree_application_data) {
                    return "<span>".$ree_application_data->eeApplicationSociety->address."</span>";
                })
                ->editColumn('date', function ($ree_application_data) {
                    return date(config('commanConfig.dateFormat'), strtotime($ree_application_data->submitted_at));
                })
                // ->editColumn('actions', function ($ree_application_data) use($request){
                //    return view('admin.REE_department.action', compact('ree_application_data', 'request'))->render();
                // })
                ->editColumn('Status', function ($listArray) use ($request) {
                    $status = $listArray->olApplicationStatusForLoginListing[0]->status_id;

                    if ($request->update_status)
                    {
                        if ($request->update_status == $status){
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
                // ->editColumn('Model', function ($ree_application_data) {
                //          return $ree_application_data->ol_application_master->model;
                //      })hya
                ->rawColumns(['radio','society_name', 'building_name', 'society_address','date','Status','eeApplicationSociety.address'])
                ->make(true);
        }
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.co_department.reval_applications', compact('html','header_data','getData'));
    }

    public function nocApplicationList(Request $request, Datatables $datatables){


        $getData = $request->all();
        $columns = [
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address', 'class' => 'datatable-address'],
            ['data' => 'Model','name' => 'Model','title' => 'Model'],
            ['data' => 'Status','name' => 'Status','title' => 'Status'],
            // ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {

            $co_application_data = $this->CommonController->listApplicationDataNoc($request);

            return $datatables->of($co_application_data)
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++; return $i;
                })
                ->editColumn('radio', function ($co_application_data) {
                    $url = route('co.view_noc_application', $co_application_data->id);
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="village_data_id"><span></span></label>';
                })
                ->editColumn('eeApplicationSociety.name', function ($co_application_data) {
                    return $co_application_data->eeApplicationSociety->name;
                })
                ->editColumn('eeApplicationSociety.building_no', function ($co_application_data) {
                    return $co_application_data->eeApplicationSociety->building_no;
                })
                ->editColumn('eeApplicationSociety.address', function ($co_application_data) {
                    return "<span>".$co_application_data->eeApplicationSociety->address."</span>";
                })
                ->editColumn('date', function ($co_application_data) {
                    return date(config('commanConfig.dateFormat'), strtotime($co_application_data->submitted_at));
                })
                // ->editColumn('actions', function ($co_application_data) use($request){
                //    return view('admin.co_department.action', compact('co_application_data', 'request'))->render();
                // })
                ->editColumn('Status', function ($listArray) use ($request) {
                    $status = $listArray->nocApplicationStatusForLoginListing[0]->status_id;

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
                ->editColumn('Model', function ($co_application_data) {
                    return $co_application_data->noc_application_master->model;
                })
                ->rawColumns(['radio','society_name', 'Status', 'building_name', 'society_address','date','actions','eeApplicationSociety.address'])
                ->make(true);
        }
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.co_department.noc_applications', compact('html','header_data','getData'));

    }

    public function nocforCCApplicationList(Request $request, Datatables $datatables){


        $getData = $request->all();
        $columns = [
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address', 'class' => 'datatable-address'],
            ['data' => 'Model','name' => 'Model','title' => 'Model'],
            ['data' => 'Status','name' => 'Status','title' => 'Status'],
            // ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {

            $co_application_data = $this->CommonController->listApplicationDataNocforCC($request);

            return $datatables->of($co_application_data)
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++; return $i;
                })
                ->editColumn('radio', function ($co_application_data) {
                    $url = route('co.view_noc_cc_application', $co_application_data->id);
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="village_data_id"><span></span></label>';
                })
                ->editColumn('eeApplicationSociety.name', function ($co_application_data) {
                    return $co_application_data->eeApplicationSociety->name;
                })
                ->editColumn('eeApplicationSociety.building_no', function ($co_application_data) {
                    return $co_application_data->eeApplicationSociety->building_no;
                })
                ->editColumn('eeApplicationSociety.address', function ($co_application_data) {
                    return "<span>".$co_application_data->eeApplicationSociety->address."</span>";
                })
                ->editColumn('date', function ($co_application_data) {
                    return date(config('commanConfig.dateFormat'), strtotime($co_application_data->submitted_at));
                })
                // ->editColumn('actions', function ($co_application_data) use($request){
                //    return view('admin.co_department.action', compact('co_application_data', 'request'))->render();
                // })
                ->editColumn('Status', function ($listArray) use ($request) {
                    $status = $listArray->nocApplicationStatusForLoginListing[0]->status_id;

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
                ->editColumn('Model', function ($co_application_data) {
                    return $co_application_data->noc_application_master->model;
                })
                ->rawColumns(['radio','society_name', 'Status', 'building_name', 'society_address','date','actions','eeApplicationSociety.address'])
                ->make(true);
        }
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.co_department.noc_cc_applications', compact('html','header_data','getData'));

    }

    public function consentforOcApplicationList(Request $request, Datatables $datatables){
        

        $getData = $request->all();
        $columns = [
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address', 'class' => 'datatable-address'],
             ['data' => 'Model','name' => 'Model','title' => 'Model'],
             ['data' => 'Status','name' => 'Status','title' => 'Status'],
            // ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {

            $co_application_data = $this->CommonController->listApplicationDataOc($request);

            return $datatables->of($co_application_data)
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++; return $i;
                })
                ->editColumn('radio', function ($co_application_data) {
                    $url = route('co.view_oc_application', $co_application_data->id);
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="village_data_id"><span></span></label>';
                })                
                ->editColumn('eeApplicationSociety.name', function ($co_application_data) {
                    return $co_application_data->eeApplicationSociety->name;
                })
                ->editColumn('eeApplicationSociety.building_no', function ($co_application_data) {
                    return $co_application_data->eeApplicationSociety->building_no;
                })
                ->editColumn('eeApplicationSociety.address', function ($co_application_data) {
                    return "<span>".$co_application_data->eeApplicationSociety->address."</span>";
                })                
                ->editColumn('date', function ($co_application_data) {
                    return date(config('commanConfig.dateFormat'), strtotime($co_application_data->submitted_at));
                })
                // ->editColumn('actions', function ($co_application_data) use($request){
                //    return view('admin.co_department.action', compact('co_application_data', 'request'))->render();
                // })
                ->editColumn('Status', function ($listArray) use ($request) {
                    $status = $listArray->ocApplicationStatusForLoginListing[0]->status_id;

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
                ->editColumn('Model', function ($co_application_data) {
                    return $co_application_data->oc_application_master->model;
                })
                ->rawColumns(['radio','society_name', 'Status', 'building_name', 'society_address','date','actions','eeApplicationSociety.address'])
                ->make(true);
        }        
                $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
            
            return view('admin.co_department.oc_applications', compact('html','header_data','getData'));    
    
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

    // society and EE documents
    public function societyEEDocuments(Request $request,$applicationId){

        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);

        $societyDocuments = $this->CommonController->getSocietyEEDocuments($applicationId);
        return view('admin.co_department.society_EE_documents',compact('societyDocuments','ol_application'));
    }

    // EE - Scrutiny & Remark page
    public function eeScrutinyRemark(Request $request,$applicationId){
        
        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);
        $eeScrutinyData = $this->CommonController->getEEScrutinyRemark($applicationId);
        return view('admin.co_department.EE_Scrunity_Remark',compact('eeScrutinyData','ol_application'));
    }

    // DyCE Scrutiny & Remark page
    public function dyceScrutinyRemark(Request $request,$applicationId){
        
        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);
        $applicationData = $this->CommonController->getDyceScrutinyRemark($applicationId);
        return view('admin.co_department.dyce_scrunity_remark',compact('applicationData','ol_application'));
    }

    // Forward Application page
    public function forwardApplication(Request $request, $applicationId){

        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);
        $applicationData = $this->CommonController->getForwardApplication($applicationId);
//        $arrData['application_status'] = $this->CommonController->getCurrentApplicationStatus($applicationId);

//        if(session()->get('role_name') != config('commanConfig.co_engineer'))
        $arrData['application_status'] = $this->CommonController->getCurrentLoggedInChild($applicationId);

        $arrData['get_current_status'] = $this->CommonController->getCurrentStatus($applicationId);

        // CAP Forward Application

        $cap_role_id = Role::where('name', '=', config('commanConfig.cap_engineer'))->first();
        $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
        $layout_ids = array_column($layout_id_array, 'layout_id');
        if($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.offer_letter_generation'))
        {
            $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();

            $arrData['get_forward_ree'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                ->whereIn('lu.layout_id', $layout_ids)
                ->where('role_id', $ree_id->id)->groupBy('users.id')->get();

            $arrData['ree_role_name']   = strtoupper(str_replace('_', ' ', $ree_id->name));
        }
        else
        {
            $arrData['get_forward_cap'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                ->whereIn('lu.layout_id', $layout_ids)
                ->where('role_id', $cap_role_id->id)->groupBy('users.id')->get();
            $arrData['cap_role_name'] = strtoupper(str_replace('_', ' ', $cap_role_id->name));
        }


        // remark and history
        // $this->CommonController->getEEForwardRevertLog($applicationData,$applicationId);
        // $this->CommonController->getDyceForwardRevertLog($applicationData,$applicationId);
        // $this->CommonController->getREEForwardRevertLog($applicationData,$applicationId);
        // $eelogs   = $this->CommonController->getLogsOfEEDepartment($applicationId);
        // $dyceLogs = $this->CommonController->getLogsOfDYCEDepartment($applicationId);
        // $reeLogs  = $this->CommonController->getLogsOfREEDepartment($applicationId);
        // $coLogs   = $this->CommonController->getLogsOfCODepartment($applicationId);
        // $capLogs  = $this->CommonController->getLogsOfCAPDepartment($applicationId);
        // $vpLogs   = $this->CommonController->getLogsOfVPDepartment($applicationId);

        //remark and history
        $remarkHistory = $this->CommonController->getRemarkHistory($applicationId);

        return view('admin.co_department.forward_application',compact('applicationData', 'arrData','ol_application','remarkHistory'));
    }

    public function forwardRevalApplication(Request $request, $applicationId){

        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);
        $applicationData = $this->CommonController->getForwardApplication($applicationId);
//        $arrData['application_status'] = $this->CommonController->getCurrentApplicationStatus($applicationId);

//        if(session()->get('role_name') != config('commanConfig.co_engineer'))
        $arrData['application_status'] = $this->CommonController->getCurrentLoggedInChild($applicationId);

        $arrData['get_current_status'] = $this->CommonController->getCurrentStatus($applicationId);

        // CAP Forward Application

        $cap_role_id = Role::where('name', '=', config('commanConfig.cap_engineer'))->first();
        $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
        $layout_ids = array_column($layout_id_array, 'layout_id');
        if($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.offer_letter_generation'))
        {
            $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();

            $arrData['get_forward_ree'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                ->whereIn('lu.layout_id', $layout_ids)
                ->where('role_id', $ree_id->id)->groupBy('users.id')->get();

            $arrData['ree_role_name']   = strtoupper(str_replace('_', ' ', $ree_id->name));
        }
        else
        {
            $arrData['get_forward_cap'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                ->whereIn('lu.layout_id', $layout_ids)
                ->where('role_id', $cap_role_id->id)->groupBy('users.id')->get();
            $arrData['cap_role_name'] = strtoupper(str_replace('_', ' ', $cap_role_id->name));
        }


        // remark and history
        $this->CommonController->getEEForwardRevertLog($applicationData,$applicationId);
        $this->CommonController->getDyceForwardRevertLog($applicationData,$applicationId);
        $this->CommonController->getREEForwardRevertLog($applicationData,$applicationId);

        //remark and history
        $eelogs   = $this->CommonController->getLogsOfEEDepartment($applicationId);
        $dyceLogs = $this->CommonController->getLogsOfDYCEDepartment($applicationId);
        $reeLogs  = $this->CommonController->getLogsOfREEDepartment($applicationId);
        $coLogs   = $this->CommonController->getLogsOfCODepartment($applicationId);
        $capLogs  = $this->CommonController->getLogsOfCAPDepartment($applicationId);
        $vpLogs   = $this->CommonController->getLogsOfVPDepartment($applicationId);

        return view('admin.co_department.forward_reval_application',compact('applicationData', 'arrData','ol_application','eelogs','dyceLogs','reeLogs','coLogs','capLogs','vpLogs'));
    }

    public function sendForwardApplication(Request $request){
        $arrData['get_current_status'] = $this->CommonController->getCurrentStatus($request->applicationId);

        if($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.offer_letter_generation'))
        {
            $this->CommonController->generateOfferLetterForwardToREE($request);
        }
        else
        {
            $this->CommonController->forwardApplicationForm($request);
        }
        return redirect('/co')->with('success','Application send successfully.');
    }

    public function sendForwardRevalApplication(Request $request){
        $arrData['get_current_status'] = $this->CommonController->getCurrentStatus($request->applicationId);

        if($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.offer_letter_generation'))
        {
            $this->CommonController->generateOfferLetterForwardToREE($request);
        }
        else
        {
            $this->CommonController->forwardApplicationForm($request);
        }
        return redirect('/co_reval_applications')->with('success','Application send successfully.');
    }

    public function downloadCapNote(Request $request, $applicationId){
        
        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);
        $capNote = $this->CommonController->downloadCapNote($applicationId);

        return view('admin.co_department.cap_note',compact('capNote','ol_application'));
    }

    public function approveOfferLetter(Request $request, $applicationId){

        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);
        // dd($ol_application->status->status_id);
        $ree_branch_head = Role::where('name',config('commanConfig.ree_branch_head'))->value('id');
        $co = Role::where('name',config('commanConfig.co_engineer'))->value('id');

        $applicationData = OlApplication::where('id',$applicationId)->first();

        $applicationData->ReeLog = OlApplicationStatus::where('application_id',$applicationId)->where('role_id',$ree_branch_head)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();

        $applicationData->coLog = OlApplicationStatus::where('application_id',$applicationId)->where('role_id',$co)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();

        return view('admin.co_department.approve_offer_letter',compact('applicationData','ol_application'));
    }

    public function approveRevalOfferLetter(Request $request, $applicationId){

        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);
        // dd($ol_application->status->status_id);
        $ree_branch_head = Role::where('name',config('commanConfig.ree_branch_head'))->value('id');
        $co = Role::where('name',config('commanConfig.co_engineer'))->value('id');

        $applicationData = OlApplication::where('id',$applicationId)->first();

        $applicationData->ReeLog = OlApplicationStatus::where('application_id',$applicationId)->where('role_id',$ree_branch_head)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();

        $applicationData->coLog = OlApplicationStatus::where('application_id',$applicationId)->where('role_id',$co)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();

        return view('admin.co_department.approve_reval_offer_letter',compact('applicationData','ol_application'));
    }

    public function approvedOfferLetter(Request $request){

        $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();
        $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
        $layout_ids = array_column($layout_id_array, 'layout_id');
        $ree = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
            ->whereIn('lu.layout_id', $layout_ids)
            ->where('role_id', $ree_id->id)->first();

        $this->CommonController->generateOfferLetterForwardToREE($request,$ree);
        return redirect('/co')->with('success','Approved Offer Letter successfully.');

        // $updateApplication = OlApplication::where('id',)
    }

    public function approvedRevalOfferLetter(Request $request){

        $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();
        $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
        $layout_ids = array_column($layout_id_array, 'layout_id');
        $ree = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
            ->whereIn('lu.layout_id', $layout_ids)
            ->where('role_id', $ree_id->id)->first();

        $this->CommonController->generateOfferLetterForwardToREE($request,$ree);
        return redirect('/co_reval_applications')->with('success','Approved Offer Letter successfully.');

        // $updateApplication = OlApplication::where('id',)
    }

    public function viewApplication(Request $request, $applicationId){

        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);

        $ol_application = $this->CommonController->downloadOfferLetter($applicationId);
        $ol_application->folder = 'co_department';
        $ol_application->comments = $this->CommonController->getSocietyDocumentComments($ol_application->id);

        return view('admin.common.offer_letter', compact('ol_application'));
    }

    public function viewRevalApplication(Request $request, $applicationId){

        $ol_application = $this->CommonController->downloadOfferLetter($applicationId);
        $ol_application->folder = 'co_department';

        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();

        return view('admin.common.reval_offer_letter', compact('ol_application'));
    }

    public function societyRevalDocuments(Request $request,$applicationId){

        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $societyDocument = $this->CommonController->getRevalSocietyREEDocuments($applicationId);

        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();

        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);
        return view('admin.co_department.society_reval_documents', compact('societyDocument','ol_application'));
    }

    public function showCalculationSheet(Request $request, $applicationId){

        $user = $this->CommonController->showCalculationSheet($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);
        $ol_application->folder = 'co_department';
        $calculationSheetDetails = $user->calculationSheetDetails;
        $dcr_rates = $user->dcr_rates;
        $blade = $user->blade;
        $arrData['reeNote'] = $user->areeNote;
        // dd($blade);
        return view('admin.common.'.$blade,compact('calculationSheetDetails','applicationId','user','dcr_rates','arrData','ol_application'));
    }

    public function showRevalCalculationSheet(Request $request, $applicationId){

        $user = $this->CommonController->showCalculationSheet($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);
        $ol_application->folder = 'co_department';
        $folder = 'co_department';
        $calculationSheetDetails = $user->calculationSheetDetails;
        $dcr_rates = $user->dcr_rates;
        $blade = $user->blade;
        $arrData['reeNote'] = $user->areeNote;
        // dd($blade);
        return view('admin.common.'.$blade,compact('calculationSheetDetails','applicationId','user','dcr_rates','arrData','ol_application','folder'));
    }

    public function viewNocApplication(Request $request, $applicationId){

        $noc_application = $this->CommonController->downloadNoc($applicationId);
        $noc_application->folder = 'co_department';

        $noc_application->model = NocApplication::with(['noc_application_master'])->where('id',$applicationId)->first();

        return view('admin.common.noc', compact('noc_application'));
    }

    public function viewNocforCCApplication(Request $request, $applicationId){

        $noc_application = $this->CommonController->downloadNocforCC($applicationId);
        $noc_application->folder = 'co_department';

        $noc_application->model = NocApplication::with(['noc_application_master'])->where('id',$applicationId)->first();

        return view('admin.common.noc_cc', compact('noc_application'));
    }

    public function societyNocDocuments(Request $request,$applicationId){

        $noc_application = $this->CommonController->getNocApplication($applicationId);
        $noc_application->model = NocApplication::with(['noc_application_master'])->where('id',$applicationId)->first();
        $societyDocuments = $this->CommonController->getSocietyNocDocuments($applicationId);
        $comments = $this->CommonController->getNOCApplicationComments($applicationId);

        return view('admin.co_department.society_noc_documents',compact('noc_application','societyDocuments','comments'));
    }

    public function societyNocforCCDocuments(Request $request,$applicationId){

        $noc_application = $this->CommonController->getNocforCCApplication($applicationId);
        $noc_application->model = NocCCApplication::with(['noc_application_master'])->where('id',$applicationId)->first();
        $societyDocuments = $this->CommonController->getSocietyNocCCDocuments($applicationId);

        return view('admin.co_department.society_noc_cc_documents',compact('noc_application','societyDocuments'));
    }

    public function nocScrutinyRemarks(Request $request,$applicationId){

        $noc_application = $this->CommonController->getNocApplication($applicationId);
        $noc_application->status = $this->CommonController->getCurrentStatusNoc($applicationId);

        $application_master_id = NocApplication::where('society_id', $noc_application->eeApplicationSociety->id)->value('application_master_id');

        $arrData['society_detail'] = NocApplication::with('eeApplicationSociety')->where('id', $applicationId)->first();

        $arrData['scrutiny_questions_noc'] = NocSrutinyQuestionMaster::all();

        $arrData['scrutiny_answers_to_questions'] = NocReeScrutinyAnswer::where('application_id', $applicationId)->get()->keyBy('question_id')->toArray();

        $arrData['get_last_status'] = NocApplicationStatus::where([
            'application_id' =>  $applicationId,
            'user_id' => Auth::user()->id,
            'role_id' => session()->get('role_id')
        ])->orderBy('id', 'desc')->first();

        return view('admin.co_department.scrutiny-remark-noc', compact('arrData','noc_application'));
    }

    public function nocforCCScrutinyRemarks(Request $request,$applicationId){

        $noc_application = $this->CommonController->getNocforCCApplication($applicationId);
        $noc_application->status = $this->CommonController->getCurrentStatusNocCC($applicationId);

        $application_master_id = NocCCApplication::where('society_id', $noc_application->eeApplicationSociety->id)->value('application_master_id');

        $arrData['society_detail'] = NocCCApplication::with('eeApplicationSociety')->where('id', $applicationId)->first();

        $arrData['get_last_status'] = NocCCApplicationStatus::where([
            'application_id' =>  $applicationId,
            'user_id' => Auth::user()->id,
            'role_id' => session()->get('role_id')
        ])->orderBy('id', 'desc')->first();

        return view('admin.co_department.scrutiny-remark-noc-cc', compact('arrData','noc_application'));
    }

    public function issueNoc(Request $request, $applicationId){

        $noc_application = $this->CommonController->getNocApplication($applicationId);
        $noc_application->status = $this->CommonController->getCurrentStatusNoc($applicationId);
        // dd($ol_application->status->status_id);
        $ree_branch_head = Role::where('name',config('commanConfig.ree_branch_head'))->value('id');
        $co = Role::where('name',config('commanConfig.co_engineer'))->value('id');

        $applicationData = NocApplication::where('id',$applicationId)->first();

        $applicationData->ReeLog = NocApplicationStatus::where('application_id',$applicationId)->where('role_id',$ree_branch_head)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();

        $applicationData->coLog = NocApplicationStatus::where('application_id',$applicationId)->where('role_id',$co)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();

        return view('admin.co_department.issue_noc',compact('applicationData','noc_application'));
    }

    public function issueNocforCC(Request $request, $applicationId){

        $noc_application = $this->CommonController->getNocforCCApplication($applicationId);
        $noc_application->status = $this->CommonController->getCurrentStatusNocCC($applicationId);
        // dd($ol_application->status->status_id);
        $ree_branch_head = Role::where('name',config('commanConfig.ree_branch_head'))->value('id');
        $co = Role::where('name',config('commanConfig.co_engineer'))->value('id');

        $applicationData = NocCCApplication::where('id',$applicationId)->first();

        $applicationData->ReeLog = NocCCApplicationStatus::where('application_id',$applicationId)->where('role_id',$ree_branch_head)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();

        $applicationData->coLog = NocCCApplicationStatus::where('application_id',$applicationId)->where('role_id',$co)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();

        return view('admin.co_department.issue_noc_cc',compact('applicationData','noc_application'));
    }

    public function approveNoctoRee(Request $request){

        $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();
        $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
        $layout_ids = array_column($layout_id_array, 'layout_id');
        $ree = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
            ->whereIn('lu.layout_id', $layout_ids)
            ->where('role_id', $ree_id->id)->first();

        $this->CommonController->generateNOCforwardToREE($request,$ree);
        return redirect('/co_noc_applications')->with('success','NOC has been approved successfully.');

        // $updateApplication = OlApplication::where('id',)
    }

    public function approveNocforCCtoRee(Request $request){

        $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();
        $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
        $layout_ids = array_column($layout_id_array, 'layout_id');
        $ree = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
            ->whereIn('lu.layout_id', $layout_ids)
            ->where('role_id', $ree_id->id)->first();

        $this->CommonController->generateNOCforCCforwardToREE($request,$ree);
        return redirect('/co_noc_cc_applications')->with('success','NOC has been approved successfully.');

        // $updateApplication = OlApplication::where('id',)
    }

    public function forwardNOCApplication(Request $request, $applicationId){

        $noc_application = $this->CommonController->getNocApplication($applicationId);
        $noc_application->status = $this->CommonController->getCurrentStatusNoc($applicationId);
        $applicationData = $this->CommonController->getForwardNocApplication($applicationId);

        $arrData['application_status'] = $this->CommonController->getCurrentLoggedInChildNoc($applicationId);

        $arrData['get_current_status'] = $this->CommonController->getCurrentStatusNoc($applicationId);
        $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
        $layout_ids = array_column($layout_id_array, 'layout_id');
        if(isset($arrData['get_current_status']->status_id) && $arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.NOC_Generation'))
        {
            $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();

            $arrData['get_forward_ree'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                ->whereIn('lu.layout_id', $layout_ids)
                ->where('role_id', $ree_id->id)->groupBy('users.id')->get();

            $arrData['ree_role_name']   = strtoupper(str_replace('_', ' ', $ree_id->name));
        }
        else{
            $arrData['get_forward_ree'] = array();
            $arrData['ree_role_name']   = null;

            if(empty($arrData['get_current_status']->status_id))
            {
                $arrData['get_current_status'] = new \stdClass();
                $arrData['get_current_status']->status_id = null;
            }
        }

        //remark and history
        $reeLogs  = $this->CommonController->getLogsOfREEDepartmentForNOC($applicationId);
        $coLogs   = $this->CommonController->getLogsOfCODepartmentForNOC($applicationId);

        return view('admin.co_department.forward_application_noc',compact('applicationData', 'arrData','noc_application','reeLogs','coLogs'));
    }

    public function forwardNOCforCCApplication(Request $request, $applicationId){

        $noc_application = $this->CommonController->getNocforCCApplication($applicationId);
        $noc_application->status = $this->CommonController->getCurrentStatusNocCC($applicationId);
        $applicationData = $this->CommonController->getForwardNocCCApplication($applicationId);

        $arrData['application_status'] = $this->CommonController->getCurrentLoggedInChildNocCC($applicationId);

        $arrData['get_current_status'] = $this->CommonController->getCurrentStatusNocCC($applicationId);
        $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
        $layout_ids = array_column($layout_id_array, 'layout_id');
        if(isset($arrData['get_current_status']->status_id) && $arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.NOC_Generation'))
        {
            $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();

            $arrData['get_forward_ree'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                ->whereIn('lu.layout_id', $layout_ids)
                ->where('role_id', $ree_id->id)->groupBy('users.id')->get();

            $arrData['ree_role_name']   = strtoupper(str_replace('_', ' ', $ree_id->name));
        }
        else{
            $arrData['get_forward_ree'] = array();
            $arrData['ree_role_name']   = null;

            if(empty($arrData['get_current_status']->status_id))
            {
                $arrData['get_current_status'] = new \stdClass();
                $arrData['get_current_status']->status_id = null;
            }
        }

        //remark and history
        $reeLogs  = $this->CommonController->getLogsOfREEDepartmentForNOCforCC($applicationId);
        $coLogs   = $this->CommonController->getLogsOfCODepartmentForNOCforCC($applicationId);

        return view('admin.co_department.forward_application_noc_cc',compact('applicationData', 'arrData','noc_application','reeLogs','coLogs'));
    }

    public function sendForwardNocApplication(Request $request){

        $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();
        $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
        $layout_ids = array_column($layout_id_array, 'layout_id');
        $ree = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
            ->whereIn('lu.layout_id', $layout_ids)
            ->where('role_id', $ree_id->id)->first();

        $this->CommonController->generateNOCforwardToREE($request);

        return redirect('/co_noc_applications')->with('success','Application send successfully.');
    }

    public function sendForwardNocforCCApplication(Request $request){

        $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();
        $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
        $layout_ids = array_column($layout_id_array, 'layout_id');
        $ree = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
            ->whereIn('lu.layout_id', $layout_ids)
            ->where('role_id', $ree_id->id)->first();

        $this->CommonController->generateNOCforCCforwardToREE($request);

        return redirect('/co_noc_applications')->with('success','Application send successfully.');
    }


    /**
     * Show the offer letter dashboard.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(){
        $role_id = session()->get('role_id');
        $user_id = Auth::id();
        $department_id = RtiDepartmentUser::where('user_id',Auth::id())->value('department_id');

        $conveyanceCommonController = new conveyanceCommonController();
        $conveyanceRoles     = $conveyanceCommonController->getConveyanceRoles();


        //Hearing Summary
        $hearing_data = Hearing::with(['hearingStatusLog.hearingStatus','hearingStatusLog' => function($q) use($department_id) {
            $q->where('department_id', $department_id);
        }, 'hearingSchedule.prePostSchedule', 'hearingForwardCase', 'hearingSendNoticeToAppellant', 'hearingUploadCaseJudgement'])
            ->whereHas('hearingStatusLog' ,function($q) use($department_id){
                $q->where('department_id', $department_id);
            })->get()->toArray();

        $hearing_count = count($hearing_data);

        //Offer Letter
        $ol_count = count($this->getApplicationData($role_id,$user_id));

        //Offer Letter Subordinate Pendency
        $ol_pending_data = $this->CommonController->getTotalCountsOfApplicationsPending();
        $ol_pending_count = $ol_pending_data['Total Number of Applications'];

        //Tripartite Agreement
        $tripartite_data = Null;
        $tripartite_dashboard = new TripartiteDashboardController();
        $tripartite_data = $tripartite_dashboard->getApplicationData($role_id,$user_id);
        $tripartite_count = count($tripartite_data);

        //Tripartite Agreement Subordinate Pendency
        $tripartite_pending_data = Null;
        $tripartite_pending_data  = $tripartite_dashboard->getDashboardHeaders()->getData();
        $tripartite_pending_count = $tripartite_pending_data['dashboardData_head']['Total Number of Applications'];

        //Offer Letter Revalidation
        $ol_reval_data = Null;
        $ol_reval_data = $this->getRevalApplicationData($role_id,$user_id);
        $ol_reval_count = count($ol_reval_data);

        //Offer Letter Revalidation Subordinate Pendency
        $ol_reval_pending_data = NUll;
        $CommonController = new CommonController();
        $ol_reval_pending_data = $CommonController->getTotalCountsOfRevalApplicationsPending();
        $ol_reval_pending_count = $ol_reval_pending_data['Total Number of Applications'];

        //Society Conveyance
        $conveyance_data = $conveyanceCommonController->getApplicationData($role_id,$user_id);
        $conveyance_count = count($conveyance_data);

        //Society Conveyance Subordinate Pendency
        $conveyance_pending_data = $conveyanceCommonController->getApplicationPendingAtDepartment();
        $conveyance_pending_count = $conveyance_pending_data['Total Number of Applications'];

        //NOC
        $nocModuleController = new SocietyNocController();
        $nocApplication = $nocModuleController->getApplicationListDashboard('REE');
        $noc_data = $nocApplication['app_data'];
        $noc_count = $noc_data['Total Number of Applications'][0];

        //NOC Subordinate Pendency
        $noc_pending_data = $nocApplication['pending_data'];
        $noc_pending_count = $noc_pending_data['Total Number of Applications'];

        //NOC (CC)
        $nocforCCModuleController = new SocietyNocforCCController();
        $nocforCCApplication = $nocforCCModuleController->getApplicationListDashboard('REE');
        $noc_cc_data = $nocforCCApplication['app_data'];
        $noc_cc_count = $noc_cc_data['Total Number of Applications'][0];

        //NOC (CC) Subordinate Pendency
        $noc_cc_pending_data = $nocforCCApplication['pending_data'];
        $noc_cc_pending_count = $noc_cc_pending_data['Total Number of Applications'];


        //Revision in Layout

        //Layout Approval

        //Layout Approval Pendency

        $today = Carbon::now()->format('d-m-Y');

        if(session()->get('role_name') == config('commanConfig.co_engineer') || session()->get('role_name') == config('commanConfig.co_pa')){
            $department_id = Department::where('department_name', config('commanConfig.hearing_department.co'))->value('id');
        }
        elseif(session()->get('role_name') == config('commanConfig.joint_co_pa') || session()->get('role_name') == config('commanConfig.joint_co')){
            $department_id = Department::where('department_name', config('commanConfig.hearing_department.joint_co'))->value('id');
        }

        $todaysHearing = Hearing::with(['hearingSchedule'=> function($q) use ($today){
            $q->where('preceding_date',$today);
        },'hearingPrePostSchedule'=> function($q) use ($today){
            $q->orderBy('id','desc')->limit(1);
        }])->where('department_id',$department_id)->get()->toArray();

        $todays_hearing_count = 0;
        $hearing= array();
        foreach($todaysHearing as $key => $todayHearing){
            if($todayHearing['hearing_schedule']){
                if($todayHearing['hearing_pre_post_schedule']){
                    if($todayHearing['hearing_pre_post_schedule']['0']['date'] == $today){
                        $todays_hearing_count += 1;
                        $hearing[] = $todayHearing;
                    }
                }
                else{
                    if($todayHearing['hearing_schedule']['preceding_date'] == $today)
                    {
                        $todays_hearing_count += 1;
                        $hearing[] = $todayHearing;
                    }
                }
            }
        }

        $todaysHearing = $hearing;

        return view('admin.co_department.dashboard',compact('todaysHearing','todays_hearing_count','conveyanceRoles','hearing_count','ol_count','ol_pending_count','conveyance_count','conveyance_pending_count','tripartite_count','tripartite_pending_count','ol_reval_count','ol_reval_pending_count',
            'noc_count','noc_cc_count','noc_pending_count','noc_cc_pending_count'));
    }

    /**
     * Show the offer letter dashboard using ajax.
     *
     * Author: Prajakta Sisale.
     *
     *  @return json response
     */
    public function ajaxdashboard(Request $request){
        if($request->ajax()){
            $role_id = session()->get('role_id');
            $user_id = Auth::id();

            if($request->module_name == 'Hearing Summary'){
                $department_id = RtiDepartmentUser::where('user_id',Auth::id())->value('department_id');

                $hearing_data = Hearing::with(['hearingStatusLog.hearingStatus','hearingStatusLog' => function($q) use($department_id) {
                    $q->where('department_id', $department_id);
                }, 'hearingSchedule.prePostSchedule', 'hearingForwardCase', 'hearingSendNoticeToAppellant', 'hearingUploadCaseJudgement'])
                    ->whereHas('hearingStatusLog' ,function($q) use($department_id){
                        $q->where('department_id', $department_id);
                    })->get()->toArray();

                $totalPendingHearing = $totalClosedHearing = $totalScheduledHearing = $totalUnderJudgementHearing = $totalForwardedHearing = 0;

                foreach ($hearing_data as $hearing){

                    $status = $hearing['hearing_status_log']['0']['hearing_status']['id'];

                    switch ( $status )
                    {
                        case config('commanConfig.hearingStatus.pending'): $totalPendingHearing += 1; break;
                        case config('commanConfig.hearingStatus.scheduled_meeting'): $totalScheduledHearing += 1; break;
                        case config('commanConfig.hearingStatus.case_under_judgement'): $totalUnderJudgementHearing += 1 ; break;
                        case config('commanConfig.hearingStatus.forwarded'): $totalForwardedHearing += 1; break;
                        case config('commanConfig.hearingStatus.case_closed'): $totalClosedHearing +=1 ; break;
                        default:
                            ; break;
                    }

                }

                $totalHearing = count($hearing_data);

                $hearingDashboardData = array();
                $hearingDashboardData['Total Number of Cases'][0] =  $totalHearing;
                $hearingDashboardData['Total Number of Cases'][1] =  '';
                $hearingDashboardData['Total Number of Pending Cases'][0] =  $totalPendingHearing;
                $hearingDashboardData['Total Number of Pending Cases'][1] =  '?office_date_from=&office_date_to=&hearing_status_id='.config('commanConfig.hearingStatus.pending');
                $hearingDashboardData['Total Number of Scheduled Cases'][0] = $totalScheduledHearing;
                $hearingDashboardData['Total Number of Scheduled Cases'][1] = '?office_date_from=&office_date_to=&hearing_status_id='.config('commanConfig.hearingStatus.scheduled_meeting');
                $hearingDashboardData['Total Number of Under Judgement Cases'][0] = $totalUnderJudgementHearing;
                $hearingDashboardData['Total Number of Under Judgement Cases'][1] = '?office_date_from=&office_date_to=&hearing_status_id='.config('commanConfig.hearingStatus.case_under_judgement');
                $hearingDashboardData['Total Number of Forwarded Cases'][0] = $totalForwardedHearing;
                $hearingDashboardData['Total Number of Forwarded Cases'][1] = '?office_date_from=&office_date_to=&hearing_status_id='.config('commanConfig.hearingStatus.forwarded');
                $hearingDashboardData['Total Number of Closed Cases'][0] = $totalClosedHearing;
                $hearingDashboardData['Total Number of Closed Cases'][1] = '?office_date_from=&office_date_to=&hearing_status_id='.config('commanConfig.hearingStatus.case_closed');

                return $hearingDashboardData;

            }

            if($request->module_name == 'Offer Letter'){
                $applicationData = $this->getApplicationData($role_id,$user_id);
                $statusCount = $this->getApplicationStatusCount($applicationData);
                $dashboardData = $this->getCODashboardData($statusCount);
                return $dashboardData;
            }

            if($request->module_name == "Offer Letter Department Pendency"){
                $dashboardData1 = $this->CommonController->getTotalCountsOfApplicationsPending();

                return $dashboardData1;
            }

            if($request->module_name == "Offer Letter Revalidation"){
                $revalApplicationData = $this->getRevalApplicationData($role_id,$user_id);
                $revalStatusCount = $this->getApplicationStatusCount($revalApplicationData);
                $revalDashboardData = $this->getCODashboardData($revalStatusCount);
                return $revalDashboardData;
            }

            if($request->module_name == "Offer Letter Revalidation Department Pendency") {
                $revalDashboardData1 = NULL;
                $revalDashboardData1 = $this->CommonController->getTotalCountsOfRevalApplicationsPending();
                return $revalDashboardData1;
            }

            if($request->module_name == 'NOC'){
                $nocModuleController = new SocietyNocController();
                $nocApplication = $nocModuleController->getApplicationListDashboard();

                return $nocApplication['app_data'];
            }

            if($request->module_name == 'NOC Department Pendency'){
                $nocModuleController = new SocietyNocController();
                $nocApplication = $nocModuleController->getApplicationListDashboard();

                return $nocApplication['pending_data'];
            }

            if($request->module_name == 'NOC (CC)'){
                $nocforCCModuleController = new SocietyNocforCCController();
                $nocforCCApplication = $nocforCCModuleController->getApplicationListDashboard();

                return $nocforCCApplication['app_data'];
            }

            if($request->module_name == 'NOC (CC) Department Pendency'){
                $nocforCCModuleController = new SocietyNocforCCController();
                $nocforCCApplication = $nocforCCModuleController->getApplicationListDashboard();

                return $nocforCCApplication['pending_data'];
            }

            if($request->module_name == 'Society Conveyance'){
                $conveyanceCommonController = new conveyanceCommonController();
                $conveyanceDashboard = $conveyanceCommonController->ConveyanceDashboard();

                return $conveyanceDashboard;
            }

            if($request->module_name == 'Society Conveyance Department Pendency'){
                $conveyanceCommonController = new conveyanceCommonController();

                $pendingApplications = $conveyanceCommonController->getApplicationPendingAtDepartment();

                return $pendingApplications;
            }


            if ($request->module_name == "Revision in Layout") {
                $architect_dashboard = new ArchitectLayoutDashboardController();
                $data['Total Number of Layouts']=$architect_dashboard->total_number_of_layouts();
                $data['Layouts in process']=$architect_dashboard->total_no_of_appln_for_revision_and_approval();
                $data['Layouts Approved by VP']=$architect_dashboard->approved_layouts();
                return $data;

            }

            if($request->module_name == 'Layout Approval'){
                $architect_dashboard = new ArchitectLayoutDashboardController();
                if (session()->get('role_name') == config('commanConfig.co_engineer')) {

                    $data['Total Number of Layouts for revision'] = $architect_dashboard->total_no_of_appln_for_revision();
                    $data['Application Pending'] = $architect_dashboard->pending_layout_before_layout_and_excel(1);
                    $data['Applications Sent to EE'] = $architect_dashboard->sent_to_ee();
                    $data['Applications Sent to REE'] = $architect_dashboard->sent_to_ree();
                    $data['Applications Sent to LM'] = $architect_dashboard->sent_to_lm();
                    $data['Applications Sent to EM'] = $architect_dashboard->sent_to_em();
                    $data['Applications Forwarded for Approval'] = $architect_dashboard->appln_sent_for_arroval();
                    $data['Approved Layouts'] = $architect_dashboard->approved_layouts();
                    return $data;
                }
            }

            if ($request->module_name == "Layout Approval Pendency") {
                $architect_dashboard = new ArchitectLayoutDashboardController();

                $ree = $architect_dashboard->pending_at_ree();
                $co  = $architect_dashboard->pending_at_co();
                $cap = $architect_dashboard->pending_at_cap();
                $sap = $architect_dashboard->pending_at_sap();
                $la  = $architect_dashboard->pending_at_la();
                $vp  = $architect_dashboard->pending_at_vp();

                $data['Applications Pending at REE']   = $ree;
                $data['Applications Pending at CO']    = $co;
                $data['Applications Pending at CAP']   = $cap;
                $data['Applications Pending at SAP']   = $sap;
                $data['Applications Pending at LA']    = $la;
                $data['Applications Pending at VP']    = $vp;
                return $data;

            }

            if($request->module_name == 'Tripartite Agreement'){

                $tripartite_dashboard = new TripartiteDashboardController();
                $data = $tripartite_dashboard->getDashboardHeaders()->getData();
                return $data['dashboardData'];

            }

            if($request->module_name == 'Tripartite Agreement Department Pendency'){
                $tripartite_dashboard = new TripartiteDashboardController();
                $data = $tripartite_dashboard->getDashboardHeaders()->getData();
                return $data['dashboardData_head'];
            }
        }
    }


    public function getApplicationData($role_id,$user_id){

        $new_offer_letter_master_ids = config('commanConfig.new_offer_letter_master_ids');

        $applicationData = OlApplication::with([
            'olApplicationStatus' => function ($q) use ($role_id,$user_id) {
                $q->where('user_id', $user_id)
                    ->where('role_id', $role_id)
                    ->where('society_flag', 0)
                    ->where('is_active',1)
                    ->orderBy('id', 'desc');
            }])
            ->whereHas('olApplicationStatus', function ($q) use ($role_id,$user_id) {
                $q->where('user_id', $user_id)
                    ->where('role_id', $role_id)
                    ->where('society_flag', 0)
                    ->where('is_active',1)
                    ->orderBy('id', 'desc');
            })->whereIn('application_master_id',$new_offer_letter_master_ids)->get()->toArray();

        return $applicationData;
    }

    // reval application data
    public function getRevalApplicationData($role_id,$user_id){

        $reval_application_type_ids= config('commanConfig.revalidation_master_ids');

        $applicationData = OlApplication::with([
            'olApplicationStatus' => function ($q) use ($role_id,$user_id) {
                $q->where('user_id', $user_id)
                    ->where('role_id', $role_id)
                    ->where('society_flag', 0)
                    ->where('is_active',1)
                    ->orderBy('id', 'desc');
            }])
            ->whereHas('olApplicationStatus', function ($q) use ($role_id,$user_id) {
                $q->where('user_id', $user_id)
                    ->where('role_id', $role_id)
                    ->where('society_flag', 0)
                    ->where('is_active',1)
                    ->orderBy('id', 'desc');
            })->whereIn('application_master_id',$reval_application_type_ids)->get()->toArray();

        return $applicationData;
    }

    public function getApplicationStatusCount($applicationData){
        $totalForwarded = $totalReverted = $totalPending = $totalInProcess = 0 ;

        $totalPendingForOfferLetterApproval = $approvedOfferLetterForwardedForIssueingToSociety = $totalOfferLetterApproved = 0;

//        dd($applicationData);
        foreach ($applicationData as $application){
//            echo "<pre>";
//            print_r($application);

            $phase =  $application['ol_application_status'][0]['phase'];
            $status = $application['ol_application_status'][0]['status_id'];
//            print_r($phase);
//            echo '=====';
            if($phase == 0){
                switch ( $status )
                {
                    case config('commanConfig.applicationStatus.in_process'): $totalPending += 1; break;
                    case config('commanConfig.applicationStatus.forwarded'): $totalForwarded += 1; break;
                    case config('commanConfig.applicationStatus.reverted'): $totalReverted += 1 ; break;
                    default:
                        ; break;
                }
            }
            if($phase == 1){
                switch ( $status )
                {
                    case config('commanConfig.applicationStatus.offer_letter_generation'): $totalPendingForOfferLetterApproval += 1; break;
                    case config('commanConfig.applicationStatus.offer_letter_approved'): $totalOfferLetterApproved += 1; break;
                    case config('commanConfig.applicationStatus.forwarded') /*&& $application['drafted_offer_letter']*/ : $approvedOfferLetterForwardedForIssueingToSociety += 1; break;
                    default:
                        ; break;
                }
            }
            if($phase == 2){
                switch ( $status )
                {
                    case config('commanConfig.applicationStatus.offer_letter_generation'): $totalPendingForOfferLetterApproval += 1; break;
                    case config('commanConfig.applicationStatus.offer_letter_approved'): $totalOfferLetterApproved += 1; break;
                    case config('commanConfig.applicationStatus.forwarded') /*&& $application['drafted_offer_letter']*/ : $approvedOfferLetterForwardedForIssueingToSociety += 1; break;
                    default:
                        ; break;
                }
            }
        }

        $totalApplication = count($applicationData);

        $count = ['totalPending' => $totalPending,
            'totalForwarded' => $totalForwarded,
            'totalReverted' => $totalReverted,
            'totalApplication' => $totalApplication,
            'totalPendingForOfferLetterApproval' => $totalPendingForOfferLetterApproval,
            'totalOfferLetterApproved' => $totalOfferLetterApproved,
            'totalApprovedOfferLetterForwardedForIssueingToSociety' => $approvedOfferLetterForwardedForIssueingToSociety

        ];
//        dd($count);
        return $count;

    }

    public function getCODashboardData($statusCount)
    {
//        dd($statusCount);
        $dashboardData = array();

        $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
        $dashboardData['Total Number of Applications'][1] = '';

        $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
        $dashboardData['Applications Pending'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.in_process');

        $dashboardData['Applications Sent for Revision'][0] = $statusCount['totalReverted'];
        $dashboardData['Applications Sent for Revision'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.reverted');

        $dashboardData['Applications Forwarded to CAP'][0] = $statusCount['totalForwarded'];
        $dashboardData['Applications Forwarded to CAP'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');
//                $dashboardData['Draft Offer Letter Generated'] = $statusCount['totalDraftOfferLetterGenereated'];

        $dashboardData['Offer Letters Pending for Approval'][0] = $statusCount['totalPendingForOfferLetterApproval'];
        $dashboardData['Offer Letters Pending for Approval'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.offer_letter_generation');
//                $dashboardData['Offer Letter Approved'] = $statusCount['offerLetterApproved'];

        $dashboardData['Offer Letters Approved'][0] = $statusCount['totalOfferLetterApproved'];
        $dashboardData['Offer Letters Approved'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.offer_letter_approved');;

        $dashboardData['Offer Letters Approved but Not Issued to Society'][0] = $statusCount['totalApprovedOfferLetterForwardedForIssueingToSociety'];
        $dashboardData['Offer Letters Approved but Not Issued to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

        return $dashboardData;
    }

    public function viewApplicationConsentOc(Request $request, $applicationId)
    {
        $oc_application = $this->CommonController->downloadConsentforOc($applicationId);
        $oc_application->folder = 'co_department';
        /*$oc_application->status = $this->comman->getCurrentStatus($applicationId);*/
        return view('admin.common.consent_for_oc', compact('oc_application'));
    }

    public function societyconsentOcDocuments(Request $request,$applicationId){

       $oc_application = $this->CommonController->getOcApplication($applicationId);
       $oc_application->model = OcApplication::with(['oc_application_master'])->where('id',$applicationId)->first();
       $comments = $this->CommonController->getOCApplicationComments($applicationId);
        $societyDocuments = $this->CommonController->getSocietyDocumentsforOC($applicationId);

       return view('admin.co_department.society_oc_documents',compact('oc_application','societyDocuments','comments'));
    }

    public function viewEMScrutinyOc($applicationId)
    {
        $oc_application = $this->CommonController->getOcApplication($applicationId);
        $oc_application->status = $this->CommonController->getCurrentStatusOc($applicationId);

        $application_master_id = OcApplication::where('society_id', $oc_application->eeApplicationSociety->id)->value('application_master_id');

        $arrData['society_detail'] = OcApplication::with('eeApplicationSociety')->where('id', $applicationId)->first();

        $arrData['get_last_status'] = OcApplicationStatusLog::where([
                'application_id' =>  $applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id')
            ])->orderBy('id', 'desc')->first();

        return view('admin.co_department.view_em_scrutiny', compact('arrData','oc_application'));
    }

    public function viewEEScrutinyOc($applicationId)
    {
        $oc_application = $this->CommonController->getOcApplication($applicationId);
        $oc_application->status = $this->CommonController->getCurrentStatusOc($applicationId);

        $application_master_id = OcApplication::where('society_id', $oc_application->eeApplicationSociety->id)->value('application_master_id');

        $arrData['society_detail'] = OcApplication::with('eeApplicationSociety')->where('id', $applicationId)->first();

        $arrData['scrutiny_questions_oc'] = OcSrutinyQuestionMaster::all();

        $arrData['scrutiny_answers_to_questions'] = OcEEScrutinyAnswer::where('application_id', $applicationId)->get()->keyBy('question_id')->toArray();

        $arrData['get_last_status'] = OcApplicationStatusLog::where([
                'application_id' =>  $applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id')
            ])->orderBy('id', 'desc')->first();

        return view('admin.co_department.ee_scrutiny_oc_ree', compact('arrData','oc_application'));
    }

    public function consentforOcREEnote(Request $request,$applicationId){

        $oc_application = $this->CommonController->getOcApplication($applicationId);
        $oc_application->status = $this->CommonController->getCurrentStatusOc($applicationId);

        $application_master_id = OcApplication::where('society_id', $oc_application->eeApplicationSociety->id)->value('application_master_id');

        $arrData['society_detail'] = OcApplication::with('eeApplicationSociety')->where('id', $applicationId)->first();

        $arrData['get_last_status'] = OcApplicationStatusLog::where([
                'application_id' =>  $applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id')
            ])->orderBy('id', 'desc')->first();

        return view('admin.co_department.ree_note_oc', compact('arrData','oc_application'));
    }

    public function approveConsentforOc(Request $request, $applicationId){

        $oc_application = $this->CommonController->getOcApplication($applicationId);
        $oc_application->status = $this->CommonController->getCurrentStatusOc($applicationId);
        // dd($ol_application->status->status_id);
        $ree_branch_head = Role::where('name',config('commanConfig.ree_branch_head'))->value('id');
        $co = Role::where('name',config('commanConfig.co_engineer'))->value('id');

        $applicationData = OcApplication::where('id',$applicationId)->first();

        $applicationData->ReeLog = OcApplicationStatusLog::where('application_id',$applicationId)->where('role_id',$ree_branch_head)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();

        $applicationData->coLog = OcApplicationStatusLog::where('application_id',$applicationId)->where('role_id',$co)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first(); 

        return view('admin.co_department.approve_consent_oc',compact('applicationData','oc_application'));
    }

    public function approveconsentOctoRee(Request $request){

        $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();
        $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
        $layout_ids = array_column($layout_id_array, 'layout_id');
        $ree = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
            ->whereIn('lu.layout_id', $layout_ids)
            ->where('role_id', $ree_id->id)->first(); 

            $this->CommonController->generateOCforwardToREE($request,$ree);
            return redirect('/co_consent_oc_applications')->with('success','Consent for OC has been approved successfully.');

        // $updateApplication = OlApplication::where('id',)           
    }

    public function forwardOcApplication(Request $request, $applicationId){
        
        $oc_application = $this->CommonController->getOcApplication($applicationId);
        $oc_application->status = $this->CommonController->getCurrentStatusOc($applicationId);
        $applicationData = $this->CommonController->getForwardOcApplication($applicationId);

        $arrData['application_status'] = $this->CommonController->getCurrentLoggedInChildOc($applicationId);

        $arrData['get_current_status'] = $this->CommonController->getCurrentStatusOc($applicationId);
        $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
        $layout_ids = array_column($layout_id_array, 'layout_id');
        if(isset($arrData['get_current_status']->status_id) && $arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.OC_Generation'))
        {
            $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();

            $arrData['get_forward_ree'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                ->whereIn('lu.layout_id', $layout_ids)
                ->where('role_id', $ree_id->id)->groupBy('users.id')->get();

            $arrData['ree_role_name']   = strtoupper(str_replace('_', ' ', $ree_id->name));
        }
        else{
            $arrData['get_forward_ree'] = array();
            $arrData['ree_role_name']   = null;

            if(empty($arrData['get_current_status']->status_id))
            {
                $arrData['get_current_status'] = new \stdClass();
                $arrData['get_current_status']->status_id = null;
            }
        }

        //remark and history
        $eelogs   = $this->CommonController->getLogsOfEEDepartmentforOc($applicationId);
        $emlogs   = $this->CommonController->getLogsOfEMforOc($applicationId);
        $reeLogs  = $this->CommonController->getLogsOfREEDepartmentForOc($applicationId); 
        $coLogs   = $this->CommonController->getLogsOfCODepartmentForOc($applicationId);   

        return view('admin.co_department.forward_application_oc',compact('applicationData', 'arrData','oc_application','reeLogs','coLogs' , 'emlogs' ,'eelogs'));
    }

    public function sendForwardOcApplication(Request $request){

        $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();
        $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
        $layout_ids = array_column($layout_id_array, 'layout_id');
        $ree = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
            ->whereIn('lu.layout_id', $layout_ids)
            ->where('role_id', $ree_id->id)->first(); 

        $this->CommonController->generateOCforwardToREE($request);

        return redirect('/co_consent_oc_applications')->with('success','Application send successfully.');
    }
}
