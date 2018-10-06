<?php

namespace App\Http\Controllers\EEDepartment;

use App\EENote;
use App\Http\Controllers\Common\CommonController;
use App\OlApplication;
use App\OlApplicationStatus;
use App\OlChecklistScrutiny;
use App\OlConsentVerificationDetails;
use App\OlConsentVerificationQuestionMaster;
use App\OlDemarcationVerificationDetails;
use App\OlDemarcationVerificationQuestionMaster;
use App\OlRelocationVerificationDetails;
use App\OlRgRelocationVerificationQuestionMaster;
use App\OlSocietyDocumentsMaster;
use App\OlSocietyDocumentsStatus;
use App\OlTitBitVerificationDetails;
use App\OlTitBitVerificationQuestionMaster;
use App\Role;
use App\SocietyOfferLetter;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;
use Config;
use DB;
use File;
use Storage;

class EEController extends Controller
{
    public function __construct()
    {
        $this->comman = new CommonController();
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
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no', 'name' => 'eeApplicationSociety.building_no', 'title' => 'Building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address'],
//            ['data' => 'model','name' => 'model','title' => 'Model'],
            ['data' => 'Status','name' => 'current_status_id','title' => 'Status'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {

            $ee_application_data =  $this->comman->listApplicationData($request);

            return $datatables->of($ee_application_data)
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++; return $i;
                })
                ->editColumn('eeApplicationSociety.name', function ($listArray) {
                    return $listArray->eeApplicationSociety->name;
                })
                ->editColumn('eeApplicationSociety.building_no', function ($listArray) {
                    return $listArray->eeApplicationSociety->building_no;
                })
                ->editColumn('eeApplicationSociety.address', function ($listArray) {
                    return $listArray->eeApplicationSociety->address;
                })
                ->editColumn('Status', function ($listArray) use ($request) {
                    $status = $listArray->olApplicationStatusForLoginListing[0]->status_id;

                    if($request->update_status)
                    {
                        if($request->update_status == $status){
                            $config_array = array_flip(config('commanConfig.applicationStatus'));
                            $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                            return $value;
                        }
                    }else{
                        $config_array = array_flip(config('commanConfig.applicationStatus'));
                        $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                        return $value;
                    }

                })
                ->editColumn('submitted_at', function ($listArray) {
                    return date(config('commanConfig.dateFormat'), strtotime($listArray->submitted_at));
                })
                ->editColumn('actions', function ($ee_application_data) use($request) {
                    return view('admin.ee_department.actions', compact('ee_application_data', 'request'))->render();
                })
                ->rawColumns(['society_name', 'actions', 'society_building_no', 'society_address', 'Status', 'submitted_at'])
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
            "order"=> [7, "desc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    }

    public function documentSubmittedBySociety($applicationId)
    {
        $societyDocument = $this->comman->getSocietyEEDocuments($applicationId);
        return view('admin.ee_department.documentSubmitted', compact('societyDocument'));
    }

    public function getForwardApplicationForm($application_id){
        $arrData['society_detail'] = OlApplication::with('eeApplicationSociety')->where('id', $application_id)->first();

        $parentData = $this->comman->getForwardApplicationParentData();
        $arrData['parentData'] = $parentData['parentData'];
        $arrData['role_name'] = $parentData['role_name'];
//        $arrData['application_status'] = $this->comman->getCurrentApplicationStatus($application_id);


        $society_role_id = Role::where('name', config('commanConfig.society_offer_letter'))->first();

        if(session()->get('role_name') != config('commanConfig.ee_junior_engineer')) {
            $child_role_id = Role::where('id', session()->get('role_id'))->get(['child_id']);
            $result = json_decode($child_role_id[0]->child_id);
            $status_user = OlApplicationStatus::where(['application_id' => $application_id])->pluck('user_id')->toArray();

            $final_child = User::with('roles')->whereIn('id', array_unique($status_user))->whereIn('role_id', $result)->get();

            $arrData['application_status'] = $final_child;
        }

        // DyCE Junior Forward Application
        $dyce_role_id = Role::where('name', '=', config('commanConfig.dyce_jr_user'))->first();

        $arrData['get_forward_dyce'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                                                ->where('lu.layout_id', session()->get('layout_id'))
                                                ->where('role_id', $dyce_role_id->id)->get();

        $arrData['dyce_role_name'] = strtoupper(str_replace('_', ' ', $dyce_role_id->name));

        return view('admin.ee_department.forward-application', compact('arrData', 'society_role_id'));
    }

    public function forwardApplication(Request $request)
    {
        if($request->check_status == 1) {
            $forward_application = [[
                'application_id' => $request->application_id,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.forwarded'),
                'to_user_id' => $request->to_user_id,
                'to_role_id' => $request->to_role_id,
                'remark' => $request->remark,
                'created_at' => Carbon::now()
            ],

            [
                'application_id' => $request->application_id,
                'user_id' => $request->to_user_id,
                'role_id' => $request->to_role_id,
                'status_id' => config('commanConfig.applicationStatus.in_process'),
                'to_user_id' => NULL,
                'to_role_id' => NULL,
                'remark' => $request->remark,
                'created_at' => Carbon::now()
            ]
            ];

//            echo "in forward";
//            dd($forward_application);
            OlApplicationStatus::insert($forward_application);
        }
        else{
            /*if(session()->get('role_name') == config('commanConfig.ee_junior_engineer'))
            {
                $society_user_data = OlApplicationStatus::where('application_id', $request->application_id)
                                                        ->where('society_flag', 1)
                                                        ->orderBy('id', 'desc')->get();                                     
                $revert_application = [
                    [
                        'application_id' => $request->application_id,
                        'society_flag' => 0,
                        'user_id' => Auth::user()->id,
                        'role_id' => session()->get('role_id'),
                        'status_id' => config('commanConfig.applicationStatus.reverted'),
                        'to_user_id' => $society_user_data[0]->user_id,
                        'to_role_id' => $society_user_data[0]->role_id,
                        'remark' => $request->remark,
                        'created_at' => Carbon::now()
                    ],

                    [
                        'application_id' => $request->application_id,
                        'society_flag' => 1,
                        'user_id' => $society_user_data[0]->user_id,
                        'role_id' => $society_user_data[0]->role_id,
                        'status_id' => config('commanConfig.applicationStatus.reverted'),
                        'to_user_id' => NULL,
                        'to_role_id' => NULL,
                        'remark' => $request->remark,
                        'created_at' => Carbon::now()
                    ]
                ];
            }
            else
            {*/
                $revert_application = [
                    [
                        'application_id' => $request->application_id,
                        'user_id' => Auth::user()->id,
                        'role_id' => session()->get('role_id'),
                        'society_flag' => 0,
                        'status_id' => config('commanConfig.applicationStatus.reverted'),
                        'to_user_id' => $request->to_child_id,
                        'to_role_id' => $request->to_role_id,
                        'remark' => $request->remark,
                        'created_at' => Carbon::now()
                    ],

                    [
                        'application_id' => $request->application_id,
                        'user_id' => $request->to_child_id,
                        'role_id' => $request->to_role_id,
                        'society_flag' => $request->society_flag,
                        'status_id' => config('commanConfig.applicationStatus.in_process'),
                        'to_user_id' => NULL,
                        'to_role_id' => NULL,
                        'remark' => $request->remark,
                        'created_at' => Carbon::now()
                    ]
                ];
//            }

//            echo "in revert";
//            dd($revert_application);
            OlApplicationStatus::insert($revert_application);
        }

        return redirect('/ee')->with('success','Application send successfully.');

        // insert into ol_application_status_log table
    }

    public function scrutinyRemarkByEE($application_id, $society_id)
    {

        $application_master_id = OlApplication::where('society_id', $society_id)->value('application_master_id');
        $arrData['society_document'] = OlSocietyDocumentsMaster::where('application_id', $application_master_id)->get();       
        // Document Scrutiny
        $arrData['society_detail'] = OlApplication::with('eeApplicationSociety')->where('id', $application_id)->first();
        // $arrData['society_document'] = OlSocietyDocumentsMaster::get();
        $document_status_data = SocietyOfferLetter::with('societyDocuments')->where('id', $society_id)->first();
        $arrData['society_document_data'] = array_get($document_status_data,'societyDocuments')->keyBy('document_id')->toArray();
//        dd($arrData['society_document_data']);

        // Consent Scrutiny

        $arrData['consent_verification_question'] = OlConsentVerificationQuestionMaster::all();
        $arrData['consent_verification_checkist_data'] = OlChecklistScrutiny::where('application_id', $application_id)
                                                                                ->where('verification_type', 'CONSENT VERIFICATION')
                                                                                ->first();
        $arrData['consent_verification_details_data'] = OlConsentVerificationDetails::where('application_id', $application_id)->get()->keyBy('question_id')->toArray();

        // Demarcation Scrutiny

        $arrData['demarcation_question'] = OlDemarcationVerificationQuestionMaster::all();
        $arrData['demarcation_checkist_data'] = OlChecklistScrutiny::where('application_id', $application_id)
                                                                        ->where('verification_type', 'DEMARCATION')
                                                                        ->first();
        $arrData['demarcation_details_data'] = OlDemarcationVerificationDetails::where('application_id', $application_id)->get()->keyBy('question_id')->toArray();

        // Tit-Bit Scrutiny

        $arrData['tit_bit_question'] = OlTitBitVerificationQuestionMaster::all();
        $arrData['tit_bit_checkist_data'] = OlChecklistScrutiny::where('application_id', $application_id)
                                                                        ->where('verification_type', 'TIT BIT')
                                                                        ->first();
        $arrData['tit_bit_details_data'] = OlTitBitVerificationDetails::where('application_id', $application_id)->get()->keyBy('question_id')->toArray();


        // R.G Relocation

        $arrData['rg_question'] = OlRgRelocationVerificationQuestionMaster::all();
        $arrData['rg_checkist_data'] = OlChecklistScrutiny::where('application_id', $application_id)
            ->where('verification_type', 'RG RELOCATION')
            ->first();
        $arrData['rg_details_data'] = OlRelocationVerificationDetails::where('application_id', $application_id)->get()->keyBy('question_id')->toArray();

        // EE Note download

        $arrData['eeNote'] = EENote::where('application_id', $application_id)->orderBy('id', 'desc')->first();

        // Get Application last Status
        // dd($arrData);
        $arrData['get_last_status'] = OlApplicationStatus::where([
                'application_id' =>  $application_id,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id')
            ])->orderBy('id', 'desc')->first();

        return view('admin.ee_department.scrutiny-remark', compact('arrData'));
    }

    public function addDocumentScrutiny(Request $request)
    {
        $document_status = OlSocietyDocumentsStatus::find($request->document_status_id);
        $ee_document_scrutiny = [
            'comment_by_EE' => $request->remark,
        ];

        $time = time();
        if($request->hasFile('EE_document_path')) {
            $extension = $request->file('EE_document_path')->getClientOriginalExtension();
            $file = $request->file('EE_document_path');

            if ($extension == "pdf") {

                $folder_name = "EE_document_path";
                $name = 'ee_note_' . $time . '.' . $extension;
                $path = $folder_name."/".$name;

                $fileUpload = $this->comman->ftpFileUpload($folder_name,$request->file('EE_document_path'),$name);
                $ee_document_scrutiny['EE_document_path'] = $path;
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

        $time = time();

        if($request->hasFile('EE_document')) {
            $extension = $request->file('EE_document')->getClientOriginalExtension();
            $file = $request->file('EE_document');

            if ($extension == "pdf") {
                Storage::disk('ftp')->delete($request->oldFileName);
                $name = 'ee_note_' . $time . '.' . $extension;
                $folder_name = "EE_document_path";
                $Filepath = $folder_name."/".$name;

                $fileUpload1 = $this->comman->ftpFileUpload($folder_name,$request->file('EE_document'),$name);                
                $fileUpload = $ee_document_scrutiny['EE_document_path'] = $Filepath;
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


    // Consent Verification

    public function consentVerification(Request $request)
    {
        OlChecklistScrutiny::where('application_id', $request->application_id)
                                ->where('verification_type', 'CONSENT VERIFICATION')
                                ->delete();
        OlConsentVerificationDetails::where('application_id', $request->application_id)->delete();
        $ee_checklist_scrutiny = [
            'application_id' => $request->application_id,
            'user_id' => Auth::user()->id,
            'verification_type' => 'CONSENT VERIFICATION',
            'layout' => $request->layout,
            'details_of_notice' => $request->details_of_notice,
            'investigation_officer_name' => $request->investigation_officer_name,
            'date_of_investigation' => date('Y-m-d H:i:s', strtotime($request->date_of_investigation))
        ];

        // insert into ol_application_checklist_scrunity_details table

        OlChecklistScrutiny::insert($ee_checklist_scrutiny);

        foreach($request->question_id as $key => $consent_data) {
            $ee_consent_verification[] = [
                'application_id' => $request->application_id,
                'user_id' => Auth::user()->id,
                'question_id' => isset($request->question_id[$key]) ? $request->question_id[$key] : NULL,
                'answer' => isset($request->answer[$key]) ? $request->answer[$key] : NULL,
                'remark' => isset($request->remark[$key]) ? $request->remark[$key] : NULL
            ];
        }
        // insert into ol_consent_verification_details table

        OlConsentVerificationDetails::insert($ee_consent_verification);

        return redirect()->back();
    }

    public function eeDemarcation(Request $request)
    {
        OlChecklistScrutiny::where('application_id', $request->application_id)
                                ->where('verification_type', 'DEMARCATION')
                                ->delete();
        OlDemarcationVerificationDetails::where('application_id', $request->application_id)->delete();

        $ee_checklist_scrutiny = [
            'application_id' => $request->application_id,
            'user_id' => Auth::user()->id,
            'verification_type' => 'DEMARCATION',
            'layout' => $request->layout,
            'details_of_notice' => $request->details_of_notice,
            'investigation_officer_name' => $request->investigation_officer_name,
            'date_of_investigation' => date('Y-m-d H:i:s', strtotime($request->date_of_investigation))
        ];

        OlChecklistScrutiny::insert($ee_checklist_scrutiny);

        foreach($request->question_id as $key => $consent_data) {
            $ee_demarcation[] = [
                'application_id' => $request->application_id,
                'user_id' => Auth::user()->id,
                'question_id' => isset($request->question_id[$key]) ? $request->question_id[$key] : NULL,
                'answer' => isset($request->answer[$key]) ? $request->answer[$key] : NULL,
                'remark' => isset($request->remark[$key]) ? $request->remark[$key] : NULL
            ];
        }

        OlDemarcationVerificationDetails::insert($ee_demarcation);

        return redirect()->back();
    }

    public function titBit(Request $request)
    {
        OlChecklistScrutiny::where('application_id', $request->application_id)
            ->where('verification_type', 'TIT BIT')
            ->delete();
        OlTitBitVerificationDetails::where('application_id', $request->application_id)->delete();

        $ee_checklist_scrutiny = [
            'application_id' => $request->application_id,
            'user_id' => Auth::user()->id,
            'verification_type' => 'TIT BIT',
            'layout' => $request->layout,
            'details_of_notice' => $request->details_of_notice,
            'investigation_officer_name' => $request->investigation_officer_name,
            'date_of_investigation' => date('Y-m-d H:i:s', strtotime($request->date_of_investigation))
        ];

        OlChecklistScrutiny::insert($ee_checklist_scrutiny);

        foreach($request->question_id as $key => $consent_data) {
            $ee_tit_bit[] = [
                'application_id' => $request->application_id,
                'user_id' => Auth::user()->id,
                'question_id' => isset($request->question_id[$key]) ? $request->question_id[$key] : NULL,
                'answer' => isset($request->answer[$key]) ? $request->answer[$key] : NULL,
                'remark' => isset($request->remark[$key]) ? $request->remark[$key] : NULL
            ];
        }

        OlTitBitVerificationDetails::insert($ee_tit_bit);

        return redirect()->back();
    }

    public function rgRelocation(Request $request)
    {
        OlChecklistScrutiny::where('application_id', $request->application_id)
            ->where('verification_type', 'RG RELOCATION')
            ->delete();
        OlRelocationVerificationDetails::where('application_id', $request->application_id)->delete();

        $ee_checklist_scrutiny = [
            'application_id' => $request->application_id,
            'user_id' => Auth::user()->id,
            'verification_type' => 'RG RELOCATION',
            'layout' => $request->layout,
            'details_of_notice' => $request->details_of_notice,
            'investigation_officer_name' => 'TEST',
            'date_of_investigation' => date('Y-m-d H:i:s')
        ];

        OlChecklistScrutiny::insert($ee_checklist_scrutiny);

        foreach($request->question_id as $key => $consent_data) {
            $rg_relocation[] = [
                'application_id' => $request->application_id,
                'user_id' => Auth::user()->id,
                'question_id' => isset($request->question_id[$key]) ? $request->question_id[$key] : NULL,
                'answer' => isset($request->answer[$key]) ? $request->answer[$key] : NULL,
                'remark' => isset($request->remark[$key]) ? $request->remark[$key] : NULL
            ];
        }

        OlRelocationVerificationDetails::insert($rg_relocation);

        return redirect()->back();
    }

    public function uploadEENote(Request $request){
        $applicationId   = $request->application_id;
        $uploadPath      = '/uploads/ee_note';
        $destinationPath = public_path($uploadPath);

        if ($request->file('ee_note')){

            $file = $request->file('ee_note');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'ee_note.'.$extension;
            $folder_name = "ee_note";
            $path = $folder_name."/".$file_name;

            if($extension == "pdf") {

                $fileUpload = $this->comman->ftpFileUpload($folder_name,$request->file('ee_note'),$file_name);

                    $fileData[] = array('document_path' => $path,
                        'application_id' => $applicationId,
                        'user_id' => Auth::user()->id,
                        'role_id' => session()->get('role_id'));

                $data = EENote::insert($fileData);
                return redirect('/ee')->with('success', 'EE Note uploaded successfully');
            }
            else
            {
                return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
            }
        }
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
