<?php

namespace App\Http\Controllers;

use App\ApplicationStatusMaster;
use App\conveyance\RenewalApplication;
use App\conveyance\RenewalApplicationLog;
use App\conveyance\RenewalDocumentStatus;
use App\conveyance\RenewalSocietyDocumentComment;
use App\conveyance\RenewalAgreementComments;
use App\SocietyConveyance;
use App\SocietyOfferLetter;
use Session;
use App\OlApplication;
use Yajra\DataTables\DataTables;
use Auth;
use App\Http\Controllers\Common\CommonController;
use Config;
use Maatwebsite\Excel\Facades\Excel;
use File;
use App\LayoutUser;
use App\MasterLayout;
use App\Role;
use App\RoleUser;
use App\User;
use App\conveyance\scApplication;
use App\conveyance\SocietyConveyanceDocumentMaster;
use App\conveyance\SocietyConveyanceDocumentStatus;
use App\conveyance\SocietyBankDetails;
use App\conveyance\scApplicationType;
use Storage;
use Mpdf\Mpdf;
use App\conveyance\scRegistrationDetails;
use App\Http\Controllers\conveyance\conveyanceCommonController;
use App\Http\Controllers\conveyance\renewalCommonController;
use App\MasterTenantType;
use DB;

use Illuminate\Http\Request;

class SocietyRenewalController extends Controller
{
    protected $list_num_of_records_per_page;

