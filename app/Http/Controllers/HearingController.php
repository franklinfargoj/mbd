<?php

namespace App\Http\Controllers;

use App\ApplicationType;
use App\Department;
use App\Hearing;
use App\HearingStatus;
use App\Http\Requests\hearing\EditHearingRequest;
use DB;
use App\Http\Requests\hearing\AddHearingRequest;
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Datatables $datatables)
    {
        $header_data = $this->header_data;
        $getData = $request->all();

        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'id','name' => 'id','title' => 'Case Number'],
            ['data' => 'case_year','name' => 'case_year','title' => 'Case Year'],
            ['data' => 'office_date','name' => 'office_date','title' => 'Case Reg Date'],
            ['data' => 'applicant_name', 'name' => 'applicant_name', 'title' => 'Applicant Name'],
            ['data' => 'hearingDepartment','name' => 'hearingDepartment.department_name','title' => 'Department'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {

            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));

            $hearing_data = Hearing::with(['hearingDepartment', 'hearingSchedule', 'prePostSchedule']);

            if($request->office_date_from)
            {
                $hearing_data = $hearing_data->whereDate('office_date', '>=', date('Y-m-d', strtotime($request->office_date_from)));
            }

            if($request->office_date_to)
            {
                $hearing_data = $hearing_data->whereDate('office_date', '<=', date('Y-m-d', strtotime($request->office_date_to)));
            }

            $hearing_data = $hearing_data->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').', case_year, hearing.id as id, department_id,  office_date, applicant_name');

            return $datatables->of($hearing_data)
                ->editColumn('hearingDepartment', function ($hearing_data) {
                    return $hearing_data->hearingDepartment->department_name;
                })
                ->editColumn('actions', function ($hearing_data) {
                    return view('admin.hearing.actions', compact('hearing_data'))->render();
                })
                ->rawColumns(['hearingDepartment', 'actions'])
                ->make(true);
        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.hearing.index', compact('html','header_data','getData'));
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [6, "desc" ],
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
        $arrData['department'] = Department::all();
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
            'office_date' => $request->office_date,
            'office_tehsil' => $request->office_tehsil,
            'office_village' => $request->office_village,
            'office_remark' => $request->office_remark,
            'department_id' => $request->department,
            'hearing_status_id' => $request->hearing_status_id,
        ];

        Hearing::create($data);

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
            'office_date' => $request->office_date,
            'office_tehsil' => $request->office_tehsil,
            'office_village' => $request->office_village,
            'office_remark' => $request->office_remark,
            'department_id' => $request->department,
            'hearing_status_id' => $request->hearing_status_id,
        ];

        $hearing->update($data);

        return redirect('hearing')->with(['success'=> 'Record updated succesfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
