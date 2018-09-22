<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Auth\SessionGuard;
use App\SocietyOfferLetter;
use App\MasterEmailTemplates;
use App\OlRequestForm;
use App\OlApplicationMaster;
use App\OlApplication;
use App\OlApplicationStatus;
use App\OlSocietyDocumentsMaster;
use App\OlSocietyDocumentsStatus;
use App\OlSocietyDocumentsComment;
use App\MasterLayout;
use App\LayoutUser;
use App\User;
use App\RoleUser;
use DB;
use Validator;
use Mail;
use Illuminate\Http\Request;
use Redirect;
use Yajra\DataTables\DataTables;
use Config;
use PDF;
use Auth;
use Hash;
use Session;
use App\Mail\SocietyOfferLetterForgotPassword;

class SocietyOfferLetterController extends Controller
{

    protected $list_num_of_records_per_page;

    public function __construct()
    {
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd(Session::all());
        return view('frontend.society.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.society.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(config('commanConfig.society_offer_letter'));
        $validated_fields = SocietyOfferLetter::validate($request);
        if($validated_fields->fails()){
            $errors = $validated_fields->errors();
            return redirect()->route('society_offer_letter.index');
        }else{

            $society_offer_letter_users = array(
                'name' => $request->input('society_name'),
                'email' => $request->input('society_email'),
                'password' => bcrypt($request->input('society_password')),
                'role_id' => config('commanConfig.society_offer_letter'),
                'uploaded_note_path' => 'test',
                'service_start_date' => '',
                'service_end_date' => '',
                'last_login_at' => '',
                'remember_token' => '',
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => '',
                'mobile_no' =>  $request->input('society_contact_no'),
                'address' => $request->input('society_address'),
            );
            // dd($society_offer_letter_users);
            $last_inserted_id = User::create($society_offer_letter_users);
            // dd($last_inserted_id->id);
            $role_user = array(
                'user_id'    => $last_inserted_id->id,
                'role_id'    => config('commanConfig.society_offer_letter'),
                'start_date' => \Carbon\Carbon::now(),
                'end_date' => ''
            );
            // dd($role_user);
            RoleUser::create($role_user);
            $society_offer_letter_details = array(
                'language_id' => '0',
                'user_id' => $last_inserted_id->id,
                'role_id' => config('commanConfig.society_offer_letter'),
                'email' => $request->input('society_email'),
                'password' => bcrypt($request->input('society_password')),
                'name' => $request->input('society_name'),
                'username' => $request->input('society_username'),
                'building_no' => $request->input('society_building_no'),
                'registration_no' => $request->input('society_registration_no'),
                'contact_no' => $request->input('society_contact_no'),
                'address' => $request->input('society_address'),
                'name_of_architect' => $request->input('society_architect_name'),
                'architect_mobile_no' => $request->input('society_architect_mobile_no'),
                'architect_telephone_no' => $request->input('society_architect_telephone_no'),
                'architect_address' => $request->input('society_architect_address'),
                'remember_token' => $request->input('_token'),
                'last_login_at' => date('Y-m-d')
            );
            SocietyOfferLetter::create($society_offer_letter_details);
            
            return redirect()->route('society_offer_letter.index')->with('registered', 'Society registered successfully!');
        }
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

    //function is used to refresh capture img 
    public function RefreshCaptcha(){
        return response()->json(['captcha' => captcha_img()]);
    }

    // function used to Aunthonticate society user
    public function UserAuthentication(Request $request){
        // dd($request);
       $validateData = $request->validate([
        'capture_text' => 'required|captcha',
        ]);        
        $email    = $request->input('email');
        $password = $request->input('password');
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // echo "Login SuccessFull<br/>";
            dd(Auth::user());
            // exit;
        } else {
            echo "Login Failed Wrong Data Passed";exit;
        }
        
        $db_password = SocietyOfferLetter::where('email',$email)->first();
        if ($password == ($db_password->password)){
            
            dd($db_password);
            if ($SocietyUser){
                $response['sucess'] = "Authenticate User";  
                // Session::
                return redirect()->route('society_offer_letter_dashboard');
            }else{
                return Redirect::back()->withErrors(['Authontication Failed']);
            }
        }else{
            return Redirect::back()->withErrors(['Enter Email and Password']);
        }
    }


    /**
     * Receives the post request and sends mail for forgot password link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function forgot_password(Request $request)
    {
        // dd($request->input('society_email'));
        $email_template = MasterEmailTemplates::where('type', 'society offer letter forgot password')->get();
        $email_template = $email_template[0];
        // dd($email_template);
        $link = rand().time();
        Mail::to($request->input('society_email'))->send(new SocietyOfferLetterForgotPassword($email_template));
        return redirect()->route('society_offer_letter.index')->with('email_sent', 'Click on the link sent in the email!');
    }


    /**
     * Listing of filled application forms.
     *
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function dashboard(DataTables $datatables, Request $request)
    {   
        /*$society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $ol_applications = OlApplication::where('society_id', $society_details->id)->with(['ol_application_master','olApplicationStatus' => function($q){
                $q->where('society_flag', '1')->orderBy('id', 'desc');
            } ])->get()->toArray();
            dd($ol_applications);*/
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application No.'],
            ['data' => 'application_master_id','name' => 'application_master_id','title' => 'Application Type'],
            ['data' => 'created_at','name' => 'created_date','title' => 'Date & Time of submission'],
            ['data' => 'status','name' => 'status','title' => 'Status'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];
        $getRequest = $request->all();
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $ol_application_count = count(OlApplication::where('society_id', $society_details->id)->get());
        if ($datatables->getRequest()->ajax()) {
            $ol_applications = OlApplication::where('society_id', $society_details->id)->with(['ol_application_master', 'olApplicationStatus' => function($q){
                $q->where('society_flag', '1')->orderBy('id', 'desc');
            } ]);
            if($request->application_master_id)
            {
                $ol_applications = $ol_applications->where('application_master_id', 'like', '%'.$request->application_master_id.'%');
            }
            $ol_applications = $ol_applications->get();
            /*$ol_applications = OlApplication::where('society_id', $society_details->id)->with(['ol_application_master', 'ol_application_status', 'olApplicationStatus' => function($q){
                $q->where('society_flag', '1')->orderBy('id', 'desc');
            } ])->get();
            dd($ol_applications);*/
            return $datatables->of($ol_applications)
                ->editColumn('rownum', function ($ol_applications) {
                    $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('application_no', function ($ol_applications) {
                    return $ol_applications->application_no;
                })
                ->editColumn('application_master_id', function ($ol_applications) {
                    return $ol_applications->ol_application_master->title;
                })
                ->editColumn('created_at', function ($ol_applications) {
                    return $ol_applications->created_at;
                })
                ->editColumn('status', function ($ol_applications) {

                    return $ol_applications->olApplicationStatus[0]->status_id;
                    // dd(array_keys(config('commanConfig.applicationStatus'), $ol_applications->olApplicationStatus[0]->status_id));
                    // $status = explode('_', array_keys(config('commanConfig.applicationStatus'), $ol_applications->olApplicationStatus[0]->status_id[0]));
                    // // dd($status);
                    // $status_display = '';
                    // foreach($status as $status_value){ $status_display .= ucwords($status_value). ' ';}
                    // return $ol_applications->olApplicationStatus;
                })
                ->editColumn('actions', function ($ol_applications) {
                    return $ol_applications->created_at;
                })
                ->rawColumns(['application_no', 'application_master_id', 'created_at','status','actions'])
                ->make(true);
        }
        
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
        return view('frontend.society.dashboard', compact('html', 'ol_applications', 'ol_application_count'));
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [5, "desc" ],
            "pageLength" => $this->list_num_of_records_per_page,
            // 'fixedHeader' => [
            //     'header' => true,
            //     'footer' => true
            // ]
        ];
    }

    public function ViewApplications(){
        $self_premium = OlApplicationMaster::where('title', 'New - Offer Letter')->where('model', 'Premium')->where('parent_id', '1')->select('id')->get();
        $self_premium = $self_premium[0]->id;
        $self_sharing = OlApplicationMaster::where('title', 'New - Offer Letter')->where('model', 'Sharing')->where('parent_id', '1')->select('id')->get();
        $self_sharing = $self_sharing[0]->id;
        $dev_premium = OlApplicationMaster::where('title', 'New - Offer Letter')->where('model', 'Sharing')->where('parent_id', '12')->select('id')->get();
        $dev_premium = $dev_premium[0]->id;
        $dev_sharing = OlApplicationMaster::where('title', 'New - Offer Letter')->where('model', 'Premium')->where('parent_id', '12')->select('id')->get();
        $dev_sharing = $dev_sharing[0]->id;
        return view('frontend.society.application', compact('self_premium', 'self_sharing', 'dev_premium', 'dev_sharing'));
    }

    public function show_offer_letter_application_self($id){
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $layouts = MasterLayout::all();
        return view('frontend.society.offer_letter_application_self', compact('society_details', 'id', 'layouts'));
    }

    public function save_offer_letter_application_self(Request $request){
        // dd($request->input());
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $input = array(
            'society_id' => $society_details->id,
            'date_of_meeting' => date('Y-m-d', strtotime($request->input('date_of_meeting'))),
            'resolution_no' => $request->input('resolution_no'),
            'architect_name' => $request->input('architect_name'),
            'developer_name' => $request->input('developer_name')
        );
        $last_inserted_id = OlRequestForm::create($input);
        $insert_application = array(
            'user_id' => Auth::user()->id,
            'language_id' => '1',
            'society_id' => $society_details->id,
            'layout_id' => $request->input('layout_id'),
            'request_form_id' => $last_inserted_id->id,
            'application_master_id' => $request->input('application_master_id'),
            'application_no' => rand().time(),
            'application_path' => 'test',
            'submitted_at' => date('Y-m-d'),
            'current_status_id' => '1',
            'is_encrochment' => '0',
            'is_approve_offer_letter' => '0',
        );
        $last_id = OlApplication::create($insert_application);
        $layout_user_ids = LayoutUser::where('layout_id', $request->input('layout_id'))->get();
        foreach ($layout_user_ids as $key => $value) {
            $user_ids[] = $value['user_id'];
        }
        $users = User::whereIn('id', $user_ids)->get();
        // dd($users);
        if(count($users) > 0){
            foreach($users as $key => $user){
                $i = 0;
                $insert_application_log_forward_to[$key]['application_id'] = $last_id->id;
                $insert_application_log_forward_to[$key]['society_flag'] = 1;
                $insert_application_log_forward_to[$key]['user_id'] = Auth::user()->id;
                $insert_application_log_forward_to[$key]['role_id'] = Auth::user()->role_id;
                $insert_application_log_forward_to[$key]['status_id'] = config('commanConfig.applicationStatus.forwarded');
                $insert_application_log_forward_to[$key]['to_user_id'] = $user->id;
                $insert_application_log_forward_to[$key]['to_role_id'] = $user->role_id;
                $insert_application_log_forward_to[$key]['remark'] = '';
                $insert_application_log_forward_to[$key]['created_at'] = date('Y-m-d');
                $insert_application_log_forward_to[$key]['updated_at'] = date('Y-m-d');

                $insert_application_log_in_process[$key]['application_id'] = $last_id->id;
                $insert_application_log_forward_to[$key]['society_flag'] = 0;
                $insert_application_log_in_process[$key]['user_id'] = $user->id;
                $insert_application_log_in_process[$key]['role_id'] = $user->role_id;
                $insert_application_log_in_process[$key]['status_id'] = config('commanConfig.applicationStatus.in_process');
                $insert_application_log_in_process[$key]['to_user_id'] = 0;
                $insert_application_log_in_process[$key]['to_role_id'] = 0;
                $insert_application_log_in_process[$key]['remark'] = '';
                $insert_application_log_in_process[$key]['created_at'] = date('Y-m-d');
                $insert_application_log_in_process[$key]['updated_at'] = date('Y-m-d');
                $i++;
            }
        }

        OlApplicationStatus::insert(array_merge($insert_application_log_forward_to, $insert_application_log_in_process));
        $last_society_flag_id = OlApplicationStatus::where('society_flag', '1')->orderBy('id', 'desc')->first();
        $id = OlApplicationStatus::find($last_society_flag_id->id);
        OlApplication::where('user_id', Auth::user()->id)->update([
                'current_status_id' => $id->id
            ]);    
        return redirect()->route('documents_upload');
    }

    public function show_offer_letter_application_dev($id){
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $layouts = MasterLayout::all();
        return view('frontend.society.offer_letter_application_dev', compact('society_details', 'id', 'layouts'));
    }

    public function save_offer_letter_application_dev(Request $request){
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        // dd($society_details->id);
        $input = array(
            'society_id' => $society_details->id,
            'date_of_meeting' => date('Y-m-d', strtotime($request->input('date_of_meeting'))),
            'resolution_no' => $request->input('resolution_no'),
            'architect_name' => $request->input('architect_name'),
            'developer_name' => $request->input('developer_name')
        );
        $last_inserted_id = OlRequestForm::create($input);
        $insert_application = array(
            'user_id' => Auth::user()->id,
            'language_id' => '1',
            'society_id' => $society_details->id,
            'layout_id' => $request->input('layout_id'),
            'request_form_id' => $last_inserted_id->id,
            'application_master_id' => $request->input('application_master_id'),
            'application_no' => rand().time(),
            'application_path' => 'test',
            'submitted_at' => date('Y-m-d'),
            'current_status_id' => '1',
            'is_encrochment' => '0',
            'is_approve_offer_letter' => '0',
        );
        $last_id = OlApplication::create($insert_application);
        $layout_user_ids = LayoutUser::where('layout_id', $request->input('layout_id'))->get();
        foreach ($layout_user_ids as $key => $value) {
            $user_ids[] = $value['user_id'];
        }
        $users = User::whereIn('id', $user_ids)->get();
        // dd($users);
        if(count($users) > 0){
            foreach($users as $key => $user){
                $i = 0;
                $insert_application_log_forward_to[$key]['application_id'] = $last_id->id;
                $insert_application_log_forward_to[$key]['user_id'] = Auth::user()->id;
                $insert_application_log_forward_to[$key]['role_id'] = Auth::user()->role_id;
                $insert_application_log_forward_to[$key]['status_id'] = config('commanConfig.applicationStatus.forwarded');
                $insert_application_log_forward_to[$key]['to_user_id'] = $user->id;
                $insert_application_log_forward_to[$key]['to_role_id'] = $user->role_id;
                $insert_application_log_forward_to[$key]['remark'] = '';
                $insert_application_log_forward_to[$key]['created_at'] = date('Y-m-d');
                $insert_application_log_forward_to[$key]['updated_at'] = date('Y-m-d');

                $insert_application_log_in_process[$key]['application_id'] = $last_id->id;
                $insert_application_log_in_process[$key]['user_id'] = $user->id;
                $insert_application_log_in_process[$key]['role_id'] = $user->role_id;
                $insert_application_log_in_process[$key]['status_id'] = config('commanConfig.applicationStatus.in_process');
                $insert_application_log_in_process[$key]['to_user_id'] = 0;
                $insert_application_log_in_process[$key]['to_role_id'] = 0;
                $insert_application_log_in_process[$key]['remark'] = '';
                $insert_application_log_in_process[$key]['created_at'] = date('Y-m-d');
                $insert_application_log_in_process[$key]['updated_at'] = date('Y-m-d');
                $i++;
            }
        }
        // dd(config('commanConfig.applicationStatus.forward_to'));
        // dd(array_merge($insert_application_log_forward_to, $insert_application_log_in_process));
        OlApplicationStatus::insert(array_merge($insert_application_log_forward_to, $insert_application_log_in_process));
        $last_society_flag_id = OlApplicationStatus::where('society_flag', '1')->orderBy('id', 'desc')->first();
        $id = OlApplicationStatus::find($last_society_flag_id->id);
        OlApplication::where('user_id', Auth::user()->id)->update([
                'current_status_id' => $id->id
            ]);
        return redirect()->route('documents_upload');
    }

    public function displaySocietyDocuments(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();      
        $application = OlApplication::where('society_id', $society->id)->first();
        $documents = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->with('documents_uploaded')->get();
        // dd($society->id);
        $documents_uploaded = OlSocietyDocumentsStatus::where('society_id', $society->id)->get();
        $documents_comment = OlSocietyDocumentsComment::where('society_id', $society->id)->first();

        // dd($documents);
        return view('frontend.society.society_upload_documents', compact('documents', 'documents_uploaded', 'society', 'application', 'documents_comment'));
    }

    public function viewSocietyDocuments(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();      
        $application = OlApplication::where('society_id', $society->id)->first();
        // dd($society->id);
        $documents = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->with('documents_uploaded')->get();
        $documents_uploaded = OlSocietyDocumentsStatus::where('society_id', $society->id)->get();
        $documents_comment = OlSocietyDocumentsComment::where('society_id', $society->id)->first();

        return view('frontend.society.view_society_uploaded_documents', compact('documents', 'documents_uploaded', 'documents_comment'));
    }

    public function uploadSocietyDocuments(Request $request){
        $uploadPath = '/uploads/society_offer_letter_documents';
        $destinationPath = public_path($uploadPath);

        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();      
        $application = OlApplication::where('society_id', $society->id)->first();

        $documents = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->where('id', $request->input('document_id'))->with('documents_uploaded')->get();

        if($request->file('document_name'))
        {
            $file = $request->file('document_name');
            $file_name = time().$file->getFileName().'.'.$file->getClientOriginalExtension();
            if($file->move($destinationPath, $file_name))
            {                
                $dataToInsert['filepath'] = $uploadPath.'/';
                $dataToInsert['filename'] = $file_name;
            }
        }
        $input = array(
            'society_id' => '1',
            'document_id' => $request->input('document_id'),
            'society_document_path' => $uploadPath.'/'.$file_name,
        );
        OlSocietyDocumentsStatus::create($input);
        return redirect()->route('documents_upload');
    }

    public function deleteSocietyDocuments($id){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $delete_document_details = OlSocietyDocumentsStatus::where('society_id', $society->id)->where('document_id', $id)->get();
        unlink(public_path($delete_document_details[0]->society_document_path));
        OlSocietyDocumentsStatus::where('society_id', $society->id)->where('document_id', $id)->delete();
        return redirect()->route('documents_upload');
    }

    public function addSocietyDocumentsComment(Request $request){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $input = array(
            'society_id' => $society->id,
            'society_documents_comment' => $request->input('society_documents_comment'),
        );
        OlSocietyDocumentsComment::create($input);
        return redirect()->route('society_offer_letter_download');
    }

    public function displayOfferLetterApplication(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $society_details = SocietyOfferLetter::find($society->id);
        $ol_application = OlApplication::where('user_id', Auth::user()->id)->with(['request_form', 'applicationMasterLayout'])->first();
        $layouts = MasterLayout::all();      
        
        return view('frontend.society.display_society_offer_letter_application', compact('society_details', 'ol_application', 'layouts'));
    }

    public function generate_pdf(){


        $society_details = SocietyOfferLetter::find('1');
        $ol_application = OlApplication::where('society_id', '1')->with('request_form')->get();
        $path = public_path('/uploads/resolutions/society_offer_letter_document.pdf');
        dd(html_entity_decode(view('frontend.society.display_society_offer_letter_application', compact('ol_application', 'society_details'))));
        // $pdf->loadView('frontend.society.display_society_offer_letter_application', $data);
        define('_MPDF_TTFONTDATAPATH', sys_get_temp_dir()."/");
        $pdf = PDF::loadView('frontend.society.display_society_offer_letter_application', $data); // or PDF::loadHtml($html);
        return $pdf->download($path);

         die('m called');
        // $pdf->download('society_offer_letter_document.pdf');
        return $pdf;

    }

    public function uploadOfferLetterAfterSign(Request $request){
        $application_name = OlApplication::where('society_id', '1')->with('ol_application_master')->get();
        dd($application_name[0]);
        return view('frontend.society.upload_society_offer_letter_after_sign', compact('application_name'));
    }
}
