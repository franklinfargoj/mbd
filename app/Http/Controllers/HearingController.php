<?php

namespace App\Http\Controllers;

use App\ApplicationType;
use App\Department;
use App\Hearing;
use App\HearingStatus;
use App\Http\Requests\hearing\AddHearingRequest;
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
    public function index()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
