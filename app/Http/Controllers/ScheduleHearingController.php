<?php

namespace App\Http\Controllers;

use App\Hearing;
use App\HearingSchedule;
use App\HearingStatus;
use App\HearingStatusLog;
use App\Http\Requests\hearing_schedule\HearingScheduleRequest;
use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\HearingController;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Auth;
use App\RtiDepartmentUser;
use Storage;

class ScheduleHearingController extends Controller
{
    public $header_data = array(
        'menu' => 'Hearing',
        'hearing_menu' => 'Schedule Hearing',
        'menu_url' => 'schedule_hearing'
    );

    public function __construct()
    {
        $this->CommonController = new CommonController();
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
    public function create($id)
    {
        $id = decrypt($id);
        $header_data = $this->header_data;
        $arrData['hearing'] = Hearing::FindOrFail($id);
        $arrData['status'] = HearingStatus::all();
        $hearing_data = $arrData['hearing'];
        $HearingController = new HearingController();
        $hearingLogs = $HearingController->getHearingLogs($id);
      
        return view('admin.schedule_hearing.add', compact('header_data', 'arrData', 'hearing_data','hearingLogs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HearingScheduleRequest $request)
    {
        $department_id = RtiDepartmentUser::where('user_id',Auth::id())->value('department_id');
        $time = time();

        $input['hearing_id'] = $request->hearing_id;
        $input['user_id'] = Auth::Id();
        $input['preceding_date'] = $request->preceding_date;
        $input['preceding_number'] = $request->preceding_number;
        $input['preceding_time'] = $request->preceding_time;
        $input['description'] = $request->description;
        $input['update_status'] = config('commanConfig.hearingStatus.scheduled_meeting');

        if($request->hasFile('file_case_template') && $request->hasFile('file_update_supporting_documents'))
        {
            if(isset($request->file_case_template)){
                $extension = $request->file_case_template->getClientOriginalExtension();
                if($extension != "pdf") {
                    return redirect()->back()->with('error','Invalid type of file uploaded (only pdf allowed)');
                }
            }

            if(isset($request->file_update_supporting_documents)){
                $extension = $request->file_update_supporting_documents->getClientOriginalExtension();
                if($extension != "pdf") {
                    return redirect()->back()->with('error','Invalid type of file uploaded (only pdf allowed)');
                }
            }

//            dd("hello");
            $case_template_name = 'file_case_template'.time().'.'. $extension;
//            $case_template_path = Storage::putFileAs('/schedule_case_template', $request->file_case_template, $case_template_name, 'public');
            $fileUpload = $this->CommonController->ftpFileUpload('schedule_case_template',$request->file_case_template,$case_template_name);
            $input['case_template'] = config('commanConfig.storage_server').'/schedule_case_template/'.$case_template_name;

            $name = 'update_supporting_documents.'. $time . '.' . $extension;
//            $path = Storage::putFileAs('/schedule_supporting_document', $request->file_update_supporting_documents, $name, 'public');
            $fileUploadSupportingDocument = $this->CommonController->ftpFileUpload('schedule_supporting_document',$request->file_update_supporting_documents,$name);
            $input['update_supporting_documents'] = config('commanConfig.storage_server').'/schedule_supporting_document/'.$name;

        }
        else
        {
            return redirect()->back()->with('error','Please select file to upload');
        }

        HearingSchedule::create($input);

        $parent_role_id = User::where('role_id', session()->get('parent'))->first();

        $hearing_status_log = [
            [
                'hearing_id' => $request->hearing_id,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'department_id' => $department_id,
                'hearing_status_id' => config('commanConfig.hearingStatus.scheduled_meeting'),
                'to_user_id' => NULL,
                'to_role_id' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]

            // [
            //     'hearing_id' => $request->hearing_id,
            //     'user_id' => $parent_role_id->id,
            //     'role_id' => session()->get('parent'),
            //     'hearing_status_id' => config('commanConfig.hearingStatus.scheduled_meeting'),
            //     'to_user_id' => NULL,
            //     'to_role_id' => NULL,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now()
            // ]
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
        $id = decrypt($id);
        $department_id = RtiDepartmentUser::where('user_id',Auth::id())->value('department_id');
        $arrData['hearing'] = Hearing::with(['hearingStatus', 'hearingApplicationType', 'hearingSchedule', 'hearingStatusLog' => function($q) use($department_id){
            $q->where('department_id', $department_id);
        }]) 
            ->where('id', $id)
            ->first();
        $hearing_data = $arrData['hearing'];
        $HearingController = new HearingController();
        $hearingLogs = $HearingController->getHearingLogs($id);        
//        dd($hearing_data);
        return view('admin.schedule_hearing.show', compact('hearing_data', 'arrData','hearingLogs'));
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
