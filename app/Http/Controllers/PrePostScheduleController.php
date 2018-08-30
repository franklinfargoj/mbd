<?php

namespace App\Http\Controllers;

use App\Hearing;
use App\HearingSchedule;
use App\Http\Requests\pre_post_schedule\PrePostScheduleRequest;
use App\PrePostSchedule;
use Illuminate\Http\Request;

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
        $header_data = $this->header_data;
        $arrData['schedule_hearing_data'] = Hearing::with('hearingSchedule')->where('id', $id)->first();

        return view('admin.prepost_schedule.add', compact('header_data', 'arrData'));
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
        $header_data = $this->header_data;
//        $arrData['schedule_prepost_data'] = PrePostSchedule::FindOrFail($id);
        $arrData['schedule_prepost_data'] = Hearing::with(['hearingSchedule', 'prePostSchedule'])->where('id', $id)->first();

        return view('admin.prepost_schedule.edit', compact('header_data', 'arrData'));
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
        $pre_post_schedule = PrePostSchedule::FindOrFail($id);

        $data = [
            'date' => $request->date,
            'description' => $request->description,
            'pre_post_status' => $request->pre_post_status,
        ];

        $pre_post_schedule->update($data);

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
