<?php

namespace App\Http\Controllers\EMDepartment;

use App\EENote;
use App\Http\Controllers\Common\CommonController;
use App\OlApplication;
use App\OlApplicationStatus;
use App\OlChecklistScrutiny;
use App\OlConsentVerificationDetails;
use App\OlConsentVerificationQuestionMaster;
use App\OlDemarcationVerificationDetails;
use App\OlDemarcationVerificationQuestionMaster;
use App\OlRelocationVerificationDetails;
use App\OlRgRelocationVerificationQuestionMaster;
use App\OlSocietyDocumentsMaster;
use App\OlSocietyDocumentsStatus;
use App\OlTitBitVerificationDetails;
use App\OlTitBitVerificationQuestionMaster;
use App\OcApplication;
use App\OcApplicationStatusLog;
use App\OcSrutinyQuestionMaster;
use App\OcEEScrutinyAnswer;
use App\Role;
use App\SocietyOfferLetter;
use App\TenantsLogDetails;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Mpdf\Mpdf;
use Yajra\DataTables\DataTables;
use Config;
use DB;
use File;
use Storage;
use App\MasterLayout;
use App\MasterWard;
use App\MasterColony;
use App\MasterBuilding;
use App\MasterTenant;
use App\SocietyDetail;
use App\ServiceChargesRate;
use App\ArrearCalculation;
use App\TransBillGenerate;
use App\TransPayment;
use App\LayoutUser;
use App\ArrearsChargesRate;
use App\TransBillServiceCharge;
use PDF;
use Yajra\DataTables\Html\Editor\Date;
use Yajra\DataTables\Html\Editor\DateTime;


class EMController extends Controller
{
    public function __construct()
    {
        $this->comman = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Datatables $datatables)
    {
        $getData = $request->all();

        //dd(session()->get('layout_id'));
        
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'submitted_at','name' => 'submitted_at','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no', 'name' => 'eeApplicationSociety.building_no', 'title' => 'Building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address','class' => 'datatable-address'],
//            ['data' => 'model','name' => 'model','title' => 'Model'],
            ['data' => 'Status','name' => 'current_status_id','title' => 'Status'],
            ['data' => 'radio','name' => 'radio','title' => 'Action','searchable' => false],

            // ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {

            $ee_application_data =  $this->comman->listApplicationData($request);

