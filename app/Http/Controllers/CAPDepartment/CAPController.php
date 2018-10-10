<?php

namespace App\Http\Controllers\CAPDepartment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\CommonController;
use Yajra\DataTables\DataTables;
use App\olSiteVisitDocuments;
use App\OlApplication;
use App\SocietyOfferLetter;
use App\OlSocietyDocumentsStatus;
use App\OlConsentVerificationDetails;
use App\OlDemarcationVerificationDetails;
use App\OlTitBitVerificationDetails;
use App\OlRelocationVerificationDetails;
use App\OlChecklistScrutiny;
use App\OlApplicationStatus;
use App\OlCapNotes;
use App\User;
use App\Role;
use Config;
use Auth;
use DB;
use Carbon\Carbon;

class CAPController extends Controller
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

            $cap_application_data = $this->CommonController->listApplicationData($request);

            return $datatables->of($cap_application_data)
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++; return $i;
                })
                ->editColumn('radio', function ($cap_application_data) {

                    $url = route('cap.view_application', $cap_application_data->id);
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="village_data_id"><span></span></label>';
                })
                ->editColumn('eeApplicationSociety.name', function ($cap_application_data) {
                    return $cap_application_data->eeApplicationSociety->name;
                })
                ->editColumn('eeApplicationSociety.building_no', function ($cap_application_data) {
                    return $cap_application_data->eeApplicationSociety->building_no;
                })
                ->editColumn('eeApplicationSociety.address', function ($cap_application_data) {
                    return "<span>".$cap_application_data->eeApplicationSociety->address."</span>";
                })                
                ->editColumn('date', function ($cap_application_data) {
                    return date(config('commanConfig.dateFormat'), strtotime($cap_application_data->submitted_at));
                })
                // ->editColumn('actions', function ($cap_application_data) use($request){
                //    return view('admin.cap_department.action', compact('cap_application_data', 'request'))->render();
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
                ->rawColumns(['radio','society_name', 'Status', 'building_name', 'society_address','date','eeApplicationSociety.address'])
                ->make(true);
        }        
    	        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
            
            return view('admin.cap_department.index', compact('html','header_data','getData','cap_application_data'));    
   	
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
        $societyDocuments = $this->CommonController->getSocietyEEDocuments($applicationId);
       return view('admin.cap_department.society_EE_documents',compact('societyDocuments','ol_application'));
    }

    // EE - Scrutiny & Remark page
    public function eeScrutinyRemark(Request $request,$applicationId){

        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $eeScrutinyData = $this->CommonController->getEEScrutinyRemark($applicationId);
        return view('admin.cap_department.EE_Scrunity_Remark',compact('eeScrutinyData','ol_application','ol_application'));
    } 

    // DyCE Scrutiny & Remark page
    public function dyceScrutinyRemark(Request $request,$applicationId){

        $applicationData = $this->CommonController->getDyceScrutinyRemark($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        return view('admin.cap_department.dyce_scrunity_remark',compact('applicationData','ol_application'));
    } 

    // Forward Application page
    public function forwardApplication(Request $request, $applicationId){

        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $applicationData = $this->CommonController->getForwardApplication($applicationId);
        $arrData['application_status'] = $this->CommonController->getCurrentApplicationStatus($applicationId);
        $arrData['get_current_status'] = $this->CommonController->getCurrentStatus($applicationId);

        // VP Forward Application

        $vp_role_id = Role::where('name', '=', config('commanConfig.vp_engineer'))->first();
        $arrData['get_forward_vp'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                                            ->where('lu.layout_id', session()->get('layout_id'))
                                            ->where('role_id', $vp_role_id->id)->get();

        $arrData['vp_role_name'] = strtoupper(str_replace('_', ' ', $vp_role_id->name));
    
        // remark and history
        $this->CommonController->getEEForwardRevertLog($applicationData,$applicationId);
        $this->CommonController->getDyceForwardRevertLog($applicationData,$applicationId);
        $this->CommonController->getREEForwardRevertLog($applicationData,$applicationId);

        // dd($applicationData);

        //remark and history
        $eelogs = $this->CommonController->getLogsOfEEDepartment($applicationId);
        $dyceLogs = $this->CommonController->getLogsOfDYCEDepartment($applicationId);  
        $reeLogs = $this->CommonController->getLogsOfREEDepartment($applicationId);          

        return view('admin.cap_department.forward_application',compact('applicationData', 'arrData','ol_application','eelogs','dyceLogs','reeLogs'));
    }

    public function sendForwardApplication(Request $request){
        $this->CommonController->forwardApplicationForm($request);
        return redirect('/cap')->with('success','Application send successfully.');
    }

    public function displayCAPNote(Request $request, $applicationId){

        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);
        // dd($ol_application->status->status_id);
        $capNote = $this->CommonController->downloadCapNote($applicationId);
        return view('admin.cap_department.cap_notes',compact('applicationId','capNote','ol_application'));
    }  

    public function uploadCAPNote(Request $request){
        
        $applicationId   = $request->applicationId;

        if ($request->file('cap_note')){

            $file = $request->file('cap_note');
            $file_name = time().'cap_note'.'.'.$file->getClientOriginalExtension();
            $extension = $file->getClientOriginalExtension();
            $folder_name = "cap_notes";

            if ($extension == "pdf"){
                $path = $folder_name.'/'.$file_name;

                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('cap_note'),$file_name);

                    $fileData[] = array('document_path' => $path, 
                                       'application_id' => $applicationId,
                                        'user_id'       => Auth::Id());

                $data = OlCapNotes::insert($fileData);
                   
                return back()->with('success','CAP Note uploaded successfully.');                         
            } else {
                return back()->with('pdf_error', 'Invalid type of file uploaded (only pdf allowed).');
            }

        }        
    }

    public function viewApplication(Request $request, $applicationId){
        $ol_application = $this->CommonController->downloadOfferLetter($applicationId);
        $ol_application->folder = 'cap_department';

        return view('admin.common.offer_letter', compact('ol_application'));
    }

    public function showCalculationSheet(Request $request, $applicationId){
        
        $user = $this->CommonController->showCalculationSheet($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->folder = 'cap_department';
        $calculationSheetDetails = $user->calculationSheetDetails;
        $dcr_rates = $user->dcr_rates;
        $blade = $user->blade;
        $arrData['reeNote'] = $user->areeNote;
        // dd($blade);
        return view('admin.common.'.$blade,compact('calculationSheetDetails','applicationId','user','dcr_rates','arrData','ol_application'));         
    }         
}
