<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Auth\SessionGuard;
use App\SocietyOfferLetter;
use App\MasterEmailTemplates;
use App\NocCCRequestForm;
use App\OlApplicationMaster;
use App\NocCCApplication;
use App\NocCCApplicationStatus;
use App\NocCCSocietyDocumentsMaster;
use App\NocCCSocietyDocumentsStatus;
use App\NocCCSocietyDocumentsComment;
use App\MasterLayout;
use App\LayoutUser;
use App\User;
use App\RoleUser;
use App\Role;
use App\Http\Controllers\Common\CommonController;
use File;
use DB;
use Validator;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Redirect;
use Yajra\DataTables\DataTables;
use Config;
// use PDF;
use Mpdf\Mpdf;
// use mPDF;
use Auth;
use Hash;
use Session;
use App\Mail\SocietyOfferLetterForgotPassword;
use Storage;

class SocietyNocforCCController extends Controller
{
	protected $list_num_of_records_per_page;

    public function __construct()
    {
        $this->CommonController = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    public function index(Request $request)
    {
        // dd(Session::all());
        //return view('frontend.society.index');
    }

    public function show_form_self_noc_cc($id){
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $layouts = MasterLayout::all();
        // dd($society_details);
        return view('frontend.society.show_form_self_noc_cc', compact('society_details', 'id', 'layouts'));
    }

    public function save_noc_cc_application_self(Request $request){
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $input = array(
            'society_id' => $society_details->id,
            'offer_letter_date' => date('Y-m-d', strtotime($request->input('offer_letter_date'))),
            'offer_letter_number' => $request->input('offer_letter_number'),
            'no_dues_certificate_number' => $request->input('no_dues_certificate_number'),
            'no_dues_certificate_date' => date('Y-m-d', strtotime($request->input('no_dues_certificate_date'))),
            'noc_no' => $request->input('noc_no'),
            'noc_date' => date('Y-m-d', strtotime($request->input('noc_date'))),
            'tripartite_agreement_number' => $request->input('tripartite_agreement_number'),
            'tripartite_agreement_date' => date('Y-m-d', strtotime($request->input('tripartite_agreement_date'))),
            'created_at' => date('Y-m-d H-i-s'),
            'updated_at' => null
        );

        $last_inserted_id = NocCCRequestForm::create($input);

        $application_master_id_spec = $request->input('application_master_id');

        $insert_application = array(
            'user_id' => Auth::user()->id,
            'language_id' => '1',
            'society_id' => $society_details->id,
            'layout_id' => $request->input('layout_id'),
            'request_form_id' => $last_inserted_id->id,
            'application_master_id' => $application_master_id_spec,
            'application_no' => mt_rand(10,100).time(),
            'application_path' => 'test',
            'submitted_at' => date('Y-m-d'),
            'current_status_id' => '1',
        );
        $last_id = NocCCApplication::create($insert_application);
        $role_id = Role::where('name', 'REE Junior Engineer')->first();
        
        $user_ids = RoleUser::where('role_id', $role_id->id)->get();
        $layout_user_ids = LayoutUser::where('layout_id', $request->input('layout_id'))->whereIn('user_id', $user_ids)->get();
        
        foreach ($layout_user_ids as $key => $value) {
            $select_user_ids[] = $value['user_id'];
        }
        $users = User::whereIn('id', $select_user_ids)->get();
        
        if(count($users) > 0){
            foreach($users as $key => $user){
                $i = 0;
                $insert_application_log_pending[$key]['application_id'] = $last_id->id;
                $insert_application_log_pending[$key]['society_flag'] = 1;
                $insert_application_log_pending[$key]['user_id'] = Auth::user()->id;
                $insert_application_log_pending[$key]['role_id'] = Auth::user()->role_id;
                $insert_application_log_pending[$key]['status_id'] = config('commanConfig.applicationStatus.pending');
                $insert_application_log_pending[$key]['to_user_id'] = $user->id;
                $insert_application_log_pending[$key]['to_role_id'] = $user->role_id;
                $insert_application_log_pending[$key]['remark'] = '';
                $insert_application_log_pending[$key]['created_at'] = date('Y-m-d H-i-s');
                $insert_application_log_pending[$key]['updated_at'] = date('Y-m-d H-i-s');
                $i++;
            }
        }
        
        NocCCApplicationStatus::insert($insert_application_log_pending);
        $last_society_flag_id = NocCCApplicationStatus::where('society_flag', '1')->orderBy('id', 'desc')->first();
        $id = NocCCApplicationStatus::find($last_society_flag_id->id);
        NocCCApplication::where('user_id', Auth::user()->id)->update([
                'current_status_id' => $id->id
            ]);    
        return redirect()->route('society_noc_cc_preview');
    }

    public function showNocApplication(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $society_details = SocietyOfferLetter::find($society->id);
        $noc_application = NocCCApplication::where('user_id', Auth::user()->id)->where('society_id', $society->id)->with(['request_form', 'applicationMasterLayout', 'nocApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc');
        }])->first();
        $layouts = MasterLayout::all();
        $id = $noc_application->application_master_id;
        $noc_applications = $noc_application;

