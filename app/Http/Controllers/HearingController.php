<?php

namespace App\Http\Controllers;

use App\ApplicationType;
use App\Board;
use App\DeletedHearing;
use App\Department;
use App\ForwardCase;
use App\Hearing;
use App\HearingSchedule;
use App\HearingStatus;
use App\HearingStatusLog;
use App\Http\Requests\hearing\EditHearingRequest;
use App\PrePostSchedule;
use App\User;
use Carbon\Carbon;
use DB;
use App\Http\Requests\hearing\AddHearingRequest;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\conveyance\conveyanceCommonController;
use App\Http\Controllers\conveyance\renewalCommonController;
use App\RtiDepartmentUser;
use Config;

class HearingController extends Controller
{
    public $header_data = array(
        'menu' => 'Hearing',
        'menu_url' => 'hearing'
    );

    protected $list_num_of_records_per_page;

    public function __construct()
    {
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    public function print_data(Request $request)
    {
        $getData = [
            'office_date_from' =>session()->get('office_date_from'),
            'office_date_to' =>session()->get('office_date_to'),
            'hearing_status_id' =>session()->get('hearing_status_id')

        ];

        $department_id = RtiDepartmentUser::where('user_id',Auth::id())->value('department_id');

        $hearing_data = Hearing::with(['hearingStatusLog.hearingStatus','hearingStatusLog' => function($q) use($department_id) {
            $q->where('department_id', $department_id);
        }, 'hearingSchedule.prePostSchedule', 'hearingForwardCase', 'hearingSendNoticeToAppellant', 'hearingUploadCaseJudgement'])
            ->whereHas('hearingStatusLog' ,function($q) use($department_id){
                $q->where('department_id', $department_id);
            });

        //     $hearing_data = Hearing::with(['hearingStatusLog.hearingStatus','hearingStatusLog' => function($q){
        //     $q->where('user_id', Auth::user()->id)
        //         ->where('role_id', session()->get('role_id'));
        // }, 'hearingSchedule.prePostSchedule', 'hearingForwardCase', 'hearingSendNoticeToAppellant', 'hearingUploadCaseJudgement'])
        //     ->whereHas('hearingStatusLog' ,function($q){
        //         $q->where('user_id', Auth::user()->id)
        //             ->where('role_id', session()->get('role_id'));
        //     });
//            dd($hearing_data);

        if($getData['office_date_from'])
        {
            $hearing_data = $hearing_data->whereDate('office_date', '>=', date('Y-m-d', strtotime($request->office_date_from)));
        }

        if($getData['office_date_to'])
        {

            $hearing_data = $hearing_data->whereDate('office_date', '<=', date('Y-m-d', strtotime($request->office_date_to)));
        }
//            if($request->hearing_status_id){
//                $hearing_data = $hearing_data->whereDate('office_date', '<=', date('Y-m-d', strtotime($request->office_date_to)));
//
//            }

        $hearing_data = $hearing_data->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').', case_year, hearing.id as id, case_number, department_id,  office_date, applicant_name')->orderBy('id', 'desc');

        $hearing_data = $hearing_data->select()->get();

//        dd($hearing_data);
        $listArray = [];

        if($getData['hearing_status_id'])
        {
            foreach ($hearing_data as $hearing)
            {
                if($hearing->hearingStatusLog[0]->hearing_status_id == $getData['hearing_status_id'])
                {
                    $listArray[] = $hearing;
                }
            }
        }
        else
        {
            $listArray =  $hearing_data;
        }

        $hearing_data = $listArray;
//        dd($hearing_data);
        return view('admin.hearing.print_data',compact('hearing_data'));    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Datatables $datatables)
    {
        $header_data = $this->header_data;
        $getData = $request->all();
        $hearing_status = HearingStatus::all();
        $department_id = RtiDepartmentUser::where('user_id',Auth::id())->value('department_id');

        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'case_number','name' => 'case_number','title' => 'Case Number'],
            ['data' => 'case_year','name' => 'case_year','title' => 'Case Year'],
            ['data' => 'office_date','name' => 'office_date','title' => 'Case Reg Date'],
            ['data' => 'applicant_name', 'name' => 'applicant_name', 'title' => 'Apellent Name'],
//            ['data' => 'hearingDepartment','name' => 'hearingDepartment.department_name','title' => 'Department'],
            ['data' => 'Status','name' => 'hearing_status_id','title' => 'Status'],
            ['data' => 'radio','name' => 'radio','title' => 'Action','searchable' => false],

            // ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

                // dd($hearing_data);

        if($request->excel)
        {
            $getData = [
                'office_date_from' =>session()->get('office_date_from'),
                'office_date_to' =>session()->get('office_date_to'),
                'hearing_status_id' =>session()->get('hearing_status_id')

            ];

            $department_id = RtiDepartmentUser::where('user_id',Auth::id())->value('department_id');

            $hearing_data = Hearing::with(['hearingStatusLog.hearingStatus','hearingStatusLog' => function($q) use($department_id) {
                $q->where('department_id', $department_id);
            }, 'hearingSchedule.prePostSchedule', 'hearingForwardCase', 'hearingSendNoticeToAppellant', 'hearingUploadCaseJudgement'])
                ->whereHas('hearingStatusLog' ,function($q) use($department_id){
                    $q->where('department_id', $department_id);
                });

            if($getData['office_date_from'])
            {
                $hearing_data = $hearing_data->whereDate('office_date', '>=', date('Y-m-d', strtotime($request->office_date_from)));
            }

            if($getData['office_date_to'])
            {

                $hearing_data = $hearing_data->whereDate('office_date', '<=', date('Y-m-d', strtotime($request->office_date_to)));
            }
//            if($request->hearing_status_id){
//                $hearing_data = $hearing_data->whereDate('office_date', '<=', date('Y-m-d', strtotime($request->office_date_to)));
//
//            }

            $hearing_data = $hearing_data->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').', case_year, hearing.id as id, case_number, department_id,  office_date, applicant_name')->orderBy('id', 'desc');

            $hearing_data = $hearing_data->select()->get();

            $listArray = [];

            if($getData['hearing_status_id'])
            {
                foreach ($hearing_data as $hearing)
                {
                    if($hearing->hearingStatusLog[0]->hearing_status_id == $getData['hearing_status_id'])
                    {
                        $listArray[] = $hearing;
                    }
                }
            }
            else
            {
                $listArray =  $hearing_data;
            }

            $hearing_data = $listArray;

            $hearing_excel_data = [];

            $i = 1;

            foreach ($hearing_data as $hearing)
            {
//                $config_array = array_flip(config('commanConfig.hearingStatus'));
//                $current_status = $hearing['hearingStatusLog'][0]['hearing_status_id'];

                $status = $hearing['hearingStatusLog'][0]['hearing_status_id'];

                if($getData['hearing_status_id'])
                {
                    if($getData['hearing_status_id'] == $status){
                        $config_array = array_flip(config('commanConfig.hearingStatus'));
                        $value = ucwords(str_replace('_', ' ', $config_array[$status]));

                        if($value == 'Scheduled Meeting' && count($hearing['hearingSchedule']['prePostSchedule']) > 0) {
                            if ($hearing['hearingSchedule']['prePostSchedule'][0]['pre_post_status'] == 1) {
                                $value = $value . ' Preponed';
                            }else{
                                $value = $value . ' Postponed';
                            }
                        }
                    }
                }else{
                    $config_array = array_flip(config('commanConfig.hearingStatus'));
                    $value = ucwords(str_replace('_', ' ', $config_array[$status]));

                    if($value == 'Scheduled Meeting' && count($hearing['hearingSchedule']['prePostSchedule']) > 0) {
                        if ($hearing['hearingSchedule']['prePostSchedule'][0]['pre_post_status'] == 1) {
                            $value = $value . ' Preponed';
                        }else{
                            $value = $value . ' Postponed';
                        }
                    }
                }

                $hearing_excel_data[] = [
                    'Sr. No.' => $i,
                    'Case No.' => $hearing['case_number'],
                    'Case Year' => $hearing['case_year'],
                    'Case Reg Date' => date(config('commanConfig.dateFormat'), strtotime($hearing['office_date'])),
                    'Apellent Name' => $hearing['applicant_name'],
                    'Appelent Mobile No.' => $hearing['applicant_mobile_no'],
                    'Status' => $value,
                ];
                $i++;
            }

            return Excel::create('hearing_'.date('Y_m_d_H_i_s'), function($excel) use($hearing_excel_data){

                $excel->sheet('mySheet', function($sheet) use($hearing_excel_data)
                {
                    $sheet->fromArray($hearing_excel_data);
                });
            })->download('csv');
        }

        if ($datatables->getRequest()->ajax()) {

//            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));

            $hearing_data = Hearing::with(['hearingStatusLog.hearingStatus','hearingStatusLog' => function($q) use($department_id) {
                $q->where('department_id', $department_id);
            }, 'hearingSchedule.prePostSchedule', 'hearingForwardCase', 'hearingSendNoticeToAppellant', 'hearingUploadCaseJudgement'])
                ->whereHas('hearingStatusLog' ,function($q) use($department_id){
                    $q->where('department_id', $department_id);
                });

            //     $hearing_data = Hearing::with(['hearingStatusLog.hearingStatus','hearingStatusLog' => function($q){
            //     $q->where('user_id', Auth::user()->id)
            //         ->where('role_id', session()->get('role_id'));
            // }, 'hearingSchedule.prePostSchedule', 'hearingForwardCase', 'hearingSendNoticeToAppellant', 'hearingUploadCaseJudgement'])
            //     ->whereHas('hearingStatusLog' ,function($q){
            //         $q->where('user_id', Auth::user()->id)
            //             ->where('role_id', session()->get('role_id'));
            //     });
//            dd($hearing_data);

            if($request->office_date_from)
            {
                session()->put('office_date_from',$request->office_date_from);
                $hearing_data = $hearing_data->whereDate('office_date', '>=', date('Y-m-d', strtotime($request->office_date_from)));
            }else{
                session()->forget('office_date_from');
            }

            if($request->office_date_to)
            {
                session()->put('office_date_from',$request->office_date_to);
                $hearing_data = $hearing_data->whereDate('office_date', '<=', date('Y-m-d', strtotime($request->office_date_to)));
            }else{
                session()->forget('office_date_from');
            }
//            if($request->hearing_status_id){
//                $hearing_data = $hearing_data->whereDate('office_date', '<=', date('Y-m-d', strtotime($request->office_date_to)));
//
//            }

            $hearing_data = $hearing_data->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').', case_year, hearing.id as id, case_number, department_id,  office_date, applicant_name')->orderBy('id', 'desc');

            $hearing_data = $hearing_data->select()->get();

            $listArray = [];

            if($request->hearing_status_id)
            {
                session()->put('hearing_status_id',$request->hearing_status_id);
                foreach ($hearing_data as $hearing)
                {
                    if($hearing->hearingStatusLog[0]->hearing_status_id == $request->hearing_status_id)
                    {
                        $listArray[] = $hearing;
                    }
                }
            }
        else
            {
                session()->forget('hearing_status_id');
                $listArray =  $hearing_data;
            }

//            dd($listArray);

            return $datatables->of($listArray)
                ->editColumn('radio', function ($hearing_data) {
                    $url = route('hearing.show', encrypt($hearing_data->id));
                    return '<div class="d-flex btn-icon-list"><a href="'.$url.'" onclick="geturl(this.value);" name="village_data_id" class="d-flex flex-column align-items-left"><span class="btn-icon btn-icon--view">
                        <img src="'. asset("img/view-icon.svg").'">
                    </span>View</span></a></div>';
                })
                ->editColumn('rownum', function ($hearing_data) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('case_number', function ($hearing_data) {
                    return $hearing_data->id;
                })
                ->editColumn('office_date', function ($hearing_data) {
                    return date(config('commanConfig.dateFormat'), strtotime($hearing_data->office_date));
                })
                // ->editColumn('actions', function ($hearing_data) use($request){
                //     return view('admin.hearing.actions', compact('hearing_data', 'request'))->render();
                // })
                ->editColumn('Status', function ($listArray) use ($request) {
                    $status = $listArray->hearingStatusLog[0]->hearing_status_id;

                    if($request->hearing_status_id)
                    {
                        if($request->hearing_status_id == $status){
                            $config_array = array_flip(config('commanConfig.hearingStatus'));
                            $value = ucwords(str_replace('_', ' ', $config_array[$status]));

                            if($value == 'Scheduled Meeting' && count($listArray['hearingSchedule']['prePostSchedule']) > 0) {
                                if ($listArray['hearingSchedule']['prePostSchedule'][0]['pre_post_status'] == 1) {
                                    $value = $value . ' Preponed';
                                }else{
                                    $value = $value . ' Postponed';
                                }
                            }
                            return $value;
                        }
                    }else{
                        $config_array = array_flip(config('commanConfig.hearingStatus'));
                        $value = ucwords(str_replace('_', ' ', $config_array[$status]));

                        if($value == 'Scheduled Meeting' && count($listArray['hearingSchedule']['prePostSchedule']) > 0) {
                            if ($listArray['hearingSchedule']['prePostSchedule'][0]['pre_post_status'] == 1) {
                                $value = $value . ' Preponed';
                            }else{
                                $value = $value . ' Postponed';
                            }
                        }
                        return $value;
                    }

                })
                ->rawColumns(['radio', 'case_number', 'office_date', 'Status'])
                ->make(true);
        }


        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.hearing.index', compact('html','header_data','getData', 'hearing_status','hearing_data'));
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $header_data = $this->header_data;
        $arrData['application_type'] = ApplicationType::all();
        $arrData['department'] = Department::where('status', 1)->get();
        $arrData['board'] = Board::where('status', 1)->get();
        $arrData['status'] = HearingStatus::all();

        return view('admin.hearing.add', compact('header_data', 'arrData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddHearingRequest $request)
    {
//        dd(session()->all());
        $department_id = RtiDepartmentUser::where('user_id',Auth::id())->value('department_id');

        $data = [
            'preceding_officer_name' => $request->preceding_officer_name,
            'case_year' => $request->case_year,
            'case_number' => $request->case_number,
            'application_type_id' => $request->application_type_id,
            'applicant_name' => $request->applicant_name,
            'applicant_mobile_no' => $request->applicant_mobile_no,
            'applicant_address' => $request->applicant_address,
            'respondent_name' => $request->respondent_name,
            'respondent_mobile_no' => $request->respondent_mobile_no,
            'respondent_address' => $request->respondent_address,
            'case_type' => $request->case_type,
            'office_year' => $request->office_year,
            'office_number' => $request->office_number,
            'office_date' => date('Y-m-d', strtotime($request->office_date)),
            'office_tehsil' => $request->office_tehsil,
            'office_village' => $request->office_village,
            'office_remark' => $request->office_remark,
            'department_id' => $department_id,
            // 'board_id' => $request->board_id,
            'hearing_status_id' => config('commanConfig.hearingStatus.pending'),
            'role_id' => session()->get('role_id'),
            'user_id' => Auth::user()->id
        ];

        // if(session()->get('role_name') == config('commanConfig.co_engineer') || session()->get('role_name') == config('commanConfig.co_pa')){
        //     $department_id = Department::where('department_name', config('commanConfig.hearing_department.co'))->value('id');
        //     $data['department_id'] = $department_id;
        // }
        // elseif(session()->get('role_name') == config('commanConfig.joint_co_pa') || session()->get('role_name') == config('commanConfig.joint_co')){
        //     $department_id = Department::where('department_name', config('commanConfig.hearing_department.joint_co'))->value('id');
        //     $data['department_id'] = $department_id;

        // }

        $hearing = Hearing::create($data);
        $hearing->update(['case_number' => $hearing->id]);
        $parent_role_id = User::where('role_id', session()->get('parent'))->first();

        $hearing_status_log = [
            [
                'hearing_id' => $hearing->id,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'department_id' => $department_id,
                'hearing_status_id' => config('commanConfig.hearingStatus.pending'),
                'to_user_id' => NULL,
                'to_role_id' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            // [
            //     'hearing_id' => $hearing->id,
            //     'user_id' => $parent_role_id->id,
            //     'role_id' => session()->get('parent'),
            //     'hearing_status_id' => config('commanConfig.hearingStatus.pending'),
            //     'to_user_id' => NULL,
            //     'to_role_id' => NULL,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now()
            // ]
        ];

        HearingStatusLog::insert($hearing_status_log);

        return redirect('hearing')->with(['success'=> 'Record added succesfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department_id = RtiDepartmentUser::where('user_id',Auth::id())->value('department_id');
        $id = decrypt($id);
//        $header_data = $this->header_data;
        $arrData['hearing'] = Hearing::with(['hearingStatus', 'hearingApplicationType', 'hearingStatusLog' => function($q) use($department_id){
            $q->where('department_id', $department_id);
        }])
                        ->where('id', $id)
                        ->first();
        $hearing_data = $arrData['hearing'];
////         dd($arrData['hearing']->hearingStatusLog[0]->hearing_status_id);
////         dd($hearing_data->hearingApplicationType->application_type);
//        $status = $arrData['hearing']->hearingStatusLog[0]->hearing_status_id;
//        $config_array = array_flip(config('commanConfig.hearingStatus'));
//        $status_value = ucwords(str_replace('_', ' ', $config_array[$status]));
//        dd($value);

//        $header_data = $this->header_data;
//        $arrData['hearing'] = Hearing::FindOrFail($id);
        $arrData['application_type'] = ApplicationType::all();
        $arrData['department'] = Department::all();
        $arrData['board'] = Board::where('status', 1)->get();
        $arrData['status'] = HearingStatus::all();
//        $hearing_data = $arrData['hearing'];
//        dd($hearing_data['hearingStatusLog']['0']['hearing_status_id']);

        return view('admin.hearing.show', compact('header_data', 'arrData', 'hearing_data', 'status_value'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $header_data = $this->header_data;
        $arrData['hearing'] = Hearing::FindOrFail($id);
        $arrData['application_type'] = ApplicationType::all();
        $arrData['department'] = Department::all();
        $arrData['board'] = Board::where('status', 1)->get();
        $arrData['status'] = HearingStatus::all();
        $hearing_data = $arrData['hearing'];
//         dd($hearing_data);

        return view('admin.hearing.edit', compact('header_data', 'arrData', 'hearing_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditHearingRequest $request, $id)
    {
        $hearing = Hearing::find($id);
        $data = [
            'preceding_officer_name' => $request->preceding_officer_name,
            'case_year' => $request->case_year,
            'case_number' => $request->case_number,
            'application_type_id' => $request->application_type_id,
            'applicant_name' => $request->applicant_name,
            'applicant_mobile_no' => $request->applicant_mobile_no,
            'applicant_address' => $request->applicant_address,
            'respondent_name' => $request->respondent_name,
            'respondent_mobile_no' => $request->respondent_mobile_no,
            'respondent_address' => $request->respondent_address,
            'case_type' => $request->case_type,
            'office_year' => $request->office_year,
            'office_number' => $request->office_number,
            'office_date' => date('Y-m-d', strtotime($request->office_date)),
            'office_tehsil' => $request->office_tehsil,
            'office_village' => $request->office_village,
            'office_remark' => $request->office_remark,
            'department_id' => $request->department,
            'board_id' => $request->board_id,
            'hearing_status_id' => config('commanConfig.hearingStatus.pending'),
            'role_id' => session()->get('role_id'),
            'user_id' => Auth::user()->id
        ];

        if(session()->get('role_name') == config('commanConfig.co_engineer') || session()->get('role_name') == config('commanConfig.co_pa')){
            $department_id = Department::where('department_name', config('commanConfig.hearing_department.co'))->value('id');
            $data['department_id'] = $department_id;
        }
        elseif(session()->get('role_name') == config('commanConfig.joint_co_pa') || session()->get('role_name') == config('commanConfig.joint_co')){
            $department_id = Department::where('department_name', config('commanConfig.hearing_department.joint_co'))->value('id');
            $data['department_id'] = $department_id;

        }

        $hearing->update($data);

        /*$hearing_status_log = [
            'hearing_id' => $id,
            'user_id' => Auth::user()->id,
            'role_id' => session()->get('role_id'),
            'hearing_status_id' => $request->hearing_status_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        HearingStatusLog::insert($hearing_status_log);*/

        return redirect('hearing')->with(['success'=> 'Record updated succesfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $hearing = Hearing::findOrFail($id);
        $hearing->delete();
        DeletedHearing::create([
            'hearing_id' => $id,
            'case_number' => $hearing->case_number,
            'case_year' => $hearing->case_year,
            'appellant_name' => $hearing->applicant_name,
            'description' => $hearing->office_remark,
            'final_judgement' => $hearing->hearing_status_id,
            'delete_reason' => $request->delete_reason,
        ]);

        return redirect('hearing')->with(['success'=> 'Record deleted succesfully']);
    }

    public function loadDeleteReasonOfHearingUsingAjax(Request $request)
    {
        $id = $request->id;
        return view('admin.hearing.hearingDeleteReason', compact('id'))->render();
    }


    /**
     * Show the hearing dashboard.
     * Author : Prajakta Sisale.
     * @return \Illuminate\Http\Response
     */
    public function Dashboard() {

        $role_id = session()->get('role_id');
        $user_id = Auth::id();
        $department_id = RtiDepartmentUser::where('user_id',Auth::id())->value('department_id');

        $conveyanceCommonController = new conveyanceCommonController();
        $conveyanceRoles     = $conveyanceCommonController->getConveyanceRoles();

        $renewal = new renewalCommonController();
        $renewalRoles     = $renewal->getRenewalRoles();

        //Hearing Summary
        $hearing_data = Hearing::with(['hearingStatusLog.hearingStatus','hearingStatusLog' => function($q) use($department_id) {
            $q->where('department_id', $department_id);
        }, 'hearingSchedule.prePostSchedule', 'hearingForwardCase', 'hearingSendNoticeToAppellant', 'hearingUploadCaseJudgement'])
            ->whereHas('hearingStatusLog' ,function($q) use($department_id){
                $q->where('department_id', $department_id);
            })->get()->toArray();

        $hearing_count = count($hearing_data);

        //Society Conveyance
        $conveyance_data = $conveyanceCommonController->getApplicationData($role_id,$user_id);
        $conveyance_count = count($conveyance_data);

        //Society Conveyance Subordinate Pendency
        $conveyance_pending_data = $conveyanceCommonController->getApplicationPendingAtDepartment();
        $conveyance_pending_count = $conveyance_pending_data['Total Number of Applications'];

        //Society Renewal
        $renewal_data = $renewal->getApplicationData($role_id,$user_id);
        $renewal_count = count($renewal_data);

        //Society Renewal Subordinate Pendency
        $renewal_pending_data = $renewal->getApplicationPendingAtDepartment();
        $renewal_pending_count = $renewal_pending_data['Total Number of Applications'];


        //Revision in Layout

        $today = Carbon::now()->format('d-m-Y');

        if(session()->get('role_name') == config('commanConfig.co_engineer') || session()->get('role_name') == config('commanConfig.co_pa')){
            $department_id = Department::where('department_name', config('commanConfig.hearing_department.co'))->value('id');
        }
        elseif(session()->get('role_name') == config('commanConfig.joint_co_pa') || session()->get('role_name') == config('commanConfig.joint_co')){
            $department_id = Department::where('department_name', config('commanConfig.hearing_department.joint_co'))->value('id');
        }


        $isHearingUsers = RtiDepartmentUser::where('department_id',$department_id)->pluck('user_id')->toArray();

//        dd(in_array($user_id,$isHearingUsers));

            $todaysHearing = Hearing::with(['hearingSchedule'=> function($q) use ($today ){
                $q->where('preceding_date',$today)->orderBy('id','desc')->limit(1);
            },'hearingSchedule.prePostSchedule'=> function($q) use ($today){
                $q->orderBy('id','desc')->limit(1);
            }])->where('department_id',$department_id)->get()->toArray();

//dd($todaysHearing);
        
            $todays_hearing_count = 0;
            $hearing= array();
            foreach($todaysHearing as $key => $todayHearing){
                if($todayHearing['hearing_schedule']){
                    if(in_array($todayHearing['hearing_schedule']['user_id'],$isHearingUsers)){
                        if($todayHearing['hearing_schedule']['pre_post_schedule']){
                            if(in_array($todayHearing['hearing_schedule']['pre_post_schedule']['0']['user_id'],$isHearingUsers)){
                                if($todayHearing['hearing_schedule']['pre_post_schedule']['0']['date'] == $today){
                                    $todays_hearing_count += 1;
                                    $hearing[] = $todayHearing;
                                }
                            }
                        }
                        else{
                            if($todayHearing['hearing_schedule']['preceding_date'] == $today)
                            {
                                $todays_hearing_count += 1;
                                $hearing[] = $todayHearing;
                            }
                        }
                    }
                }
            }
            $todaysHearing = $hearing;

        return view('admin.hearing.dashboard',compact('todaysHearing','hearing_count','todays_hearing_count','conveyanceRoles','renewalRoles','conveyance_pending_count','conveyance_count','renewal_pending_count','renewal_count'));
    }

    public function ajaxDashboard(Request $request){

        if($request->module_name == "Hearing Summary"){
            $department_id = RtiDepartmentUser::where('user_id',Auth::id())->value('department_id');

            $role_id = session()->get('role_id');
            $user_id = Auth::id();

            $hearing_data = Hearing::with(['hearingStatusLog.hearingStatus','hearingStatusLog' => function($q) use ($department_id){
                $q->where('department_id', $department_id);
                // ->where('role_id', session()->get('role_id'));
            }, 'hearingSchedule.prePostSchedule', 'hearingForwardCase', 'hearingSendNoticeToAppellant', 'hearingUploadCaseJudgement'])
                ->whereHas('hearingStatusLog' ,function($q) use ($department_id){
                    $q->where('department_id', $department_id);
                    // ->where('role_id', session()->get('role_id'));
                })->get()->toArray();

            $totalPendingHearing = $totalClosedHearing = $totalNoticeSendHearing = $totalScheduledHearing = $totalUnderJudgementHearing = $totalForwardedHearing = 0;

            foreach ($hearing_data as $hearing){

                $status = $hearing['hearing_status_log']['0']['hearing_status']['id'];

                switch ( $status )
                {
                    case config('commanConfig.hearingStatus.pending'): $totalPendingHearing += 1; break;
                    case config('commanConfig.hearingStatus.scheduled_meeting'): $totalScheduledHearing += 1; break;
                    case config('commanConfig.hearingStatus.case_under_judgement'): $totalUnderJudgementHearing += 1 ; break;
                    case config('commanConfig.hearingStatus.forwarded'): $totalForwardedHearing += 1; break;
                    case config('commanConfig.hearingStatus.case_closed'): $totalClosedHearing +=1 ; break;
                    case config('commanConfig.hearingStatus.notice_send'): $totalNoticeSendHearing +=1 ; break;
                    default:
                        ; break;
                }

            }

            $totalHearing = count($hearing_data);

            $dashboardData = array();
            $dashboardData['Total Number of Cases'][0] =  $totalHearing;
            $dashboardData['Total Number of Cases'][1] =  '';
            $dashboardData['Total Number of Pending Cases'][0] =  $totalPendingHearing;
            $dashboardData['Total Number of Pending Cases'][1] =  '?office_date_from=&office_date_to=&hearing_status_id='.config('commanConfig.hearingStatus.pending');
            $dashboardData['Total Number of Scheduled Cases'][0] = $totalScheduledHearing;
            $dashboardData['Total Number of Scheduled Cases'][1] = '?office_date_from=&office_date_to=&hearing_status_id='.config('commanConfig.hearingStatus.scheduled_meeting');
            $dashboardData['Total Number of Under Judgement Cases'][0] = $totalUnderJudgementHearing;
            $dashboardData['Total Number of Under Judgement Cases'][1] = '?office_date_from=&office_date_to=&hearing_status_id='.config('commanConfig.hearingStatus.case_under_judgement');
            $dashboardData['Total Number of Forwarded Cases'][0] = $totalForwardedHearing;
            $dashboardData['Total Number of Forwarded Cases'][1] = '?office_date_from=&office_date_to=&hearing_status_id='.config('commanConfig.hearingStatus.forwarded');
            $dashboardData['Total Number of Closed Cases'][0] = $totalClosedHearing;
            $dashboardData['Total Number of Closed Cases'][1] = '?office_date_from=&office_date_to=&hearing_status_id='.config('commanConfig.hearingStatus.case_closed');
            $dashboardData['Total Number of Notice Sent Cases'][0] = $totalNoticeSendHearing;
            $dashboardData['Total Number of Notice Sent Cases'][1] = '?office_date_from=&office_date_to=&hearing_status_id='.config('commanConfig.hearingStatus.notice_send');

            return $dashboardData;
        }

        if($request->module_name == "Society Conveyance"){
            $conveyanceCommonController = new conveyanceCommonController();
            $conveyanceDashboard = $conveyanceCommonController->ConveyanceDashboard();

            return $conveyanceDashboard;
        }

        if($request->module_name == 'Society Conveyance Subordinate Pendency'){
            $conveyanceCommonController = new conveyanceCommonController();

            $pendingApplications = $conveyanceCommonController->getApplicationPendingAtDepartment();

            return $pendingApplications;
        }

        if($request->module_name == "Society Renewal"){
            $renewal = new renewalCommonController();
            $renewalDashboard = $renewal->RenewalDashboard();

            return $renewalDashboard;
        }

        if($request->module_name = "Society Renewal Subordinate Pendency"){
            $renewal = new renewalCommonController();
            $renewalPendingApplications = $renewal->getApplicationPendingAtDepartment();

            return $renewalPendingApplications;

        }

    }

    public function getHearingLogs($hearing_id){

        $hearing_data = Hearing::with(['hearingSchedule1.userDetails.roleDetails', 'hearingUploadCaseJudgement', 'hearingUploadCaseJudgement.userDetails', 'hearingUploadCaseJudgement.userDetails.roleDetails', 'hearingPrePostSchedule.userDetails', 'hearingPrePostSchedule.userDetails.roleDetails', 'hearingSchedule1.userDetails'])
            ->where('id', $hearing_id)
            ->orderBy('id', 'desc')
            ->first();

            return $hearing_data;
    }

    /**
     * Show hearing log data.
     * Author : Prajakta Sisale.
     * @param  int  $hearing_id
     * @return \Illuminate\Http\Response
     */
    public function getAllHearingLogs($hearing_id){

        $hearing_id = decrypt($hearing_id);
        $department_id = RtiDepartmentUser::where('user_id',Auth::id())->value('department_id');

        $hearing_data = Hearing::with([
            'hearingSchedule1',
            'hearingSchedule1.scheduledCaseJudagementDetails',
            'hearingSchedule1.userDetails',
            'hearingSchedule1.userDetails.roleDetails',
            'hearingSchedule1.prePostSchedule',
            'hearingSchedule1.prePostSchedule.prePostCaseJudagementDetails',
            'hearingSchedule1.prePostSchedule.userDetails',
            'hearingSchedule1.prePostSchedule.userDetails.roleDetails',
            'hearingStatusLog' => function($q) use($department_id){
                $q->where('department_id', $department_id);
            }
            ])
            ->where('id', $hearing_id)
            ->orderBy('id', 'desc')
            ->first();

//        dd($hearing_data);
        return view('admin.hearing.hearing_log',compact('hearing_data'));

    }

    /**
     * Hearing export panel.
     * Author : Prajakta Sisale.
     * @return \Illuminate\Http\Response
     */
    public function hearingReports(){

        $module_names = ['Closed', 'Open', 'Scheduled'];

        return view('admin.reports.hearing.hearing_reports',compact('module_names'));

    }

    /**
     * Generate the hearing report.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function hearingReportsExport(Request $request){

//        dd($request->all());
        $status = $request->status;

        if($request->period != null)
            $period = $this->period($request->period);
        else
            $period = $request->period;

        $period_title = $this->periodTitle($request->period);

//        if($request->pdf == 'pdf'){
//            $report_format = $request->pdf;
//        }
//        else{
//            $report_format = $request->excel;
//        }
        $report_format = $request->excel;

        $department_id = RtiDepartmentUser::where('user_id',Auth::id())->value('department_id');

        $hearing_data = $this->getHearingData($period,$department_id);

        if($request->status == config('commanConfig.hearing_reports.Open')){

            $hearing_case_data = $this->getPendingCaseData($hearing_data);

            $result = $this->generateReport($hearing_case_data,$report_format,$period_title, 'Open Cases Details');
            if(!$result){
                return back()->with('error', 'No Record Found');
            }
        }
        else if($request->status == config('commanConfig.hearing_reports.Scheduled')){

            $hearing_case_data = $this->getScheduleCasedData($hearing_data);

            $result = $this->generateReport($hearing_case_data,$report_format,$period_title, 'Open Cases Details');
            if(!$result){
                return back()->with('error', 'No Record Found');
            }
        }
        else if($request->status == config('commanConfig.hearing_reports.Closed')){

            $hearing_case_data = $this->getClosedCaseData($hearing_data);

            $result = $this->generateReport($hearing_case_data,$report_format,$period_title, 'Open Cases Details');
            if(!$result){
                return back()->with('error', 'No Record Found');
            }
        }
        else{
            return back()->with('error', 'No Record Found');

        }
    }

    /**
     * Hearing report Data.
     *
     * Author: Prajakta Sisale.
     *
     * @return $data
     */
    public function getHearingData($period,$department_id){
        if($period == null){

            $hearing_data = Hearing::with(['userDetails.roleDetails','hearingStatusLog.hearingStatus','hearingStatusLog' => function($q) use($department_id , $period) {
                $q->where('department_id', $department_id);
            }, 'hearingSchedule.prePostSchedule','hearingSchedule.userDetails.roleDetails', 'hearingForwardCase', 'hearingSendNoticeToAppellant', 'hearingUploadCaseJudgement'])
                ->whereHas('hearingStatusLog' ,function($q) use($department_id){
                    $q->where('department_id', $department_id);
                })->get()->toArray();
        }
        else{
            $department_id = RtiDepartmentUser::where('user_id',Auth::id())->value('department_id');

            $hearing_data = Hearing::with(['userDetails.roleDetails','hearingStatusLog.hearingStatus','hearingStatusLog' => function($q) use($department_id , $period) {
                $q->where('department_id', $department_id)
                    ->where(DB::raw('DATEDIFF(NOW(),hearing_status_log.created_at)'), '>=', $period[0])
                    ->where(DB::raw('DATEDIFF(NOW(),hearing_status_log.created_at)'), '<=', $period[1]);
            }, 'hearingSchedule.prePostSchedule','hearingSchedule.userDetails.roleDetails', 'hearingForwardCase', 'hearingSendNoticeToAppellant', 'hearingUploadCaseJudgement'])
                ->whereHas('hearingStatusLog' ,function($q) use($department_id, $period){
                    $q->where('department_id', $department_id)
                        ->where(DB::raw('DATEDIFF(NOW(),hearing_status_log.created_at)'), '>=', $period[0])
                        ->where(DB::raw('DATEDIFF(NOW(),hearing_status_log.created_at)'), '<=', $period[1]);;
                })->get()->toArray();
        }
//        dd($hearing_data);
        return $hearing_data;
    }

    /**
     * Period for generating report.
     *
     * Author: Prajakta Sisale.
     *
     * @return $period
     */
    public function period($request_period){

        $period = explode('-', $request_period);

        return $period;
    }

    /**
     * Period title for generating report.
     *
     * Author: Prajakta Sisale.
     *
     * @return $period_title
     */
    public function periodTitle($request_period){
        $period_title = isset(config('commanConfig.pendency_report_periods')[$request_period])?config('commanConfig.pendency_report_periods')[$request_period]:"";

        return $period_title;
    }

    /**
     * Hearing Pending Case report Data.
     *
     * Author: Prajakta Sisale.
     *
     * @return $data
     */
    public function getPendingCaseData($hearing_data)
    {

        $hearing_case_data = array();
        $open = 0;

        foreach ($hearing_data as $hearing) {

            $hearing_status = $hearing['hearing_status_log'][0]['hearing_status_id'];


            switch ($hearing_status) {
                case config('commanConfig.hearingStatus.case_under_judgement') :
                    $open += 1;
                    $hearing_case_data[] = $hearing;
                    break;
                case config('commanConfig.hearingStatus.pending') :
                    $open += 1;
                    $hearing_case_data[] = $hearing;
                    break;
                case config('commanConfig.hearingStatus.forwarded') :
                    $open += 1;
                    $hearing_case_data[] = $hearing;
                    break;
                default:
                    ;
                    break;
            }
        }

        return $hearing_case_data;
    }

    /**
     * Hearing Scheduled case report Data.
     *
     * Author: Prajakta Sisale.
     *
     * @return $data
     */
    public function getScheduleCasedData($hearing_data)
    {

        $hearing_case_data = array();
        $scheduled= 0;

        foreach ($hearing_data as $hearing) {

            $hearing_status = $hearing['hearing_status_log'][0]['hearing_status_id'];

            switch ($hearing_status) {
                case config('commanConfig.hearingStatus.scheduled_meeting') :
                    $scheduled += 1;
                    $hearing_case_data[] = $hearing;
                    break;
                default:
                    ;
                    break;
            }
        }

        return $hearing_case_data;

    }

    /**
     * Hearing Closed case report Data.
     *
     * Author: Prajakta Sisale.
     *
     * @return $data
     */
    public function getClosedCaseData($hearing_data){

        $hearing_case_data = array();
        $closed = 0;
        foreach ($hearing_data as $hearing){

            $hearing_status =  $hearing['hearing_status_log'][0]['hearing_status_id'];

            switch ($hearing_status){
                case config('commanConfig.hearingStatus.case_closed') :
                    $closed += 1;
                    $hearing_case_data[] = $hearing;break;
                default:
                    ; break;
            }
        }

        return $hearing_case_data;

    }

    /**
     * Generate the Report in excel or pdf format.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateReport($data, $report_format, $period_title, $module_name){
        $fileName = date('Y_m_d_H_i_s') . '_period_wise_hearing_report.pdf';

//        $application_types = ApplicationType::all();
//        dd($application_types);

        if (count($data) > 0) {

//            if($report_format == 'pdf')
//            {
//                $content = view('admin.reports.hearing._period_wise_hearing_report', compact('data', 'period_title','module_name'));
//                $header_file = '';
//                $footer_file = '';
////                $header_file = view('admin.REE_department.offer_letter_header');
////                $footer_file = view('admin.REE_department.offer_letter_footer');
//                //$pdf = \App::make('dompdf.wrapper');
//                $pdf = new Mpdf([
//                    'default_font_size' => 9,
//                    'default_font' => 'Times New Roman',
//                    'format' => 'A4-L',
//                    'orientation' => 'L'
//                ]);
//                $pdf->autoScriptToLang = true;
//                $pdf->autoLangToFont = true;
//                $pdf->setAutoBottomMargin = 'stretch';
//                $pdf->setAutoTopMargin = 'stretch';
//                $pdf->SetHTMLHeader($header_file);
//                $pdf->SetHTMLFooter($footer_file);
//                $pdf->WriteHTML($content);
//                $pdf->Output($fileName, 'D');
//            }
            if($report_format == 'excel')
            {
                $dataListMaster = [];
                $i=1;
                foreach ($data as $datas) {

                    $dataList = [];
                    $dataList['id'] = $i;
                    $dataList['Preceding Officer Name'] = $datas['preceding_officer_name'];
                    $dataList['Case Year'] = $datas['case_year'];
                    $dataList['Case Number'] = $datas['case_number'];
                    $dataList['Role'] = $datas['user_details']['role_details']['name'];
                    $dataList['Application Type Id'] = ApplicationType::where('id',$datas['application_type_id'])->value('application_type');
                    $dataList['Applicant Name'] = $datas['applicant_name'];
                    $dataList['Applicant Mobile No'] = $datas['applicant_mobile_no'];
                    $dataList['Applicant Address'] = $datas['applicant_address'];
                    $dataList['Respondent Name'] = $datas['respondent_name'];
                    $dataList['Respondent Mobile No'] = $datas['respondent_mobile_no'];
                    $dataList['Respondent Address'] = $datas['respondent_address'];
                    $dataList['Case Type'] = $datas['case_type'];
                    $dataList['Office Year'] = $datas['office_year'];
                    $dataList['Office Number'] = $datas['office_number'];
                    $dataList['Office Date'] = $datas['office_date'];
                    $dataList['Office Tehsil'] = $datas['office_tehsil'];
                    $dataList['Office Village'] = $datas['office_village'];
                    $dataList['Office Remark'] = $datas['office_remark'];
                    $dataList['Department Name'] = Department::where('id',$datas['department_id'])->value('department_name');
                    $dataList['Board'] = 'Mumbai';
                    $dataList['Hearing Status'] = $datas['hearing_status_log'][0]['hearing_status']['status_title'];
                    $dataList['Current User for Case'] = $datas['hearing_schedule']['user_details']['name'] ?? $datas['user_details']['name']  ;
                    $dataList['Current Role for Case'] = $datas['hearing_schedule']['user_details']['role_details']['name'] ?? $datas['user_details']['role_details']['name'];
                    $dataList['Previous Case Department'] = isset($datas['hearing_status_log']) ? Department::where('id',$datas['hearing_status_log'][0]['department_id'])->value('department_name'):'';
                    $dataList['Hearing Schedule Description'] = $datas['hearing_schedule']['description'] ?? '';
                    $dataList['Hearing Case Judgement Description'] = $datas['hearing_upload_case_judgement'][0]['description'] ?? '';

//                    $dataList['Hearing Status Log'] = $datas[''];
//                    $dataList['Hearing Schedule'] = $datas[''];
//                    $dataList['Hearing Forward Case'] = $datas[''];
//                    $dataList['Hearing Send Notice to Appellant'] = $datas[''];
//                    $dataList['Hearing Upload Case Judgement'] = $datas[''];
                    


                    $dataListKeys = array_keys($dataList);
                    $dataListMaster[]=$dataList;
                    $i++;
                }
                $module_name = str_replace(' ','_',$module_name);
                return Excel::create(date('Y_m_d_H_i_s') . '_Period_Wise_'.$module_name, function($excel) use($dataListMaster){

                    $excel->sheet('mySheet', function($sheet) use($dataListMaster)
                    {
                        $sheet->fromArray($dataListMaster);
                    });
                })->download('csv');
            }

            return true;

        } else {
            return false;
        }
    }
}
