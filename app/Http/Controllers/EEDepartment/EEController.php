<?php

namespace App\Http\Controllers\EEDepartment;

use App\OlApplication;
use App\OlSocietyDocumentsMaster;
use App\OlSocietyDocumentsStatus;
use App\SocietyOfferLetter;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Config;
use DB;
use File;
use Storage;

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
//            ['data' => 'current_status_id','name' => 'current_status_id','title' => 'Status'],
//            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {

            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));

            $ee_application_data = OlApplication::with(['olApplicationStatus' => function($q){
                $q->where('user_id', Auth::user()->id)
                    ->where('role_id', session()->get('role_id'));
            }, 'eeApplicationSociety'])
            ->whereHas('olApplicationStatus', function($q){
                $q->where('user_id', Auth::user()->id)
                    ->where('role_id', session()->get('role_id'));
            });

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
            "order"=> [5, "desc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    }

    public function documentSubmittedBySociety()
    {
        $arrData['society_document'] = OlSocietyDocumentsMaster::get();
        $document_status_data = SocietyOfferLetter::with('societyDocuments')->first();

        $arrData['society_document_data'] = array_get($document_status_data,'societyDocuments')->keyBy('document_id')->toArray();

        return view('admin.ee_department.documentSubmitted', compact('arrData'));
    }

    public function getForwardApplicationForm(){
        $arrData['society_detail'] = OlApplication::with('eeApplicationSociety')->first();
        $user = User::with(['roles.parent.parentUser'])->where('id', Auth::user()->id)->first();
        $roles = array_get($user, 'roles');
        $parent = array_get($roles[0], 'parent');
        $arrData['parentData'] = array_get($parent, 'parentUser');
        $arrData['role_name'] = strtoupper(str_replace('_', ' ', $parent['name']));

        return view('admin.ee_department.forward-application', compact('arrData'));
    }

    public function forwardApplication(Request $request)
    {
        dd($request->all());
        $forward_application = [
            'application_id' => '',
            'user_id' => Auth::user()->id,
            'role_id' => session()->get('role_id'),
            'status_id' => '',
            'to_user_id' => '',
            'remark' => $request->remark,
        ];


        // insert into ol_application_status_log table
    }

    public function scrutinyRemarkByEE()
    {
        $arrData['society_detail'] = OlApplication::with('eeApplicationSociety')->first();
        $arrData['society_document'] = OlSocietyDocumentsMaster::get();
        $document_status_data = SocietyOfferLetter::with('societyDocuments')->first();

        $arrData['society_document_data'] = array_get($document_status_data,'societyDocuments')->keyBy('document_id')->toArray();
//        dd($arrData['society_document_data']);
        return view('admin.ee_department.scrutiny-remark', compact('arrData'));
    }

    public function addDocumentScrutiny(Request $request)
    {
        $uploadPath = '/uploads/EE_document_path';
        $destinationPath = public_path($uploadPath);

        $document_status = OlSocietyDocumentsStatus::find($request->document_status_id);
        $ee_document_scrutiny = [
            'comment_by_EE' => $request->remark,
        ];

        $time = time();
        if($request->hasFile('EE_document_path')) {
            $extension = $request->file('EE_document_path')->getClientOriginalExtension();
            $file = $request->file('EE_document_path');

            if ($extension == "pdf") {
                $name = File::name($request->file('EE_document_path')->getClientOriginalName()) . '_' . $time . '.' . $extension;
//                $path = Storage::putFileAs('/EE_document_path', $request->file('EE_document'), $name, 'public');
                if($file->move($destinationPath, $name))
                {
                    $ee_document_scrutiny['EE_document_path'] = $uploadPath.'/'.$name;
                }
            } else {
                return redirect()->back()->with('error','Invalid type of file uploaded (only pdf allowed)');
            }

        }

        $document_status->update($ee_document_scrutiny);

        return redirect()->back();
        //insert into ol_society_document_status table
    }

    public function getDocumentScrutinyData(Request $request)
    {
        $documentStatusData = OlSocietyDocumentsStatus::find($request->documentStatusId);

        return $documentStatusData;
    }

    public function editDocumentScrutiny(Request $request, $id)
    {
        $document_status = OlSocietyDocumentsStatus::find($id);

        $ee_document_scrutiny = [
            'comment_by_EE' => $request->comment_by_EE,
        ];

        $uploadPath = '/uploads/EE_document_path';
        $destinationPath = public_path($uploadPath);
        // dd($request->file('document_name'));

        $time = time();
        if($request->hasFile('EE_document')) {
            $extension = $request->file('EE_document')->getClientOriginalExtension();
            $file = $request->file('EE_document');

            if ($extension == "pdf") {
                unlink(public_path($request->oldFileName));
                $name = File::name($request->file('EE_document')->getClientOriginalName()) . '_' . $time . '.' . $extension;
//                $path = Storage::putFileAs('/EE_document_path', $request->file('EE_document'), $name, 'public');
                if($file->move($destinationPath, $name))
                {
                    $ee_document_scrutiny['EE_document_path'] = $uploadPath.'/'.$name;
                }
            } else {
                return redirect()->back()->with('error','Invalid type of file uploaded (only pdf allowed)');
            }

        }
        else
        {
            $ee_document_scrutiny['EE_document_path'] = $request->oldFileName;
        }

        $document_status->update($ee_document_scrutiny);

        return redirect()->back();

        //insert into ol_society_document_status table
    }


    public function deleteDocumentScrutiny(Request $request, $id)
    {
        $data = [
            'comment_by_EE' => '',
            'EE_document_path' => '',
            'deleted_comment_by_EE' => $request->remark
        ];
        unlink(public_path($request->fileName));
        $document_delete = OlSocietyDocumentsStatus::find($id);

        $document_delete->update($data);

        return redirect()->back();
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
