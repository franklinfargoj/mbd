<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Board;
use App\Department;
use App\RtiForm;
use App\RtiScheduleMeeting;
use App\Users;
use App\MasterRtiStatus;
use App\RtiStatus;
use App\RtiSendInfo;
use App\RtiForwardApplication;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\rti\RtiFormSubmitRequest;
use App\Http\Requests\rti\SearchRtiFrontendRequest;
use Yajra\DataTables\DataTables;
use Config;
use DB;
use App\RtiFronendUser;
use PDF;

class RtiFormController extends Controller
{

    protected $list_num_of_records_per_page;

    public function __construct()
    {
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    public function showFrontendForm()
    {
        $boards = Board::where('status',1)->get();
            $departments = Department::where('status',1)->get();
            return view('frontendRtiForm',compact('departments','boards'));
        if(Session::has('fronendLoginId'))
        {
            $boards = Board::where('status',1)->get();
            $departments = Department::where('status',1)->get();
            return view('frontendRtiForm',compact('departments','boards'));
        }
        else{
            return redirect('/frontend_register');
        }
    }

    public function saveFrontendForm(RtiFormSubmitRequest $request)
    {
       // dd($request->input());
        $input = $request->except(['_token']);
        $time = date("Ymd").time();
        $input['unique_id'] = $time;
        $input['frontend_user_id'] = Session::get('fronendLoginId');
        $input['applicant_name'] = $request->get('fullname');
        $input['applicant_addr'] = $request->get('address');
        Session::put('rtiFormId',$input['unique_id']);

        if($request->hasFile('poverty_line_proof_file'))
        {
            $extension = $request->file('poverty_line_proof_file')->getClientOriginalExtension();
            $path = Storage::putFileAs( '/poverty_files', $request->file('poverty_line_proof_file'), $time.'.'.$extension, 'public');
            $input['poverty_line_proof'] = $request->get($time.'.'.$extension);
        }
        RtiForm::create($input);
        return redirect('rti_form_success');
    }

    public function rtiFormSuccess()
    {
        return view('admin.rti_form.rtiFormSuccess');
    }

    public function rtiFormSuccessClose()
    {
        Session::flush();
        return redirect('/');
    }

    public function rtiApplicants(Request $request, DataTables $datatables)
    {
        $getData = $request->all();
        $rti_statuses = MasterRtiStatus::all();
        $columns = [
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No', 'searchable' => false],
            ['data' => 'unique_id','name' => 'unique_id','title' => 'RTI Application No.'],
            ['data' => 'created_at','name' => 'created_at','title' => 'Date of Submission'],
            ['data' => 'applicant_name','name' => 'applicant_name','title' => 'Applicant Name'],
            ['data' => 'meeting_scheduled_date','name' => 'created_at','title' => 'Meeting Scheduled Date'],
            ['data' => 'rti_status_id','name' => 'rti_status_id','title' => 'Status'],
            // ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];
        if ($datatables->getRequest()->ajax()) {
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
            $rti_applicants = RtiForm::with(['rti_schedule_meetings','master_rti_status']);

            if($request->status)
            {
                $rti_applicants = $rti_applicants->where('status', $request->status);
            }

            if($request->date_of_submission)
            {
                $rti_applicants = $rti_applicants->whereDate('created_at', '=' , date('Y-m-d' , strtotime($request->date_of_submission)));
            }
            // $rti_applicants = $rti_applicants->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').', unique_id, created_at, applicant_name, meeting_scheduled_date, id, status');

            return $datatables->of($rti_applicants->orderBy('id'))
                ->editColumn('radio', function ($rti_applicants) {
                    $url = route('view_applicant', [$rti_applicants->id]);
                    return '<label class="m-radio m-radio--primary"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="village_data_id"><span></span></label>';
                })
                ->editColumn('rownum', function ($rti_applicants) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('rti_application_no', function ($rti_applicants) {
                    return $rti_applicants->unique_id;
                })
                ->editColumn('created_at', function ($rti_applicants) {
                   return date('d-m-Y',strtotime($rti_applicants->created_at));
                })
                ->editColumn('applicant_name', function ($rti_applicants) {
                    return $rti_applicants->applicant_name;
                })
                ->editColumn('meeting_scheduled_date', function ($rti_applicants) {
                    return $rti_applicants->rti_schedule_meetings!=""?$rti_applicants->rti_schedule_meetings->meeting_scheduled_date:' - ';
                })
                ->editColumn('rti_status_id', function ($rti_applicants) {
                    return $rti_applicants->master_rti_status!=""?$rti_applicants->master_rti_status->status_title->status_title:' - ';
                })
                ->editColumn('actions', function ($rti_applicants) {
                   // return view('admin.rti_form.actions', compact('rti_applicants'))->render();
                })
                ->rawColumns(['radio', 'board_name','status','actions'])
                ->make(true);
        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
        return view('admin.rti_form.index', compact('html', 'rti_statuses', 'getData'));
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [6, "desc" ],
            "pageLength" => $this->list_num_of_records_per_page,
            // 'fixedHeader' => [
            //     'header' => true,
            //     'footer' => true
            // ]
        ];
    }

    public function show_schedule_meeting_form($id)
    {
        $rti_applicant = RtiForm::find($id);
        $rti_meetings_scheduled = RtiScheduleMeeting::where('application_no', $rti_applicant->unique_id)->orderBy('id','desc')->first();
        if($rti_meetings_scheduled){
            $rti_meetings_scheduled = $rti_meetings_scheduled;
        }
        return view('admin.rti_form.schedule_meeting', compact('rti_applicant', 'rti_meetings_scheduled'));
    }

    public function schedule_meeting(Request $request, $id)
    {
        $input = array(
            'application_no' => $request->input('application_no'),
            'meeting_scheduled_date' => $request->input('meeting_scheduled_date'),
            'meeting_venue' => $request->input('meeting_venue'),
            'meeting_time' => $request->input('meeting_time'),
            'contact_person_name' => $request->input('contact_person_name')
        );
        $applicant_exist = RtiScheduleMeeting::where('application_no', $request->input('application_no'))->get();
        $last_inserted_id = RtiScheduleMeeting::create($input);
        $update_meeting_schedule_id['rti_schedule_meeting_id'] = $last_inserted_id->id;
        RtiForm::where('unique_id', $request->input('application_no'))->where('id', $id)->update($update_meeting_schedule_id);
        return redirect('rti_applicants');
    }

    public function view_applicant($id){
        $rti_applicant = RtiForm::with(['users','master_rti_status'])->where('id', $id)->first();
        if($rti_applicant){
            $rti_applicant = $rti_applicant;
        }
        // dd($rti_applicant);
        return view('admin.rti_form.view_applicant', compact('rti_applicant'));
    }

    public function download_applicant_form($id)
    {
        
        if(RtiForm::find($id))
        {
            $application_form_data=RtiForm::find($id);
            $boards = Board::all();
            $departments = Department::all();
            //$pdf = PDF::loadView('admin.rti_form.download_applicant_form', array('boards'=>$boards, 'departments'=>$departments,'application_form_data'=>$application_form_data)); // or PDF::loadHtml($html);
            //return $pdf->download($filename); // or
            $pdf = PDF::loadView('admin.rti_form.download_applicant_form', array('boards'=>$boards, 'departments'=>$departments,'application_form_data'=>$application_form_data));
            return $pdf->download($application_form_data->unique_id.date('YmdHis').'.pdf');
            //return view('admin.rti_form.download_applicant_form', compact('id', 'boards', 'departments','application_form_data'));
        }
    }

    public function show_update_status_form($id){
        $rti_applicant = RtiForm::with(['users'])->where('id', $id)->OrderBy('id','desc')->first();
        $rti_statuses = MasterRtiStatus::all();
        return view('admin.rti_form.update_status', compact('rti_statuses', 'rti_applicant'));
    }

    public function update_status(Request $request, $id){
        //dd($request->all());
        $input = array(
            'status_id' => $request->input('status'),
            'application_id' => $id
        );
        $last_updated_status = RtiStatus::create($input);
        $update_id['rti_status_id'] = $last_updated_status->id;
        $update_id['status'] = $input['status_id'];
        RtiForm::where('unique_id', $request->input('application_no'))->where('id', $id)->update($update_id);
        return redirect('rti_applicants');
    }

    public function show_send_info_form($id){
        $rti_applicant = RtiForm::with('users', 'rti_send_info')->where('id', $id)->orderBY('id','desc')->first();
        $rti_statuses = MasterRtiStatus::all();
        $rti_applicant = $rti_applicant;
        return view('admin.rti_form.send_info_to_applicant', compact('rti_statuses', 'rti_applicant'));
    }

    public function send_info(Request $request, $id){
        $request->validate([
            'rti_comment' => 'required',
            'rti_info_file' => 'mimes:pdf',
        ]);
        $input = array(
            'application_id' => $id,
            'rti_status_id' => $request->input('status'),
            'comment' => $request->input('rti_comment'),
        );
        $uploadPath = '/uploads/rti_send_info_files';
        $destinationPath = public_path($uploadPath);

        if($request->file('rti_info_file'))
        {
            $file = $request->file('rti_info_file');
            $file_name = time().$file->getFileName().'.'.$file->getClientOriginalExtension();
            if($file->move($destinationPath, $file_name))
            {
                $input['filepath'] = $uploadPath.'/';
                $input['filename'] = $file_name;
            }
        }else
        {
            $input['filepath']=$request->uploaded_file!=""?$request->uploaded_file_path:'';
            $input['filename']=$request->uploaded_file!=""?$request->uploaded_file:'';
        }
        $last_inserted_id = RtiSendInfo::create($input);

        $updated_status = array(
            'status_id' => $request->input('status'),
            'application_id' => $id
        );
        $last_updated_status_id = RtiStatus::create($updated_status);

        $update_id['rti_status_id'] = $last_updated_status_id->id;
        $update_id['rti_send_info_id'] = $last_inserted_id->id;
        $update_id['status'] = $request->input('status');
        RtiForm::where('unique_id', $request->input('application_no'))->where('id', $id)->update($update_id);
        return redirect('rti_applicants');
    }

    public function show_forward_application_form($id){
        $rti_applicant = RtiForm::with('users', 'rti_forward_application')->where('id', $id)->first();
        $rti_statuses = MasterRtiStatus::all();
        $boards = Board::all();
        $departments = Department::all();
        return view('admin.rti_form.forward_application', compact('rti_statuses', 'rti_applicant', 'boards', 'departments'));
    }

    public function forward_application(Request $request, $id){
        $request->validate([
            'rti_remarks' => 'required',
        ]);
        $input = array(
            'application_id' => $id,
            'board_id' => $request->input('board'),
            'department_id' => $request->input('department'),
            'remarks' => $request->input('rti_remarks')
        );
        $last_inserted_id = RtiForwardApplication::create($input);
        $update_id['rti_forward_application_id'] = $last_inserted_id->id;
        $update_id['board_id'] = $request->input('board');
        $update_id['department_id'] = $request->input('department');
        RtiForm::where('unique_id', $request->input('application_no'))->where('id', $id)->update($update_id);
        return redirect('rti_applicants');
    }

    public function searchRtiForm()
    {

    }
}
