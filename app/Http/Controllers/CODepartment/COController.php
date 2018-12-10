<?php

namespace App\Http\Controllers\CODepartment;

use App\Role;
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
use App\Http\Controllers\conveyance\conveyanceCommonController;
use App\User;
use Config;
use Auth;
use DB;

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
            // ['data' => 'model','name' => 'model','title' => 'Model'],
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
                    $url = route('co.view_application', $co_application_data->id);
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

       $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);

        $societyDocuments = $this->CommonController->getSocietyEEDocuments($applicationId);
       return view('admin.co_department.society_EE_documents',compact('societyDocuments','ol_application'));
    }

    // EE - Scrutiny & Remark page
    public function eeScrutinyRemark(Request $request,$applicationId){
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);
        $eeScrutinyData = $this->CommonController->getEEScrutinyRemark($applicationId);
        return view('admin.co_department.EE_Scrunity_Remark',compact('eeScrutinyData','ol_application'));
    }

    // DyCE Scrutiny & Remark page
    public function dyceScrutinyRemark(Request $request,$applicationId){
         $ol_application = $this->CommonController->getOlApplication($applicationId);
         $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);
        $applicationData = $this->CommonController->getDyceScrutinyRemark($applicationId);
        return view('admin.co_department.dyce_scrunity_remark',compact('applicationData','ol_application'));
    }

    // Forward Application page
    public function forwardApplication(Request $request, $applicationId){
        
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);
        $applicationData = $this->CommonController->getForwardApplication($applicationId);
//        $arrData['application_status'] = $this->CommonController->getCurrentApplicationStatus($applicationId);

