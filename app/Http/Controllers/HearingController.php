<?php

namespace App\Http\Controllers;

use App\ApplicationType;
use App\Board;
use App\DeletedHearing;
use App\Department;
use App\Hearing;
use App\HearingStatus;
use App\HearingStatusLog;
use App\Http\Requests\hearing\EditHearingRequest;
use App\User;
use Carbon\Carbon;
use DB;
use App\Http\Requests\hearing\AddHearingRequest;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
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
        $hearing_data = Hearing::with(['hearingStatusLog.hearingStatus','hearingStatusLog' => function($q){
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'));
        }, 'hearingSchedule.prePostSchedule', 'hearingForwardCase', 'hearingSendNoticeToAppellant', 'hearingUploadCaseJudgement'])
            ->whereHas('hearingStatusLog' ,function($q){
                $q->where('user_id', Auth::user()->id)
                    ->where('role_id', session()->get('role_id'));
            })->get()->toArray();

        return view('admin.hearing.print_data',compact('hearing_data'));
    }

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

        $columns = [
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'case_number','name' => 'case_number','title' => 'Case Number'],
            ['data' => 'case_year','name' => 'case_year','title' => 'Case Year'],
            ['data' => 'office_date','name' => 'office_date','title' => 'Case Reg Date'],
            ['data' => 'applicant_name', 'name' => 'applicant_name', 'title' => 'Applicant Name'],
