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

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
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

                        $input_sc_application = array(
                            "sc_application_master_id" => $request->sc_application_master_id,
                            "application_no" => str_pad($sc_form_last_id, 5, '0', STR_PAD_LEFT),
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
                            $input_sc_application['application_no'] = config('commanConfig.mhada_code').str_pad($input_id->id, 5, '0', STR_PAD_LEFT);
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
        //dd($society_bank_details);
        $documents = SocietyConveyanceDocumentMaster::with(['sc_document_status' => function($q) use($sc_application) { $q->where('application_id', $sc_application->id)->get(); }])->where('application_type_id', $sc_application->sc_application_master_id)->where('society_flag', '1')->where('language_id', '2')->get();
        $documents_uploaded = SocietyConveyanceDocumentStatus::where('application_id', $sc_application->id)->where('society_flag', '1')->get();
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
        $sc_bank_details = new SocietyBankDetails;
        $sc_bank_details_fields_name = $sc_bank_details->getFillable();
        $sc_bank_details_fields_name = array_flip($sc_bank_details_fields_name);
        unset($sc_bank_details_fields_name['society_id']);
        $sc_bank_details_fields = array_values(array_flip($sc_bank_details_fields_name));
        $comm_func = $this->CommonController;
    //    dd($documents_uploaded_count);
        $noc = config('commanConfig.scAgreements.conveynace_uploaded_NOC');
        $nocId = $this->conveyance_common->getScAgreementId($noc, $sc_application->sc_application_master_id);
        $issued_noc = $this->conveyance_common->getScAgreement($nocId, $sc_application->id, NULL);

        $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Conveyance'))->value('id');
        $uploaded_stamped_application_id = $this->conveyance_common->getDocumentId(config('commanConfig.documents.society.stamp_conveyance_application'), $application_type);
        $uploaded_stamped_application_ids = $documents_uploaded->pluck('document_path', 'document_id');
        $uploaded_stamped_application = isset($uploaded_stamped_application_ids->toArray()[$uploaded_stamped_application_id])?$uploaded_stamped_application_ids->toArray()[$uploaded_stamped_application_id]:"";

        return view('frontend.society.conveyance.show_doc_bank_details', compact('documents', 'uploaded_stamped_application', 'sc_application', 'society', 'documents_uploaded', 'sc_bank_details_fields', 'comm_func', 'society_bank_details', 'issued_noc', 'documents_count', 'documents_uploaded_count'));
    }

    /**
     * Uploads documents.
     * Author: Amar Prajapati
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function upload_sc_docs(Request $request)
    {
        // dd($request->all());
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
    public function delete_sc_upload_docs($id)
    {
        $id = decrypt($id);

        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $sc_application = scApplication::where('society_id', $society->id)->with(['scApplicationType', 'scApplicationLog' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        } ])->orderBy('id', 'desc')->first();
        
        $documents = SocietyConveyanceDocumentMaster::with(['sc_document_status' => function($q) use($sc_application) { $q->where('application_id', $sc_application->id)->get(); }])->where('application_type_id', $sc_application->sc_application_master_id)->get();
        $documents_uploaded = SocietyConveyanceDocumentStatus::where('application_id', $sc_application->id)->where('id', $id)->first();

        $path = $documents_uploaded->document_path;
        $deleted = Storage::disk('ftp')->delete($path);
        SocietyConveyanceDocumentStatus::where('application_id', $sc_application->id)->where('id', $id)->delete();
        $update_template_file = array(
            'template_file' => ''
        );
        SocietyConveyance::where('society_id', $society->id)->where('id', $sc_application->form_request_id)->update($update_template_file);

        return redirect()->route('sc_upload_docs');
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

        $documents = SocietyConveyanceDocumentMaster::with(['sc_document_status' => function($q) use($sc_application) { $q->where('application_id', $sc_application->id)->get(); }])->where('application_type_id', $sc_application->sc_application_master_id)->where('society_flag', '1')->where('language_id', '2')->get();
        $documents_uploaded = SocietyConveyanceDocumentStatus::where('application_id', $sc_application->id)->get();

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

        return view('frontend.society.conveyance.sc_form_upload_show', compact('sc_application', 'documents', 'documents_uploaded', 'documents_count', 'documents_uploaded_count'));
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
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $sc_application = scApplication::where('society_id', $society->id)->with(['scApplicationType', 'scApplicationLog' => function($q){
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

            //optimize below code with above query (Bhavana)

            // $user_ids = RoleUser::where('role_id', $role_id)->get();
            // $layout_user_ids = LayoutUser::where('layout_id', $sc_application->layout_id)->whereIn('user_id', $user_ids)->get();

            // foreach ($layout_user_ids as $key => $value) {
            //     $select_user_ids[] = $value['user_id'];
            // }

            // $users = User::whereIn('id', $select_user_ids)->get();
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
            }
        }

        return redirect()->route('society_conveyance.index');
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
//        dd($sc_application->scApplicationLog->status_id);
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

        $sc_registration_details = new scRegistrationDetails;
        $sc_document_status = new SocietyConveyanceDocumentStatus;
        $field_names_registrar_details = $sc_registration_details->getFillable();
        $field_names_docs = $sc_document_status->getFillable();

        $field=array_flip($field_names_docs);
        unset($field_names_docs[$field['other_document_name']]);

        $field_names = array_merge($field_names_registrar_details, $field_names_docs);
        $comm_func = $this->CommonController;
        $sale_agreement_type_id = $this->conveyance_common->getDocumentId('Sale Deed Agreement', '1');
        $lease_agreement_type_id = $this->conveyance_common->getDocumentId('Lease Deed Agreement', '1');
        $status = config('commanConfig.documents.society.Register');
        $status_names = array(
            config('commanConfig.documents.society.Stamped_Signed'),
            config('commanConfig.documents.society.Stamp_by_jtco'),
            config('commanConfig.documents.society.Stamp_by_dycdo'),
            config('commanConfig.documents.society.Draft')
        );

        $statuses = ApplicationStatusMaster::whereIn('status_name', $status_names)->get();
        $society_flag = 1;
        $status_ids = array_pluck($statuses, 'id');
        $statuses_ids = array_pluck($statuses, 'status_name', 'id');
        
        $sc_registration_details = scRegistrationDetails::with('scAgreementId')->where('application_id', $sc_application->id)->get();

        foreach($sc_registration_details as $sc_registration_details_val){
            if($sale_agreement_type_id == $sc_registration_details_val->agreement_type_id){
                $sc_registrar_details[$sc_registration_details_val->scAgreementId->document_name] = $sc_registration_details_val;
            }
            if($lease_agreement_type_id == $sc_registration_details_val->agreement_type_id){
                $sc_registrar_details[$sc_registration_details_val->scAgreementId->document_name] = $sc_registration_details_val;
            }
        }

        $sale_agreement = SocietyConveyanceDocumentStatus::where('application_id', $sc_application->id)->where('document_id', $sale_agreement_type_id)->whereIn('status_id', $status_ids)->get();
        $lease_agreement = SocietyConveyanceDocumentStatus::where('application_id', $sc_application->id)->where('document_id', $lease_agreement_type_id)->whereIn('status_id', $status_ids)->get();

        $i= 0;
        $key = 0;
        $sale_deed_agreement= '';
        $lease_deed_agreement= '';
        $is_break = 0;
        $is_sale_agreement_break = 0;
        $lease_deed_agreement_break = 0;

        foreach($status_names as $status_name_key => $status_name){            
            foreach($sale_agreement as $sale_agreement_val){
                
                if($sale_agreement_val->status_id == array_search($status_name, $statuses_ids)){
                    $sale_deed_agreement = $sale_agreement_val;
                    $is_sale_agreement_break = 1;
                    break;
                }else{
                    $is_sale_agreement_break = 0;
                }
            }
            
            foreach($lease_agreement as $lease_agreement_val){
                if(array_search($status_name, $statuses_ids) == $lease_agreement_val->status_id){
                    $lease_deed_agreement = $lease_agreement_val;
                    $lease_deed_agreement_break = 1;
                    break;
                }else{
                    $lease_deed_agreement_break = 0;
                }
            }

            if($is_sale_agreement_break == 1 || $lease_deed_agreement_break == 1){
                break;
            }
        }
        
        
        $documents = SocietyConveyanceDocumentMaster::with(['sc_document_status' => function($q) use($sc_application, $status) { $q->where('application_id', $sc_application->id)->where('status_id', $status)->get(); }])->where('application_type_id', $sc_application->sc_application_master_id)->where('society_flag', '1')->where('language_id', '2')->get();
        $documents_uploaded = SocietyConveyanceDocumentStatus::where('application_id', $sc_application->id)->get();


        $noc = config('commanConfig.scAgreements.conveynace_uploaded_NOC');
        $nocId = $this->conveyance_common->getScAgreementId($noc, $sc_application->sc_application_master_id);
        $issued_noc = $this->conveyance_common->getScAgreement($nocId, $sc_application->id, NULL);

        $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Conveyance'))->value('id');
        $uploaded_stamped_application_id = $this->conveyance_common->getDocumentId(config('commanConfig.documents.society.stamp_conveyance_application'), $application_type);
        $uploaded_stamped_application_ids = $documents_uploaded->pluck('document_path', 'document_id');
        $uploaded_stamped_application = isset($uploaded_stamped_application_ids->toArray()[$uploaded_stamped_application_id])?$uploaded_stamped_application_ids->toArray()[$uploaded_stamped_application_id]:"";
        
        return view('frontend.society.conveyance.signed_sale_lease_deed', compact('sc_application', 'society_flag','status', 'sale_agreement_type_id', 'lease_agreement_type_id', 'field_names', 'comm_func', 'documents', 'documents_uploaded', 'sc_registrar_details', 'sale_deed_agreement', 'lease_deed_agreement', 'issued_noc', 'uploaded_stamped_application'));
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

            // $documents_req = array(
            //     config('commanConfig.documents.society.Sale Deed Agreement'),
            //     config('commanConfig.documents.society.Lease Deed Agreement'),
            //     config('commanConfig.documents.society.sc_resolution'),
            //     config('commanConfig.documents.society.sc_undertaking'),
            //     config('commanConfig.documents.society.sc_Indemnity Bond'),
            // );
            // $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Conveyance'))->value('id');
            // $document_ids = $this->conveyance_common->getDocumentIds($documents_req, $application_type, $request->application_id);
            // $uploaded_document_ids = [];
            // $documents_remaining_ids = [];
            // foreach($document_ids as $document_id){
            //     $document_lease[str_replace(' ', '_', strtolower($document_id->document_name))] = $document_id->document_name;
            //     if($document_id->sc_document_status !== null){
            //         $uploaded_document_ids[str_replace(' ', '_', strtolower($document_id->document_name))] = $document_id;
            //     }else{
            //         $documents_remaining_ids[str_replace(' ', '_', strtolower($document_id->document_name))] = $document_id;
            //     }
            // }

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
    }

    // forward application after stamp duty
    public function ForwardApplication(Request $request){
        $role_id = Role::where('name', config('commanConfig.dycdo_engineer'))->first();
        $users_record = scApplicationLog::where('application_id', $request->application_id)->where('society_flag', 0)->where('role_id', $role_id->id)->where('status_id', config('commanConfig.conveyance_status.forwarded'))->orderBy('id', 'desc')->first();
        $users = User::where('id', $users_record->user_id)->where('role_id', $users_record->role_id)->get();
        $insert_log_arr = array(
            'users' => $users
        );
        $sc_application = new scApplication();
        $sc_application->id = $request->application_id;
        $sc_application->sc_application_master_id = $application_type;
        $inserted_application_log = $this->CommonController->sc_application_status_society($insert_log_arr, config('commanConfig.conveyance_status.forwarded'), $sc_application, config('commanConfig.conveyance_status.Stamped_sale_&_lease_deed'));
        $update_arr = array(
            'application_status' => config('commanConfig.conveyance_status.Stamped_sale_&_lease_deed')
        );
        $update_sc_application = scApplication::where('id', $request->application_id)->update($update_arr);
        return redirect()->back()->with('success', 'Application sent successfully.');
    }

    /**
     * Uploads signed sale & lease deed agreement.
     * Author: Amar Prajapati
     * @param  request
     * @return \Illuminate\Http\Response
     */
    public function upload_signed_sale_lease(Request $request){
        $insert_arr = $request->all();
        $insert_arr['status_id'] = ApplicationStatusMaster::where('status_name', $insert_arr['status_id'])->value('id');

        if($request->hasFile('document_path') || $request->hasFile('document_path_lease')) {
            if($request->hasFile('document_path_lease')){
                $file = $request->file('document_path_lease');
            }else{
                $file = $request->file('document_path');
            }
            $extension = $file->getClientOriginalExtension();
            $time = time();
            $name = File::name(str_replace(' ', '_', $file->getClientOriginalName())) . '_' . $time . '.' . $extension;
            $folder_name = "society_conveyance_documents";
            $path = '/' . $folder_name . '/' . $name;
            $fileUpload = $this->CommonController->ftpFileUpload($folder_name, $file, $name);
            if($request->hasFile('document_path_lease')){
                unset($insert_arr['document_path_lease']);
            }
            $insert_arr['document_path'] = $path;
            unset($insert_arr['_token']);

            $sc_registration_details = new scRegistrationDetails;
            $sc_document_status = new SocietyConveyanceDocumentStatus;

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

            //Code added by Amar >>start
            DB::beginTransaction();
            try {
                scRegistrationDetails::create($insert_registrar_details);
                SocietyConveyanceDocumentStatus::create($insert_sc_document_details);

                $role_id = Role::where('name', config('commanConfig.dycdo_engineer'))->first();
                $users_record = scApplicationLog::where('application_id', $request->application_id)->where('society_flag', 0)->where('role_id', $role_id->id)->where('status_id', config('commanConfig.conveyance_status.forwarded'))->orderBy('id', 'desc')->first();
                $users = User::where('id', $users_record->user_id)->where('role_id', $users_record->role_id)->get();
                $insert_log_arr = array(
                    'users' => $users
                );
                $application_type = scApplicationType::where('application_type', config('commanConfig.applicationType.Conveyance'))->value('id');
                $sc_application = new scApplication();
                $sc_application->id = $request->application_id;
                $sc_application->sc_application_master_id = $application_type;
                $documents_req = array(
                    config('commanConfig.documents.society.Sale Deed Agreement'),
                    config('commanConfig.documents.society.Lease Deed Agreement')
                );
                $document_ids = $this->conveyance_common->getDocumentIds($documents_req, $application_type, $request->application_id);
                $uploaded_document_ids = [];
                $documents_remaining_ids = [];
                foreach($document_ids as $document_id){
                    $document_lease[str_replace(' ', '_', strtolower($document_id->document_name))] = $document_id->document_name;
                    if($document_id->sc_document_status !== null && $document_id->sc_document_status->society_flag == 1){
                        $uploaded_document_ids[str_replace(' ', '_', strtolower($document_id->document_name))] = $document_id;
                    }else{
                        $documents_remaining_ids[str_replace(' ', '_', strtolower($document_id->document_name))] = $document_id;
                    }
                }
                if(count($uploaded_document_ids) == 2 && count($documents_remaining_ids) == 0) {
                    $update_arr = array(
                        'application_status' => config('commanConfig.conveyance_status.Registered_sale_&_lease_deed')
                    );
                    $update_sc_application = scApplication::where('id', $request->application_id)->update($update_arr);
                    $inserted_application_log = $this->CommonController->sc_application_status_society($insert_log_arr, config('commanConfig.conveyance_status.forwarded'), $sc_application, config('commanConfig.conveyance_status.Registered_sale_&_lease_deed'));
                    DB::commit();
                    return redirect()->back()->with('success', 'Application sent successfully.');
                }else{
                    DB::commit();
                }

            }catch (\Exception $ex) {
                dd($ex);
                DB::rollback();
                return redirect()->back()->with('error_db', 'Something went wrong!');
            }
            //Code added by Amar >>end

            return redirect()->back();
        }
    }
}
