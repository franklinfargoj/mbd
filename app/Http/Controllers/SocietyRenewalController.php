<?php

namespace App\Http\Controllers;

use App\conveyance\RenewalApplication;
use App\conveyance\RenewalDocumentStatus;
use App\conveyance\RenewalSocietyDocumentComment;
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

use Illuminate\Http\Request;

class SocietyRenewalController extends Controller
{
    protected $list_num_of_records_per_page;

    public function __construct()
    {
        $this->CommonController = new CommonController();
        $this->conveyance_common = new conveyanceCommonController();
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

            return $datatables->of($sr_applications)
                ->editColumn('radio', function ($sr_applications) {
                    $url = route('society_renewal.show', base64_encode($sr_applications->id));
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
                    $status = explode('_', array_keys(config('commanConfig.applicationStatus'), $sr_applications->srApplicationLog->status_id)[0]);
                    $status_display = '';
                    foreach($status as $status_value){ $status_display .= ucwords($status_value). ' ';}
                    $status_color = '';
                    if($status_display == 'Sent To Society '){
                        $status_display = 'Approved';
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
            "order"=> [4, "desc" ],
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
        $layouts = MasterLayout::all();
        $application_master_id = scApplicationType::where('application_type', config('commanConfig.applicationType.Renewal'))->first();
        return view('frontend.society.renewal.add', compact('layouts', 'field_names', 'society_details', 'comm_func', 'application_master_id'));
    }

    /**
     * Store a newly created resource in storage.
     * Author: Amar Prajapati
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
//                            dd($input_sc_application);
                            $sc_application = RenewalApplication::create($input_sc_application);
                            $inserted_application_log = $this->CommonController->sr_application_status_society($insert_arr, config('commanConfig.applicationStatus.pending'), $sc_application);

                            $sc_document_status = new RenewalDocumentStatus;
                            $sc_document_status_arr = array_flip($sc_document_status->getFillable());
                            $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Renewal'))->value('id');
                            $document_id = $this->conveyance_common->getDocumentId(config('commanConfig.documents.society.list_of_members_from_society'), $application_type);

                            $sc_document_status_arr['application_id'] = $sc_application->id;
                            $sc_document_status_arr['society_flag'] = 1;
                            $sc_document_status_arr['document_id'] = $document_id;
                            $sc_document_status_arr['document_path'] = $path;

                            $renewal_document_status = RenewalDocumentStatus::create($sc_document_status_arr);

                            if(!empty($renewal_document_status->id)){
                                return redirect()->route('society_renewal.show', base64_encode($sc_application->id));
                            }
                        }
                    }else{
                        return redirect()->route('society_renewal.create')->withErrors('error', "Excel file headers doesn't match")->withInput();
                    }
                }else{
                    return redirect()->route('society_renewal.create')->withErrors('error', "Excel file is empty.")->withInput();
                }
            }
        }else{
            return redirect()->route('society_renewal.create')->withErrors('error', "Excel file headers doesn't match")->withInput();
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
        $id = base64_decode($id);

        $sc_application = RenewalApplication::with(['sr_form_request', 'societyApplication', 'applicationLayout', 'srApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->where('id', $id)->first();

        return view('frontend.society.renewal.show_sr_application', compact('sc_application'));
    }

    /**
     * Show the form for editing the specified resource.
     * Author: Amar Prajapati
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $sc_application = RenewalApplication::with(['sr_form_request', 'societyApplication', 'applicationLayout'])->where('id', $id)->first();
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
//        dd($field_names);
        return view('frontend.society.renewal.edit', compact('layouts', 'field_names', 'society_details', 'comm_func', 'sc_application', 'id'));
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
                        $is_match = 1;
                        $sc_application = RenewalApplication::with('sr_form_request')->where('id', $id)->first();
                    }else{
                        return redirect()->route('society_renewal.edit', base64_encode($id))->withErrors('error', "Excel file headers doesn't match")->withInput();
                    }
                }else{
                    return redirect()->route('society_renewal.edit', base64_encode($id))->withErrors('error', "Excel file is empty.")->withInput();
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
        return redirect()->route('society_renewal.show', base64_encode($id));
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
        $documents = SocietyConveyanceDocumentMaster::with(['sr_document_status' => function($q) use($sc_application) { $q->where('application_id', $sc_application->id)->get(); }])->where('application_type_id', $sc_application->application_master_id)->where('society_flag', '1')->get();
        $documents_uploaded =   RenewalDocumentStatus::where('application_id', $sc_application->id)->get();
//        foreach($documents as $document){
//            if($document->sr_document_status != null)
//            $documents_uploaded[] = $document;
//        }
        $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Renewal'))->value('id');
        $uploaded_document_id = $this->conveyance_common->getDocumentId(config('commanConfig.documents.society.list_of_members_from_society'), $application_type);

        $sc_bank_details = new SocietyBankDetails;
        $sc_bank_details_fields_name = $sc_bank_details->getFillable();
        $sc_bank_details_fields_name = array_flip($sc_bank_details_fields_name);
        unset($sc_bank_details_fields_name['society_id']);
        $sc_bank_details_fields = array_values(array_flip($sc_bank_details_fields_name));
        $comm_func = $this->CommonController;
        return view('frontend.society.renewal.show_doc_bank_details', compact('documents', 'sc_application', 'society', 'documents_uploaded', 'sc_bank_details_fields', 'comm_func', 'society_bank_details', 'uploaded_document_id'));
    }

    /**
     * Uploads society renewal documents.
     * Author: Amar Prajapati
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function upload_sr_docs(Request $request)
    {
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
                    'document_id' => $document_id,
                    'document_path' => $path
                );
                $documents_uploaded = RenewalDocumentStatus::create($sr_doc_status);
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
        $id = base64_decode($id);
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $sc_application = RenewalApplication::where('society_id', $society->id)->with(['srApplicationType', 'srApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        } ])->orderBy('id', 'desc')->first();

        $documents = SocietyConveyanceDocumentMaster::with(['sr_document_status' => function($q) use($sc_application) { $q->where('application_id', $sc_application->id)->get(); }])->where('application_type_id', $sc_application->application_master_id)->get();
        $documents_uploaded = RenewalDocumentStatus::where('application_id', $sc_application->id)->where('document_id', $id)->first();

        $path = $documents_uploaded->document_path;
        $deleted = Storage::disk('ftp')->delete($path);
        RenewalDocumentStatus::where('application_id', $sc_application->id)->where('document_id', $id)->delete();
//        $this->conveyance_common->getDocumentId(config('commanConfig.'));
//        if(){
//
//        }
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

        return view('frontend.society.renewal.sr_form_upload_show', compact('sc_application'));
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
            $this->conveyance_common->uploadDocumentStatus($request->id, config('commanConfig.documents.society.stamp_renewal_application'), $path);

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
                $inserted_application_log = $this->CommonController->sr_application_status_society($insert_arr, config('commanConfig.applicationStatus.forwarded'), $sc_application);
            }
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
        $sc_application = scApplication::with(['sr_form_request', 'societyApplication', 'applicationLayout', 'scApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->where('id', $id)->first();

        return view('frontend.society.conveyance.sale_lease_deed', compact('sc_application'));
    }

    /**
     * Shows signed sale & lease deed agreement forms.
     * Author: Amar Prajapati
     * @param  id
     * @return \Illuminate\Http\Response
     */
    public function show_signed_sale_lease($id){
        $sc_application = scApplication::with(['sr_form_request', 'societyApplication', 'applicationLayout', 'scApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->where('id', $id)->first();
        $sc_registration_details = new scRegistrationDetails;
        $sc_document_status = new SocietyConveyanceDocumentStatus;
        $field_names_registrar_details = $sc_registration_details->getFillable();
        $field_names_docs = $sc_document_status->getFillable();
        $field_names = array_merge($field_names_registrar_details, $field_names_docs);
        $comm_func = $this->CommonController;
        $sale_agreement_type_id = $this->conveyance_common->getDocumentId('Sale Deed Agreement', '1');
        $lease_agreement_type_id = $this->conveyance_common->getDocumentId('Lease Deed Agreement', '1');
        $status = config('commanConfig.applicationStatus.Stamped_signed_sale_&_lease_deed');
        $society_flag = 1;

        return view('frontend.society.conveyance.signed_sale_lease_deed', compact('sc_application', 'society_flag','status', 'sale_agreement_type_id', 'lease_agreement_type_id', 'field_names', 'comm_func'));
    }

    /**
     * Uploads stamped sale & lease deed agreements.
     * Author: Amar Prajapati
     * @param  request
     * @return \Illuminate\Http\Response
     */
    public function upload_sale_lease(Request $request){

    }

    /**
     * Uploads stamped & signed sale & lease deed agreements.
     * Author: Amar Prajapati
     * @param  request
     * @return \Illuminate\Http\Response
     */
    public function upload_signed_sale_lease(Request $request){
        $insert_arr = $request->all();
        if($request->hasFile('document_path')) {

            $file = $request->file('document_path');
            $extension = $file->getClientOriginalExtension();
            $time = time();
            $name = File::name(str_replace(' ', '_', $file->getClientOriginalName())) . '_' . $time . '.' . $extension;
            $folder_name = "society_renewal_documents";
            $path = '/' . $folder_name . '/' . $name;
//            $fileUpload = $this->CommonController->ftpFileUpload($folder_name, $file, $name);
            $insert_arr['document_path'] = $path;
            unset($insert_arr['_token']);
            $sc_registration_details = new scRegistrationDetails;
            $sc_document_status = new SocietyConveyanceDocumentStatus;
            $registration_details = $sc_registration_details->getFillable();
            $sc_document_details = $sc_document_status->getFillable();
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
            scRegistrationDetails::create($insert_registrar_details);
            SocietyConveyanceDocumentStatus::create($insert_sc_document_details);
            return redirect()->route('show_signed_sale_lease', $insert_arr['application_id']);
        }
    }
}