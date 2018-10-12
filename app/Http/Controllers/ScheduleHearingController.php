<?php

namespace App\Http\Controllers;

use App\Hearing;
use App\HearingSchedule;
use App\HearingStatus;
use App\HearingStatusLog;
use App\Http\Requests\hearing_schedule\HearingScheduleRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Auth;
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
        $hearing_data = $arrData['hearing'];
        return view('admin.schedule_hearing.add', compact('header_data', 'arrData', 'hearing_data'));
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

        $input['hearing_id'] = $request->hearing_id;
        $input['preceding_date'] = $request->preceding_date;
        $input['preceding_number'] = $request->preceding_number;
        $input['preceding_time'] = $request->preceding_time;
        $input['description'] = $request->description;
        $input['update_status'] = config('commanConfig.hearingStatus.scheduled_meeting');

        if($request->hasFile('file_case_template') && $request->hasFile('file_update_supporting_documents'))
        {
            if(isset($request->file['file_case_template'])){
                dd($request->file('file_case_template'));
                $extension = $request->file('file_case_template')->getClientOriginalExtension();
                if($extension != "pdf") {
                    return redirect()->back()->with('error','Invalid type of file uploaded (only pdf allowed)');
                }
            }

            if(isset($request->file['file_update_supporting_documents'])){
                $extension = $request->file['file_update_supporting_documents']->getClientOriginalExtension();
                if($extension != "pdf") {
                    return redirect()->back()->with('error','Invalid type of file uploaded (only pdf allowed)');
                }
            }

//            $case_template_name = File::name($request->file['file_case_template']->getClientOriginalName()) . '_' . $time . '.' . $extension;
//            $case_template_path = Storage::putFileAs('/schedule_case_template', $request->file['case_template'], $case_template_name, 'public');
//            $input['case_template'] = $case_template_path;
//
//            $name = File::name($request->file['file_update_supporting_documents']->getClientOriginalName()) . '_' . $time . '.' . $extension;
//            $path = Storage::putFileAs('/schedule_supporting_document', $request->file['file_update_supporting_documents'], $name, 'public');
//            $input['file_update_supporting_documents'] = $path;

        }
        else
        {
//             dd("sadsad");
            return redirect()->back()->with('error','Please select file to upload');
        }

        HearingSchedule::create($input);

        $parent_role_id = User::where('role_id', session()->get('parent'))->first();

        $hearing_status_log = [
            [
                'hearing_id' => $request->hearing_id,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'hearing_status_id' => config('commanConfig.hearingStatus.scheduled_meeting'),
                'to_user_id' => NULL,
                'to_role_id' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'hearing_id' => $request->hearing_id,
                'user_id' => $parent_role_id->id,
                'role_id' => session()->get('parent'),
                'hearing_status_id' => config('commanConfig.hearingStatus.scheduled_meeting'),
                'to_user_id' => NULL,
                'to_role_id' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        HearingStatusLog::insert($hearing_status_log);

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
