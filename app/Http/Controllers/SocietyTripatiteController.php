<?php

namespace App\Http\Controllers;

use App\ApplicationStatusMaster;
use App\OlApplication;
use App\OlApplicationStatus;
use Illuminate\Http\Request;
use App\SocietyOfferLetter;
use App\MasterLayout;
use App\OlRequestForm;
use App\Http\Controllers\Common\CommonController;
use App\Role;
use App\RoleUser;
use App\LayoutUser;
use App\User;
use Config;
use App\OlSocietyDocumentsMaster;
use App\OlSocietyDocumentsStatus;
use App\OlSocietyDocumentsComment;
use App\OlApplicationMaster;
use File;
use Storage;
use Mpdf\Mpdf;
use Auth;

class SocietyTripatiteController extends Controller
{
    public function __construct()
    {
        $this->CommonController = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    /**
     * Shows tripatite application form.
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show_tripatite_self($id){
        $ids = explode('_', $id);
        $id = $ids[0];
        $society_details = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
        $ol_form_request_fields = new OlRequestForm;

        foreach($ol_form_request_fields->getFillable() as $key => $value){
            if(in_array($value, config('commanConfig.tripartite_fields'))){
                $form_fields[] = $value;
            }
        }
        $layouts = MasterLayout::all();
        $comm_func = $this->CommonController;

        $data = OlApplication::where('user_id', auth()->user()->id)->where('application_master_id',$id)->with(['request_form', 'ol_application_master', 'applicationMasterLayout'])->orderBy('id','desc')->first();

        if (isset($data)){
            return redirect()->route('tripartite_application_form_edit',encrypt($data->id));
        }else{
            return view('frontend.society.tripatite.show_tripatite_self', compact('society_details', 'id', 'ids', 'layouts', 'form_fields', 'layouts', 'comm_func'));   
        }        
    }

    /**
     * Shows tripatite application form.
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function save_tripatite_self(Request $request){

        $ol_request_form_details = new OlRequestForm;
        $ol_request_form_details = $ol_request_form_details->getFillable();
        $ol_request_form['society_id'] = $request->society_id;
        foreach($request->all() as $key => $ol_request_form_detail){
            if(in_array($key, $ol_request_form_details) == true){
                $ol_request_form[$key] = $ol_request_form_detail;
            }
        }

        $ol_request_form_id = OlRequestForm::create($ol_request_form);
        $input_arr_ol_applications = array(
            'user_id' => auth()->user()->id,
            'language_id' => 1,
            'society_id' => $request->society_id,
            'layout_id' => $request->layout_id,
            'request_form_id' => $ol_request_form_id->id,
            'application_master_id' => $request->application_master_id,
            'application_no' => 'MHD'.str_pad($ol_request_form_id->id, 5, '0', STR_PAD_LEFT),
            'current_status_id' => config('commanConfig.applicationStatus.in_process')
        );
        $ol_application = OlApplication::create($input_arr_ol_applications);

        $role_id = Role::where('name', config('commanConfig.ree_junior'))->first();
        $user_ids = RoleUser::where('role_id', $role_id->id)->get();
        $layout_user_ids = LayoutUser::where('layout_id', $request->input('layout_id'))->whereIn('user_id', $user_ids)->get();

        foreach ($layout_user_ids as $key => $value) {
            $select_user_ids[] = $value['user_id'];
        }
        $users = User::whereIn('id', $select_user_ids)->get();

        $insert_arr = array(
            'users' => $users
        );

        $this->CommonController->tripartite_application_status_society($insert_arr, config('commanConfig.applicationStatus.pending'), $ol_application);

        $id = encrypt($ol_application->id);

        return redirect()->route('tripartite_application_form_preview', $id);
    }

    /**
     * Shows edit tripatite application form.
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function tripartite_application_form_edit($id){
        $id = decrypt($id);
        $society = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
        $society_details = SocietyOfferLetter::find($society->id);
        $ol_applications = OlApplication::where('id', $id)->with(['request_form', 'ol_application_master', 'applicationMasterLayout', 'olApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->first();
        $ol_form_request_fields = new OlRequestForm;

        foreach($ol_form_request_fields->getFillable() as $key => $value){
            if(in_array($value, config('commanConfig.tripartite_fields'))){
                $form_fields[] = $value;
                $form_fields_values[$value] = $ol_applications->request_form->$value;
            }
        }
        $layouts = MasterLayout::all();
        $comm_func = $this->CommonController;

        $title = OlApplicationMaster::where('id',$ol_applications->ol_application_master->parent_id)->value('title');

        return view('frontend.society.tripatite.edit_tripatite_application', compact('society', 'society_details', 'ol_applications', 'layouts', 'comm_func', 'form_fields', 'id', 'form_fields_values','title'));
    }

    /**
     * Updates tripatite application form data.
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function tripartite_application_form_update(Request $request){
        $ol_request_form_details = new OlRequestForm;
        $ol_request_form_details = $ol_request_form_details->getFillable();
        $ol_request_form['society_id'] = $request->society_id;
        $ol_application_data =  OlApplication::where('id', $request->application_id)->first();

        foreach($request->all() as $key => $ol_request_form_detail){
            if(in_array($key, $ol_request_form_details) == true){
                $ol_request_form[$key] = $ol_request_form_detail;
            }
        }

        $ol_request_form_id = OlRequestForm::where('id', $ol_application_data->request_form_id)->update($ol_request_form);

        $input_arr_ol_applications = array(
            'user_id' => auth()->user()->id,
            'language_id' => 1,
            'society_id' => $request->society_id,
            'layout_id' => $request->layout_id,
            'request_form_id' => $ol_application_data->request_form_id,
            'application_master_id' => $request->application_master_id,
            'application_no' => 'MHD'.str_pad($ol_application_data->request_form_id, 5, '0', STR_PAD_LEFT),
            'current_status_id' => config('commanConfig.applicationStatus.in_process')
        );
        $ol_application = OlApplication::where('id', $request->application_id)->update($input_arr_ol_applications);

        $role_id = Role::where('name', config('commanConfig.ree_junior'))->first();
        $user_ids = RoleUser::where('role_id', $role_id->id)->get();
        $layout_user_ids = LayoutUser::where('layout_id', $request->input('layout_id'))->whereIn('user_id', $user_ids)->get();

        foreach ($layout_user_ids as $key => $value) {
            $select_user_ids[] = $value['user_id'];
        }
        $users = User::whereIn('id', $select_user_ids)->get();
        $insert_arr = array(
            'users' => $users
        );

        $this->CommonController->tripartite_application_status_society($insert_arr, config('commanConfig.applicationStatus.pending'), $ol_application_data);

        $id = encrypt($ol_application_data->id); 

        return redirect()->route('tripartite_application_form_preview', $id);
    }

    /**
     * Shows tripatite application form.
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show_tripatite_dev($id){
        $ids = explode('_', $id);
        $id = $ids[0];
        $society_details = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
        $ol_form_request_fields = new OlRequestForm;

        foreach($ol_form_request_fields->getFillable() as $key => $value){
            if(in_array($value, config('commanConfig.tripartite_fields'))){
                $form_fields[] = $value;
            }
        }
        $layouts = MasterLayout::all();
        $comm_func = $this->CommonController;

        $data = OlApplication::where('user_id', auth()->user()->id)->where('application_master_id',$id)->with(['request_form', 'ol_application_master', 'applicationMasterLayout'])->orderBy('id','desc')->first();

        if (isset($data)){
            return redirect()->route('tripartite_application_form_edit',encrypt($data->id));
        }else{
            return view('frontend.society.tripatite.show_tripatite_dev', compact('society_details', 'id', 'ids', 'layouts', 'form_fields', 'layouts', 'comm_func'));  
        }        
    }

    /**
     * Shows tripatite application form.
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function save_tripatite_dev(Request $request){
        $ol_request_form_details = new OlRequestForm;
        $ol_request_form_details = $ol_request_form_details->getFillable();
        $ol_request_form['society_id'] = $request->society_id;
        foreach($request->all() as $key => $ol_request_form_detail){
            if(in_array($key, $ol_request_form_details) == true){
                $ol_request_form[$key] = $ol_request_form_detail;
            }
        }
        $ol_request_form_id = OlRequestForm::create($ol_request_form);
        $input_arr_ol_applications = array(
            'user_id' => auth()->user()->id,
            'language_id' => 1,
            'society_id' => $request->society_id,
            'layout_id' => $request->layout_id,
            'request_form_id' => $ol_request_form_id->id,
            'application_master_id' => $request->application_master_id,
            'application_no' => 'MHD'.str_pad($ol_request_form_id->id, 5, '0', STR_PAD_LEFT),
            'current_status_id' => config('commanConfig.applicationStatus.in_process')
        );
        $ol_application = OlApplication::create($input_arr_ol_applications);


        $role_id = Role::where('name', config('commanConfig.ree_junior'))->first();
        $user_ids = RoleUser::where('role_id', $role_id->id)->get();
        $layout_user_ids = LayoutUser::where('layout_id', $request->input('layout_id'))->whereIn('user_id', $user_ids)->get();

        foreach ($layout_user_ids as $key => $value) {
            $select_user_ids[] = $value['user_id'];
        }
        $users = User::whereIn('id', $select_user_ids)->get();
        $insert_arr = array(
            'users' => $users
        );
        $id = encrypt($ol_application->id);

        $this->CommonController->tripartite_application_status_society($insert_arr, config('commanConfig.applicationStatus.pending'), $ol_application);
        return redirect()->route('tripartite_application_form_preview', $id);
    }


    /**
     * Shows tripatite application form preview.
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function tripartite_application_form_preview($id){
        // dd("hi");
         $id = decrypt($id);

        $society = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
        $society_details = SocietyOfferLetter::find($society->id);
        $ol_applications = OlApplication::where('id', $id)->with(['request_form', 'applicationMasterLayout', 'olApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->first();
        $applicationCount = $this->getForwardedApplication();

        return view('frontend.society.tripatite.tripartite_application_form_preview', compact('ol_applications', 'society_details', 'id','applicationCount'));
    }

    /**
     * Shows tripatite application documents.
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function display_tripartite_docs($id){

        $id = decrypt($id);
        $society = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
        $society_details = SocietyOfferLetter::find($society->id);
        $ol_applications = OlApplication::where('id', $id)->with(['request_form', 'applicationMasterLayout', 'olApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->first();
        $documents = OlSocietyDocumentsMaster::where('application_id', $ol_applications->application_master_id)->where('is_admin', 0)->with(['documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();
//        dd($documents);

        $document_ids = array_pluck($documents, 'id');
        $documents_uploaded = OlSocietyDocumentsStatus::with('document_name')->where('society_id', $society->id)->whereIn('document_id', $document_ids)->get();
        $documents_comment = OlSocietyDocumentsComment::where('society_id', $society->id)->where('application_id', $ol_applications->id)->first();
        $documents_complusory = [];
        foreach ($documents as $key => $value) {
            if($value->is_optional == 0){
                $documents_complusory[] = $value;
            }
        }

        $documents_uploaded_complusory = [];
        foreach ($documents_uploaded as $key => $value) {
            if($value->document_name->is_optional == 0){
                $documents_uploaded_complusory[] = $value;
            }
        }

        if(count($documents_complusory) == count($documents_uploaded_complusory) || count($documents_complusory) < count($documents_uploaded)){
            $docs_comment = OlSocietyDocumentsComment::where('society_id', $society->id)->where('application_id', $ol_applications->id)->first();
            $input = array(
                'society_id' => $society->id,
                'application_id' => $ol_applications->id
            );
            if($docs_comment){
                $input['society_documents_comment'] = $docs_comment->society_documents_comment;
                OlSocietyDocumentsComment::where('id', $docs_comment->id)->update($input);
            }else{
                $input['society_documents_comment'] = 'N.A.';
                OlSocietyDocumentsComment::create($input);
            }
            $show_comment_tab = 1;
        }else{
            $show_comment_tab = 0;
        }
        if($documents_comment && $documents_comment->society_documents_comment == 'N.A.'){
            $documents_comment->society_documents_comment = '';
        }
        return view('frontend.society.tripatite.show_society_documents', compact('ol_applications', 'documents', 'documents_uploaded', 'documents_comment', 'id', 'society', 'society_details', 'show_comment_tab'));

    }

    /**
     * Saves tripatite application documents.
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function upload_tripartite_docs(Request $request){
       // dd($request->all());
       $applicationId = $request->application_id;
        $uploadPath = '/uploads/society_tripartite_agreement_documents';
        $destinationPath = public_path($uploadPath);

        $society = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
        $application = OlApplication::where('id',$applicationId)->where('society_id', $society->id)
        ->first();

        $documents = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->where('is_admin', 0)->with(['documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();

        foreach ($documents as $key => $value) {
            $document_ids[] = $value->id;
        }
        $documents_uploaded = OlSocietyDocumentsStatus::where('society_id', $society->id)->whereIn('document_id', $document_ids)->get();
        $documents_comment = OlSocietyDocumentsComment::where('society_id', $society->id)->first();

        if($request->file('document_name'))
        {
            $file = $request->file('document_name');
            $file_name = time().$file->getFileName().'.'.$file->getClientOriginalExtension();
            $extension = $request->file('document_name')->getClientOriginalExtension();
            if ($extension == "pdf") {
                $time = time();
                $name = File::name($request->file('document_name')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                $folder_name = "society_tripartite_agreement_documents";
                $path = $folder_name.'/'.$name;
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('document_name'),$name);

            }else{
                return redirect()->back()->with('error_'.$request->input('document_id'), 'Invalid type of file uploaded (only pdf allowed)');
            }
        }

        //$input = array(
          //  'society_id' => $society->id,
            //'document_id' => $request->input('document_id'),
            //'society_document_path' => $path,
        //);
        //OlSocietyDocumentsStatus::create($input);


        $role_id = Role::where('name', config('commanConfig.ree_junior'))->first();
        $user_ids = RoleUser::where('role_id', $role_id->id)->get();
        $layout_user_ids = LayoutUser::where('layout_id', $application->layout_id)->whereIn('user_id', $user_ids)->get();
        foreach ($layout_user_ids as $key => $value) {
            $select_user_ids[] = $value['user_id'];
        }
        $users = User::whereIn('id', $select_user_ids)->get();
        $insert_arr = array(
            'users' => $users
        );
        $input = array(
            'society_id' => $society->id,
            'application_id' => $applicationId,
            'document_id' => $request->input('document_id'),
            'society_document_path' => $path,
        );
        OlSocietyDocumentsStatus::create($input);
//        $this->CommonController->tripartite_application_status_society($insert_arr, config('commanConfig.applicationStatus.forwarded'), $application);
        return redirect()->back();
    }

    /**
     * Saves tripatite application documents.
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function delete_tripartite_docs($id){
        $id = decrypt($id);
        $society = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
        $delete_document_details = OlSocietyDocumentsStatus::with('document_name')->where('society_id', $society->id)->where('document_id', $id)->first();
        $documents = OlSocietyDocumentsMaster::where('application_id', $delete_document_details->document_name->application_id)->where('is_admin', 0)->with(['documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();

        $docs_uploaded = 0;
        $docs_remain = 0;
        foreach($documents as $document){
            if(count($document->documents_uploaded) > 0){
                $docs_uploaded++;
            }else{
                $docs_remain++;
            }
        }
//        if($docs_uploaded > 0 && $docs_remain == 0){
//
//        }

        $stored_filepath = explode('/', $delete_document_details->society_document_path);
        $folder_name = "society_offer_letter_documents";
        $path = $folder_name.'/'.$stored_filepath[count($stored_filepath)-1];
        $delete = Storage::disk('ftp')->delete($path);
        OlSocietyDocumentsStatus::where('society_id', $society->id)->where('document_id', $id)->delete();

        return redirect()->back();
    }

    /**
     * Adds society documents comments.
     * Author: Amar Prajapati
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function addSocietyDocumentsComment(Request $request){
        $society = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
        $comments = '';
        if(!empty($request->input('society_documents_comment'))){
            $comments = $request->input('society_documents_comment');
        }else{
            $comments = 'N.A.';
        }
        $input = array(
            'society_id' => $society->id,
            'application_id' => $request->application_id,
            'society_documents_comment' => $comments,
        );
//        dd($society->id);
        OlSocietyDocumentsComment::where('society_id', $society->id)->where('application_id', $request->application_id)->update($input);
        return redirect()->route('upload_society_tripartite_application', encrypt($request->application_id));
    }

    /**
     * Shows form to upload stamped tripartite application form.
     * Author: Amar Prajapati
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function showuploadTripartiteAfterSign($id){
        $id = decrypt($id);
        $society = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
        $ol_applications = OlApplication::where('society_id', $society->id)->where('id', $id)->with(['ol_application_master', 'olApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->first();

        return view('frontend.society.tripatite.upload_stamped_tripartite_application', compact('ol_applications', 'application_details'));
    }


    /**
     * Streams filled offer letter application form in marathi.
     * Author: Amar Prajapati
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function generate_pdf($id){
        $id = decrypt($id);
        $society = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
        $society_details = SocietyOfferLetter::find($society->id);
        $ol_applications = OlApplication::where('user_id', auth()->user()->id)->where('id', $id)->with(['request_form', 'applicationMasterLayout'])->first();
        $layouts = MasterLayout::all();
        $id = $ol_applications->application_master_id;

        $mpdf = new Mpdf();
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $contents = view('frontend.society.tripatite.display_society_tripartite_application', compact('society_details', 'ol_applications', 'layouts', 'id'));
        $mpdf->WriteHTML($contents);
        $mpdf->Output();
    }


    /**
     * Uploads stamped offer letter application form in marathi in pdf format.
     * Author: Amar Prajapati
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadTripartiteAfterSign(Request $request){
        $society = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
        $application_name = OlApplication::where('society_id', $society->id)->with('ol_application_master')->get();
        $society_remark = OlSocietyDocumentsComment::where('society_id', $society->id)->orderBy('id', 'desc')->first();

        if($request->file('application_path'))
        {
            $file = $request->file('application_path');
            $file_name = time().$file->getFileName().'.'.$file->getClientOriginalExtension();
            $extension = $request->file('application_path')->getClientOriginalExtension();
            if ($extension == "pdf") {
                $time = time();
                $name = File::name($request->file('application_path')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                $folder_name = "society_offer_letter_documents";
                $path = $folder_name.'/'.$name;
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('application_path'),$name);
                $input = array(
                    'application_path' => $path,
                    'submitted_at' => date('Y-m-d H-i-s')
                );
                OlApplication::where('society_id', $society->id)->where('id', $request->input('id'))->update($input);
                $role_id = Role::where('name', config('commanConfig.ree_junior'))->first();
                $ol_applications = OlApplication::where('society_id', $society->id)->where('id', $request->input('id'))->first();

                $user_ids = RoleUser::where('role_id', $role_id->id)->get();

                $layout_user_ids = LayoutUser::where('layout_id', $ol_applications->layout_id)->whereIn('user_id', $user_ids)->get();
                foreach ($layout_user_ids as $key => $value) {
                    $select_user_ids[] = $value['user_id'];
                }
                $users = User::whereIn('id', $select_user_ids)->get();

                if(count($users) > 0) {
                    $insert_arr = array(
                        'users' => $users
                    );
                    $this->CommonController->tripartite_application_status_society($insert_arr, config('commanConfig.applicationStatus.forwarded'), $ol_applications);
                }
            }else{
                return redirect()->back()->with('error_uploaded_file', 'Invalid type of file uploaded (only pdf allowed)');
            }
        }
        return redirect()->route('society_offer_letter_dashboard');
    }

    /**
     * Shows drafted/signed tripartite agreement.
     * Author: Amar Prajapati
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show_tripartite_agreement($id){
        $id = decrypt($id);
        $society = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
        $ol_applications = OlApplication::where('society_id', $society->id)->where('id', $id)->with(['ol_application_master', 'olApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc');
        }])->first();
        $tripartite_agreement = $this->CommonController->get_tripartite_agreements($ol_applications->id, config('commanConfig.tripartite_agreements.drafted'));

        return view('frontend.society.tripatite.show_tripartite_agreement', compact('society', 'ol_applications', 'tripartite_agreement', 'id'));
    }

    /**
     * Uploads stamped tripartite agreement.
     * Author: Amar Prajapati
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function upload_tripartite_agreement(Request $request){
        if($request->file('document_path')){
            $file = $request->file('document_path');
            $file_name = time().$file->getFileName().'.'.$file->getClientOriginalExtension();
            $extension = $request->file('document_path')->getClientOriginalExtension();
            if ($extension == "pdf") {
                $time = time();
                $name = File::name($request->file('document_path')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                $folder_name = "society_tripartite_documents";
                $path = $folder_name . '/' . $name;
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name, $request->file('document_path'), $name);

                $society = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
                $ol_applications = OlApplication::where('society_id', $society->id)->where('id', $request->application_id)->with(['ol_application_master', 'olApplicationStatus' => function($q){
                    $q->where('society_flag', '1')->orderBy('id', 'desc');
                }])->first();

                $status = ApplicationStatusMaster::where('status_name', config('commanConfig.documents.society.Stamped'))->value('id');

                $this->CommonController->set_tripartite_agreements($ol_applications, config('commanConfig.tripartite_agreements.drafted'), $path, $status);
                $ol_application_status = OlApplicationStatus::where('application_id', $request->application_id)->where('society_flag', 1)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();
                $users = User::where('id', $ol_application_status->to_user_id)->get();
                $insert_arr = array(
                    'users' => $users
                );

                $this->CommonController->tripartite_application_status_society($insert_arr, config('commanConfig.applicationStatus.forwarded'), $ol_applications);
            }
        }
        return redirect()->route('society_offer_letter_dashboard');
    }

    public function getForwardedApplication(){

        $forward = config('commanConfig.applicationStatus.forwarded');
        $masterIds = OlApplicationMaster::where('title','Tripartite Agreement')->pluck('id')->toArray();
        $count = OlApplication::where('user_id', Auth::user()->id)
        ->whereIn('application_master_id',$masterIds)->with(['olApplicationStatus' => function($q) use($forward){
                $q->where('status_id',$forward)->orderBy('id','desc');
        }])->whereHas('olApplicationStatus', function($q) use($forward){
            $q->where('status_id',$forward)->orderBy('id','desc');
        })->count();

        return $count;
    }

}
