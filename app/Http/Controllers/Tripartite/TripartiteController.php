<?php

namespace App\Http\Controllers\Tripartite;

use App\ApplicationStatusMaster;
use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\Controller;
use App\OlApplication;
use App\OlApplicationStatus;
use App\OlSocietyDocumentsComment;
use App\OlSocietyDocumentsMaster;
use App\OlSocietyDocumentsStatus;
use App\Role;
use App\SocietyOfferLetter;
use App\TripartiteAgreementRemark;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Storage;
use Yajra\DataTables\DataTables;
use App\LayoutUser;

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
                    return date(config('commanConfig.dateFormat'), strtotime($listArray->created_at));
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
        $id = $applicationId;
        $society_details = SocietyOfferLetter::find($ol_application->society_id);
        $ol_applications = OlApplication::where('id', $id)->with(['request_form', 'applicationMasterLayout', 'olApplicationStatus' => function ($q) {
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->first();
        return view('admin.tripartite.view_application', compact('ol_application', 'ol_applications', 'society_details', 'id'));
    }

    public function view_society_documents($applicationId)
    {
        $applicationId = decrypt($applicationId);
        $id = $applicationId;
        $ol_application = $this->comman->getOlApplication($applicationId);
        $society = SocietyOfferLetter::where('id', $ol_application->society_id)->first();
        $society_details = SocietyOfferLetter::find($ol_application->society_id);
        $ol_applications = OlApplication::where('id', $id)->with(['request_form', 'applicationMasterLayout', 'olApplicationStatus' => function ($q) {
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->first();
       
        $documents = OlSocietyDocumentsMaster::where('application_id', $ol_applications->application_master_id)->where('is_admin', 0)->with(['documents_uploaded' => function ($q) use ($ol_application) {
            $q->where('society_id', $ol_application->society_id)->where('application_id',$ol_application->id)->get();
        }])->get();

        $document_ids = array_pluck($documents, 'id');
        $documents_uploaded = OlSocietyDocumentsStatus::with('document_name')->where('society_id', $ol_application->society_id)->where('application_id',$ol_applications->id)->whereIn('document_id', $document_ids)->get();
        $documents_comment = OlSocietyDocumentsComment::where('application_id',$ol_applications->id)
        ->where('society_id', $ol_application->society_id)->first();
        $documents_complusory = [];
        foreach ($documents as $key => $value) {
            if ($value->is_optional == 0) {
                $documents_complusory[] = $value;
            }
        }

        $documents_uploaded_complusory = [];
        foreach ($documents_uploaded as $key => $value) {
            if ($value->document_name->is_optional == 0) {
                $documents_uploaded_complusory[] = $value;
            }
        }
        if (count($documents_complusory) == count($documents_uploaded_complusory) || count($documents_complusory) < count($documents_uploaded)) {
            $docs_comment = OlSocietyDocumentsComment::where('application_id',$ol_applications->id)->where('society_id', $ol_application->society_id)->where('application_id', $ol_applications->id)->first();
            $input = array(
                'society_id' => $ol_application->society_id,
                'application_id' => $ol_applications->id,
                'society_documents_comment' => 'N.A.',
            );
            if ($docs_comment) {
                //OlSocietyDocumentsComment::where('id', $docs_comment->id)->update($input);
            } else {
                OlSocietyDocumentsComment::create($input);
            }
            $show_comment_tab = 1;
        } else {
            $show_comment_tab = 0;
        }
        return view('admin.tripartite.view_society_documents', compact('ol_application', 'ol_applications', 'id', 'documents', 'society', 'show_comment_tab', 'documents_comment'));
    }

    public function get_tripartite_agreements($ol_application_id, $agreement_type)
    {
        $ol_application = $this->comman->getOlApplication($ol_application_id);
        $document_type_id = $ol_application->application_master_id;
        $agreement_type = $agreement_type;
        $OlSocietyDocumentsMaster = OlSocietyDocumentsMaster::where(['application_id' => $document_type_id, 'name' => $agreement_type])->first();
        if ($OlSocietyDocumentsMaster) {
            $documents_id = $OlSocietyDocumentsMaster->id;
            return OlSocietyDocumentsStatus::where(['application_id'=>$ol_application_id ,'society_id' => $ol_application->society_id, 'document_id' => $OlSocietyDocumentsMaster->id])->orderBy('id', 'desc')->first();
        }
        return null;
    }

    public function set_tripartite_agreements($ol_application, $agreement_type, $path, $status_id = 0)
    {
        // //dd('ok');
        // $document_type_id = $ol_application->application_master_id;
        // $agreement_type = $agreement_type;
        // $OlSocietyDocumentsMaster = OlSocietyDocumentsMaster::where(['application_id' => $document_type_id, 'name' => $agreement_type])->first();
        // if ($OlSocietyDocumentsMaster) {

        //     $documents_id = $OlSocietyDocumentsMaster->id;
        //     $OlSocietyDocumentsStatus = OlSocietyDocumentsStatus::where(['society_id' => $ol_application->society_id, 'document_id' => $OlSocietyDocumentsMaster->id])->first();
        //     if ($OlSocietyDocumentsStatus) {
        //         $OlSocietyDocumentsStatus->society_document_path = $path;
        //         $OlSocietyDocumentsStatus->status_id = $status_id;
        //         $OlSocietyDocumentsStatus->save();
        //     } else {
        //         $OlSocietyDocumentsStatus = new OlSocietyDocumentsStatus;
        //         $OlSocietyDocumentsStatus->society_id = $ol_application->society_id;
        //         $OlSocietyDocumentsStatus->document_id = $OlSocietyDocumentsMaster->id;
        //         $OlSocietyDocumentsStatus->society_document_path = $path;
        //         $OlSocietyDocumentsStatus->status_id = $status_id;
        //         $OlSocietyDocumentsStatus->save();
        //     }
        //     return $OlSocietyDocumentsStatus;
        // }
        // return null;
        $document_type_id = $ol_application->application_master_id;
        $agreement_type = $agreement_type;
        $OlSocietyDocumentsMaster = OlSocietyDocumentsMaster::where(['application_id' => $document_type_id, 'name' => $agreement_type])->first();
        if ($OlSocietyDocumentsMaster) {
            $document_type_id = $ol_application->application_master_id;
            $agreement_type = $agreement_type;

            $OlSocietyDocumentsStatus = new OlSocietyDocumentsStatus;
            $OlSocietyDocumentsStatus->application_id = $ol_application->id;
            $OlSocietyDocumentsStatus->society_id = $ol_application->society_id;
            $OlSocietyDocumentsStatus->document_id = $OlSocietyDocumentsMaster->id;
            $OlSocietyDocumentsStatus->society_document_path = $path;
            $OlSocietyDocumentsStatus->status_id = $status_id;
            $OlSocietyDocumentsStatus->save();
            if ($OlSocietyDocumentsStatus) {
                return $OlSocietyDocumentsStatus;
            }
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
                $drafted_agreement = $this->get_tripartite_agreements($ol_application->id, config('commanConfig.tripartite_agreements.drafted'));
                if (($drafted_agreement->status_id == $this->get_document_status_by_name('Stamped')) || ($drafted_agreement->status_id == $this->get_document_status_by_name('Stamped_Signed'))) {
                    if (session()->get('role_name') == config('commanConfig.co_engineer')) {
                        $status = $this->get_document_status_by_name('Approved');
                    } else {
                        $status = $this->get_document_status_by_name('Stamped_Signed');
                    }

                } else {
                    $status = $this->get_document_status_by_name('Draft_Sign');
                }
                $this->set_tripartite_agreements($ol_application, config('commanConfig.tripartite_agreements.drafted'), $fileUpload, $status);
                return redirect()->back()->with('success', 'Draft copy of Agreement has been uploaded successfully.');
            } else {
                return redirect()->back()->with('error', 'Invalid format. pdf file only.');
            }
        }
    }

    public function getTripartiteRemarks($application_id)
    {
        return TripartiteAgreementRemark::with(['Roles'])->where(['application_id' => $application_id])->get();
    }

    public function setTripartiteRemark(Request $request)
    {
        $remark = array(
            'application_id' => $request->applicationId,
            'user_id' => auth()->user()->id,
            'role_id' => session()->get('role_id'),
            'remark' => $request->remark,
        );
        if (TripartiteAgreementRemark::insert($remark)) {
            return back()->with('success', 'Remark added successfully');
        }

        return back()->with('error', 'Something went wrong');
    }

    public function tripartite_agreement($applicationId)
    {
        $stamped_by_society = 0;
        $stamped_and_signed = 0;
        $approved_by_co = 0;
        $applicationId = decrypt($applicationId);
        $ol_application = $this->comman->getOlApplication($applicationId);
        $applicationLog = $this->comman->getCurrentStatus($applicationId);
        $tripartite_agrement['text_agreement_name'] = $this->get_tripartite_agreements($ol_application->id, config('commanConfig.tripartite_agreements.text'));
        $tripartite_agrement['drafted_tripartite_agreement'] = $this->get_tripartite_agreements($ol_application->id, config('commanConfig.tripartite_agreements.drafted'));
        //$tripartite_agrement['drafted_signed_tripartite_agreement'] = $this->get_tripartite_agreements($ol_application->id, config('commanConfig.tripartite_agreements.drafted_signed'));

        if ($tripartite_agrement['drafted_tripartite_agreement'] != null) {
            $stamped_by_society = (($this->get_document_status_by_name('Stamped') == $tripartite_agrement['drafted_tripartite_agreement']->status_id) || ($this->get_document_status_by_name('Stamped_Signed') == $tripartite_agrement['drafted_tripartite_agreement']->status_id)) ? 1 : 0;
            $stamped_and_signed = ($this->get_document_status_by_name('Stamped_Signed') == $tripartite_agrement['drafted_tripartite_agreement']->status_id) ? 1 : 0;
            $approved_by_co = ($this->get_document_status_by_name('Approved') == $tripartite_agrement['drafted_tripartite_agreement']->status_id) ? 1 : 0;
        }

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

        $tripatiet_remark_history = $this->getTripartiteRemarks($applicationId);

        $societyData['ree_Jr_id'] = (session()->get('role_name') == config('commanConfig.ree_junior'));
        $societyData['ree_branch_head'] = (session()->get('role_name') == config('commanConfig.ree_branch_head')); 

        $roleId = Role::where('name', '=', config('commanConfig.co_engineer'))->value('id');
        $coName = User::where('role_id',$roleId)->value('name');

        $LAroleId = Role::where('name', '=', config('commanConfig.la_engineer'))->value('id');
        $LAName = User::where('role_id',$LAroleId)->value('name');
       
        return view('admin.tripartite.tripartite_agreement', compact('approved_by_co', 'stamped_and_signed', 'stamped_by_society', 'societyData', 'applicationLog', 'ol_application', 'tripatiet_remark_history', 'tripartite_agrement', 'content','coName','LAName'));
    }

    public function ree_note($applicationId)
    {
        $applicationId = decrypt($applicationId);
        $ol_application = $this->comman->getOlApplication($applicationId);
        $applicationLog = $this->comman->getCurrentStatus($applicationId);
        $ree_note = $this->get_tripartite_agreements($ol_application->id, config('commanConfig.tripartite_agreements.ree_note'));
        return view('admin.tripartite.ree_note', compact('ol_application', 'ree_note', 'applicationId', 'applicationLog'));
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

    public function getForwardApplicationParentData($applicationId)
    {
        $result = array();
        if (session()->get('role_name') == config('commanConfig.co_engineer')) {
            $roles = Role::whereIn('name', [config('commanConfig.la_engineer'), config('commanConfig.ree_junior')])->get();
            foreach ($roles as $role) {
                $result[] = $role->id;
            }
        } else if (session()->get('role_name') == config('commanConfig.la_engineer')) {
            $role_id = Role::where('name', config('commanConfig.co_engineer'))->first();
            $result[] = $role_id->id;
        } else if (session()->get('role_name') == config('commanConfig.ree_branch_head')) {
            $SocietyOfferLetter = OlApplication::find($applicationId);
            $society_user_id = $SocietyOfferLetter->user_id;
            $society_user = User::where('id', $society_user_id)->get();
            $role_id = Role::where('name', config('commanConfig.co_engineer'))->first();
            $result[] = $role_id->id;
        } else {
            $role_id = Role::where('id', auth()->user()->role_id)->first();
            //$result = json_decode($role_id->parent_id);
            $result[] = $role_id->parent_id;
            //$result = json_decode($result);
        }
        //dd($result);
        $parent = "";
        if ($result) {
            $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
            $layout_ids = array_column($layout_id_array, 'layout_id');
            $parent = User::with(['roles', 'LayoutUser' => function ($q) use($layout_ids){
                $q->whereIn('layout_id', $layout_ids);
            }])->whereHas('LayoutUser', function ($q)  use($layout_ids){
                    $q->whereIn('layout_id', $layout_ids);
                })->whereIn('role_id', $result)->get();
        }
        $approved_by_co = 0;
        if (session()->get('role_name') == config('commanConfig.ree_branch_head')) {
            $tripartite_agrement['drafted_tripartite_agreement'] = $this->get_tripartite_agreements($applicationId, config('commanConfig.tripartite_agreements.drafted'));

            if ($tripartite_agrement['drafted_tripartite_agreement']){
                $approved_by_co = ($this->get_document_status_by_name('Approved') == $tripartite_agrement['drafted_tripartite_agreement']->status_id) ? 1 : 0;
                if ($approved_by_co == 1) {
                    $parent = $society_user;
                } else {
                    $parent = $parent->merge($society_user);
                    //$parent = $parent;
                }                
            }
        }
        
        return $parent;
    }

    public function getRevertApplicationChildData($society_id)
    {
        $SocietyOfferLetter = SocietyOfferLetter::find($society_id);
        $society_user_id = $SocietyOfferLetter->user_id;
        $society_user = User::where('id', $society_user_id)->get();

       // LA user find
        $la_user_find=User::with(['roles'=>function($q){
            $q->where('name',config('commanConfig.la_engineer'));
        }])->whereHas('roles',function($q){
            $q->where('name',config('commanConfig.la_engineer'));
        })->first();
        $la_user = User::where('id', $la_user_find->id)->get();


        $ignore_roles = array();
        $ignore_role = Role::whereIn('name', ['dyce_engineer', 'ee_engineer'])->get();
        if ($ignore_role) {
            foreach ($ignore_role as $ignore_rol) {
                $ignore_roles[] = $ignore_rol->id;
            }
        }

        $role_id = Role::where('id', auth()->user()->role_id)->first();
        $result = json_decode($role_id->child_id);
        $child = "";
        if ($result) {
            foreach ($result as $key => $res) {
                if (in_array($res, $ignore_roles)) {
                    unset($result[$key]);
                }
            }
            $child = User::with(['roles', 'LayoutUser' => function ($q) {
                $q->where('layout_id', session('layout_id'));
            }])
                ->whereHas('LayoutUser', function ($q) {
                    $q->where('layout_id', session('layout_id'));
                })
                ->whereIn('role_id', $result)->get();
        }
// dd($child);
        if ($child) {
            if(session()->get('role_name')==config('commanConfig.ree_branch_head'))
            {
                $child = $child->merge($society_user);
            }

            if(session()->get('role_name')==config('commanConfig.co_engineer'))
            {
                $child = $child->merge($la_user);
            }
        }
        //dd($child);
        return $child;
    }

    public function getForwardApplicationData($applicationId)
    {
        // dd($applicationId);
        $data = OlApplication::with('eeApplicationSociety')
            ->where('id', $applicationId)->first();

        $society_id = $data->society_id;
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
        $master_log = array();
       // dd($data_logs[0]);
        foreach ($data_logs as $data_log) {
            foreach ($data_log as $log) {
                if ($log->status_id == config('commanConfig.applicationStatus.forwarded')) {
                    $status = 'Forwarded';
                } elseif ($log->status_id == config('commanConfig.applicationStatus.reverted')) {
                    $status = 'Reverted';
                } else {
                    $status = '';
                }
                $master_log[$log->id]['role_id'] = (isset($log) && $log->created_at != '' ? $log->getCurrentRole->name : '');
                $master_log[$log->id]['date'] = (isset($log) && $log->created_at != '' ? date("d-m-Y", strtotime($log->created_at)) : '');
                $master_log[$log->id]['time'] = (isset($log) && $log->created_at != '' ? date("H:i", strtotime($log->created_at)) : '');
                $master_log[$log->id]['action'] = $status . ' to ' . (isset($log->getRoleName->display_name) ? $log->getRoleName->display_name : '');
                $master_log[$log->id]['description'] = (isset($log) ? $log->remark : '');
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
        //dd($societyLogs);
        $ReeLogs = $this->getLogsOfReeDepartment($applicationId);
        $CoLogs = $this->getLogsOfCoDepartment($applicationId);
        $LaLogs = $this->getLogsOfLaDepartment($applicationId);
        $master_log = $this->get_master_log_of_status(array($societyLogs, $ReeLogs, $CoLogs, $LaLogs));
        //dd($master_log);
        return view('admin.tripartite.forward_application', compact('master_log', 'ol_application', 'applicationId', 'tripartite_application', 'data', 'societyLogs', 'ReeLogs', 'CoLogs', 'LaLogs'));
    }

    public function saveForwardApplication(Request $request)
    {
        //return $request->all();
        $forwardData = $this->forwardApplication($request);
        return redirect()->route('tripartite.index')->with('success', 'Application sent successfully.');
    }

    public function get_society_role_from_user_id($user_id)
    {
        $user = User::where(['id' => $user_id])->whereHas('roles', function ($q) {
            $q->where('name', config('commanConfig.society_offer_letter'));
        })->first();
        if ($user) {
            return $user->role_id;
        }
        return 0;
    }

    // forward and revert application
    public function forwardApplication(Request $request)
    {
        $society_flag = 0;
        $is_reverted_to_society = 0;
        $is_approved_agreement = 0;
        $sc_application = OlApplication::where('id', $request->applicationId)->first();

        if ($request->check_status == 1) {

            if ($request->to_role_id == $this->get_society_role_from_user_id($request->to_user_id)) {
                $society_flag = 1;
                $agreement = $this->get_tripartite_agreements($request->applicationId, config('commanConfig.tripartite_agreements.drafted'));
                if ($agreement) {
                    if ($agreement->status_id == $this->get_document_status_by_name('Approved')) {
                        $is_approved_agreement = config('commanConfig.applicationStatus.approved_tripartite_agreement');
                        $status = config('commanConfig.applicationStatus.approved_tripartite_agreement');
                        $Tostatus = config('commanConfig.applicationStatus.approved_tripartite_agreement');
                    } else {
                        $is_approved_agreement = config('commanConfig.applicationStatus.draft_tripartite_agreement');
                        $status = config('commanConfig.applicationStatus.sent_for_stamp_duty_registration');
                        $Tostatus = config('commanConfig.applicationStatus.pending');
                    }
                } else {
                    $is_approved_agreement = config('commanConfig.applicationStatus.draft_tripartite_agreement');
                    $status = config('commanConfig.applicationStatus.sent_for_stamp_duty_registration');
                    $Tostatus = config('commanConfig.applicationStatus.pending');
                }

            } else {
                $status = config('commanConfig.applicationStatus.forwarded');
                $Tostatus = config('commanConfig.applicationStatus.in_process');
            }

        } else {

            if ($request->to_role_id == $this->get_society_role_from_user_id($request->to_user_id)) {
                $is_reverted_to_society = 1;
                $society_flag = 1;
                $status = config('commanConfig.applicationStatus.reverted');
                $Tostatus = config('commanConfig.applicationStatus.pending');
            } else {
                $status = config('commanConfig.applicationStatus.reverted');
                $Tostatus = config('commanConfig.applicationStatus.in_process');
            }

        }

        //$Tostatus = config('commanConfig.applicationStatus.in_process');
        // if($data->no_dues_certificate_sent_to_society==1 && session()->get('role_name')==config('commanConfig.dycdo_engineer'))
        // {
        //     $Tostatus = config('commanConfig.applicationStatus.processed_to_DDR');

        // }else
        // {
        //     $Tostatus = config('commanConfig.applicationStatus.in_process');
        // }

        $application = [[
            'application_id' => $request->applicationId,
            'user_id' => auth()->user()->id,
            'role_id' => session()->get('role_id'),
            'status_id' => $status,
            'to_user_id' => $request->to_user_id,
            'to_role_id' => $request->to_role_id,
            'society_flag' => 0,
            'remark' => $request->remark,
            'created_at' => Carbon::now(),
            'is_active' => 1,
            'phase' => ($sc_application->current_status_id == config('commanConfig.applicationStatus.approved_tripartite_agreement') || $sc_application->current_status_id == config('commanConfig.applicationStatus.draft_tripartite_agreement'))? 1 : 0
        ],
            [
                'application_id' => $request->applicationId,
                'user_id' => $request->to_user_id,
                'role_id' => $request->to_role_id,
                'status_id' => $Tostatus,
                'to_user_id' => null,
                'to_role_id' => null,
                'society_flag' => $society_flag,
                'remark' => $request->remark,
                'created_at' => Carbon::now(),
                'is_active' => 1,
                'phase' => ($sc_application->current_status_id == config('commanConfig.applicationStatus.approved_tripartite_agreement') || $sc_application->current_status_id == config('commanConfig.applicationStatus.draft_tripartite_agreement'))? 1 : 0
            ],
        ];

        \DB::transaction(function () use ($is_reverted_to_society, $request, $application, $is_approved_agreement) {
            if ($is_reverted_to_society == 1) {
                OlApplication::where('id', $request->applicationId)->update(['is_reverted_to_society' => $is_reverted_to_society]);
            }
            if ($is_approved_agreement != 0) {
                OlApplication::where('id', $request->applicationId)->update(['current_status_id' => $is_approved_agreement,'is_approve_offer_letter'=>($is_approved_agreement==config('commanConfig.applicationStatus.approved_tripartite_agreement')?1:0)]);
            }
            OlApplicationStatus::where('application_id',$request->applicationId)
                    ->whereIn('user_id', [auth()->user()->id,$request->to_user_id ])
                    ->update(array('is_active' => 0));
            OlApplicationStatus::insert($application);
        });
    }

}
