<?php

namespace App\Http\Controllers\conveyance;

use App\conveyance\scApplicationType;
use App\conveyance\SfApplication;
use App\conveyance\SfApplicationStatusLog;
use App\conveyance\SocietyConveyanceDocumentMaster;
use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\conveyance\SfScrtinyByEmMaster;
use App\conveyance\SfScrtinyByEmMasterDetail;
use Storage;

class FormationCommonController extends Controller
{
    public function __construct()
    {
        $this->list_num_of_records_per_page = config('commanConfig.list_num_of_records_per_page');
        $this->CommonController = new CommonController();
    }

    public function index(Request $request, Datatables $datatables)
    {

        $data = $this->listApplicationData($request);
        $typeId = scApplicationType::where('application_type', '=', 'Formation')->value('id');
        $columns = [
            ['data' => 'radio', 'name' => 'radio', 'title' => '', 'searchable' => false],
            ['data' => 'rownum', 'name' => 'rownum', 'title' => 'Sr No.', 'searchable' => false],
            ['data' => 'application_no', 'name' => 'application_no', 'title' => 'Application Number'],
            ['data' => 'date', 'name' => 'date', 'title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'societyApplication.name', 'name' => 'societyApplication.name', 'title' => 'Society Name'],
            ['data' => 'societyApplication.building_no', 'name' => 'societyApplication.building_no', 'title' => 'building No'],
            ['data' => 'societyApplication.address', 'name' => 'societyApplication.address', 'title' => 'Address', 'class' => 'datatable-address'],
            ['data' => 'Status', 'name' => 'Status', 'title' => 'Status'],
        ];

        // dd($data);
        if ($datatables->getRequest()->ajax()) {

            return $datatables->of($data)
                ->editColumn('rownum', function ($data) {
                    static $i = 0; $i++;return $i;
                })

                ->editColumn('radio', function ($data) {
                    $url = route('formation.view_application', ['id' => encrypt($data->id)]);
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" name="application_id" onclick="geturl(this.value);" value="' . $url . '" ><span></span></label>';
                })
                ->editColumn('application_no', function ($data) {

                    return $data->application_no;
                })
                ->editColumn('societyApplication.name', function ($data) {

                    return $data->societyApplication->name;
                })
                ->editColumn('societyApplication.building_no', function ($data) {

                    return $data->societyApplication->building_no;
                })
                ->editColumn('societyApplication.address', function ($data) {

                    return "<span>" . $data->societyApplication->address . "</span>";
                })
                ->editColumn('date', function ($data) {

                    return date(config('commanConfig.dateFormat'), strtotime($data->created_at));
                })

                ->editColumn('Status', function ($data) use ($request) {

                    $status = $data->sfApplicationLog->status_id;

                    if ($request->update_status) {
                        if ($request->update_status == $status) {
                            $config_array = array_flip(config('commanConfig.applicationStatus'));
                            $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                            return '<span class="m-badge m-badge--' . config('commanConfig.applicationStatusColor.' . $status) . ' m-badge--wide">' . $value . '</span>';
                        }
                    } else {
                        $config_array = array_flip(config('commanConfig.applicationStatus'));

                        $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                        return '<span class="m-badge m-badge--' . config('commanConfig.applicationStatusColor.' . $status) . ' m-badge--wide">' . $value . '</span>';
                    }

                })
                ->rawColumns(['radio', 'application_no', 'society_name', 'Status', 'building_name', 'societyApplication.address', 'date', 'typeId'])
                ->make(true);

        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.formation.index', compact('html', 'header_data', 'getData', 'folder_name'));

    }

    protected function getParameters()
    {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering' => 'isSorted',
            "order" => [1, "asc"],
            "pageLength" => $this->list_num_of_records_per_page,
        ];
    }

    // list all data
    public function listApplicationData($request)
    {

        $conveyanceId = scApplicationType::where('application_type', '=', config('commanConfig.applicationType.Formation'))->value('id');

        $applicationData = SfApplication::with(['applicationLayoutUser', 'societyApplication', 'sfApplicationLog' => function ($q) use ($conveyanceId) {
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'))
                ->where('application_master_id', $conveyanceId)
                ->orderBy('id', 'desc');
        }])

            ->whereHas('sfApplicationLog', function ($q) use ($conveyanceId) {
                $q->where('user_id', Auth::user()->id)
                    ->where('role_id', session()->get('role_id'))
                    ->where('application_master_id', $conveyanceId)
                    ->orderBy('id', 'desc');
            });

        $applicationData = $applicationData->orderBy('sf_applications.id', 'desc')->get();
        $listArray = [];

        if ($request->update_status) {

            foreach ($applicationData as $app_data) {
                if ($app_data->sfApplicationLog[0]->status_id == $request->update_status) {
                    $listArray[] = $app_data;
                }
            }
        } else {
            $listArray = $applicationData;
        }

        return $listArray;
    }

    public function ViewApplication(Request $request, $applicationId)
    {
        $disabled = 1;
        $id = decrypt($applicationId);
        $sf_documents = SocietyConveyanceDocumentMaster::with(['sf_document_status' => function ($q) use ($id) {
            return $q->where(['application_id' => $id]);
        }])->where(['application_type_id' => 3])->get();
        $sf_application = SfApplication::find($id);
        return view('admin.formation.view_application', compact('sf_application', 'sf_documents', 'disabled'));

        //return view('admin.conveyance.common.view_application',compact('data'));
    }

    //revert application child id
    public function getRevertApplicationChildData()
    {

        $role_id = Role::where('id', Auth::user()->role_id)->first();
        $result = json_decode($role_id->conveyance_child_id);
        $child = "";

        if ($result) {
            $child = User::with(['roles', 'LayoutUser' => function ($q) {
                $q->where('layout_id', session('layout_id'));
            }])
                ->whereHas('LayoutUser', function ($q) {
                    $q->where('layout_id', session('layout_id'));
                })
                ->whereIn('role_id', $result)->get();
        }
        //dd($result);
        return $child;
    }

    //forward Application parent Id

    public function getForwardApplicationParentData()
    {

        $role_id = Role::where('id', Auth::user()->role_id)->first();
        $result = json_decode($role_id->conveyance_parent_id);
        //dd($result);
        $parent = "";

        if ($result) {
            $parent = User::with(['roles', 'LayoutUser' => function ($q) {
                $q->where('layout_id', session('layout_id'));
            }])
                ->whereHas('LayoutUser', function ($q) {
                    $q->where('layout_id', session('layout_id'));
                })
                ->whereHas('roles', function ($q) {
                    $q->where('name', config('commanConfig.estate_manager'));
                })
                ->whereIn('role_id', $result)->get();
        }
        //dd($parent);
        return $parent;
    }

    // get current status of application
    public function getCurrentStatus($application_id, $masterId)
    {
        $current_status = SfApplicationStatusLog::where('application_id', $application_id)
            ->where('application_master_id', $masterId)
            ->where('user_id', Auth::user()->id)
            ->where('role_id', session()->get('role_id'))
            ->orderBy('id', 'desc')->first();

        return $current_status;
    }

    public function getForwardApplicationData($applicationId)
    {
        // dd($applicationId);
        $data = SfApplication::with('societyApplication')
            ->where('id', $applicationId)->first();
        $data->society_role_id = Role::where('name', config('commanConfig.society_offer_letter'))->value('id');
        $data->status = $this->getCurrentStatus($applicationId, $data->sc_application_master_id);
        $data->parent = $this->getForwardApplicationParentData();
        $data->child = $this->getRevertApplicationChildData();
        return $data;
    }

    // get logs of DYCO dept
    public function getLogsOfDYCODepartment($applicationId, $masterId)
    {

        $roles = array(config('commanConfig.dycdo_engineer'), config('commanConfig.dyco_engineer'));

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $dycoRoles = Role::whereIn('name', $roles)->pluck('id');
        $dycologs = SfApplicationStatusLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)
            ->where('application_master_id', $masterId)->whereIn('role_id', $dycoRoles)->whereIn('status_id', $status)->get();

        return $dycologs;
    }

