<?php

namespace App\Http\Controllers;
use App\OcApplications;
use App\OcApplicationStatusLog;
use App\OcSocietyDocumentStatus;
use App\RevalOlSocietyDocumentStatus;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Auth\SessionGuard;
use App\SocietyOfferLetter;
use App\MasterEmailTemplates;
use App\OlRequestForm;
use App\OlApplicationMaster;
use App\OlApplication;
use App\NocApplication;
use App\NocolApplication;
use App\NocCCApplication;
use App\NocCColApplication;
use App\OlApplicationStatus;
use App\OlSocietyDocumentsMaster;
use App\OlSocietyDocumentsStatus;
use App\OlSocietyDocumentsComment;
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
use Mpdf\Mpdf;
use Auth;
use Hash;
use Session;
use App\Mail\SocietyOfferLetterForgotPassword;
use Storage;
use App\SocietyConveyance;
use App\OcApplication;
use App\OcSocietyDocumentsComment;
use App\conveyance\RenewalApplication;
use App\conveyance\scApplication;

class SocietyOfferLetterController extends Controller
{

    protected $list_num_of_records_per_page;

    public function __construct()
    {
        $this->CommonController = new CommonController();
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
    public function store(Request $request, MessageBag $message_bag)
    {
        $validated_fields = SocietyOfferLetter::validate($request);
        if($validated_fields->fails()){
            $errors = $validated_fields->errors();
            $request->flash();
            if($request->is_email_check != null || $request->is_society_registration_no_check != null){
                return $errors;
            }
            else{
                return redirect()->route('society_offer_letter.create')->withErrors($errors)->withInput();
            }
        }else{
            $role_id = Role::where('name', config('commanConfig.society_offer_letter'))->first();

            $society_offer_letter_users = array(
                'name' => $request->input('society_name'),
                'email' => $request->input('society_email'),
                'password' => bcrypt($request->input('society_password')),
                'role_id' => $role_id->id,
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
            $last_inserted_id = User::create($society_offer_letter_users);                    
            
            $role_user = array(
                'user_id'    => $last_inserted_id->id,
                'role_id'    => $role_id->id,
                'start_date' => \Carbon\Carbon::now(),
                'end_date' => ''
            );
            // dd($role_user);
            RoleUser::create($role_user);
            $society_offer_letter_details = array(
                'language_id' => '0',
                'user_id' => $last_inserted_id->id,
                'role_id' => $role_id->id,
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
                'last_login_at' => date('Y-m-d'),
                'optional_email' => $request->input('optional_society_email'),
                'society_wing_no' => $request->input('society_wing_no'),
                'secretary_name' => $request->input('secretary_name'),
                'chairman_name' => $request->input('chairman_name')
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
//    public function UserAuthentication(Request $request){
//        // dd($request);
//       $validateData = $request->validate([
//        'capture_text' => 'required|captcha',
//        ]);
//        $email    = $request->input('email');
//        $password = $request->input('password');
//        if (Auth::attempt(['email' => $email, 'password' => $password])) {
//            // echo "Login SuccessFull<br/>";
//            dd(Auth::user());
//            // exit;
//        } else {
//            echo "Login Failed Wrong Data Passed";exit;
//        }
//
//        $db_password = SocietyOfferLetter::where('email',$email)->first();
//        if ($password == ($db_password->password)){
//
//            dd($db_password);
//            if ($SocietyUser){
//                $response['sucess'] = "Authenticate User";
//                // Session::
//                return redirect()->route('society_offer_letter_dashboard');
//            }else{
//                return Redirect::back()->withErrors(['Authontication Failed']);
//            }
//        }else{
//            return Redirect::back()->withErrors(['Enter Email and Password']);
//        }
//    }


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
     * Author: Amar Prajapati
     * @param  $datatables, $request
     * @return \Illuminate\Http\Response
     */
    public function dashboard(DataTables $datatables, Request $request)
    {
        $columns = [
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application No.'],
            ['data' => 'application_type','name' => 'application_type','title' => 'Application Type'],
            ['data' => 'application_master_id','name' => 'application_master_id','title' => 'Model'],
            ['data' => 'created_at','name' => 'created_date','title' => 'Submission Date', 'class' => 'datatable-date'],
            ['data' => 'status','name' => 'status','title' => 'Status'],
//            ['data' => 'model','name' => 'model','title' => 'Model','searchable' => false,'orderable'=>false],
        ];
//        $self_premium = OlApplicationMaster::where('title', 'New - Offer Letter')->where('model', 'Premium')->where('parent_id', '1')->select('id')->get();
//        $self_premium = $self_premium[0]->id;
//        $self_sharing = OlApplicationMaster::where('title', 'New - Offer Letter')->where('model', 'Sharing')->where('parent_id', '1')->select('id')->get();
//        $self_sharing = $self_sharing[0]->id;
//        $dev_premium = OlApplicationMaster::where('title', 'New - Offer Letter')->where('model', 'Premium')->where('parent_id', '12')->select('id')->get();
//        $dev_premium = $dev_premium[0]->id;
//        $dev_sharing = OlApplicationMaster::where('title', 'New - Offer Letter')->where('model', 'Sharing')->where('parent_id', '12')->select('id')->get();
//        $dev_sharing = $dev_sharing[0]->id;
//
     /*   $self_reval_premium = OlApplicationMaster::where('title', 'Revalidation Of Offer Letter')->where('model', 'Premium')->where('parent_id', '1')->select('id')->get();
        $self_reval_premium = $self_reval_premium[0]->id;
        $self_reval_sharing = OlApplicationMaster::where('title', 'Revalidation Of Offer Letter')->where('model', 'Sharing')->where('parent_id', '1')->select('id')->get();
        $self_reval_sharing = $self_reval_sharing[0]->id;
        $dev_reval_premium = OlApplicationMaster::where('title', 'Revalidation Of Offer Letter')->where('model', 'Sharing')->where('parent_id', '12')->select('id')->get();
        $dev_reval_premium = $dev_reval_premium[0]->id;
        $dev_reval_sharing = OlApplicationMaster::where('title', 'Revalidation Of Offer Letter')->where('model', 'Premium')->where('parent_id', '12')->select('id')->get();
        $dev_reval_sharing = $dev_reval_sharing[0]->id;
*/
        $self_parent = OlApplicationMaster::where('title', 'Self Redevelopment')->value('id');
        $dev_parent = OlApplicationMaster::where('title', 'Redevelopment Through Developer')->value('id');

        $getRequest = $request->all();
        $applications_tab = array(
            'self_pre_parent' => $self_parent.'_premium',
            'self_share_parent' => $self_parent.'_sharing',
            'dev_pre_parent' => $dev_parent.'_premium',
            'dev_share_parent' => $dev_parent.'_sharing',
//            'dev_parent' => $dev_parent,
//            'self_premium' => $self_premium,
//            'self_sharing' => $self_sharing,
//            'dev_premium' => $dev_premium,
//            'dev_sharing' => $dev_sharing,
//            'self_reval_premium' => $self_reval_premium,
//            'self_reval_sharing' => $self_reval_sharing,
//            'dev_reval_premium' => $dev_reval_premium,
//            'dev_reval_sharing' => $dev_reval_sharing
        );


        Session::put('applications_tab', $applications_tab);
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();

        $ol_application_count = count(OlApplication::where('society_id', $society_details->id)->get());
        Session::put('ol_application_count', $ol_application_count);

        $sc_application_count = count(SocietyConveyance::where('society_id', $society_details->id)->get());
        Session::put('sc_application_count', $sc_application_count);

        $sr_application_count = count(RenewalApplication::where('society_id', $society_details->id)->get());
        Session::put('sr_application_count', $sr_application_count);
//        dd(Session::get('applications_tab')['self_premium']);

        $oc_application_count = count(OcApplication::where('society_id', $society_details->id)->get());
        Session::put('oc_application_count', $oc_application_count);

        //NOC changed added by <--Sayan Pal--> Start >>

            $noc_application_count = count(NocApplication::where('society_id', $society_details->id)->get());
            Session::put('noc_application_count', $noc_application_count);

            $noc_cc_application_count = count(NocCCApplication::where('society_id', $society_details->id)->get());
            Session::put('noc_cc_application_count', $noc_cc_application_count);

//            $self_premium_noc = OlApplicationMaster::where('title', 'Application for NOC')->where('model', 'Premium')->where('parent_id', '1')->select('id')->get();
//            $self_premium_noc = $self_premium_noc[0]->id;
//            $self_sharing_noc = OlApplicationMaster::where('title', 'Application for NOC - IOD')->where('model', 'Sharing')->where('parent_id', '1')->select('id')->get();
//            $self_sharing_noc = $self_sharing_noc[0]->id;
//            $dev_premium_noc = OlApplicationMaster::where('title', 'Application for NOC')->where('model', 'Premium')->where('parent_id', '12')->select('id')->get();
//            $dev_premium_noc = $dev_premium_noc[0]->id;
//            $dev_sharing_noc = OlApplicationMaster::where('title', 'Application for NOC - IOD')->where('model', 'Sharing')->where('parent_id', '12')->select('id')->get();
//            $dev_sharing_noc = $dev_sharing_noc[0]->id;
//
            $getRequest = $request->all();
//            $applications_tab_noc = array(
//                'self_premium_noc' => $self_premium_noc,
//                'self_sharing_noc' => $self_sharing_noc,
//                'dev_premium_noc' => $dev_premium_noc,
//                'dev_sharing_noc' => $dev_sharing_noc
//            );
//            Session::put('applications_tab_noc', $applications_tab);

        //NOC changed added by <--Sayan Pal--> << End

        if ($datatables->getRequest()->ajax()) {
            $oc_master_ids_arr = config('commanConfig.oc_master_ids');

            $application_master_arr = OlApplicationMaster::Where('title', 'like', '%New - Offer Letter%')->orWhere('title', 'like', '%Revalidation Of Offer Letter%')->pluck('id')->toArray();

//            $ol_applications = OlApplication::where('society_id', $society_details->id)->with(['ol_application_master', 'olApplicationStatus' => function($q){
//                $q->where('society_flag', '1')->orderBy('id', 'desc');
//            } ])->whereIn('application_master_id', $application_master_arr);
            $ol_applications = OlApplication::where('society_id', $society_details->id)->with(['ol_application_master', 'olApplicationStatus' => function($q){
                $q->where('society_flag', '1')->orderBy('id', 'desc');
            } ]);

           $oc_applications = OcApplication::where('society_id', $society_details->id)->with(['ol_application_master', 'olApplicationStatus' => function($q){
                $q->where('society_flag', '1')->orderBy('id', 'desc');
            } ]);

            if($request->application_master_id)
            {
                $ol_applications = $ol_applications->where('application_master_id', 'like', '%'.$request->application_master_id.'%');

                $oc_applications = $oc_applications->where('application_master_id', 'like', '%'.$request->application_master_id.'%');
            }

            $ol_applications = $ol_applications->get();

            $oc_applications = $oc_applications->get();

          $ol_applications = $ol_applications->toBase()->merge($oc_applications);




            //NOC changed added by <--Sayan Pal--> Start >>

            $noc_applications = NocolApplication::select('*')->where('society_id', $society_details->id)->with(['ol_application_master', 'olApplicationStatus' => function($q){
                $q->where('society_flag', '1')->orderBy('id', 'desc');
            } ]);

            $noc_applications = $noc_applications->addSelect(DB::raw("'1' as is_noc_application"));

            if($request->application_master_id)
            {
                $noc_applications = $noc_applications->where('application_master_id', 'like', '%'.$request->application_master_id.'%');
            }
            $noc_applications = $noc_applications->get();

            $ol_applications = $ol_applications->toBase()->merge($noc_applications);

            $noc_cc_applications = NocCColApplication::select('*')->where('society_id', $society_details->id)->with(['ol_application_master', 'olApplicationStatus' => function($q){
                $q->where('society_flag', '1')->orderBy('id', 'desc');
            } ]);

            $noc_cc_applications = $noc_cc_applications->addSelect(DB::raw("'1' as is_noc_cc_application"));

            if($request->application_master_id)
            {
                $noc_cc_applications = $noc_cc_applications->where('application_master_id', 'like', '%'.$request->application_master_id.'%');
            }
            $noc_cc_applications = $noc_cc_applications->get();

            $ol_applications = $ol_applications->toBase()->merge($noc_cc_applications);

            //NOC changed added by <--Sayan Pal--> << End

//             dd($ol_applications);
            $reval_master_ids_arr = config('commanConfig.revalidation_master_ids');


            return $datatables->of($ol_applications)
                ->editColumn('radio', function ($ol_applications) use($reval_master_ids_arr,$oc_master_ids_arr) {
                    $url = route('society_offer_letter_preview');
                    $reval_url = route('society_reval_offer_letter_preview');
                    $oc_url= route('society_oc_preview');
                    $url_noc = route('society_noc_preview');
                    $url_noc_cc = route('society_noc_cc_preview');
                    $url_tripartite = route('tripartite_application_form_preview', encrypt($ol_applications->id));
//                    dd($ol_applications->ol_application_master);

                    if(isset($ol_applications->is_noc_application))
                    {
                        return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url_noc.'" name="ol_applications_id"><span></span></label>';
                    }
                    elseif($ol_applications->is_noc_cc_application)
                    {
                        return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url_noc_cc.'" name="ol_applications_id"><span></span></label>';
                    }
                    elseif(in_array($ol_applications->application_master_id,$reval_master_ids_arr))
                    {
                        return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$reval_url .'" name="ol_applications_id"><span></span></label>';

                    }
                    elseif(in_array($ol_applications->application_master_id,$oc_master_ids_arr))
                    {
                        return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$oc_url .'" name="ol_applications_id"><span></span></label>';

                    }
                    elseif(in_array($ol_applications->application_master_id,config('commanConfig.tripartite_master_ids')))
                    {
                        return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url_tripartite .'" name="ol_applications_id"><span></span></label>';

                    }
                    else{

                        return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="ol_applications_id"><span></span></label>';
                    }
                })
                ->editColumn('rownum', function ($ol_applications) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('application_no', function ($ol_applications) use($reval_master_ids_arr,$oc_master_ids_arr) {



//                    if(isset($ol_applications->is_noc_application))
//                    {
//                        $app_type = "<br><span class='m-badge m-badge--danger'>Application for Noc</span>";
//                    }
//                    elseif($ol_applications->is_noc_cc_application)
//                    {
//                        $app_type = "<br><span class='m-badge m-badge--warning'>Application for Noc (CC)</span>";
//                    }
////                    elseif(in_array($ol_applications->application_master_id,$reval_master_ids_arr))
//                    elseif(isset($ol_applications->ol_application_master))
//                    {
//                        $app_type = "<br><span class='m-badge m-badge--success'> Application for ".$ol_applications->ol_application_master->title."</span>";
//                    }
//                    elseif(in_array($ol_applications->application_master_id,$oc_master_ids_arr))
//                    {
//                        $app_type = "<br><span class='m-badge m-badge--success'>Consent For OC</span>";
//                    }
//                    else
//                    {
//                        $app_type = "<br><span class='m-badge m-badge--success'>Application for Offer letter</span>";
//                    }

                    return $ol_applications->application_no;
                })
                ->editColumn('application_type', function ($ol_applications) {
                    return $ol_applications->ol_application_master->title;
                })
                ->editColumn('application_master_id', function ($ol_applications) {
                    return $ol_applications->ol_application_master->model;
                })
                ->editColumn('created_at', function ($ol_applications) {
                    return date(config('commanConfig.dateFormat'), strtotime($ol_applications->created_at));
                })
                ->editColumn('status', function ($ol_applications) {
                    $status = explode('_', array_keys(config('commanConfig.applicationStatus'), $ol_applications->olApplicationStatus[0]->status_id)[0]);
                    $status_display = '';
                    foreach($status as $status_value){ $status_display .= ucwords($status_value). ' ';}
                    $status_color = '';
                    if($status_display == 'Sent To Society '){
                        $status_display = 'Approved';
                    }

                    if($status_display == 'Pending ' && $ol_applications->is_approve_offer_letter){
                        $status_display = 'Approved';
                    }

                    return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$ol_applications->olApplicationStatus[0]->status_id) .' m-badge--wide">'.$status_display.'</span>';
                })
                ->editColumn('model', function ($ol_applications) {
                    return view('frontend.society.actions', compact('ol_applications', 'status_display'))->render();
                })
                ->rawColumns(['radio', 'application_no', 'application_type', 'application_master_id', 'created_at','status','model'])
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
            "order"=> [1, "asc" ],
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

    public function get_docs_count($application, $society){
        $documents = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->with(['documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();
        foreach ($documents as $key => $value) {
            $document_ids[] = $value->id;
        }
        $documents_uploaded = OlSocietyDocumentsStatus::where('society_id', $society->id)->whereIn('document_id', $document_ids)->with(['documents_uploaded'])->get();

        $documents_comment = OlSocietyDocumentsComment::where('society_id', $society->id)->first();
        if($application->application_master_id == '2' || $application->application_master_id == '13'){
            $optional_docs = config('commanConfig.optional_docs_premium');
        }
        if($application->application_master_id == '6' || $application->application_master_id == '17'){
            $optional_docs = config('commanConfig.optional_docs_sharing');
        }

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
        $arr = array(
            'docs_count' => $docs_count,
            'docs_uploaded_count' => $docs_uploaded_count
        );
        return $arr;
    }

    /**
     * Shows filled application forms.
     * Author: Amar Prajapati
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function ViewApplications($id){
        $ids = explode('_', $id);
        $data = OlApplicationMaster::with('ol_application_type', 'ol_application_id' , 'noc_application_ref' , 'noc_cc_application_ref')->where('model', ucfirst($ids[1]))->where('parent_id', $ids[0])->get();

        return view('frontend.society.application', compact('ids', 'data'));
    }

    /**
     * Shows self redevelopment application form.
     * Author: Amar Prajapati
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show_form_self($id){
        $ids = explode('_', $id);
        $id = $ids[0];
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $layouts = MasterLayout::all();

        return view('frontend.society.show_form_self', compact('society_details', 'id', 'ids', 'layouts'));
    }

    public function show_reval_self($id){
        $ids = explode('_', $id);
        $id = $ids[0];
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $layouts = MasterLayout::all();
        // dd($society_details);
        return view('frontend.society.show_reval_self', compact('society_details', 'id','ids', 'layouts'));
    }


    public function show_oc_self($id){
        $ids = explode('_', $id);
        $id = $ids[0];
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $layouts = MasterLayout::all();
        // dd($society_details);
        return view('frontend.society.show_oc_self', compact('society_details', 'id', 'ids', 'layouts'));
    }

    /**
     * Shows self redevelopment application form in marathi.
     * Author: Amar Prajapati
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show_offer_letter_application_self($id){
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $layouts = MasterLayout::all();
        return view('frontend.society.offer_letter_application_self', compact('society_details', 'id', 'layouts'));
    }

    /**
     * Saves self redevelopment application form.
     * Author: Amar Prajapati
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function save_offer_letter_application_self(Request $request){
        //dd($request->all());
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $input = array(
            'society_id' => $society_details->id,
            'date_of_meeting' => date('Y-m-d', strtotime($request->input('date_of_meeting'))),
            'resolution_no' => $request->input('resolution_no'),
            'architect_name' => $request->input('architect_name'),
            'developer_name' => $request->input('developer_name'),
            'created_at' => date('Y-m-d H-i-s'),
            'updated_at' => null
        );
        $last_inserted_id = OlRequestForm::create($input);
        $insert_application = array(
            'user_id' => Auth::user()->id,
            'language_id' => '1',
            'department_id'=>$request->input('department_name'),
            'society_id' => $society_details->id,
            'layout_id' => $request->input('layout_id'),
            'request_form_id' => $last_inserted_id->id,
            'application_master_id' => $request->input('application_master_id'),
            'application_no' => mt_rand(10,100).time(),
            'application_path' => 'test',
            'submitted_at' => date('Y-m-d'),
            'current_status_id' => '1',
            'is_encrochment' => '0',
            'is_approve_offer_letter' => '0',
        );
        $last_id = OlApplication::create($insert_application);
        $role_id = Role::where('name', 'ee_junior_engineer')->first();
        
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
                $insert_application_log_pending[$key]['to_user_id'] = null;
                $insert_application_log_pending[$key]['to_role_id'] = null;
                $insert_application_log_pending[$key]['remark'] = '';
                $insert_application_log_pending[$key]['created_at'] = date('Y-m-d H-i-s');
                $insert_application_log_pending[$key]['updated_at'] = date('Y-m-d H-i-s');
                $i++;
            }
        }

        OlApplicationStatus::insert($insert_application_log_pending);
        $last_society_flag_id = OlApplicationStatus::where('society_flag', '1')->orderBy('id', 'desc')->first();
        $id = OlApplicationStatus::find($last_society_flag_id->id);
        OlApplication::where('user_id', Auth::user()->id)->update([
                'current_status_id' => $id->id
            ]);    
        return redirect()->route('society_offer_letter_preview');
    }

    public function save_offer_letter_application_reval_self(Request $request){
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $input = array(
            'society_id' => $society_details->id,
            'date_of_meeting' => date('Y-m-d', strtotime($request->input('date_of_meeting'))),
            'resolution_no' => $request->input('resolution_no'),
            'architect_name' => $request->input('architect_name'),
            'developer_name' => $request->input('developer_name'),
            'created_at' => date('Y-m-d H-i-s'),
            'ol_issue_date' => date('Y-m-d', strtotime($request->input('ol_issue_date'))),
            'ol_vide_no' => $request->input('ol_vide_no'),
            'reason_for_revalidation' => $request->input('reason_for_revalidation'),
            'updated_at' => null
        );
        $last_inserted_id = OlRequestForm::create($input);
        $insert_application = array(
            'user_id' => Auth::user()->id,
            'language_id' => '1',
            'society_id' => $society_details->id,
            'layout_id' => $request->input('layout_id'),
            'request_form_id' => $last_inserted_id->id,
            'application_master_id' => $request->input('application_master_id'),
            'application_no' => mt_rand(10,100).time(),
            'application_path' => 'test',
            'submitted_at' => date('Y-m-d'),
            'current_status_id' => '1',
            'is_encrochment' => '0',
            'is_approve_offer_letter' => '0',
        );
        $last_id = OlApplication::create($insert_application);
        $role_id = Role::where('name','like', 'ree_junior_engineer')->first();

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

        OlApplicationStatus::insert($insert_application_log_pending);
        $last_society_flag_id = OlApplicationStatus::where('society_flag', '1')->orderBy('id', 'desc')->first();
        $id = OlApplicationStatus::find($last_society_flag_id->id);
        OlApplication::where('user_id', Auth::user()->id)->update([
            'current_status_id' => $id->id
        ]);
        return redirect()->route('society_reval_offer_letter_preview');
    }

    public function save_oc_application_self(Request $request){
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $input = array(
            'society_id' => $society_details->id,
            'resolution_no' => $request->input('resolution_no'),
            'architect_name' => $request->input('architect_name'),
            'developer_name' => $request->input('developer_name'),
            'is_full_oc' => $request->input('is_full_oc'),
            'construction_details' => $request->input('construction_details'),
            'updated_at' => null
        );
        $last_inserted_id = OlRequestForm::create($input);
        $insert_application = array(
            'user_id' => Auth::user()->id,
            'language_id' => '1',
            'society_id' => $society_details->id,
            'layout_id' => $request->input('layout_id'),
            'request_form_id' => $last_inserted_id->id,
            'application_master_id' => $request->input('application_master_id'),
            'application_no' => mt_rand(10,100).time(),
            'application_path' => 'test',
            'submitted_at' => date('Y-m-d'),
            'current_status_id' => '1',
            'is_approve_oc' => '0',
        );
        $last_id = OcApplication::create($insert_application);
        $role_ids = Role::where('name','like', 'ee_junior_engineer')->orWhere('name','like', 'EM')->pluck('id')->toArray();

        $user_ids = RoleUser::whereIn('role_id', $role_ids)->get();
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

        OcApplicationStatusLog::insert($insert_application_log_pending);
        $last_society_flag_id = OcApplicationStatusLog::where('society_flag', '1')->orderBy('id', 'desc')->first();
        $id = OcApplicationStatusLog::find($last_society_flag_id->id);
        OcApplication::where('user_id', Auth::user()->id)->update([
            'current_status_id' => $id->id
        ]);
        return redirect()->route('society_oc_preview');
    }

    /**
     * Shows redevelopment through developer application form.
     * Author: Amar Prajapati
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show_form_dev($id){
        $ids = explode('_', $id);
        $id = $ids[0];
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $layouts = MasterLayout::all();

        return view('frontend.society.show_form_dev', compact('society_details', 'id', 'ids', 'layouts'));
    }

    public function show_reval_dev($id){
        $ids = explode('_', $id);
        $id = $ids[0];
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $layouts = MasterLayout::all();
        // dd($society_details);
        return view('frontend.society.show_reval_dev', compact('society_details', 'id','ids', 'layouts'));
    }

    public function show_oc_dev($id){
        $ids = explode('_', $id);
        $id = $ids[0];
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $layouts = MasterLayout::all();
        // dd($society_details);
        return view('frontend.society.show_oc_dev', compact('society_details', 'id', 'ids', 'layouts'));
    }

    /**
     * Shows redevelopment through developer application form in marathi.
     * Author: Amar Prajapati
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show_offer_letter_application_dev($id){
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $layouts = MasterLayout::all();

        return view('frontend.society.offer_letter_application_dev', compact('society_details', 'id', 'layouts'));
    }

    /**
     * Saves redevelopment through developer application form.
     * Author: Amar Prajapati
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function save_offer_letter_application_dev(Request $request){
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        
        $input = array(
            'society_id' => $society_details->id,
            'date_of_meeting' => date('Y-m-d', strtotime($request->input('date_of_meeting'))),
            'resolution_no' => $request->input('resolution_no'),
            'architect_name' => $request->input('architect_name'),
            'developer_name' => $request->input('developer_name'),
            'created_at' => date('Y-m-d H-i-s'),
            'updated_at' => null
        );
        $last_inserted_id = OlRequestForm::create($input);

        $insert_application = array(
            'user_id' => Auth::user()->id,
            'language_id' => '1',
            'department_id'=>$request->input('department_name'),
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
        $role_id = Role::where('name', 'ee_junior_engineer')->first();

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
        
        OlApplicationStatus::insert($insert_application_log_pending);
        $last_society_flag_id = OlApplicationStatus::where('society_flag', '1')->orderBy('id', 'desc')->first();
        $id = OlApplicationStatus::find($last_society_flag_id->id);
        OlApplication::where('user_id', Auth::user()->id)->update([
                'current_status_id' => $id->id
            ]);
        return redirect()->route('society_offer_letter_preview');
    }

    public function save_offer_letter_application_reval_dev(Request $request){
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();

        $input = array(
            'society_id' => $society_details->id,
            'date_of_meeting' => date('Y-m-d', strtotime($request->input('date_of_meeting'))),
            'resolution_no' => $request->input('resolution_no'),
            'architect_name' => $request->input('architect_name'),
            'developer_name' => $request->input('developer_name'),
            'created_at' => date('Y-m-d H-i-s'),
            'updated_at' => null,
            'ol_issue_date' => date('Y-m-d', strtotime($request->input('ol_issue_date'))),
            'ol_vide_no' => $request->input('ol_vide_no'),
            'reason_for_revalidation' => $request->input('reason_for_revalidation'),
            'updated_at' => null
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
        $role_id = Role::where('name', 'like','ree_junior_engineer')->first();

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

        OlApplicationStatus::insert($insert_application_log_pending);
        $last_society_flag_id = OlApplicationStatus::where('society_flag', '1')->orderBy('id', 'desc')->first();
        $id = OlApplicationStatus::find($last_society_flag_id->id);
        OlApplication::where('user_id', Auth::user()->id)->update([
            'current_status_id' => $id->id
        ]);
        return redirect()->route('society_reval_offer_letter_preview');
    }


    public function save_oc_application_dev(Request $request){
        $society_details = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();

        $input = array(
            'society_id' => $society_details->id,
            'architect_name' => $request->input('architect_name'),
            'developer_name' => $request->input('developer_name'),
            'is_full_oc' => $request->input('is_full_oc'),
            'construction_details' => $request->input('construction_details'),
            'updated_at' => null
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
            'is_approve_oc' => '0',
        );

        $last_id = OcApplication::create($insert_application);
        $role_ids = Role::where('name','like', 'ee_junior_engineer')->orWhere('name','like', 'EM')->pluck('id')->toArray();

        $user_ids = RoleUser::whereIn('role_id', $role_ids)->get()->toArray();
        $user_ids = array_column($user_ids, 'user_id');
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

        OcApplicationStatusLog::insert($insert_application_log_pending);
        $last_society_flag_id = OcApplicationStatusLog::where('society_flag', '1')->orderBy('id', 'desc')->first();
        $id = OcApplicationStatusLog::find($last_society_flag_id->id);
        OcApplication::where('user_id', Auth::user()->id)->update([
            'current_status_id' => $id->id
        ]);
        return redirect()->route('society_oc_preview');
    }



    /**
     * Shows society documents.
     * Author: Amar Prajapati
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function displaySocietyDocuments(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $master_ids = config('commanConfig.new_offer_letter_master_ids');
        $application = OlApplication::where('society_id', $society->id)->whereIn('application_master_id', $master_ids)->with(['ol_application_master', 'olApplicationStatus' => function($q){
                $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
            } ])->orderBy('id', 'desc')->first();
        $ol_applications = $application;
        $documents = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->with(['documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();
    
        foreach ($documents as $key => $value) {
            $document_ids[] = $value->id;
        }
        $documents_uploaded = OlSocietyDocumentsStatus::where('society_id', $society->id)->whereIn('document_id', $document_ids)->with(['documents_uploaded'])->get();

        // dd($documents);

        $documents_comment = OlSocietyDocumentsComment::where('society_id', $society->id)->first();

        if($application->application_master_id == '2' || $application->application_master_id == '13'){
            $optional_docs = config('commanConfig.optional_docs_premium');
        }
        if($application->application_master_id == '6' || $application->application_master_id == '17'){
            $optional_docs = config('commanConfig.optional_docs_sharing');
        }

        $docs_uploaded_count = 0;
        $docs_count = 0;
        $i=0;
        foreach($documents as $documents_key => $documents_val){
            if(in_array($documents_key+1, $optional_docs) == false){
                $docs_count++;
                if(count($documents_val->documents_uploaded) > 0){
                    $docs_uploaded_count++;
                    $i++;
                }
            }
        }

        $documents_arr['docs_count'] = $docs_count;
        $documents_arr['docs_uploaded_count'] = $docs_uploaded_count;

        return view('frontend.society.society_upload_documents', compact('documents','ol_applications',  'optional_docs', 'docs_count', 'docs_uploaded_count', 'documents_uploaded', 'society', 'application', 'documents_comment', 'documents_arr'));
    }


    public function displaySocietyRevalDocuments(){

        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $application = OlApplication::where('society_id', $society->id)->with(['ol_application_master', 'olApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        } ])->orderBy('id', 'desc')->first();
        $ol_applications = $application;
        $documents = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->with(['reval_documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();
        foreach ($documents as $key => $value) {
            $document_ids[] = $value->id;
        }
        $documents_uploaded = RevalOlSocietyDocumentStatus::where('society_id', $society->id)->whereIn('document_id', $document_ids)->with(['documents_uploaded'])->get();

        $documents_comment = OlSocietyDocumentsComment::where('society_id', $society->id)->orderBy('id','desc')->first();

        if($application->application_master_id == '3' || $application->application_master_id == '14'){
            $optional_docs = config('commanConfig.optional_docs_premium_reval');
        }
        if($application->application_master_id == '7' || $application->application_master_id == '18'){
            $optional_docs = config('commanConfig.optional_docs_sharing_reval');
        }

        $docs_uploaded_count = 0;
        $docs_count = 0;
        foreach($documents as $documents_key => $documents_val){
            if(in_array($documents_val->id, $optional_docs) == false){
                $docs_count++;
                if(count($documents_val->reval_documents_uploaded) > 0){
                    $docs_uploaded_count++;
                }
            }
        }

        return view('frontend.society.society_upload_reval_documents', compact('documents','ol_applications',  'optional_docs', 'docs_count', 'docs_uploaded_count', 'documents_uploaded', 'society', 'application', 'documents_comment'));
    }


    public function displaySocietyOcDocuments(){

        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $application = OcApplication::where('society_id', $society->id)->with(['oc_application_master', 'ocApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        } ])->orderBy('id', 'desc')->first();
        $oc_applications = $application;
        $documents = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->with(['oc_documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();
        foreach ($documents as $key => $value) {
            $document_ids[] = $value->id;
        }
        $documents_uploaded = OcSocietyDocumentStatus::where('society_id', $society->id)->whereIn('document_id', $document_ids)->with(['documents_uploaded'])->get();

        $documents_comment = OcSocietyDocumentsComment::where('society_id', $society->id)->orderBy('id','desc')->first();

        if($application->application_master_id == '5' || $application->application_master_id == '16'){
            $optional_docs = config('commanConfig.optional_docs_premium_oc');
        }
        if($application->application_master_id == '11' || $application->application_master_id == '22'){
            $optional_docs = config('commanConfig.optional_docs_sharing_oc');
        }

        $docs_uploaded_count = 0;
        $docs_count = 0;
        foreach($documents as $documents_key => $documents_val){
            if(in_array($documents_val->id, $optional_docs) == false){
                $docs_count++;
                if(count($documents_val->oc_documents_uploaded) > 0){
                    $docs_uploaded_count++;
                }
            }
        }

        $check_upload_avail = 0;
        if($docs_uploaded_count >= $docs_count)
        {
            $check_upload_avail = 1;
        }

        return view('frontend.society.society_upload_oc_documents', compact('documents','oc_applications',  'optional_docs', 'docs_count', 'docs_uploaded_count', 'documents_uploaded', 'society', 'application', 'documents_comment','check_upload_avail'));
    }

    /**
     * Adds society documents comments.
     * Author: Amar Prajapati
     * @param  $request
     * @return \Illuminate\Http\Response
     */
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
            'application_id' => $request->applicationId,
            'society_documents_comment' => $comments,
        ); 
       OlSocietyDocumentsComment::updateOrCreate(['society_id' => $society->id, 'application_id' => $request->applicationId], $input);

        return redirect()->route('upload_society_offer_letter_application');
    }

    public function addSocietyRevalDocumentsComment(Request $request){
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

        OlSocietyDocumentsComment::where('society_id', $society->id)->update($input);
        return redirect()->route('upload_society_reval_offer_letter_application');
    }


    public function addSocietyOcDocumentsComment(Request $request){
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

        OcSocietyDocumentsComment::where('society_id', $society->id)->update($input);
        return redirect()->route('upload_society_oc_application');
    }

    /**
     * Adds society documents remark.
     * Author: Amar Prajapati
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function addSocietyDocumentsRemark(Request $request){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $application = OlApplication::where('society_id', $society->id)->first();
        $user = OlApplicationStatus::where('application_id', $application->id)->first();

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
        
        OlApplicationStatus::create($input_forwarded);
        OlApplicationStatus::create($input_in_process);
        return redirect()->route('society_offer_letter_dashboard');
    }

    public function addSocietyRevalDocumentsRemark(Request $request){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $application = OlApplication::where('society_id', $society->id)->first();
        $user = OlApplicationStatus::where('application_id', $application->id)->first();

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

        OlApplicationStatus::create($input_forwarded);
        OlApplicationStatus::create($input_in_process);
        return redirect()->route('upload_society_offer_letter_application');
    }

    /**
     * Shows self redevelopment application form in marathi.
     * Author: Amar Prajapati
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function viewSocietyDocuments(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $master_ids = config('commanConfig.new_offer_letter_master_ids');
        $application = OlApplication::where('society_id', $society->id)->whereIn('application_master_id', $master_ids)->with(['olApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->first();
        
        $documents = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->with(['documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();

        foreach ($documents as $key => $value) {
            $document_ids[] = $value->id;
        }
        if($application->application_master_id == '2' || $application->application_master_id == '13'){
            $optional_docs = config('commanConfig.optional_docs_premium');
        }
        if($application->application_master_id == '6' || $application->application_master_id == '17'){
            $optional_docs = config('commanConfig.optional_docs_sharing');
        }

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
        $ol_applications = $application;
        $documents_uploaded = OlSocietyDocumentsStatus::where('society_id', $society->id)->whereIn('document_id', $document_ids)->get();
        $documents_comment = OlSocietyDocumentsComment::where('society_id', $society->id)->where('application_id', $application->id)->first();

        return view('frontend.society.view_society_uploaded_documents', compact('documents', 'optional_docs', 'docs_uploaded_count','docs_count', 'ol_applications','documents_uploaded', 'documents_comment', 'society'));
    }


    public function viewSocietyRevalDocuments(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $application = OlApplication::where('society_id', $society->id)->with(['olApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->orderBy('id', 'desc')->first();

        $documents = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->with(['reval_documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();

        foreach ($documents as $key => $value) {
            $document_ids[] = $value->id;
        }
        if($application->application_master_id == '3' || $application->application_master_id == '14'){
            $optional_docs = config('commanConfig.optional_docs_premium_reval');
        }
        if($application->application_master_id == '7' || $application->application_master_id == '18'){
            $optional_docs = config('commanConfig.optional_docs_sharing_reval');
        }

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
        $ol_applications = $application;
        $documents_uploaded = RevalOlSocietyDocumentStatus::where('society_id', $society->id)->whereIn('document_id', $document_ids)->get();
        $documents_comment = OlSocietyDocumentsComment::where('society_id', $society->id)->orderBy('id','desc')->first();

        return view('frontend.society.view_society_uploaded_reval_documents', compact('documents', 'optional_docs', 'docs_uploaded_count','docs_count', 'ol_applications','documents_uploaded', 'documents_comment', 'society'));
    }


    public function viewSocietyOcDocuments(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $application = OcApplication::where('society_id', $society->id)->with(['ocApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
        }])->orderBy('id', 'desc')->first();

        $documents = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->with(['oc_documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();

        foreach ($documents as $key => $value) {
            $document_ids[] = $value->id;
        }
        if($application->application_master_id == '5' || $application->application_master_id == '16'){
            $optional_docs = config('commanConfig.optional_docs_premium_oc');
        }
        if($application->application_master_id == '11' || $application->application_master_id == '22'){
            $optional_docs = config('commanConfig.optional_docs_sharing_oc');
        }

        $docs_uploaded_count = 0;
        $docs_count = 0;
        foreach($documents as $documents_key => $documents_val) {
            if (in_array($documents_val->id, $optional_docs) == false) {
                $docs_count++;
                if (count($documents_val->oc_documents_uploaded) > 0) {
                    $docs_uploaded_count++;
                }
            }
        }
        $oc_applications = $application;
        $documents_uploaded = OcSocietyDocumentStatus::where('society_id', $society->id)->whereIn('document_id', $document_ids)->get();
        $documents_comment = OcSocietyDocumentsComment::where('society_id', $society->id)->orderBy('id','desc')->first();

        return view('frontend.society.view_society_uploaded_oc_documents', compact('documents', 'optional_docs', 'docs_uploaded_count','docs_count', 'oc_applications','documents_uploaded', 'documents_comment', 'society'));
    }



    /**
     * Uploads society documents.
     * Author: Amar Prajapati
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadSocietyDocuments(Request $request){
        $uploadPath = '/uploads/society_offer_letter_documents';
        $destinationPath = public_path($uploadPath);

        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $master_ids = config('commanConfig.new_offer_letter_master_ids');
        $application = OlApplication::where('society_id', $society->id)->whereIn('application_master_id', $master_ids)->first();

        $documents = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->where('id', $request->input('document_id'))->with(['documents_uploaded' => function($q) use ($society){
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
                $folder_name = "society_offer_letter_documents";
                $path = '/'.$folder_name.'/'.$name;
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
        $documents_master = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->with(['documents_uploaded' => function($q) use ($society){
                    $q->where('society_id', $society->id)->get();
                }])->get();

        if($application->application_master_id == '2' || $application->application_master_id == '13'){
            $optional_docs = config('commanConfig.optional_docs_premium');
        }
        if($application->application_master_id == '6' || $application->application_master_id == '17'){
            $optional_docs = config('commanConfig.optional_docs_sharing');
        }
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
            $role_id = Role::where('name', 'ee_junior_engineer')->first();
            
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
                OlApplicationStatus::insert($insert_application_log_pending);
                $add_comment = array(
                    'society_id' => $society->id,
                    'society_documents_comment' => 'N.A.',
                );
                OlSocietyDocumentsComment::create($add_comment);
            }
        }
        return redirect()->route('documents_upload');
    }


    public function uploadSocietyRevalDocuments(Request $request){
        $uploadPath = '/uploads/society_reval_offer_letter_documents';
        $destinationPath = public_path($uploadPath);

        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $application = OlApplication::where('society_id', $society->id)->orderBy('id','desc')->first();

        $documents = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->where('id', $request->input('document_id'))->with(['reval_documents_uploaded' => function($q) use ($society){
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
                $folder_name = "society_reval_offer_letter_documents";
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
        RevalOlSocietyDocumentStatus::create($input);
        $documents_master = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->with(['reval_documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();

        if($application->application_master_id == '3' || $application->application_master_id == '14'){
            $optional_docs = config('commanConfig.optional_docs_premium_reval');
        }
        if($application->application_master_id == '7' || $application->application_master_id == '18 '){
            $optional_docs = config('commanConfig.optional_docs_sharing_reval');
        }
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
            $role_id = Role::where('name','like', 'ree_junior_engineer')->first();

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
                OlApplicationStatus::insert($insert_application_log_pending);
                $add_comment = array(
                    'society_id' => $society->id,
                    'society_documents_comment' => 'N.A.',
                );
                OlSocietyDocumentsComment::create($add_comment);
            }
        }
        return redirect()->route('reval_documents_upload');
    }


    public function uploadSocietyOcDocuments(Request $request){
        $uploadPath = '/uploads/society_oc_documents';
        $destinationPath = public_path($uploadPath);

        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $application = OcApplication::where('society_id', $society->id)->orderBy('id','desc')->first();

        $documents = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->where('id', $request->input('document_id'))->with(['oc_documents_uploaded' => function($q) use ($society){
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
                $folder_name = "society_oc_documents";
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
        OcSocietyDocumentStatus::create($input);
        $documents_master = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->with(['oc_documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();

        if($application->application_master_id == '5' || $application->application_master_id == '16'){
            $optional_docs = config('commanConfig.optional_docs_premium_oc');
        }
        if($application->application_master_id == '11' || $application->application_master_id == '22 '){
            $optional_docs = config('commanConfig.optional_docs_sharing_oc');
        }
        $docs_uploaded_count = 0;
        $docs_count = 0;
        foreach($documents_master as $documents_key => $documents_val) {
            if (in_array($documents_val->id, $optional_docs) == false) {
                $docs_count++;
                if (count($documents_val->oc_documents_uploaded) > 0) {
                    $documents_uploaded[] = $documents_val->documents_uploaded;
                    $docs_uploaded_count++;
                }
            }
        }

        if($docs_count == $docs_uploaded_count){

            $role_ids = Role::where('name','like', 'ee_junior_engineer')->orWhere('name','like', 'EM')->pluck('id')->toArray();

            $user_ids = RoleUser::whereIn('role_id', $role_ids)->get();
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
                OcApplicationStatusLog::insert($insert_application_log_pending);
                $add_comment = array(
                    'society_id' => $society->id,
                    'society_documents_comment' => 'N.A.',
                );
                OcSocietyDocumentsComment::create($add_comment);
            }
        }
        return redirect()->route('oc_documents_upload');
    }

    /**
     * Deletes uploaded society documents.
     * Author: Amar Prajapati
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteSocietyDocuments($id){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $application = OlApplication::where('society_id', $society->id)->first();

        $documents_master = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->with(['documents_uploaded' => function($q) use ($society){
                    $q->where('society_id', $society->id)->get();
                }])->get();

        if($application->application_master_id == '2' || $application->application_master_id == '13'){
            $optional_docs = config('commanConfig.optional_docs_premium');
        }
        if($application->application_master_id == '6' || $application->application_master_id == '17'){
            $optional_docs = config('commanConfig.optional_docs_sharing');
        }
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
            $role_id = Role::where('name', 'ee_junior_engineer')->first();
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
            OlApplicationStatus::insert($insert_application_log_pending);
        }

        $delete_document_details = OlSocietyDocumentsStatus::where('society_id', $society->id)->where('document_id', $id)->get();
        $stored_filepath = explode('/', $delete_document_details[0]->society_document_path);
        $folder_name = "society_offer_letter_documents";
        $path = $folder_name.'/'.$stored_filepath[count($stored_filepath)-1];
        $delete = Storage::disk('ftp')->delete($path);
        OlSocietyDocumentsStatus::where('society_id', $society->id)->where('document_id', $id)->delete();

        return redirect()->route('documents_upload');
    }


    public function deleteSocietyRevalDocuments($id){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $application = OlApplication::where('society_id', $society->id)->orderBy('id','desc')->first();

        $documents_master = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->with(['reval_documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();

        if($application->application_master_id == '3' || $application->application_master_id == '14'){
            $optional_docs = config('commanConfig.optional_docs_premium_reval');
        }
        if($application->application_master_id == '7' || $application->application_master_id == '18'){
            $optional_docs = config('commanConfig.optional_docs_sharing_reval');
        }
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
            $role_id = Role::where('name','like', 'ree_junior_engineer')->first();
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
            OlApplicationStatus::insert($insert_application_log_pending);
        }

        $delete_document_details = RevalOlSocietyDocumentStatus::where('society_id', $society->id)->where('document_id', $id)->get();
        $stored_filepath = explode('/', $delete_document_details[0]->society_document_path);
        $folder_name = "society_reval_offer_letter_documents";
        $path = $folder_name.'/'.$stored_filepath[count($stored_filepath)-1];
        $delete = Storage::disk('ftp')->delete($path);
        RevalOlSocietyDocumentStatus::where('society_id', $society->id)->where('document_id', $id)->delete();

        return redirect()->route('reval_documents_upload');
    }


    public function deleteSocietyOcDocuments($id){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $application = OcApplication::where('society_id', $society->id)->orderBy('id','desc')->first();

        $documents_master = OlSocietyDocumentsMaster::where('application_id', $application->application_master_id)->with(['oc_documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();

        if($application->application_master_id == '5' || $application->application_master_id == '16'){
            $optional_docs = config('commanConfig.optional_docs_premium_oc');
        }
        if($application->application_master_id == '11' || $application->application_master_id == '22'){
            $optional_docs = config('commanConfig.optional_docs_sharing_oc');
        }
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

            $role_ids = Role::where('name','like', 'ee_junior_engineer')->orWhere('name','like', 'EM')->pluck('id')->toArray();

            $user_ids = RoleUser::whereIn('role_id', $role_ids)->get()->toArray();
            $user_ids = array_column($user_ids, 'user_id');
            $layout_user_ids = LayoutUser::where('layout_id', $request->input('layout_id'))->whereIn('user_id', $user_ids)->get();

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
            OcApplicationStatusLog::insert($insert_application_log_pending);
        }

        $delete_document_details = OcSocietyDocumentStatus::where('society_id', $society->id)->where('document_id', $id)->get();
        $stored_filepath = explode('/', $delete_document_details[0]->society_document_path);
        $folder_name = "society_oc_documents";
        $path = $folder_name.'/'.$stored_filepath[count($stored_filepath)-1];
        $delete = Storage::disk('ftp')->delete($path);
        OcSocietyDocumentStatus::where('society_id', $society->id)->where('document_id', $id)->delete();

        return redirect()->route('oc_documents_upload');
    }

    /**
     * Shows filled offer letter application form in pdf format.
     * Author: Amar Prajapati
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function displayOfferLetterApplication(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $society_details = SocietyOfferLetter::find($society->id);
        $ol_application = OlApplication::where('user_id', Auth::user()->id)->with(['request_form', 'applicationMasterLayout'])->first();
        $layouts = MasterLayout::all(); 
        $id = $ol_application->application_master_id;
        return view('frontend.society.display_society_offer_letter_application', compact('society_details', 'ol_application', 'layouts', 'id'));
    }

    /**
     * Shows filled offer letter application form in marathi.
     * Author: Amar Prajapati
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function showOfferLetterApplication(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $society_details = SocietyOfferLetter::find($society->id);
        $master_ids = config('commanConfig.new_offer_letter_master_ids');
        $ol_application = OlApplication::where('user_id', Auth::user()->id)->where('society_id', $society->id)->whereIn('application_master_id', $master_ids)->with(['request_form', 'applicationMasterLayout', 'olApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc');
        }])->first();
        $layouts = MasterLayout::all();
        $id = $ol_application->application_master_id;
        $ol_applications = $ol_application;
        $documents_arr = $this->get_docs_count($ol_application, $society_details);

//        dd($society_details->name);
        return view('frontend.society.show_ol_application_form', compact('society_details', 'ol_applications', 'ol_application', 'layouts', 'id', 'documents_arr'));
    }


    public function showOfferLetterRevalApplication(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $society_details = SocietyOfferLetter::find($society->id);
        $ol_application = OlApplication::where('user_id', Auth::user()->id)->where('society_id', $society->id)->with(['request_form', 'applicationMasterLayout', 'olApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc');
        }])->orderBy('id', 'desc')->first();

        $old_ol_application = OlApplication::where('user_id', Auth::user()->id)->where('society_id', $society->id)->with(['request_form', 'applicationMasterLayout', 'olApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc');
        }])->first();

        $layouts = MasterLayout::all();
        $id = $ol_application->application_master_id;
        $ol_applications = $ol_application;

        return view('frontend.society.show_reval_ol_application_form', compact('society_details', 'ol_applications', 'ol_application', 'layouts', 'id','old_ol_application'));
    }

    public function showOcApplication(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $society_details = SocietyOfferLetter::find($society->id);
        $oc_application = OcApplication::where('user_id', Auth::user()->id)->where('society_id', $society->id)->with(['request_form', 'applicationMasterLayout', 'ocApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc');
        }])->orderBy('id', 'desc')->first();

        $layouts = MasterLayout::all();
        $id = $oc_application->application_master_id;
        $oc_applications = $oc_application;

        $documents = OlSocietyDocumentsMaster::where('application_id', $oc_application->application_master_id)->with(['oc_documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();

        if($oc_application->application_master_id == '5' || $oc_application->application_master_id == '16'){
            $optional_docs = config('commanConfig.optional_docs_premium_oc');
        }
        if($oc_application->application_master_id == '11' || $oc_application->application_master_id == '22'){
            $optional_docs = config('commanConfig.optional_docs_sharing_oc');
        }

        $docs_uploaded_count = 0;
        $docs_count = 0;
        foreach($documents as $documents_key => $documents_val){
                if(in_array($documents_val->id, $optional_docs) == false){
                    $docs_count++;
                    if(count($documents_val->oc_documents_uploaded) > 0){
                        $docs_uploaded_count++;
                    }
                }
        }

        $check_upload_avail = 0;
        if($docs_uploaded_count >= $docs_count)
        {
            $check_upload_avail = 1;
        }

        return view('frontend.society.show_oc_application_form', compact('society_details', 'oc_applications', 'oc_application', 'layouts', 'id' , 'check_upload_avail'));
    }

    /**
     * Shows Edit offer letter application form.
     * Author: Amar Prajapati
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function editOfferLetterApplication(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $society_details = SocietyOfferLetter::find($society->id);
        $master_ids = config('commanConfig.new_offer_letter_master_ids');
        $ol_application = OlApplication::where('user_id', Auth::user()->id)->with(['request_form', 'applicationMasterLayout', 'ol_application_master'])->whereIn('application_master_id', $master_ids)->first();
        $layouts = MasterLayout::all();
        $id = $ol_application->application_master_id;
        $ol_applications = $ol_application;
        $documents_arr = $this->get_docs_count($ol_application, $society_details);

        return view('frontend.society.edit_form', compact('society_details', 'ol_applications', 'ol_application', 'layouts', 'id', 'documents_arr'));
    }

    public function editRevalOfferLetterApplication(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $society_details = SocietyOfferLetter::find($society->id);
        $ol_application = OlApplication::where('user_id', Auth::user()->id)->with(['request_form', 'ol_application_master', 'applicationMasterLayout'])->orderBy('id','desc')->first();
        $layouts = MasterLayout::all();
        $id = $ol_application->application_master_id;
        $ol_applications = $ol_application;

        return view('frontend.society.edit_reval_form', compact('society_details', 'ol_applications', 'ol_application', 'layouts', 'id'));
    }

    public function editOcApplication(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $society_details = SocietyOfferLetter::find($society->id);
        $oc_application = OcApplication::where('user_id', Auth::user()->id)->with(['request_form', 'ol_application_master', 'applicationMasterLayout'])->orderBy('id','desc')->first();
        $layouts = MasterLayout::all();
        $id = $oc_application->application_master_id;
        $oc_applications = $oc_application;

        $documents = OlSocietyDocumentsMaster::where('application_id', $oc_application->application_master_id)->with(['oc_documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();

        if($oc_application->application_master_id == '5' || $oc_application->application_master_id == '16'){
            $optional_docs = config('commanConfig.optional_docs_premium_oc');
        }
        if($oc_application->application_master_id == '11' || $oc_application->application_master_id == '22'){
            $optional_docs = config('commanConfig.optional_docs_sharing_oc');
        }

        $docs_uploaded_count = 0;
        $docs_count = 0;
        foreach($documents as $documents_key => $documents_val){
                if(in_array($documents_val->id, $optional_docs) == false){
                    $docs_count++;
                    if(count($documents_val->oc_documents_uploaded) > 0){
                        $docs_uploaded_count++;
                    }
                }
        }

        $check_upload_avail = 0;
        if($docs_uploaded_count >= $docs_count)
        {
            $check_upload_avail = 1;
        }

        return view('frontend.society.edit_oc_form', compact('society_details', 'oc_applications', 'oc_application', 'layouts', 'id' , 'check_upload_avail'));
    }

    /**
     * Updates offer letter application form.
     * Author: Amar Prajapati
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOfferLetterApplication(Request $request){
        //dd($request->input('department_name'));
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $update_input = array(
            'date_of_meeting' => date('Y-m-d', strtotime($request->date_of_meeting)),
            'resolution_no' => $request->resolution_no,
            'architect_name' => $request->architect_name,
            'developer_name' => $request->developer_name,
        );
        OlRequestForm::where('society_id', $society->id)->where('id', $request->request_form_id)->update($update_input);
        OlApplication::where('society_id', $society->id)->update(['department_id'=>$request->input('department_name')]);
        return redirect()->route('society_offer_letter_preview');
    }


    public function updateRevalOfferLetterApplication(Request $request){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $update_input = array(
            'date_of_meeting' => date('Y-m-d', strtotime($request->date_of_meeting)),
            'resolution_no' => $request->resolution_no,
            'architect_name' => $request->architect_name,
            'developer_name' => $request->developer_name,
            'ol_vide_no' => $request->ol_vide_no,
            'ol_issue_date' => date('Y-m-d', strtotime($request->ol_issue_date)),
            'reason_for_revalidation' => $request->reason_for_revalidation,
        );
        OlRequestForm::where('society_id', $society->id)->where('id', $request->request_form_id)->update($update_input);
        return redirect()->route('society_reval_offer_letter_preview');
    }

    public function updateOcApplication(Request $request){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $update_input = array(
            'architect_name' => $request->architect_name,
            'developer_name' => $request->developer_name,
            'construction_details' => $request->construction_details,
            'is_full_oc' => $request->is_full_oc,
        );
        OlRequestForm::where('society_id', $society->id)->where('id', $request->request_form_id)->update($update_input);
        return redirect()->route('society_oc_preview');
    }

    /**
     * Streams filled offer letter application form in marathi.
     * Author: Amar Prajapati
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function generate_pdf(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $society_details = SocietyOfferLetter::find($society->id);
        $master_ids = config('commanConfig.new_offer_letter_master_ids');
        $ol_application = OlApplication::where('user_id', Auth::user()->id)->whereIn('application_master_id', $master_ids)->with(['request_form', 'applicationMasterLayout'])->first();
        $layouts = MasterLayout::all(); 
        $id = $ol_application->application_master_id;
        
        $comment = OlSocietyDocumentsComment::where('application_id',$ol_application->id)->where('society_id',$society->id)->first();

        $mpdf = new Mpdf();
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $contents = view('frontend.society.display_society_offer_letter_application', compact('society_details', 'ol_application', 'layouts', 'id','comment'));
        $mpdf->WriteHTML($contents);
        $mpdf->Output();

    }

    public function generate_reval_pdf(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $society_details = SocietyOfferLetter::find($society->id);
        $ol_application = OlApplication::where('user_id', Auth::user()->id)->with(['request_form', 'applicationMasterLayout'])->orderBy('id','desc')->first();
        $layouts = MasterLayout::all();
        $id = $ol_application->application_master_id;

        $old_ol_application = OlApplication::where('user_id', Auth::user()->id)->where('society_id', $society->id)->with(['request_form', 'applicationMasterLayout', 'olApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc');
        }])->first();

        $mpdf = new Mpdf();
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $contents = view('frontend.society.display_society_reval_offer_letter_application', compact('society_details', 'ol_application', 'layouts', 'id','old_ol_application'));
        $mpdf->WriteHTML($contents);
        $mpdf->Output();

    }


    public function generate_oc_pdf(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $society_details = SocietyOfferLetter::find($society->id);
        $oc_application = OcApplication::where('user_id', Auth::user()->id)->with(['request_form', 'applicationMasterLayout'])->orderBy('id','desc')->first();
        $layouts = MasterLayout::all();
        $id = $oc_application->application_master_id;


        $mpdf = new Mpdf();
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;
        $contents = view('frontend.society.display_society_oc_application', compact('society_details', 'oc_application', 'layouts', 'id'));
        $mpdf->WriteHTML($contents);
        $mpdf->Output();

    }

    /**
     * Shows form to upload stamped offer letter application form.
     * Author: Amar Prajapati
     * @param  void
     * @return \Illuminate\Http\Response
     */
    public function showuploadOfferLetterAfterSign(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $master_ids = config('commanConfig.new_offer_letter_master_ids');
        $application_details = OlApplication::where('society_id', $society->id)->whereIn('application_master_id', $master_ids)->with(['ol_application_master', 'olApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc');
        }])->first();
        $ol_applications = $application_details;
        $documents_arr = $this->get_docs_count($ol_applications, $society);

        return view('frontend.society.upload_download_offer_letter_application_form', compact('ol_applications', 'application_details', 'documents_arr'));
    }

    public function showuploadRevalOfferLetterAfterSign(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $application_details = OlApplication::where('society_id', $society->id)->with(['ol_application_master', 'olApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc');
        }])->orderBy('id', 'desc')->first();
        $ol_applications = $application_details;

        return view('frontend.society.upload_download_reval_offer_letter_application_form', compact('ol_applications', 'application_details'));
    }

    public function showuploadOcAfterSign(){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $application_details = OcApplication::where('society_id', $society->id)->with(['oc_application_master', 'ocApplicationStatus' => function($q){
            $q->where('society_flag', '1')->orderBy('id', 'desc');
        }])->orderBy('id', 'desc')->first();
        $oc_applications = $application_details;

        $documents = OlSocietyDocumentsMaster::where('application_id', $application_details->application_master_id)->with(['oc_documents_uploaded' => function($q) use ($society){
            $q->where('society_id', $society->id)->get();
        }])->get();

        if($application_details->application_master_id == '5' || $application_details->application_master_id == '16'){
            $optional_docs = config('commanConfig.optional_docs_premium_oc');
        }
        if($application_details->application_master_id == '11' || $application_details->application_master_id == '22'){
            $optional_docs = config('commanConfig.optional_docs_sharing_oc');
        }

        $docs_uploaded_count = 0;
        $docs_count = 0;
        foreach($documents as $documents_key => $documents_val){
                if(in_array($documents_val->id, $optional_docs) == false){
                    $docs_count++;
                    if(count($documents_val->oc_documents_uploaded) > 0){
                        $docs_uploaded_count++;
                    }
                }
        }

        $check_upload_avail = 0;
        if($docs_uploaded_count >= $docs_count)
        {
            $check_upload_avail = 1;
        }

        return view('frontend.society.upload_download_oc_application_form', compact('oc_applications', 'application_details','check_upload_avail'));
    }

    /**
     * Uploads stamped offer letter application form in marathi in pdf format.
     * Author: Amar Prajapati
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadOfferLetterAfterSign(Request $request){

        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $application_name = OlApplication::where('society_id', $society->id)->with('ol_application_master')->get();
        $society_remark = OlSocietyDocumentsComment::where('society_id', $society->id)->orderBy('id', 'desc')->first();
        if($request->file('offer_letter_application_form'))
        {
            $file = $request->file('offer_letter_application_form');
            $file_name = time().$file->getFileName().'.'.$file->getClientOriginalExtension();
            $extension = $request->file('offer_letter_application_form')->getClientOriginalExtension();
            if ($extension == "pdf") {
                $time = time();
                $name = File::name($request->file('offer_letter_application_form')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                $folder_name = "society_offer_letter_documents";
                $path = config('commanConfig.storage_server').'/'.$folder_name.'/'.$name;
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('offer_letter_application_form'),$name);
                $input = array(
                    'application_path' => $path,
                    'submitted_at' => date('Y-m-d H-i-s')
                );
                OlApplication::where('society_id', $society->id)->where('id', $request->input('id'))->update($input);
                $role_id = Role::where('name', 'ee_junior_engineer')->first();
                $application = OlApplication::where('society_id', $society->id)->where('id', $request->input('id'))->first();

                $user_ids = RoleUser::where('role_id', $role_id->id)->get();

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
                        $insert_application_log_forwarded[$key]['is_active'] = 1;
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
                        $insert_application_log_in_process[$key]['is_active'] = 1;
                        $insert_application_log_in_process[$key]['created_at'] = date('Y-m-d H-i-s');
                        $insert_application_log_in_process[$key]['updated_at'] = date('Y-m-d H-i-s');
                        $i++;
                    }
                }

                //Code added by Prajakta >>start
                DB::beginTransaction();
                try {

                    OlApplicationStatus::where('application_id',$application->id)->update(array('is_active' => 0,'phase' => 0));


                    OlApplicationStatus::insert(array_merge($insert_application_log_forwarded, $insert_application_log_in_process));

                    DB::commit();
                } catch (\Exception $ex) {
                    DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
                }
                //Code added by Prajakta >>end
            }else{
                return redirect()->back()->with('error_uploaded_file', 'Invalid type of file uploaded (only pdf allowed)');
            }
        }
        return redirect()->route('society_offer_letter_dashboard');
    }

    public function uploadRevalOfferLetterAfterSign(Request $request){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $application_name = OlApplication::where('society_id', $society->id)->with('ol_application_master')->get();
        $society_remark = OlSocietyDocumentsComment::where('society_id', $society->id)->orderBy('id', 'desc')->first();
        if($request->file('reval_offer_letter_application_form'))
        {
            $file = $request->file('reval_offer_letter_application_form');
            $file_name = time().$file->getFileName().'.'.$file->getClientOriginalExtension();
            $extension = $request->file('reval_offer_letter_application_form')->getClientOriginalExtension();
            if ($extension == "pdf") {
                $time = time();
                $name = File::name($request->file('reval_offer_letter_application_form')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                $folder_name = "society_reval_offer_letter_documents";
                $path = config('commanConfig.storage_server').'/'.$folder_name.'/'.$name;
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('reval_offer_letter_application_form'),$name);
                $input = array(
                    'application_path' => $path,
                    'submitted_at' => date('Y-m-d H-i-s')
                );
                OlApplication::where('society_id', $society->id)->where('id', $request->input('id'))->update($input);
                $role_id = Role::where('name','like', 'ree_junior_engineer')->first();
                $application = OlApplication::where('society_id', $society->id)->where('id', $request->input('id'))->first();

                $user_ids = RoleUser::where('role_id', $role_id->id)->get();

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
                        $insert_application_log_forwarded[$key]['is_active'] = 1;
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
                        $insert_application_log_in_process[$key]['is_active'] = 1;
                        $insert_application_log_in_process[$key]['created_at'] = date('Y-m-d H-i-s');
                        $insert_application_log_in_process[$key]['updated_at'] = date('Y-m-d H-i-s');
                        $i++;
                    }
                }
//                OlApplicationStatus::insert(array_merge($insert_application_log_forwarded, $insert_application_log_in_process));

                //Code added by Prajakta >>start
                DB::beginTransaction();
                try {

                    OlApplicationStatus::where('application_id',$application->id)->update(array('is_active' => 0,'phase' => 0));


                OlApplicationStatus::insert(array_merge($insert_application_log_forwarded, $insert_application_log_in_process));

                    DB::commit();
                } catch (\Exception $ex) {
                    DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
                }
                //Code added by Prajakta >>end

            }else{
                return redirect()->back()->with('error_uploaded_file', 'Invalid type of file uploaded (only pdf allowed)');
            }
        }
        return redirect()->route('society_offer_letter_dashboard');
    }

    public function uploadOcAfterSign(Request $request){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();
        $application_name = OcApplication::where('society_id', $society->id)->with('oc_application_master')->get();
        $society_remark = OcSocietyDocumentsComment::where('society_id', $society->id)->orderBy('id', 'desc')->first();
        if($request->file('oc_application_form'))
        {
            $file = $request->file('oc_application_form');
            $file_name = time().$file->getFileName().'.'.$file->getClientOriginalExtension();
            $extension = $request->file('oc_application_form')->getClientOriginalExtension();
            if ($extension == "pdf") {
                $time = time();
                $name = File::name($request->file('oc_application_form')->getClientOriginalName()) . '_' . $time . '.' . $extension;
                $folder_name = "society_oc_documents";
                $path = config('commanConfig.storage_server').'/'.$folder_name.'/'.$name;
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('oc_application_form'),$name);
                $input = array(
                    'application_path' => $path,
                    'submitted_at' => date('Y-m-d H-i-s')
                );
                OcApplication::where('society_id', $society->id)->where('id', $request->input('id'))->update($input);



                $role_ids = Role::where('name','like', 'ee_junior_engineer')->orWhere('name','like', 'EM')->pluck('id')->toArray();
                $application = OcApplication::where('society_id', $society->id)->where('id', $request->input('id'))->first();

                $user_ids = RoleUser::whereIn('role_id', $role_ids)->get()->toArray();
                $user_ids = array_column($user_ids, 'user_id');
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
                        $insert_application_log_forwarded[$key]['is_active'] = 1;
                        $insert_application_log_forwarded[$key]['created_at'] = date('Y-m-d H-i-s');
                        $insert_application_log_forwarded[$key]['updated_at'] = date('Y-m-d H-i-s');

                        $insert_application_log_in_process[$key]['application_id'] = $application->id;
                        $insert_application_log_in_process[$key]['society_flag'] = 0;
                        $insert_application_log_in_process[$key]['user_id'] = $user->id;
                        $insert_application_log_in_process[$key]['role_id'] = $user->role_id;
                        $insert_application_log_in_process[$key]['status_id'] = config('commanConfig.applicationStatus.in_process');
                        $insert_application_log_in_process[$key]['to_user_id'] = null;
                        $insert_application_log_in_process[$key]['to_role_id'] = null;
                        $insert_application_log_in_process[$key]['remark'] = isset($society_remark->society_documents_comment) ? $society_remark->society_documents_comment : '' ;
                        $insert_application_log_in_process[$key]['is_active'] = 1;
                        $insert_application_log_in_process[$key]['created_at'] = date('Y-m-d H-i-s');
                        $insert_application_log_in_process[$key]['updated_at'] = date('Y-m-d H-i-s');
                        $i++;
                    }
                }
                OcApplicationStatusLog::insert(array_merge($insert_application_log_forwarded, $insert_application_log_in_process));
            }else{
                return redirect()->back()->with('error_uploaded_file', 'Invalid type of file uploaded (only pdf allowed)');
            }
        }
        return redirect()->route('society_offer_letter_dashboard');
    }


    public function society_applications(DataTables $datatables, Request $request){
        $society = SocietyOfferLetter::where('user_id', Auth::user()->id)->first();

        $columns = [
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application No.'],
            ['data' => 'application_type','name' => 'application_type','title' => 'Application Type'],
            ['data' => 'application_master_id','name' => 'application_master_id','title' => 'Model'],
            ['data' => 'created_at','name' => 'created_date','title' => 'Submission Date', 'class' => 'datatable-date'],
            ['data' => 'status','name' => 'status','title' => 'Status'],
//            ['data' => 'model','name' => 'model','title' => 'Model','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {

            $ol_applications = OlApplication::where('society_id', $society->id)->with(['application_master', 'ol_application_master', 'olApplicationStatus' => function($q){
                $q->where('society_flag', '1')->orderBy('id', 'desc');
            } ]);

            $ol_applications = $ol_applications->get();

            $sc_applications = scApplication::where('society_id', $society->id)->with(['application_master', 'scApplicationType' => function($q){
                $q->where('application_type', config('commanConfig.applicationType.Conveyance'))->first();
            }, 'scApplicationLog' => function($q){
                $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
            } ])->orderBy('id', 'desc');

            $sc_applications = $sc_applications->get();
            $ol_applications = $ol_applications->toBase()->merge($sc_applications);

            $sr_applications = RenewalApplication::where('society_id', $society->id)->with(['application_master', 'srApplicationType' => function($q){
                $q->where('application_type', config('commanConfig.applicationType.Renewal'))->first();
            }, 'srApplicationLog' => function($q){
                $q->where('society_flag', '1')->orderBy('id', 'desc')->first();
            } ])->orderBy('id', 'desc');

            $sr_applications = $sr_applications->get();
            $ol_applications = $ol_applications->toBase()->merge($sr_applications);

            $oc_applications = OcApplication::where('society_id', $society->id)->with(['application_master', 'ol_application_master', 'olApplicationStatus' => function($q){
                $q->where('society_flag', '1')->orderBy('id', 'desc');
            } ]);

            $oc_applications = $oc_applications->get();
            $ol_applications = $ol_applications->toBase()->merge($oc_applications);

            $noc_applications = NocolApplication::select('*')->where('society_id', $society->id)->with(['application_master', 'ol_application_master', 'olApplicationStatus' => function($q){
                $q->where('society_flag', '1')->orderBy('id', 'desc');
            } ]);

            $noc_applications = $noc_applications->addSelect(DB::raw("'1' as is_noc_application"));
            $noc_applications = $noc_applications->get();
            $ol_applications = $ol_applications->toBase()->merge($noc_applications);

            $noc_cc_applications = NocCColApplication::select('*')->where('society_id', $society->id)->with(['application_master', 'ol_application_master', 'olApplicationStatus' => function($q){
                $q->where('society_flag', '1')->orderBy('id', 'desc');
            } ]);

            $noc_cc_applications = $noc_cc_applications->addSelect(DB::raw("'1' as is_noc_cc_application"));
            $noc_cc_applications = $noc_cc_applications->get();
            $ol_applications = $ol_applications->toBase()->merge($noc_cc_applications);

            $reval_master_ids_arr = config('commanConfig.revalidation_master_ids');
            $oc_master_ids_arr = config('commanConfig.oc_master_ids');

            return $datatables->of($ol_applications)
                ->editColumn('radio', function ($ol_applications) use($reval_master_ids_arr, $oc_master_ids_arr) {

                    if(in_array($ol_applications->application_master->preview_route, config('commanConfig.preview_routes_without_id'))){
                        $url = route($ol_applications->application_master->preview_route);
                    }else{
                        $url = route($ol_applications->application_master->preview_route, encrypt($ol_applications->id));
                    }
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name=""><span></span></label>';

//                    if(isset($ol_applications->is_noc_application))
//                    {
//                        return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url_noc.'" name="ol_applications_id"><span></span></label>';
//                    }
//                    elseif($ol_applications->is_noc_cc_application)
//                    {
//                        return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url_noc_cc.'" name="ol_applications_id"><span></span></label>';
//                    }
//                    elseif(in_array($ol_applications->application_master_id,$reval_master_ids_arr))
//                    {
//                        return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$reval_url .'" name="ol_applications_id"><span></span></label>';
//
//                    }
//                    elseif(in_array($ol_applications->application_master_id,$oc_master_ids_arr))
//                    {
//                        return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$oc_url .'" name="ol_applications_id"><span></span></label>';
//
//                    }
//                    elseif(in_array($ol_applications->application_master_id,config('commanConfig.tripartite_master_ids')))
//                    {
//                        return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url_tripartite .'" name="ol_applications_id"><span></span></label>';
//
//                    }
//                    else{
//
//                        return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="ol_applications_id"><span></span></label>';
//                    }
                })
                ->editColumn('rownum', function ($ol_applications) {
                    static $i = 0;
                    $i++;
                    return $i;
                })
                ->editColumn('application_no', function ($ol_applications) use($reval_master_ids_arr, $oc_master_ids_arr) {



//                    if(isset($ol_applications->is_noc_application))
//                    {
//                        $app_type = "<br><span class='m-badge m-badge--danger'>Application for Noc</span>";
//                    }
//                    elseif($ol_applications->is_noc_cc_application)
//                    {
//                        $app_type = "<br><span class='m-badge m-badge--warning'>Application for Noc (CC)</span>";
//                    }
////                    elseif(in_array($ol_applications->application_master_id,$reval_master_ids_arr))
//                    elseif(isset($ol_applications->ol_application_master))
//                    {
//                        $app_type = "<br><span class='m-badge m-badge--success'> Application for ".$ol_applications->ol_application_master->title."</span>";
//                    }
//                    elseif(in_array($ol_applications->application_master_id,$oc_master_ids_arr))
//                    {
//                        $app_type = "<br><span class='m-badge m-badge--success'>Consent For OC</span>";
//                    }
//                    else
//                    {
//                        $app_type = "<br><span class='m-badge m-badge--success'>Application for Offer letter</span>";
//                    }

                    return $ol_applications->application_no;
                })
                ->editColumn('application_type', function ($ol_applications) {
                    if(isset($ol_applications->ol_application_master)){
                        return $ol_applications->ol_application_master->title;
                    }
                    elseif(isset($ol_applications->srApplicationType)){
                        return $ol_applications->srApplicationType->application_type;
                    }
                    elseif(isset($ol_applications->scApplicationType)){
                        return $ol_applications->scApplicationType->application_type;
                    }
                })
                ->editColumn('application_master_id', function ($ol_applications) {
                    if(isset($ol_applications->ol_application_master)) {
                        return $ol_applications->ol_application_master->model;
                    }else{
                        return '-';
                    }
                })
                ->editColumn('created_at', function ($ol_applications) {
                    return date(config('commanConfig.dateFormat'), strtotime($ol_applications->created_at));
                })
                ->editColumn('status', function ($ol_applications) {
                    if(isset($ol_applications->ol_application_master)){
                        return $this->get_society_applications_status(config('commanConfig.application_names.ree_offer_letter'), $ol_applications);
                    }
                    elseif(isset($ol_applications->srApplicationType)){
                        return $this->get_society_applications_status(config('commanConfig.application_names.renewal'), $ol_applications);
                    }
                    elseif(isset($ol_applications->scApplicationType)){
                        return $this->get_society_applications_status(config('commanConfig.application_names.conveyance'), $ol_applications);
                    }
                })
                ->editColumn('model', function ($ol_applications) {
//                    dd($ol_applications->olApplicationStatus[0]->status_id);
//                    return view('frontend.society.actions', compact('ol_applications', 'status_display'))->render();
                })
                ->rawColumns(['radio', 'application_no', 'application_type', 'application_master_id', 'created_at','status','model'])
                ->make(true);
        }

//        $self_parent = OlApplicationMaster::where('title', 'Self Redevelopment')->value('id');
//        $dev_parent = OlApplicationMaster::where('title', 'Redevelopment Through Developer')->value('id');
//
//        $getRequest = $request->all();
//        $applications_tab = array(
//            'self_pre_parent' => $self_parent.'_premium',
//            'self_share_parent' => $self_parent.'_sharing',
//            'dev_pre_parent' => $dev_parent.'_premium',
//            'dev_share_parent' => $dev_parent.'_sharing',
////            'dev_parent' => $dev_parent,
////            'self_premium' => $self_premium,
////            'self_sharing' => $self_sharing,
////            'dev_premium' => $dev_premium,
////            'dev_sharing' => $dev_sharing,
////            'self_reval_premium' => $self_reval_premium,
////            'self_reval_sharing' => $self_reval_sharing,
////            'dev_reval_premium' => $dev_reval_premium,
////            'dev_reval_sharing' => $dev_reval_sharing
//        );
//
//
//        Session::put('applications_tab', $applications_tab);



        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
        return view('frontend.society.dashboard', compact('html', 'ol_applications', 'ol_application_count'));
    }

    public function get_society_applications_status($application_type, $ol_applications){
        switch($application_type){
            case config('commanConfig.application_names.ree_offer_letter'):
                $status = explode('_', array_keys(config('commanConfig.applicationStatus'), $ol_applications->olApplicationStatus[0]->status_id)[0]);
                $status_display = '';
                foreach($status as $status_value){ $status_display .= ucwords($status_value). ' ';}
                $status_color = '';
                if($status_display == 'Sent To Society '){
                    $status_display = 'Approved';
                }

                if($status_display == 'Pending ' && $ol_applications->is_approve_offer_letter){
                    $status_display = 'Approved';
                }

                return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$ol_applications->olApplicationStatus[0]->status_id) .' m-badge--wide">'.$status_display.'</span>';
            case config('commanConfig.application_names.conveyance'):
                $status_display = '';
                if($ol_applications->application_status == config('commanConfig.conveyance_status.Send_society_to_pay_stamp_duty')){
                    $status_display = config('commanConfig.conveyance_status.society_stamp_duty');
                }elseif($ol_applications->application_status == config('commanConfig.conveyance_status.Send_society_for_registration_of_sale_&_lease')){
                    $status_display = config('commanConfig.conveyance_status.society_register_sale_lease_deed');
                }else{
                    $status = explode('_', array_keys(config('commanConfig.conveyance_status'), $ol_applications->scApplicationLog->status_id)[0]);
                    foreach($status as $status_value){ $status_display .= ucwords($status_value). ' ';}
                    $status_color = '';
                    if($status_display == 'Sent To Society '){
                        $status_display = 'Approved';
                    }
                }

                return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$ol_applications->scApplicationLog->status_id) .' m-badge--wide">'.$status_display.'</span>';
            case config('commanConfig.application_names.renewal'):
                $status_display = '';
                if($ol_applications->application_status == config('commanConfig.renewal_status.Send_society_to_pay_stamp_duty')){
                    $status_display = 'Pay Stamp Duty';
                }elseif($ol_applications->application_status == config('commanConfig.renewal_status.Send_society_for_registration_of_Lease_deed')){
                    $status_display = 'Register Lease Deed';
                }else{
                    $status = explode('_', array_keys(config('commanConfig.renewal_status'), $ol_applications->srApplicationLog->status_id)[0]);
                    foreach($status as $status_value){ $status_display .= ucwords($status_value). ' ';}
                    $status_color = '';
                    if($status_display == 'Sent To Society ' ){
                        $status_display = 'Approved';
                    }
                }

                return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$ol_applications->srApplicationLog->status_id) .' m-badge--wide">'.$status_display.'</span>';
        }
    } 

    public function uploadMultipleDocuments(Request $request,$societyId,$documentId){

        $documentId = decrypt($documentId);
        $societyId = decrypt($societyId);
        $ol_applications = OlApplication::where('user_id', Auth::user()->id)->where('society_id', 
            $societyId)->with(['request_form', 'applicationMasterLayout', 'olApplicationStatus' => function($q){$q->where('society_flag', '1')->orderBy('id', 'desc');
        }])->first();

        // $ol_applications = OlApplication::where('society_id', $societyId)->first();
        $documents = OlSocietyDocumentsStatus::where('document_id',$documentId)
        ->where('society_id', $societyId)->orderBy('id','desc')->get();
        $ol_applications->status = $this->getSocietyStatusLog($ol_applications->id);
        
        return view('frontend.society.upload_multiple_documents',compact('ol_applications','documentId','documents'));    
    }

    public function saveDocuments(Request $request){

        $file = $request->file('file');
        $societyId = $request->societyId;
        $documentId = $request->documentId;
        $folderName = "society_offer_letter_documents";
        try{
            if ($file->getClientMimeType() == 'application/pdf') {

                $extension = $request->file('file')->getClientOriginalExtension();
                $fileName = time().'_member_'.$societyId.'.'.$extension;
                $this->CommonController->ftpFileUpload($folderName,$file,$fileName); 

                $Documents = new OlSocietyDocumentsStatus();
                $Documents->society_id = $societyId;
                $Documents->document_id = $documentId;
                $Documents->member_name = $request->memberName;
                $Documents->society_document_path = $folderName.'/'.$fileName;
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

    public function deleteDocuments(Request $request){

        try{
            if (isset($request->oldFile) && isset($request->id)){
                Storage::disk('ftp')->delete($request->oldFile);
                OlSocietyDocumentsStatus::where('id',$request->id)->delete(); 
                $response['status'] = 'success';           
            }else{
                $response['status'] = 'error';
            }
        }catch(Exception $e){
            $response['status'] = 'error';
        }
        return response(json_encode($response), 200);       
    }

    public function getSocietyStatusLog($applicationId){
        
        $status = OlApplicationStatus::where('application_id',$applicationId)
        ->where('society_flag',1)->orderBy('id','desc')->first();
        return $status;
    }
}
