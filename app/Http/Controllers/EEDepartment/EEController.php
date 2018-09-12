<?php

namespace App\Http\Controllers\EEDepartment;

use App\OlApplication;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Config;
use DB;

class EEController extends Controller
{
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
        $getData = $request->all();

        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'submitted_at','name' => 'submitted_at','title' => 'Date'],
            ['data' => 'society_name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'society_building_no', 'name' => 'eeApplicationSociety.building_no', 'title' => 'Building No'],
            ['data' => 'society_address','name' => 'eeApplicationSociety.address','title' => 'Address'],
//            ['data' => 'model','name' => 'model','title' => 'Model'],
            ['data' => 'current_status_id','name' => 'current_status_id','title' => 'Status'],
//            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {

            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));

            $ee_application_data = OlApplication::with('eeApplicationSociety');

            /*if($request->office_date_from)
            {
                $hearing_data = $hearing_data->whereDate('office_date', '>=', date('Y-m-d', strtotime($request->office_date_from)));
            }

            if($request->office_date_to)
            {
                $hearing_data = $hearing_data->whereDate('office_date', '<=', date('Y-m-d', strtotime($request->office_date_to)));
            }*/

            $ee_application_data = $ee_application_data->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').', application_no, ol_applications.id as id, submitted_at, society_id, current_status_id');

            return $datatables->of($ee_application_data)
                ->editColumn('society_name', function ($ee_application_data) {
                    return $ee_application_data->eeApplicationSociety->name;
                })
                ->editColumn('society_building_no', function ($ee_application_data) {
                    return $ee_application_data->eeApplicationSociety->building_no;
                })
                ->editColumn('society_address', function ($ee_application_data) {
                    return $ee_application_data->eeApplicationSociety->address;
                })
//                ->editColumn('actions', function ($hearing_data) {
//                    return view('admin.hearing.actions', compact('hearing_data'))->render();
//                })
                ->rawColumns(['society_name', 'society_building_no', 'society_address'])
                ->make(true);
        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.ee_department.index', compact('html','header_data','getData'));
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

    public function documentSubmittedBySociety()
    {
        return view('admin.ee_department.documentSubmitted');
    }

    public function forwardApplication(Request $request ,$id)
    {
        $forward_application = [
            'application_id' => $id,
            'user_id' => Auth::user()->id,
            'role_id' => session()->get('role_id'),
            'status_id' => '',
            'to_user_id' => '',
            'remark' => $request->remark,
        ];


        // insert into ol_application_status_log table
    }

    public function addDocumentScrutiny(Request $request)
    {
        $ee_document_scrutiny = [
            'society_id' => '',
            'document_id' => '',
            'society_document_path' => '',
            'EE_document_path' => '',
            'comment_by_EE' => $request->remark,
        ];

        //insert into ol_society_document_status table
    }

    public function editDocumentScrutiny(Request $request)
    {
        $ee_document_scrutiny = [
            'society_id' => '',
            'document_id' => '',
            'society_document_path' => '',
            'EE_document_path' => '',
            'comment_by_EE' => $request->remark,
        ];

        //insert into ol_society_document_status table
    }

    public function consentVerification(Request $request)
    {
        $ee_checklist_scrutiny = [
            'application_id' => '',
            'user_id' => Auth::user()->id,
            'verification_type' => 'CONSENT VERIFICATION',
            'layout' => $request->layout,
            'details_of_notice' => $request->details_of_notice,
            'investigation_officer_name' => $request->investigation_officer_name,
            'date_of_investigation' => $request->date_of_investigation
        ];

        // insert into ol_application_checklist_scrunity_details table

        $ee_consent_verification = [
            'application_id' => '',
            'user_id' => Auth::user()->id,
            'question_id' => $request->question_id,
            'answer' => $request->answer,
            'remark' => $request->remark
        ];

        // insert into ol_consent_verification_details table

        $ee_demarcation = [
            'application_id' => '',
            'user_id' => Auth::user()->id,
            'question_id' => $request->question_id,
            'answer' => $request->answer,
            'remark' => $request->remark
        ];

        // insert into ol_demarcation_details table

        $ee_tit_bit = [
            'application_id' => '',
            'user_id' => Auth::user()->id,
            'question_id' => $request->question_id,
            'answer' => $request->answer,
            'remark' => $request->remark
        ];

        // insert into ol_tit_bit_details table

        $ee_rg_location = [
            'application_id' => '',
            'user_id' => Auth::user()->id,
            'question_id' => $request->question_id,
            'answer' => $request->answer,
            'remark' => $request->remark
        ];

        // insert into ol_rg_relocation_details table
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