            return $datatables->of($ee_application_data)
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++; return $i;
                })
                ->editColumn('radio', function ($ee_application_data) {
                    $url = route('ee.view_application', $ee_application_data->id);
                    return '<div class="d-flex btn-icon-list"><a href="'.$url.'" onclick="geturl(this.value);" name="village_data_id" class="d-flex flex-column align-items-left"><span class="btn-icon btn-icon--view">
                        <img src="'. asset("img/view-icon.svg").'">
                    </span>View</span></a></div>';
                })
                ->editColumn('eeApplicationSociety.name', function ($listArray) {
                    return $listArray->eeApplicationSociety->name;
                })
                ->editColumn('eeApplicationSociety.building_no', function ($listArray) {
                    return $listArray->eeApplicationSociety->building_no;
                })
                ->editColumn('eeApplicationSociety.address', function ($listArray) {
                    return "<span>".$listArray->eeApplicationSociety->address."</span>";
                })
                ->editColumn('Status', function ($listArray) use ($request) {
                    $status = $listArray->olApplicationStatusForLoginListing[0]->status_id;
                    // dd(config('commanConfig.applicationStatusColor.'.$status));
                    if($request->update_status)
                    {
                        if($request->update_status == $status){
                            $config_array = array_flip(config('commanConfig.applicationStatus'));
                            $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                            return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$status) .' m-badge--wide">'.$value.'</span>';
                        }
                    } else {
                        $config_array = array_flip(config('commanConfig.applicationStatus'));
                        $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                        return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$status) .' m-badge--wide">'.$value.'</span>';
                    }

                })
                ->editColumn('submitted_at', function ($listArray) {
                    return date(config('commanConfig.dateFormat'), strtotime($listArray->submitted_at));
                })
                // ->editColumn('actions', function ($ee_application_data) use($request) {
                //     return view('admin.ee_department.actions', compact('ee_application_data', 'request'))->render();
                // })
                ->rawColumns(['radio','society_name', 'society_building_no', 'society_address', 'Status', 'submitted_at','eeApplicationSociety.address'])
                ->make(true);
        }
        
        $html = $datatables->getHtmlBuilder()->columns($columns)->postAjax()->parameters($this->getParameters());

        return view('admin.em_department.index', compact('html','header_data','getData'));
    }

    public function consent_for_oc(Request $request, Datatables $datatables)
    {
        $getData = $request->all();

        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'submitted_at','name' => 'submitted_at','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no', 'name' => 'eeApplicationSociety.building_no', 'title' => 'Building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address','class' => 'datatable-address'],
            ['data' => 'Model','name' => 'Model','title' => 'Application Type'],
            ['data' => 'Status','name' => 'current_status_id','title' => 'Status'],
            ['data' => 'radio','name' => 'radio','title' => 'Action','searchable' => false],

            // ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {

            $em_application_data =  $this->comman->listApplicationDataOc($request);

            return $datatables->of($em_application_data)
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++; return $i;
                })
                ->editColumn('radio', function ($em_application_data) {
                    $url = route('em.view_oc_application', $em_application_data->id);
                    return '<div class="d-flex btn-icon-list"><a href="'.$url.'" onclick="geturl(this.value);" name="village_data_id" class="d-flex flex-column align-items-left"><span class="btn-icon btn-icon--view">
                        <img src="'. asset("img/view-icon.svg").'">
                    </span>View</span></a></div>';
                })
                ->editColumn('eeApplicationSociety.name', function ($listArray) {
                    return $listArray->eeApplicationSociety->name;
                })
                ->editColumn('eeApplicationSociety.building_no', function ($listArray) {
                    return $listArray->eeApplicationSociety->building_no;
                })
                ->editColumn('eeApplicationSociety.address', function ($listArray) {
                    return "<span>".$listArray->eeApplicationSociety->address."</span>";
                })
                ->editColumn('Status', function ($listArray) use ($request) {
                    $status = $listArray->ocApplicationStatusForLoginListing[0]->status_id;
                    // dd(config('commanConfig.applicationStatusColor.'.$status));
                    if($request->update_status)
                    {
                        if($request->update_status == $status){
                            $config_array = array_flip(config('commanConfig.applicationStatus'));
                            $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                            return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$status) .' m-badge--wide">'.$value.'</span>';
                        }
                    }else{
                        $config_array = array_flip(config('commanConfig.applicationStatus'));
                        $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                        return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$status) .' m-badge--wide">'.$value.'</span>';
                    }

                })
                ->editColumn('Model', function ($listArray) {

                    $application_type = '';
                    $type = $listArray->oc_application_master->ol_application_type[0]->title;
                    if (strpos($type, 'Self') !== false) {
                        $application_type = 'Self';
                    }elseif(strpos($type, 'Developer') !== false){
                        $application_type = 'Through Developer';
                    }else{
                        $application_type = '-';
                    }
                    return $application_type."\n".'('.$listArray->oc_application_master->model.')' ;


//                    return $listArray->oc_application_master->model;
                })
                ->editColumn('submitted_at', function ($listArray) {
                    return date(config('commanConfig.dateFormat'), strtotime($listArray->submitted_at));
                })
                // ->editColumn('actions', function ($ee_application_data) use($request) {
                //     return view('admin.ee_department.actions', compact('ee_application_data', 'request'))->render();
                // })
                ->rawColumns(['radio','society_name', 'society_building_no', 'society_address', 'Status', 'submitted_at','eeApplicationSociety.address'])
                ->make(true);
        }

        $html = $datatables->getHtmlBuilder()->columns($columns)->postAjax()->parameters($this->getParameters());

        return view('admin.em_department.oc_applications', compact('html','header_data','getData'));
    }

    public function viewOCApplication(Request $request, $applicationId)
    {
        $oc_application = $this->comman->downloadConsentforOc($applicationId);
        $oc_application->folder = 'em_department';
        /*$oc_application->status = $this->comman->getCurrentStatus($applicationId);*/
        return view('admin.common.consent_for_oc', compact('oc_application'));
    }

    public function societyDocumentsOC(Request $request,$applicationId)
    {
        $oc_application = $this->comman->getOcApplication($applicationId);    
         $societyDocuments = $this->comman->getSocietyDocumentsforOC($applicationId);
        $oc_application->status = $this->comman->getCurrentStatusOc($applicationId);
        $comments = $this->comman->getOCApplicationComments($applicationId);
        return view('admin.em_department.society_documents_consent_oc', compact('oc_application','comments','societyDocuments'));
    }

    public function generateNoDueCertificateOc(Request $request,$applicationId)
    {
        $oc_application = $this->comman->getOcApplication($applicationId);
        $oc_application->model = OcApplication::with(['oc_application_master'])->where('id',$applicationId)->first();
        $applicationLog = $this->comman->getCurrentStatusOc($applicationId);
        $societyData = OcApplication::with(['eeApplicationSociety'])
                ->where('id',$applicationId)->orderBy('id','DESC')->first();
        $oc_application->status = $this->comman->getCurrentStatusOc($applicationId);

        $societyData->em_eng = (session()->get('role_name') == config('commanConfig.estate_manager'));

        return view('admin.em_department.no_due_certificate',compact('societyData','oc_application','applicationLog'));
    }

    public function createEditNoDueCert(Request $request,$applicatonId){
        
        $model = OcApplication::with('oc_application_master','eeApplicationSociety','request_form')->where('id',$applicatonId)->first();

        $blade =  "em_no_due_cert";

        if($model->no_dues_certificate_text){

            $content = Storage::disk('ftp')->get($model->no_dues_certificate_text); 
                   
        }else{
           $content = ""; 
        }

        return view('admin.em_department.'.$blade,compact('applicatonId','content','model'));
    }

    public function saveNoDuesCertOc(Request $request){

        $noc_application = $this->comman->getOcApplication($request->applicationId);

        $id = $request->applicationId;
        $content = str_replace('_', "", $_POST['ckeditorText']);
        $folder_name = 'No_Dues_Cert_Oc';

        /*$header_file = view('admin.REE_department.offer_letter_header');        
        $footer_file = view('admin.REE_department.offer_letter_footer');*/
        $header_file = '';
        $footer_file = '';

        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadHTML($header_file.$content.$footer_file);

        $fileName = time().'no_due_cert_oc'.$id.'.pdf';
        $filePath = $folder_name."/".$fileName;

        if (!(Storage::disk('ftp')->has($folder_name))) {            
            Storage::disk('ftp')->makeDirectory($folder_name, $mode = 0777, true, true);
        } 
        Storage::disk('ftp')->put($filePath, $pdf->output());
        $file = $pdf->output();

        $folder_name1 = 'text_no_due_cert_oc';

        if (!(Storage::disk('ftp')->has($folder_name1))) {            
            Storage::disk('ftp')->makeDirectory($folder_name1, $mode = 0777, true, true);
        }        
        $file_nm =  time()."text_no_due_cert_oc".$id.'.txt';
        $filePath1 = $folder_name1."/".$file_nm;

        Storage::disk('ftp')->put($filePath1, $content);

        OcApplication::where('id',$request->applicationId)->update(["no_dues_certificate_draft" => $filePath, "no_dues_certificate_text" => $filePath1]);

        \Session::flash('success_msg', 'No Dues Certificate has been successfully generated..');

        return redirect('no_dues_certificate_em_oc/'.$request->applicationId);
    }

    public function uploadOfficeNoteOcEM(Request $request){
        $applicationId   = $request->application_id;
        $uploadPath      = '/uploads/em_office_note_oc';
        $destinationPath = public_path($uploadPath);

        if ($request->file('em_office_note_oc')){

            $file = $request->file('em_office_note_oc');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'em_office_note_oc.'.$extension;
            $folder_name = "em_office_note_oc";
            $path = $folder_name."/".$file_name;

            if($extension == "pdf") {

                $fileUpload = $this->comman->ftpFileUpload($folder_name,$request->file('em_office_note_oc'),$file_name);

                OcApplication::where('id',$applicationId)->update(["em_office_note_oc" => $path]);

                return back()->with('success', 'Office Note has been uploaded successfully');
            }
            else
            {
                return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
            }
        }
    }

    public function forwardApplicationOcEM(Request $request, $applicationId){

        $oc_application = $this->comman->getOcApplication($applicationId);
        $oc_application->model = OcApplication::with(['oc_application_master'])->where('id',$applicationId)->first();
        $applicationData = $this->comman->getForwardOcApplication($applicationId);

        $parentData = $this->comman->getForwardApplicationParentData();
        $arrData['parentData'] = $parentData['parentData'];
        $arrData['role_name'] = $parentData['role_name'];

/*        if(session()->get('role_name') != config('commanConfig.ee_junior_engineer'))
        $arrData['application_status'] = $this->comman->getCurrentLoggedInChildOc($applicationId);*/

        $arrData['get_current_status'] = $this->comman->getCurrentStatusOc($applicationId);

        // REE junior Forward Application
        $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
        $layout_ids = array_column($layout_id_array, 'layout_id');
        $ree_jr_id = Role::where('name', '=', config('commanConfig.ree_junior'))->first();

        $arrData['get_forward_ree'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                                ->whereIn('lu.layout_id', $layout_ids)
                                ->where('role_id', $ree_jr_id->id)->groupBy('users.id')->get();
        $arrData['ree_junior_name'] = strtoupper(str_replace('_', ' ', $ree_jr_id->name));

        //remark and history
        $eelogs   = $this->comman->getLogsOfEEDepartmentforOc($applicationId);
        $emlogs   = $this->comman->getLogsOfEMforOc($applicationId);
        $reeLogs  = $this->comman->getLogsOfREEDepartmentForOc($applicationId); 
        $coLogs   = $this->comman->getLogsOfCODepartmentForOc($applicationId); 

          // dd($ol_application->offer_letter_document_path);
        return view('admin.em_department.forward_application_oc',compact('applicationData','arrData','oc_application','reeLogs','coLogs','eelogs','emlogs'));  
    }

    function sendForwardOcApplication(Request $request)
    {
        if($request->check_status == 1) {
            $forward_application = [[
                'application_id' => $request->applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id'),
                'status_id' => config('commanConfig.applicationStatus.forwarded'),
                'to_user_id' => $request->to_user_id,
                'to_role_id' => $request->to_role_id,
                'remark' => $request->remark,
                'is_active' => 1,
                'created_at' => Carbon::now()
            ],

            [
                'application_id' => $request->applicationId,
                'user_id' => $request->to_user_id,
                'role_id' => $request->to_role_id,
                'status_id' => config('commanConfig.applicationStatus.in_process'),
                'to_user_id' => NULL,
                'to_role_id' => NULL,
                'remark' => $request->remark,
                'is_active' => 1,
                'created_at' => Carbon::now()
            ]
            ];

            DB::beginTransaction();
            try {
                OcApplicationStatusLog::where('application_id',$request->applicationId)
                    ->update(array('is_active' => 0));

                OcApplicationStatusLog::insert($forward_application);

                DB::commit();
            } catch (\Exception $ex) {
                DB::rollback();
            }
        }

        return redirect('/consentoc_em')->with('success','Application send successfully.');
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [0, "asc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    }

    public function getsocieties(Request $request, Datatables $datatables){
      //dd($request->id);
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'society_name','name' => 'lm_society_detail.society_name','title' => 'Society Name','searchable' => true],
            ['data' => 'ward_name','name' => 'master_wards.name','title' => 'Ward','searchable' => true],
            ['data' => 'col_name','name' => 'master_colonies.name','title' => 'Colony','searchable' => true],
            ['data' => 'billname','name' => 'master_society_bill_level.name','title' => 'Bill type','searchable' => true],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];


        $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
        $layout_data = MasterLayout::whereIn('id', $layouts)->get();
        //dd($layout_data->toArray());
        $wards = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
        //dd($wards);
        $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');
        //dd($colonies);
        
        //done by shrikant sabne
        //$societies = SocietyDetail::whereIn('colony_id', $colonies)->paginate(10);
        if ($request->has('layout') && $request->get('layout') != '') {
            $wards = MasterWard::where('layout_id', '=', decrypt($request->input('layout')))->pluck('id');
            $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');
            $layout_id = decrypt($request->input('layout'));
        } 

        if ($datatables->getRequest()->ajax()) {
           
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
        
            if ($request->has('layout') && $request->get('layout') != '') {
                $societies = SocietyDetail::selectRaw('@rownum  := @rownum  + 1 AS rownum,lm_society_detail.*,master_colonies.name as col_name,master_wards.name as ward_name,master_society_bill_level.name as billname')
                    ->leftjoin('master_wards','master_wards.layout_id','=','lm_society_detail.layout_id')
                    ->leftjoin('master_society_bill_level','master_society_bill_level.id','=','lm_society_detail.society_bill_level')
                    ->leftjoin('master_colonies','master_colonies.id','=','lm_society_detail.colony_id')
                    ->where('lm_society_detail.layout_id',decrypt($request->input('layout')));
            } else {
                $societies = SocietyDetail::selectRaw('@rownum  := @rownum  + 1 AS rownum,lm_society_detail.*,master_colonies.name as col_name,master_wards.name as ward_name,master_society_bill_level.name as billname')
                     ->leftjoin('master_wards','master_wards.layout_id','=','lm_society_detail.layout_id')
                     ->leftjoin('master_society_bill_level','master_society_bill_level.id','=','lm_society_detail.society_bill_level')
                     ->leftjoin('master_colonies','master_colonies.id','=','lm_society_detail.colony_id');
            }
            if($request->search['value']!="")
           {
            $societies=$societies->where('master_colonies.name','like','%'.$request->search['value'].'%')
            ->orWhere('master_wards.name','like','%'.$request->search['value'].'%')
            ->orWhere('lm_society_detail.society_name','like','%'.$request->search['value'].'%')
            ->orWhere('master_society_bill_level.name','like','%'.$request->search['value'].'%');
            //$societies=$societies;
            //dd($societies->toSql());
           }

            return $datatables->of($societies)
                ->editColumn('actions', function ($societies){
                    return "<div class='d-flex btn-icon-list'>
                    <a href='".route('get_buildings', [encrypt($societies->id)])."' class='d-flex flex-column align-items-center ' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--view'><img src='".asset('/img/view-icon.svg')."'></span>Building Details</a>
                
                    <a href='".route('soc_bill_level', [encrypt($societies->id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/edit-icon.svg')."'></span>Bill Level</a>
                   
                    <a href='".route('soc_ward_colony', [encrypt($societies->id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--delete'><img src='".asset('/img/generate-bill-icon.svg')."'></span>Ward & colony</a>

                </div>";
                    
                })               
                ->rawColumns(['actions'])
                ->make(true);
            
        }
     
        $html = $datatables->getHtmlBuilder()->columns($columns)->postAjax()->parameters($this->getParameters());

        return view('admin.em_department.society', compact('layout_data','html','layout_id'));

    //     if($request->input('id')){            
    //         $wards = MasterWard::where('layout_id', '=', $request->input('id'))->pluck('id');
    //         $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');
    //         $societies = SocietyDetail::whereIn('colony_id', $colonies)->paginate(10);
            
    //         return view('admin.em_department.ajax_society', compact('societies'));
            
    //     } elseif(!empty($request->input('search'))) {
                
    //       $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
    //       $layout_data = MasterLayout::whereIn('id', $layouts)->get();
    //       $wards = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
    //       $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');
    //       $societies = SocietyDetail::whereIn('colony_id', $colonies)->where('society_name','like', '%'.$request->input('search').'%')->paginate(10);
    //       return view('admin.em_department.ajax_society', compact('societies'));
        
    //     } else {
    
    //     $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
    //     $layout_data = MasterLayout::whereIn('id', $layouts)->get();
    //    // dd($layout_data);
    //     $wards = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
    //     //dd($wards);
    //     $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');
    //     //dd($colonies);

    //     //done by shrikant sabne
    //     //$societies = SocietyDetail::whereIn('colony_id', $colonies)->paginate(10);
        
    //     $societies = SocietyDetail::paginate(10);
    //     //dd($societies);
    //     if($request->has('search')) {
    //         return view('admin.em_department.ajax_society', compact('societies'));  
    //     } else {
    //         return view('admin.em_department.society', compact('layout_data','societies'));
    //     }
    //   }
     
    }

    public function getbuildings($id, Request $request, Datatables $datatables){
        //$societies = SocietyDetail::whereIn('colony_id', $colonies)->get();
       // dd($id);
       $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'building_no','name' => 'building_no','title' => 'Building / Chawl Number'],
            ['data' => 'name','name' => 'name','title' => 'Building / Chawl Name'],
            ['data' => 'tenant_count','name' => 'tenant_count','title' => 'Tenant Count'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];
        $society_id =decrypt($id);
        $building_name = '';
        $building_no   = '';

        if($request->has('building_name') && !empty($request->building_name)) {
            $building_name = $request->building_name;
        }
        if($request->has('building_no') && !empty($request->building_no)) {
            $building_no = $request->building_no;
        }
        
        if ($datatables->getRequest()->ajax()) {
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
            $buildings =MasterBuilding::with('tenant_count')->where('society_id', '=', decrypt($id))->where(function ($query) use ($request) {
                       $query->orWhere('name', 'like', '%'.$request->building_name.'%')
                         ->orWhere('building_no', 'like', '%'.$request->building_no.'%');
                        })
                        ->selectRaw('@rownum  := @rownum  + 1 AS rownum,master_buildings.*')->orderBy('id','DESC')
                        ->get();
            
            return $datatables->of($buildings)
            ->editColumn('tenant_count', function ($buildings){  
               $value = $buildings->tenant_count->toArray(); 
               if($value) {
                   foreach($value as $i) {
                     return $i['count'];
                   }
                } else {
                    return 0;
                }
            })
            ->editColumn('actions', function ($buildings){
                return "<div class='d-flex btn-icon-list'>
                <a href='".route('get_tenants', [encrypt($buildings->id)])."' class='d-flex flex-column align-items-center ' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--view'><img src='".asset('/img/view-icon.svg')."'></span>Tenant Details</a>
              
                <a href='".route('edit_building', [encrypt($buildings->id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/edit-icon.svg')."'></span>Edit</a>

            </div>";
                
            })               
            ->rawColumns(['actions'])
            ->make(true);
         }
         $html = $datatables->getHtmlBuilder()->columns($columns)->postAjax()->parameters($this->getParameters());
         return view('admin.em_department.building', compact('html', 'society_id','building_name','building_no'));
        // if(!empty($request->input('search'))) {
        //     $society_id = $id;
        //     $buildings = MasterBuilding::with('tenant_count')->where('society_id', '=', decrypt($id))
        //         ->where(function ($query) use ($request) {
        //           $query->orWhere('name', 'like', '%'.$request->input('search').'%')
        //                ->orWhere('building_no', 'like', '%'.$request->input('search').'%');
        //         })
        //         ->paginate(10);
        //     //dd($buildings);
        //     return view('admin.em_department.ajax_building', compact('buildings', 'society_id'));
        // } else {
        //     $society_id =decrypt($id);
        //     $building_name = '';
        //     $building_no   = '';

        //     if($request->has('building_name') && !empty($request->building_name)) {
        //         $building_name = $request->building_name;
        //     }
        //     if($request->has('building_no') && !empty($request->building_no)) {
        //         $building_no = $request->building_no;
        //     }
        //     $buildings = MasterBuilding::with('tenant_count')->where('society_id', '=', decrypt($id))->where(function ($query) use ($request) {
        //           $query->orWhere('name', 'like', '%'.$request->building_name.'%')
        //                ->orWhere('building_no', 'like', '%'.$request->building_no.'%');
        //         })->paginate(10);
        //     //dd($buildings);
        //     if($request->has('search')) {
        //         return view('admin.em_department.ajax_building', compact('buildings', 'society_id'));  
        //     } else {
        //         return view('admin.em_department.building', compact('buildings', 'society_id','building_name','building_no'));
        //     }            
        // }
        
    }

    public function gettenants($id, Request $request, Datatables $datatables){
         $tenament = DB::table('master_tenant_type')->get();

         $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'flat_no','name' => 'flat_no','title' => 'Flat No.'],
            ['data' => 'salutation','name' => 'salutation','title' => 'Salutation'],
            ['data' => 'first_name','name' => 'first_name','title' => 'First Name'],
            ['data' => 'middle_name','name' => 'middle_name','title' => 'Middle Name'],
            ['data' => 'last_name','name' => 'last_name','title' => 'Last Name'],
            ['data' => 'use','name' => 'use','title' => 'Use'],
            ['data' => 'carpet_area','name' => 'carpet_area','title' => 'Carpet Area'],
            ['data' => 'tenanttype.name','name' => 'tenanttype.name','title' => 'Tenant Type'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false]
        ];
        $building_id = $id;
        $society_id = MasterBuilding::find(decrypt($id))->society_id;
        if ($datatables->getRequest()->ajax()) {
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
            $buildings = MasterTenant::selectRaw('@rownum  := @rownum  + 1 AS rownum,master_tenants.*')->where('building_id',decrypt($id))->with('tenanttype');
            return $datatables->of($buildings)
                ->editColumn('actions', function ($buildings){
                    return "<div class='d-flex btn-icon-list'>
                    <a href='".route('change_tenants', [encrypt($buildings->id)])."' class='d-flex flex-column align-items-center ' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--view'><img src='".asset('/img/view-icon.svg')."'></span>Change Tenant</a>
                    <a href='".route('edit_tenant', [encrypt($buildings->id)])."' class='d-flex flex-column align-items-center ' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--view'><img src='".asset('/img/edit-icon.svg')."'></span>Edit</a>
                    <a href='".route('delete_tenant', [encrypt($buildings->id)])."' class='d-flex flex-column align-items-center' onclick='return confirm(".'"'.'Are you sure want to delete Tenant details?'.'"'.")' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--delete'><img src='".asset('/img/delete-icon.svg')."'></span>Delete</a>

                </div>";
                    
                })               
                ->rawColumns(['actions'])
                ->make(true);
        }
        $html = $datatables->getHtmlBuilder()->columns($columns)->postAjax()->parameters($this->getParameters());
        return view('admin.em_department.tenant', compact('html', 'tenament','building_id','society_id'));
        // if(!empty($request->input('search'))) {
        //     $building_id = $id;
        // 
        //     $society_id = MasterBuilding::find(decrypt($id))->society_id;
        //     $buildings = MasterTenant::where('building_id', '=', decrypt($id))
        //          ->where(function ($query) use ($request) {
        //            $query->orWhere('first_name', 'like', '%'.$request->input('search').'%')
        //                 ->orWhere('middle_name', 'like', '%'.$request->input('search').'%')
        //                 ->orWhere('flat_no', 'like', '%'.$request->input('search').'%')
        //                 ->orWhere('last_name', 'like', '%'.$request->input('search').'%');
        //         })->paginate(10);
        //     return view('admin.em_department.ajax_tenant', compact('tenament','buildings', 'building_id','society_id'));
        // } else {
        //     $building_id = $id;
        //     $society_id = MasterBuilding::find(decrypt($id))->society_id;
        //     $buildings = MasterTenant::where('building_id', '=', decrypt($id))->paginate(10);
        //     if($request->has('search')) {
        //         return view('admin.em_department.ajax_tenant', compact('tenament','buildings', 'building_id','society_id'));  
        //     } else {
        //         return view('admin.em_department.tenant', compact('tenament','buildings', 'building_id','society_id'));
        //     }
        // }
        
    }

    public function soc_bill_level($id){
        $society = SocietyDetail::where('id','=',decrypt($id))->get();
        //dd($society);
        $soc_bill_level = DB::table('master_society_bill_level')->get();
       // dd($soc_bill_level);
        return view('admin.em_department.soc_bill_level', compact('society','soc_bill_level'));
    }

    public function soc_ward_colony($id){
        
        $society = SocietyDetail::where('id','=',decrypt($id))->get();
        //dd($society);
        $soc_colony = MasterColony::where('id', '=', $society[0]->colony_id)->first();

        //$soc_colony = MasterColony::first();
        //dd($soc_colony);
        $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
        $layout_data = MasterLayout::whereIn('id', $layouts)->get();
       // dd($layout_data);
        $wards = MasterWard::whereIn('layout_id', $layouts)->get();
        
        $wards_id = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
       
        $colonies = MasterColony::whereIn('ward_id', $wards_id)->get();
        // dd($colonies);
       return view('admin.em_department.soc_ward_colony', compact('society','wards','colonies', 'soc_colony'));
    }

    public function get_wards(Request $request){
    
        if($request->input('id')){
        $wards = MasterWard::where('layout_id', '=', decrypt($request->input('id')))->get();

        $html = '<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="wards" name="wards">';
        $html .= '<option value="" style="font-weight: normal;">Select ward</option>';

            foreach($wards as $key => $value){
                $html .= '<option value="'.encrypt($value->id).'">'.$value->name.'</option>';
            }   
        $html .= '</select>';         

        return $html;
        }
    }

    public function get_colonies(Request $request){
    
        if($request->input('id')){
        $colonies = MasterColony::where('ward_id', '=', decrypt($request->input('id')))->get();

        $html = '<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="colony" name="colony">';
        $html .= '<option value="" style="font-weight: normal;">Select Colony</option>';

            foreach($colonies as $key => $value){
                $html .= '<option value="'.encrypt($value->id).'">'.$value->name.'</option>';
            }   
        $html .= '</select>';         

        return $html;
        }
    }

    public function get_society_select(Request $request){
    
        if($request->input('id')){
        $society = SocietyDetail::where('colony_id', '=', decrypt($request->input('id')))->get();

        $html = '<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="society" name="society">';
        $html .= '<option value="" style="font-weight: normal;">Select Society</option>';

            foreach($society as $key => $value){
                $html .= '<option value="'.encrypt($value->id).'">'.$value->society_name.'</option>';
            }   
        $html .= '</select>';         

        return $html;
        }
    }

    public function get_building_ajax(Request $request){

            $society_id = $request->input('id');
            $buildings = MasterBuilding::with('tenant_count')->where('society_id', '=', $request->input('id'))
                        ->get();
            //return $buildings;
            return view('admin.em_department.ajax_building_bill_generation', compact('buildings', 'society_id'));
    }

    public function get_building_select(Request $request){
    
        if($request->input('id')){
        $building = MasterBuilding::where('society_id', '=', decrypt($request->input('id')))->get();

        $html = '<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="building" name="building">';
        $html .= '<option value="" style="font-weight: normal;">Select Building</option>';

            foreach($building as $key => $value){
                $html .= '<option value="'.encrypt($value->id).'">'.$value->name.'</option>';
            }   
        $html .= '</select>';         

        return $html;
        }
    }

    public function get_tenant_ajax(Request $request, Datatables $datatables){
//         print_r($request->download);exit;
         $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
         $layout_data = MasterLayout::whereIn('id', $layouts)->get();
         
        // dd($layout_data);
         $wards = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
         $wards_data = MasterWard::whereIn('layout_id', $layouts)->get();
 
         //dd($wards);
         $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');
         $colonies_data = MasterColony::whereIn('ward_id', $wards)->get();
 
         //dd($colonies);
         $societies = SocietyDetail::whereIn('colony_id', $colonies)->pluck('id');
         $societies_data = SocietyDetail::where('society_bill_level', '=', '2')->whereIn('colony_id', $colonies)->get();
         $building_data = MasterBuilding::whereIn('society_id', $societies)->get();

         $layoutId = decrypt($request->input('layout'));
         $wardId=decrypt($request->input('wards'));
         $colonyId=decrypt($request->input('colony'));
         $society_id = decrypt($request->input('society'));
         if(isset($colonyId)){
             $society_list = SocietyDetail::where('colony_id', $colonyId)->get();
         }
        if(isset($wardId)){
            $colony_list = MasterColony::where('ward_id', $wardId)->get();
        }
        if(isset($layoutId)){
            $ward_list = MasterWard::where('layout_id', $layoutId)->get();
        }
        if(isset($society_id)){
            $building_list = MasterBuilding::where('society_id', $society_id)->get();
        }



         $society_name = SocietyDetail::where('id', $society_id)->first()->society_name;
//        dd($society_id);
         if($request->input('building')) {
            $tenament = DB::table('master_tenant_type')->get();
            $buildingId=decrypt($request->input('building'));
            $building_name = MasterBuilding::where('id',$buildingId)->first()->name;
            $society_Id = MasterBuilding::where('id', '=', $buildingId)->first()->society_id;
            $columns = [
                ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
                ['data' => 'flat_no','name' => 'flat_no','title' => 'Flat No.'],
                ['data' => 'salutation','name' => 'salutation','title' => 'Salutation'],
                ['data' => 'first_name','name' => 'first_name','title' => 'First Name'],
                ['data' => 'last_name','name' => 'last_name','title' => 'Last Name'],
                ['data' => 'use','name' => 'use','title' => 'Use'],
                ['data' => 'carpet_area','name' => 'carpet_area','title' => 'Carpet Area'],
                ['data' => 'tenant_type','name' => 'tenant_type','title' => 'Tenant Type'],
                ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false]
            ];
            if ($datatables->getRequest()->ajax()) {

                $currentMonth = date('m');
                // if($currentMonth < 4) {
                //     if($currentMonth == 1) {
                //         $data['month'] = 12;
                //         $data['year'] = date('Y') -1;
                //     } else {
                //         $data['month'] = date('m') -1;
                //         $data['year'] = date('Y') -1;
                //     }
                // } else {
                //     $data['month'] = date('m');
                //     $data['year'] = date('Y');
                // }

                if($currentMonth < 4) {
                    if($currentMonth == 1) {
                        $data['month'] = 12;
                        $data['year'] = date('Y') -1;
                        $bill_year = date('Y') -1;
                    } else {
                        $data['month'] = date('m') -1;
                        $data['year'] = date('Y') -1;
                        $bill_year = date('Y');
                    }
                } else {
                    $data['month'] = date('m') - 1;
                    $data['year'] = date('Y');
                    $bill_year = date('Y');
                }

                DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
                $tenants = MasterTenant::with(['TransBillGenerate' => function($query) use($buildingId,$data,$bill_year){
                    $query->where('building_id',$buildingId)->where('bill_month', '=', $data['month'])->where('bill_year', '=', $bill_year);
                }])
                ->where('building_id', '=', decrypt($request->input('building')))
                ->selectRaw('@rownum  := @rownum  + 1 AS rownum,master_tenants.*');

                return $datatables->of($tenants)
                        ->editColumn('actions', function ($tenants) use($society_Id){
                            if(count($tenants->TransBillGenerate)<=0) {
                            return "<div class='d-flex btn-icon-list'>
                            <a href='".route('billing_calculations', ['tenant_id'=>encrypt($tenants->id),'building_id'=>encrypt($tenants->building_id),'society_id'=>encrypt($society_Id)])."' class='d-flex flex-column align-items-center ' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/view-billing-details-icon.svg')."'></span>View Billing Details</a>
                        
                            <a href='".route('generateTenantBill', ['tenant_id'=>encrypt($tenants->id),'building_id'=>encrypt($tenants->building_id),'society_id'=>encrypt($society_Id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/generate-bill-icon.svg')."'></span>Generate Bill</a>
        
                            <a href='".route('arrears_calculations', ['tenant_id'=>encrypt($tenants->id),'building_id'=>encrypt($tenants->building_id),'society_id'=>encrypt($society_Id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/view-arrears-calculation-icon.svg')."'></span>Arrear Calculation</a>
            
                            </div>";
                            } else {
                                return "<div class='d-flex btn-icon-list'>
                                <a href='".route('billing_calculations', ['tenant_id'=>encrypt($tenants->id),'building_id'=>encrypt($tenants->building_id),'society_id'=>encrypt($society_Id)])."' class='d-flex flex-column align-items-center ' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/view-billing-details-icon.svg')."'></span>View Billing Details</a>
                            
                                <a href='".route('generateTenantBill', ['tenant_id'=>encrypt($tenants->id),'building_id'=>encrypt($tenants->building_id),'society_id'=>encrypt($society_Id),'regenate'=>true])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--regenerate'><img src='".asset('/img/regenerate-bill-icon.svg')."'></span>Regenerate Bill</a>
            
                                <a href='".route('arrears_calculations', ['tenant_id'=>encrypt($tenants->id),'building_id'=>encrypt($tenants->building_id),'society_id'=>encrypt($society_Id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/view-arrears-calculation-icon.svg')."'></span>Arrear Calculation</a>
                
                                </div>"; 
                            }
                            
                        })               
                        ->rawColumns(['actions'])
                        ->make(true);
            }
            $html = $datatables->getHtmlBuilder()->columns($columns)->postAjax()->parameters($this->getParameters());
                    // return $buildings;


             if(isset($request->search)){
                 return view('admin.em_department.generate_bill_tenant_level',
                     compact('building_list','ward_list','colony_list','society_list','building_data','building_name','buildingId','layoutId','wardId','colonyId','layout_data','wards_data','colonies_data','societies_data','tenament','html', 'building_id', 'society_id'));


             }else{

                 $data = $request->all();
                 $result = $this->downloadTenantBills($data);
                    if(!$result){
//                        return view('admin.em_department.generate_bill_tenent_level_download',
//                            compact('building_list','ward_list','colony_list','society_list','building_data',
//                                'building_name','buildingId','layoutId','wardId','colonyId','layout_data',
//                                'wards_data','colonies_data','societies_data','tenament','html', 'building_id',
//                                'society_id'))->with('warning', 'No Billing Data is Available.');


                        return redirect()->back()->with('warning', 'No Billing Data is Available.');

                    }
             }

            } else {
            $columns = [
                ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
                ['data' => 'building_no','name' => 'building_no','title' => 'Building / Chawl Number'],
                ['data' => 'name','name' => 'name','title' => 'Building / Chawl Name'],
                ['data' => 'tenant_count','name' => 'tenant_count','title' => 'Tenant Count'],
                ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
            ];
            if ($datatables->getRequest()->ajax()) {
                DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));

                $currentMonth = date('m');
                // if($currentMonth < 4) {
                //     if($currentMonth == 1) {
                //         $data['month'] = 12;
                //         $data['year'] = date('Y') -1;
                //     } else {
                //         $data['month'] = date('m') -1;
                //         $data['year'] = date('Y') -1;
                //     }
                // } else {
                //     $data['month'] = date('m');
                //     $data['year'] = date('Y');
                // }

                if($currentMonth < 4) {
                    if($currentMonth == 1) {
                        $data['month'] = 12;
                        $data['year'] = date('Y') -1;
                        $bill_year = date('Y') -1;
                    } else {
                        $data['month'] = date('m') -1;
                        $data['year'] = date('Y') -1;
                        $bill_year = date('Y');
                    }
                } else {
                    $data['month'] = date('m') - 1;
                    $data['year'] = date('Y');
                    $bill_year = date('Y');
                }


                $buildings = MasterBuilding::with(['TransBillGenerate'=>function($query) use($society_id,$data,$bill_year){
                    $query->where('society_id', '=', $society_id)->where('bill_month', '=',$data['month'])->where('bill_year', '=', $bill_year);
                }])->with('tenant_count')->where('society_id', '=', decrypt($request->input('society')))
                ->selectRaw('@rownum  := @rownum  + 1 AS rownum,master_buildings.*');
                
                return $datatables->of($buildings)
                ->editColumn('tenant_count', function ($buildings){  
                   $value = $buildings->tenant_count->toArray(); 
                   if($value) {
                       foreach($value as $i) {
                         return $i['count'];
                       }
                    } else {
                        return 0;
                    }
                })
                ->editColumn('actions', function ($buildings){
                    if(count($buildings->TransBillGenerate)<=0) {
                        return "<div class='d-flex btn-icon-list'>
                        <a href='".route('generateBuildingBill', ['building_id'=>encrypt($buildings->id),'society_id'=>encrypt($buildings->society_id)])."' class='d-flex flex-column align-items-center ' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/view-billing-details-icon.svg')."'></span>Generate Bill</a>
                    
                        <a href='".route('billing_calculations', ['building_id'=>encrypt($buildings->id),'society_id'=>encrypt($buildings->society_id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/generate-bill-icon.svg')."'></span>View Billing Details</a>
    
                        <a href='".route('arrears_calculations', ['building_id'=>encrypt($buildings->id),'society_id'=>encrypt($buildings->society_id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--delete'><img src='".asset('/img/view-arrears-calculation-icon.svg')."'></span>View Arrear Calculation</a>
        
                    </div>";  
                    } else {
                            return "<div class='d-flex btn-icon-list'>
                            <a href='".route('generateBuildingBill', ['building_id'=>encrypt($buildings->id),'society_id'=>encrypt($buildings->society_id),'regenate'=> true])."' class='d-flex flex-column align-items-center ' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/regenerate-bill-icon.svg')."'></span>Regenerate Bill</a>
                        
                            <a href='".route('billing_calculations', ['building_id'=>encrypt($buildings->id),'society_id'=>encrypt($buildings->society_id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/generate-bill-icon.svg')."'></span>View Billing Details</a>

                            <a href='".route('arrears_calculations', ['building_id'=>encrypt($buildings->id),'society_id'=>encrypt($buildings->society_id)])."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--delete'><img src='".asset('/img/view-arrears-calculation-icon.svg')."'></span>View Arrear Calculation</a>
            
                        </div>";
                    }
                })               
                ->rawColumns(['actions'])
                ->make(true);           
            }

            $html = $datatables->getHtmlBuilder()->columns($columns)->postAjax()->parameters($this->getParameters());