//            ['data' => 'hearingDepartment','name' => 'hearingDepartment.department_name','title' => 'Department'],
            ['data' => 'Status','name' => 'hearing_status_id','title' => 'Status'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if($request->excel)
        {
            //dd('ok');
            $hearing_data = Hearing::with(['hearingStatusLog.hearingStatus','hearingStatusLog' => function($q){
                $q->where('user_id', Auth::user()->id)
                    ->where('role_id', session()->get('role_id'));
            }, 'hearingSchedule.prePostSchedule', 'hearingForwardCase', 'hearingSendNoticeToAppellant', 'hearingUploadCaseJudgement'])
                ->whereHas('hearingStatusLog' ,function($q){
                    $q->where('user_id', Auth::user()->id)
                        ->where('role_id', session()->get('role_id'));
                })->get()->toArray();

            $hearing_excel_data = [];

            $i = 1;
            foreach ($hearing_data as $hearing)
            {
                $config_array = array_flip(config('commanConfig.hearingStatus'));
                $current_status = $hearing['hearing_status_log'][0]['hearing_status_id'];

                $hearing_excel_data[] = [
                    'Sr. No.' => $i,
                    'Case No.' => $hearing['case_number'],
                    'Case Year' => $hearing['case_year'],
                    'Apellent Name' => $hearing['applicant_name'],
                    'Appelent Mobile No.' => $hearing['applicant_mobile_no'],
                    'Status' => (array_key_exists($current_status, $config_array)) ? ucwords(str_replace('_', ' ', $config_array[$current_status])) : "",
                ];
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

            $hearing_data = Hearing::with(['hearingStatusLog.hearingStatus','hearingStatusLog' => function($q){
                $q->where('user_id', Auth::user()->id)
                    ->where('role_id', session()->get('role_id'));
            }, 'hearingSchedule.prePostSchedule', 'hearingForwardCase', 'hearingSendNoticeToAppellant', 'hearingUploadCaseJudgement'])
                ->whereHas('hearingStatusLog' ,function($q){
                    $q->where('user_id', Auth::user()->id)
                        ->where('role_id', session()->get('role_id'));
                });


            if($request->office_date_from)
            {
                $hearing_data = $hearing_data->whereDate('office_date', '>=', date('Y-m-d', strtotime($request->office_date_from)));
            }

            if($request->office_date_to)
            {

                $hearing_data = $hearing_data->whereDate('office_date', '<=', date('Y-m-d', strtotime($request->office_date_to)));
            }

//            $hearing_data = $hearing_data->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').', case_year, hearing.id as id, case_number, department_id,  office_date, applicant_name');

            $hearing_data = $hearing_data->select()->get();

            $listArray = [];
            if($request->hearing_status_id)
            {
                foreach ($hearing_data as $hearing)
                {
                    if($hearing->hearingStatusLog[0]->hearing_status_id == $request->hearing_status_id)
                    {
//                        dd("in if");
                        $listArray[] = $hearing;
                    }
                }
            }
            else
            {
                $listArray =  $hearing_data;
            }

            return $datatables->of($listArray)
                ->editColumn('radio', function ($hearing_data) {
                    $url = route('hearing.show', $hearing_data->id);
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="village_data_id"><span></span></label>';
                })
                ->editColumn('rownum', function ($hearing_data) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                /*->editColumn('hearingDepartment', function ($hearing_data) {
                    return $hearing_data->hearingDepartment->department_name;
                })*/
                ->editColumn('office_date', function ($hearing_data) {
                    return date(config('commanConfig.dateFormat'), strtotime($hearing_data->office_date));
                })
                ->editColumn('actions', function ($hearing_data) use($request){
                    return view('admin.hearing.actions', compact('hearing_data', 'request'))->render();
                })
                ->editColumn('Status', function ($listArray) use ($request) {
                    $status = $listArray->hearingStatusLog[0]->hearing_status_id;

                    if($request->hearing_status_id)
                    {
                        if($request->hearing_status_id == $status){
                            $config_array = array_flip(config('commanConfig.hearingStatus'));
                            $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                            return $value;
                        }
                    }else{
                        $config_array = array_flip(config('commanConfig.hearingStatus'));
                        $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                        return $value;
                    }

                })
                ->rawColumns(['radio', 'actions', 'office_date', 'Status'])
                ->make(true);
        }


        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.hearing.index', compact('html','header_data','getData', 'hearing_status'));
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [7, "desc" ],
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
            /*'department_id' => $request->department,
            'board_id' => $request->board_id,
            'hearing_status_id' => $request->hearing_status_id,*/
            'role_id' => session()->get('role_id'),
            'user_id' => Auth::user()->id
        ];

        $hearing_id = Hearing::create($data)->id;

        $parent_role_id = User::where('role_id', session()->get('parent'))->first();

        $hearing_status_log = [
            [
                'hearing_id' => $hearing_id,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'hearing_status_id' => config('commanConfig.hearingStatus.pending'),
                'to_user_id' => NULL,
                'to_role_id' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'hearing_id' => $hearing_id,
                'user_id' => $parent_role_id->id,
                'role_id' => session()->get('parent'),
                'hearing_status_id' => config('commanConfig.hearingStatus.pending'),
                'to_user_id' => NULL,
                'to_role_id' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
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
        $header_data = $this->header_data;
        $arrData['hearing'] = Hearing::with(['hearingStatus', 'hearingApplicationType'])
                        ->where('id', $id)
                        ->first()->toArray();

        return view('admin.hearing.show', compact('header_data', 'arrData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $header_data = $this->header_data;
        $arrData['hearing'] = Hearing::FindOrFail($id);
        $arrData['application_type'] = ApplicationType::all();
        $arrData['department'] = Department::all();
        $arrData['board'] = Board::where('status', 1)->get();
        $arrData['status'] = HearingStatus::all();

        return view('admin.hearing.edit', compact('header_data', 'arrData'));
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
            'hearing_status_id' => $request->hearing_status_id,
            'role_id' => session()->get('role_id'),
            'user_id' => Auth::user()->id
        ];

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

        return redirect()->back()->with(['success'=> 'Record deleted succesfully']);
    }

    public function loadDeleteReasonOfHearingUsingAjax(Request $request)
    {
        $id = $request->id;
        return view('admin.hearing.hearingDeleteReason', compact('id'))->render();
    }
}
