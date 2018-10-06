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
use App\OlApplicationCalculationSheetDetails;
use App\OlSharingCalculationSheetDetail;
use App\OlChecklistScrutiny;
use App\OlDcrRateMaster;
use App\REENote;
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
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address'],
            // ['data' => 'model','name' => 'model','title' => 'Model'],
             ['data' => 'Status','name' => 'Status','title' => 'Status'],
            // ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];


        if ($datatables->getRequest()->ajax()) {

            $vp_application_data = $this->CommonController->listApplicationData($request);

            return $datatables->of($vp_application_data)
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++; return $i;
                })
                ->editColumn('radio', function ($vp_application_data) {
                    $url = route('vp.view_application', $vp_application_data->id);
                    return '<label class="m-radio m-radio--primary"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="village_data_id"><span></span></label>';
                })
                ->editColumn('eeApplicationSociety.name', function ($vp_application_data) {
                    return $vp_application_data->eeApplicationSociety->name;
                })
                ->editColumn('eeApplicationSociety.building_no', function ($vp_application_data) {
                    return $vp_application_data->eeApplicationSociety->building_no;
                })
                ->editColumn('eeApplicationSociety.address', function ($vp_application_data) {
                    return $vp_application_data->eeApplicationSociety->address;
                })                
                ->editColumn('date', function ($vp_application_data) {
                    return date(config('commanConfig.dateFormat'), strtotime($vp_application_data->submitted_at));
                })
                // ->editColumn('actions', function ($vp_application_data) use($request){
                //    return view('admin.vp_department.action', compact('vp_application_data', 'request'))->render();
                // })
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
                ->rawColumns(['radio','society_name', 'Status', 'building_name', 'society_address','date'])
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
       
       $ol_application = $this->CommonController->getOlApplication($applicationId);
        $societyDocuments = $this->CommonController->getSocietyEEDocuments($applicationId);
       return view('admin.vp_department.society_EE_documents',compact('ol_application','societyDocuments'));
    }

    // EE - Scrutiny & Remark page
    public function eeScrutinyRemark(Request $request,$applicationId){

        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $eeScrutinyData = $this->CommonController->getEEScrutinyRemark($applicationId);
        return view('admin.vp_department.EE_Scrunity_Remark',compact('ol_application','eeScrutinyData'));
    }

    // DyCE Scrutiny & Remark page
    public function dyceScrutinyRemark(Request $request,$applicationId){
        
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $applicationData = $this->CommonController->getDyceScrutinyRemark($applicationId);
        // dd($applicationData);
        return view('admin.vp_department.dyce_scrunity_remark',compact('ol_application','applicationData'));
    }

    // Forward Application page
    public function forwardApplication(Request $request, $applicationId){

        $ol_application = $this->CommonController->getOlApplication($applicationId);
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

        return view('admin.vp_department.forward_application',compact('applicationData', 'arrData','ol_application'));
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
                    'user_id' => $request->user_id,
                    'role_id' => $request->role_id,
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

        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $capNote = $this->CommonController->downloadCapNote($applicationId);
        return view('admin.vp_department.cap_note',compact('applicationId','capNote','ol_application'));
    } 

    public function viewApplication(Request $request, $applicationId){

        $ol_application = $this->CommonController->downloadOfferLetter($applicationId);
        $ol_application->folder = 'vp_department';

        return view('admin.common.offer_letter', compact('ol_application'));
    }

    public function showCalculationSheet(Request $request, $applicationId){
        
        $user = $this->CommonController->showCalculationSheet($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->folder = 'vp_department';
        $calculationSheetDetails = $user->calculationSheetDetails;
        $dcr_rates = $user->dcr_rates;
        $blade = $user->blade;
        $arrData['reeNote'] = $user->areeNote;
        // dd($blade);
        return view('admin.common.'.$blade,compact('calculationSheetDetails','applicationId','user','dcr_rates','arrData','ol_application'));         
    }                                        
}
