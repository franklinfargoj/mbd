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
            ['data' => 'date','name' => 'date','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address', 'class' => 'datatable-address'],
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
                    $url = route('vp.view_application', encrypt($vp_application_data->id));
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="village_data_id"><span></span></label>';
                })
                ->editColumn('eeApplicationSociety.name', function ($vp_application_data) {
                    return $vp_application_data->eeApplicationSociety->name;
                })
                ->editColumn('eeApplicationSociety.building_no', function ($vp_application_data) {
                    return $vp_application_data->eeApplicationSociety->building_no;
                })
                ->editColumn('eeApplicationSociety.address', function ($vp_application_data) {
                    return "<span>".$vp_application_data->eeApplicationSociety->address."</span>";
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
            
            return view('admin.vp_department.index', compact('html','header_data','getData'));    
   	
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
                    $url = route('vp.view_reval_application', $ree_application_data->id);
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

        return view('admin.vp_department.reval_applications', compact('html','header_data','getData'));
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
        $societyDocuments = $this->CommonController->getSocietyEEDocuments($applicationId);
       return view('admin.vp_department.society_EE_documents',compact('ol_application','societyDocuments'));
    }

    // EE - Scrutiny & Remark page
    public function eeScrutinyRemark(Request $request,$applicationId){

        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $eeScrutinyData = $this->CommonController->getEEScrutinyRemark($applicationId);
        return view('admin.vp_department.EE_Scrunity_Remark',compact('ol_application','eeScrutinyData'));
    }

    // DyCE Scrutiny & Remark page
    public function dyceScrutinyRemark(Request $request,$applicationId){
        
        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $applicationData = $this->CommonController->getDyceScrutinyRemark($applicationId);
        // dd($applicationData);
        return view('admin.vp_department.dyce_scrunity_remark',compact('ol_application','applicationData'));
    }

    // Forward Application page
    public function forwardApplication(Request $request, $applicationId){

        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $applicationData = $this->CommonController->getForwardApplication($applicationId);
        $arrData['application_status'] = $this->CommonController->getCurrentApplicationStatus($applicationId);
        $arrData['get_current_status'] = $this->CommonController->getCurrentStatus($applicationId);
        
        //cap reverted
        $cap_role_id = Role::where('name', '=', config('commanConfig.cap_engineer'))->first();

        $arrData['get_reverted_cap'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                                            ->where('lu.layout_id', session()->get('layout_id'))
                                            ->where('role_id', $cap_role_id->id)->get();

        $arrData['cap_role_name'] = strtoupper(str_replace('_', ' ', $cap_role_id->name));

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

        //remark and history
        $eelogs   = $this->CommonController->getLogsOfEEDepartment($applicationId);
        $dyceLogs = $this->CommonController->getLogsOfDYCEDepartment($applicationId);
        $reeLogs  = $this->CommonController->getLogsOfREEDepartment($applicationId); 
        $coLogs   = $this->CommonController->getLogsOfCODepartment($applicationId); 
        $capLogs  = $this->CommonController->getLogsOfCAPDepartment($applicationId); 
        $vpLogs   = $this->CommonController->getLogsOfVPDepartment($applicationId);            

        return view('admin.vp_department.forward_application',compact('applicationData', 'arrData','ol_application','eelogs','dyceLogs','reeLogs','coLogs','capLogs','vpLogs'));
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
                'is_active' => 1,
                'phase' => 1,
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
                'is_active' => 1,
                'phase' => 1,
                'created_at' => Carbon::now()
            ]
            ];

            //Code added by Prajakta >>start
            DB::beginTransaction();
            try {
                OlApplicationStatus::where('application_id',$request->applicationId)
                    ->whereIn('user_id', [Auth::user()->id,$request->to_user_id ])
                    ->update(array('is_active' => 0));

                OlApplicationStatus::insert($forward_application);

                OlApplication::where('id', $request->applicationId)->update(['status_offer_letter' => config('commanConfig.applicationStatus.offer_letter_generation')]);

                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
            }
            //Code added by Prajakta >>end

        }
        else{
            $revert_application = [
                [
                    'application_id' => $request->applicationId,
                    'user_id' => Auth::user()->id,
                    'role_id' => session()->get('role_id'),
                    'status_id' => config('commanConfig.applicationStatus.reverted'),
                    'to_user_id' => $request->to_child_id,
                    'to_role_id' => $request->to_role_id,
                    'remark' => $request->remark,
                    'is_active' => 1,
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
                    'is_active' => 1,
                    'created_at' => Carbon::now()
                ]
            ];

            //Code added by Prajakta >>start
            DB::beginTransaction();
            try {
                OlApplicationStatus::where('application_id',$request->applicationId)
                    ->whereIn('user_id', [Auth::user()->id,$request->to_child_id ])
                    ->update(array('is_active' => 0));

                OlApplicationStatus::insert($revert_application);

                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
            }
            //Code added by Prajakta >>end


        }
