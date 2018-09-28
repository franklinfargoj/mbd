<?php

namespace App\Http\Controllers\VPDepartment;

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

class VPController extends Controller
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
            ['data' => 'society_name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'building_name','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'society_address','name' => 'eeApplicationSociety.address','title' => 'Address'],
            // ['data' => 'model','name' => 'model','title' => 'Model'],
             ['data' => 'Status','name' => 'status','title' => 'Status'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {

            $vp_application_data = $this->CommonController->listApplicationData($request);

            return $datatables->of($vp_application_data)
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++; return $i;
                })
                ->editColumn('society_name', function ($vp_application_data) {
                    return $vp_application_data->eeApplicationSociety->name;
                })
                ->editColumn('building_name', function ($vp_application_data) {
                    return $vp_application_data->eeApplicationSociety->building_no;
                })
                ->editColumn('society_address', function ($vp_application_data) {
                    return $vp_application_data->eeApplicationSociety->address;
                })                
                ->editColumn('date', function ($vp_application_data) {
                    return date(config('commanConfig.dateFormat', strtotime($vp_application_data->submitted_at)));
                })
                ->editColumn('actions', function ($vp_application_data) use($request){
                   return view('admin.vp_department.action', compact('vp_application_data', 'request'))->render();
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
            
            return view('admin.vp_department.index', compact('html','header_data','getData'));    
   	
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
       return view('admin.vp_department.society_EE_documents',compact('societyDocuments'));
    }

    // EE - Scrutiny & Remark page
    public function eeScrutinyRemark(Request $request,$applicationId){

        $eeScrutinyData = $this->CommonController->getEEScrutinyRemark($applicationId);
        return view('admin.vp_department.EE_Scrunity_Remark',compact('eeScrutinyData'));
    }

    // DyCE Scrutiny & Remark page
    public function dyceScrutinyRemark(Request $request,$applicationId){

        $applicationData = $this->CommonController->getDyceScrutinyRemark($applicationId);
        // dd($applicationData);
        return view('admin.vp_department.dyce_scrunity_remark',compact('applicationData'));
    }

    // Forward Application page
    public function forwardApplication(Request $request, $applicationId){

        $applicationData = $this->CommonController->getForwardApplication($applicationId);
        $arrData['application_status'] = $this->CommonController->getCurrentApplicationStatus($applicationId);
        $arrData['get_current_status'] = $this->CommonController->getCurrentStatus($applicationId);
        // REE Forward Application

        $ree_role_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();

        $arrData['get_forward_ree'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                                            ->where('lu.layout_id', session()->get('layout_id'))
                                            ->where('role_id', $ree_role_id->id)->get();

        $arrData['ree_role_name'] = strtoupper(str_replace('_', ' ', $ree_role_id->name));
    
        // remark and history
        $this->CommonController->getEEForwardRevertLog($applicationData,$applicationId);
        $this->CommonController->getDyceForwardRevertLog($applicationData,$applicationId);
        $this->CommonController->getREEForwardRevertLog($applicationData,$applicationId);

        return view('admin.vp_department.forward_application',compact('applicationData', 'arrData'));
    } 

    public function sendForwardApplication(Request $request){
//        $this->CommonController->forwardApplicationForm($request);
//        dd($request->all());
        if($request->check_status == 1) {
            $forward_application = [[
                'application_id' => $request->applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.forwarded'),
                'to_user_id' => $request->to_user_id,
                'to_role_id' => $request->to_role_id,
                'remark' => $request->remark,
                'created_at' => Carbon::now()
            ],

            [
                'application_id' => $request->applicationId,
                'user_id' => $request->to_user_id,
                'role_id' => $request->to_role_id,
                'status_id' => config('commanConfig.applicationStatus.offer_letter_generation'),
                'to_user_id' => NULL,
                'to_role_id' => NULL,
                'remark' => $request->remark,
                'created_at' => Carbon::now()
            ]
            ];

//            echo "in forward";
//            dd($forward_application);
            OlApplicationStatus::insert($forward_application);
            OlApplication::where('id', $request->applicationId)->update(['status_offer_letter' => config('commanConfig.applicationStatus.offer_letter_generation')]);
        }
        else{
            $revert_application = [
                [
                    'application_id' => $request->applicationId,
                    'user_id' => Auth::user()->id,
                    'role_id' => session()->get('role_id'),
                    'status_id' => config('commanConfig.applicationStatus.reverted'),
                    'to_user_id' => $request->user_id,
                    'to_role_id' => $request->role_id,
                    'remark' => $request->remark,
                    'created_at' => Carbon::now()
                ],

                [
                    'application_id' => $request->applicationId,
                    'user_id' => $request->to_child_id,
                    'role_id' => $request->to_role_id,
                    'status_id' => config('commanConfig.applicationStatus.in_process'),
                    'to_user_id' => NULL,
                    'to_role_id' => NULL,
                    'remark' => $request->remark,
                    'created_at' => Carbon::now()
                ]
            ];
            OlApplicationStatus::insert($revert_application);
        }
//            echo "in revert";
//            dd($revert_application);
        return redirect('/vp');
    }

    public function displayCAPNote(Request $request, $applicationId){

        $capNote = $this->CommonController->downloadCapNote($applicationId);
        return view('admin.vp_department.cap_note',compact('applicationId','capNote'));
    }                                    
}
