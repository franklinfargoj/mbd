<?php

namespace App\Http\Controllers\DYCEDepartment;

use App\Role;
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
use App\MasterLayout;
use App\User;
use Config;
use Auth;
use DB;
use Storage;
use Carbon\Carbon;
use App\LayoutUser;

class DYCEController extends Controller
{
    public function __construct()
    {
        $this->CommonController = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }	
    public function index(Request $request, Datatables $datatables){

            $dyce_application_data = $this->CommonController->listApplicationData($request);
        $getData = $request->all();

        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address', 'class' => 'datatable-address'],
            ['data' => 'model','name' => 'model','title' => 'Model'],
             ['data' => 'Status','name' => 'Status','title' => 'Status'],
            ['data' => 'radio','name' => 'radio','title' => 'Action','searchable' => false],
        ];
        if ($datatables->getRequest()->ajax()) {
 
            return $datatables->of($dyce_application_data)
                ->editColumn('radio', function ($dyce_application_data) {
                    $url = route('dyce.view_application', encrypt($dyce_application_data->id));
                    return '<div class="d-flex btn-icon-list"><a href="'.$url.'" onclick="geturl(this.value);" name="village_data_id" class="d-flex flex-column align-items-left"><span class="btn-icon btn-icon--view">
                        <img src="'. asset("img/view-icon.svg").'">
                    </span>View</span></a></div>';
                })
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++; return $i;
                })
                ->editColumn('eeApplicationSociety.name', function ($dyce_application_data) {
                    return $dyce_application_data->eeApplicationSociety->name;
                })
                ->editColumn('eeApplicationSociety.building_no', function ($dyce_application_data) {
                    return $dyce_application_data->eeApplicationSociety->building_no;
                })
                ->editColumn('eeApplicationSociety.address', function ($dyce_application_data) {
                    return "<span>".$dyce_application_data->eeApplicationSociety->address."</span>";
                })                
                ->editColumn('date', function ($dyce_application_data) {
                    return date(config('commanConfig.dateFormat'), strtotime($dyce_application_data->submitted_at));
                })
                // ->editColumn('actions', function ($dyce_application_data) use($request){
                //    return view('admin.DYCE_department.action', compact('dyce_application_data','request'))->render();
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

                ->rawColumns(['radio','society_name', 'Status', 'building_name', 'society_address','date','eeApplicationSociety.address'])
                ->make(true);
        }                                    

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
        return view('admin.DYCE_department.index', compact('html','header_data','getData'));    	
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [0, "asc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    } 

    // function used to DyCE Scrutiny & Remark page
    public function dyceScrutinyRemark(Request $request, $applicationId){

        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->log = $this->CommonController->getCurrentStatus($applicationId);
        $is_view = session()->get('role_name') == config('commanConfig.dyce_jr_user'); 
        $applicationData = $this->CommonController->getDyceScrutinyRemark($applicationId);
        $folder = $this->CommonController->getCurrentRoleFolderName();
        if (session()->get('role_name') == config('commanConfig.dyce_jr_user') && $ol_application->log->status_id == config('commanConfig.applicationStatus.in_process')){
            $blade = 'admin.DYCE_department.scrutiny_remark';
        }else{
            $blade = 'admin.common.view_dyce_scrutiny';
        }

        // dd($blade);

        return view($blade,compact('applicationData','is_view','ol_application','folder'));
    } 

    // function used to update details and upload documents by DYCE 
    public function store(Request $request){
        
        $folder_name = "dyceDocuments";
        $deletedDoc = explode("#",$request->deletedDoc);
        
        foreach($deletedDoc as $doc){
            if ($doc != "") {
                $delete = Storage::disk('ftp')->delete($folder_name.'/'.$doc);
            }
        }
        $applicationId = $request->applicationId;
        if (isset($request->documentId))
            $removeDocument = olSiteVisitDocuments::where('application_id',$applicationId)->whereNotIn('id',$request->documentId)->delete();
        else
            $removeDocument = olSiteVisitDocuments::where('application_id',$applicationId)->delete();

        $olApplication = OlApplication::find($applicationId);                           
        $olApplication->update([
            'demarkation_verification_comment' => $request->demarkation_comments,
            'date_of_site_visit'               => date('Y-m-d',strtotime($request->visit_date)),
            'site_visit_officers'              => implode(",",array_filter($request->officer_name)),
            'is_encrochment'                   => $request->encrochment,
            'encrochment_verification_comment' => $request->encrochment_comments
            ]);

        if ($request->file('document')){
            foreach ($request->file('document') as $file){

                $extension = $file->getClientOriginalExtension();
                $file_name = time()."_".$file->getClientoriginalName();

                if($extension == "pdf" || $extension == "png" || $extension == "jpeg" || $extension == "jpg"){

                    $path = $folder_name."/".$file_name;  
                    $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$file,$file_name);      

                    $fileData[] = array('document_path' => $path, 
                        'application_id' => $applicationId,
                        'user_id' => Auth::Id());
                    //             
                }else{
                    return back()->with('error','Invalid type of file uploaded.'); 
                }
            }
            $data = olSiteVisitDocuments::insert($fileData);
        }
        return back()->with('success','Data Submitted Successfully.'); 
    } 

    // society and EE documents
    // public function societyEEDocuments(Request $request,$applicationId){

    //     $id = '';
    //     $applicationId = decrypt($applicationId);
    //     $ol_application = $this->CommonController->getOlApplication($applicationId);
    //     $societyDocuments = $this->CommonController->getSocietyEEDocuments($applicationId);
        
    //     if ($societyDocuments){
    //         foreach($societyDocuments[0]->societyDocuments as $data){
    //             if ($data->documents_Name[0]->is_multiple == 1){

    //                 if ($id != $data->document_id){
    //                     $documents [] = $data;
    //                     $id = $data->document_id;
    //                 }

    //             }else{
    //                 $documents[] = $data;
    //             }
    //         }                    
    //     }

    //     $folder = $this->CommonControllergetCurrentRoleFolderName();

    //    return view('admin.common.view_society_ee_documents',compact('societyDocuments','ol_application','documents','folder')); 
    // }

    // EE - Scrutiny & Remark page
    // public function eeScrutinyRemark(Request $request,$applicationId){

    //     $applicationId = decrypt($applicationId);
    //     $ol_application = $this->CommonController->getOlApplication($applicationId);
    //     $eeScrutinyData = $this->CommonController->getEEScrutinyRemark($applicationId);
    //     return view('admin.DYCE_department.EE_Scrutiny_Remark',compact('eeScrutinyData','ol_application'));
    // } 

    // Forward Application page
    public function forwardApplication(Request $request, $applicationId){

        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $applicationData = $this->CommonController->getForwardApplication($applicationId);
        $parentData      = $this->CommonController->getForwardApplicationParentData();

        $arrData['parentData'] = $parentData['parentData'];
        $arrData['role_name']  = $parentData['role_name'];

//        $arrData['application_status'] = $this->CommonController->getCurrentApplicationStatus($applicationId);
        if(session()->get('role_name') != config('commanConfig.dyce_jr_user'))
            $arrData['application_status'] = $this->CommonController->getCurrentLoggedInChild($applicationId);

        $arrData['get_current_status'] = $this->CommonController->getCurrentStatus($applicationId);
        // REE Forward Application

        $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();

        $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
        $layout_ids = array_column($layout_id_array, 'layout_id');


        $arrData['get_forward_ree'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                                            ->whereIn('lu.layout_id', $layout_ids)
                                            ->where('role_id', $ree_id->id)->groupBy('users.id')->get();

        $arrData['ree_role_name']   = strtoupper(str_replace('_', ' ', $ree_id->name));

        //remark and history
        $remarkHistory = $this->CommonController->getRemarkHistory($applicationId);

        return view('admin.DYCE_department.forward_application',compact('applicationData', 'arrData','ol_application','remarkHistory'));
    }
 
    // forward or revert forward Application
    public function sendForwardApplication(Request $request){

        $this->CommonController->forwardApplicationForm($request);

        return redirect('/dyce')->with('success','Application send Successfully.');

    } 

    public function viewApplication(Request $request, $applicationId){

        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->downloadOfferLetter($applicationId);
        $ol_application->folder = 'DYCE_department';
        $ol_application->comments = $this->CommonController->getSocietyDocumentComments($ol_application->id);
        return view('admin.common.offer_letter', compact('ol_application'));
    }    
}