//            echo "in revert";
//            dd($revert_application);
        return redirect('/vp')->with('success','Application send successfully.');
    }

    public function displayCAPNote(Request $request, $applicationId){

        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $capNote = $this->CommonController->downloadCapNote($applicationId);
        return view('admin.vp_department.cap_note',compact('applicationId','capNote','ol_application'));
    } 

    public function viewApplication(Request $request, $applicationId){

        $applicationId = decrypt($applicationId);
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


    public function viewRevalApplication(Request $request, $applicationId){

        $ol_application = $this->CommonController->downloadOfferLetter($applicationId);
        $ol_application->folder = 'vp_department';

        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();

        return view('admin.common.reval_offer_letter', compact('ol_application'));
    }

    public function societyRevalDocuments(Request $request,$applicationId){

        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $societyDocument = $this->CommonController->getRevalSocietyREEDocuments($applicationId);

        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();

        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);
        return view('admin.vp_department.society_reval_documents', compact('societyDocument','ol_application'));
    }

    public function showRevalCalculationSheet(Request $request, $applicationId){

        $user = $this->CommonController->showCalculationSheet($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->folder = 'vp_department';
        $folder = 'vp_department';
        $calculationSheetDetails = $user->calculationSheetDetails;
        $dcr_rates = $user->dcr_rates;
        $blade = $user->blade;
        $arrData['reeNote'] = $user->areeNote;
        // dd($blade);
        return view('admin.common.'.$blade,compact('calculationSheetDetails','applicationId','user','dcr_rates','arrData','ol_application','folder'));
    }


    public function forwardRevalApplication(Request $request, $applicationId)
    {
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $applicationData = $this->CommonController->getForwardApplication($applicationId);
        //$arrData['application_status'] = $this->CommonController->getCurrentApplicationStatus($applicationId);
        //$arrData['get_current_status'] = $this->CommonController->getCurrentStatus($applicationId);

        $arrData['application_status'] = $this->CommonController->getCurrentLoggedInChild($applicationId);
        $arrData['get_current_status'] = $this->CommonController->getCurrentStatus($applicationId);

        $parentData = $this->CommonController->getForwardApplicationParentData();
        $arrData['parentData'] = $parentData['parentData'];
        $arrData['role_name'] = $parentData['role_name'];


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

        //remark and history
        $eelogs   = $this->CommonController->getLogsOfEEDepartment($applicationId);
        $dyceLogs = $this->CommonController->getLogsOfDYCEDepartment($applicationId);
        $reeLogs  = $this->CommonController->getLogsOfREEDepartment($applicationId);
        $coLogs   = $this->CommonController->getLogsOfCODepartment($applicationId);
        $capLogs  = $this->CommonController->getLogsOfCAPDepartment($applicationId);
        $vpLogs   = $this->CommonController->getLogsOfVPDepartment($applicationId);

        return view('admin.vp_department.forward_reval_application',compact('applicationData', 'arrData','ol_application','eelogs','dyceLogs','reeLogs','coLogs','capLogs','vpLogs','parentData'));
    }

    public function sendForwardRevalApplication(Request $request){
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
                'is_active' => 1,
                'phase' => 1,
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
                    'is_active' => 1,
                    'phase' => 1,
                    'created_at' => Carbon::now()
                ]
            ];

//            echo "in forward";
//            dd($forward_application);

            //Code added by Prajakta >>start
            DB::beginTransaction();
            try {
                OlApplicationStatus::where('application_id',$request->applicationId)
                    ->whereIn('user_id', [Auth::user()->id,$request->to_user_id ])
                    ->update(array('is_active' => 0));

                OlApplicationStatus::insert($forward_application);

                OlApplication::where('id', $request->applicationId)->update(['status_offer_letter' => config('commanConfig.applicationStatus.offer_letter_generation')]);

                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
            }
            //Code added by Prajakta >>end



        }
        else{
            $revert_application = [
                [
                    'application_id' => $request->applicationId,
                    'user_id' => Auth::user()->id,
                    'role_id' => session()->get('role_id'),
                    'status_id' => config('commanConfig.applicationStatus.reverted'),
                    'to_user_id' => $request->to_child_id,
                    'to_role_id' => $request->to_role_id,
                    'remark' => $request->remark,
                    'is_active' => 1,
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
                    'is_active' => 1,
                    'created_at' => Carbon::now()
                ]
            ];

            //Code added by Prajakta >>start
            DB::beginTransaction();
            try {
                OlApplicationStatus::where('application_id',$request->applicationId)
                    ->whereIn('user_id', [Auth::user()->id,$request->to_child_id ])
                    ->update(array('is_active' => 0));

                OlApplicationStatus::insert($revert_application);

                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
            }

        }
//            echo "in revert";
//            dd($revert_application);
        return redirect('/vp_reval_applications')->with('success','Application send successfully.');
    }
}