    // get logs of Society
    public function getLogsOfSociety($applicationId, $masterId)
    {
        $roles = array(config('commanConfig.society_offer_letter'));

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $societyRoles = Role::whereIn('name', $roles)->pluck('id');
        $ocietylogs = SfApplicationStatusLog::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('society_flag', '=', '1')->where('application_master_id', $masterId)->whereIn('role_id', $societyRoles)->whereIn('status_id', $status)->get();
        // dd($societyRoles);

        return $ocietylogs;
    }

    public function commonForward(Request $request, $applicationId)
    {
        $applicationId = decrypt($applicationId);
        $sf_application = SfApplication::with('societyApplication')->where('id', $applicationId)->first();
        $data = $this->getForwardApplicationData($applicationId);
        //dd($data);
        //$data->folder  = $this->getCurrentRoleFolderName();
        $societyLogs = $this->getLogsOfSociety($applicationId, $data->sc_application_master_id);
        $dycoLogs = $this->getLogsOfDYCODepartment($applicationId, $data->sc_application_master_id);
        //$eelogs        = $this->getLogsOfEEDepartment($applicationId,$data->sc_application_master_id);
        //$Architectlogs = $this->getLogsOfArchitectDepartment($applicationId,$data->sc_application_master_id);
        //$cologs        = $this->getLogsOfCODepartment($applicationId,$data->sc_application_master_id);

        //$this->getAllSaleLeaseAgreement($data,$applicationId,$data->sc_application_master_id);

        // if (session()->get('role_name') == config('commanConfig.co_engineer') || session()->get('role_name') == config('commanConfig.joint_co')){
        //   $route = 'admin.conveyance.co_department.forward_application';

        // } elseif (session()->get('role_name') == config('commanConfig.dyco_engineer') || session()->get('role_name') == config('commanConfig.dycdo_engineer')){

        //        $route = 'admin.conveyance.dyco_department.forward_application';
        //   }
        //   else{
        //   $route = 'admin.conveyance.common.forward_application';
        // }

        return view('admin.formation.forward_application', compact('data', 'societyLogs', 'dycoLogs', 'sf_application'));
    }

