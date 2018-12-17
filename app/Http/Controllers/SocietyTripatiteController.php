<?php

namespace App\Http\Controllers;

use App\OlApplication;
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
        $society_details = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
        $ol_form_request_fields = new OlRequestForm;

        foreach($ol_form_request_fields->getFillable() as $key => $value){
            if(in_array($value, config('commanConfig.tripartite_fields'))){
                $form_fields[] = $value;
            }
        }
        $layouts = MasterLayout::all();
        $comm_func = $this->CommonController;

        return view('frontend.society.tripatite.show_tripatite_self', compact('society_details', 'id', 'layouts', 'form_fields', 'layouts', 'comm_func'));
    }

    /**
     * Shows tripatite application form.
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function save_tripatite_self(Request $request){
        dd($request->application_master_id);
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
        return redirect()->route('tripartite_application_form_preview', $ol_application->id);
    }

    /**
     * Shows edit tripatite application form.
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function tripartite_application_form_edit($id){
        $society = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
        $society_details = SocietyOfferLetter::find($society->id);
        $ol_applications = OlApplication::where('id', $id)->with(['request_form', 'applicationMasterLayout', 'olApplicationStatus' => function($q){
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

        return view('frontend.society.tripatite.edit_tripatite_application', compact('society', 'society_details', 'ol_applications', 'layouts', 'comm_func', 'form_fields', 'id', 'form_fields_values'));
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

        return redirect()->route('tripartite_application_form_preview', $ol_application_data->id);
    }

    /**
     * Shows tripatite application form.
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show_tripatite_dev($id){
        $society_details = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
        $layouts = MasterLayout::all();

        return view('frontend.society.tripatite.show_tripatite_dev', compact('society_details', 'id', 'layouts'));
    }

    /**
     * Shows tripatite application form.
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function save_tripatite_dev(Request $request){
        dd($request->all());
    }


    /**
     * Shows tripatite application form preview.
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function tripartite_application_form_preview($id){
        $society = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
        $society_details = SocietyOfferLetter::find($society->id);
        $ol_applications = OlApplication::where('id', $id)->with(['request_form', 'applicationMasterLayout', 'olApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->first();

        return view('frontend.society.tripatite.tripartite_application_form_preview', compact('ol_applications', 'society_details', 'id'));
    }

    /**
     * Shows tripatite application documents.
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function display_tripartite_docs($id){
        $society = SocietyOfferLetter::where('user_id', auth()->user()->id)->first();
        $society_details = SocietyOfferLetter::find($society->id);
        $ol_applications = OlApplication::where('id', $id)->with(['request_form', 'applicationMasterLayout', 'olApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc');
        }])->first();

//        dd($ol_applications);
        $documents = OlSocietyDocumentsMaster::where('application_id', $ol_applications->application_master_id)->where('is_admin', 0)->with(['documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();
//        dd($documents);

        foreach ($documents as $key => $value) {
            $document_ids[] = $value->id;
        }
        $documents_uploaded = OlSocietyDocumentsStatus::where('society_id', $society->id)->whereIn('document_id', $document_ids)->get();
        $documents_comment = OlSocietyDocumentsComment::where('society_id', $society->id)->first();
//        dd($ol_applications);
        return view('frontend.society.tripatite.show_society_documents', compact('ol_applications', 'documents', 'documents_uploaded', 'documents_comment', 'id', 'society', 'society_details'));

    }

    /**
     * Saves tripatite application documents.
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function upload_tripartite_docs(Request $request){
        dd($request->all());
        $uploadPath = '/uploads/society_tripartite_agreement_documents';
        $destinationPath = public_path($uploadPath);

        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $application = OlApplication::where('society_id', $society->id)->first();

        $documents = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->where('is_admin', 0)->with(['documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();
//        dd($documents);

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

        $input = array(
            'society_id' => $society->id,
            'document_id' => $request->input('document_id'),
            'society_document_path' => $path,
        );
        OlSocietyDocumentsStatus::create($input);

        $role_id = Role::where('name', 'ee_junior_engineer')->first();
        $user_ids = RoleUser::where('role_id', $role_id->id)->get();
        $layout_user_ids = LayoutUser::where('layout_id', $application->layout_id)->whereIn('user_id', $user_ids)->get();
        foreach ($layout_user_ids as $key => $value) {
            $select_user_ids[] = $value['user_id'];
        }
        $users = User::whereIn('id', $select_user_ids)->get();
        $insert_arr = array(
            'users' => $users
        );

        $this->CommonController->tripartite_application_status_society($insert_arr, config('commanConfig.applicationStatus.forwarded'), $application);

    }
}
