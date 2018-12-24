<?php

namespace App\Http\Controllers;

use App\Hearing;
use App\HearingSchedule;
use App\HearingStatusLog;
use App\Http\Requests\pre_post_schedule\PrePostScheduleRequest;
use App\PrePostSchedule;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrePostScheduleController extends Controller
{
    public $header_data = array(
        'menu' => 'Hearing',
        'menu_url' => 'hearing',
        'schedule' => 'Prepone/Postpone Hearing'
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
        $id = decrypt($id);
        $header_data = $this->header_data;
//        $arrData['schedule_hearing_data'] = Hearing::with('hearingSchedule')->where('id', $id)->first();
        $arrData['hearing_data'] = Hearing::with(['hearingStatus', 'hearingPrePostSchedule', 'hearingApplicationType', 'hearingStatusLog' => function($q){
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'));
        }])
            ->where('id', $id)
            ->first();
        $hearing_data = $arrData['hearing_data'];
//        dd($hearing_data->id);
        return view('admin.prepost_schedule.add', compact('header_data', 'arrData', 'hearing_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrePostScheduleRequest $request)
    {
        $data = [
            'date' => $request->date,
            'description' => $request->description,
            'pre_post_status' => $request->pre_post_status,
            'hearing_schedule_id' => $request->hearing_schedule_id,
            'hearing_id' => $request->hearing_id,
        ];

        PrePostSchedule::create($data);

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


        return redirect('/hearing')->with('success','Hearing Rescheduled successfully');
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
        $id = decrypt($id);
        $header_data = $this->header_data;
//        $arrData['schedule_prepost_data'] = PrePostSchedule::FindOrFail($id);
        $arrData['schedule_prepost_data'] = Hearing::with(['hearingSchedule.prePostSchedule'])->where('id', $id)->first();
        $hearing_data = Hearing::with(['hearingStatus', 'hearingPrePostSchedule', 'hearingApplicationType', 'hearingStatusLog' => function($q){
            $q->where('user_id', Auth::user()->id)
                ->where('role_id', session()->get('role_id'));
        }])
            ->where('id', $id)
            ->first();
//        dd($hearing_data);
        return view('admin.prepost_schedule.edit', compact('header_data', 'arrData', 'hearing_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PrePostScheduleRequest $request, $id)
    {
//        dd($request->all());
//        $pre_post_schedule = PrePostSchedule::FindOrFail($id);

        $data = [
            'date' => $request->date,
            'description' => $request->description,
            'pre_post_status' => $request->pre_post_status,
            'hearing_schedule_id' => $request->hearing_schedule_id,
            'hearing_id' => $request->hearing_id,
        ];

//        $pre_post_schedule->update($data);

        PrePostSchedule::create($data);

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

        return redirect('/hearing')->with('success','Hearing Rescheduled successfully');
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
