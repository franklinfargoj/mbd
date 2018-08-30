<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Board;
use App\Department;
use App\RtiForm;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\rti\RtiFormSubmitRequest;
use App\Http\Requests\rti\SearchRtiFrontendRequest;
use Yajra\DataTables\DataTables;
use Config;


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
        dd($input);
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
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No', 'searchable' => false],
            ['data' => 'unique_id','name' => 'unique_id','title' => 'RTI Application No.'],
            ['data' => 'created_at','name' => 'created_at','title' => 'Date of Submission'],
            ['data' => 'applicant_name','name' => 'applicant_name','title' => 'Applicant Name'],
            ['data' => 'created_at','name' => 'created_at','title' => 'Meeting Scheduled Date'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {
            
            $rti_applicants = RtiForm::all();
            
            return $datatables->of($rti_applicants)
                ->editColumn('rownum', function ($rti_applicants) {
                    return $rti_applicants->id;
                })
                ->editColumn('rti_application_no', function ($rti_applicants) {
                    return $rti_applicants->unique_id;
                })
                ->editColumn('created_at', function ($rti_applicants) {
                   return $rti_applicants->created_at;
                })
                ->editColumn('applicant_name', function ($rti_applicants) {
                    return $rti_applicants->applicant_name;
                })
                ->editColumn('created_at', function ($rti_applicants) {
                    return $rti_applicants->created_at;
                })
                ->editColumn('actions', function ($rti_applicants) {
                   return view('admin.rti_form.actions', compact('rti_applicants'))->render();
                    // return $rti_applicants->created_at;
                })
                ->rawColumns(['board_name','status','actions'])
                ->make(true);
        }
        
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
        return view('admin.rti_form.index', compact('html'));
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [5, "desc" ],
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
        return view('admin.rti_form.schedule_meeting', compact('rti_applicant'));
    }

    public function schedule_meeting(Request $request)
    {
        dd($request);
    }

    public function searchRtiForm()
    {

    }
}
