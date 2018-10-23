<?php

namespace App\Http\Controllers\CODepartment;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\CommonController;
use Yajra\DataTables\DataTables;
use App\olSiteVisitDocuments;
use App\OlApplication;
use Carbon\Carbon;
use App\SocietyOfferLetter;
use App\OlSocietyDocumentsStatus;
use App\OlConsentVerificationDetails;
use App\OlDemarcationVerificationDetails;
use App\OlTitBitVerificationDetails;
use App\OlRelocationVerificationDetails;
use App\OlChecklistScrutiny;
use App\OlApplicationStatus;
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

    public function approvedOfferLetter(Request $request){

        $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();

        $ree = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
            ->where('lu.layout_id', session()->get('layout_id'))
            ->where('role_id', $ree_id->id)->first(); 

            $this->CommonController->generateOfferLetterForwardToREE($request,$ree);
            return redirect('/co')->with('success','Approved Offer Letter successfully.');

        // $updateApplication = OlApplication::where('id',)           
    }

    public function viewApplication(Request $request, $applicationId){

        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);

        $ol_application = $this->CommonController->downloadOfferLetter($applicationId);
        $ol_application->folder = 'co_department';

        return view('admin.common.offer_letter', compact('ol_application'));
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
}
