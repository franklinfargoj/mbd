<?php

namespace App\Http\Controllers;
use App\User;
use App\Board;
use App\Department;
use App\RtiForm;
use App\Http\Requests\rti\RtiFormSubmitRequest;
use Illuminate\Http\Request;

class RtiFrontEndController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.rti.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.rti.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->input());
        $input = array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => '',
            'mobile_no' => $request->input('mobile_no'),
            'address' => $request->input('address'),
        );
        // dd($input);
        $last_inserted_id = User::create($input);
        return redirect()->route('rti_frontend.show', $last_inserted_id->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        // dd($errors);
        $boards = Board::all();
        $departments = Department::all();
        return view('frontend.rti.register_applicants', compact('id', 'boards', 'departments'));
    }

    public function saveRtiFrontendForm(RtiFormSubmitRequest $request)
    {
        // dd($request->input());
        // $input = $request->except(['_token']);
        // $time = date("Ymd").time();
        // $input['unique_id'] = $time;
        // $input['frontend_user_id'] = Session::get('fronendLoginId');
        // $input['applicant_name'] = $request->get('fullname');
        // $input['applicant_addr'] = $request->get('address');
        $input = array(
            'board_id' => $request->input('board_id'),
            'frontend_user_id' => $request->input('user_id'),
            'applicant_name' => $request->input('name'),
            'applicant_addr' => $request->input('address'),
            'info_subject' => $request->input('info_subject'),
            'info_period_from' => $request->input('info_period_from'),
            'info_period_to' => $request->input('info_period_to'),
            'info_descr' => $request->input('info_descr'),
            'info_post_or_person' => $request->input('info_post_or_person'),
            'applicant_below_poverty_line' => $request->input('applicant_below_poverty_line'),
            'department_id' => $request->input('department_id'),
            'unique_id' => $request->input('user_id').date("Ymd").time(),
            'status' => '1',
            'user_id' => $request->input('user_id'),
            'rti_schedule_meeting_id' => '0',
            'rti_status_id' => '0',
            'rti_send_info_id' => '0',
            'rti_forward_application_id' => '0',
        );
        // Session::put('rtiFormId',$input['unique_id']);

        if($request->hasFile('poverty_line_proof_file'))
        {
            $extension = $request->file('poverty_line_proof_file')->getClientOriginalExtension();
            $path = Storage::putFileAs( '/poverty_files', $request->file('poverty_line_proof_file'), $time.'.'.$extension, 'public');
            $input['poverty_line_proof'] = $request->get($time.'.'.$extension);
        }
        if(!empty($request->input('info_post_type')) && !empty($request->input('poverty_line_proof_file'))){
            $input['info_post_type'] = $request->input('info_post_type');
            $input['poverty_line_proof'] = '';
        }else{
            $input['info_post_type'] = '0';
            $input['poverty_line_proof'] = '';
        }
        // dd($input);
        $last_id = RtiForm::create($input);
        $last_inserted_id = $last_id->id;
        dd($last_inserted_id);
        return redirect()->route('rti_frontend.edit', $input['frontend_user_id']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unique_id = RtiForm::find($id);
        dd($unique_id);
        return view('frontend.rti.rti_view_application_no', compact('id'));
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