//            dd(isset($request->download));
            if(isset($request->search)){
                return view('admin.em_department.generate_bill_tenant_level',
                    compact('building_list','ward_list','colony_list','society_list','building_data','layoutId','wardId','colonyId',
                        'layout_data','wards_data','colonies_data','societies_data',
                        'tenament','html', 'society_id','society_name','buildingId'));


            }else{
                $data = $request->all();
                $result = $this->downloadbuildingBills($data);
                if(!$result){
                    return redirect()->back()->with('warning', 'No Billing Data is Available.');

                }
            }
            }
    }

    /*
       * All Tenant Bill Generation
       * @ param    => $data_request.
       * @ Response => Downloads pdf.
       * Author: Prajakta Sisale
       */
    public function downloadTenantBills($data_request){

        $year = $data_request['year'];
        $month = $data_request['month'];
// t 228 b 211 s 209

        $building_id = decrypt($data_request['building']);
        $society_id = decrypt($data_request['society']);

        $pdf_data =array();

        $trans_bill_generate_data = TransBillGenerate::with(['tenant_detail','trans_payment', 'service_charges'])
            ->where('trans_bill_generate.society_id', $society_id)
            ->where('trans_bill_generate.building_id', $building_id)
            ->where('trans_bill_generate.bill_year', $year)
            ->where('trans_bill_generate.bill_month', $month)
            ->get()->toArray();

        if(!empty($trans_bill_generate_data)){
            foreach ($trans_bill_generate_data as $bill_data){

                $data['tenant'] = MasterTenant::where('building_id',$bill_data['building_id'])->where('id',$bill_data['tenant_id'])->first();

                if($bill_data['building_id'] != '' && '' != $bill_data['tenant_id']) {

                    $data['building'] = MasterBuilding::find($bill_data['building_id']);
                    $data['society'] = SocietyDetail::find($data['building']->society_id);
                    $data['tenant'] = MasterTenant::where('building_id',$bill_data['building_id'])->where('id',$bill_data['tenant_id'])->first();


                    $data['TransBillGenerate'] = TransBillGenerate::find($bill_data['id']);

                    $data['year'] = $year;

                    $data['month'] = $month;
                    if($month < 4 ) {
                        $data['year'] = date('Y') -1;
                    } else {
                        $data['year'] = date('Y');
                    }

                    if($data['month'] == 1) {
                        $lastBillMonth = 12;
                        $lastBillYear=$data['year']-1;
                    } else {
                        $lastBillMonth = $data['month']-1;
                        $lastBillYear=$data['year'];
                    }

                    $data['lastBill'] = TransBillGenerate::where('tenant_id', '=', $bill_data['tenant_id'])
                        ->where('bill_month', '=', $lastBillMonth)
                        ->where('bill_year', '=', $lastBillYear)
                        ->orderBy('id','DESC')
                        ->first();

                    $data['serviceChargesRate'] = ServiceChargesRate::selectRaw('Sum(water_charges) as water_charges,
                                    sum(electric_city_charge) as electric_city_charge,
                                    sum(pump_man_and_repair_charges) as  pump_man_and_repair_charges,
                                    sum(external_expender_charge) as external_expender_charge,
                                    sum(administrative_charge) as administrative_charge, 
                                    sum(lease_rent) as lease_rent,sum(na_assessment) as na_assessment, 
                                    sum(other) as other')
                        ->where('building_id',$bill_data['building_id'])
                        ->where('year',$data['year'])->first();

                    if(!$data['serviceChargesRate']){

                        return redirect()->back()->with('warning', 'Service charge Rates Not added into system.');
                    }

                    $data['arreasCalculation'] = ArrearCalculation::where('tenant_id',$bill_data['tenant_id'])->get();
                    $arrear_balance=$arrear_interest_balance=0;
                    if(count($data['arreasCalculation'])>0)
                    {
                        foreach($data['arreasCalculation'] as $arreasCalculation)
                        {
                            $arrear_balance+=($arreasCalculation->total_amount - $arreasCalculation->old_intrest_amount -
                                $arreasCalculation->difference_intrest_amount);
                            $arrear_interest_balance+=($arreasCalculation->old_intrest_amount +
                                $arreasCalculation->difference_intrest_amount);
                        }
                    }

                    $data['consumer_number'] = substr(sprintf('%08d', $data['building']->id),0,8).'|'.substr(sprintf('%08d', $data['tenant']->id),0,8);

                    $pdf_data[] = $data;

                }
            }

//            $fileName = 'tenants_bill.pdf';
//
//            $mpdf = new Mpdf();
//            $mpdf->autoScriptToLang = true;
//            $mpdf->autoLangToFont = true;
//            $contents = view('admin.em_department.download_all_tenant_bills', compact('pdf_data'));
//            $mpdf->WriteHTML($contents);
//            $mpdf->Output($fileName,'D');

            $fileName = 'tenants_bill.pdf';

            $mpdf = new Mpdf();
            $mpdf->autoScriptToLang = true;
            $mpdf->autoLangToFont = true;

            foreach ($pdf_data as $key => $bill_data) {
                $contents = view('admin.em_department.download_all_tenant_bills', compact('bill_data'));
                $mpdf->WriteHTML($contents);
                $mpdf->WriteHTML('<pagebreak>');
            }

            $mpdf->Output($fileName,'D');

        }else{
            return '';
        }
    }

    public function downloadbuildingBills($data_request){

        $year = $data_request['year'];
        $month = $data_request['month'];

        $society_id = decrypt($data_request['society']);

        $pdf_data =array();

        $trans_bill_generate_data = TransBillGenerate::with(['tenant_detail','trans_payment', 'service_charges'])
            ->where('trans_bill_generate.society_id', $society_id)
//            ->where('trans_bill_generate.building_id', $building_id)
            ->where('trans_bill_generate.bill_year', $year)
            ->where('trans_bill_generate.bill_month', $month)
            ->get()->toArray();


//        dd($trans_bill_generate_data);
        $pdf_data = array();

        if(!empty($trans_bill_generate_data)){
            foreach ($trans_bill_generate_data as $bill_data) {
                if($bill_data['building_id'] != '') {

                    $data['year'] = $year;

//                $bill_year = date('Y');

                    $data['month'] = $month;
                    if($month < 4 ) {
                        $data['year'] = date('Y') -1;
                    } else {
                        $data['year'] = date('Y');
                    }

                    $data['building'] = MasterBuilding::find($bill_data['building_id']);
                    $data['society'] = SocietyDetail::find($data['building']->society_id);
                    $data['serviceChargesRate'] = ServiceChargesRate::selectRaw('Sum(water_charges) as water_charges,
                sum(electric_city_charge) as electric_city_charge,
                sum(pump_man_and_repair_charges) as  pump_man_and_repair_charges,
                sum(external_expender_charge) as external_expender_charge,
                sum(administrative_charge) as administrative_charge, 
                sum(lease_rent) as lease_rent,sum(na_assessment) as na_assessment, 
                sum(other) as other')
                        ->where('building_id',$bill_data['building_id'])
                        ->where('year',$data['year'])->first();

                    //  dd($data['serviceChargesRate']);
                    if(!$data['serviceChargesRate']){
                        return redirect()->back()->with('warning', 'Service charge Rates Not added into system.');
                    }

                    $data['Tenant_bill_id'] = DB::table('building_tenant_bill_association')
                        ->where('building_id', '=', $bill_data['building_id'])
                        ->where('bill_month', '=',  $data['month'])
                        ->where('bill_year', '=', $data['year'])
                        ->orderBy('id','DESC')->first();

                    $bill_ids = '';
                    if($data['Tenant_bill_id']) {
                        $bill_ids = $data['Tenant_bill_id']->bill_id;
                    }
                    $data['TransBillGenerate'] = TransBillGenerate::selectRaw('sum(total_bill)as total_bill_temp,
                sum(arrear_bill) as arrear_bill_temp,
                sum(`total_service_after_due`) as `total_service_after_due_temp`,
                sum(`late_fee_charge`) as `late_fee_charge_temp`, 
                sum(`total_bill_after_due_date`) as `total_bill_after_due_date_temp`,
                sum(`balance_amount`) as `balance_amount_temp`, 
                sum(credit_amount) as credit_amount_temp,
                sum(monthly_bill) as monthly_bill_temp,trans_bill_generate.*')
                        ->whereIn('id',explode(',',$bill_ids))->first();

                    //  echo '<pre>';
                    // print_r($data['TransBillGenerate']);exit;

                    $data['arrear_ids'] = TransBillGenerate::whereIn('id',explode(',', $bill_ids))->pluck('arrear_id')->toArray();


                    $data['arrear_ids_temp'] = [];
                    if($data['arrear_ids']) {
                        foreach($data['arrear_ids'] as $arrear_id) {
                            if (strpos($arrear_id, ',') !== false) {
                                $explode_ids = explode(',', $arrear_id);
                                foreach($explode_ids as $id) {
                                    $data['arrear_ids_temp'][] = $id;
                                }
                            } else {
                                $data['arrear_ids_temp'][] = $arrear_id;
                            }
                        }
                    }
                    $data['arreasCalculation'] = ArrearCalculation::whereIn('id',$data['arrear_ids_temp'])->get();

                    $data['number_of_tenants'] = MasterBuilding::with('tenant_count')->where('id',$bill_data['building_id'])->first();
                    //dd($data['number_of_tenants']->tenant_count()->first());
                    if(!$data['number_of_tenants']->tenant_count()->first()) {
                        return redirect()->back()->with('warning', 'Number of Tenants Is zero.');
                    }


                    if($data['month'] == 1) {
                        $lastBillMonth = 12;
                        $lastBillYear=$data['year']-1;
                    } else {
                        $lastBillMonth = $data['month']-1;
                        $lastBillYear=$data['year'];
                    }
                    // dd($lastBillYear." ".$lastBillMonth);
                    $data['lastBill'] = TransBillGenerate::where('tenant_id', '=', $bill_data['tenant_id'])
                        ->where('bill_month', '=', $lastBillMonth)
                        ->where('bill_year', '=', $lastBillYear)
                        ->orderBy('id','DESC')
                        ->first();
                    //dd($data['lastBill']);
                    $data['consumer_number'] = substr(sprintf('%08d', $data['building']->society_id),0,8).'|'.substr(sprintf('%08d', $data['building']->id),0,8);

                    $pdf_data[] = $data;
                }

            }

//            $fileName = 'building_bills.pdf';
//
//            $mpdf = new Mpdf();
//            $mpdf->autoScriptToLang = true;
//            $mpdf->autoLangToFont = true;
//            $contents = view('admin.em_department.download_all_building_bills', compact('pdf_data'));
//            $mpdf->WriteHTML($contents);
//            $mpdf->Output($fileName,'D');

            $fileName = 'building_bills.pdf';

            $mpdf = new Mpdf();
            $mpdf->autoScriptToLang = true;
            $mpdf->autoLangToFont = true;

            foreach ($pdf_data as $key => $bill_data) {
                $contents = view('admin.em_department.download_all_building_bills', compact('bill_data'));
                $mpdf->WriteHTML($contents);
                $mpdf->WriteHTML('<pagebreak>');
            }

            $mpdf->Output($fileName,'D');

        }else{
            return '';
        }
    }

    public function update_soc_ward_colony(Request $request){

        $temp = array(       
            'id' => 'required',
            'wards' => 'required', 
            'colony' => 'required' 
        );

        $this->validate($request, $temp);
        
        $society = SocietyDetail::find($request->input('id'));
        $society->colony_id = $request->input('colony');
        $society->save();

        return redirect()->back()->with('success', 'Society Ward & Colony Details Updated Successfully.');
    }

    public function update_soc_bill_level(Request $request){
        //dd($request->all());
        $temp = array(       
        'id' => 'required',
        'soc_bill_level' => 'required',
        'conveyanced_type' => 'required_with:is_conveyanced,on',
        'lease_and_na_charges'=>'required_with:conveyanced_type,full'
        );
        // validate the Grievances form data.
        $this->validate($request, $temp);

        $society = SocietyDetail::find($request->input('id'));
        $society->society_bill_level = $request->input('soc_bill_level');
        $society->is_conveyanced = $request->input('is_conveyanced')?1:0;
        $society->conveyanced_type=$request->conveyanced_type;
        $society->lease_and_na_charges_in_per = $request->input('lease_and_na_charges')!=""?$request->input('lease_and_na_charges'):0.00;
        $society->save();

        return redirect()->back()->with('success', 'Society billing level Updated Successfully.');
    }
    
    public function add_building($id){
        return view('admin.em_department.add_building')->with('society_id', decrypt($id));
    }

    public function create_building(Request $request){
        //return $request->all();
         $temp = array(       
        'society_id' => 'required',
        'name' => 'required',
        'building_no' => 'required' 
        );
        // validate the Grievances form data.
        $this->validate($request, $temp);

        $building =  new MasterBuilding;
        $building->society_id = $request->input('society_id');
        $building->name = $request->input('name');
        $building->building_no = $request->input('building_no');
        $building->description = $request->input('name');
        $building->save();

        //return redirect()->back()->with('success', 'Building Added Successfully.');

        return redirect()->route('get_buildings', [encrypt($building->society_id)])->with('success', 'Building Added Successfully.');
    }

    public function edit_building($id){
        $building = MasterBuilding::where('id', '=', decrypt($id))->first();
        return view('admin.em_department.edit_building')->with('building', $building);
        //return $building;
    }

    public function update_building(Request $request){
       // return $request->all();
        $temp = array( 
        'id' => 'required',      
        'society_id' => 'required',
        'name' => 'required',
        'building_no' => 'required' 
        );
        // validate the Grievances form data.
        $this->validate($request, $temp);

        $building = MasterBuilding::find($request->input('id'));
        $building->society_id = $request->input('society_id');
        $building->name = $request->input('name');
        $building->building_no = $request->input('building_no');
        $building->description = $request->input('name');
        $building->save();

       // return redirect()->back()->with('success', 'Building Details Updated Successfully.');
        return redirect()->route('get_buildings', [encrypt($building->society_id)])->with('success', 'Building Details Updated Successfully.');
    }

    /*
    * Add Tenant 
    * @ param    => Building ID 
    * @ Response => Return View with Building ID.
    */
    public function add_tenant($id){
        $tenament = DB::table('master_tenant_type')->get();
        return view('admin.em_department.add_tenant')->with('building_id', $id)->with('tenament',$tenament);
    }

    /*
    * Add Tenant 
    * @ param    => Request Data. 
    * @ Response => Return Success Message.
    */
    public function create_tenant(Request $request){
        //return $request->all();
         $temp = array(       
        'building_id' => 'required',
        'flat_no' => 'required',
        'salutation' => 'required|alpha',
        'first_name' => 'required|alpha',
        'middle_name' => 'required|alpha',
        'last_name' => 'required|alpha',
        'mobile' => 'required|numeric|digits:10',
        'email_id' => 'required|email',
        'use' => 'required',
        'carpet_area' => 'required', 
        'tenant_type' => 'required'
        );
        // validate the Grievances form data.
        $this->validate($request, $temp);

        $tenant =  new MasterTenant;
        $tenant->building_id = $request->input('building_id');
        $tenant->flat_no = $request->input('flat_no');
        $tenant->salutation = $request->input('salutation');
        $tenant->first_name = $request->input('first_name');
        $tenant->middle_name = $request->input('middle_name');
        $tenant->last_name = $request->input('last_name');
        $tenant->mobile = $request->input('mobile');
        $tenant->email_id = $request->input('email_id');
        $tenant->use = $request->input('use');
        $tenant->carpet_area = $request->input('carpet_area');
        $tenant->tenant_type = $request->input('tenant_type');
        $tenant->save();

        //return redirect()->back()->with('success', 'Tenant Added Successfully.');
        return redirect()->route('get_tenants', [encrypt($tenant->building_id)])->with('success', 'Tenant Added Successfully.');
    }

    /*
    * Edit Tenant 
    * @ param    => Request id. 
    * @ Response => Return view with tenant details.
    */
    public function edit_tenant($id){
        $tenant = MasterTenant::where('id', '=', decrypt($id))->first();
         $tenament = DB::table('master_tenant_type')->get();
        return view('admin.em_department.edit_tenant')->with('tenant', $tenant)->with('tenament',$tenament);
        //return $building;
    }

    /*
    * Update Tenant 
    * @ param    => Request Data. 
    * @ Response => Return view with Success Message.
    */
    public function update_tenant(Request $request){
       // return $request->all();
        $temp = array(       
        'id' => 'required',
        'building_id' => 'required',
        'flat_no' => 'required',
        'salutation' => 'required|alpha',
        'first_name' => 'required|alpha',
        'middle_name' => 'required|alpha',
        'last_name' => 'required|alpha',
        'mobile' => 'required|numeric|digits:10',
        'email_id' => 'required|email',
        'use' => 'required',
        'carpet_area' => 'required', 
        'tenant_type' => 'required'
        );
        // validate the Grievances form data.
        $this->validate($request, $temp);

        $tenant = MasterTenant::find($request->input('id'));
        $tenant->building_id = $request->input('building_id');
        $tenant->flat_no = $request->input('flat_no');
        $tenant->salutation = $request->input('salutation');
        $tenant->first_name = $request->input('first_name');
        $tenant->middle_name = $request->input('middle_name');
        $tenant->last_name = $request->input('last_name');
        $tenant->mobile = $request->input('mobile');
        $tenant->email_id = $request->input('email_id');
        $tenant->use = $request->input('use');
        $tenant->carpet_area = $request->input('carpet_area');
        $tenant->tenant_type = $request->input('tenant_type');
        $tenant->save();

        //return redirect()->back()->with('success', 'Tenant Added Successfully.');
        return redirect()->route('get_tenants', [encrypt($tenant->building_id)])->with('success', 'Tenant Updated Successfully.');
    }

    /*
     * Edit Tenant
     * @ param    => Request id.
     * @ Response => Return view with tenant details.
     */
    public function changeTenants($id){
        $tenant = MasterTenant::where('id', '=', decrypt($id))->first();
        $tenament = DB::table('master_tenant_type')->get();

        $tenant_log = TenantsLogDetails::with('MasterBuilding','tenanttype')->where('tenant_primary_id',decrypt($id))->get()->toArray();

        return view('admin.em_department.change_tenant')->with('tenant', $tenant)->with('tenament',$tenament)->with('tenant_log',$tenant_log);
    }

    /*
    * Update Tenant
    * @ param    => Request Data.
    * @ Response => Return view with Success Message.
    */
    public function save_changed_tenants(Request $request){
        // return $request->all();
        $temp1 = array(
            'id' => 'required',
            'tenant_primary_id' => 'required',
            'tenant_building_id' => 'required',
            'tenant_flat_no' => 'required',
            'tenant_salutation' => 'required|alpha',
            'tenant_first_name' => 'required|alpha',
            'tenant_middle_name' => 'required|alpha',
            'tenant_last_name' => 'required|alpha',
            'tenant_mobile' => 'required|numeric|digits:10',
            'tenant_email_id' => 'required|email',
            'tenant_use' => 'required',
            'tenant_carpet_area' => 'required',
            'tenant_tenant_type' => 'required'
        );
        // validate the Grievances form data.
        $this->validate($request, $temp1);

        $tenantLog = new TenantsLogDetails();

        if($request->input('tenant_primary_id') != $request->input('id') ||
            ($request->input('tenant_building_id') != $request->input('building_id')) ||
            ($request->input('tenant_flat_no') != $request->input('flat_no')) ||
            ($request->input('tenant_salutation') != $request->input('salutation')) ||
            ($request->input('tenant_first_name') != $request->input('first_name')) ||
            ($request->input('tenant_middle_name') != $request->input('middle_name')) ||
            ($request->input('tenant_last_name') != $request->input('last_name')) ||
            ($request->input('tenant_mobile') != $request->input('mobile')) ||
            ($request->input('tenant_email_id') != $request->input('email_id')) ||
            ($request->input('tenant_use') != $request->input('use')) ||
            ($request->input('tenant_carpet_area') != $request->input('carpet_area')) ||
            ($request->input('tenant_tenant_type') != $request->input('tenant_type')) )
        {
            $tenantLog->tenant_primary_id = $request->input('tenant_primary_id');
            $tenantLog->building_id = $request->input('tenant_building_id');
            $tenantLog->flat_no = $request->input('tenant_flat_no');
            $tenantLog->salutation = $request->input('tenant_salutation');
            $tenantLog->first_name = $request->input('tenant_first_name');
            $tenantLog->middle_name = $request->input('tenant_middle_name');
            $tenantLog->last_name = $request->input('tenant_last_name');
            $tenantLog->mobile = $request->input('tenant_mobile');
            $tenantLog->email_id = $request->input('tenant_email_id');
            $tenantLog->use = $request->input('tenant_use');
            $tenantLog->carpet_area = $request->input('tenant_carpet_area');
            $tenantLog->tenant_type = $request->input('tenant_tenant_type');
            $tenantLog->save();
        }

        $result = $this->update_tenant($request);

        if($result){
            return redirect()->route('get_tenants', [encrypt($request->input('building_id'))])->with('success', 'Tenant Updated Successfully.');
        }
    }



    public function delete_tenant($id){
        $tenant = MasterTenant::find(decrypt($id));
        $tenant->delete();
        return redirect()->back()->with('success', 'Tenant Removed Successfully.');
    }

    public function generate_soc_bill(Request $request){
        // return $id;
        $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
        $layout_data = MasterLayout::whereIn('id', $layouts)->get();
       // dd($layout_data);
        $wards = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
        $wards_data = MasterWard::whereIn('layout_id', $layouts)->get();

        //dd($wards);
        $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');

        $colonies_data = MasterColony::whereIn('ward_id', $wards)->get();

        //dd($colonies);
        $societies_data = SocietyDetail::where('society_bill_level', '=', '1')->whereIn('colony_id', $colonies)->get();

        //return $rate_card;
        return view('admin.em_department.generate_bill', compact('layout_data', 'wards_data', 'colonies_data','societies_data'));

    }

    public function generate_tenant_bill(Request $request){
            // return $id;
        $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
        $layout_data = MasterLayout::whereIn('id', $layouts)->get();
       // dd($layout_data);
        $wards = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
        $wards_data = MasterWard::whereIn('layout_id', $layouts)->get();

        //dd($wards);
        $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');

        $colonies_data = MasterColony::whereIn('ward_id', $wards)->get();

        //dd($colonies);
        $societies = SocietyDetail::whereIn('colony_id', $colonies)->pluck('id');
        $societies_data = SocietyDetail::/*where('society_bill_level', '=', '2')->*/whereIn('colony_id', $colonies)->get();

        $building_data = MasterBuilding::whereIn('society_id', $societies)->get();
        $html='';
        $society_id = 0;
        $layoutId = 0;
        $wardId= 0;
        $colonyId=0;
        $buildingId=0;
        //return $rate_card;
        return view('admin.em_department.generate_bill_tenant_level', compact('buildingId','colonyId','wardId','layoutId','society_id','html','layout_data', 'wards_data', 'colonies_data','societies_data', 'building_data'));

    }

    public function generate_tenant_bill_download(Request $request){
        // return $id;
        $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
        $layout_data = MasterLayout::whereIn('id', $layouts)->get();
        // dd($layout_data);
        $wards = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
        $wards_data = MasterWard::whereIn('layout_id', $layouts)->get();

        //dd($wards);
        $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');

        $colonies_data = MasterColony::whereIn('ward_id', $wards)->get();

        //dd($colonies);
        $societies = SocietyDetail::whereIn('colony_id', $colonies)->pluck('id');
        $societies_data = SocietyDetail::/*where('society_bill_level', '=', '2')->*/whereIn('colony_id', $colonies)->get();

        $building_data = MasterBuilding::whereIn('society_id', $societies)->get();
        $html='';
        $society_id = 0;
        $layoutId = 0;
        $wardId= 0;
        $colonyId=0;
        $buildingId=0;
        //return $rate_card;generate_bill_tenent_level_download
        return view('admin.em_department.generate_bill_tenent_level_download', compact('buildingId','colonyId','wardId','layoutId','society_id','html','layout_data', 'wards_data', 'colonies_data','societies_data', 'building_data'));

    }


    public function generateBuildingBill(Request $request) {
        
        if($request->has('building_id') && '' != $request->building_id) {

            $request->building_id = decrypt($request->building_id);
            $request->society_id  = decrypt($request->society_id);            
            //dd($request->building_id." ".$request->society_id);
            $data['building'] = MasterBuilding::find($request->building_id);
            $data['society'] = SocietyDetail::find($data['building']->society_id);

            $currentMonth = date('m');
            if($currentMonth < 4) {
                $year = date('Y') -1;
            } else {
                $year = date('Y');
            }

            $data['serviceChargesRate'] = ServiceChargesRate::selectRaw('Sum(water_charges) as water_charges,sum(electric_city_charge) as electric_city_charge,sum(pump_man_and_repair_charges) as  pump_man_and_repair_charges,sum(external_expender_charge) as external_expender_charge,sum(administrative_charge) as administrative_charge, sum(lease_rent) as lease_rent,sum(property_tax) as property_tax,sum(na_assessment) as na_assessment, sum(other) as other')->where('building_id',$request->building_id)->where('year',$year)->first();

           //dd($data['serviceChargesRate']); 
            if(!$data['serviceChargesRate']){
                return redirect()->back()->with('warning', 'Service charge Rates Not added into system.');
            }

            $start    = new \DateTime($year.'-4-01');
            $start->modify('first day of this month');
            $end      = new \DateTime(date('Y').'-'.date('m').'-06');
            $end->modify('first day of next month');
            $interval = \DateInterval::createFromDateString('1 month');
            $period   = new \DatePeriod($start, $interval, $end);

            $months = [];
            $years = [];
            foreach ($period as $dt) {
                $years[$dt->format("Y")] = $dt->format("Y");
                $months[$dt->format("n")] = $dt->format("n");
                // echo $dt->format("Y-m") . "<br>\n";
            }
            unset($months[count($months)-1]);
            $data['arrear_data']=ArrearsChargesRate::where(['society_id'=>$data['building']->society_id,'building_id'=>$request->building_id])->first();
            //$data['arreasCalculation'] = ArrearCalculation::where('building_id',$request->building_id)->where('payment_status','0')->whereIn('year',$years)->whereIn('month',$months)->orderby('year','month')->get();
            $data['arreasCalculation'] = ArrearCalculation::where('building_id',$request->building_id)->where('payment_status','0')->orderby('year','month')->get();            
            //dd($data['arreasCalculation']);
                
            $data['number_of_tenants'] = MasterBuilding::with('tenant_count')->where('id',$request->building_id)->first();
             //dd($data['number_of_tenants']->tenant_count()->first());
            if(!$data['number_of_tenants']->tenant_count()->first()) {
                return redirect()->back()->with('warning', 'Number of Tenants Is zero.');
            }

            $currentMonth = date('m');
            // if($currentMonth < 4) {
            //     if($currentMonth == 1) {
            //         $data['month'] = 12;
            //         $data['year'] = date('Y') -1;
            //     } else {
            //         $data['month'] = date('m') -1;
            //         $data['year'] = date('Y') -1;
            //     }
            // } else {
            //     $data['month'] = date('m');
            //     $data['year'] = date('Y');
            // }


            if($currentMonth < 4) {
                if($currentMonth == 1) {
                    $data['month'] = 12;
                    $data['year'] = date('Y') -1;
                    $data['bill_year'] = date('Y') -1;
                } else {
                    $data['month'] = date('m') -1;
                    $data['year'] = date('Y') -1;
                    $data['bill_year'] = date('Y');
                }
            } else {
                $data['month'] = date('m') - 1;
                $data['year'] = date('Y');
                $data['bill_year'] = date('Y');
            }

            $data['consumer_number'] = substr(sprintf('%08d', $data['building']->society_id),0,8).'|'.substr(sprintf('%08d', $data['building']->id),0,8);

            $data['check'] = TransBillGenerate::where('building_id', '=', $request->building_id)
                                ->where('society_id', '=', $request->society_id)
                                ->where('bill_month', '=', $data['month'])
                                ->where('bill_year', '=',$data['bill_year'])
                                ->first();
            //dd($data['check']);
            $data['regenate'] = false;                    
            if($request->has('regenate') && true == $request->regenate) {
                $data['regenate'] = true;
            }

            if($data['month'] == 1) {
                $lastBillMonth = 12;
            } else {
                $lastBillMonth = $data['month']-1;
            }
            $data['lastBill'] = TransBillGenerate::where('building_id', '=', $request->building_id)
                                    ->where('bill_month', '=', $lastBillMonth)
                                    ->where('bill_year', '=',$data['bill_year'])
                                    ->orderBy('id','DESC')
                                    ->get();
//                                     echo '<pre>';
//  print_r($data['lastBill']);exit;                                    
            return view('admin.em_department.generate_building_bill',$data);

        }
    }

    public function generateTenantBill(Request $request) {
        // print_r($request->all());exit;
        if($request->has('building_id') && '' != $request->building_id && $request->has('tenant_id') && '' != $request->tenant_id) {
            $request->building_id = decrypt($request->building_id);
            $request->tenant_id  = decrypt($request->tenant_id);

            $data['building'] = MasterBuilding::find($request->building_id);
            $data['society'] = SocietyDetail::find($data['building']->society_id);
            $data['tenant'] = MasterTenant::where('building_id',$data['building']->id)->where('id',$request->tenant_id)->first();

            $currentMonth = date('m');
            if($currentMonth < 4) {
                $year = date('Y') -1;
            } else {
                $year = date('Y');
            }
            $data['serviceChargesRate'] = ServiceChargesRate::selectRaw('Sum(water_charges) as water_charges,sum(electric_city_charge) as electric_city_charge,sum(pump_man_and_repair_charges) as  pump_man_and_repair_charges,sum(external_expender_charge) as external_expender_charge,sum(administrative_charge) as administrative_charge, sum(lease_rent) as lease_rent,sum(property_tax) as property_tax,sum(na_assessment) as na_assessment, sum(other) as other')->where('building_id',$request->building_id)->where('year',$year )->first();

            if(!$data['serviceChargesRate']){
                //dd($data);
                return redirect()->back()->with('warning', 'Service charge Rates Not added into system.');
            }
            $realMonth = date('m');
            if($realMonth == 1) {
                $realMonth = 12;
            } else {
                $realMonth = $realMonth - 1;
            }
            //dd($request->tenant_id);
            //dd($realMonth." ".$request->tenant_id);
            //dd($realMonth);
            //$data['arreasCalculation'] = ArrearCalculation::where('tenant_id',$request->tenant_id)->where('month',$realMonth)->where('payment_status','0')->get();
            $data['arreasCalculation'] = ArrearCalculation::where('tenant_id',$request->tenant_id)
            ->where(function($q){
                $q->where('payment_status', 0)
                  ->orWhere('payment_status', NULL);
            })->get();
            //->where('payment_status','0')->get();
            //dd($data['arreasCalculation']);
            $currentMonth = date('m');
            if($currentMonth < 4) {
                if($currentMonth == 1) {
                    $data['month'] = 12;
                    $data['year'] = date('Y') -1;
                } else {
                    $data['month'] = date('m') -1;
                    $data['year'] = date('Y') -1;
                }
            } else {
                $data['month'] = date('m') - 1;//changed by prajakta
                $data['year'] = date('Y');
            }
            $data['consumer_number'] = substr(sprintf('%08d', $data['building']->id),0,8).'|'.substr(sprintf('%08d', $data['tenant']->id),0,8);

            $data['check'] = TransBillGenerate::where('tenant_id', '=', $request->tenant_id)
                                    ->where('bill_month', '=', $data['month'])
                                    ->where('bill_year', '=', $data['year'])
                                    ->first();
            $data['arrear_data']=ArrearsChargesRate::where(['society_id'=>$data['building']->society_id,'building_id'=>$request->building_id])->first();
            // dd($arrear_data);
            $data['regenate'] = false;  
            
            if($data['month'] == 1) {
                $lastBillMonth = 12;
            } else {
                $lastBillMonth = $data['month']-1;
            }
            $data['lastBill'] = TransBillGenerate::where('tenant_id', '=', $request->tenant_id)
                                    ->where('bill_month', '=', $lastBillMonth)
                                    ->where('bill_year', '=', $data['year'])
                                    ->orderBy('id','DESC')
                                    ->first();
            
            if($request->has('regenate') && true == $request->regenate || !empty($data['check'])) {

                $data['regenate'] = true;
            }
            $data['transPayment'] = TransPayment::where('tenant_id', '=', $request->tenant_id)->where('building_id', '=', $request->building_id)->orderBy('id','DESC')->first();

            // print_r($data['transPayment']);exit;
            
            return view('admin.em_department.generate_tenant_bill',$data);
        }
    }

    public function create_tenant_bill(Request $request){
       //dd($request->all());
            if($request->arrear_id && (count($request->arrear_id) > 0)){
                $arrear_id = implode(",",$request->arrear_id);
                //dd($arrear_id);
            } else {
                $arrear_id = '';
            }
            $check = '';
            if($request->has('regenate') && false == $request->regenate) {

                $check = TransBillGenerate::where('tenant_id', '=', $request->tenant_id)
                                    ->where('bill_month', '=', $request->bill_month)
                                    ->where('bill_year', '=', $request->bill_year)
                                    ->orderBy('id','DESC')
                                    ->first();
            }
            //dd($check);
            $serviceChargesRate = ServiceChargesRate::selectRaw('Sum(water_charges) as water_charges,sum(electric_city_charge) as electric_city_charge,sum(pump_man_and_repair_charges) as  pump_man_and_repair_charges,sum(external_expender_charge) as external_expender_charge,sum(administrative_charge) as administrative_charge, sum(lease_rent) as lease_rent,sum(na_assessment) as na_assessment,sum(property_tax) as property_tax, sum(other) as other')->where('building_id',$request->building_id)->where('year',$request->bill_year)->first();
            $arreasCalculations = ArrearCalculation::where('tenant_id',$request->tenant_id)->where('payment_status','0')->get();
            $arrear_balance=$arrear_interest_balance=0;
            if(count($arreasCalculations)>0)
            {
                foreach($arreasCalculations as $arreasCalculation)
                {
                    $arrear_balance+=($arreasCalculation->total_amount - $arreasCalculation->old_intrest_amount -
                                $arreasCalculation->difference_intrest_amount);
                    $arrear_interest_balance+=($arreasCalculation->old_intrest_amount +
                        $arreasCalculation->difference_intrest_amount);
                }
            }
           // dd($arrear_balance." ".$arrear_interest_balance);
        if(is_null($check) || $check == ''){
           // dd('ok');
            $bill = new TransBillGenerate;
            $bill->tenant_id = $request->tenant_id;
            $bill->building_id = $request->building_id;
            $bill->society_id = $request->society_id;
            $bill->bill_from = $request->bill_from;
            $bill->bill_to = $request->bill_to;
            $bill->bill_month = $request->bill_month;
            $bill->bill_year = $request->bill_year;
            if($request->no_of_tenant)
            {
                $bill->monthly_bill = $request->monthly_bill / $request->no_of_tenant;
            }else {
                $bill->monthly_bill = $request->monthly_bill;
            }
            $bill->service_charge_balance=$request->monthly_bill;
            $bill->arrear_balance=$arrear_balance;
            $bill->arrear_interest_balance=$arrear_interest_balance;
            $bill->prev_arrear_balance=$arrear_balance;
            $bill->prev_arrear_interest_balance=$arrear_interest_balance;
            $bill->arrear_bill = $request->arrear_bill;
            $bill->arrear_id = $arrear_id;
            $bill->total_bill = $request->total_bill;
            $bill->bill_date = date('04-m-Y');
            $bill->due_date = $request->due_date;
            $bill->consumer_number = $request->consumer_number;
            $bill->total_service_after_due = $request->total_service_after_due;
            $bill->late_fee_charge = $request->late_fee_charge;
            $bill->total_bill_after_due_date = ceil($request->total_bill + $request->late_fee_charge);

            
            // $transPayment = TransPayment::where('bill_no',$check->id)->where('tenant_id',$request->tenant_id)->where('building_id',$request->building_id)->where('society_id',$request->society_id)->orderBy('id','DESC')->first();

            $lastBillMonth = $request->bill_month;
            $lastBillYear = $request->bill_year;

            if($request->bill_month ==1) {
                $lastBillMonth = 12;
                $lastBillYear = $request->bill_year -1;
            } else {
                $lastBillMonth = $request->bill_month -1;
            }
            $lastBillGenerated = TransBillGenerate::orderBy('id','DESC')->first();
            if($lastBillGenerated && !empty($lastBillGenerated->bill_number)) {
                $lastGeneratedNumber = substr($lastBillGenerated->bill_number,-7);
                $increNumber = (int)$lastGeneratedNumber+1;
                $bill->bill_number = $request->tenant_id.str_pad($increNumber, 7, "0", STR_PAD_LEFT);
            } else {
                $bill->bill_number = $request->tenant_id.'0000001';
            }

            $bill->status = 'Generated';

            $lastBill = TransBillGenerate::where('tenant_id', '=', $request->tenant_id)
                                    ->where('bill_month', '=', $lastBillMonth)
                                    ->where('bill_year', '=', $lastBillYear)
                                    ->orderBy('id','DESC')
                                    ->first();
            
            if($lastBill)
            {
                $bill->arrear_balance=$lastBill->arrear_balance;
                $bill->arrear_interest_balance=$lastBill->arrear_interest_balance;
                if($lastBill->credit_amount>0)
                {
                    $bill->prev_credit=$lastBill->credit_amount;
                    if($lastBill->credit_amount>=$bill->monthly_bill)
                    {
                        $lastBill->credit_amount=$lastBill->credit_amount-$bill->monthly_bill;
                        $bill->service_charge_balance = 0;
                        if($lastBill->credit_amount>0)
                        {
                            if($lastBill->credit_amount>=$bill->arrear_balance)
                            {
                                $lastBill->credit_amount= $lastBill->credit_amount-$bill->arrear_balance;
                                $bill->arrear_balance=0;
                                if($lastBill->credit_amount>=$lastBill->arrear_interest_balance)
                                {
                                    $lastBill->credit_amount= $lastBill->credit_amount-$bill->arrear_interest_balance;
                                    $bill->credit_amount=$lastBill->credit_amount;
                                }else
                                {
                                    $bill->arrear_interest_balance=$bill->arrear_interest_balance-$lastBill->credit_amount;
                                    $bill->credit_amount=0;
                                }
                               
                            }else
                            {
                                $bill->arrear_balance=$bill->arrear_balance-$lastBill->credit_amount;
                                $bill->credit_amount=0;
                            }
                        }
                    }else
                    {
                        $bill->service_charge_balance=$bill->service_charge_balance-$lastBill->credit_amount;
                        $bill->credit_amount= 0;
                    }
                    $bill->balance_amount=$bill->arrear_balance+$bill->service_charge_balance;
                }else
                {
                    $bill->credit_amount= 0;
                }

                //for balance amounty
                if($lastBill->balance_amount>0)
                {
                    $bill->prev_service_charge_balance=0;
                    $bill->prev_arrear_balance=0;
                    $bill->prev_arrear_interest_balance=0;
                    if($lastBill->service_charge_balance>0)
                    {
                        $lastBill->service_charge_balance=$lastBill->service_charge_balance+($lastBill->service_charge_balance*0.015);
                        $bill->prev_service_charge_balance=$lastBill->service_charge_balance;
                        
                    }
                    
                    $bill->service_charge_balance=$bill->service_charge_balance+$lastBill->service_charge_balance;
                    
                    if($lastBill->arrear_balance>0)
                    {
                        //dd($lastBill);
                        $arrear_interest=0;
                        $arrear_data=ArrearsChargesRate::where(['society_id'=>$lastBill->society_id,'building_id'=>$lastBill->building_id])->first();
                        //dd($arrer_data);
                        if($arrear_data)
                            {
                                $arrear_interest=($arrear_data->old_rate*($arrear_data->interest_on_old_rate/100))+(($arrear_data->revise_rate-$arrear_data->old_rate)*($arrear_data->interest_on_differance/100));
                            }
                        $lastBill->arrear_balance=$lastBill->arrear_balance;
                        $lastBill->arrear_interest_balance=$lastBill->arrear_interest_balance+$arrear_interest;
                        //dd($lastBill->arrear_balance);
                        $bill->prev_arrear_balance=$lastBill->arrear_balance;
                        $bill->prev_arrear_interest_balance=$lastBill->arrear_interest_balance;
                    }
                    $bill->arrear_balance=$lastBill->arrear_balance;
                    $bill->arrear_interest_balance=$lastBill->arrear_interest_balance;
                    
                }
                
                $bill->balance_amount=ceil($bill->arrear_balance+$bill->arrear_interest_balance+$bill->service_charge_balance);
                
                $bill->total_bill=ceil($bill->arrear_balance+$bill->arrear_interest_balance+$bill->service_charge_balance);
                
            }else
            {
                $bill->balance_amount = ceil($bill->total_bill);
                $bill->credit_amount= 0;    
            }
            // if($lastBill)
            // {
            //     if($lastBill->credit_amount>0)
            //     {
            //         $bill->prev_credit=$lastBill->credit_amount;
            //         if($lastBill->credit_amount>=$bill->monthly_bill)
            //         {
            //             $lastBill->credit_amount=$lastBill->credit_amount-$bill->monthly_bill;
            //             $bill->service_charge_balance = 0;
            //             if($lastBill->credit_amount>0)
            //             {
            //                 if($lastBill->credit_amount>=$bill->arrear_bill)
            //                 {
            //                     $lastBill->credit_amount= $lastBill->credit_amount-$bill->arrear_bill;
            //                     $bill->arrear_balance=0;
            //                 }else
            //                 {
            //                     $bill->arrear_balance=$bill->arrear_balance-$lastBill->credit_amount;
            //                 }
            //             }else
            //             {
            //                 $bill->credit_amount=0;
            //             }
            //         }else
            //         {
            //             $bill->service_charge_balance=$bill->service_charge_balance-$lastBill->credit_amount;
            //             $bill->credit_amount=0;
            //         }
            //         $bill->balance_amount=$bill->arrear_balance+$bill->service_charge_balance;
            //     }else
            //     {
            //         $bill->credit_amount=0;
            //     }
            //     if($lastBill->balance_amount>0)
            //     {
            //         $bill->prev_service_charge_balance=0;
            //         $bill->prev_arrear_balance=0;
            //         if($lastBill->service_charge_balance>0)
            //         {
            //             $lastBill->service_charge_balance=$lastBill->service_charge_balance+($lastBill->service_charge_balance*0.015);
            //             $bill->prev_service_charge_balance=$lastBill->service_charge_balance;
            //         }
                    
            //         $bill->service_charge_balance=$bill->service_charge_balance+$lastBill->service_charge_balance;
            //         if($lastBill->arrear_balance>0)
            //         {
            //             $lastBill->arrear_balance=$lastBill->arrear_balance+($lastBill->arrear_balance*0.015);
            //             $bill->prev_arrear_balance=$lastBill->arrear_balance;
            //         }
            //         $bill->arrear_balance=$bill->arrear_balance+$lastBill->arrear_balance;
            //     }
            //     $bill->balance_amount=$bill->arrear_balance+$bill->service_charge_balance;
            //     $bill->total_bill=$bill->balance_amount;
            // }else
            // {
            //     $bill->balance_amount = round($request->total_bill,2);
            //     $bill->credit_amount= 0;    
            // }
            // if(!empty($transPayment)) {
                
            //     $bill->balance_amount = $transPayment->balance_amount + $request->total_bill;    
            // }
            //dd($bill);
            $bill->save();
            if($bill)
            {
                $this->insertServiceChrargeForBill($bill->id,$serviceChargesRate);
            }

            return redirect()->back()->with('success', 'Bill Generated Successfully.')->with('regenate',false);
        } else {
            $message = ' Bill Already Generated on '.$check->bill_date; 
            return redirect()->back()->with('warning', $message);
        }
    }

    public function create_society_bill(Request $request){
//        dd($request->all());
        $check = '';
        if($request->has('regenate') && $request->regenate) {
           // dd('ok');
        $check = TransBillGenerate::where('building_id', '=', $request->building_id)
            ->where('society_id', '=', $request->society_id)
            ->where('bill_month', '=', $request->bill_month)
            ->where('bill_year', '=', $request->bill_year)
            ->first();
        }

        //dump($request->bill_month." ".$request->bill_year);

        $society = SocietyDetail::where('id',$request->society_id)->first();

        if(($society->is_conveyanced == 1) && ($society->conveyanced_type == 'Full')){
            $interest_charge = ((float)$society->lease_and_na_charges_in_per / 12);
        }else{
            $interest_charge = 0.015;
        }

        if(is_null($check) || $check == ''){
            
            $tenants = MasterTenant::where('building_id',$request->building_id)->get();
            //dump($tenants);
            //$request->monthly_bill = $request->monthly_bill / $request->no_of_tenant;
            //$last_bill_balance=0;
            $currentMonth = date('m');
            if($currentMonth < 4) {
                $year = date('Y') -1;
            } else {
                $year = date('Y');
            }
            //dump($currentMonth." ".$year);
            
            $start    = new \DateTime($year.'-4-01');
            //dump($start);
            $start->modify('first day of this month');
            $end      = new \DateTime(date('Y').'-'.date('m').'-06');
            //dump($end);
            $end->modify('first day of next month');
            $interval = \DateInterval::createFromDateString('1 month');
            $period   = new \DatePeriod($start, $interval, $end);
            
            $months = [];
            $years = [];
            foreach ($period as $dt) {
                $years[$dt->format("Y")] = $dt->format("Y");
                $months[$dt->format("n")] = $dt->format("n");
                // echo $dt->format("Y-m") . "<br>\n";
            }

            unset($months[count($months)-1]);
           // dd($tenants);
            if($tenants){
               // foreach($tenants as $row => $key){
                    $lastBillMonth = $request->bill_month;
                    $lastBillYear = $request->bill_year;
                    if($request->bill_month ==1) {
                        $lastBillMonth = 12;
                        $lastBillYear = $request->bill_year -1;
                    } else {
                        $lastBillMonth = $request->bill_month -1;
                    }
                    //dd($lastBillMonth."=>>>>".$lastBillYear);
                    $serviceChargesRate = ServiceChargesRate::selectRaw('Sum(water_charges) as water_charges,sum(electric_city_charge) as electric_city_charge,sum(pump_man_and_repair_charges) as  pump_man_and_repair_charges,sum(external_expender_charge) as external_expender_charge,sum(administrative_charge) as administrative_charge, sum(lease_rent) as lease_rent,sum(na_assessment) as na_assessment,sum(property_tax) as property_tax, sum(other) as other')->where('building_id',$request->building_id)->where('year',$request->bill_year)->first();
                    $lastBill = TransBillGenerate::where('building_id', '=', $request->building_id)
                                    ->where('bill_month', '=', $lastBillMonth)
                                    ->where('bill_year', '=', $lastBillYear)
                                    ->orderBy('id','DESC')
                                    ->first();
                    //$consumer_number = 'BL-'.substr(sprintf('%08d', $request->building_id),0,8).'|'.substr(sprintf('%08d', $key->id),0,8);
                    $consumer_number = 'BL-'.substr(sprintf('%08d', $request->building_id),0,8);    
                    $arrear_bill = 0;
                    $total_bill = 0;
                    $arrear_id = '';
                    $monthly_bill=0;
                    $arrearID = [];
                    $arrear_balance=$arrear_interest_balance=0;                
                    if($lastBill==null)
                    {
                        //$arreasCalculation = ArrearCalculation::where('building_id',$request->building_id)->where('payment_status','0')->whereIn('year',$years)->whereIn('month',$months)->get();
                        $arreasCalculation = ArrearCalculation::where('building_id',$request->building_id)->where('payment_status','0')->get();                        
                        if(!$arreasCalculation->isEmpty()){ 
                            foreach($arreasCalculation as $calculation){
                            $arrear_bill = $arrear_bill + $calculation->total_amount;
                            $arrearID[] = $calculation->id; 
                            }
                            $arrear_id = implode(",",$arrearID);                      
                        }
                        if(!$arreasCalculation->isEmpty())
                        {
                            foreach($arreasCalculation as $arreasCalculations)
                            {
                                $arrear_balance+=($arreasCalculations->total_amount - $arreasCalculations->old_intrest_amount -
                                            $arreasCalculations->difference_intrest_amount);
                                $arrear_interest_balance+=($arreasCalculations->old_intrest_amount +
                                    $arreasCalculations->difference_intrest_amount);
                            }
                        }
                    }
                    //dd($arreasCalculation);
                   
                    
                    

                    //dd($arrear_balance);
                    $monthly_bill=$request->monthly_bill;
                    $total_bill  = $monthly_bill + $arrear_bill;
                    $total_after_due = $request->monthly_bill * 0.015; 
                    //dd($total_after_due);
                    $total_service_after_due = $total_bill + $total_after_due;

//                $date = date('Y-m-04');
//
//                dd($date);
                        $data =  [
                                    'tenant_id'  => NULL,
                                    'building_id'    => $request->building_id,
                                    'society_id'     => $request->society_id,
                                    'bill_from'    => $request->bill_from,
                                    'bill_to'    => $request->bill_to,
                                    'bill_month' => $request->bill_month,
                                    'bill_year' => $year,
                                    'monthly_bill' => $monthly_bill,
                                    'arrear_bill' => $arrear_bill,
                                    'arrear_id' => $arrear_id,
                                    'total_bill' => $total_bill,
                                    'bill_date' => date('01-m-Y'),
                                    'due_date' => $request->due_date,
                                    'consumer_number' => $consumer_number,
                                    'total_bill_after_due_date'=>ceil($total_service_after_due),
                                    'total_service_after_due' => ceil($total_after_due+$monthly_bill),
                                    'late_fee_charge' => ceil($total_after_due),
                                    'status' => 'Generated',
                                    //'balance_amount' => $arrear_bill,
                                    'balance_amount' => $total_bill,
                                    'arrear_balance'=>$arrear_balance,
                                    'arrear_interest_balance'=>$arrear_interest_balance,
                                    'prev_arrear_balance'=>$arrear_balance,
                                    'prev_arrear_interest_balance'=>$arrear_interest_balance,
                                    'service_charge_balance'=>$monthly_bill,
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s')
                                ];
                                
                              // $dat[]=$data;
                              if($lastBill)
                              {
                                $data['arrear_balance']=$lastBill->arrear_balance;
                                $data['arrear_interest_balance']=$lastBill->arrear_interest_balance;
                                  //for credit amount
                                  if($lastBill->credit_amount>0)
                                  {
                                      $data['prev_credit']=$lastBill->credit_amount;
                                      if($lastBill->credit_amount>=$monthly_bill)
                                      {
                                          $lastBill->credit_amount=$lastBill->credit_amount-$monthly_bill;
                                          $data['service_charge_balance'] = 0;
                                          if($lastBill->credit_amount>0)
                                          {
                                              if($lastBill->credit_amount>=$data['arrear_balance'])
                                              {
                                                  $lastBill->credit_amount= $lastBill->credit_amount-$data['arrear_balance'];
                                                $data['arrear_balance']=0;
                                                if($lastBill->credit_amount>=$lastBill->arrear_interest_balance)
                                                {
                                                    $lastBill->credit_amount= $lastBill->credit_amount-$data['arrear_interest_balance'];
                                                    $data['credit_amount']=$lastBill->credit_amount;
                                                }else
                                                {
                                                    $data['arrear_interest_balance']=$data['arrear_interest_balance']-$lastBill->credit_amount;
                                                    $data['credit_amount']=0;
                                                }
                                              }else
                                              {
                                                  $data['arrear_balance']=$data['arrear_balance']-$lastBill->credit_amount;
                                                  $data['credit_amount']=0;
                                              }
                                          }
                                      }else
                                      {
                                          $data['service_charge_balance']=$data['service_charge_balance']-$lastBill->credit_amount;
                                          $data['credit_amount']= 0;
                                      }
                                      $data['balance_amount']=$data['arrear_balance']+$data['service_charge_balance'];
                                  }else
                                  {
                                      $data['credit_amount']= 0;
                                  }

                                  //for balance amounty
                                  if($lastBill->balance_amount>0)
                                  {
                                      $data['prev_service_charge_balance']=0;
                                      $data['prev_arrear_balance']=0;
                                      $data['prev_arrear_interest_balance']=0;
                                      if($lastBill->service_charge_balance>0)
                                      {
                                          $lastBill->service_charge_balance=$lastBill->service_charge_balance+($lastBill->service_charge_balance*$interest_charge);
                                          $data['prev_service_charge_balance']=$lastBill->service_charge_balance;
                                          
                                      }
                                      
                                      $data['service_charge_balance']=$data['service_charge_balance']+$lastBill->service_charge_balance;
                                      
                                      if($lastBill->arrear_balance>0)
                                      {
                                          //dd($lastBill);
                                          $arrear_interest=0;
                                          $arrear_data=ArrearsChargesRate::where(['society_id'=>$lastBill->society_id,'building_id'=>$lastBill->building_id])->first();
                                          //dd($arrer_data);
                                          if($arrear_data)
                                            {
                                                $arrear_interest=($arrear_data->old_rate*($arrear_data->interest_on_old_rate/100))+(($arrear_data->revise_rate-$arrear_data->old_rate)*($arrear_data->interest_on_differance/100));
                                            }
                                          //$lastBill->arrear_balance=$lastBill->arrear_balance+$arrear_interest;
                                          $lastBill->arrear_balance=$lastBill->arrear_balance;
                                          $lastBill->arrear_interest_balance=$lastBill->arrear_interest_balance+$arrear_interest;
                                          //dd($lastBill->arrear_balance);
                                          $data['prev_arrear_balance']=$lastBill->arrear_balance;
                                          $data['prev_arrear_interest_balance']=$lastBill->arrear_interest_balance;
                                      }
                                      $data['arrear_balance']+$lastBill->arrear_balance;
                                      $data['arrear_interest_balance']=$lastBill->arrear_interest_balance;
                                  }
                                  
                                  $data['balance_amount']=ceil($data['arrear_balance']+$data['arrear_interest_balance']+$data['service_charge_balance']);
                                  
                                  $data['total_bill']=ceil($data['arrear_balance']+$data['arrear_interest_balance']+$data['service_charge_balance']);
                                  
                              }else
                              {
                                  $data['balance_amount'] = ceil($total_bill);
                                  $data['credit_amount']= 0;    
                              }
                        // if($lastBill) {
                        // // dd($lastBill);
                        //     if($lastBill->balance_amount > 0) {
                        //         $data['total_bill_after_due_date'] = round($request->total_bill + $request->late_fee_charge +$lastBill->balance_amount,2);
                        //         $data['balance_amount'] = round($lastBill->total_bill_after_due_date,2);
                        //     }
            
                        //     if($lastBill->credit_amount > 0 && $lastBill->credit_amount > $request->total_bill) {
                        //         $data['credit_amount'] = round($lastBill->credit_amount - $request->monthly_bill,2);
                        //         $data['total_bill_after_due_date'] = 0;
                        //         $data['status'] = 'paid';
                        //     }
            
                        //     if($lastBill->credit_amount > 0 && $lastBill->credit_amount < $request->total_bill) {
                        //         $data['total_bill'] = round($request->monthly_bill - $lastBill->credit_amount,2);
                        //         $data['balance_amount'] = $data['total_bill_after_due_date'] = round($request->total_service_after_due - $lastBill->credit_amount,2);
                        //         $data['credit_amount'] = 0;
                        //     }
                        // } else {
                        // // dd('not null');
                        //     //$bill->balance_amount = 0;
                        //     $data['balance_amount'] = round($request->total_bill,2);
                        //     $data['credit_amount']= 0;    
                        // }
                        //dd($data);
                        $bill[] = TransBillGenerate::insertGetId($data);
               // }
//                dd($bill[0]);
               if(isset($bill)){
                    $ids = implode(",",$bill);
                    //dd($ids);
                    $lastBillGenerated = DB::table('building_tenant_bill_association')->orderBy('id','DESC')->first();
//                    dd($lastBillGenerated);
                    if($lastBillGenerated) {
                        //dd($lastBillGenerated);
                        $lastGeneratedNumber = substr($lastBillGenerated->bill_number,-7);
                        $increNumber = (int)$lastGeneratedNumber+1;
                        $bill_number = $request->building_id.str_pad($increNumber, 7, "0", STR_PAD_LEFT);
                        
                    } else {
                        $bill_number = $request->building_id.'0000001';
                    }
//                    dd($lastBillGenerated);
                    if($lastBillGenerated)
                    {
                        $this->insertServiceChrargeForBill($bill[0],$serviceChargesRate);
                    }
                    TransBillGenerate::where(['id'=>$ids])->update(['bill_number'=>$bill_number]);
                    $association = DB::table('building_tenant_bill_association')->insert(['building_id' => $request->building_id, 'bill_id' => $ids, 'bill_month' => $request->bill_month, 'bill_year' => $request->bill_year,'bill_number'=>$bill_number]);
                } else { 
                                   
                }     
                //dd($bill);
                $request->regenate = false;
                return redirect()->back()->with('success', 'Bill Generated Successfully.');                   
            } else {
                return redirect()->back()->with('success', 'Check bill details once.');    
            }
            
        } else {
            $message = ' Bill Already Generated on '.$check->bill_date; 
            return redirect()->back()->with('warning', $message);
        }
    }

     public function get_building_select_updated(Request $request){
    
        if($request->input('id')){
            $society = SocietyDetail::find(decrypt($request->input('id')));
            if(Config::get('commanConfig.SOCIETY_LEVEL_BILLING') == $society->society_bill_level) {
                
                $html ='<div class="form-group m-form__group ">
                            Billing Level : Society Level Biiling
                        </div>';
            $society_id = decrypt($request->input('id'));
            $buildings = MasterBuilding::with(['TransBillGenerate'=>function($query) use($society_id){
                $query->where('society_id', '=', $society_id)->where('bill_month', '=', date('m'))->where('bill_year', '=', date('Y'));
            }])->with('tenant_count')->where('society_id', '=', decrypt($request->input('id')))
                        ->get();
            // return $buildings;

            //$html .= view('admin.em_department.ajax_building_bill_generation', compact('buildings', 'society_id'))->render();
            return $html;

            } else {
                
                $building = MasterBuilding::where('society_id', '=', decrypt($request->input('id')))->get();
                $html = '<div class="form-group m-form__group ">
                            Billing Level : Tenant Level Biiling
                        </div>
               
                <div class="col-md-12" style="margin-top:10px;margin-bottom: 10px;">
                    <div class="row align-items-center mb-0">                            
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" style="opacity:1" id="building" name="building">';
                $html .= '<option value="" style="font-weight: normal;">Select Building</option>';

                    foreach($building as $key => $value){
                        $html .= '<option value="'.encrypt($value->id).'">'.$value->name.'</option>';
                    }   
                $html .= '</select></div>
                            </div>                          
                    </div>
                </div>
                ';         

                return $html;
            }
        }
    }

    // upload no dues certificate in OC
    public function uploadOCNoDuesCertificate(Request $request){
        
        $applicationId = $request->applicationId; 
        $folder_name = 'No_Dues_Cert_Oc';
        $file  = $request->file('no_due_certificate');   
        if ($file){
            $extension  = $file->getClientOriginalExtension(); 
            $file_name  = time().'_no_dues_'.$applicationId.'.'.$extension; 
            $file_path  = $folder_name.'/'.$file_name;

            if ($extension == "pdf") {
                $this->comman->ftpFileUpload($folder_name,$file,$file_name); 
                OcApplication::where('id',$applicationId)->update(["no_dues_certificate_draft" => $file_path]);
                $result = 'No Dues certificate uploaded successfully';
            }else{
                $result = 'Invalid type of file upload(pdf required).';
            }
        }else{
            $result = 'Please select file to upload';
        }

        return back()->with('success',$result);
    }

    //Enter service charges against bill
    public function insertServiceChrargeForBill($bill_id,$serviceChargesRate)
    {
        $TransBillServiceCharge=TransBillServiceCharge::where(['trans_bill_generate_id'=>$bill_id])->first();
        if($TransBillServiceCharge==null)
        {
            $TransBillServiceCharge=new TransBillServiceCharge;
            $TransBillServiceCharge->trans_bill_generate_id=$bill_id;
            $TransBillServiceCharge->water_charges=$serviceChargesRate->water_charges!=null?$serviceChargesRate->water_charges:0.00;
            $TransBillServiceCharge->electric_city_charge=$serviceChargesRate->electric_city_charge!=null?$serviceChargesRate->electric_city_charge:0.00;
            $TransBillServiceCharge->pump_man_and_repair_charges=$serviceChargesRate->pump_man_and_repair_charges!=null?$serviceChargesRate->pump_man_and_repair_charges:0.00;
            $TransBillServiceCharge->external_expender_charge=$serviceChargesRate->external_expender_charge!=null?$serviceChargesRate->external_expender_charge:0.00;
            $TransBillServiceCharge->administrative_charge=$serviceChargesRate->administrative_charge!=null?$serviceChargesRate->administrative_charge:0.00;
            $TransBillServiceCharge->lease_rent=$serviceChargesRate->lease_rent!=null?$serviceChargesRate->lease_rent:0.00;
            $TransBillServiceCharge->na_assessment=$serviceChargesRate->na_assessment!=null?$serviceChargesRate->na_assessment:0.00;
            $TransBillServiceCharge->property_tax=$serviceChargesRate->property_tax!=null?$serviceChargesRate->property_tax:0.00;
            $TransBillServiceCharge->other=$serviceChargesRate->other!=null?$serviceChargesRate->other:0.00;
            $TransBillServiceCharge->save();
        }
        return $TransBillServiceCharge;
    }
}