    public function saveForwardApplication(Request $request)
    {
        //return $request->all();
        $forwardData = $this->forwardApplication($request);
        return redirect()->route('get_sf_applications.index')->with('success', 'Application sent successfully.');
    }

    // forward and revert application
    public function forwardApplication(Request $request)
    {

        $Scstatus = "";
        $data = SfApplication::where('id', $request->applicationId)->first();
        $applicationStatus = $data->application_status;
        $masterId = $data->sc_application_master_id;

        $dycdoId = Role::where('name', config('commanConfig.dycdo_engineer'))->value('id');
        $dycoId = Role::where('name', config('commanConfig.dyco_engineer'))->value('id');

        if ($request->check_status == 1) {
            $status = config('commanConfig.applicationStatus.forwarded');
        } else {
            $status = config('commanConfig.applicationStatus.reverted');
        }
        $Tostatus = config('commanConfig.applicationStatus.in_process');

        $application = [[
            'application_id' => $request->applicationId,
            'user_id' => Auth::user()->id,
            'role_id' => session()->get('role_id'),
            'status_id' => $status,
            'to_user_id' => $request->to_user_id,
            'to_role_id' => $request->to_role_id,
            'remark' => $request->remark,
            'application_master_id' => $masterId,
            'created_at' => Carbon::now(),
        ],
            [
                'application_id' => $request->applicationId,
                'user_id' => $request->to_user_id,
                'role_id' => $request->to_role_id,
                'status_id' => $Tostatus,
                'to_user_id' => null,
                'to_role_id' => null,
                'remark' => $request->remark,
                'application_master_id' => $masterId,
                'created_at' => Carbon::now(),
            ],
        ];

        SfApplicationStatusLog::insert($application);
        if ($Scstatus != "") {
            SfApplication::where('id', $request->applicationId)->where('sc_application_master_id', $masterId)
                ->update(['application_status' => $Tostatus]);
        }
    }

    public function get_em_checklist_and_remarks_for_sf($application_id,$user_id)
    {
        $SfScrtinyByEmMaster = SfScrtinyByEmMaster::all();
        foreach ($SfScrtinyByEmMaster as $data) {
            $detail = SfScrtinyByEmMasterDetail::where(['sf_application' => $application_id, 'sf_scrutiny_master_by_em_id' => $data->id])->first();
            if ($detail) {

            } else {
                $enter_detail = new SfScrtinyByEmMasterDetail;
                $enter_detail->user_id = $user_id;
                $enter_detail->sf_application = $application_id;
                $enter_detail->sf_scrutiny_master_by_em_id = $data->id;
                $enter_detail->save();
            }
        }

        $final_detail = SfScrtinyByEmMasterDetail::with(['question'])->where([ 'sf_application' => $application_id])->get();
        return $final_detail;

    }

    public function get_sf_em_srutiny_and_remark($id)
    {
        $read_only=0;
        $applicationId = decrypt($id);
        $SfScrtinyByEmMaster=SfScrtinyByEmMaster::all();
        $sf_application = SfApplication::with('societyApplication')->where('id', $applicationId)->first();
        $check_list_and_remarks=$this->get_em_checklist_and_remarks_for_sf($sf_application->id, auth()->user()->id);
        //dd($check_list_and_remarks);
        $data = $this->getForwardApplicationData($applicationId);
        return view('admin.formation.scrutiny_and_remark',compact('check_list_and_remarks','sf_application','data','SfScrtinyByEmMaster','read_only'));
    }

