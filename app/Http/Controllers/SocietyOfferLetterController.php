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
        // dd($request);
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

        $validated_fields = SocietyOfferLetter::validate($request);
        if($validated_fields->fails()){
            $errors = $validated_fields->errors();
            return redirect()->route('society_offer_letter.index');
        }else{
            $society_offer_letter_details = array(
                'language_id' => '0',
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

       $validateData = $request->validate([
        'capture_text' => 'required|captcha',
        ]);        
        $email    = $request->input('email');
        $password = $request->input('password');
        if (auth()->guard('society')->attempt(['email' => $email, 'password' => $password])) {
            echo "Login SuccessFull<br/>";
            dd(Auth::guard('society'));
            exit;
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
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application No.'],
            ['data' => 'application_master_id','name' => 'application_master_id','title' => 'Application Type'],
            ['data' => 'created_at','name' => 'created_date','title' => 'Date & Time of submission'],
            ['data' => 'status','name' => 'status','title' => 'Status'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];
        $getRequest = $request->all();
        $ol_application_count = count(OlApplication::where('society_id', '1')->get());
        if ($datatables->getRequest()->ajax()) {
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
            $ol_applications = OlApplication::where('society_id', '1')->with(['ol_application_master', 'ol_application_status']);
            if($request->application_master_id)
            {
                $ol_applications = $ol_applications->where('application_master_id', 'like', '%'.$request->application_master_id.'%');
            }
            $ol_applications = $ol_applications->selectRaw(DB::raw('@rownum  := @rownum  + 1 AS rownum').', current_status_id , application_no, application_master_id, created_at');
            // $ol_applications[] = $ol_applications[0];
            // $parent_application_name = OlApplicationMaster::where('id', $ol_applications->ol_application_master->parent_id)->get();
            // $ol_applications['parent_application_name'] = $parent_application_name[0];
            // dd($ol_applications);
            return $datatables->of($ol_applications)
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
                    $status = explode('_', array_keys(config('commanConfig.applicationStatus'), $ol_applications->ol_application_status->status_id)[0]);
                    return ucwords($status[0]). ' ' .ucwords($status[1]);
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

    public function show_offer_letter_application_self($id){
        $society_details = SocietyOfferLetter::find('1');
        // dd($society_details->building_no);
        return view('frontend.society.offer_letter_application_self', compact('society_details', 'id'));
    }

    public function save_offer_letter_application_self(Request $request){
        // dd($request->input());
        $input = array(
            'society_id' => 1,
            'date_of_meeting' => date('Y-m-d', strtotime($request->input('date_of_meeting'))),
            'resolution_no' => $request->input('resolution_no'),
            'architect_name' => $request->input('architect_name'),
            'developer_name' => $request->input('developer_name')
        );
        $last_inserted_id = OlRequestForm::create($input);
        $insert_application = array(
            'user_id' => 1,
            'language_id' => '1',
            'society_id' => '1',
            'layout_id' => 1,
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
        $insert_application_log = array(
            'application_id' => $last_id->id,
            'user_id' => 1,
            'role_id' => 0,
            'status_id' => config('commanConfig.applicationStatus.in_process'),
            'to_user_id' => 0,
            'to_role_id' => 0,
            'remark' => ''
        );
        OlApplicationStatus::create($insert_application_log);
        return redirect()->route('documents_upload');
    }

    public function show_offer_letter_application_dev($id){
        $society_details = SocietyOfferLetter::find('1');
        return view('frontend.society.offer_letter_application_dev', compact('society_details', 'id'));
    }

    public function save_offer_letter_application_dev(Request $request){
        // dd($request->input());
        $input = array(
            'society_id' => 1,
            'date_of_meeting' => date('Y-m-d', strtotime($request->input('date_of_meeting'))),
            'resolution_no' => $request->input('resolution_no'),
            'architect_name' => $request->input('architect_name'),
            'developer_name' => $request->input('developer_name')
        );
        $last_inserted_id = OlRequestForm::create($input);
        $insert_application = array(
            'user_id' => 1,
            'language_id' => '1',
            'society_id' => '1',
            'layout_id' => 1,
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
        $insert_application_log = array(
            'application_id' => $last_id->id,
            'user_id' => 1,
            'role_id' => 0,
            'status_id' => config('commanConfig.applicationStatus.in_process'),
            'to_user_id' => 0,
            'to_role_id' => 0,
            'remark' => ''
        );
        OlApplicationStatus::create($insert_application_log);
        return redirect()->route('documents_upload');
    }

    public function displaySocietyDocuments(){
        // dd(OlSocietyDocumentsMaster::where('application_id', '2')->get());
        $documents = OlSocietyDocumentsMaster::where('application_id', '2')->with('documents_uploaded')->get();
        $documents_uploaded = OlSocietyDocumentsStatus::where('society_id', '1')->get();
        // dd($documents);
        return view('frontend.society.society_upload_documents', compact('documents', 'documents_uploaded'));
    }

    public function uploadSocietyDocuments(Request $request){
        $uploadPath = '/uploads/society_offer_letter_documents';
        $destinationPath = public_path($uploadPath);
        
        $documents = OlSocietyDocumentsMaster::where('application_id', '2')->where('id', $request->input('document_id'))->with('documents_uploaded')->get();
        // dd($documents[0]->documents_uploaded);
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
        $delete_document_details = OlSocietyDocumentsStatus::where('society_id', '1')->where('document_id', $id)->get();
        unlink(public_path($delete_document_details[0]->society_document_path));
        OlSocietyDocumentsStatus::where('society_id', '1')->where('document_id', $id)->delete();
        return redirect()->route('documents_upload');
    }

    public function addSocietyDocumentsComment(Request $request){
        // dd($request->input('society_documents_comment'));
        $input = array(
            'society_id' => '1',
            'society_documents_comment' => $request->input('society_documents_comment'),
        );
        OlSocietyDocumentsComment::create($input);
        return redirect()->route('society_offer_letter_download');
    }

    public function displayOfferLetterApplication(){
        // dd('hi');
        $data['society_details'] = SocietyOfferLetter::find('1');
        $data['ol_application'] = OlApplication::where('society_id', '1')->with('request_form')->get();

        $society_offer_letter_application = $this->generate_pdf($data);
        dd($society_offer_letter_application);
        // dd($society_offer_letter_application);       
        
        return view('frontend.society.upload_society_offer_letter_after_sign', compact('society_offer_letter_application'));
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

    public function ViewApplications(Request $request){
        $self_premium = OlApplicationMaster::where('title', 'New - Offer Letter')->where('model', 'Premium')->where('parent_id', '1')->select('id')->get();
        $self_premium = $self_premium[0]->id;
        $self_sharing = OlApplicationMaster::where('title', 'New - Offer Letter')->where('model', 'Sharing')->where('parent_id', '1')->select('id')->get();
        $self_sharing = $self_sharing[0]->id;
        $dev_premium = OlApplicationMaster::where('title', 'New - Offer Letter')->where('model', 'Premium')->where('parent_id', '12')->select('id')->get();
        $dev_premium = $dev_premium[0]->id;
        $dev_sharing = OlApplicationMaster::where('title', 'New - Offer Letter')->where('model', 'Premium')->where('parent_id', '12')->select('id')->get();
        $dev_sharing = $dev_sharing[0]->id;
        return view('frontend.society.application', compact('self_premium', 'self_sharing', 'dev_premium', 'dev_sharing'));
    }
}