        $documents = NocCCSocietyDocumentsMaster::where('application_id', $noc_application->application_master_id)->with(['documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();

        $optional_docs = config('commanConfig.optional_docs_society_noc_cc');
        $docs_uploaded_count = 0;
        $docs_count = 0;

        foreach($documents as $documents_key => $documents_val){
                if(in_array($documents_key+1, $optional_docs) == false){
                    $docs_count++;
                    if(count($documents_val->documents_uploaded) > 0){
                        $docs_uploaded_count++;
                    }
                }
        }

        $check_upload_avail = 0;
        if($docs_uploaded_count >= $docs_count)
        {
            $check_upload_avail = 1;
        }

//        dd($id);
        return view('frontend.society.show_noc_cc_application_form', compact('society_details', 'noc_applications', 'noc_application', 'layouts', 'id' , 'check_upload_avail'));
    }

    public function editNocApplication(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $society_details = SocietyOfferLetter::find($society->id);
        $noc_application = NocCCApplication::where('user_id', Auth::user()->id)->with(['request_form', 'applicationMasterLayout'])->first();
        $documents = NocCCSocietyDocumentsMaster::where('application_id', $noc_application->application_master_id)->with(['documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();
        $layouts = MasterLayout::all();
        $id = $noc_application->application_master_id;
        $noc_applications = $noc_application;

        $optional_docs = config('commanConfig.optional_docs_society_noc_cc');

        $docs_uploaded_count = 0;
        $docs_count = 0;
        foreach($documents as $documents_key => $documents_val){
                if(in_array($documents_key+1, $optional_docs) == false){
                    $docs_count++;
                    if(count($documents_val->documents_uploaded) > 0){
                        $docs_uploaded_count++;
                    }
                }
        }

        $check_upload_avail = 0;
        if($docs_uploaded_count >= $docs_count)
        {
            $check_upload_avail = 1;
        }

        return view('frontend.society.edit_form_noc_cc', compact('society_details', 'noc_applications', 'noc_application', 'layouts', 'id','check_upload_avail'));
    }

    public function updateNocApplication(Request $request){
//        dd($request->input());
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $update_input = array(
            'offer_letter_date' => date('Y-m-d', strtotime($request->offer_letter_date)),
            'offer_letter_number' => $request->offer_letter_number,
            'no_dues_certificate_number' => $request->no_dues_certificate_number,
            'noc_no' => $request->noc_no,
            'tripartite_agreement_number' => $request->tripartite_agreement_number,
            'no_dues_certificate_date' => date('Y-m-d', strtotime($request->no_dues_certificate_date)),
            'noc_date' => date('Y-m-d', strtotime($request->noc_date)),
            'tripartite_agreement_date' => date('Y-m-d', strtotime($request->tripartite_agreement_date)),
        );
        NocCCRequestForm::where('society_id', $society->id)->where('id', $request->request_form_id)->update($update_input);
        return redirect()->route('society_noc_cc_preview');
    }

    public function displaySocietyDocuments(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
//        dd($society->id);
        $application = NocCCApplication::where('society_id', $society->id)->with(['noc_application_master', 'nocApplicationStatus' => function($q){
                $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
            } ])->orderBy('id', 'desc')->first();
        $noc_applications = $application;
        $documents = NocCCSocietyDocumentsMaster::where('application_id', $application->application_master_id)->with(['documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();
        foreach ($documents as $key => $value) {
            $document_ids[] = $value->id;
        }
        $documents_uploaded = NocCCSocietyDocumentsStatus::where('society_id', $society->id)->whereIn('document_id', $document_ids)->with(['documents_uploaded'])->get();
        
        $documents_comment = NocCCSocietyDocumentsComment::where('society_id', $society->id)->first();
        $optional_docs = config('commanConfig.optional_docs_society_noc_cc');
        $docs_uploaded_count = 0;
        $docs_count = 0;
        foreach($documents as $documents_key => $documents_val){
                if(in_array($documents_key+1, $optional_docs) == false){
                    $docs_count++;
                    if(count($documents_val->documents_uploaded) > 0){
                        $docs_uploaded_count++;
                    }
                }
        }

        $check_upload_avail = 0;
        if($docs_uploaded_count >= $docs_count)
        {
            $check_upload_avail = 1;
        }
        //dd($docs_uploaded_count);
        return view('frontend.society.society_upload_documents_noc_cc', compact('documents','noc_applications',  'optional_docs', 'docs_count', 'docs_uploaded_count', 'documents_uploaded', 'society', 'application', 'documents_comment' , 'check_upload_avail'));
    }

    public function uploadSocietyDocuments(Request $request){
        $uploadPath = '/uploads/society_noc_cc_documents';
        $destinationPath = public_path($uploadPath);

        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();      
        $application = NocCCApplication::where('society_id', $society->id)->first();

        $documents = NocCCSocietyDocumentsMaster::where('application_id', $application->application_master_id)->where('id', $request->input('document_id'))->with(['documents_uploaded' => function($q) use ($society){
                    $q->where('society_id', $society->id)->get();
                }])->get();       
        
        if($request->file('document_name'))
        {
            $file = $request->file('document_name');

            $file_name = time().$file->getFileName().'.'.$file->getClientOriginalExtension();
            $extension = $request->file('document_name')->getClientOriginalExtension();
            if ($extension == "pdf") {
                $time = time();
                $name = File::name($request->file('document_name')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                $folder_name = "society_noc_cc_documents";
                $path = config('commanConfig.storage_server').'/'.$folder_name.'/'.$name;
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('document_name'),$name);
            }else{
                return redirect()->back()->with('error_'.$request->input('document_id'), 'Invalid type of file uploaded (only pdf allowed)');
            }
        }
        $input = array(
            'society_id' => $society->id,
            'document_id' => $request->input('document_id'),
            'society_document_path' => $path,
        );
        NocCCSocietyDocumentsStatus::create($input);
        $documents_master = NocCCSocietyDocumentsMaster::where('application_id', $application->application_master_id)->with(['documents_uploaded' => function($q) use ($society){
                    $q->where('society_id', $society->id)->get();
                }])->get();

        $optional_docs = config('commanConfig.optional_docs_society_noc_cc');

        $docs_uploaded_count = 0;
        $docs_count = 0;
        foreach($documents_master as $documents_key => $documents_val) {
            if (in_array($documents_key + 1, $optional_docs) == false) {
                $docs_count++;
                if (count($documents_val->documents_uploaded) > 0) {
                    $documents_uploaded[] = $documents_val->documents_uploaded;
                    $docs_uploaded_count++;
                }
            }
        }

        if($docs_count == $docs_uploaded_count){
            $role_id = Role::where('name', 'REE Junior Engineer')->first();
            
            $user_ids = RoleUser::where('role_id', $role_id->id)->get();
            // dd($user_ids);
            $layout_user_ids = LayoutUser::where('layout_id', $application->layout_id)->whereIn('user_id', $user_ids)->get();
            foreach ($layout_user_ids as $key => $value) {
                $select_user_ids[] = $value['user_id'];
            }
            $users = User::whereIn('id', $select_user_ids)->get();
            
            if(count($users) > 0){

                foreach($users as $key => $user){
                    $i = 0;
                    $insert_application_log_pending[$key]['application_id'] = $application->id;
                    $insert_application_log_pending[$key]['society_flag'] = 1;
                    $insert_application_log_pending[$key]['user_id'] = Auth::user()->id;
                    $insert_application_log_pending[$key]['role_id'] = Auth::user()->role_id;
                    $insert_application_log_pending[$key]['status_id'] = config('commanConfig.applicationStatus.pending');
                    $insert_application_log_pending[$key]['to_user_id'] = $user->id;
                    $insert_application_log_pending[$key]['to_role_id'] = $user->role_id;
                    $insert_application_log_pending[$key]['remark'] = '';
                    $insert_application_log_pending[$key]['created_at'] = date('Y-m-d H-i-s');
                    $insert_application_log_pending[$key]['updated_at'] = date('Y-m-d H-i-s');
                    $i++;
                }
                // dd(array_merge($insert_application_log_forwarded, $insert_application_log_in_process));
                NocCCApplicationStatus::insert($insert_application_log_pending);
                $add_comment = array(
                    'society_id' => $society->id,
                    'society_documents_comment' => 'N.A.',
                );
                NocCCSocietyDocumentsComment::create($add_comment);
            }
        }
        return redirect()->route('documents_upload_noc_cc')->with('success','Document has been successfully uploaded.');
    }

    public function deleteSocietyDocuments($id){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $application = NocCCApplication::where('society_id', $society->id)->first();

        $documents_master = NocCCSocietyDocumentsMaster::where('application_id', $application->application_master_id)->with(['documents_uploaded' => function($q) use ($society){
                    $q->where('society_id', $society->id)->get();
                }])->get();

        $optional_docs = config('commanConfig.optional_docs_society_noc_cc');

        $docs_uploaded_count = 0;
        $docs_count = 0;
        foreach($documents_master as $documents_key => $documents_val) {
            if (in_array($documents_key + 1, $optional_docs) == false) {
                $docs_count++;
                if (count($documents_val->documents_uploaded) > 0) {
                    $documents_uploaded[] = $documents_val->documents_uploaded;
                    $docs_uploaded_count++;
                }
            }
        }

        if($docs_count == $docs_uploaded_count){
            $role_id = Role::where('name', 'REE Junior Engineer')->first();
            $user_ids = RoleUser::where('role_id', $role_id->id)->get();
            $layout_user_ids = LayoutUser::where('layout_id', $application->layout_id)->whereIn('user_id', $user_ids)->get();
            foreach ($layout_user_ids as $key => $value) {
                $select_user_ids[] = $value['user_id'];
            }
            $users = User::whereIn('id', $select_user_ids)->get();

            if(count($users) > 0){
                foreach($users as $key => $user){
                    $i = 0;
                    $insert_application_log_pending[$key]['application_id'] = $application->id;
                    $insert_application_log_pending[$key]['society_flag'] = 1;
                    $insert_application_log_pending[$key]['user_id'] = Auth::user()->id;
                    $insert_application_log_pending[$key]['role_id'] = Auth::user()->role_id;
                    $insert_application_log_pending[$key]['status_id'] = config('commanConfig.applicationStatus.pending');
                    $insert_application_log_pending[$key]['to_user_id'] = $user->id;
                    $insert_application_log_pending[$key]['to_role_id'] = $user->role_id;
                    $insert_application_log_pending[$key]['remark'] = '';
                    $insert_application_log_pending[$key]['created_at'] = date('Y-m-d H-i-s');
                    $insert_application_log_pending[$key]['updated_at'] = date('Y-m-d H-i-s');
                    $i++;
                }
            }
            NocCCApplicationStatus::insert($insert_application_log_pending);
        }

        $delete_document_details = NocCCSocietyDocumentsStatus::where('society_id', $society->id)->where('document_id', $id)->get();
        $stored_filepath = explode('/', $delete_document_details[0]->society_document_path);
        $folder_name = "society_noc_cc_documents";
        $path = $folder_name.'/'.$stored_filepath[count($stored_filepath)-1];
        $delete = Storage::disk('ftp')->delete($path);
        NocCCSocietyDocumentsStatus::where('society_id', $society->id)->where('document_id', $id)->delete();

        return redirect()->route('documents_upload_noc_cc')->with('success','Document has been discarded successfully.');
    }

    public function addSocietyDocumentsComment(Request $request){
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
        
        NocCCSocietyDocumentsComment::where('society_id', $society->id)->update($input);
        return redirect()->route('upload_noc_application_cc');
    }

    public function showuploadNoc(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $application_details = NocCCApplication::where('society_id', $society->id)->with(['noc_application_master', 'nocApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc');
        }])->first();

        $noc_applications = $application_details;
        $check_upload_avail = 1;
//         dd($ol_applications->ol_application_master);
        return view('frontend.society.upload_downloaded_noc_cc_app', compact('noc_applications', 'application_details','check_upload_avail'));
    }

    public function download_noc_application(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $society_details = SocietyOfferLetter::find($society->id);

        $noc_application = NocCCApplication::where('user_id', Auth::user()->id)->with(['request_form', 'applicationMasterLayout'])->first();
        $layouts = MasterLayout::all(); 
        $id = $noc_application->application_master_id;
        // dd($id);
        $mpdf = new Mpdf();
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $contents = view('frontend.society.display_noc_cc_application', compact('society_details', 'noc_application', 'layouts', 'id'));
        $mpdf->WriteHTML($contents);
        $mpdf->Output();

    }

    public function uploadNocAfterSign(Request $request){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $application_name = NocCCApplication::where('society_id', $society->id)->with('noc_application_master')->get();
        $society_remark = NocCCSocietyDocumentsComment::where('society_id', $society->id)->orderBy('id', 'desc')->first();
        if($request->file('noc_application_form'))
        {
            $file = $request->file('noc_application_form');
            $file_name = time().$file->getFileName().'.'.$file->getClientOriginalExtension();
            $extension = $request->file('noc_application_form')->getClientOriginalExtension();
            if ($extension == "pdf") {
                $time = time();
                $name = File::name($request->file('noc_application_form')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                $folder_name = "society_noc_cc_documents";
                $path = config('commanConfig.storage_server').'/'.$folder_name.'/'.$name;
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('noc_application_form'),$name);
                $input = array(
                    'application_path' => $path,
                    'submitted_at' => date('Y-m-d H-i-s'),
                    'noc_generation_status' => 0
                );
                NocCCApplication::where('society_id', $society->id)->where('id', $request->input('id'))->update($input);
                $role_id = Role::where('name', 'REE Junior Engineer')->first();
                $application = NocCCApplication::where('society_id', $society->id)->where('id', $request->input('id'))->first();
//                dd($application);
                $user_ids = RoleUser::where('role_id', $role_id->id)->get();
                // dd($user_ids);
                $layout_user_ids = LayoutUser::where('layout_id', $application->layout_id)->whereIn('user_id', $user_ids)->get();
                foreach ($layout_user_ids as $key => $value) {
                    $select_user_ids[] = $value['user_id'];
                }
                $users = User::whereIn('id', $select_user_ids)->get();

                if(count($users) > 0) {
                    foreach ($users as $key => $user) {
                        $i = 0;
                        $insert_application_log_forwarded[$key]['application_id'] = $application->id;
                        $insert_application_log_forwarded[$key]['society_flag'] = 1;
                        $insert_application_log_forwarded[$key]['user_id'] = Auth::user()->id;
                        $insert_application_log_forwarded[$key]['role_id'] = Auth::user()->role_id;
                        $insert_application_log_forwarded[$key]['status_id'] = config('commanConfig.applicationStatus.forwarded');
                        $insert_application_log_forwarded[$key]['to_user_id'] = $user->id;
                        $insert_application_log_forwarded[$key]['to_role_id'] = $user->role_id;
                        $insert_application_log_forwarded[$key]['remark'] = isset($society_remark->society_documents_comment) ? $society_remark->society_documents_comment : '' ;
                        $insert_application_log_forwarded[$key]['created_at'] = date('Y-m-d H-i-s');
                        $insert_application_log_forwarded[$key]['updated_at'] = date('Y-m-d H-i-s');

                        $insert_application_log_in_process[$key]['application_id'] = $application->id;
                        $insert_application_log_in_process[$key]['society_flag'] = 0;
                        $insert_application_log_in_process[$key]['user_id'] = $user->id;
                        $insert_application_log_in_process[$key]['role_id'] = $user->role_id;
                        $insert_application_log_in_process[$key]['status_id'] = config('commanConfig.applicationStatus.in_process');
                        $insert_application_log_in_process[$key]['to_user_id'] = 0;
                        $insert_application_log_in_process[$key]['to_role_id'] = 0;
                        $insert_application_log_in_process[$key]['remark'] = isset($society_remark->society_documents_comment) ? $society_remark->society_documents_comment : '' ;
                        $insert_application_log_in_process[$key]['created_at'] = date('Y-m-d H-i-s');
                        $insert_application_log_in_process[$key]['updated_at'] = date('Y-m-d H-i-s');
                        $i++;
                    }
                }
                    NocCCApplicationStatus::insert(array_merge($insert_application_log_forwarded, $insert_application_log_in_process));
            }else{
                return redirect()->back()->with('error_uploaded_file', 'Invalid type of file uploaded (only pdf allowed)');
            }
        }
        return redirect()->route('society_offer_letter_dashboard');
    }

   	public function viewSocietyDocuments(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();      
        $application = NocCCApplication::where('society_id', $society->id)->with(['nocApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->first();
        
        $documents = NocCCSocietyDocumentsMaster::where('application_id', $application->application_master_id)->with(['documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();

        foreach ($documents as $key => $value) {
            $document_ids[] = $value->id;
        }
        $optional_docs = config('commanConfig.optional_docs_society_noc_cc');
//        dd($documents);
        $docs_uploaded_count = 0;
        $docs_count = 0;
        foreach($documents as $documents_key => $documents_val) {
            if (in_array($documents_key + 1, $optional_docs) == false) {
                $docs_count++;
                if (count($documents_val->documents_uploaded) > 0) {
                    $docs_uploaded_count++;
                }
            }
        }
        $noc_applications = $application;
        $documents_uploaded = NocCCSocietyDocumentsStatus::where('society_id', $society->id)->whereIn('document_id', $document_ids)->get();
        $documents_comment = NocCCSocietyDocumentsComment::where('society_id', $society->id)->first();
        
        return view('frontend.society.view_society_uploaded_documents_noc_cc', compact('documents', 'optional_docs', 'docs_uploaded_count','docs_count', 'noc_applications','documents_uploaded', 'documents_comment', 'society'));
    }

    public function resubmitNocApplication(Request $request){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $application = NocCCApplication::where('society_id', $society->id)->first();
        $user = NocCCApplicationStatus::where('application_id', $application->id)->first();

        if(!empty($request->input('remark'))){
            $remark = $request->input('remark');
        }else{
            $remark = 'N.A.';
        }
        $input_forwarded = array(
            'application_id' => $application->id,
            'society_flag' => 1,
            'user_id' => Auth::user()->id,
            'role_id' => Auth::user()->role_id,
            'status_id' => config('commanConfig.applicationStatus.forwarded'),
            'to_user_id' => $user->to_user_id,
            'to_role_id' => $user->to_role_id,
            'remark' => $remark,
            'created_at' => date('Y-m-d H-i-s'),
            'updated_at' => date('Y-m-d H-i-s'),
        );
        $input_in_process = array(
            'application_id' => $application->id,
            'society_flag' => 0,
            'user_id' => $user->to_user_id,
            'role_id' => $user->to_role_id,
            'status_id' => config('commanConfig.applicationStatus.in_process'),
            'to_user_id' => 0,
            'to_role_id' => 0,
            'remark' => $remark,
            'created_at' => date('Y-m-d H-i-s'),
            'updated_at' => date('Y-m-d H-i-s'),
        );
        
        NocCCApplicationStatus::create($input_forwarded);
        NocCCApplicationStatus::create($input_in_process);

        NocCCApplication::where('id',$application->id)->update(["noc_generation_status" => 0]);

        return redirect()->route('society_offer_letter_dashboard');
    }


}