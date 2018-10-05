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
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address'],
            // ['data' => 'model','name' => 'model','title' => 'Model'],
             ['data' => 'Status','name' => 'Status','title' => 'Status'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {

            $cap_application_data = $this->CommonController->listApplicationData($request);

            return $datatables->of($cap_application_data)
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++; return $i;
                })
                ->editColumn('eeApplicationSociety.name', function ($cap_application_data) {
                    return $cap_application_data->eeApplicationSociety->name;
                })
                ->editColumn('eeApplicationSociety.building_no', function ($cap_application_data) {
                    return $cap_application_data->eeApplicationSociety->building_no;
                })
                ->editColumn('eeApplicationSociety.address', function ($cap_application_data) {
                    return $cap_application_data->eeApplicationSociety->address;
                })                
                ->editColumn('date', function ($cap_application_data) {
                    return date(config('commanConfig.dateFormat'), strtotime($cap_application_data->submitted_at));
                })
                ->editColumn('actions', function ($cap_application_data) use($request){
                   return view('admin.cap_department.action', compact('cap_application_data', 'request'))->render();
                })
                ->editColumn('Status', function ($listArray) use ($request) {
                    $status = $listArray->olApplicationStatusForLoginListing[0]->status_id;

                    if($request->update_status)
                    {
                        if($request->update_status == $status){
                            $config_array = array_flip(config('commanConfig.applicationStatus'));
                            $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                            return $value;
                        }
                    }else{
                        $config_array = array_flip(config('commanConfig.applicationStatus'));
                        $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                        return $value;
                    }

                })
                ->rawColumns(['society_name', 'Status', 'building_name', 'society_address','date','actions'])
                ->make(true);
        }        
    	        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
            
            return view('admin.cap_department.index', compact('html','header_data','getData'));    
   	
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"      => [7, "desc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    } 

    // society and EE documents
    public function societyEEDocuments(Request $request,$applicationId){
       
        $societyDocuments = $this->CommonController->getSocietyEEDocuments($applicationId);
       return view('admin.cap_department.society_EE_documents',compact('societyDocuments'));
    }

    // EE - Scrutiny & Remark page
    public function eeScrutinyRemark(Request $request,$applicationId){

        $eeScrutinyData = $this->CommonController->getEEScrutinyRemark($applicationId);
        return view('admin.cap_department.EE_Scrunity_Remark',compact('eeScrutinyData'));
    } 

    // DyCE Scrutiny & Remark page
    public function dyceScrutinyRemark(Request $request,$applicationId){

        $applicationData = $this->CommonController->getDyceScrutinyRemark($applicationId);
        return view('admin.cap_department.dyce_scrunity_remark',compact('applicationData'));
    } 

    // Forward Application page
    public function forwardApplication(Request $request, $applicationId){

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

        return view('admin.cap_department.forward_application',compact('applicationData', 'arrData'));
    }

    public function sendForwardApplication(Request $request){
        $this->CommonController->forwardApplicationForm($request);
        return redirect('/cap');
    }

    public function displayCAPNote(Request $request, $applicationId){

        $capNote = $this->CommonController->downloadCapNote($applicationId);
        return view('admin.cap_department.cap_notes',compact('applicationId','capNote'));
    }  

    public function uploadCAPNote(Request $request){
        
        $applicationId   = $request->applicationId;
        $uploadPath      = '/uploads/cap_notes';
        $destinationPath = public_path($uploadPath);

        if ($request->file('cap_note')){

            $file = $request->file('cap_note');
            $file_name = time().'cap_note'.'.'.$file->getClientOriginalExtension();
            $extension = $file->getClientOriginalExtension();
            $folder_name = "cap_notes";

            if ($extension == "pdf"){
                $path = config('commanConfig.storage_server').'/'.$folder_name.'/'.$file_name;

                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('cap_note'),$file_name);

                    $fileData[] = array('document_path' => $path, 
                                       'application_id' => $applicationId,
                                        'user_id'       => Auth::Id());

                $data = OlCapNotes::insert($fileData);   
                return redirect('/cap')->with('success','CAP Note uploaded successfully.');                         
            } else {
                return back()->with('pdf_error', 'Invalid type of file uploaded (only pdf allowed).');
            }

        }        
    }  
}
