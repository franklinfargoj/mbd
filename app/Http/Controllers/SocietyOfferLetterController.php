<?php

namespace App\Http\Controllers;
use App\SocietyOfferLetter;
use App\MasterEmailTemplates;
use App\OlRequestForm;
use App\OlApplication;
use App\OlSocietyDocumentsMaster;
use App\OlSocietyDocumentsStatus;
use App\OlSocietyDocumentsComment;
use Validator;
use Mail;
use Illuminate\Http\Request;
use Redirect;
use Yajra\DataTables\DataTables;
use Config;
use PDF;
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
                'remember_token' => rand().time(),
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

        if (isset($email) && isset($password)){
            $SocietyUser = SocietyOfferLetter::where('society_email',$email)
                                               ->where('society_password',$password)->first();
            if ($SocietyUser){
                $response['sucess'] = "Authonticate User";  
                // return Redirect::back()->withSuccess(['Authonticate User']);
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
    public function dashboard()
    {
        $columns = [
            ['data' => 'application_no','name' => 'application_no','title' => 'Application No.'],
            ['data' => 'application_type','name' => 'application_type','title' => 'Application'],
            ['data' => 'created_at','name' => 'created_date','title' => 'Date & Time of submission'],
            ['data' => 'status','name' => 'status','title' => 'Status'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {
            
            $boards = Board::all();
            
            return $datatables->of($boards)
                ->editColumn('application_no', function ($boards) {
                    return $boards->board_name;
                })
                ->editColumn('application_type', function ($boards) {
                    return $boards->status;
                })
                ->editColumn('created_at', function ($boards) {
                    return $boards->board_name;
                })
                ->editColumn('status', function ($boards) {
                    return $boards->status;
                })
                ->editColumn('actions', function ($boards) {
                   return view('admin.board.actions', compact('boards'))->render();
                })
                ->rawColumns(['application_no', 'application_type', 'created_at','status','actions'])
                ->make(true);
        }
        
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
        return view('frontend.society.dashboard');
    }

    public function show_offer_letter_application_self(){
        $society_details = SocietyOfferLetter::find('1');
        // dd($society_details->building_no);
        return view('frontend.society.offer_letter_application_self', compact('society_details'));
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
            'language_id' => '1',
            'society_id' => '1',
            'request_form_id' => $last_inserted_id->id,
            'application_master_id' => '2',
            'application_no' => rand().time(),
            'application_path' => 'test',
            'submitted_at' => date('Y-m-d'),
            'current_status_id' => '1',
            'is_encrochment' => '0',
            'is_approve_offer_letter' => '0',
        );
        OlApplication::create($insert_application);
        return redirect()->route('documents_upload');
    }

    public function show_offer_letter_application_dev(){
        return view('frontend.society.offer_letter_application_dev');
    }

    public function save_offer_letter_application_dev(Request $request){
        dd($request);
        return view('frontend.society.offer_letter_application_dev');
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
        return view('frontend.society.upload_society_offer_letter_after_sign');
    }

    public function uploadOfferLetterAfterSign(Request $request){
        return view('frontend.society.upload_society_offer_letter_after_sign');
    }

    public function ViewApplications(Request $request){
        return view('frontend.society.application');
    }
}