    public function upload_em_scrutiny_document_for_sf(Request $request)
    {
        $file = $request->file('file');
        if ($file->getClientMimeType() == 'application/pdf') {
            $extension = $request->file('file')->getClientOriginalExtension();
            $dir = 'architect_layout_details';
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $storage = Storage::disk('ftp')->putFileAs($dir, $request->file('file'), $filename);
            if ($storage) {
                $enter_detail = SfScrtinyByEmMasterDetail::where(['sf_application' => $request->application_id, 'id' => $request->report_id, 'user_id' => auth()->user()->id])->first();
                if ($enter_detail) {
                    $enter_detail->file = $storage;
                    $enter_detail->save();

                } 

                $response_array = array(
                    'status' => true,
                    'file_path' => config('commanConfig.storage_server') . "/" . $storage,
                    'doc_id' => $enter_detail->id,
                );
            } else {
                $response_array = array(
                    'status' => false,
                    'message' => 'file not uploaded',
                );
            }

        } else {
            $response_array = array(
                'status' => false,
                'message' => 'PDF file is required',
            );
        }

        return response()->json($response_array);
    }

    public function post_sf_em_srutiny_and_remark(Request $request)
    {
        $lables = $request->lable;
        $remarks = $request->remark;
        $j = 0;
        foreach ($request->report_id as $report_ids) {
            $detail = SfScrtinyByEmMasterDetail::where(['id' => $report_ids, 'sf_application' => $request->sf_application])->first();
            if ($detail) {
                if (isset($lables[$j])) {
                    if ($lables[$j] == 1) {
                        $detail->label1 = 1;
                        $detail->label2 = 0;
                    }
                    if ($lables[$j] == 2) {
                        $detail->label1 = 0;
                        $detail->label2 = 1;
                    }
                }

                $detail->remark = isset($remarks[$j]) ? $remarks[$j] : '';
                $detail->save();

            }
            $j++;
        }
        return back()->withSuccess('data added successfully!!!');
    }

    public function get_no_dues_certificate($id)
    {
        $content="";
        $applicationId = decrypt($id);
        $sf_application = SfApplication::with('societyApplication')->where('id', $applicationId)->first();
        //dd($sf_application->societyApplication->building_no);
        if($sf_application->no_dues_certificate_in_text!="")
        {
            
            $content=Storage::disk('ftp')->get($sf_application->no_dues_certificate_in_text);
        }
        
        return view('admin.formation.no_dues_certificate',compact('content','sf_application'));
    }

    public function post_no_dues_certificate(Request $request)
    {
        $id = $request->applicationId;
        $content = str_replace('_', "", $_POST['ckeditorText']);
        $folder_name = 'society_formation_no_dues';

        $header_file = view('admin.REE_department.offer_letter_header');        
        $footer_file = view('admin.REE_department.offer_letter_footer');
        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadHTML($header_file.$content.$footer_file);

        $fileName = time().'no_dues_certificate_'.$id.'.pdf';
        $filePath = $folder_name."/".$fileName;

        if (!(Storage::disk('ftp')->has($folder_name))) {            
            Storage::disk('ftp')->makeDirectory($folder_name, $mode = 0777, true, true);
        } 
        Storage::disk('ftp')->put($filePath, $pdf->output());
        $file = $pdf->output();

        //text offer letter

        $folder_name1 = 'sf_no_dues_certificate';

        if (!(Storage::disk('ftp')->has($folder_name1))) {            
            Storage::disk('ftp')->makeDirectory($folder_name1, $mode = 0777, true, true);
        }        
        $file_nm =  time()."no_dues_certificate_in_text_".$id.'.txt';
        $filePath1 = $folder_name1."/".$file_nm;

        Storage::disk('ftp')->put($filePath1, $content);

        SfApplication::where('id',$request->applicationId)->update(["no_due_certificate" => $filePath, "no_dues_certificate_in_text" => $filePath1]);
         // OlApplication::where('id',$request->applicationId)->update(["drafted_offer_letter" => $filePath]);
        return redirect()->route('formation.em_srutiny_and_remark',['id'=>encrypt($request->applicationId)])->withSuccess('Certificate Generated!');
    }

    public function society_documents($id)
    {
        $disabled = 1;
        $id = decrypt($id);
        $sf_documents = SocietyConveyanceDocumentMaster::with(['sf_document_status' => function ($q) use ($id) {
            return $q->where(['application_id' => $id]);
        }])->where(['application_type_id' => 3])->get();
        $sf_application = SfApplication::find($id);
        return view('admin.formation.society_documents', compact('sf_application', 'sf_documents', 'disabled'));

    }

    public function send_no_due_to_society(Request $request)
    {
        $application_id=decrypt($request->application_id);
        $sf_application = SfApplication::find($application_id);
        $sf_application->no_dues_certificate_sent_to_society=1;
        $sf_application->save();
        if($sf_application)
        {
            return back()->withSuccess('sent to society');
        }else
        {
            return back()->withError('Something went wrong!!!');
        }
        //dd($sf_application);
    }
}
