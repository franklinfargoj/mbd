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
use App\User;
use Config;
use Auth;
use DB;
use Carbon\Carbon;

class DYCEController extends Controller
{
    public function __construct()
    {
        $this->CommonController = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }	
    public function index(Request $request, Datatables $datatables){

            $dyce_application_data = $this->CommonController->listApplicationData($request);
            // dd($dyce_application_data);
        $getData = $request->all();

        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date'],
            ['data' => 'society_name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'building_name','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'society_address','name' => 'eeApplicationSociety.address','title' => 'Address'],
            // ['data' => 'model','name' => 'model','title' => 'Model'],
             ['data' => 'Status','name' => 'status','title' => 'Status'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];
        if ($datatables->getRequest()->ajax()) {


            return $datatables->of($dyce_application_data)
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++; return $i;
                })
                ->editColumn('society_name', function ($dyce_application_data) {
                    return $dyce_application_data->eeApplicationSociety->name;
                })
                ->editColumn('building_name', function ($dyce_application_data) {
                    return $dyce_application_data->eeApplicationSociety->building_no;
                })
                ->editColumn('society_address', function ($dyce_application_data) {
                    return $dyce_application_data->eeApplicationSociety->address;
                })                
                ->editColumn('date', function ($dyce_application_data) {
                    return date(config('commanConfig.dateFormat', strtotime($dyce_application_data->submitted_at)));
                })
                ->editColumn('actions', function ($dyce_application_data) use($request){
                   return view('admin.DYCE_department.action', compact('dyce_application_data','request'))->render();
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
        return view('admin.DYCE_department.index', compact('html','header_data','getData'));    	
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

    // function used to DyCE Scrutiny & Remark page
    public function dyceScrutinyRemark(Request $request, $applicationId){

        $is_view = session()->get('role_name') == config('commanConfig.dyce_jr_user'); 

        $applicationData = $this->CommonController->getDyceScrutinyRemark($applicationId);
       
        return view('admin.DYCE_department.scrutiny_remark',compact('applicationData','is_view'));
    } 

    // function used to update details and upload documents by DYCE 
    public function store(Request $request){
       
        $applicationId = $request->applicationId;
        if (isset($request->documentId))
            $removeDocument = olSiteVisitDocuments::where('application_id',$applicationId)->whereNotIn('id',$request->documentId)->delete();
        else
            $removeDocument = olSiteVisitDocuments::where('application_id',$applicationId)->delete();

        $olApplication = OlApplication::find($applicationId);                           
        $olApplication->update([
            'demarkation_verification_comment' => $request->demarkation_comments,
            'date_of_site_visit'               => $request->visit_date,
            'site_visit_officers'              => implode(",",$request->officer_name),
            'is_encrochment'                   => $request->encrochment,
            'encrochment_verification_comment' => $request->encrochment_comments
            ]);

        $uploadPath      = '/uploads/dyceDocuments';
        $destinationPath = public_path($uploadPath);

        if ($request->file('document')){
            foreach ($request->file('document') as $file){

                $file_name = time().$file->getFileName().'.'.$file->getClientOriginalExtension();

                if($file->move($destinationPath, $file_name))
                {
                    $fileData[] = array('document_path' => $uploadPath.'/'.$file_name, 
                        'application_id' => $applicationId,
                        'user_id' => Auth::Id());
                }
            }
            $data = olSiteVisitDocuments::insert($fileData);            
        }
        return back(); 
    } 

    // society and EE documents
    public function societyEEDocuments(Request $request,$applicationId){

        $societyDocuments = $this->CommonController->getSocietyEEDocuments($applicationId);
       return view('admin.DYCE_department.society_EE_documents',compact('societyDocuments')); 
    }

    // EE - Scrutiny & Remark page
    public function eeScrutinyRemark(Request $request,$applicationId){

        $eeScrutinyData = $this->CommonController->getEEScrutinyRemark($applicationId);
        return view('admin.DYCE_department.EE_Scrutiny_Remark',compact('eeScrutinyData'));
    }

    // Forward Application page
    public function forwardApplication(Request $request, $applicationId){

        $applicationData = $this->CommonController->getForwardApplication($applicationId);

        $parentData = $this->CommonController->getForwardApplicationParentData();
        $arrData['parentData'] = $parentData['parentData'];
        $arrData['role_name'] = $parentData['role_name'];

        $arrData['application_status'] = $this->CommonController->getCurrentApplicationStatus($applicationId);
        $arrData['get_current_status'] = $this->CommonController->getCurrentStatus($applicationId);
        // REE Forward Application

        $ree_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();
        $arrData['get_forward_co'] = User::where('role_id', $ree_id->id)->get();
        $arrData['co_role_name'] = strtoupper(str_replace('_', ' ', $ree_id->name));

        $this->CommonController->getEEForwardRevertLog($applicationData,$applicationId);
        // dd($applicationData);
        return view('admin.DYCE_department.forward_application',compact('applicationData', 'arrData'));
    }

    // forward or revert forward Application
    public function sendForwardApplication(Request $request){

        $this->CommonController->forwardApplicationForm($request);

        return redirect('/dyce');

    }
}