    public function __construct()
    {
        $this->CommonController = new CommonController();
        $this->conveyance_common = new conveyanceCommonController();
        $this->renewal_common = new renewalCommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    /**
     * Display a listing of the resource.
     * Author: Amar Prajapati
     * @return \Illuminate\Http\Response
     */
    public function index(DataTables $datatables, Request $request)
    {
        $columns = [
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application No.'],
            ['data' => 'application_master_id','name' => 'application_master_id','title' => 'Application Type'],
            ['data' => 'created_at','name' => 'created_date','title' => 'Submission Date', 'class' => 'datatable-date'],
            ['data' => 'status','name' => 'status','title' => 'Status'],
        ];
        $getRequest = $request->all();
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $ol_application_count = count(SocietyConveyance::where('society_id', $society_details->id)->get());
        if ($datatables->getRequest()->ajax()) {
            $sr_applications = RenewalApplication::where('society_id', $society_details->id)->with(['srApplicationType' => function($q){
                $q->where('application_type', config('commanConfig.applicationType.Renewal'))->first();
            }, 'srApplicationLog' => function($q){
                $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
            } ])->orderBy('id', 'desc');

            if($request->application_master_id)
            {
                $sr_applications = $sr_applications->where('application_master_id', 'like', '%'.$request->application_master_id.'%');
            }
            $sr_applications = $sr_applications->get();

            Session::put('sr_application_count', count($sr_applications));

            return $datatables->of($sr_applications)
                ->editColumn('radio', function ($sr_applications) {
                    $url = route('society_renewal.show', encrypt($sr_applications->id));
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="sr_applications_id"><span></span></label>';
                })
                ->editColumn('rownum', function ($sr_applications) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('application_no', function ($sr_applications) {
                    return $sr_applications->application_no;
                })
                ->editColumn('application_master_id', function ($sr_applications) {
                    return $sr_applications->srApplicationType->application_type;
                })
                ->editColumn('created_at', function ($sr_applications) {
                    return date(config('commanConfig.dateFormat'), strtotime($sr_applications->created_at));
                })
                ->editColumn('status', function ($sr_applications) {
                    $status_display = '';
                    if($sr_applications->application_status == config('commanConfig.renewal_status.Send_society_to_pay_stamp_duty')){
                        $status_display = 'Pay Stamp Duty';
                    }elseif($sr_applications->application_status == config('commanConfig.renewal_status.Send_society_for_registration_of_Lease_deed')){
                        $status_display = 'Register Lease Deed';
                    }else{
                        $status = explode('_', array_keys(config('commanConfig.renewal_status'), $sr_applications->srApplicationLog->status_id)[0]);
                        foreach($status as $status_value){ $status_display .= ucwords($status_value). ' ';}
                        $status_color = '';
                        if($status_display == 'Sent To Society ' ){
                            $status_display = 'Approved';
                        }
                    }

                    return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$sr_applications->srApplicationLog->status_id) .' m-badge--wide">'.$status_display.'</span>';
                })
                ->rawColumns(['radio', 'application_no', 'application_master_id', 'created_at','status'])
                ->make(true);
        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
        return view('frontend.society.conveyance.index', compact('html'));
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [0, "desc" ],
            "pageLength" => $this->list_num_of_records_per_page,
            // 'fixedHeader' => [
            //     'header' => true,
            //     'footer' => true
            // ]
            "filter" => [
                'class' => 'test_class'
            ]
        ];
    }

    /**
     * Show the form for creating a new resource.
     * Author: Amar Prajapati
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $sc = new SocietyConveyance;
        $fillable_field_names = $sc->getFillable();
        if(in_array('language_id', $fillable_field_names) == true || in_array('society_id', $fillable_field_names) == true){
            $field_name = array_flip($fillable_field_names);
            unset($field_name['language_id'], $field_name['society_id'], $field_name['template_file']);
            $fields_names = array_flip($field_name);
            $field_names = array_values($fields_names);
        }
        $comm_func = $this->CommonController;

        $role_id = Role::where('name', config('commanConfig.dycdo_engineer'))->first();
        $user_ids = RoleUser::where('role_id', $role_id->id)->pluck('user_id');

        $layouts = MasterLayout::whereHas('layoutuser', function($q)use($user_ids){ $q->whereIn('user_id', $user_ids); })->get();
        $application_master_id = scApplicationType::where('application_type', config('commanConfig.applicationType.Renewal'))->first();
        $master_tenant_type = MasterTenantType::all();

        return view('frontend.society.renewal.add', compact('layouts', 'field_names', 'society_details', 'comm_func', 'application_master_id', 'master_tenant_type'));
    }

    /**
     * Store a newly created resource in storage.
     * Author: Amar Prajapati
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->flash();
        $error = array(
            'error' => "Excel file headers doesn't match."
        );
        if($request->file('template')) {
            $file = $request->file('template');
            $file_name = time() . $file->getFileName() . '.' . $file->getClientOriginalExtension();
            $extension = $request->file('template')->getClientOriginalExtension();
            $request->flash();
            if ($extension == "xls") {
                $time = time();
                $name = File::name(str_replace(' ', '_',$request->file('template')->getClientOriginalName())) . '_' . $time . '.' . $extension;
                $folder_name = "society_renewal_documents";
                $path = '/' . $folder_name . '/' . $name;
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name, $request->file('template'), $name);
                $count = 0;
                $sc_excel_headers = [];
                Excel::load($request->file('template')->getRealPath(), function ($reader)use(&$count, &$sc_excel_headers) {
                    if(count($reader->toArray()) > 0){
                        $excel_headers = $reader->first()->keys()->toArray();
                        $sc_excel_headers = config('commanConfig.sc_excel_headers');

                        foreach($excel_headers as $excel_headers_key => $excel_headers_val){
                            if(isset($sc_excel_headers[$excel_headers_key])){
                                $excel_headers_value = strtolower(str_replace(str_split('\\/- '), '_', $sc_excel_headers[$excel_headers_key]));
                                if($excel_headers_value == $excel_headers_val){
                                    $count++;
                                }else{
                                    $exploded = explode('_', $excel_headers_value);
                                    foreach($exploded as $exploded_key => $exploded_value){
                                        if(!empty(strpos($excel_headers_val, $exploded_value))){
                                            $count++;
                                        }
                                    }
                                }
                            }
                        }
                    }
                });

                if($count != 0){
                    if($count == count($sc_excel_headers)){
                        $input = $request->all();
                        $input['first_flat_issue_date'] = date('Y-m-d', strtotime($request->first_flat_issue_date));
                        $input['society_registration_date'] = date('Y-m-d', strtotime($request->society_registration_date));
                        $input['template_file'] = $path;
                        unset($input['layout_id'], $input['template'], $input['_token'], $input['sc_application_master_id']);

                        $sc = new SocietyConveyance;
                        $sc_application_form =  $sc->getFillable();

                        $sc_form_last_id = '';
                        $sc_appn = new scApplication;
                        $sc_application = array_slice($sc_appn->getFillable(), 0, 5);

                        $input_sc_application = array(
                            "application_master_id" => $request->sc_application_master_id,
                            "form_request_id" => $sc_form_last_id,
                            "layout_id" => $request->layout_id,
                            "society_id" => $request->society_id,
                            "application_no" => str_pad($sc_form_last_id, 5, '0', STR_PAD_LEFT),
                        );
                        $sc_application_last_id = '';
                        $role_id = Role::where('name', config('commanConfig.dycdo_engineer'))->first();
                        $user_ids = RoleUser::where('role_id', $role_id->id)->get();
                        $layout_user_ids = LayoutUser::where('layout_id', $request->input('layout_id'))->whereIn('user_id', $user_ids)->get();

                        foreach ($layout_user_ids as $key => $value) {
                            $select_user_ids[] = $value['user_id'];
                        }
                        $users = User::whereIn('id', $select_user_ids)->get();

                        if(count($sc_application_form) > count($input) && count($sc_application) == count($input_sc_application) && count($users) > 0){
                            $insert_arr = array(
                                'users' => $users
                            );
                            $input_id = SocietyConveyance::create($input);
                            $input_sc_application['application_no'] = config('commanConfig.mhada_code').str_pad($input_id->id, 5, '0', STR_PAD_LEFT);
                            $input_sc_application['form_request_id'] = $input_id->id;

                            $sc_application = RenewalApplication::create($input_sc_application);
                            $inserted_application_log = $this->CommonController->sr_application_status_society($insert_arr, config('commanConfig.applicationStatus.pending'), $sc_application);

                            $sc_document_status = new RenewalDocumentStatus;
                            $sc_document_status_arr = array_flip($sc_document_status->getFillable());
                            $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Renewal'))->value('id');
                            $document_id = $this->conveyance_common->getDocumentId(config('commanConfig.documents.society.list_of_members_from_society'), $application_type);

                            $sc_document_status_arr['application_id'] = $sc_application->id;
                            $sc_document_status_arr['user_id'] = auth()->user()->id;
                            $sc_document_status_arr['society_flag'] = 1;
                            $sc_document_status_arr['document_id'] = $document_id;
                            $sc_document_status_arr['document_path'] = $path;

                            $renewal_document_status = RenewalDocumentStatus::create($sc_document_status_arr);

                            if(!empty($renewal_document_status->id)){
                                return redirect()->route('society_renewal.show', encrypt($sc_application->id));
                            }
                        }
                    }else{
                        return redirect()->route('society_renewal.create')->with('error', "Excel file headers doesn't match.")->withInput();
                    }
                }else{
                    return redirect()->route('society_renewal.create')->with('error', "Excel file headers doesn't match.")->withInput();
                }
            }
        }else{
            return redirect()->route('society_renewal.create')->with('error', "Excel file headers doesn't match.")->withInput();
        }
    }

    /**
     * Display the specified resource.
     * Author: Amar Prajapati
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = decrypt($id);

        $sc_application = RenewalApplication::with(['sr_form_request' => function($q){
            $q->with('scheme_names');
        }, 'societyApplication', 'applicationLayout', 'srApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->where('id', $id)->first();

        $documents = SocietyConveyanceDocumentMaster::with(['sr_document_status' => function($q) use($sc_application) { $q->where('application_id', $sc_application->id)->get(); }])->where('application_type_id', $sc_application->application_master_id)->where('society_flag', '1')->where('document_name', '!=', config('commanConfig.documents.society.stamp_renewal_application'))->get();
        $documents_uploaded = RenewalDocumentStatus::where('application_id', $sc_application->id)->get();

        $documents_count = 0;
        $documents_uploaded_count = 0;
        foreach($documents as $document){
            if($document->is_optional == '0'){
                $documents_count++;
                if($document->sr_document_status != null){
                    $documents_uploaded_count++;
                }
            }
        }

        $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Renewal'))->value('id');
        $uploaded_stamped_application_id = $this->conveyance_common->getDocumentId(config('commanConfig.documents.society.stamp_renewal_application'), $application_type);        
        $uploaded_stamped_application_ids = $documents_uploaded->pluck('document_path', 'document_id');
        $uploaded_stamped_application = isset($uploaded_stamped_application_ids->toArray()[$uploaded_stamped_application_id])?$uploaded_stamped_application_ids->toArray()[$uploaded_stamped_application_id]:"";

        return view('frontend.society.renewal.show_sr_application', compact('sc_application', 'documents', 'documents_uploaded', 'documents_count', 'documents_uploaded_count', 'uploaded_stamped_application'));
    }

    /**
     * Show the form for editing the specified resource.
     * Author: Amar Prajapati
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $sc_application = RenewalApplication::with(['sr_form_request' => function($q){
            $q->with('scheme_names');
        }, 'societyApplication', 'applicationLayout', 'srApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->where('id', $id)->first();
        $sc = new SocietyConveyance;
        $fillable_field_names = $sc->getFillable();
        if(in_array('language_id', $fillable_field_names) == true || in_array('society_id', $fillable_field_names) == true){
            $field_name = array_flip($fillable_field_names);
            unset($field_name['language_id'], $field_name['society_id'], $field_name['template_file']);
            $fields_names = array_flip($field_name);
            $field_names = array_values($fields_names);
        }
        $comm_func = $this->CommonController;
        $layouts = MasterLayout::all();
        $master_tenant_type = MasterTenantType::all();
        $documents = SocietyConveyanceDocumentMaster::with(['sr_document_status' => function($q) use($sc_application) { $q->where('application_id', $sc_application->id)->get(); }])->where('application_type_id', $sc_application->application_master_id)->where('society_flag', '1')->where('document_name', '!=', config('commanConfig.documents.society.stamp_renewal_application'))->get();
        $documents_uploaded = RenewalDocumentStatus::where('application_id', $sc_application->id)->get();

        $documents_count = 0;
        $documents_uploaded_count = 0;
        foreach($documents as $document){
            if($document->is_optional == '0'){
                $documents_count++;
                if($document->sr_document_status != null){
                    $documents_uploaded_count++;
                }
            }
        }

        return view('frontend.society.renewal.edit', compact('layouts', 'field_names', 'society_details', 'comm_func', 'sc_application', 'id','master_tenant_type', 'documents', 'documents_uploaded', 'documents_count', 'documents_uploaded_count'));
    }

    /**
     * Update the specified resource in storage.
     * Author: Amar Prajapati
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $is_old_match = 0;
        $is_match = 0;
        if($request->hasFile('template')) {
            $file = $request->file('template');
            $file_name = time() . $file->getFileName() . '.' . $file->getClientOriginalExtension();
            $extension = $request->file('template')->getClientOriginalExtension();
            $request->flash();
            if ($extension == "xls") {
                $time = time();
                $name = File::name(str_replace(' ', '_', $request->file('template')->getClientOriginalName())) . '_' . $time . '.' . $extension;
                $folder_name = "society_renewal_documents";
                $path = '/' . $folder_name . '/' . $name;
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name, $request->file('template'), $name);
                $count = 0;
                $sc_excel_headers = [];
                Excel::load($request->file('template')->getRealPath(), function ($reader) use (&$count, &$sc_excel_headers) {
                    if (count($reader->toArray()) > 0) {
                        $excel_headers = $reader->first()->keys()->toArray();
                        $sc_excel_headers = config('commanConfig.sc_excel_headers');

                        foreach ($excel_headers as $excel_headers_key => $excel_headers_val) {
                            if(isset($sc_excel_headers[$excel_headers_key])) {
                                $excel_headers_value = strtolower(str_replace(str_split('\\/- '), '_', $sc_excel_headers[$excel_headers_key]));
                                if ($excel_headers_value == $excel_headers_val) {
                                    $count++;
                                } else {
                                    $exploded = explode('_', $excel_headers_value);
                                    foreach ($exploded as $exploded_key => $exploded_value) {
                                        if (!empty(strpos($excel_headers_val, $exploded_value))) {
                                            $count++;
                                        }
                                    }
                                }
                            }
                        }
                    }
                });

                if ($count != 0) {
                    if ($count == count($sc_excel_headers)) {
                        $is_match = 1;
                        $sc_application = RenewalApplication::with('sr_form_request')->where('id', $id)->first();
                    }else{
                        return redirect()->route('society_renewal.edit', encrypt($id))->withErrors('error', "Excel file headers doesn't match")->withInput();
                    }
                }else{
                    return redirect()->route('society_renewal.edit', encrypt($id))->withErrors('error', "Excel file is empty.")->withInput();
                }
            }
        }else{
            $is_old_match = 1;
            $sc_application = RenewalApplication::with('sr_form_request')->where('id', $id)->first();
            $path = $sc_application->sr_form_request->template_file;
        }
        if($is_match == 1 || $is_old_match == 1){
            $update_scApplication = array(
                'layout_id' => $request->layout_id
            );

            $updated_sc_application = RenewalApplication::where('id', $id)->update($update_scApplication);

            $input = $request->all();
            $input['first_flat_issue_date'] = date('Y-m-d', strtotime($request->first_flat_issue_date));
            $input['society_registration_date'] = date('Y-m-d', strtotime($request->society_registration_date));
            $input['template_file'] = $path;
            unset($input['layout_id'], $input['template'], $input['_token'], $input['_method']);

            $sc = new SocietyConveyance;
            $sc_application_form =  $sc->getFillable();
            $sc_document_status = new RenewalDocumentStatus;
            $sc_document_status_arr = array_flip($sc_document_status->getFillable());
            $sc_document_status_arr['application_id'] = $sc_application->id;
            $sc_document_status_arr['society_flag'] = 1;
            $sc_document_status_arr['document_id'] = 1;
            $sc_document_status_arr['document_path'] = $path;
//            dd($sc_document_status_arr);
            $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Renewal'))->value('application_type');
            $document_id = $this->conveyance_common->getDocumentId(config('commanConfig.documents.society.list_of_members_from_society'), $application_type);
            RenewalDocumentStatus::where('document_id', $document_id)->update($sc_document_status_arr);

            if(count($input) < count($sc_application_form)){
                SocietyConveyance::where('id', $sc_application->sr_form_request->id)->update($input);
            }
        }
        return redirect()->route('society_renewal.show', encrypt($id));
    }

    /**
     * Remove the specified resource from storage.
     * Author: Amar Prajapati
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Download excel.
     * Author: Amar Prajapati
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function download_excel()
    {
        $headers = config('commanConfig.sc_excel_headers');
        Excel::create('society_details', function($excel) use ($headers){
            $excel->sheet('Sheet 1', function($sheet) use($headers) {
                $sheet->fromArray($headers);
            });
        })->export('xls');
        return redirect()->route('society_conveyance.create');
    }

    /**
     * Show upload documents form.
     * Author: Amar Prajapati
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function sr_upload_docs()
    {
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $sc_application = RenewalApplication::where('society_id', $society->id)->with(['srApplicationType', 'srApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        } ])->orderBy('id', 'desc')->first();
        $society_bank_details = SocietyBankDetails::where('society_id', $society->id)->first();
//        dd($sc_application);
        $documents = SocietyConveyanceDocumentMaster::with(['sr_document_status' => function($q) use($sc_application) { $q->where('application_id', $sc_application->id)->get(); }])->where('application_type_id', $sc_application->application_master_id)->where('society_flag', '1')->where('document_name', '!=', config('commanConfig.documents.society.stamp_renewal_application'))->get();
        $docs_uploaded =   RenewalDocumentStatus::where('application_id', $sc_application->id)->where('society_flag', 1)->get();
        foreach($documents as $document){
            if($document->sr_document_status != null){
                $documents_uploaded[] = $document;
            }
        }

        $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Renewal'))->value('id');
        $uploaded_document_id = $this->conveyance_common->getDocumentId(config('commanConfig.documents.society.list_of_members_from_society'), $application_type);

        $renewal_doc_comments = RenewalSocietyDocumentComment::where('society_id', $society->id)->orderBy('id', 'desc')->first();

        if(isset($renewal_doc_comments)){
            if($renewal_doc_comments->society_documents_comment == 'N.A.'){
                $renewal_doc_comments->society_documents_comment = '';
            }
        }

        $documents_count = 0;
        $documents_uploaded_count = 0;
        foreach($documents as $document){
            if($document->is_optional == '0'){
                $documents_count++;
                if($document->sr_document_status != null){
                    $documents_uploaded_count++;
                }
            }
        }
        
        $uploaded_stamped_application_id = $this->conveyance_common->getDocumentId(config('commanConfig.documents.society.stamp_renewal_application'), $application_type);        
        $uploaded_stamped_application_ids = $docs_uploaded->pluck('document_path', 'document_id');
        $uploaded_stamped_application = isset($uploaded_stamped_application_ids->toArray()[$uploaded_stamped_application_id])?$uploaded_stamped_application_ids->toArray()[$uploaded_stamped_application_id]:"";
        // dd($uploaded_stamped_application);        
        return view('frontend.society.renewal.show_doc_bank_details', compact('documents', 'sc_application', 'society', 'documents_uploaded', 'sc_bank_details_fields', 'comm_func', 'society_bank_details', 'uploaded_document_id', 'renewal_doc_comments', 'documents_count', 'documents_uploaded_count', 'docs_uploaded', 'uploaded_stamped_application'));
    }

    /**
     * Uploads society renewal documents.
     * Author: Amar Prajapati
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function upload_sr_docs(Request $request)
    {
        // dd($request->all());
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $sc_application = RenewalApplication::where('society_id', $society->id)->with(['srApplicationType', 'srApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        } ])->orderBy('id', 'desc')->first();
        $document_id = $request->document_id;
        if($request->hasfile('document_name') == true){

            $file = $request->file('document_name');
            $extension = $file->getClientOriginalExtension();
            $time = time();
            $name = File::name(str_replace(' ', '_', $file->getClientOriginalName())) . '_' . $time . '.' . $extension;
            $folder_name = "society_renewal_documents";
            $path = '/' . $folder_name . '/' . $name;

            $is_doc_first = 0;
            $is_doc = 0;

            $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Renewal'))->value('id');
            $uploaded_document_id = $this->conveyance_common->getDocumentId(config('commanConfig.documents.society.list_of_members_from_society'), $application_type);

            if($document_id == $uploaded_document_id){
                $is_doc_first = 1;
                if ($extension == "xls") {
                    $count = 0;
                    $sc_excel_headers = [];
                    Excel::load($file->getRealPath(), function ($reader) use (&$count, &$sc_excel_headers) {
                        if (count($reader->toArray()) > 0) {
                            $excel_headers = $reader->first()->keys()->toArray();
                            $sc_excel_headers = config('commanConfig.sc_excel_headers');

                            foreach ($excel_headers as $excel_headers_key => $excel_headers_val) {
                                $excel_headers_value = strtolower(str_replace(str_split('\\/- '), '_', $sc_excel_headers[$excel_headers_key]));
                                if ($excel_headers_value == $excel_headers_val) {
                                    $count++;
                                } else {
                                    $exploded = explode('_', $excel_headers_value);
                                    foreach ($exploded as $exploded_key => $exploded_value) {
                                        if (!empty(strpos($excel_headers_val, $exploded_value))) {
                                            $count++;
                                        }
                                    }
                                }
                            }
                        }
                    });
                    if ($count != 0) {
                        if ($count == count($sc_excel_headers)) {

                            $update_scApplication = array(
                                'template_file' => $path
                            );
                            $updated_sc_application = SocietyConveyance::where('id', $sc_application->id)->update($update_scApplication);
                        }else{
                            return redirect()->route('sr_upload_docs')->with('error_'.$document_id, "Excel file headers doesn't match");
                        }
                    }else{
                        return redirect()->route('sr_upload_docs')->with('error_'.$document_id, "Excel file is empty.");
                    }
                }
            }else{
                if($extension == 'pdf'){
                    $is_doc = 1;
                }else{
                    return redirect()->route('sr_upload_docs')->with('error_'.$document_id, "Only files with .pdf extension required.");
                }
            }

            if($is_doc_first == 1 || $is_doc == 1){
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name, $file, $name);
                $sr_doc_status = array(
                    'application_id' => $sc_application->id,
                    'user_id' => auth()->user()->id,
                    'society_flag' => 1,
                    'document_id' => $document_id,
                    'document_path' => $path
                );

                if($request->other_document_name != null){
                    $sr_doc_status['other_document_name'] = $request->other_document_name;
                }
                
                $documents_uploaded = RenewalDocumentStatus::create($sr_doc_status);
                
                $add_comment = array(
                    'society_id' => $society->id,
                    'society_documents_comment' => 'N.A.',
                );
                RenewalSocietyDocumentComment::create($add_comment);
            }

        }else{
            return redirect()->route('sr_upload_docs')->with('error_'.$document_id, "File upload is required.");
        }

        return redirect()->route('sr_upload_docs');
    }

    /**
     * Deletes uploaded documents.
     * Author: Amar Prajapati
     * @param  id
     * @return \Illuminate\Http\Response
     */
    public function delete_sr_upload_docs($id)
    {
        $id = decrypt($id);
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $sc_application = RenewalApplication::where('society_id', $society->id)->with(['srApplicationType', 'srApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        } ])->orderBy('id', 'desc')->first();

        $documents = SocietyConveyanceDocumentMaster::with(['sr_document_status' => function($q) use($sc_application) { $q->where('application_id', $sc_application->id)->get(); }])->where('application_type_id', $sc_application->application_master_id)->where('society_flag', '1')->where('document_name', '!=', config('commanConfig.documents.society.stamp_renewal_application'))->get();
        $documents_uploaded = RenewalDocumentStatus::where('application_id', $sc_application->id)->where('document_id', $id)->first();

        $path = $documents_uploaded->document_path;
        $deleted = Storage::disk('ftp')->delete($path);
        RenewalDocumentStatus::where('application_id', $sc_application->id)->where('id', $id)->delete();

        $update_template_file = array(
            'template_file' => ''
        );
//        dd($id);
        SocietyConveyance::where('society_id', $society->id)->where('id', $sc_application->form_request_id)->update($update_template_file);

        return redirect()->route('sr_upload_docs');
    }


    /**
     * Saves society document comments.
     * Author: Amar Prajapati
     * @param  request
     * @return \Illuminate\Http\Response
     */
    public function add_society_documents_comment(Request $request)
    {
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $comments = '';
        if(!empty($request->input('society_documents_comment'))){
            $comments = $request->input('society_documents_comment');
        }else{
            $comments = 'N.A.';
        }
        $input = array(
            'society_id' => $society->id,
            'society_documents_comment' => $comments,
        );

        RenewalSocietyDocumentComment::where('society_id', $society->id)->update($input);
        return redirect()->route('sr_form_upload_show');
    }


    /**
     * Shows society renewal upload form.
     * Author: Amar Prajapati
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function sr_form_upload_show ()
    {
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $sc_application = RenewalApplication::where('society_id', $society->id)->with(['srApplicationType', 'srApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        } ])->orderBy('id', 'desc')->first();
        $documents = SocietyConveyanceDocumentMaster::with(['sr_document_status' => function($q) use($sc_application) { $q->where('application_id', $sc_application->id)->get(); }])->where('application_type_id', $sc_application->application_master_id)->where('society_flag', '1')->where('document_name', '!=', config('commanConfig.documents.society.stamp_renewal_application'))->get();
        $documents_uploaded = RenewalDocumentStatus::where('application_id', $sc_application->id)->get();

        $documents_count = 0;
        $documents_uploaded_count = 0;
        foreach($documents as $document){
            if($document->is_optional == '0'){
                $documents_count++;
                if($document->sr_document_status != null){
                    $documents_uploaded_count++;
                }
            }
        }

        return view('frontend.society.renewal.sr_form_upload_show', compact('sc_application', 'documents', 'documents_uploaded', 'documents_count', 'documents_uploaded_count'));
    }

    /**
     * Shows society conveyance application form in pdf format.
     * Author: Amar Prajapati
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function generate_pdf(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $sc_application = RenewalApplication::with(['sr_form_request', 'societyApplication', 'applicationLayout'])->where('society_id', $society->id)->first();
        $mpdf = new Mpdf();
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $contents = view('frontend.society.renewal.sr_application_form_preview', compact('society_details', 'sc_application'));
        $mpdf->WriteHTML($contents);
        $mpdf->Output();
    }


    /**
     * Uploads stamped society conveyance application form.
     * Author: Amar Prajapati
     * @param  request
     * @return \Illuminate\Http\Response
     */
    public function sr_form_upload(Request $request)
    {
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $sc_application = RenewalApplication::where('society_id', $society->id)->with(['srApplicationType', 'srApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        } ])->orderBy('id', 'desc')->first();

        if($request->hasFile('sr_application_form')){

            $file = $request->file('sr_application_form');
            $extension = $file->getClientOriginalExtension();
            $time = time();
            $name = File::name(str_replace(' ', '_', $file->getClientOriginalName())) . '_' . $time . '.' . $extension;
            $folder_name = "society_renewal_documents";
            $path = '/' . $folder_name . '/' . $name;

            $fileUpload = $this->CommonController->ftpFileUpload($folder_name, $file, $name);

            $this->renewal_common->uploadDocumentStatus($request->id, config('commanConfig.documents.society.stamp_renewal_application'), $path);


            if($extension == 'pdf'){
                $role_id = Role::where('name', config('commanConfig.dycdo_engineer'))->first();
                $user_ids = RoleUser::where('role_id', $role_id->id)->get();
                $layout_user_ids = LayoutUser::where('layout_id', $sc_application->layout_id)->whereIn('user_id', $user_ids)->get();

                foreach ($layout_user_ids as $key => $value) {
                    $select_user_ids[] = $value['user_id'];
                }

                $users = User::whereIn('id', $select_user_ids)->get();
                if(count($users) > 0){
                    $insert_arr = array(
                        'users' => $users
                    );
                    $inserted_application_log = $this->CommonController->sr_application_status_society($insert_arr, config('commanConfig.renewal_status.forwarded'), $sc_application);
                    RenewalApplication::where('id', $sc_application->id)->update(['application_status' => config('commanConfig.renewal_status.in_process')]);
                }

            }else{
                return redirect()->route('sr_form_upload_show')->with('error', 'Only files with .xls extension required.');
            }
        }else{
            return redirect()->route('sr_form_upload_show')->with('error', 'Files with .xls extension required.');
        }

        return redirect()->route('society_renewal.index');
    }

    /**
     * Shows sale & lease deed agreement forms.
     * Author: Amar Prajapati
     * @param  id
     * @return \Illuminate\Http\Response
     */
    public function show_sale_lease($id){

        $id = decrypt($id);
        $sc_application = RenewalApplication::with(['sr_form_request', 'societyApplication', 'applicationLayout', 'srApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->where('id', $id)->first();
        $documents_req = array(
            config('commanConfig.documents.society.renewal_stamp_duty_letter'),
            config('commanConfig.documents.society.renewal_lease_deed_agreement')
        );
        $document_status_req = array(
            config('commanConfig.documents.society.Approved'),
            config('commanConfig.documents.society.Draft_Sign'),
            config('commanConfig.documents.society.Draft')
        );

        $document_status_master = ApplicationStatusMaster::whereIn('status_name', $document_status_req)->get();

        foreach($document_status_master as $document_status_master_val){
            $document_status_master_seq[array_search($document_status_master_val->status_name, $document_status_req)] = $document_status_master_val;
        }
        ksort($document_status_master_seq);
        $document_status_master_seq = array_pluck($document_status_master_seq, 'id');
        $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Renewal'))->value('id');
        $document_ids = $this->renewal_common->getDocumentIds($documents_req, $application_type, $sc_application->id);

        $uploaded_document_ids = [];
        $documents_remaining_ids = [];

        foreach($document_ids as $key => $document_id){
            $document_lease[str_replace(' ', '_', strtolower($document_id->document_name))] = $document_id->document_name;
            if($document_id->document_name == config('commanConfig.documents.society.renewal_stamp_duty_letter')) {
                $document_id->sr_agreement_document_status = $document_id->sr_agreement_document_status[count($document_id->sr_agreement_document_status)-1];
                $uploaded_document_ids[str_replace(' ', '_', strtolower($document_id->document_name))] = $document_id;
            }else{
                if ($document_id->sr_agreement_document_status !== null) {
                    $docs_uploaded_status = array_pluck($document_id->sr_agreement_document_status->toArray(), 'status_id');
                    foreach ($document_status_master_seq as $document_status_master_seq_val) {
                        if (array_search($document_status_master_seq_val, $docs_uploaded_status) !== false) {
                            $document_id->sr_agreement_document_status = $document_id->sr_agreement_document_status[array_search($document_status_master_seq_val, $docs_uploaded_status)];
                            $uploaded_document_ids[str_replace(' ', '_', strtolower($document_id->document_name))] = $document_id;
                            break;
                        }
                    }
                } else {
                    $documents_remaining_ids[str_replace(' ', '_', strtolower($document_id->document_name))] = $document_id;
                }
            }
        }

        $documents = SocietyConveyanceDocumentMaster::with(['sr_document_status' => function($q) use($sc_application) { $q->where('application_id', $sc_application->id)->get(); }])->where('application_type_id', $sc_application->application_master_id)->where('society_flag', '1')->where('language_id', '2')->get();
        $documents_uploaded = RenewalDocumentStatus::where('application_id', $sc_application->id)->orderBy('id', 'desc')->get();
        
        $documents_uploaded_ids = $documents_uploaded->pluck('document_id');
        
        $sc_agreement_comments = RenewalAgreementComments::with('srAgreementId')->where('user_id', Auth::user()->id)->where('role_id', Session::get('role_id'))->orderBy('id', 'desc')->get();
        $uploaded_agreement_id = $this->conveyance_common->getDocumentId(config('commanConfig.documents.society.renewal_lease_deed_agreement'), $application_type);
        
        foreach($documents_uploaded as $document_uploaded){
            if($document_uploaded->document_id == $uploaded_agreement_id){
                $uploaded_agreement[] = $document_uploaded;
            }
        }
        
        foreach($sc_agreement_comments as $sc_agreement_comment_val){
            foreach($document_ids as $document_id){
                if($document_id->id == $sc_agreement_comment_val->agreement_type_id){
                    $sc_agreement_comment[$sc_agreement_comment_val->srAgreementId->document_name] = $sc_agreement_comment_val;
                }
            }
        }

        $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Renewal'))->value('id');
        $uploaded_stamped_application_id = $this->conveyance_common->getDocumentId(config('commanConfig.documents.society.stamp_renewal_application'), $application_type);        
        $uploaded_stamped_application_ids = $documents_uploaded->pluck('document_path', 'document_id');
        $uploaded_stamped_application = isset($uploaded_stamped_application_ids->toArray()[$uploaded_stamped_application_id])?$uploaded_stamped_application_ids->toArray()[$uploaded_stamped_application_id]:"";


        return view('frontend.society.renewal.sale_lease_deed', compact('sc_application', 'document_lease', 'documents', 'uploaded_document_ids', 'documents_remaining_ids', 'sc_agreement_comment', 'documents_uploaded','uploaded_stamped_application', 'uploaded_agreement'));
    }

    /**
     * Shows signed sale & lease deed agreement forms.
     * Author: Amar Prajapati
     * @param  id
     * @return \Illuminate\Http\Response
     */
    public function show_signed_sale_lease($id){
        $id = decrypt($id);
        $sc_application = RenewalApplication::with(['sr_form_request', 'societyApplication', 'applicationLayout', 'srApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->where('id', $id)->first();

        $documents_req = array(
            config('commanConfig.documents.society.renewal_lease_deed_agreement')
        );
        $document_status_req = array(
            config('commanConfig.documents.society.Stamped_Signed'),
            config('commanConfig.documents.society.Stamped_Signed_by_dycdo'),
            config('commanConfig.documents.society.Stamped')
        );

        $document_status_master = ApplicationStatusMaster::whereIn('status_name', $document_status_req)->get();
        foreach($document_status_master as $document_status_master_val){
            $document_status_master_seq[array_search($document_status_master_val->status_name, $document_status_req)] = $document_status_master_val;
        }
        ksort($document_status_master_seq);
        $document_status_master_seq = array_pluck($document_status_master_seq, 'id');
        $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Renewal'))->value('id');
        $document_ids = $this->renewal_common->getDocumentIds($documents_req, $application_type, $sc_application->id);

        $uploaded_document_ids = [];
        $documents_remaining_ids = [];

        foreach($document_ids as $document_id){
            $document_lease[str_replace(' ', '_', strtolower($document_id->document_name))] = $document_id->document_name;
            if($document_id->sr_agreement_document_status !== null){
                $docs_uploaded_status = array_pluck($document_id->sr_agreement_document_status->toArray(), 'status_id');
                foreach($document_status_master_seq as $document_status_master_seq_val){
                    if(array_search($document_status_master_seq_val, $docs_uploaded_status) !== false){
                        $document_id->sr_agreement_document_status = $document_id->sr_agreement_document_status[array_search($document_status_master_seq_val, $docs_uploaded_status)];
                        $uploaded_document_ids[str_replace(' ', '_', strtolower($document_id->document_name))] = $document_id;
                        break;
                    }
                }
            }else{
                $documents_remaining_ids[str_replace(' ', '_', strtolower($document_id->document_name))] = $document_id;
            }
        }

        $documents = SocietyConveyanceDocumentMaster::with(['sr_agreement_document_status', 'sr_document_status' => function($q) use($sc_application) { $q->where('application_id', $sc_application->id)->get(); }])->where('application_type_id', $sc_application->application_master_id)->where('society_flag', '1')->where('document_name', '!=', config('commanConfig.documents.society.stamp_renewal_application'))->get();
        $documents_uploaded = RenewalDocumentStatus::where('application_id', $sc_application->id)->get();

        $sc_registration_details = new scRegistrationDetails;
        $sc_document_status = new RenewalDocumentStatus;
        
        $field_names_registrar_details = $sc_registration_details->getFillable();
        $field_names_docs = $sc_document_status->getFillable();
        $field_names = array_merge($field_names_registrar_details, $field_names_docs);
        $field_names = array_flip($field_names);
        unset($field_names['other_document_name']);
        $field_names = array_flip($field_names);
        $comm_func = $this->CommonController;

        $lease_agreement_type_id = $uploaded_document_ids['renewal_lease_deed_agreement']->sr_agreement_document_status->document_id;
        $sc_registration_detail = scRegistrationDetails::where('application_id', $id)->where('application_type_id', $application_type)->orderBy('id', 'desc')->first();

        $society_flag = 1;
        $status = ApplicationStatusMaster::where('status_name', config('commanConfig.documents.society.Register'))->value('id');
        
        $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Renewal'))->value('id');
        $uploaded_stamped_application_id = $this->conveyance_common->getDocumentId(config('commanConfig.documents.society.stamp_renewal_application'), $application_type);        
        $uploaded_stamped_application_ids = $documents_uploaded->pluck('document_path', 'document_id');
        $uploaded_stamped_application = isset($uploaded_stamped_application_ids->toArray()[$uploaded_stamped_application_id])?$uploaded_stamped_application_ids->toArray()[$uploaded_stamped_application_id]:"";

        return view('frontend.society.renewal.signed_sale_lease_deed', compact('sc_application', 'society_flag','status', 'sale_agreement_type_id', 'lease_agreement_type_id', 'field_names', 'comm_func', 'uploaded_document_ids', 'documents', 'documents_uploaded', 'status', 'sc_registration_detail','uploaded_stamped_application'));
    }

    /**
     * Uploads stamped sale & lease deed agreements.
     * Author: Amar Prajapati
     * @param  request
     * @return \Illuminate\Http\Response
     */
    public function upload_sale_lease(Request $request){
        $insert_arr = $request->all();

        if($insert_arr['remark'] == null){
            $insert_arr['remark'] = 'N.A.';
        }
        $sc_application = RenewalApplication::with(['societyApplication', 'applicationLayout', 'srApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->where('id', $request->application_id)->first();

        if($request->hasFile('document_path')) {
            $file = $request->file('document_path');
            $extension = $file->getClientOriginalExtension();
            $time = time();
            $name = File::name(str_replace(' ', '_', $file->getClientOriginalName())) . '_' . $time . '.' . $extension;
            $folder_name = "society_renewal_documents";
            $path = '/' . $folder_name . '/' . $name;
            $fileUpload = $this->CommonController->ftpFileUpload($folder_name, $file, $name);
            $insert_arr['document_path'] = $path;
            unset($insert_arr['_token']);

            $sc_document_status = new RenewalDocumentStatus;

            $sc_document_details = $sc_document_status->getFillable();
            $role_id = Role::where('name', config('commanConfig.dycdo_engineer'))->first();
            $users_record = RenewalApplicationLog::where('application_id', $request->application_id)->where('society_flag', 0)->where('role_id', $role_id->id)->where('status_id', config('commanConfig.renewal_status.forwarded'))->orderBy('id', 'desc')->first();
            $users = User::where('id', $users_record->user_id)->where('role_id', $users_record->role_id)->get();
            $insert_log_arr = array(
                'users' => $users
            );
            $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Renewal'))->value('id');
            $document_id = $this->conveyance_common->getDocumentId($request->document_name, $application_type);
            $status_id = ApplicationStatusMaster::where('status_name', config('commanConfig.documents.society.Stamped'))->value('id');
            $insert_arr['document_id'] = $document_id;
            unset($insert_arr['document_name']);
            $insert_sr_document_details = array(
                'application_id' => $insert_arr['application_id'],
                'user_id' => auth()->user()->id,
                'society_flag' => 1,
                'status_id' => $status_id,
                'document_id' => $document_id,
                'document_path' => $insert_arr['document_path'],
            );

            $insert_sr_agreement_details = array(
                'application_id' => $insert_arr['application_id'],
                'user_id' => auth()->user()->id,
                'role_id' => auth()->user()->role_id,
                'agreement_type_id' => $document_id,
                'remark' => $insert_arr['remark'],
            );

            //Code added by Amar >>start
            DB::beginTransaction();
            try {

                RenewalDocumentStatus::create($insert_sr_document_details);
                RenewalAgreementComments::create($insert_sr_agreement_details);
                RenewalApplication::where('id', $request->application_id)->update(['application_status' => config('commanConfig.renewal_status.Stamp_Renewal_of_Lease_deed')]);
                $inserted_application_log = $this->CommonController->sr_application_status_society($insert_log_arr, config('commanConfig.renewal_status.forwarded'), $sc_application, config('commanConfig.renewal_status.Stamp_Renewal_of_Lease_deed'));

                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
                return redirect()->back()->with('error_db', 'Something went wrong!');
            }
            //Code added by Amar >>end

            return redirect()->back()->with('success', 'Application forwarded successfully!');
        }
    }

    /**
     * Uploads stamped & signed sale & lease deed agreements.
     * Author: Amar Prajapati
     * @param  request
     * @return \Illuminate\Http\Response
     */
    public function upload_signed_sale_lease(Request $request){
        $insert_arr = $request->all();

        $sc_application = RenewalApplication::with(['societyApplication', 'applicationLayout', 'srApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->where('id', $request->application_id)->first();

        if($request->hasFile('document_path')) {

            $file = $request->file('document_path');
            $extension = $file->getClientOriginalExtension();
            $time = time();
            $name = File::name(str_replace(' ', '_', $file->getClientOriginalName())) . '_' . $time . '.' . $extension;
            $folder_name = "society_renewal_documents";
            $path = '/' . $folder_name . '/' . $name;
            $fileUpload = $this->CommonController->ftpFileUpload($folder_name, $file, $name);
            $insert_arr['document_path'] = $path;
            unset($insert_arr['_token']);
            $sc_registration_details = new scRegistrationDetails;
            $sc_document_status = new RenewalDocumentStatus;
            $registration_details = $sc_registration_details->getFillable();
            $sc_document_details = $sc_document_status->getFillable();
            
            $fields=array_flip($sc_document_details);
            unset($sc_document_details[$fields['other_document_name']]);
            $insert_registrar_details = array_slice($insert_arr, 0, count($registration_details));
            $insert_sc_document_detail = array_slice($insert_arr, count($registration_details), count($sc_document_details));
            foreach($sc_document_details as $key => $value){
                $keys = array_keys($insert_sc_document_detail);
                if(array_key_exists($value, $keys) == false){
                    $insert_sc_document_details[$value] = $insert_arr[$value];
                }else{
                    $insert_sc_document_details[$value] = $insert_arr[$value];
                }
            }

            $role_id = Role::where('name', config('commanConfig.dycdo_engineer'))->first();
            $users_record = RenewalApplicationLog::where('application_id', $request->application_id)->where('society_flag', 0)->where('role_id', $role_id->id)->where('status_id', config('commanConfig.renewal_status.forwarded'))->orderBy('id', 'desc')->first();
            $users = User::where('id', $users_record->user_id)->where('role_id', $users_record->role_id)->get();
            $insert_log_arr = array(
                'users' => $users
            );
            $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Renewal'))->value('id');
            $insert_registrar_details['application_type_id'] = $application_type;

            //Code added by Amar >>start
            DB::beginTransaction();
            try {

                scRegistrationDetails::create($insert_registrar_details);
                RenewalDocumentStatus::create($insert_sc_document_details);
                RenewalApplication::where('id', $request->application_id)->update(['application_status' => config('commanConfig.renewal_status.Registered_lease_deed')]);
                $inserted_application_log = $this->CommonController->sr_application_status_society($insert_log_arr, config('commanConfig.renewal_status.forwarded'), $sc_application, config('commanConfig.renewal_status.Registered_lease_deed'));

                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
                return redirect()->back()->with('error_db', 'Something went wrong!');
            }
            //Code added by Amar >>end

            return redirect()->back()->with('success', 'Application forwarded successfully!');
        }
    }
}
