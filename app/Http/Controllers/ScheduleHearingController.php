<?php

namespace App\Http\Controllers;

use App\Hearing;
use App\HearingSchedule;
use App\HearingStatus;
use App\Http\Requests\hearing_schedule\HearingScheduleRequest;
use Illuminate\Http\Request;
use File;
use Storage;

class ScheduleHearingController extends Controller
{
    public $header_data = array(
        'menu' => 'Hearing',
        'hearing_menu' => 'Schedule Hearing',
        'menu_url' => 'schedule_hearing'
    );
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
    public function create($id)
    {
        $header_data = $this->header_data;
        $arrData['hearing'] = Hearing::FindOrFail($id);
        $arrData['status'] = HearingStatus::all();

        return view('admin.schedule_hearing.add', compact('header_data', 'arrData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HearingScheduleRequest $request)
    {
        $time = time();

        $input['preceding_officer_name'] = $request->preceding_officer_name;
        $input['case_year'] = $request->case_year;
        $input['case_number'] = $request->case_number;
        $input['preceding_number'] = $request->hearing_id;
        $input['appellant_name'] = $request->applicant_name;
        $input['respondent_name'] = $request->respondent_name;
        $input['preceding_date'] = $request->preceding_date;
        $input['preceding_time'] = $request->preceding_time;
        $input['description'] = $request->description;
        $input['update_status'] = $request->update_status;

        if($request->hasFile('file'))
        {
            if(isset($request->file['case_template'])){
                $extension = $request->file['case_template']->getClientOriginalExtension();
                if($extension != "pdf") {
                    return redirect()->back()->with('error','Invalid type of file uploaded (only pdf allowed)');
                }
            }

            if(isset($request->file['update_supporting_documents'])){
                $extension = $request->file['update_supporting_documents']->getClientOriginalExtension();
                if($extension != "pdf") {
                    return redirect()->back()->with('error','Invalid type of file uploaded (only pdf allowed)');
                }
            }

            $case_template_name = File::name($request->file['case_template']->getClientOriginalName()) . '_' . $time . '.' . $extension;
            $case_template_path = Storage::putFileAs('/schedule_case_template', $request->file['case_template'], $case_template_name, 'public');
            $input['case_template'] = $case_template_path;

            $name = File::name($request->file['update_supporting_documents']->getClientOriginalName()) . '_' . $time . '.' . $extension;
            $path = Storage::putFileAs('/schedule_supporting_document', $request->file['update_supporting_documents'], $name, 'public');
            $input['update_supporting_documents'] = $path;

        }
        else
        {
            return redirect()->back()->with('error','Please select file to upload');
        }

        HearingSchedule::create($input);

        return redirect('/hearing')->with(['success'=> 'Schedule created successfully']);
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
