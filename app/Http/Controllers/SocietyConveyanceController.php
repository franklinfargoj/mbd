<?php

namespace App\Http\Controllers;
use App\conveyance\scApplicationLog;
use App\NatureOfBuilding;
use App\ServiceCharge;
use App\SocietyConveyance;
use App\SocietyOfferLetter;
use App\conveyance\ScAgreementComments;
use App\OlApplication;
use Illuminate\Support\Facades\Session;
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
use App\Http\Controllers\EmailMsg\EmailMsgConfigration;
use App\ApplicationStatusMaster;
use App\MasterTenantType;
use DB;

use Illuminate\Http\Request;

class SocietyConveyanceController extends Controller
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
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application No.'],
            ['data' => 'application_master_id','name' => 'application_master_id','title' => 'Application Type'],
            ['data' => 'created_at','name' => 'created_at','title' => 'Submission Date', 'class' => 'datatable-date'],
            ['data' => 'status','name' => 'status','title' => 'Status'],
            ['data' => 'radio','name' => 'radio','title' => 'Action','searchable' => false],

        ];
        $getRequest = $request->all();
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();

        $sc_application_count = count(scApplication::where('society_id', $society_details->id)->get());

        Session::put('sc_application_count', $sc_application_count);

        if ($datatables->getRequest()->ajax()) {
            $sc_applications = scApplication::where('society_id', $society_details->id)->with(['scApplicationType' => function($q){
               $q->where('application_type', config('commanConfig.applicationType.Conveyance'))->first();
            }, 'scApplicationLog' => function($q){
                $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
            } ])->orderBy('id', 'desc');


            if($request->application_master_id)
            {
                $sc_applications = $sc_applications->where('application_master_id', 'like', '%'.$request->application_master_id.'%');
            }
            $sc_applications = $sc_applications->get();

            return $datatables->of($sc_applications)
                ->editColumn('radio', function ($sc_applications) {
                    $url = route('society_conveyance.show', encrypt($sc_applications->id));
                    return '<div class="d-flex btn-icon-list"><a href="'.$url.'" onclick="geturl(this.value);" name="village_data_id" class="d-flex flex-column align-items-left"><span class="btn-icon btn-icon--view">
                        <img src="'. asset("img/view-icon.svg").'">
                    </span>View</span></a></div>';
                })
                ->editColumn('rownum', function ($sc_applications) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('application_no', function ($sc_applications) {
                    return $sc_applications->application_no;
                })
                ->editColumn('application_master_id', function ($sc_applications) {
                    return $sc_applications->scApplicationType->application_type;
                })
                ->editColumn('created_at', function ($sc_applications) {
                    return date(config('commanConfig.dateFormat'), strtotime($sc_applications->created_at));
                })

                ->editColumn('status', function ($sc_applications) {
                    $status_display = '';
                    if($sc_applications->application_status == config('commanConfig.conveyance_status.Send_society_to_pay_stamp_duty')){
                        $status_display = config('commanConfig.conveyance_status.society_stamp_duty');
                    }elseif($sc_applications->application_status == config('commanConfig.conveyance_status.Send_society_for_registration_of_sale_&_lease')){
                        $status_display = config('commanConfig.conveyance_status.society_register_sale_lease_deed');
                    }else{
                        $status = explode('_', array_keys(config('commanConfig.conveyance_status'), $sc_applications->scApplicationLog->status_id)[0]);
                        foreach($status as $status_value){ $status_display .= ucwords($status_value). ' ';}
                        $status_color = '';
                        if($status_display == 'Sent To Society '){
                            $status_display = 'Approved';
                        }
                    }

                    return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$sc_applications->scApplicationLog->status_id) .' m-badge--wide">'.$status_display.'</span>';
                })
                ->rawColumns(['radio', 'application_no', 'application_master_id', 'created_at','status'])
                ->make(true);

        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->postAjax()->parameters($this->getParameters());
        return view('frontend.society.conveyance.index', compact('html'));
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [0, "asc" ],
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
            unset($field_name['language_id'], $field_name['society_id'], $field_name['template_file'], $field_name['prev_lease_agreement_no']);
            $fields_names = array_flip($field_name);
            $field_names = array_values($fields_names);
        }
        $comm_func = $this->CommonController;
        $role_id = Role::where('name', config('commanConfig.dycdo_engineer'))->first();
        $user_ids = RoleUser::where('role_id', $role_id->id)->pluck('user_id');

        // $layouts = MasterLayout::whereHas('layoutuser', function($q)use($user_ids){ $q->whereIn('user_id', $user_ids); })->get();
        $application_master_id = scApplicationType::where('application_type', config('commanConfig.applicationType.Conveyance'))->first();
        $master_tenant_type = MasterTenantType::all();
        $building_nature = NatureOfBuilding::all();
        $service_charge_names = ServiceCharge::all();
        $layouts = MasterLayout::all();

        return view('frontend.society.conveyance.add', compact('layouts', 'field_names', 'society_details', 'comm_func', 'application_master_id', 'master_tenant_type', 'building_nature', 'service_charge_names'));
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
                $folder_name = "society_conveyance_documents";
                $path = '/' . $folder_name . '/' . $name;

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
                        $fileUpload = $this->CommonController->ftpFileUpload($folder_name, $request->file('template'), $name);
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
                        $applicationNo = $this->generateApplicationNumber($request->applicationId);
                        $input_sc_application = array(
                            "sc_application_master_id" => $request->sc_application_master_id,
                            "application_no" => $applicationNo,
                            "society_id" => $request->society_id,
                            "form_request_id" => $sc_form_last_id,
                            "layout_id" => $request->layout_id
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
                            
                            $input_sc_application['form_request_id'] = $input_id->id;
                            $sc_application = scApplication::create($input_sc_application);

                            $inserted_application_log = $this->CommonController->sc_application_status_society($insert_arr, config('commanConfig.conveyance_status.pending'), $sc_application);

                            $sc_document_status = new SocietyConveyanceDocumentStatus;
                            $sc_document_status_arr = array_flip($sc_document_status->getFillable());
                            $sc_document_status_arr['application_id'] = $sc_application->id;
                            $sc_document_status_arr['society_flag'] = 1;
                            $sc_document_status_arr['document_id'] = 1;
                            $sc_document_status_arr['document_path'] = $path;

                            SocietyConveyanceDocumentStatus::create($sc_document_status_arr);

                            if($inserted_application_log == true){
                                return redirect()->route('society_conveyance.show', encrypt($sc_application->id));
                            }
                        }
                    }else{
                        return redirect()->route('society_conveyance.create')->with('error', "Excel file headers doesn't match")->withInput();
                    }
                }else{
                    return redirect()->route('society_conveyance.create')->with('error', "Excel file is empty.")->withInput();
                }
            }
        }else{
            return redirect()->route('society_conveyance.create')->with('error', "Excel file headers doesn't match")->withInput();
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

        $sc_application = scApplication::with(['sc_form_request' => function($q){  $q->with(['scheme_names', 'building_nature', 'service_charges']); }, 'societyApplication', 'applicationLayout', 'scApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->where('id', $id)->first();

        $documents = SocietyConveyanceDocumentMaster::with(['sc_document_status' => function($q) use($sc_application) { $q->where('application_id', $sc_application->id)->get(); }])->where('application_type_id', $sc_application->sc_application_master_id)->where('society_flag', '1')->where('language_id', '2')->get();
        $documents_uploaded = SocietyConveyanceDocumentStatus::where('application_id', $sc_application->id)->get();
        $master_tenant_type = MasterTenantType::all();

        $noc = config('commanConfig.scAgreements.conveynace_uploaded_NOC');
        $nocId = $this->conveyance_common->getScAgreementId($noc, $sc_application->sc_application_master_id);
        $issued_noc = $this->conveyance_common->getScAgreement($nocId, $sc_application->id, NULL);
        $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Conveyance'))->value('id');
        $uploaded_stamped_application_id = $this->conveyance_common->getDocumentId(config('commanConfig.documents.society.stamp_conveyance_application'), $application_type);
        $uploaded_stamped_application_ids = $documents_uploaded->pluck('document_path', 'document_id');
        $uploaded_stamped_application = isset($uploaded_stamped_application_ids->toArray()[$uploaded_stamped_application_id])?$uploaded_stamped_application_ids->toArray()[$uploaded_stamped_application_id]:"";

        $documents_count = 0;
        $documents_uploaded_count = 0;
        foreach($documents as $document){
            if($document->is_optional == '0'){
                $documents_count++;
                if($document->sc_document_status != null){
                    $documents_uploaded_count++;
                }
            }
        }

        return view('frontend.society.conveyance.show_sc_application', compact('sc_application', 'uploaded_stamped_application', 'documents', 'documents_uploaded', 'master_tenant_type', 'issued_noc', 'documents_count', 'documents_uploaded_count'));
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
        $sc_application = scApplication::with(['sc_form_request' => function($q){
            $q->with('scheme_names');
        }, 'societyApplication', 'applicationLayout'])->where('id', $id)->first();
//        dd($sc_application->sc_form_request);
//        $documents = SocietyConveyanceDocumentMaster::with(['sc_document_status' => function($q) use($sc_application) { $q->where('application_id', $sc_application->id)->get(); }])->where('application_type_id', $sc_application->sc_application_master_id)->where('society_flag', '1')->where('language_id', '2')->get();
//        $documents_uploaded = SocietyConveyanceDocumentStatus::where('application_id', $sc_application->id)->get();

        $sc = new SocietyConveyance;
        $fillable_field_names = $sc->getFillable();

        if(in_array('language_id', $fillable_field_names) == true || in_array('society_id', $fillable_field_names) == true){
            $field_name = array_flip($fillable_field_names);
            unset($field_name['language_id'], $field_name['society_id'], $field_name['template_file'], $field_name['prev_lease_agreement_no']);
            $fields_names = array_flip($field_name);
            $field_names = array_values($fields_names);
        }
        $comm_func = $this->CommonController;
        $layouts = MasterLayout::all();
        $master_tenant_type = MasterTenantType::all();

        $documents = SocietyConveyanceDocumentMaster::with(['sc_document_status' => function($q) use($sc_application) { $q->where('application_id', $sc_application->id)->get(); }])->where('application_type_id', $sc_application->sc_application_master_id)->where('society_flag', '1')->where('language_id', '2')->get();
        $documents_uploaded = SocietyConveyanceDocumentStatus::where('application_id', $sc_application->id)->get();
        $master_tenant_type = MasterTenantType::all();
        $building_nature = NatureOfBuilding::all();
        $service_charge_names = ServiceCharge::all();

        $documents_count = 0;
        $documents_uploaded_count = 0;
        foreach($documents as $document){
            if($document->is_optional == '0'){
                $documents_count++;
                if($document->sc_document_status != null){
                    $documents_uploaded_count++;
                }
            }
        }

        return view('frontend.society.conveyance.edit', compact('layouts', 'field_names', 'society_details', 'comm_func', 'sc_application', 'id', 'documents', 'documents_uploaded', 'master_tenant_type', 'documents_count', 'documents_uploaded_count', 'building_nature', 'service_charge_names'));
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
//        dd($request->all());
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
                $folder_name = "society_conveyance_documents";
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
                        $sc_application = scApplication::with('sc_form_request')->where('id', $id)->first();
                    }else{
                        return redirect()->route('society_conveyance.edit', encrypt($id))->withErrors('error', "Excel file headers doesn't match")->withInput();
                    }
                }else{
                    return redirect()->route('society_conveyance.edit', encrypt($id))->withErrors('error', "Excel file is empty.")->withInput();
                }
            }
        }else{
            $is_old_match = 1;
            $sc_application = scApplication::with('sc_form_request')->where('id', $id)->first();
            $path = $sc_application->sc_form_request->template_file;
        }
        if($is_match == 1 || $is_old_match == 1){
            $update_scApplication = array(
                'layout_id' => $request->layout_id
            );
            $updated_sc_application = scApplication::where('id', $id)->update($update_scApplication);

            $input = $request->all();
            $input['first_flat_issue_date'] = date('Y-m-d', strtotime($request->first_flat_issue_date));
            $input['society_registration_date'] = date('Y-m-d', strtotime($request->society_registration_date));
            $input['template_file'] = $path;
            unset($input['layout_id'], $input['template'], $input['_token'], $input['_method']);

            $sc = new SocietyConveyance;
            $sc_application_form =  $sc->getFillable();
            $sc_document_status = new SocietyConveyanceDocumentStatus;
            $sc_document_status_arr = array_flip($sc_document_status->getFillable());
            $sc_document_status_arr['application_id'] = $sc_application->id;
            $sc_document_status_arr['society_flag'] = 1;
            $sc_document_status_arr['document_id'] = 1;
            $sc_document_status_arr['document_path'] = $path;
//            dd($sc_document_status_arr);
            SocietyConveyanceDocumentStatus::where('document_id', '1')->update($sc_document_status_arr);

            if(count($input) < count($sc_application_form)){
                SocietyConveyance::where('id', $sc_application->sc_form_request->id)->update($input);
            }
        }
        return redirect()->route('society_conveyance.show', encrypt($id));
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
     * Show upload documents & bank details form.
     * Author: Amar Prajapati
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function sc_upload_docs()
    {
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $sc_application = scApplication::where('society_id', $society->id)->with(['scApplicationType', 'scApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        } ])->orderBy('id', 'desc')->first();

        $society_bank_details = SocietyBankDetails::where('society_id', $society->id)->first();
        $documents = SocietyConveyanceDocumentMaster::with(['sc_document_status' => function($q) use($sc_application) { $q->where('application_id', $sc_application->id); 
        }])->where('application_type_id', $sc_application->sc_application_master_id)->where('society_flag', '1')->where('language_id', '2')->get();
        
        $documents_count = SocietyConveyanceDocumentMaster::where('application_type_id', $sc_application->sc_application_master_id)->where('is_optional',0)->where('society_flag', '1')->where('language_id', '2')->count();

        $documents_uploaded_count = SocietyConveyanceDocumentMaster::with(['sc_document_status' => function($q) use($sc_application) { $q->where('application_id', $sc_application->id); 
        }])->whereHas('sc_document_status', function($q) use($sc_application) {
            $q->where('application_id', $sc_application->id);
        })->where('application_type_id', $sc_application->sc_application_master_id)->where('is_optional',0)->where('society_flag', '1')->where('language_id', '2')->count();

        $sc_bank_details = new SocietyBankDetails;
        $sc_bank_details_fields_name = $sc_bank_details->getFillable();
        $sc_bank_details_fields_name = array_flip($sc_bank_details_fields_name);
        unset($sc_bank_details_fields_name['society_id']);
        $sc_bank_details_fields = array_values(array_flip($sc_bank_details_fields_name));
        $comm_func = $this->CommonController;

        // get issued final conveyance letter
        $noc = config('commanConfig.scAgreements.conveynace_uploaded_NOC');
        $nocId = $this->conveyance_common->getScAgreementId($noc, $sc_application->sc_application_master_id);
        $issued_noc = $this->conveyance_common->getScAgreement($nocId, $sc_application->id, NULL);

        $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Conveyance'))->value('id');

        //get uploaded signed application pdf
        $documentId = $this->conveyance_common->getDocumentId(config('commanConfig.documents.society.stamp_conveyance_application'), $application_type);
        $uploaded_stamped_application = $this->conveyance_common->getDocumentStatus($sc_application->id,$documentId);

        return view('frontend.society.conveyance.show_doc_bank_details', compact('documents', 'uploaded_stamped_application', 'sc_application', 'society', 'sc_bank_details_fields', 'comm_func', 'society_bank_details', 'issued_noc', 'documents_count', 'documents_uploaded_count'));
    }

    /**
     * Uploads documents.
     * Author: Amar Prajapati
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function upload_sc_docs(Request $request)
    {
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $sc_application = scApplication::where('society_id', $society->id)->with(['scApplicationType', 'scApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        } ])->orderBy('id', 'desc')->first();

        $document_id = $request->document_id;
        if($request->hasfile('document_name') == true){

            $file = $request->file('document_name');
            $extension = $file->getClientOriginalExtension();
            $time = time();
            $name = File::name(str_replace(' ', '_', $file->getClientOriginalName())) . '_' . $time . '.' . $extension;
            $folder_name = "society_conveyance_documents";
            $path = '/' . $folder_name . '/' . $name;

            $is_doc_first = 0;
            $is_doc = 0;

            if($document_id == 1){
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
                            return redirect()->route('sc_upload_docs')->with('error_'.$document_id, "Excel file headers doesn't match");
                        }
                    }else{
                        return redirect()->route('sc_upload_docs')->with('error_'.$document_id, "Excel file is empty.");
                    }
                }
            }else{
                if($extension == 'pdf'){
                    $is_doc = 1;
                }else{
                    return redirect()->route('sc_upload_docs')->with('error_'.$document_id, "Only files with .pdf extension required.");
                }
            }

            if($is_doc_first == 1 || $is_doc == 1){
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name, $file, $name);
                $sc_doc_status = array(
                    'application_id' => $sc_application->id,
                    'user_id' => Auth::user()->id,
                    'society_flag' => '1',
                    'document_id' => $document_id,
                    'document_path' => $path
                );
                if($request->other_document_name != null){
                    $sc_doc_status['other_document_name'] = $request->other_document_name;
                }
                $documents_uploaded = SocietyConveyanceDocumentStatus::create($sc_doc_status);
            }

        }else{
            return redirect()->route('sc_upload_docs')->with('error_'.$document_id, "File upload is required.");
        }

        return redirect()->route('sc_upload_docs');
    }

    /**
     * Deletes uploaded documents.
     * Author: Amar Prajapati
     * @param  id
     * @return \Illuminate\Http\Response
     */
    public function delete_sc_upload_docs(Request $request)
    {
        $id = $request->id;
        $applicationId = $request->applicationId; 
        $file = $request->oldFile;

        try {
            $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
            $sc_application = scApplication::where('id', $applicationId)->first();
            $deleted = Storage::disk('ftp')->delete($file);
            SocietyConveyanceDocumentStatus::where('id', $id)->where('application_id', $sc_application->id)->delete();
            $update_template_file = array(
                'template_file' => ''
            );
            SocietyConveyance::where('id', $sc_application->form_request_id)->update($update_template_file);
            $response['status'] = 'success';
        }catch(Exception $e){
            dd($e);
            $response['status'] = 'error';
        }
        if ($request->type == 'form'){
            return redirect()->route('sc_upload_docs');
        }else if ($request->type == 'ajax'){
            return response(json_encode($response), 200);
        }
    }


    /**
     * Saves society bank details.
     * Author: Amar Prajapati
     * @param  request
     * @return \Illuminate\Http\Response
     */
    public function society_bank_details(Request $request)
    {
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $inserted_society_bank_details = SocietyBankDetails::where('society_id', $society->id)->first();
        $society_bank_detail['society_id'] = $society->id;
        $society_bank_details = $request->all();
        unset($society_bank_details['_token']);
        $sc_bank_details = new SocietyBankDetails;
        //dd($inserted_society_bank_details);
        if($inserted_society_bank_details!=null && count($sc_bank_details->getFillable()) == count(array_merge($society_bank_detail, $society_bank_details))){
            SocietyBankDetails::where('id', $inserted_society_bank_details->id)->update(array_merge($society_bank_detail, $society_bank_details));
        }else{
            if(count($sc_bank_details->getFillable()) == count(array_merge($society_bank_detail, $society_bank_details))){
                SocietyBankDetails::create(array_merge($society_bank_detail, $society_bank_details));
            }
        }

        return redirect()->route('sc_form_upload_show');
    }


    /**
     * Shows society conveyance upload form.
     * Author: Amar Prajapati
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function sc_form_upload_show()
    {
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $sc_application = scApplication::where('society_id', $society->id)->with(['scApplicationType', 'scApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        } ])->orderBy('id', 'desc')->first();

        $documents = SocietyConveyanceDocumentMaster::with(['sc_document_status' => function($q) use($sc_application) { $q->where('application_id', $sc_application->id); 
        }])->where('application_type_id', $sc_application->sc_application_master_id)->where('society_flag', '1')->where('language_id', '2')->get();

        $documents_count = SocietyConveyanceDocumentMaster::where('application_type_id', $sc_application->sc_application_master_id)->where('is_optional',0)->where('society_flag', '1')->where('language_id', '2')->count();

        $documents_uploaded_count = 0;
        foreach($documents as $document){
            if($document->sc_document_status != null){
                $documents_uploaded_count++;
            }
        }

        $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Conveyance'))->value('id');

        //get uploaded signed application pdf
        $documentId = $this->conveyance_common->getDocumentId(config('commanConfig.documents.society.stamp_conveyance_application'), $application_type);
        $uploaded_stamped_application = $this->conveyance_common->getDocumentStatus($sc_application->id,$documentId);
        return view('frontend.society.conveyance.sc_form_upload_show', compact('sc_application', 'documents', 'documents_count', 'documents_uploaded_count','uploaded_stamped_application'));
    }

    /**
     * Shows society conveyance application form in pdf format.
     * Author: Amar Prajapati
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function generate_pdf(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $sc_application = scApplication::with(['sc_form_request' => function($q){
            $q->with(['scheme_names', 'building_nature', 'service_charges']);
        }, 'societyApplication', 'applicationLayout'])->where('society_id', $society->id)->first();

        $society_bank_details = SocietyBankDetails::where('society_id', $society->id)->first();
        $sc_application->society_bank_details = $society_bank_details;

        $mpdf = new Mpdf();
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $contents = view('frontend.society.conveyance.sc_application_form_preview', compact('society_details', 'sc_application'));
        $mpdf->WriteHTML($contents);
        $mpdf->Output();
    }


    /**
     * Uploads stamped society conveyance application form.
     * Author: Amar Prajapati
     * @param  request
     * @return \Illuminate\Http\Response
     */
    public function sc_form_upload(Request $request)
    {
        $applicationId = $request->applicationId;
        try{
            $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
            $sc_application = scApplication::where('id', $applicationId)->with(['scApplicationType', 'scApplicationLog' => function($q){
                $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
            } ])->orderBy('id', 'desc')->first();

            if($request->hasFile('sc_application_form')) {

                $file = $request->file('sc_application_form');
                $extension = $file->getClientOriginalExtension();
                $time = time();
                $name = File::name(str_replace(' ', '_', $file->getClientOriginalName())) . '_' . $time . '.' . $extension;
                $folder_name = "society_conveyance_documents";
                $path = '/' . $folder_name . '/' . $name;

                $fileUpload = $this->CommonController->ftpFileUpload($folder_name, $file, $name);
                $this->conveyance_common->uploadDocumentStatus($request->id, config('commanConfig.documents.society.stamp_conveyance_application'), $path);

                return redirect()->back()->with('success','Application form uploaded successfully.');

                // if ($sc_application->scApplicationLog->status_id == config('commanConfig.conveyance_status.pending')) {
                //     if ($sc_application->from_user_id != NULL) {
                //         $status_new = $sc_application->application_status;
                //     } else {
                //         $status_new = NULL;
                //     }
                // }
                // $role_id = Role::where('name', config('commanConfig.dycdo_engineer'))->value('id');
                // $users = User::where('role_id',$role_id)->with(['LayoutUser' => function($query)use($sc_application){
                // $query->where('layout_id',$sc_application->layout_id);
                // }])->whereHas('LayoutUser', function($query)use($sc_application){
                //     $query->where('layout_id',$sc_application->layout_id);
                // })->get();

                // if(count($users) > 0){
                //     $insert_arr = array(
                //         'users' => $users
                //     );

                //     //send application submission mail and msg to society and respective department
                //     $data = $society;
                //     $data['users'] = $users;
                //     $data['application_no'] = $sc_application->application_no;
                //     $data['layout_id'] = $sc_application->layout_id;
                //     $data['application_type'] = $sc_application->scApplicationType->application_type;
                    
                //     $EmailMsgConfigration = new EmailMsgConfigration();
                //     $EmailMsgConfigration->ApplicationSubmissionEmailMsg($data);

                //     $inserted_application_log = $this->CommonController->sc_application_status_society($insert_arr, config('commanConfig.conveyance_status.forwarded'), $sc_application, $status_new);
                //     scApplication::where('id', $sc_application->id)->update(['application_status' => config('commanConfig.conveyance_status.in_process')]);
                // }
            }
        }catch(Exception $e){
            return redirect()->back()->with('error','Something went wrong, Please contact to Admin.');
        }
    }

    /**
     * Uploads stamped society conveyance application form.
     * Author: Amar Prajapati
     * @param  request
     * @return \Illuminate\Http\Response
     */
    public function show_sale_lease($id){
        $id = decrypt($id);
        $sc_application = scApplication::with(['sc_form_request', 'societyApplication', 'applicationLayout', 'scApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->where('id', $id)->first();
        $documents_req = array(
            config('commanConfig.documents.society.conveyance_stamp_duty_letter'),
            config('commanConfig.documents.society.Sale Deed Agreement'),
            config('commanConfig.documents.society.Lease Deed Agreement'),
            config('commanConfig.documents.society.sc_resolution'),
            config('commanConfig.documents.society.sc_undertaking'),
            config('commanConfig.documents.society.sc_Indemnity Bond'),
        );
        $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Conveyance'))->value('id');
        $document_ids = $this->conveyance_common->getDocumentIds($documents_req, $application_type, $sc_application->id);
        $uploaded_document_ids = [];
        $documents_remaining_ids = [];
        foreach($document_ids as $document_id){
            $document_lease[str_replace(' ', '_', strtolower($document_id->document_name))] = $document_id->document_name;
            if($document_id->sc_document_status !== null){
                $uploaded_document_ids[str_replace(' ', '_', strtolower($document_id->document_name))] = $document_id;
            }else{
                $documents_remaining_ids[str_replace(' ', '_', strtolower($document_id->document_name))] = $document_id;
            }
        }

        $documents = SocietyConveyanceDocumentMaster::with(['sc_document_status' => function($q) use($sc_application) { $q->where('application_id', $sc_application->id)->get(); }])->where('application_type_id', $sc_application->sc_application_master_id)->where('society_flag', '1')->where('language_id', '2')->get();
        $documents_uploaded = SocietyConveyanceDocumentStatus::where('application_id', $sc_application->id)->get();

        $sc_agreement_comments = ScAgreementComments::with('scAgreementId')->where('user_id', Auth::user()->id)->where('role_id', Session::get('role_id'))->orderBy('id', 'desc')->get();

        foreach($sc_agreement_comments as $sc_agreement_comment_val){
            foreach($document_ids as $document_id){
                if($document_id->id == $sc_agreement_comment_val->agreement_type_id){
                    $sc_agreement_comment[$sc_agreement_comment_val->scAgreementId->document_name] = $sc_agreement_comment_val;
                }
            }
        }
        $noc = config('commanConfig.scAgreements.conveynace_uploaded_NOC');
        $nocId = $this->conveyance_common->getScAgreementId($noc, $sc_application->sc_application_master_id);
        $issued_noc = $this->conveyance_common->getScAgreement($nocId, $sc_application->id, NULL);
        $uploaded_stamped_application_id = $this->conveyance_common->getDocumentId(config('commanConfig.documents.society.stamp_conveyance_application'), $application_type);        
        $uploaded_stamped_application_ids = $documents_uploaded->pluck('document_path', 'document_id');
        $uploaded_stamped_application = isset($uploaded_stamped_application_ids->toArray()[$uploaded_stamped_application_id])?$uploaded_stamped_application_ids->toArray()[$uploaded_stamped_application_id]:"";

        $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Conveyance'))->value('id');
        $uploaded_stamped_application_id = $this->conveyance_common->getDocumentId(config('commanConfig.documents.society.stamp_conveyance_application'), $application_type);
        $uploaded_stamped_application_ids = $documents_uploaded->pluck('document_path', 'document_id');
        $uploaded_stamped_application = isset($uploaded_stamped_application_ids->toArray()[$uploaded_stamped_application_id])?$uploaded_stamped_application_ids->toArray()[$uploaded_stamped_application_id]:"";

        return view('frontend.society.conveyance.sale_lease_deed', compact('sc_application', 'document_lease', 'documents', 'uploaded_document_ids', 'documents_remaining_ids', 'sc_agreement_comment', 'documents_uploaded', 'issued_noc', 'uploaded_stamped_application'));
    }

    /**
     * Uploads stamped society conveyance application form.
     * Author: Amar Prajapati
     * @param  request
     * @return \Illuminate\Http\Response
     */
    public function show_signed_sale_lease($id){
        $id = decrypt($id);
        $sc_application = scApplication::with(['sc_form_request', 'societyApplication', 'applicationLayout', 'scApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->where('id', $id)->first();

        $SaleAgreement  = config('commanConfig.scAgreements.sale_deed_agreement');
        $LeaseAgreement = config('commanConfig.scAgreements.lease_deed_agreement');
        $Applicationtype = $sc_application->sc_application_master_id;
        $saleId  =$this->conveyance_common->getScAgreementId($SaleAgreement,$Applicationtype);
        $leaseId =$this->conveyance_common->getScAgreementId($LeaseAgreement,$Applicationtype);

        // get registration details
        $saleRegDetails = scRegistrationDetails::where('application_id', $sc_application->id)->where('agreement_type_id',$saleId)->first();

        $leaseRegDetails = scRegistrationDetails::where('application_id', $sc_application->id)->where('agreement_type_id',$leaseId)->first();

        $docStatus = config('commanConfig.documents.society.Register');
        $statusId = ApplicationStatusMaster::where('status_name', $docStatus)->value('id');

        // get register sale nd lease agreement
        $regSaleDocument = SocietyConveyanceDocumentStatus::where('application_id',$sc_application->id)
        ->where('society_flag',1)->where('status_id',$statusId)->where('document_id',$saleId)->first();

        $regLeaseDocument = SocietyConveyanceDocumentStatus::where('application_id',$sc_application->id)
        ->where('society_flag',1)->where('status_id',$statusId)->where('document_id',$leaseId)->first();

        // get sale nd lease documents 
        $status_names = array(
            config('commanConfig.documents.society.Stamped_Signed'),
            config('commanConfig.documents.society.Stamp_by_jtco'),
            config('commanConfig.documents.society.Stamp_by_dycdo'),
            config('commanConfig.documents.society.Draft')
        );

        $status_ids = ApplicationStatusMaster::whereIn('status_name', $status_names)->pluck('id');

        $sale_agreement = SocietyConveyanceDocumentStatus::where('application_id', $sc_application->id)->where('document_id', $saleId)->whereIn('status_id', $status_ids)->orderBy('id','DESC')->first();
        $lease_agreement = SocietyConveyanceDocumentStatus::where('application_id', $sc_application->id)->where('document_id', $leaseId)->whereIn('status_id', $status_ids)->orderBy('id','DESC')->first();

        $stamp = config('commanConfig.documents.society.stamp_conveyance_application');
        $stampUpload = $this->conveyance_common->getDocumentId($stamp,$sc_application->sc_application_master_id); 
        $doc = $this->conveyance_common->getDocumentStatus($sc_application->id,$stampUpload);
        $uploaded_stamped_application = $doc->document_path;
        
        return view('frontend.society.conveyance.signed_sale_lease_deed', compact('sc_application','saleRegDetails','leaseRegDetails','sale_agreement','lease_agreement','uploaded_stamped_application','regSaleDocument','regLeaseDocument'));
    }

    /**
     * Uploads stamped society conveyance application form.
     * Author: Amar Prajapati
     * @param  request
     * @return \Illuminate\Http\Response
     */
    public function upload_sale_lease(Request $request){

        if($request->hasFile('document_path')) {
            $insert_arr = $request->all();
            $file = $request->file('document_path');
            $extension = $file->getClientOriginalExtension();
            $time = time();
            $name = File::name(str_replace(' ', '_', $file->getClientOriginalName())) . '_' . $time . '.' . $extension;
            $folder_name = "society_conveyance_documents";
            $path = '/' . $folder_name . '/' . $name;
            $fileUpload = $this->CommonController->ftpFileUpload($folder_name, $file, $name);
            if($request->document_name == 'sc_resolution' || $request->document_name == 'sc_undertaking' || $request->document_name == 'sc_Indemnity Bond'){
                $status = NULL;
            }else{
                $status = ApplicationStatusMaster::where('status_name', 'Stamped')->value('id');
            }
            $uploaded = $this->conveyance_common->uploadDocumentStatus($request->application_id, $request->document_name, $path, $status);

        }
        if(isset($request->remark)){
            $application_master_id = scApplicationType::where('application_type', config('commanConfig.applicationType.Conveyance'))->first();
            $document_id = $this->conveyance_common->getDocumentId($request->document_name, $application_master_id->id);
            $input = array(
                'application_id' => $request->application_id,
                'user_id' => Auth::user()->id,
                'role_id' => Session::get('role_id'),
                'agreement_type_id' => $document_id,
                'remark' => $request->remark
            );
            $inserted_data = ScAgreementComments::create($input);
            if(count($inserted_data) > 0){
                return redirect()->back();
            }
        }
        return back()->with('success','Document save successfully');
    }

    // forward application after stamp duty
    public function stampForwardApplication(Request $request){
        
        $role_id = Role::where('name', config('commanConfig.dycdo_engineer'))->first();
        $users_record = scApplicationLog::where('application_id', $request->application_id)->where('society_flag', 0)->where('role_id', $role_id->id)->where('status_id', config('commanConfig.conveyance_status.forwarded'))->orderBy('id', 'desc')->first();
        $users = User::where('id', $users_record->user_id)->where('role_id', $users_record->role_id)->get();
        if(count($users) > 0){
            $insert_log_arr = array(
                'users' => $users
            );
        if (isset($request->type) && $request->type == 'register'){
            $status = config('commanConfig.conveyance_status.Registered_sale_&_lease_deed');
        }else{
            $status = config('commanConfig.conveyance_status.Stamped_sale_&_lease_deed');
        }
        $sc_application =scApplication::where('id',$request->application_id)->first();
        $inserted_application_log = $this->CommonController->sc_application_status_society($insert_log_arr, config('commanConfig.conveyance_status.forwarded'), $sc_application, $status);

        // application_status
        $update_sc_application = scApplication::where('id', $request->application_id)->update(['application_status' => $status]);
        return redirect()->back()->with('success', 'Application sent successfully.');
        }else{
            return redirect()->back()->with('error', 'Something went wrong, Please contact to Admin');
        }
    }

    /**
     * Uploads signed sale & lease deed agreement.
     * Author: Amar Prajapati
     * @param  request
     * @return \Illuminate\Http\Response
     */
    public function upload_signed_sale_lease(Request $request){

        $data = $request->all();
        $docStatus = config('commanConfig.documents.society.Register');
        $statusId = ApplicationStatusMaster::where('status_name', $docStatus)->value('id');
        $SaleAgreement  = config('commanConfig.scAgreements.sale_deed_agreement');
        $LeaseAgreement = config('commanConfig.scAgreements.lease_deed_agreement');
        $Applicationtype = $request->applicationType;
        $saleId  =$this->conveyance_common->getScAgreementId($SaleAgreement,$Applicationtype);
        $leaseId =$this->conveyance_common->getScAgreementId($LeaseAgreement,$Applicationtype);

        DB::beginTransaction();
        try{
            // upload sale agreement
            if ($request->hasFile('sale_document')){
                $file = $request->file('sale_document');
                $extension = $file->getClientOriginalExtension();
                $time = time();
                $name = File::name(str_replace(' ', '_', $file->getClientOriginalName())) . '_' . $time . '.' . $extension;
                $folder_name = "society_conveyance_documents";
                $path = '/' . $folder_name . '/' . $name;
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name, $file, $name);

                $arr = ['application_id' => $request->applicationId, 'user_id' => Auth::Id(), 'society_flag' => 1, 'status_id' => $statusId,'document_id' => $saleId, 'document_path' =>$path]; 

                SocietyConveyanceDocumentStatus::updateOrCreate(['application_id' => $request->applicationId,'document_id' => $saleId, 'status_id' => $statusId, 'society_flag' => 1],$arr);
            }

            // upload lease agreement
            if ($request->hasFile('lease_document')){
                $file = $request->file('lease_document');
                $extension = $file->getClientOriginalExtension();
                $time = time();
                $name = File::name(str_replace(' ', '_', $file->getClientOriginalName())) . '_' . $time . '.' . $extension;
                $folder_name = "society_conveyance_documents";
                $path = '/' . $folder_name . '/' . $name;
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name, $file, $name);

                $arr = ['application_id' => $request->applicationId, 'user_id' => Auth::Id(), 'society_flag' => 1, 'status_id' => $statusId,'document_id' => $leaseId, 'document_path' =>$path]; 
                
                SocietyConveyanceDocumentStatus::updateOrCreate(['application_id' => $request->applicationId,'document_id' => $leaseId, 'status_id' => $statusId, 'society_flag' => 1],$arr);
            }

            //save register details
            if ($data['type'] == 'sale'){
                $type = $saleId;
            }elseif ($data['type'] == 'lease'){
                $type = $leaseId;
            }

            $reg = ['application_id' => $data['applicationId'],'agreement_type_id' => $type, 'sub_registrar_name' => $data['sub_registrar_name'], 'registration_year' => $data['registration_year'],'registration_no' => $data['registration_no'],'application_type_id' => $type];

            scRegistrationDetails::updateOrCreate(['application_id' => $data['applicationId'],'agreement_type_id' => $type,],$reg);

        DB::commit();
        return back()->with('Agreement Details Added successfully');            
        }catch(Exception $e){
            DB::rollback();
            return back()->with('error','Agreement Details Added successfully');
        } 
    }

    //generate application Number
    public function generateApplicationNumber($applicationId){

        if (isset($applicationId)){
            $applicationId = scApplication::where('id',$applicationId)->value('application_no');
        }else{
            $id1 = scApplication::orderBy('id','desc')->value('id');
            $id1++;
            $id = str_pad($id1,6, '0', STR_PAD_LEFT);
            $applicationId = 'CON-'.$id;
        }
        return $applicationId;
    }

    // get final conveyance issued document
    public function ConveyanceIssuedDoc($applicationId,$masterId){
        
        $noc = config('commanConfig.scAgreements.conveynace_uploaded_NOC');
        $nocId = $this->conveyance_common->getScAgreementId($noc, $masterId);
        $issued_noc = $this->conveyance_common->getScAgreement($nocId, $applicationId, NULL);
        return $issued_noc;
    }

    // upload other conveyance documents
    public function uploadSCOtherDocuments($applicationId,$documentId){

        $documentId = decrypt($documentId);
        $applicationId = decrypt($applicationId);
        $documents = SocietyConveyanceDocumentStatus::where('application_id', $applicationId)
        ->where('document_id', $documentId)->where('society_flag', 1)->get();

        $sc_application = scApplication::where('id', $applicationId)->with(['scApplicationLog' => function($q) use($applicationId) { $q->where('application_id',$applicationId)->where('society_flag', '1')->orderBy('id', 'desc');
        } ])->first();

        $documents_count = SocietyConveyanceDocumentMaster::where('application_type_id', $sc_application->sc_application_master_id)->where('is_optional',0)->where('society_flag', '1')->where('language_id', '2')->count();

        $documents_uploaded_count = SocietyConveyanceDocumentMaster::with(['sc_document_status' => function($q) use($applicationId) { $q->where('application_id', $applicationId); 
        }])->whereHas('sc_document_status', function($q) use($applicationId) {
            $q->where('application_id', $applicationId);
        })->where('application_type_id', $sc_application->sc_application_master_id)->where('is_optional',0)->where('society_flag', '1')->where('language_id', '2')->count();

        $issued_noc = $this->ConveyanceIssuedDoc($applicationId,$sc_application->sc_application_master_id);

        //get uploaded signed application pdf
        $documentId = $this->conveyance_common->getDocumentId(config('commanConfig.documents.society.stamp_conveyance_application'), $sc_application->sc_application_master_id);
        $doc = $this->conveyance_common->getDocumentStatus($sc_application->id,$documentId);
        $uploaded_stamped_application = $doc->document_path;

        return view('frontend.society.conveyance.upload_sc_other_documents',compact('documents_count','documents','issued_noc','sc_application','documents_uploaded_count','documentId','uploaded_stamped_application'));
    }

    public function saveSCOtherDocuments(Request $request){

        $file = $request->file('file');
        $societyId = $request->societyId;
        $documentId = $request->documentId;
        $applicationId = $request->applicationId;
        $folderName = "society_conveyance_documents"; 

        try{
            if ($file->getClientMimeType() == 'application/pdf') {

                $extension = $request->file('file')->getClientOriginalExtension();
                $fileName = time().'_member_'.$societyId.'.'.$extension;
                $this->CommonController->ftpFileUpload($folderName,$file,$fileName);

                $Documents = new SocietyConveyanceDocumentStatus();
                $Documents->application_id = $applicationId;
                $Documents->document_id = $documentId;
                $Documents->application_id = $applicationId;
                $Documents->society_flag = 1;
                $Documents->other_document_name = $request->memberName;
                $Documents->document_path = $folderName.'/'.$fileName;
                $Documents->save();
                $response['status'] = 'success';
            }else{
                $response['status'] = 'error';
            }
        }catch(Exception $e){
            $response['status'] = 'error';
        }

        return response(json_encode($response), 200); 
    }

    // forward application to admin
    public function scSubmitApplication(Request $request){
        
        $applicationId = $request->applicationId;
        DB::beginTransaction();
        try{
            $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
            $sc_application = scApplication::where('id', $applicationId)->with(['scApplicationType', 'scApplicationLog' => function($q){
                    $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
                } ])->orderBy('id', 'desc')->first();

            if (isset($request->applicationFile)){
                if ($sc_application->scApplicationLog->status_id == config('commanConfig.conveyance_status.pending')) {
                    if ($sc_application->from_user_id != NULL) {
                        $status_new = $sc_application->application_status;
                    } else {
                        $status_new = NULL;
                    }
                }
                $role_id = Role::where('name', config('commanConfig.dycdo_engineer'))->value('id');
                $users = User::where('role_id',$role_id)->with(['LayoutUser' => function($query)use($sc_application){
                $query->where('layout_id',$sc_application->layout_id);
                }])->whereHas('LayoutUser', function($query)use($sc_application){
                    $query->where('layout_id',$sc_application->layout_id);
                })->get();

                if(count($users) > 0){
                    $insert_arr = array(
                        'users' => $users
                    );

                    //send application submission mail and msg to society and respective department
                    $data = $society;
                    $data['users'] = $users;
                    $data['application_no'] = $sc_application->application_no;
                    $data['layout_id'] = $sc_application->layout_id;
                    $data['application_type'] = $sc_application->scApplicationType->application_type;
                    
                    $EmailMsgConfigration = new EmailMsgConfigration();
                    $EmailMsgConfigration->ApplicationSubmissionEmailMsg($data);

                    $inserted_application_log = $this->CommonController->sc_application_status_society($insert_arr, config('commanConfig.conveyance_status.forwarded'), $sc_application, $status_new);
                    scApplication::where('id', $sc_application->id)->update(['application_status' => config('commanConfig.conveyance_status.in_process')]);
                DB::commit();  
                // return redirect()->route('society_conveyance.index');  
                return redirect()->route('society_offer_letter_dashboard')->with('success','Conveyance Application form forwarded successfully.');
                }else{
                    return back()->with('error','Something went wrong, Please contact to Admin.');
                    // also print user not assign error to log
                }
            }else{
                return back()->with('error','Please upload Signed & Stamped Application.');
            }
        }catch(Exception $e){
            DB::rollback();
            return back()->with('error','Something went wrong, Please contact to Admin.'); 
        }           
    }
}