//        if(session()->get('role_name') != config('commanConfig.co_engineer'))
            $arrData['application_status'] = $this->CommonController->getCurrentLoggedInChild($applicationId);

        $arrData['get_current_status'] = $this->CommonController->getCurrentStatus($applicationId);

        // CAP Forward Application

        $cap_role_id = Role::where('name', '=', config('commanConfig.cap_engineer'))->first();

        if($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.offer_letter_generation'))
        {
            $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();

            $arrData['get_forward_ree'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                ->where('lu.layout_id', session()->get('layout_id'))
                ->where('role_id', $ree_id->id)->get();

            $arrData['ree_role_name']   = strtoupper(str_replace('_', ' ', $ree_id->name));
        }
        else
        {
            $arrData['get_forward_cap'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                ->where('lu.layout_id', session()->get('layout_id'))
                ->where('role_id', $cap_role_id->id)->get();
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

        return view('admin.co_department.forward_application',compact('applicationData', 'arrData','ol_application','eelogs','dyceLogs','reeLogs','coLogs','capLogs','vpLogs'));
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

        if($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.offer_letter_generation'))
        {
            $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();

            $arrData['get_forward_ree'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                ->where('lu.layout_id', session()->get('layout_id'))
                ->where('role_id', $ree_id->id)->get();

            $arrData['ree_role_name']   = strtoupper(str_replace('_', ' ', $ree_id->name));
        }
        else
        {
            $arrData['get_forward_cap'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                ->where('lu.layout_id', session()->get('layout_id'))
                ->where('role_id', $cap_role_id->id)->get();
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
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);
        $capNote = $this->CommonController->downloadCapNote($applicationId);

        return view('admin.co_department.cap_note',compact('capNote','ol_application'));
     } 

    public function approveOfferLetter(Request $request, $applicationId){

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

        $ree = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
            ->where('lu.layout_id', session()->get('layout_id'))
            ->where('role_id', $ree_id->id)->first(); 

            $this->CommonController->generateOfferLetterForwardToREE($request,$ree);
            return redirect('/co')->with('success','Approved Offer Letter successfully.');

        // $updateApplication = OlApplication::where('id',)           
    }

    public function approvedRevalOfferLetter(Request $request){

        $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();

        $ree = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
            ->where('lu.layout_id', session()->get('layout_id'))
            ->where('role_id', $ree_id->id)->first();

        $this->CommonController->generateOfferLetterForwardToREE($request,$ree);
        return redirect('/co_reval_applications')->with('success','Approved Offer Letter successfully.');

        // $updateApplication = OlApplication::where('id',)
    }

    public function viewApplication(Request $request, $applicationId){

        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);

        $ol_application = $this->CommonController->downloadOfferLetter($applicationId);
        $ol_application->folder = 'co_department';

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

       return view('admin.co_department.society_noc_documents',compact('noc_application','societyDocuments'));
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

        $ree = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
            ->where('lu.layout_id', session()->get('layout_id'))
            ->where('role_id', $ree_id->id)->first(); 

            $this->CommonController->generateNOCforwardToREE($request,$ree);
            return redirect('/co_noc_applications')->with('success','NOC has been approved successfully.');

        // $updateApplication = OlApplication::where('id',)           
    }

    public function approveNocforCCtoRee(Request $request){

        $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();

        $ree = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
            ->where('lu.layout_id', session()->get('layout_id'))
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

        if($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.NOC_Generation'))
        {
            $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();

            $arrData['get_forward_ree'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                ->where('lu.layout_id', session()->get('layout_id'))
                ->where('role_id', $ree_id->id)->get();

            $arrData['ree_role_name']   = strtoupper(str_replace('_', ' ', $ree_id->name));
        }
        else{
            $arrData['get_forward_ree'] = array();
            $arrData['ree_role_name']   = null;
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

        if($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.NOC_Generation'))
        {
            $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();

            $arrData['get_forward_ree'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                ->where('lu.layout_id', session()->get('layout_id'))
                ->where('role_id', $ree_id->id)->get();

            $arrData['ree_role_name']   = strtoupper(str_replace('_', ' ', $ree_id->name));
        }
        else{
            $arrData['get_forward_ree'] = array();
            $arrData['ree_role_name']   = null;
        }

        //remark and history
        $reeLogs  = $this->CommonController->getLogsOfREEDepartmentForNOCforCC($applicationId); 
        $coLogs   = $this->CommonController->getLogsOfCODepartmentForNOCforCC($applicationId); 

        return view('admin.co_department.forward_application_noc_cc',compact('applicationData', 'arrData','noc_application','reeLogs','coLogs'));
    }

    public function sendForwardNocApplication(Request $request){

        $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();

        $ree = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
            ->where('lu.layout_id', session()->get('layout_id'))
            ->where('role_id', $ree_id->id)->first(); 

        $this->CommonController->generateNOCforwardToREE($request);

        return redirect('/co_noc_applications')->with('success','Application send successfully.');
    }

    public function sendForwardNocforCCApplication(Request $request){

        $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();

        $ree = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
            ->where('lu.layout_id', session()->get('layout_id'))
            ->where('role_id', $ree_id->id)->first(); 

        $this->CommonController->generateNOCforCCforwardToREE($request);

        return redirect('/co_noc_applications')->with('success','Application send successfully.');
    }

    //co dashboard
    public function dashboard(){
        $role_id = session()->get('role_id');

        $user_id = Auth::id();

        $applicationData = $this->getApplicationData($role_id,$user_id);

        $statusCount = $this->getApplicationStatusCount($applicationData);

        $dashboardData = $this->getCODashboardData($statusCount);

        $dashboardData1 = $this->CommonController->getTotalCountsOfApplicationsPending();
        
        // conveyance dashboard
        $conveyanceCommonController = new conveyanceCommonController();
        $conveyanceDashboard = $conveyanceCommonController->ConveyanceDashboard();
        $conveyanceRoles     = $conveyanceCommonController->getConveyanceRoles();        

        return view('admin.co_department.dashboard',compact('dashboardData','dashboardData1','conveyanceDashboard','conveyanceRoles'));
    }

    public function getApplicationData($role_id,$user_id){
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
            })->get()->toArray();

        return $applicationData;
    }

    public function getApplicationStatusCount($applicationData){

        $totalForwarded = $totalReverted = $totalPending = $totalInProcess = 0 ;

        $totalPendingForOfferLetterApproval = $approvedOfferLetterForwardedForIssueingToSociety = $totalOfferLetterApproved = 0;

        foreach ($applicationData as $application){
//            echo "<pre>";
//            print_r($application);

            $phase =  $application['ol_application_status'][0]['phase'];
            $status = $application['ol_application_status'][0]['status_id'];
//            print_r($status);
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
//                dd($application);
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
//        dd('asdhash');
        $totalApplication = count($applicationData);

        $count = ['totalPending' => $totalPending,
            'totalForwarded' => $totalForwarded,
            'totalReverted' => $totalReverted,
            'totalApplication' => $totalApplication,
            'totalPendingForOfferLetterApproval' => $totalPendingForOfferLetterApproval,
            'totalOfferLetterApproved' => $totalOfferLetterApproved,
            'totalApprovedOfferLetterForwardedForIssueingToSociety' => $approvedOfferLetterForwardedForIssueingToSociety

        ];
        return $count;

    }

    public function getCODashboardData($statusCount)
    {
//        dd($statusCount);
        $dashboardData = array();

        $dashboardData['Total No of Application'] = $statusCount['totalApplication'];
        $dashboardData['Application Pending'] = $statusCount['totalPending'];
        $dashboardData['Application Sent for Revision'] = $statusCount['totalReverted'];
        $dashboardData['Application Forwarded to CAP'] = $statusCount['totalForwarded'];
//                $dashboardData['Draft Offer Letter Generated'] = $statusCount['totalDraftOfferLetterGenereated'];
        $dashboardData['Offer Letter Pending for Approval'] = $statusCount['totalPendingForOfferLetterApproval'];
//                $dashboardData['Offer Letter Approved'] = $statusCount['offerLetterApproved'];
        $dashboardData['Offer Letter Approved'] = $statusCount['totalOfferLetterApproved'];
        $dashboardData['Offer Letter Approved but not issued to Society'] = $statusCount['totalApprovedOfferLetterForwardedForIssueingToSociety'];

        return $dashboardData;
    }
}
