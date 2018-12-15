<?php

namespace App\Http\Controllers\Tripartite;

use App\ApplicationStatusMaster;
use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\Controller;
use App\OlSocietyDocumentsMaster;
use App\OlSocietyDocumentsStatus;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Storage;
use Yajra\DataTables\DataTables;
use App\TripartiteAgreementRemark;
use App\OlApplication;
use App\Role;
use App\OlApplicationStatus;
use App\User;
use App\LayoutUser;
use App\SocietyOfferLetter;
use Carbon\Carbon;

class TripartiteController extends Controller
{
    public function __construct()
    {
        $this->comman = new CommonController();
        $this->list_num_of_records_per_page = config('commanConfig.list_num_of_records_per_page');
        $this->society_level_billing = config('commanConfig.SOCIETY_LEVEL_BILLING');
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
            ['data' => 'radio', 'name' => 'radio', 'title' => '', 'searchable' => false],
            ['data' => 'rownum', 'name' => 'rownum', 'title' => 'Sr No.', 'searchable' => false],
            ['data' => 'application_no', 'name' => 'application_no', 'title' => 'Application Number'],
            ['data' => 'submitted_at', 'name' => 'submitted_at', 'title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name', 'name' => 'eeApplicationSociety.name', 'title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no', 'name' => 'eeApplicationSociety.building_no', 'title' => 'Building No'],
            ['data' => 'eeApplicationSociety.address', 'name' => 'eeApplicationSociety.address', 'title' => 'Address', 'class' => 'datatable-address'],
//            ['data' => 'model','name' => 'model','title' => 'Model'],
            ['data' => 'Status', 'name' => 'current_status_id', 'title' => 'Status'],
            // ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {

            $ee_application_data = $this->comman->listApplicationData($request, 'tripartite');

            return $datatables->of($ee_application_data)
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++;return $i;
                })
                ->editColumn('radio', function ($ee_application_data) {
                    $url = route('tripartite.view_application', encrypt($ee_application_data->id));
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="' . $url . '" name="village_data_id"><span></span></label>';
                })
                ->editColumn('eeApplicationSociety.name', function ($listArray) {
                    return $listArray->eeApplicationSociety->name;
                })
                ->editColumn('eeApplicationSociety.building_no', function ($listArray) {
                    return $listArray->eeApplicationSociety->building_no;
                })
                ->editColumn('eeApplicationSociety.address', function ($listArray) {
                    return "<span>" . $listArray->eeApplicationSociety->address . "</span>";
                })
                ->editColumn('Status', function ($listArray) use ($request) {
                    $status = $listArray->olApplicationStatusForLoginListing[0]->status_id;
                    // dd(config('commanConfig.applicationStatusColor.'.$status));
                    if ($request->update_status) {
                        if ($request->update_status == $status) {
                            $config_array = array_flip(config('commanConfig.applicationStatus'));
                            $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                            return '<span class="m-badge m-badge--' . config('commanConfig.applicationStatusColor.' . $status) . ' m-badge--wide">' . $value . '</span>';
                        }
                    } else {
                        $config_array = array_flip(config('commanConfig.applicationStatus'));
                        $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                        return '<span class="m-badge m-badge--' . config('commanConfig.applicationStatusColor.' . $status) . ' m-badge--wide">' . $value . '</span>';
                    }

                })
                ->editColumn('submitted_at', function ($listArray) {
                    return date(config('commanConfig.dateFormat'), strtotime($listArray->submitted_at));
                })
            // ->editColumn('actions', function ($ee_application_data) use($request) {
            //     return view('admin.ee_department.actions', compact('ee_application_data', 'request'))->render();
            // })
                ->rawColumns(['radio', 'society_name', 'society_building_no', 'society_address', 'Status', 'submitted_at', 'eeApplicationSociety.address'])
                ->make(true);
        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.tripartite.index', compact('html', 'header_data', 'getData'));
    }

    protected function getParameters()
    {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering' => 'isSorted',
            "order" => [1, "asc"],
            "pageLength" => $this->list_num_of_records_per_page,
        ];
    }

    public function view_application($applicationId)
    {
        $applicationId = decrypt($applicationId);
        $ol_application = $this->comman->getOlApplication($applicationId);
        return view('admin.tripartite.view_application', compact('ol_application'));
    }

    public function view_society_documents($applicationId)
    {
        $applicationId = decrypt($applicationId);
        $ol_application = $this->comman->getOlApplication($applicationId);
        return view('admin.tripartite.view_society_documents', compact('ol_application'));
    }

    public function get_tripartite_agreements($ol_application_id, $agreement_type)
    {
        $ol_application = $this->comman->getOlApplication($ol_application_id);
        $document_type_id = $ol_application->application_master_id;
        $agreement_type = $agreement_type;
        $OlSocietyDocumentsMaster = OlSocietyDocumentsMaster::where(['application_id' => $document_type_id, 'name' => $agreement_type])->first();
        if ($OlSocietyDocumentsMaster) {
            $documents_id = $OlSocietyDocumentsMaster->id;
            return OlSocietyDocumentsStatus::where(['society_id' => $ol_application->society_id, 'document_id' => $OlSocietyDocumentsMaster->id])->first();
        }
        return null;
    }

    public function set_tripartite_agreements($ol_application, $agreement_type, $path, $status_id = 0)
    {
        //dd('ok');
        $document_type_id = $ol_application->application_master_id;
        $agreement_type = $agreement_type;
        $OlSocietyDocumentsMaster = OlSocietyDocumentsMaster::where(['application_id' => $document_type_id, 'name' => $agreement_type])->first();
        if ($OlSocietyDocumentsMaster) {

            $documents_id = $OlSocietyDocumentsMaster->id;
            $OlSocietyDocumentsStatus = OlSocietyDocumentsStatus::where(['society_id' => $ol_application->society_id, 'document_id' => $OlSocietyDocumentsMaster->id])->first();
            if ($OlSocietyDocumentsStatus) {
                $OlSocietyDocumentsStatus->society_document_path = $path;
                $OlSocietyDocumentsStatus->status_id = $status_id;
                $OlSocietyDocumentsStatus->save();
            } else {
                $OlSocietyDocumentsStatus = new OlSocietyDocumentsStatus;
                $OlSocietyDocumentsStatus->society_id = $ol_application->society_id;
                $OlSocietyDocumentsStatus->document_id = $OlSocietyDocumentsMaster->id;
                $OlSocietyDocumentsStatus->society_document_path = $path;
                $OlSocietyDocumentsStatus->status_id = $status_id;
                $OlSocietyDocumentsStatus->save();
            }
            return $OlSocietyDocumentsStatus;
        }
        return null;
    }

    public function get_document_status_by_name($name)
    {
        $status = ApplicationStatusMaster::where(['status_name' => $name])->first();
        if ($status) {
            return $status->id;
        }
        return 0;
    }

    public function saveTripartiteagreement(Request $request)
    {
        $id = $request->applicationId;
        $ol_application = $this->comman->getOlApplication($id);
        $content = str_replace('_', "", $_POST['ckeditorText']);

        $pdf_folder_name = 'Draft_tripartite_agreement';
        $header_file = '';
        $footer_file = '';
        $header_file = view('admin.REE_department.offer_letter_header');
        $footer_file = view('admin.REE_department.offer_letter_footer');

        $pdf = new Mpdf([
            'default_font_size' => 9,
            'default_font' => 'Times New Roman',
        ]);
        $pdf->autoScriptToLang = true;
        $pdf->autoLangToFont = true;
        $pdf->setAutoBottomMargin = 'stretch';
        $pdf->setAutoTopMargin = 'stretch';
        $pdf->SetHTMLHeader($header_file);
        $pdf->SetHTMLFooter($footer_file);
        $pdf->WriteHTML($content);
        $fileName = 'tripartite_agrrement_' . $ol_application->application_no . '.pdf';
        $filePath = $pdf_folder_name . "/" . $fileName;
        if (!(Storage::disk('ftp')->has($pdf_folder_name))) {
            Storage::disk('ftp')->makeDirectory($pdf_folder_name, $mode = 0777, true, true);
        }
        Storage::disk('ftp')->put($filePath, $pdf->output($fileName, 'S'));
        //$file = $pdf->output();

        $text_folder_name = 'text_tripartite_agreement';

        if (!(Storage::disk('ftp')->has($text_folder_name))) {
            Storage::disk('ftp')->makeDirectory($text_folder_name, $mode = 0777, true, true);
        }
        $file_nm = "text_tripartite_agreement_" . $ol_application->application_no . '.txt';
        $filePath1 = $text_folder_name . "/" . $file_nm;
        //dd($filePath);
        Storage::disk('ftp')->put($filePath1, $content);
        $this->set_tripartite_agreements($ol_application, config('commanConfig.tripartite_agreements.text'), $filePath1);
        $this->set_tripartite_agreements($ol_application, config('commanConfig.tripartite_agreements.drafted'), $filePath, $this->get_document_status_by_name('Draft'));

        if ((session()->get('role_name') == config('commanConfig.ree_junior')) && $this->get_tripartite_agreements($ol_application->id, config('commanConfig.tripartite_agreements.drafted')) != null) {
            return back()->with('success', 'Agreement generated successfully.');
        }
    }

    public function upload_signed_tripartite_agreement(Request $request)
    {
        $applicationId = $request->applicationId;
        $ol_application = $this->comman->getOlApplication($applicationId);
        if ($request->file('signed_agreement')) {
            $file = $request->file('signed_agreement');
            $extension = $file->getClientOriginalExtension();
            $file_name = 'signed_agreement_' . $applicationId . '.' . $extension;
            $folder_name = "signed_tripartite_agreement";
            if ($extension == "pdf") {
                $fileUpload = $this->comman->ftpFileUpload($folder_name, $request->file('signed_agreement'), $file_name);
                $this->set_tripartite_agreements($ol_application, config('commanConfig.tripartite_agreements.drafted'), $fileUpload, $this->get_document_status_by_name('Draft_Sign'));
                return redirect()->back()->with('success', 'Draft copy of Agreement has been uploaded successfully.');
            } else {
                return redirect()->back()->with('error', 'Invalid format. pdf file only.');
            }
        }
    }

    public function getTripartiteRemarks($application_id)
    {
        return TripartiteAgreementRemark::with(['Roles'])->where(['application_id'=>$application_id])->get();
    }

    public function setTripartiteRemark(Request $request)
    {
        $remark=array(
            'application_id'=>$request->applicationId,
            'user_id'=>auth()->user()->id,
            'role_id'=>session()->get('role_id'),
            'remark'=>$request->remark
        );
        if(TripartiteAgreementRemark::insert($remark))
        {
            return back()->with('success','Remark added successfully');
        }

        return back()->with('error','Something went wrong');
    }

    public function tripartite_agreement($applicationId)
    {
        $applicationId = decrypt($applicationId);
        $ol_application = $this->comman->getOlApplication($applicationId);
        $applicationLog = $this->comman->getCurrentStatus($applicationId);
        $tripartite_agrement['text_agreement_name'] = $this->get_tripartite_agreements($ol_application->id, config('commanConfig.tripartite_agreements.text'));
        $tripartite_agrement['drafted_tripartite_agreement'] = $this->get_tripartite_agreements($ol_application->id, config('commanConfig.tripartite_agreements.drafted'));
        $tripartite_agrement['drafted_signed_tripartite_agreement'] = $this->get_tripartite_agreements($ol_application->id, config('commanConfig.tripartite_agreements.drafted_signed'));
        if ($tripartite_agrement['text_agreement_name'] != null) {
            $text_doc_path = $tripartite_agrement['text_agreement_name']->society_document_path;
            if ($text_doc_path != null) {
                $content = Storage::disk('ftp')->get($text_doc_path);
            } else {
                $content = "";
            }
        } else {
            $content = "";
        }
        $tripatiet_remark_history=$this->getTripartiteRemarks($applicationId);
        //dd($tripatiet_remark_history);
        $societyData['ree_Jr_id'] = (session()->get('role_name') == config('commanConfig.ree_junior'));
        $societyData['ree_branch_head'] = (session()->get('role_name') == config('commanConfig.ree_branch_head'));
        return view('admin.tripartite.tripartite_agreement', compact('societyData', 'applicationLog', 'ol_application','tripatiet_remark_history', 'tripartite_agrement', 'content'));
    }

    public function ree_note($applicationId)
    {
        $applicationId = decrypt($applicationId);
        $ol_application = $this->comman->getOlApplication($applicationId);
        $applicationLog = $this->comman->getCurrentStatus($applicationId);
        $ree_note = $this->get_tripartite_agreements($ol_application->id, config('commanConfig.tripartite_agreements.ree_note'));
        return view('admin.tripartite.ree_note', compact('ol_application', 'ree_note', 'applicationId','applicationLog'));
    }

    public function upload_ree_note(Request $request)
    {
        $ol_application = $this->comman->getOlApplication($request->applicationId);
        $applicationId = $request->applicationId;
        $uploadPath = '/uploads/tripartite_ree_note';
        $destinationPath = public_path($uploadPath);

        if ($request->file('tripartite_ree_note')) {

            $file = $request->file('tripartite_ree_note');
            $extension = $file->getClientOriginalExtension();
            $file_name = time() . 'tripartite_ree_note.' . $extension;
            $folder_name = "tripartite_ree_note";
            $path = $folder_name . "/" . $file_name;

            if ($extension == "pdf") {

                $fileUpload = $this->comman->ftpFileUpload($folder_name, $request->file('tripartite_ree_note'), $file_name);
                $ree_note = $this->set_tripartite_agreements($ol_application, config('commanConfig.tripartite_agreements.ree_note'), $path);
                return back()->with('success', 'Ree Note has been uploaded successfully');
            } else {
                return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
            }
        }
    }

    // get current status of application
    public function getCurrentStatus($application_id, $masterId)
    {
        $current_status = OlApplicationStatus::where('application_id', $application_id)
            // ->where('application_master_id', $masterId)
            ->where('user_id', auth()->user()->id)
            ->where('role_id', session()->get('role_id'))
            ->orderBy('id', 'desc')->first();

        return $current_status;
    }

    public function getForwardApplicationParentData($society_id)
    {
        $result = array();
        if (session()->get('role_name') == config('commanConfig.co_engineer')) {
            $roles = Role::whereIn('name', [config('commanConfig.la_engineer'),config('commanConfig.ree_junior')])->get();
            foreach($roles as $role)
            {
                $result[] = $role->id;
            }
        } else if (session()->get('role_name') == config('commanConfig.la_engineer')) {
            $role_id = Role::where('name', config('commanConfig.co_engineer'))->first();
            $result[] = $role_id->id;
        } else if (session()->get('role_name') == config('commanConfig.ree_branch_head')) {
            $SocietyOfferLetter= SocietyOfferLetter::find($society_id);
            $society_user_id=$SocietyOfferLetter->user_id;
            $society_user=User::where('id',$society_user_id)->get();
            $role_id = Role::where('name', config('commanConfig.co_engineer'))->first();
            $result[] = $role_id->id;
        }else{
            $role_id = Role::where('id', auth()->user()->role_id)->first();
            //$result = json_decode($role_id->parent_id);
            $result[] = $role_id->parent_id;
            //$result = json_decode($result);
        }
         //dd($result);
        $parent = "";
        if ($result) {
            $parent = User::with(['roles', 'LayoutUser' => function ($q) {
                $q->where('layout_id', session('layout_id'));
            }])
                ->whereHas('LayoutUser', function ($q) {
                    $q->where('layout_id', session('layout_id'));
                })
                ->whereIn('role_id', $result)->get();
        }
        if (session()->get('role_name') == config('commanConfig.ree_branch_head')) {
            $parent = $parent->merge($society_user);
        }
        //dd($parent);
        return $parent;
    }

    public function getRevertApplicationChildData($society_id)
    {
       $SocietyOfferLetter= SocietyOfferLetter::find($society_id);
       $society_user_id=$SocietyOfferLetter->user_id;
       $society_user=User::where('id',$society_user_id)->get();
      // dd($society_user);
        $role_id = Role::where('id', auth()->user()->role_id)->first();
        $result = json_decode($role_id->child_id);
        $child = "";
        //dd($result);
        if ($result) {
            $child = User::with(['roles', 'LayoutUser' => function ($q) {
                $q->where('layout_id', session('layout_id'));
            }])
                ->whereHas('LayoutUser', function ($q) {
                    $q->where('layout_id', session('layout_id'));
                })
                ->whereIn('role_id', $result)->get();
        }

        if($child)
        {
            $child = $child->merge($society_user);
        }
        //dd($child);
        return $child;
    }

    public function getForwardApplicationData($applicationId)
    {
        // dd($applicationId);
        $data = OlApplication::with('eeApplicationSociety')
            ->where('id', $applicationId)->first();
            
        $society_id=$data->society_id;
        $data->society_role_id = Role::where('name', config('commanConfig.society_offer_letter'))->value('id');
        
        $data->status = $this->getCurrentStatus($applicationId, $data->application_master_id);
        
        $data->parent = $this->getForwardApplicationParentData($applicationId);
        
        $data->child = $this->getRevertApplicationChildData($society_id);
        return $data;
    }

    public function getLogsOfSociety($applicationId)
    {
        $roles = array(config('commanConfig.society_offer_letter'));

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $societyRoles = Role::whereIn('name', $roles)->pluck('id');
        $ocietylogs = OlApplicationStatus::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)->where('society_flag', '=', '1')->whereIn('role_id', $societyRoles)->whereIn('status_id', $status)->get();


        return $ocietylogs;
    }

    public function getLogsOfReeDepartment($applicationId)
    {

        $roles = array(config('commanConfig.ree_junior'), config('commanConfig.ree_branch_head'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'));

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $reeRoles = Role::whereIn('name', $roles)->pluck('id');
        $reeLogs = OlApplicationStatus::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)
            ->whereIn('role_id', $reeRoles)->whereIn('status_id', $status)->get();

        return $reeLogs;
    }

    public function getLogsOfCoDepartment($applicationId)
    {

        $roles = array(config('commanConfig.co_engineer'));

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $reeRoles = Role::whereIn('name', $roles)->pluck('id');
        $reeLogs = OlApplicationStatus::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)
            ->whereIn('role_id', $reeRoles)->whereIn('status_id', $status)->get();

        return $reeLogs;
    }

    public function getLogsOfLaDepartment($applicationId)
    {

        $roles = array(config('commanConfig.la_engineer'));

        $status = array(config('commanConfig.applicationStatus.forwarded'), config('commanConfig.applicationStatus.reverted'));

        $reeRoles = Role::whereIn('name', $roles)->pluck('id');
        $reeLogs = OlApplicationStatus::with(['getRoleName', 'getRole'])->where('application_id', $applicationId)
            ->whereIn('role_id', $reeRoles)->whereIn('status_id', $status)->get();

        return $reeLogs;
    }

    public function get_master_log_of_status($data_logs)
    {
        $master_log=array();
        foreach($data_logs as $data_log)
        {
            foreach($data_log as $log)
            {
                if($log->status_id == config('commanConfig.applicationStatus.forward'))
                {
                $status = 'Forwarded';
                }
                elseif($log->status_id ==config('commanConfig.applicationStatus.reverted'))
                {
                $status = 'Reverted';
                }else
                {
                    $status='';
                }
                $master_log[$log->id]['role_id']=(isset($log) && $log->created_at != '' ? $log->getCurrentRole->name : '');
                $master_log[$log->id]['date']=(isset($log) && $log->created_at != '' ? date("d-m-Y",strtotime($log->created_at)) : '');
                $master_log[$log->id]['time']=(isset($log) && $log->created_at != '' ? date("H:i",strtotime($log->created_at)) : '');
                $master_log[$log->id]['action']=$status.' to '.(isset($log->getRoleName->display_name)?$log->getRoleName->display_name : '');
                $master_log[$log->id]['description']=(isset($log)? $log->remark : '');
            }
        }
        ksort($master_log);
        return $master_log;
        
    }

    public function forward_application($applicationId)
    {
        $applicationId = decrypt($applicationId);
        $ol_application = $this->comman->getOlApplication($applicationId);
        $tripartite_application = OlApplication::with('eeApplicationSociety')->where('id', $applicationId)->first();
        $data = $this->getForwardApplicationData($applicationId);
        $societyLogs = $this->getLogsOfSociety($applicationId);
        $ReeLogs = $this->getLogsOfReeDepartment($applicationId);
        $CoLogs = $this->getLogsOfCoDepartment($applicationId);
        $LaLogs = $this->getLogsOfLaDepartment($applicationId);
        $master_log=$this->get_master_log_of_status(array($societyLogs,$ReeLogs,$CoLogs,$LaLogs));
        return view('admin.tripartite.forward_application',compact('master_log','ol_application','applicationId','tripartite_application','data','societyLogs','ReeLogs','CoLogs','LaLogs'));
    }

    public function saveForwardApplication(Request $request)
    {
        //return $request->all();
        $forwardData = $this->forwardApplication($request);
        return redirect()->route('tripartite.index')->with('success', 'Application sent successfully.');
    }

    // forward and revert application
    public function forwardApplication(Request $request)
    {

        $Scstatus = "";
        $data = OlApplication::where('id', $request->applicationId)->first();
        $applicationStatus = $data->application_status;
        if ($request->check_status == 1) {
            
            $status = config('commanConfig.formation_status.forwarded');
        } else {
            $status = config('commanConfig.formation_status.reverted');
        }

        $Tostatus = config('commanConfig.formation_status.in_process');
        // if($data->no_dues_certificate_sent_to_society==1 && session()->get('role_name')==config('commanConfig.dycdo_engineer'))
        // {
        //     $Tostatus = config('commanConfig.formation_status.processed_to_DDR');
            
        // }else
        // {
        //     $Tostatus = config('commanConfig.formation_status.in_process');
        // }

        $application = [[
            'application_id' => $request->applicationId,
            'user_id' => auth()->user()->id,
            'role_id' => session()->get('role_id'),
            'status_id' => $status,
            'to_user_id' => $request->to_user_id,
            'to_role_id' => $request->to_role_id,
            'remark' => $request->remark,
            'created_at' => Carbon::now(),
        ],
            [
                'application_id' => $request->applicationId,
                'user_id' => $request->to_user_id,
                'role_id' => $request->to_role_id,
                'status_id' => $Tostatus,
                'to_user_id' => null,
                'to_role_id' => null,
                'remark' => $request->remark,
                'created_at' => Carbon::now(),
            ],
        ];

        OlApplicationStatus::insert($application);
        if ($Scstatus != "") {
            SfApplication::where('id', $request->applicationId)->where('sc_application_master_id', $masterId)
                ->update(['application_status' => $Tostatus]);
        }
    }

}
