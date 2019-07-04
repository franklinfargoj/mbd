<?php

namespace App\Http\Controllers\REEDepartment;

use App\Http\Controllers\Dashboard\ArchitectLayoutDashboardController;
use App\Http\Controllers\OcDashboardController;
use App\Http\Controllers\Tripartite\TripartiteDashboardController;
use App\Layout\ArchitectLayout;
use App\REENote;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\CommonController;
use Yajra\DataTables\DataTables;
use App\olSiteVisitDocuments;
use App\OlApplication;
use App\NocApplication;
use App\NocCCApplication;
use App\SocietyOfferLetter;
use App\OlSocietyDocumentsStatus;
use App\OlConsentVerificationDetails;
use App\OlTitBitVerificationDetails;
use App\OlRelocationVerificationDetails;
use App\OlApplicationCalculationSheetDetails;
use App\OlSharingCalculationSheetDetail;
use App\OlFsiCalculationSheet;
use App\OlCustomCalculationMasterModel;
use App\OlCustomCalculationSheet;
use App\OlChecklistScrutiny;
use App\OlApplicationStatus;
use App\OcApplication;
use App\OcApplicationStatusLog;
use App\OcSrutinyQuestionMaster;
use App\OcEEScrutinyAnswer;
use App\NocApplicationStatus;
use App\NocCCApplicationStatus;
use App\NocSrutinyQuestionMaster;
use App\NocReeScrutinyAnswer;
use App\NOCBuildupArea;
use App\OlApplicationMaster;
use App\Http\Controllers\SocietyNocController;
use App\Http\Controllers\SocietyNocforCCController;
use App\OlDemarcationVerificationDetails;
use App\OlApplicationConcessionSheetDetails;
use App\NOCSharingCalculationSheet;
use App\OlDemarcationLandArea;
use App\OlDcrRateMaster;
use App\OCEENote;
use App\User;
use Config;
use Auth;
use DB;
use PDF;
use File;
use Storage;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Mpdf\Mpdf;
use App\LayoutUser;

class REEController extends Controller
{
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
    public function index(Request $request, Datatables $datatables){

        $getData = $request->all();
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address','class' => 'datatable-address', 'searchable' => false],
            ['data' => 'model','name' => 'model','title' => 'Application Type'],
            ['data' => 'Status','name' => 'Status','title' => 'Status'],
            ['data' => 'radio','name' => 'radio','title' => 'Action','searchable' => false],

            // ['data' => 'Model','name' => 'Model','title' => 'Model'],
            // ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];
        if ($datatables->getRequest()->ajax()) {

            //dd($request);
            $ree_application_data = $this->CommonController->listApplicationData($request);
            // dd($ree_application_data);
            // $ol_application = $this->CommonController->getOlApplication($ree_application_data->id);
              
            return $datatables->of($ree_application_data)
                ->editColumn('rownum', function ($listArray) {
                     static $i = 0; $i++; return $i;
                })
            ->editColumn('radio', function ($ree_application_data) {
                $url = route('ree.view_application', encrypt($ree_application_data->id));
                return '<div class="d-flex btn-icon-list"><a href="'.$url.'" onclick="geturl(this.value);" name="village_data_id" class="d-flex flex-column align-items-left"><span class="btn-icon btn-icon--view">
                        <img src="'. asset("img/view-icon.svg").'">
                    </span>View</span></a></div>';
            })
            ->editColumn('eeApplicationSociety.name', function ($ree_application_data) {
                return $ree_application_data->eeApplicationSociety->name;
            })
            ->editColumn('eeApplicationSociety.building_no', function ($ree_application_data) {
                return $ree_application_data->eeApplicationSociety->building_no;
            })
            ->editColumn('eeApplicationSociety.address', function ($ree_application_data) {
                return "<span>".$ree_application_data->eeApplicationSociety->address."</span>";
            })                
            ->editColumn('date', function ($ree_application_data) {
                return date(config('commanConfig.dateFormat'), strtotime($ree_application_data->submitted_at));
            })
            // ->editColumn('actions', function ($ree_application_data) use($request){
            //    return view('admin.REE_department.action', compact('ree_application_data', 'request'))->render();
            // }) 
                ->editColumn('model', function ($listArray) {
                $application_type = '';
                $type = $listArray->ol_application_master->ol_application_type[0]->title;
                if (strpos($type, 'Self') !== false) {
                    $application_type = 'Self';
                }elseif(strpos($type, 'Developer') !== false){
                    $application_type = 'Through Developer';
                }else{
                    $application_type = '-';
                }

                return $application_type."\n".'('.$listArray->ol_application_master->model.')' ;
//                    return $listArray->ol_application_master->model;
                })            
            ->editColumn('Status', function ($listArray) use ($request) {
                $status = $listArray->olApplicationStatusForLoginListing[0]->status_id;

                if ($request->update_status)
                {
                    if ($request->update_status == $status){
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
           // ->editColumn('Model', function ($ree_application_data) {
           //          return $ree_application_data->ol_application_master->model;
           //      })
            ->rawColumns(['radio','society_name', 'building_name', 'society_address','date','Status','eeApplicationSociety.address'])
            ->make(true);
        }        
            $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
            
        return view('admin.REE_department.index', compact('html','header_data','getData'));        
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"      => [0, "asc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    } 

    // public function societyEEDocuments(Request $request,$applicationId){
        
    //     $applicationId = decrypt($applicationId);
    //     $ol_application = $this->CommonController->getOlApplication($applicationId);
    //     $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
    //     $societyDocuments = $this->CommonController->getSocietyEEDocuments($applicationId);
    //    return view('admin.REE_department.society_EE_documents',compact('ol_application','societyDocuments'));
    // }

    // Forward Application page
    public function forwardApplication(Request $request, $applicationId){

        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $applicationData = $this->CommonController->getForwardApplication($applicationId);
        $parentData = $this->CommonController->getForwardApplicationParentData();
        $arrData['parentData'] = $parentData['parentData'];
        $arrData['role_name'] = $parentData['role_name'];

//        $arrData['application_status'] = $this->CommonController->getCurrentApplicationStatus($applicationId);
        if(session()->get('role_name') != config('commanConfig.ree_junior'))
            $arrData['application_status'] = $this->CommonController->getCurrentLoggedInChild($applicationId);

        $arrData['get_current_status'] = $this->CommonController->getCurrentStatus($applicationId);

        // CO Forward Application
        $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
        $layout_ids = array_column($layout_id_array, 'layout_id');
        $co_id = Role::where('name', '=', config('commanConfig.co_engineer'))->first();
        if($arrData['get_current_status']->status_id != config('commanConfig.applicationStatus.offer_letter_approved'))
        {
            $arrData['get_forward_co'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                                ->whereIn('lu.layout_id', $layout_ids)
                                ->where('role_id', $co_id->id)->groupBy('users.id')->get();
            $arrData['co_role_name'] = strtoupper(str_replace('_', ' ', $co_id->name));
        }

        $remarkHistory = $this->CommonController->getRemarkHistory($applicationId);
        return view('admin.REE_department.forward_application',compact('applicationData','arrData','ol_application','remarkHistory'));  
    }


    // Forward Revalidation Application page
    public function forwardRevalApplication(Request $request, $applicationId){

        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $applicationData = $this->CommonController->getForwardApplication($applicationId);

        $parentData = $this->CommonController->getForwardApplicationParentData();
        $arrData['parentData'] = $parentData['parentData'];
        $arrData['role_name'] = $parentData['role_name'];

//        $arrData['application_status'] = $this->CommonController->getCurrentApplicationStatus($applicationId);
        if(session()->get('role_name') != config('commanConfig.ree_junior'))
            $arrData['application_status'] = $this->CommonController->getCurrentLoggedInChild($applicationId);

        $arrData['get_current_status'] = $this->CommonController->getCurrentStatus($applicationId);

        // CO Forward Application
        $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
        $layout_ids = array_column($layout_id_array, 'layout_id');
        $co_id = Role::where('name', '=', config('commanConfig.co_engineer'))->first();
        if($arrData['get_current_status']->status_id != config('commanConfig.applicationStatus.offer_letter_approved'))
        {
            $arrData['get_forward_co'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                ->whereIn('lu.layout_id', $layout_ids)
                ->where('role_id', $co_id->id)->groupBy('users.id')->get();
            $arrData['co_role_name'] = strtoupper(str_replace('_', ' ', $co_id->name));
        }

        //remark and history
        $reeLogs  = $this->CommonController->getLogsOfREEDepartment($applicationId);
        $coLogs   = $this->CommonController->getLogsOfCODepartment($applicationId);
        $capLogs  = $this->CommonController->getLogsOfCAPDepartment($applicationId);
        $vpLogs   = $this->CommonController->getLogsOfVPDepartment($applicationId);


        return view('admin.REE_department.forward_reval_application',compact('applicationData','arrData','ol_application','eelogs','dyceLogs','reeLogs','coLogs','capLogs','vpLogs'));
    }


    public function sendForwardApplication(Request $request){
        $arrData['get_current_status'] = $this->CommonController->getCurrentStatus($request->applicationId);

//        dd($arrData['get_current_status']);
        // Added OR Condition by Prajakta Sisale
        if($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.offer_letter_generation')
        || $arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.draft_offer_letter_generated')
        )
        {
            $this->CommonController->generateOfferLetterREE($request);
        }
        // elseif((session()->get('role_name') == config('commanConfig.ree_branch_head')) && $arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.offer_letter_approved'))
        // {
        //     $this->CommonController->forwardApplicationToSociety($request);
        // }
         elseif($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.offer_letter_approved'))
         {
             $this->CommonController->forwardApprovedApplication($request);
         }
        else
        {
            $this->CommonController->forwardApplicationForm($request);
        }

        return redirect('/ree_applications')->with('success','Application send successfully.');

    }

    public function sendForwardRevalApplication(Request $request){

        //dd($request->all());
        $arrData['get_current_status'] = $this->CommonController->getCurrentStatus($request->applicationId);

        // Added OR Condition by Prajakta Sisale
        if($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.offer_letter_generation')
            || $arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.draft_offer_letter_generated'))
        {
            $this->CommonController->generateOfferLetterREE($request);
        }
        // elseif((session()->get('role_name') == config('commanConfig.ree_branch_head')) && $arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.offer_letter_approved'))
        // {
        //     $this->CommonController->forwardApplicationToSociety($request);
        // }
        elseif($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.offer_letter_approved'))
        {
            $this->CommonController->forwardApprovedApplication($request);
        }
        else
        {
            $this->CommonController->forwardApplicationForm($request);
        }

        return redirect('/ree_reval_applications')->with('success','Application send successfully.');

    }

    public function downloadCapNote(Request $request, $applicationId){

        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $capNote = $this->CommonController->downloadCapNote($applicationId);
        return view('admin.REE_department.cap_note',compact('capNote','ol_application'));
    }

    public function downloadRevalCapNote(Request $request, $applicationId){

        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $capNote = $this->CommonController->downloadCapNote($applicationId);
        return view('admin.REE_department.reval_cap_note',compact('capNote','ol_application'));
    }
    
    public function documentSubmittedBySociety()
    {
        // return view('admin.ee_department.documentSubmitted');
    }

    public function uploadREENote(Request $request){
        $applicationId   = $request->application_id;
        if ($request->file('ree_note')){

            $file = $request->file('ree_note');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'ree_note.'.$extension;
            $folder_name = "ree_note";
            $path = $folder_name."/".$file_name;

            if($extension == "pdf") {
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('ree_note'),$file_name);

                    $fileData[] = array('document_path' => $path,
                        'application_id' => $applicationId,
                        'user_id' => Auth::user()->id,
                        'role_id' => session()->get('role_id'));

                $data = REENote::insert($fileData);

                return back()->with('success', 'REE note uploaded successfully.'); 
            }
            else
            {
                return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
            }
        }
    }

    public function SharingCalculationSheet() {
        return view('admin.REE_department.sharing-calculation-sheet');
    }    

    public function GenerateOfferLetter(Request $request, $applicationId){
        
        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $applicationLog = $this->CommonController->getCurrentStatus($applicationId);
        $societyData = OlApplication::with(['eeApplicationSociety'])
                ->where('id',$applicationId)->orderBy('id','DESC')->first();

        $societyData->ree_Jr_id = (session()->get('role_name') == config('commanConfig.ree_junior')); 
        $societyData->ree_branch_head = (session()->get('role_name') == config('commanConfig.ree_branch_head')); 

        $societyData->drafted_offer_letter = OlApplication::where('id',$applicationId)->value('drafted_offer_letter');   
      
        return view('admin.REE_department.generate-offer-letter',compact('societyData','ol_application','applicationLog'));
    }

    public function GenerateRevalOfferLetter(Request $request, $applicationId){

        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $applicationLog = $this->CommonController->getCurrentStatus($applicationId);
        $societyData = OlApplication::with(['eeApplicationSociety'])
            ->where('id',$applicationId)->orderBy('id','DESC')->first();

        $societyData->ree_Jr_id = (session()->get('role_name') == config('commanConfig.ree_junior'));
        $societyData->ree_branch_head = (session()->get('role_name') == config('commanConfig.ree_branch_head'));

        $societyData->drafted_offer_letter = OlApplication::where('id',$applicationId)->value('drafted_offer_letter');

        return view('admin.REE_department.generate-reval-offer-letter',compact('societyData','ol_application','applicationLog'));
    }

    public function pdfMerge(Request $request){

        $pdf = new \PDFMerger;
         $uploadPath      = '/uploads';
        $pdfFile1Path = public_path($uploadPath) . '/pdf.pdf';
        $pdfFile1Path1 = public_path($uploadPath) . '/sample.pdf';

        $pdf->addPDF($pdfFile1Path, 'all');
        $pdf->addPDF($pdfFile1Path1, 'all');

        $file = $pdf->merge('file','mergedpdf.pdf');
        file_put_contents($uploadPath, $file);
    }

    public function editOfferLetter(Request $request,$applicatonId){
        
        $applicatonId = decrypt($applicatonId);
        $model = OlApplication::with('ol_application_master')->where('id',$applicatonId)->first();
        if ($model->ol_application_master->model == 'Premium'){
            
            $calculationData = OlApplication::with(['eeApplicationSociety'])->where('id',$applicatonId)->first(); 
            $fsi_calculation = OlFsiCalculationSheet::where('application_id',$applicatonId)->first();
            $premium = OlApplicationCalculationSheetDetails::where('application_id',$applicatonId)->first();
            
            if ($fsi_calculation){
                $calculationData->premiumCalculationSheet = $fsi_calculation;
            }else {
                $calculationData->premiumCalculationSheet = $premium;
            }   

            $blade =  "premiun_offer_letter";
                     
        }else if($model->ol_application_master->model == 'Sharing') {
            $calculationData = OlApplication::with(['sharingCalculationSheet','eeApplicationSociety'])->where('id',$applicatonId)->first(); 
            // dd($calculationData);
            $blade =  "sharing_offer_letter";           
        }

        // dd($calculationData);

        if($model->text_offer_letter){

            $content = Storage::disk('ftp')->get($model->text_offer_letter); 
                   
        }else{
           $content = ""; 
        }
        $vpApprovedData = $this->CommonController->getLogsOfVPDepartment($applicatonId);

        $calculationData->vpDate = $vpApprovedData[0]->created_at;

        //latest calculation data
        $custom = '0';
        $custom = OlCustomCalculationSheet::where('application_id',$applicatonId)->orderBy('updated_at','DESC')
        ->value('updated_at');
        $premium = OlApplicationCalculationSheetDetails::where('application_id',$applicatonId)
        ->orderBy('updated_at','DESC')->value('updated_at');  

        if ($custom > $premium){
            $custom = '1';            
        }   

        $table1Id = OlCustomCalculationMasterModel::where('name','Calculation_Table-A')->value('id');       
        $table1 = OlCustomCalculationSheet::where('application_id',$applicatonId)
        ->where('parent_id',$table1Id)->get()->toArray();
        $summary = $this->getSummaryData($applicatonId);

        $role_id = Role::where('name', '=', config('commanConfig.ree_branch_head'))->value('id');
        $ree_head = User::where('role_id',$role_id)->value('name');

        return view('admin.REE_department.'.$blade,compact('applicatonId','calculationData','content','table1','custom','summary','ree_head'));
    }

    public function editRevalOfferLetter(Request $request,$applicatonId){

        $model = OlApplication::with('ol_application_master')->where('id',$applicatonId)->first();
        if ($model->ol_application_master->model == 'Premium'){

            $calculationData = OlApplication::with(['premiumCalculationSheet','eeApplicationSociety'])->where('id',$applicatonId)->first();
            $fsi_calculation = OlFsiCalculationSheet::where('application_id',$applicatonId)->first();
            $premium = OlApplicationCalculationSheetDetails::where('application_id',$applicatonId)->first();

            if ($fsi_calculation){
                $calculationData->premiumCalculationSheet = $fsi_calculation;
            }else {
                $calculationData->premiumCalculationSheet = $premium;
            } 
            $blade =  "premiun_reval_offer_letter";

        }else if($model->ol_application_master->model == 'Sharing') {
            $calculationData = OlApplication::with(['sharingCalculationSheet','eeApplicationSociety'])->where('id',$applicatonId)->first();
            // dd($calculationData);
            $blade =  "sharing_reval_offer_letter";
        }

        // dd($calculationData);

        if($model->text_offer_letter){

            $content = Storage::disk('ftp')->get($model->text_offer_letter);

        }else{
            $content = "";
        }
        $vpApprovedData = $this->CommonController->getLogsOfVPDepartment($applicatonId);

        $calculationData->vpDate = $vpApprovedData[0]->created_at;

        //latest calculation data
        $custom = '0';
        $custom = OlCustomCalculationSheet::where('application_id',$applicatonId)->orderBy('updated_at','DESC')
            ->value('updated_at');
        $premium = OlApplicationCalculationSheetDetails::where('application_id',$applicatonId)
            ->orderBy('updated_at','DESC')->value('updated_at');

        if ($custom > $premium){
            $custom = '1';
        }

        $table1Id = OlCustomCalculationMasterModel::where('name','Calculation_Table-A')->value('id');
        $table1 = OlCustomCalculationSheet::where('application_id',$applicatonId)
            ->where('parent_id',$table1Id)->get()->toArray();
        $summary = $this->getSummaryData($applicatonId);

        $role_id = Role::where('name', '=', config('commanConfig.ree_branch_head'))->value('id');
        $ree_head = User::where('role_id',$role_id)->value('name');

        return view('admin.REE_department.'.$blade,compact('applicatonId','calculationData','content','table1','custom','summary','ree_head'));
    }
// 
    public function saveOfferLetter(Request $request){

        $id = $request->applicationId;
        $content = str_replace('_', "", $_POST['ckeditorText']);
        $folder_name = 'Draft_offer_letter';

        $header_file = view('admin.REE_department.offer_letter_header');        
        $footer_file = view('admin.REE_department.offer_letter_footer');
        
        // $pdf = \App::make('dompdf.wrapper');
        $pdf = new Mpdf();
        $pdf->autoScriptToLang = true;
        $pdf->autoLangToFont = true; 

        // $pdf->SetHTMLHeader($header_file);
        // $pdf->SetHTMLFooter($footer_file);
        // $pdf->WriteHTML($content);                   

        $pdf->WriteHTML($header_file.$content.$footer_file);
 
        $fileName = time().'draft_offer_letter_'.$id.'.pdf';
        $filePath = $folder_name."/".$fileName;

        if (!(Storage::disk('ftp')->has($folder_name))) {            
            Storage::disk('ftp')->makeDirectory($folder_name, $mode = 0777, true, true);
        } 
        Storage::disk('ftp')->put($filePath, $pdf->Output($fileName, 'S'));
        // $file = $pdf->output();

        //text offer letter

        $folder_name1 = 'text_offer_letter';

        if (!(Storage::disk('ftp')->has($folder_name1))) {            
            Storage::disk('ftp')->makeDirectory($folder_name1, $mode = 0777, true, true);
        }        
        $file_nm =  time()."text_offer_letter_".$id.'.txt';
        $filePath1 = $folder_name1."/".$file_nm;

        Storage::disk('ftp')->put($filePath1, $content);

        // OlApplication::where('id',$request->applicationId)->update(["drafted_offer_letter" => $filePath]);
        OlApplication::where('id',$request->applicationId)->update(["drafted_offer_letter" => $filePath, "text_offer_letter" => $filePath1]);

        $currentStatus = config('commanConfig.applicationStatus.draft_offer_letter_generated');
        $status = $this->CommonController->getCurrentStatus($request->applicationId);
        if ($status->status_id == config('commanConfig.applicationStatus.offer_letter_approved')){
            $currentStatus = config('commanConfig.applicationStatus.offer_letter_approved');
        }
        //Code added by Prajakta >>start
        $generated_offer_letter = [
            'application_id' => $request->applicationId,
            'user_id' => Auth::user()->id,
            'role_id' => session()->get('role_id'),
            'status_id' => $currentStatus,
            'to_user_id' => NULL,
            'to_role_id' => NULL,
            'remark' => NULL,
            'is_active' => 1,
            'phase' => 1,
            'created_at' => Carbon::now(),
        ];

        DB::beginTransaction();
        try {
            OlApplication::where('id',$request->applicationId)->update(["drafted_offer_letter" => $filePath, "text_offer_letter" => $filePath1]);

            OlApplicationStatus::where('application_id',$request->applicationId)
                ->whereIn('user_id', [Auth::user()->id])
                ->where('status_id',config('commanConfig.applicationStatus.offer_letter_generation'))
                ->update(array('is_active' => 0));

            OlApplicationStatus::insert($generated_offer_letter);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
        }
        //Code added by Prajakta >>end
        $applicationId = encrypt($request->applicationId);
        $route = 'generate_offer_letter/'.$applicationId;
        if ($status->status_id == config('commanConfig.applicationStatus.offer_letter_approved')){
            $route = 'approved_offer_letter/'.$applicationId;
        }
        
        return redirect($route)->with('success','Offer Letter generated successfully..');
    }

    public function saveRevalOfferLetter(Request $request){

        $id = $request->applicationId;
        $content = str_replace('_', "", $_POST['ckeditorText']);
        $folder_name = 'Draft_offer_letter';

        $header_file = view('admin.REE_department.offer_letter_header');
        $footer_file = view('admin.REE_department.offer_letter_footer');

        $pdf=new Mpdf([
            'default_font_size' => 9,
            'default_font' => 'Times New Roman'
        ]);
        $pdf->autoScriptToLang = true;
        $pdf->autoLangToFont = true;
        $pdf->setAutoBottomMargin = 'stretch';
        $pdf->setAutoTopMargin = 'stretch';
        $pdf->SetHTMLHeader($header_file);
        $pdf->SetHTMLFooter($footer_file);
        $pdf->WriteHTML($content);


        //$pdf = \App::make('dompdf.wrapper');

        //$pdf->loadHTML($header_file.$content.$footer_file);

        $fileName = time().'draft_offer_letter_'.$id.'.pdf';
        $filePath = $folder_name."/".$fileName;

        if (!(Storage::disk('ftp')->has($folder_name))) {
            Storage::disk('ftp')->makeDirectory($folder_name, $mode = 0777, true, true);
        }
        Storage::disk('ftp')->put($filePath, $pdf->Output($fileName, 'S'));
        // $file = $pdf->output();

        //text offer letter

        $folder_name1 = 'text_offer_letter';

        if (!(Storage::disk('ftp')->has($folder_name1))) {
            Storage::disk('ftp')->makeDirectory($folder_name1, $mode = 0777, true, true);
        }
        $file_nm =  time()."text_offer_letter_".$id.'.txt';
        $filePath1 = $folder_name1."/".$file_nm;

        Storage::disk('ftp')->put($filePath1, $content);

        OlApplication::where('id',$request->applicationId)->update(["drafted_offer_letter" => $filePath, "text_offer_letter" => $filePath1]);
        // OlApplication::where('id',$request->applicationId)->update(["drafted_offer_letter" => $filePath]);

        //Code added by Prajakta >>start
        $generated_offer_letter = [
            'application_id' => $request->applicationId,
            'user_id' => Auth::user()->id,
            'role_id' => session()->get('role_id'),
            'status_id' => config('commanConfig.applicationStatus.draft_offer_letter_generated'),
            'to_user_id' => NULL,
            'to_role_id' => NULL,
            'remark' => NULL,
            'is_active' => 1,
            'phase' => 1,
            'created_at' => Carbon::now(),
        ];
//dd($generated_offer_letter);
        DB::beginTransaction();
        try {
            OlApplication::where('id',$request->applicationId)->update(["drafted_offer_letter" => $filePath, "text_offer_letter" => $filePath1]);

            OlApplicationStatus::where('application_id',$request->applicationId)
                ->whereIn('user_id', [Auth::user()->id])
                ->where('status_id',config('commanConfig.applicationStatus.offer_letter_generation'))
                ->update(array('is_active' => 0));

            OlApplicationStatus::insert($generated_offer_letter);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
//                return response()->json(['error' => $ex->getMessage()], 500);
        }
        //Code added by Prajakta >>end

        return redirect('generate_reval_offer_letter/'.$request->applicationId);
    }

    public function uploadOfferLetter(Request $request,$applicationId){
        $reeHead = config('commanConfig.ree_branch_head');
        $status = $this->CommonController->getCurrentStatus($applicationId);
        if ($status->status_id == config('commanConfig.applicationStatus.offer_letter_approved') && session()->get('role_name') == $reeHead) {
           OlApplication::where('id',$applicationId)->update(['is_offer_letter_uploaded' => 1]); 
        }

        if ($request->file('offer_letter')) {
            $file = $request->file('offer_letter');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'_uploaded_offer_letter_'.$applicationId.'.'.$extension;
            $folder_name = "uploaded_offer_letter";

            if ($extension == "pdf") {

                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('offer_letter'),$file_name);

                    $offerLetterPath = $folder_name."/".$file_name; 
                    OlApplication::where('id',$applicationId)->update(["offer_letter_document_path" => $offerLetterPath]);

                    return redirect()->back()->with('success', 'Offer Letter uploaded successfully.');
            } else {
                return redirect()->back()->with('error', 'Invalid format. pdf file only.');
            }
        }       
    }

    public function uploadRevalOfferLetter(Request $request,$applicationId){

        if ($request->file('offer_letter')) {
            $file = $request->file('offer_letter');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'_uploaded_offer_letter_'.$applicationId.'.'.$extension;
            $folder_name = "uploaded_offer_letter";

            if ($extension == "pdf") {

                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('offer_letter'),$file_name);

                $offerLetterPath = $folder_name."/".$file_name;
                OlApplication::where('id',$applicationId)->update(["offer_letter_document_path" => $offerLetterPath]);

                return redirect()->back()->with('success', 'Offer Letter uploaded successfully.');
            } else {
                return redirect()->back()->with('error', 'Invalid format. pdf file only.');
            }
        }
    }

    public function approvedOfferLetter(Request $request,$applicationId){

        $applicationId = decrypt($applicationId);
        $ree_head = session()->get('role_name') == config('commanConfig.ree_branch_head'); 
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $applicationData = OlApplication::with(['eeApplicationSociety'])
                ->where('id',$applicationId)->orderBy('id','DESC')->first();

        // $this->CommonController->getREEForwardRevertLog($applicationData,$applicationId); 

       // get logs of ree head         
       $ree_branch_head = Role::where('name',config('commanConfig.ree_branch_head'))->value('id');         
       $applicationData->ReeLog = OlApplicationStatus::where('application_id',$applicationId)->where('role_id',$ree_branch_head)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();
       // get Co log
        $co = Role::where('name',config('commanConfig.co_engineer'))->value('id');
        $applicationData->coLog=OlApplicationStatus::where('application_id',$applicationId)->where('role_id',$co)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();
        $status = $this->CommonController->getCurrentStatus($applicationId);   
        return view('admin.REE_department.approved_offer_letter',compact('applicationData','ol_application','ree_head','status'));
    }

    public function approvedRevalOfferLetter(Request $request,$applicationId){

        $ree_head = session()->get('role_name') == config('commanConfig.ree_branch_head');
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $applicationData = OlApplication::with(['eeApplicationSociety'])
            ->where('id',$applicationId)->orderBy('id','DESC')->first();

        $this->CommonController->getREEForwardRevertLog($applicationData,$applicationId);

        // get Co log
        $co = Role::where('name',config('commanConfig.co_engineer'))->value('id');
        $applicationData->coLog = OlApplicationStatus::where('application_id',$applicationId)->where('role_id',$co)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();

        return view('admin.REE_department.approved_reval_offer_letter',compact('applicationData','ol_application','ree_head'));
    }

    public function getPermiumCalculationSheetData($applicationId){
        
        $data = OlApplicationCalculationSheetDetails::where('application_id',$applicationId)->first()
        ;
        return $data;
    }

    public function sendForApproval(Request $request){

        $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
        $layout_ids = array_column($layout_id_array, 'layout_id');
        $co_id = Role::where('name', '=', config('commanConfig.co_engineer'))->first();
        $get_forward_co = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                            ->whereIn('lu.layout_id', $layout_ids)
                            ->where('role_id', $co_id->id)->first();   

        $id = encrypt($request->applicationId);                    

        $this->CommonController->forwardApplicationToCoForOfferLetterGeneration($request,$get_forward_co);

        return redirect()->route('ree.generate_offer_letter',$id)->with('success','Application forwarded to CO successfully.');                 
        // $arco_role_name'] = strtoupper(str_replace('_', ' ', $co_id->name));        
    }

    public function sendOfferLetterToSociety(Request $request){

        $this->CommonController->forwardApplicationToSociety($request);
        return redirect('/ree_applications')->with('success','send successfully.');

    }

    public function sendRevalOfferLetterToSociety(Request $request){

        $this->CommonController->forwardApplicationToSociety($request);
        return redirect('/ree_reval_applications')->with('success','send successfully.');

    }

    public function viewApplication(Request $request, $applicationId){

        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->downloadOfferLetter($applicationId);
        $ol_application->folder = 'REE_department';

        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
    
        $ol_application->comments = $this->CommonController->getSocietyDocumentComments($ol_application->id);
        
        return view('admin.common.offer_letter', compact('ol_application'));
    }

    public function showCalculationSheet($id)
    {
        $applicationId = decrypt($id);
        $status = $this->CommonController->getCurrentStatus($applicationId); 
        // $applicationId = $id;
        $user = $this->CommonController->showCalculationSheet($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId); 
        $this->getCustomCalculationData($ol_application,$applicationId);
        $summary = $this->getSummaryData($applicationId);
        
        // $ol_application->folder = 'REE_department';
        $ol_application->model=OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $calculationSheetDetails = $user->calculationSheetDetails;
        $dcr_rates = $user->dcr_rates;
        $blade = $user->blade;
        $arrData['reeNote'] = $user->areeNote;
        //latest calculation data
        $custom = OlCustomCalculationSheet::where('application_id',$applicationId)->first();
        $premium = OlApplicationCalculationSheetDetails::where('application_id',$applicationId)->first(); 
        $fsiCalculation = OlFsiCalculationSheet::where('application_id',$applicationId)->first(); 
        $forward = config('commanConfig.applicationStatus.forwarded');

        $exists = 0;
        if (isset($custom) || isset($premium) || isset($fsiCalculation)){
            $exists = 1;
        }

        if (isset($fsiCalculation) && session()->get('role_name') == config('commanConfig.ree_junior') && 
            $status->status_id != $forward){
            $route = 'admin.REE_department.fsi_calculation_sheet';
            $FSI = '2.5 FSI';
            $calculationSheetDetails = $fsiCalculation;

        }else if ($fsiCalculation){
            $route = 'admin.REE_department.view_fsi_calculation_sheet';
            $FSI = '2.5 FSI';
            $calculationSheetDetails = $fsiCalculation;
        }
        else if (isset($custom) && session()->get('role_name') == config('commanConfig.ree_junior') && $status->status_id != $forward) {
            $route = 'admin.REE_department.custom_premium_calculation_sheet';
            $FSI = 'Custom';

        }else if (isset($custom)) {
           $route = 'admin.REE_department.view_custom_premium_calculation_sheet';
            $FSI = 'Custom';
             
        }
        else if ($ol_application->ol_application_master->model == 'Premium' && session()->get('role_name') == config('commanConfig.ree_junior') && $status->status_id != $forward) {
            $route = 'admin.REE_department.calculation_sheet';
            $FSI = $user->FSI;
           $calculationSheetDetails = $user->calculationSheetDetails;
        }
        else {
           $route = 'admin.common.'.$blade; 
           $FSI = $user->FSI;
           $calculationSheetDetails = $user->calculationSheetDetails;
        }
        $action = '';
        $master = OlApplicationMaster::where('id',$ol_application->application_master_id)->value('title');
        if ($master == 'New - Offer Letter'){
            $action = '.action';
            $folder1 = 'REE_department.action';
        }elseif($master = 'Revalidation Of Offer Letter'){
            $action = '.reval_action';
            $folder1 = 'REE_department.reval_action';
        }

        $folder = $this->getCurrentRoleFolderName();
        $reeNote = REENote::where('application_id',$applicationId)->orderBy('id','DESC')->first(); 
        $ol_application->folder = $folder;
        $buldingNumber = OlCustomCalculationSheet::where('application_id',$applicationId)
            ->where('title','total_no_of_buildings')->value('amount');

        $concessionData = $this->getConcessionDetails($applicationId);    
        //get total house (6.2) from EE scrutiny demarcation 
        $totalHouse = OlDemarcationVerificationDetails::where('application_id',$applicationId)->select(DB::raw('sum(residential + non_residential) as total'))->value('total');
        
        return view($route,compact('calculationSheetDetails','applicationId','user','dcr_rates','arrData','ol_application','summary','status','reeNote','folder','buldingNumber','action','FSI','folder1','master','exists','concessionData','totalHouse'));

    }

    // get calculation sheet as per selected FSI
    public function getCalculationSheet(Request $request){

        $exists = 0;
        $applicationId = $request->applicationId;
        $selectedFSI = $request->fsi;

        $user = $this->CommonController->showCalculationSheet($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId); 
        $ol_application->model=OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $this->getCustomCalculationData($ol_application,$applicationId);
        $summary = $this->getSummaryData($applicationId);

        $calculationSheetDetails = $user->calculationSheetDetails;
        $dcr_rates = $user->dcr_rates;
        $blade = $user->blade;
        $arrData['reeNote'] = $user->areeNote;
        $status = $this->CommonController->getCurrentStatus($applicationId);
        $reeNote = REENote::where('application_id',$applicationId)->orderBy('id','DESC')->first();
        $folder = $this->getCurrentRoleFolderName();
        $ol_application->folder = $folder;
        $buldingNumber = OlCustomCalculationSheet::where('application_id',$applicationId)
            ->where('title','total_no_of_buildings')->value('amount');

        $action = '';
        $master = OlApplicationMaster::where('id',$ol_application->application_master_id)->value('title');
        if ($master == 'New - Offer Letter'){
            $action = '.action';
            $folder1 = 'REE_department.action';
        }elseif($master = 'Revalidation Of Offer Letter'){
            $action = '.reval_action';
            $folder1 = 'REE_department.reval_action';
        }    
        //latest calculation data
        $custom = OlCustomCalculationSheet::where('application_id',$applicationId)->first();
        $premium = OlApplicationCalculationSheetDetails::where('application_id',$applicationId)->first(); 
        $fsiCalculation = OlFsiCalculationSheet::where('application_id',$applicationId)->first(); 

        if (isset($custom) || isset($premium) || isset($fsiCalculation)){
            $exists = 1;
        }
        if ($selectedFSI == '3 FSI'){
            $route = 'admin.REE_department.calculation_sheet';
            $FSI = '3 FSI';
            $calculationSheetDetails = $user->calculationSheetDetails;
        }else if ($selectedFSI == '2.5 FSI'){
            $route = 'admin.REE_department.fsi_calculation_sheet';
            $FSI = '2.5 FSI';
            $calculationSheetDetails = $fsiCalculation;
        }else{
            $route = 'admin.REE_department.custom_premium_calculation_sheet';
            $FSI = 'Custom';
        }

        $concessionData = $this->getConcessionDetails($applicationId);
        //get total house (6.2) from EE scrutiny demarcation 
        $totalHouse = OlDemarcationVerificationDetails::where('application_id',$applicationId)->select(DB::raw('sum(residential + non_residential) as total'))->value('total');

        $landArea = OlDemarcationLandArea::where('application_id',$applicationId)->first();

        return view($route,compact('calculationSheetDetails','applicationId','user','dcr_rates','arrData','ol_application','summary','status','reeNote','folder','buldingNumber','action','FSI','folder1','master','exists','totalHouse','landArea','concessionData'));
    }

    public function showRevalCalculationSheet($id)
    {
        $applicationId = $id;
        $user = $this->CommonController->showCalculationSheet($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId); 

        $this->getCustomCalculationData($ol_application,$applicationId);
        $summary = $this->getSummaryData($applicationId);

         $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $calculationSheetDetails = $user->calculationSheetDetails;
        $dcr_rates = $user->dcr_rates;
        $blade = $user->blade;
        $arrData['reeNote'] = $user->areeNote;

        //latest calculation data
        $custom = OlCustomCalculationSheet::where('application_id',$applicationId)->first();
        $premium = OlApplicationCalculationSheetDetails::where('application_id',$applicationId)->first(); 
        $fsiCalculation = OlFsiCalculationSheet::where('application_id',$applicationId)->first(); 

        if ($fsiCalculation){
            $route = 'admin.REE_department.view_fsi_calculation_sheet';
            $calculationSheetDetails = $fsiCalculation;
        }else if ($custom) {
            $route = 'admin.REE_department.view_custom_premium_calculation_sheet';
        }else {
           $route = 'admin.common.'.$blade; 
           $calculationSheetDetails = $user->calculationSheetDetails;
        }

        $action = '';
        $master = OlApplicationMaster::where('id',$ol_application->application_master_id)->value('title');
        if ($master == 'New - Offer Letter'){
            $action = '.action';
        }elseif($master = 'Revalidation Of Offer Letter'){
            $action = '.reval_action';
        }

        $folder = $this->getCurrentRoleFolderName();
        $status = $this->CommonController->getCurrentStatus($applicationId); 
        $reeNote = REENote::where('application_id',$applicationId)->orderBy('id','DESC')->first(); 

        $ol_application->folder = $folder;
        $buldingNumber = OlCustomCalculationSheet::where('application_id',$applicationId)
            ->where('title','total_no_of_buildings')->value('amount');
        return view($route,compact('calculationSheetDetails','applicationId','user','dcr_rates','arrData','ol_application','summary','status','reeNote','folder','buldingNumber','action'));

        //echo "<pre>";print_r($ol_application);exit;
        // $ol_application->folder = 'REE_department';
        // $folder = 'REE_department';
        // $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        // $calculationSheetDetails = $user->calculationSheetDetails;
        // $dcr_rates = $user->dcr_rates;
        // $blade = $user->blade;
        // $arrData['reeNote'] = $user->areeNote;

            
        // return view('admin.common.'.$blade,compact('calculationSheetDetails','applicationId','user','dcr_rates','arrData','ol_application','folder'));

    }
    
    public function getCurrentRoleFolderName(){

        if (session()->get('role_name') == config('commanConfig.co_engineer')) {
            $folder = 'co_department';

        }else if (session()->get('role_name') == config('commanConfig.ree_junior') || session()->get('role_name') == config('commanConfig.ree_deputy_engineer') || session()->get('role_name') == config('commanConfig.ree_assistant_engineer') || session()->get('role_name') == config('commanConfig.ree_branch_head')) {
            $folder = 'REE_department';

        } else if (session()->get('role_name') == config('commanConfig.cap_engineer')) {
            $folder = 'cap_department';
        }  else if (session()->get('role_name') == config('commanConfig.vp_engineer')) {
            $folder = 'vp_department';
        } 
        return $folder;

    }


    public function revalidationApplicationList(Request $request, Datatables $datatables){
        $getData = $request->all();
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address','class' => 'datatable-address', 'searchable' => false],
            // ['data' => 'model','name' => 'model','title' => 'Model'],
            ['data' => 'Status','name' => 'Status','title' => 'Status'],
            ['data' => 'radio','name' => 'radio','title' => 'Action','searchable' => false],

            // ['data' => 'Model','name' => 'Model','title' => 'Model'],
            // ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];
        if ($datatables->getRequest()->ajax()) {

            //dd($request);
            $ree_application_data = $this->CommonController->listApplicationData($request,'reval');
            // dd($ree_application_data);
            // $ol_application = $this->CommonController->getOlApplication($ree_application_data->id);

            return $datatables->of($ree_application_data)
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++; return $i;
                })
                ->editColumn('radio', function ($ree_application_data) {
                    $url = route('ree.view_reval_application', $ree_application_data->id);
                    return '<div class="d-flex btn-icon-list"><a href="'.$url.'" onclick="geturl(this.value);" name="village_data_id" class="d-flex flex-column align-items-left"><span class="btn-icon btn-icon--view">
                        <img src="'. asset("img/view-icon.svg").'">
                    </span>View</span></a></div>';
                })
                ->editColumn('eeApplicationSociety.name', function ($ree_application_data) {
                    return $ree_application_data->eeApplicationSociety->name;
                })
                ->editColumn('eeApplicationSociety.building_no', function ($ree_application_data) {
                    return $ree_application_data->eeApplicationSociety->building_no;
                })
                ->editColumn('eeApplicationSociety.address', function ($ree_application_data) {
                    return "<span>".$ree_application_data->eeApplicationSociety->address."</span>";
                })
                ->editColumn('date', function ($ree_application_data) {
                    return date(config('commanConfig.dateFormat'), strtotime($ree_application_data->submitted_at));
                })
                // ->editColumn('actions', function ($ree_application_data) use($request){
                //    return view('admin.REE_department.action', compact('ree_application_data', 'request'))->render();
                // })
                ->editColumn('Status', function ($listArray) use ($request) {
                    $status = $listArray->olApplicationStatusForLoginListing[0]->status_id;

                    if ($request->update_status)
                    {
                        if ($request->update_status == $status){
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
                // ->editColumn('Model', function ($ree_application_data) {
                //          return $ree_application_data->ol_application_master->model;
                //      })hya
                ->rawColumns(['radio','society_name', 'building_name', 'society_address','date','Status','eeApplicationSociety.address'])
                ->make(true);
        }
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.REE_department.reval_applications', compact('html','header_data','getData'));
    }

    public function viewRevalApplication(Request $request, $applicationId){

        $ol_application = $this->CommonController->downloadOfferLetter($applicationId);
        $ol_application->folder = 'REE_department';

        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();

        return view('admin.common.reval_offer_letter', compact('ol_application'));
    }

    public function societyRevalDocuments(Request $request,$applicationId){

        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $societyDocument = $this->CommonController->getRevalSocietyREEDocuments($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();

        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);
        return view('admin.REE_department.society_reval_documents', compact('societyDocument','ol_application'));
    }

    //calculations option with formula and custom
    public function displayCalculationSheetOptions(Request $request,$applicationId){
        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->model=OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();

        //latest calculation datae;
        $custom = OlCustomCalculationSheet::where('application_id',$applicationId)->first();
        $premium = OlApplicationCalculationSheetDetails::where('application_id',$applicationId)->first(); 
        $fsiCalculation = OlFsiCalculationSheet::where('application_id',$applicationId)->first(); 

        if (isset($premium) || isset($custom) || isset($fsiCalculation)){
            $applicationId = encrypt($applicationId);
            return redirect()->route('ree.show_calculation_sheet',$applicationId);
        }else{
            return view('admin.REE_department.show_calculation_sheet',compact('ol_application'));
        }   
    }

    // display custom calculation sheet for premium
    public function displayCustomCalculationSheet(Request $request,$applicationId){
        
        $user = Auth::user(); 
        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();

        $table1Id = OlCustomCalculationMasterModel::where('name','Calculation_Table-A')->value('id');
        $table2Id = OlCustomCalculationMasterModel::where('name','Part_Payment')->value('id');
        $table3Id = OlCustomCalculationMasterModel::where('name','1st_Installment')->value('id');
        $table4Id = OlCustomCalculationMasterModel::where('name','remaining_Installment')->value('id');
        
        $ol_application->table1 = OlCustomCalculationSheet::where('application_id',$applicationId)
        ->where('parent_id',$table1Id)->get()->toArray();        
        $ol_application->table2 = OlCustomCalculationSheet::where('application_id',$applicationId)
        ->where('parent_id',$table2Id)->get()->toArray();
        $ol_application->table3 = OlCustomCalculationSheet::where('application_id',$applicationId)
        ->where('parent_id',$table3Id)->get()->toArray();
        $ol_application->table4 = OlCustomCalculationSheet::where('application_id',$applicationId)
        ->where('parent_id',$table4Id)->get()->toArray();
        $summary = $this->getSummaryData($applicationId);
        $status = $this->CommonController->getCurrentStatus($applicationId);
        $reeNote = REENote::where('application_id',$applicationId)->orderBy('id','DESC')->first(); 

        $buldingNumber = OlCustomCalculationSheet::where('application_id',$applicationId)
            ->where('title','total_no_of_buildings')->value('amount');    
         
        if (session()->get('role_name') == config('commanConfig.ree_junior') && ($status->status_id == config('commanConfig.applicationStatus.offer_letter_generation') || ($status->status_id == config('commanConfig.applicationStatus.in_process')) || $status->status_id == config('commanConfig.applicationStatus.draft_offer_letter_generated') || $status->status_id == config('commanConfig.applicationStatus.offer_letter_approved'))) {
             $route = 'admin.REE_department.custom_premium_calculation_sheet';
        }  else{
            $route = 'admin.REE_department.view_custom_premium_calculation_sheet';
        }

        $custom = OlCustomCalculationSheet::where('application_id',$applicationId)->first();
        $premium = OlApplicationCalculationSheetDetails::where('application_id',$applicationId)->first(); 
        $fsiCalculation = OlFsiCalculationSheet::where('application_id',$applicationId)->first(); 
        $forward = config('commanConfig.applicationStatus.forwarded');

        $exists = 0; 
        $FSI = 'Custom';
        if (isset($custom) || isset($premium) || isset($fsiCalculation)){
            $exists = 1;
        }

         $folder1 = '';
        $master = OlApplicationMaster::where('id',$ol_application->application_master_id)->value('title');
        if ($master == 'New - Offer Letter'){
            $folder1 = 'REE_department.action';
            $action = '.action';
        }elseif($master = 'Revalidation Of Offer Letter'){
            $folder1 = 'REE_department.reval_action';
            $action = '.reval_action';
        }
        $concessionData = $this->getConcessionDetails($applicationId);
        $folder = $this->getCurrentRoleFolderName();
        return view($route,compact('ol_application','user','summary','status','reeNote','buldingNumber','folder1','folder','master','action','exists','applicationId','FSI','concessionData')); 
    }

    public function getCustomCalculationData($data,$applicationId){

        $table1Id = OlCustomCalculationMasterModel::where('name','Calculation_Table-A')->value('id');
        $table2Id = OlCustomCalculationMasterModel::where('name','Part_Payment')->value('id');
        $table3Id = OlCustomCalculationMasterModel::where('name','1st_Installment')->value('id');
        $table4Id = OlCustomCalculationMasterModel::where('name','remaining_Installment')->value('id');
        
        $data->table1 = OlCustomCalculationSheet::where('application_id',$applicationId)
        ->where('parent_id',$table1Id)->get()->toArray();        
        $data->table2 = OlCustomCalculationSheet::where('application_id',$applicationId)
        ->where('parent_id',$table2Id)->get()->toArray();
        $data->table3 = OlCustomCalculationSheet::where('application_id',$applicationId)
        ->where('parent_id',$table3Id)->get()->toArray();
        $data->table4 = OlCustomCalculationSheet::where('application_id',$applicationId)
        ->where('parent_id',$table4Id)->get()->toArray(); 

        return $data;    
    }

    public function getSummaryData($applicationId){
        
        $summary = array();
        $table5Id = OlCustomCalculationMasterModel::where('name','Summary')->value('id');
        $summary['within_6months'] = OlCustomCalculationSheet::where('application_id',$applicationId)
        ->where('parent_id',$table5Id)->where('title','=','within_6months')->value('amount');        
        $summary['within_1year'] = OlCustomCalculationSheet::where('application_id',$applicationId)
        ->where('parent_id',$table5Id)->where('title','=','within_1year')->value('amount');        
        $summary['within_2year'] = OlCustomCalculationSheet::where('application_id',$applicationId)
        ->where('parent_id',$table5Id)->where('title','=','within_2year')->value('amount');        
        $summary['within_3year'] = OlCustomCalculationSheet::where('application_id',$applicationId)
        ->where('parent_id',$table5Id)->where('title','=','within_3year')->value('amount');        
        $summary['total']        = OlCustomCalculationSheet::where('application_id',$applicationId)
        ->where('parent_id',$table5Id)->where('title','=','total')->value('amount');

        return $summary;
    }

    // public function getLatestCalculationData($applicationId){


    // }
 
    public function saveCustomCalculationData(Request $request){

        $applicationId = $request->application_id;
        $society_id = OlApplication::where('id',$applicationId)->value('society_id');
        
        if ($request->total_no_of_buildings){

            $buldingNumber = OlCustomCalculationSheet::where('application_id',$applicationId)
            ->where('title','total_no_of_buildings')
            ->where('user_id',Auth::id())->first();    
            
            if(!isset($buldingNumber)){
                $buldingNumber = new OlCustomCalculationSheet();
            }

            $buldingNumber->application_id =  $applicationId;      
            $buldingNumber->society_id =  $society_id;      
            $buldingNumber->user_id =  Auth::id();      
            $buldingNumber->title =  'total_no_of_buildings';      
            $buldingNumber->amount =  $request->total_no_of_buildings; 
            $buldingNumber->save(); 
        } 

        $tableData  = "";  $parentId = ""; $calculationData = ""; $deletedIds = ""; 
        
        if ($request->table1){
            $tableData = $request->table1; 
            $parentId = OlCustomCalculationMasterModel::where('name','Calculation_Table-A')->value('id'); 

        }else if($request->table2){

            $tableData = $request->table2; 
            $parentId = OlCustomCalculationMasterModel::where('name','Part_Payment')->value('id');


        }else if($request->table3){
        
            $tableData = $request->table3;
            $parentId = OlCustomCalculationMasterModel::where('name','1st_Installment')->value('id');

        }else if($request->table4){

            $tableData = $request->table4; 
            $parentId = OlCustomCalculationMasterModel::where('name','remaining_Installment')->value('id');

        }else if($request->table5){
            $tableData = $request->table5; 
            $parentId = OlCustomCalculationMasterModel::where('name','Summary')->value('id');
        }
        
        if ($request->table1_deletedIds){
            $deletedIds = explode("#",$request->table1_deletedIds);

        }elseif($request->table2_deletedIds){
            $deletedIds = explode("#",$request->table2_deletedIds);

        }elseif($request->table3_deletedIds){
            $deletedIds = explode("#",$request->table3_deletedIds);

        }elseif($request->table4_deletedIds){
            $deletedIds = explode("#",$request->table4_deletedIds);
        }

        if ($deletedIds != ""){
            OlCustomCalculationSheet::whereIn('id',$deletedIds)->delete();   
        }
       
        if ($tableData != ""){
            foreach($tableData as $data){
                
                if (isset($data['title']) && isset($data['amount'])){

                    if($request->table5){

                      $calculationData = OlCustomCalculationSheet::where('application_id',$applicationId)
                        ->where('user_id',Auth::id())->where('parent_id',$parentId)
                        ->where('title',$data['title'])->first(); 
                    }
                    
                    else if(isset($data['hiddenId'])){

                        $calculationData = OlCustomCalculationSheet::where('id',$data['hiddenId'])
                        ->where('application_id',$applicationId)
                        ->where('user_id',Auth::id())->where('parent_id',$parentId)->first();
                    
                    } 
                    else{
                         $calculationData = new OlCustomCalculationSheet();
                    }
                    if (!isset($calculationData)){
                        $calculationData = new OlCustomCalculationSheet();
                    }

                    $calculationData->application_id = $applicationId;
                    $calculationData->society_id     = $society_id;
                    $calculationData->user_id        = Auth::id();
                    $calculationData->parent_id      = $parentId;
                    $calculationData->title          = $data['title'];
                    $calculationData->amount         = $data['amount'];

                    DB::beginTransaction();
                    try{
                        $calculationData->save(); 
                        OlApplication::where('id',$applicationId)->update(['drafted_offer_letter' => NULL, 'text_offer_letter' => NULL, 'offer_letter_document_path' => NULL]);
                        OlFsiCalculationSheet::where('application_id',$applicationId)->delete();
                        OlApplicationCalculationSheetDetails::where('application_id',$applicationId)->delete();
                        DB::commit();
                    }catch(\Exception $ex){
                        DB::rollback();
                    }                     
                }                
            }
        }
        $applicationId = encrypt($applicationId);
        return redirect("custom_calculation_sheet/" .$applicationId."#".$request->get('redirect_tab'));
    }

    public function nocApplicationList(Request $request, Datatables $datatables)
    {
        $getData = $request->all();
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address','class' => 'datatable-address', 'searchable' => false],
            ['data' => 'Model','name' => 'Model','title' => 'Application Type'],
            ['data' => 'Status','name' => 'Status','title' => 'Status'],
            ['data' => 'radio','name' => 'radio','title' => 'Action','searchable' => false],

        ];
        if ($datatables->getRequest()->ajax()) {
            $noc_application_data = $this->CommonController->listApplicationDataNoc($request);
              
            return $datatables->of($noc_application_data)
                ->editColumn('rownum', function ($listArray) {
                     static $i = 0; $i++; return $i;
                })
            ->editColumn('radio', function ($noc_application_data) {
                $url = route('ree.view_application_noc', $noc_application_data->id);
                return '<div class="d-flex btn-icon-list"><a href="'.$url.'" onclick="geturl(this.value);" name="village_data_id" class="d-flex flex-column align-items-left"><span class="btn-icon btn-icon--view">
                        <img src="'. asset("img/view-icon.svg").'">
                    </span>View</span></a></div>';
            })
            ->editColumn('eeApplicationSociety.name', function ($noc_application_data) {
                return $noc_application_data->eeApplicationSociety->name;
            })
            ->editColumn('eeApplicationSociety.building_no', function ($noc_application_data) {
                return $noc_application_data->eeApplicationSociety->building_no;
            })
            ->editColumn('eeApplicationSociety.address', function ($noc_application_data) {
                return "<span>".$noc_application_data->eeApplicationSociety->address."</span>";
            })                
            ->editColumn('date', function ($noc_application_data) {
                return date(config('commanConfig.dateFormat'), strtotime($noc_application_data->submitted_at));
            })
            // ->editColumn('actions', function ($ree_application_data) use($request){
            //    return view('admin.REE_department.action', compact('ree_application_data', 'request'))->render();
            // }) 
            ->editColumn('Status', function ($listArray) use ($request) {
                $status = $listArray->nocApplicationStatusForLoginListing[0]->status_id;

                if ($request->update_status)
                {
                    if ($request->update_status == $status){
                        $config_array = array_flip(config('commanConfig.applicationStatus'));
                        $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                        if($value == 'NOC Issued')
                        {
                            $value = 'NOC Approved';
                        }
                        return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$status) .' m-badge--wide">'.$value.'</span>';
                    }
                }else{
                    $config_array = array_flip(config('commanConfig.applicationStatus'));
                    $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                    if($value == 'NOC Issued')
                    {
                        $value = 'NOC Approved';
                    }
                    return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$status) .' m-badge--wide">'.$value.'</span>';
                }

            })
           ->editColumn('Model', function ($noc_application_data) {

               $application_type = '';
               $type = $noc_application_data->noc_application_master->ol_application_type[0]->title;
               if (strpos($type, 'Self') !== false) {
                   $application_type = 'Self';
               }elseif(strpos($type, 'Developer') !== false){
                   $application_type = 'Through Developer';
               }else{
                   $application_type = '-';
               }
               return $application_type."\n".'('.$noc_application_data->noc_application_master->model.')' ;

//                    return $noc_application_data->noc_application_master->model;
                })
            ->rawColumns(['radio','society_name', 'building_name', 'society_address','date','Status','eeApplicationSociety.address'])
            ->make(true);
        }        
            $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
            
        return view('admin.REE_department.noc_list', compact('html','header_data','getData')); 
    }

    public function viewApplicationNoc(Request $request, $applicationId){

        $noc_application = $this->CommonController->downloadNoc($applicationId);
        $noc_application->folder = 'REE_department';

        $noc_application->model = NocApplication::with(['noc_application_master'])->where('id',$applicationId)->first();
        
        return view('admin.common.noc', compact('noc_application'));
    }

    public function societyNocDocuments(Request $request,$applicationId){
        
        $noc_application = $this->CommonController->getNocApplication($applicationId);
        $noc_application->model = NocApplication::with(['noc_application_master'])->where('id',$applicationId)->first();
        $societyDocuments = $this->CommonController->getSocietyNocDocuments($applicationId);
        $comments = $this->CommonController->getNOCApplicationComments($applicationId);

       return view('admin.REE_department.society_noc_documents',compact('noc_application','societyDocuments','comments'));
    }

    public function GenerateNoc(Request $request, $applicationId){
        
        $noc_application = $this->CommonController->getNocApplication($applicationId);
        $noc_application->model = NocApplication::with(['noc_application_master'])->where('id',$applicationId)->first();
        $applicationLog = $this->CommonController->getCurrentStatusNoc($applicationId);
        $societyData = NocApplication::with(['eeApplicationSociety'])
                ->where('id',$applicationId)->orderBy('id','DESC')->first();

        $societyData->ree_Jr_id = (session()->get('role_name') == config('commanConfig.ree_junior')); 
        $societyData->ree_branch_head = (session()->get('role_name') == config('commanConfig.ree_branch_head')); 

        //$societyData->drafted_offer_letter = OlApplication::where('id',$applicationId)->value('drafted_offer_letter');   
      
        return view('admin.REE_department.generate-noc',compact('societyData','noc_application','applicationLog'));
    }

    public function createEditNoc(Request $request,$applicatonId){
        
        $custom = 0;
        $model = NocApplication::with('noc_application_master','eeApplicationSociety','request_form')->where('id',$applicatonId)->first();

        //calculation table
        $custom = OlCustomCalculationSheet::where('society_id',$model->society_id)->first();
        $premium = OlApplicationCalculationSheetDetails::where('society_id',$model->society_id)->first(); 
        $fsiCalculation = OlFsiCalculationSheet::where('society_id',$model->society_id)->first();                
        // dd($model->noc_application_master->model);
        if ($model->noc_application_master->model == 'Premium'){
            $blade =  "premum_noc_letter";

            if ($custom){
                $calculationData = $custom;
                $custom = 1;
            }else if($fsiCalculation){
                $calculationData = $fsiCalculation;
            }else{
                $calculationData = $premium;
            }
        }elseif($model->noc_application_master->model == 'Sharing'){
            $blade =  "sharing_iod_noc_letter";
            $calculationData = NOCSharingCalculationSheet::where('application_id',$applicatonId)->first();
        }

        if($model->draft_noc_text_path){

            $content = Storage::disk('ftp')->get($model->draft_noc_text_path); 
                   
        }else{
           $content = ""; 
        }
        
        $table1Id = OlCustomCalculationMasterModel::where('name','Calculation_Table-A')->value('id');       
        $table1 = OlCustomCalculationSheet::where('society_id',$model->society_id)
        ->where('parent_id',$table1Id)->get()->toArray();
        $data = NOCBuildupArea::where('application_id',$applicatonId)->first();
        // get athorities name as per layout
        $authority = $this->getAuthorityNames($model->layout_id); 
        $status = $this->getNOCApplicationStatus($applicatonId);
        $AuthoritySign = view('admin.REE_department.authority_sign',compact('authority','status'));
        
        return view('admin.REE_department.'.$blade,compact('applicatonId','content','model','calculationData','custom','table1','data','AuthoritySign','status'));
    }

    public function saveDraftNoc(Request $request){

        $noc_application = $this->CommonController->getNocApplication($request->applicationId);

        $id = $request->applicationId;
        $content = str_replace('_', "", $_POST['ckeditorText']);
        $folder_name = 'Draft_noc';

        // get athorities name as per layout
        $authority = $this->getAuthorityNames($noc_application->layout_id); 
        $status = $this->getNOCApplicationStatus($request->applicationId);

        $AuthoritySign = view('admin.REE_department.authority_sign',compact('authority','status'));
        $header_file = view('admin.REE_department.offer_letter_header');        
        $footer_file = view('admin.REE_department.offer_letter_footer');

        $pdf = new Mpdf();
        $pdf->autoScriptToLang = true;
        $pdf->autoLangToFont = true; 
        $pdf->WriteHTML($header_file.$content.$AuthoritySign.$footer_file);

        $fileName = time().'draft_noc_'.$id.'.pdf';
        $filePath = $folder_name."/".$fileName;

        if (!(Storage::disk('ftp')->has($folder_name))) {            
            Storage::disk('ftp')->makeDirectory($folder_name, $mode = 0777, true, true);
        } 
        Storage::disk('ftp')->put($filePath, $pdf->output($fileName, 'S'));
        // $file = $pdf->output();
        $folder_name1 = 'text_noc';

        if (!(Storage::disk('ftp')->has($folder_name1))) {            
            Storage::disk('ftp')->makeDirectory($folder_name1, $mode = 0777, true, true);
        }        
        $file_nm =  time()."text_noc".$id.'.txt';
        $filePath1 = $folder_name1."/".$file_nm;

        Storage::disk('ftp')->put($filePath1, $content);

        if ($status->status_id == config('commanConfig.applicationStatus.in_process') && session()->get('role_name') == config('commanConfig.ree_junior')){

            NocApplication::where('id',$request->applicationId)->update(["draft_noc_path" => $filePath, "draft_noc_text_path" => $filePath1]);  
            return redirect('generate_noc/'.$request->applicationId)->with('success', 'Changes in NOC has been incorporated successfully.');

        }else if ($status->status_id == config('commanConfig.applicationStatus.NOC_Issued') && session()->get('role_name') == config('commanConfig.ree_junior')) {

            NocApplication::where('id',$request->applicationId)->update(["draft_noc_path" => $filePath, "draft_noc_text_path" => $filePath1]);
            return redirect('approved_noc_letter/'.$request->applicationId)->with('success', 'Changes in NOC has been incorporated successfully.');
        }

        // \Session::flash('success_msg', 'Changes in Noc draft has been saved successfully..');

        // if((session()->get('role_name') == config('commanConfig.ree_junior')) && !empty($noc_application->final_draft_noc_path) && ($noc_application->noc_generation_status != config('commanConfig.applicationStatus.NOC_Issued')))
        // {
        //     return redirect('approved_noc_letter/'.$request->applicationId)->with('success', 'Changes in NOC has been incorporated successfully.');
        // }else{
        //     return redirect('generate_noc/'.$request->applicationId);
        // }

    }

    public function uploadDraftNoc(Request $request,$applicationId){
        if ($request->file('noc_letter')) {
            $file = $request->file('noc_letter');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'_uploaded_noc_'.$applicationId.'.'.$extension;
            $folder_name = "uploaded_noc";

            if ($extension == "pdf") {

                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('noc_letter'),$file_name);

                    $draftNocPath = $folder_name."/".$file_name; 
                    NocApplication::where('id',$applicationId)->update(["final_draft_noc_path" => $draftNocPath]);

                    return redirect()->back()->with('success', 'Draft copy of Noc has been uploaded successfully.');
            } else {
                return redirect()->back()->with('error', 'Invalid format. pdf file only.');
            }
        }       
    }

    public function scrutinyRemarkNocByREE($application_id)
    {
        $noc_application = $this->CommonController->getNocApplication($application_id);

        //get values from premium calculation nd FSI calculation table
        $calculation = OlApplicationCalculationSheetDetails::where('society_id',$noc_application->society_id)->select('area_of_tit_bit_plot','area_as_per_lease_agreement','permissible_carpet_area_coordinates','total_house','sqm_area_per_slot','permissible_proratata_area','area_in_reserved_seats_for_vp_pio')->first();

        if (isset($calculation)){
            $noc_application->OlCalculationSheet = $calculation;
        }else{
            $noc_application->OlCalculationSheet = OlFsiCalculationSheet::where('society_id',$noc_application->society_id)->select('area_of_tit_bit_plot','area_as_per_lease_agreement','permissible_carpet_area_coordinates','total_house','sqm_area_per_slot','permissible_proratata_area','area_in_reserved_seats_for_vp_pio')->first();
        }
        
        // dd($noc_application->society_id);
        $noc_application->status = $this->CommonController->getCurrentStatusNoc($application_id);

        $application_master_id = NocApplication::where('society_id', $noc_application->eeApplicationSociety->id)->value('application_master_id');

        $arrData['society_detail'] = NocApplication::with('eeApplicationSociety')->where('id', $application_id)->first();

        $arrData['scrutiny_questions_noc'] = NocSrutinyQuestionMaster::all();

        $arrData['scrutiny_answers_to_questions'] = NocReeScrutinyAnswer::where('application_id', $application_id)->get()->keyBy('question_id')->toArray();
/*
        // EE Note download

        $arrData['eeNote'] = EENote::where('application_id', $application_id)->orderBy('id', 'desc')->first();

        // Get Application last Status
        // dd($arrData);*/
        //dd($arrData['society_detail']);registration_no
        $arrData['get_last_status'] = NocApplicationStatus::where([
                'application_id' =>  $application_id,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id')
            ])->orderBy('id', 'desc')->first();

        $data = NOCBuildupArea::where('application_id',$application_id)->first();

        return view('admin.REE_department.scrutiny-remark-noc', compact('arrData','noc_application','data'));
    }

    public function nocScrutinyVerification(Request $request)
    {

        NocReeScrutinyAnswer::where('application_id', $request->application_id)->delete();


        foreach($request->question_id as $key => $consent_data) {
            $noc_verification_answers[] = [
                'application_id' => $request->application_id,
                'society_id' => $request->society_id,
                'user_id' => Auth::user()->id,
                'question_id' => isset($request->question_id[$key]) ? $request->question_id[$key] : NULL,
                'answer' => isset($request->answer[$key]) ? $request->answer[$key] : NULL,
                'remark' => isset($request->remark[$key]) ? $request->remark[$key] : NULL
            ];
        }
        // insert into ol_consent_verification_details table

        NocReeScrutinyAnswer::insert($noc_verification_answers);

        return redirect()->back()->with('success', 'Answers for scrutiny questions has been successfully submitted.');
    }

    public function uploadOfficeNoteNocRee(Request $request){
        $applicationId   = $request->application_id;
        $uploadPath      = '/uploads/ree_office_note_noc';
        $destinationPath = public_path($uploadPath);

        if ($request->file('ree_office_note_noc')){

            $file = $request->file('ree_office_note_noc');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'ree_office_note_noc.'.$extension;
            $folder_name = "ree_office_note_noc";
            $path = $folder_name."/".$file_name;

            if($extension == "pdf") {

                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('ree_office_note_noc'),$file_name);

                NocApplication::where('id',$applicationId)->update(["ree_office_note_noc" => $path]);

                return back()->with('success', 'Office Note has been uploaded successfully');
            }
            else
            {
                return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
            }
        }
    }

    public function forwardApplicationNoc(Request $request, $applicationId){

        $noc_application = $this->CommonController->getNocApplication($applicationId);
        $noc_application->model = NocApplication::with(['noc_application_master'])->where('id',$applicationId)->first();
        $applicationData = $this->CommonController->getForwardNocApplication($applicationId);

        $parentData = $this->CommonController->getForwardApplicationParentData();
        $arrData['parentData'] = $parentData['parentData'];
        $arrData['role_name'] = $parentData['role_name'];

//        $arrData['application_status'] = $this->CommonController->getCurrentApplicationStatus($applicationId);
        if(session()->get('role_name') != config('commanConfig.ree_junior'))
        $arrData['application_status'] = $this->CommonController->getCurrentLoggedInChildNoc($applicationId);

        $arrData['get_current_status'] = $this->CommonController->getCurrentStatusNoc($applicationId);

        // CO Forward Application

        $co_id = Role::where('name', '=', config('commanConfig.co_engineer'))->first();
       
        if(isset($arrData['get_current_status']) && $arrData['get_current_status']->status_id != config('commanConfig.applicationStatus.NOC_Issued'))
        {
            $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
            $layout_ids = array_column($layout_id_array, 'layout_id');
            $arrData['get_forward_co'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                                ->whereIn('lu.layout_id', $layout_ids)
                                ->where('role_id', $co_id->id)->groupBy('users.id')->get();
            $arrData['co_role_name'] = strtoupper(str_replace('_', ' ', $co_id->name));
        }
        //remark and history
        // $reeLogs  = $this->CommonController->getLogsOfREEDepartmentForNOC($applicationId); 
        // $coLogs   = $this->CommonController->getLogsOfCODepartmentForNOC($applicationId); 
        $remarkHistory= $this->CommonController->getNOCRemarkHistory($applicationId); 
        return view('admin.REE_department.forward_application_noc',compact('applicationData','arrData','noc_application','reeLogs','coLogs','remarkHistory'));  
    }

    public function sendForwardNocApplication(Request $request){
        $noc_application = $this->CommonController->getNocApplication($request->applicationId);

        $arrData['get_current_status'] = $this->CommonController->getCurrentStatusNoc($request->applicationId);

        if(session()->get('role_name') == config('commanConfig.ree_junior') && $noc_application->noc_generation_status == 0 && !empty($noc_application->final_draft_noc_path))
        {
//            dd('1');
            NocApplication::where('id',$request->applicationId)->update(["noc_generation_status" => config('commanConfig.applicationStatus.NOC_Generation')]);

            $noc_application = $this->CommonController->getNocApplication($request->applicationId);
        }

        if($noc_application->noc_generation_status == '0' && (session()->get('role_name') == config('commanConfig.ree_branch_head')) && empty($noc_application->final_draft_noc_path))
        {
//            dd('2');
            $this->CommonController->revertNocApplicationToSociety($request);
        }
        elseif($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.NOC_Generation') || ($noc_application->noc_generation_status == config('commanConfig.applicationStatus.NOC_Generation') && session()->get('role_name') == config('commanConfig.ree_junior')))
        {
//            dd('3');
            $this->CommonController->generateNOCREE($request);
        }
        elseif($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.NOC_Issued'))
        {
//            dd('4');
             $this->CommonController->forwardApprovedNocApplication($request);
        }
        else
        {
//            dd('5');
            $this->CommonController->forwardNocApplicationForm($request);
        }

        return redirect('/ree_noc_applications')->with('success','Application send successfully.');

    }

    public function approvedNOCletter(Request $request,$applicationId){

        $ree_head = session()->get('role_name') == config('commanConfig.ree_branch_head'); 
        $noc_application = $this->CommonController->getNocApplication($applicationId);
        $noc_application->model = NocApplication::with(['noc_application_master'])->where('id',$applicationId)->first();
        $applicationData = NocApplication::with(['eeApplicationSociety'])
                ->where('id',$applicationId)->orderBy('id','DESC')->first();

        $applicationData->ree_Jr_id = (session()->get('role_name') == config('commanConfig.ree_junior'));

        $this->CommonController->getREEForwardRevertLogNoc($applicationData,$applicationId); 
       
       // get Co log
        $co = Role::where('name',config('commanConfig.co_engineer'))->value('id');
        $applicationData->coLog = NocApplicationStatus::where('application_id',$applicationId)->where('role_id',$co)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();
        $status = $this->getNOCApplicationStatus($applicationId);   

        return view('admin.REE_department.approved_noc_cert',compact('applicationData','noc_application','ree_head','status'));
    }

    public function sendissuedNOCToSociety(Request $request){

        $this->CommonController->forwardNocApplicationToSociety($request);
        return redirect('/ree_noc_applications')->with('success','Issued Noc has been successfully sent to society.');
        
    }

    public function nocforCCApplicationList(Request $request, Datatables $datatables)
    {
        $getData = $request->all();
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address','class' => 'datatable-address', 'searchable' => false],
            ['data' => 'Model','name' => 'Model','title' => 'Application Type'],
            ['data' => 'Status','name' => 'Status','title' => 'Status'],
            ['data' => 'radio','name' => 'radio','title' => 'Action','searchable' => false],

        ];
        $noc_application_data = $this->CommonController->listApplicationDataNocforCC($request);
        if ($datatables->getRequest()->ajax()) {
            $noc_application_data = $this->CommonController->listApplicationDataNocforCC($request);
              
            return $datatables->of($noc_application_data)
                ->editColumn('rownum', function ($listArray) {
                     static $i = 0; $i++; return $i;
                })
            ->editColumn('eeApplicationSociety.name', function ($noc_application_data) {
                return $noc_application_data->eeApplicationSociety->name;
            })
            ->editColumn('eeApplicationSociety.building_no', function ($noc_application_data) {
                return $noc_application_data->eeApplicationSociety->building_no;
            })
            ->editColumn('eeApplicationSociety.address', function ($noc_application_data) {
                return "<span>".$noc_application_data->eeApplicationSociety->address."</span>";
            })                
            ->editColumn('date', function ($noc_application_data) {
                return date(config('commanConfig.dateFormat'), strtotime($noc_application_data->submitted_at));
            })
            // ->editColumn('actions', function ($ree_application_data) use($request){
            //    return view('admin.REE_department.action', compact('ree_application_data', 'request'))->render();
            // }) 
            ->editColumn('Status', function ($listArray) use ($request) {
                $status = $listArray->nocApplicationStatusForLoginListing[0]->status_id;

                if ($request->update_status)
                {
                    if ($request->update_status == $status){
                        $config_array = array_flip(config('commanConfig.applicationStatus'));
                        $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                        if($value == 'NOC Issued')
                        {
                            $value = 'NOC Approved';
                        }
                        return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$status) .' m-badge--wide">'.$value.'</span>';
                    }
                }else{
                    $config_array = array_flip(config('commanConfig.applicationStatus'));
                    $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                    if($value == 'NOC Issued')
                    {
                        $value = 'NOC Approved';
                    }
                    return '<span class="m-badge m-badge--'. config('commanConfig.applicationStatusColor.'.$status) .' m-badge--wide">'.$value.'</span>';
                }

            })
            ->editColumn('Model', function ($noc_application_data) {
                $application_type = '';
                $type = $noc_application_data->noc_application_master->ol_application_type[0]->title;
                if (strpos($type, 'Self') !== false) {
                    $application_type = 'Self';
                }elseif(strpos($type, 'Developer') !== false){
                    $application_type = 'Through Developer';
                }else{
                    $application_type = '-';
                }
                return $application_type."\n".'('.$noc_application_data->noc_application_master->model.')' ;


//                    return $noc_application_data->noc_application_master->model;
                })
            ->editColumn('radio', function ($noc_application_data) {
                    $url = route('ree.view_application_noc_cc', $noc_application_data->id);
                    return '<div class="d-flex btn-icon-list"><a href="'.$url.'" onclick="geturl(this.value);" name="village_data_id" class="d-flex flex-column align-items-left"><span class="btn-icon btn-icon--view">
                        <img src="'. asset("img/view-icon.svg").'">
                    </span>View</span></a></div>';
                })
                ->rawColumns(['radio','society_name', 'building_name', 'society_address','date','Status','eeApplicationSociety.address'])
            ->make(true);
        }        
            $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
            
        return view('admin.REE_department.noc_cc_list', compact('html','header_data','getData')); 
    }

    public function viewApplicationNocforCC(Request $request, $applicationId){

        $noc_application = $this->CommonController->downloadNocforCC($applicationId);
        $noc_application->folder = 'REE_department';

        $noc_application->model = NocCCApplication::with(['noc_application_master'])->where('id',$applicationId)->first();
        
        return view('admin.common.noc_cc', compact('noc_application'));
    }

    public function societyNocforCCDocuments(Request $request,$applicationId){
        
        $noc_application = $this->CommonController->getNocforCCApplication($applicationId);
        $noc_application->model = NocCCApplication::with(['noc_application_master'])->where('id',$applicationId)->first();
        $societyDocuments = $this->CommonController->getSocietyNocCCDocuments($applicationId);

       return view('admin.REE_department.society_noc_cc_documents',compact('noc_application','societyDocuments'));
    }

    public function GenerateNocforCC(Request $request, $applicationId){
        
        $noc_application = $this->CommonController->getNocforCCApplication($applicationId);
        $noc_application->model = NocCCApplication::with(['noc_application_master'])->where('id',$applicationId)->first();
        $applicationLog = $this->CommonController->getCurrentStatusNocforCC($applicationId);
        $societyData = NocCCApplication::with(['eeApplicationSociety'])
                ->where('id',$applicationId)->orderBy('id','DESC')->first();

        $societyData->ree_Jr_id = (session()->get('role_name') == config('commanConfig.ree_junior')); 
        $societyData->ree_branch_head = (session()->get('role_name') == config('commanConfig.ree_branch_head')); 

        //$societyData->drafted_offer_letter = OlApplication::where('id',$applicationId)->value('drafted_offer_letter');   
      
        return view('admin.REE_department.generate-noc-cc',compact('societyData','noc_application','applicationLog'));
    }

    public function createEditNocforCC(Request $request,$applicatonId){
        
        $model = NocCCApplication::with('noc_application_master','eeApplicationSociety','request_form')->where('id',$applicatonId)->first();

        $blade =  "sharing_noc_cc_letter";

        if($model->draft_noc_text_path){

            $content = Storage::disk('ftp')->get($model->draft_noc_text_path); 
                   
        }else{
           $content = ""; 
        }

        return view('admin.REE_department.'.$blade,compact('applicatonId','content','model'));
    }

    public function saveDraftNocforCC(Request $request){

        $noc_application = $this->CommonController->getNocforCCApplication($request->applicationId);

        $id = $request->applicationId;
        $content = str_replace('_', "", $_POST['ckeditorText']);
        $folder_name = 'Draft_noc_cc';

        /*$header_file = view('admin.REE_department.offer_letter_header');
        $footer_file = view('admin.REE_department.offer_letter_footer');*/
//        $header_file = '';
//        $footer_file = '';

        $header_file = view('admin.REE_department.offer_letter_header');
        $footer_file = view('admin.REE_department.offer_letter_footer');
//
        $pdf = new Mpdf();
        $pdf->autoScriptToLang = true;
        $pdf->autoLangToFont = true;
//        $pdf->setAutoBottomMargin = 'stretch';
//        $pdf->setAutoTopMargin = 'stretch';
//        $pdf->SetHTMLHeader($header_file);
//        $pdf->SetHTMLFooter($footer_file);
//        $pdf->WriteHTML($content);

//        dd($content);
        $pdf->WriteHTML($header_file.$content.$footer_file);

//        $pdf = \App::make('dompdf.wrapper');

//        $pdf->loadHTML($header_file.$content.$footer_file);

        $fileName = time().'draft_noc_cc_'.$id.'.pdf';
        $filePath = $folder_name."/".$fileName;

        if (!(Storage::disk('ftp')->has($folder_name))) {
            Storage::disk('ftp')->makeDirectory($folder_name, $mode = 0777, true, true);
        }
        Storage::disk('ftp')->put($filePath, $pdf->output($fileName,'S'));
//        $file = $pdf->output();

        $folder_name1 = 'text_noc_cc';

        if (!(Storage::disk('ftp')->has($folder_name1))) {
            Storage::disk('ftp')->makeDirectory($folder_name1, $mode = 0777, true, true);
        }
        $file_nm =  time()."text_noc_cc".$id.'.txt';
        $filePath1 = $folder_name1."/".$file_nm;

        Storage::disk('ftp')->put($filePath1, $content);

        NocCCApplication::where('id',$request->applicationId)->update(["draft_noc_path" => $filePath, "draft_noc_text_path" => $filePath1]);

        if($noc_application->draft_noc_text_path == null){
            \Session::flash('success', 'NOC CC draft has been saved successfully.');

        }else{
            \Session::flash('success', 'Changes in NOC CC draft has been saved successfully.');
        }

        if((session()->get('role_name') == config('commanConfig.ree_junior')) && !empty($noc_application->final_draft_noc_path) && ($noc_application->noc_generation_status == config('commanConfig.applicationStatus.NOC_Issued')))
        {
            //dump('REE');
            return redirect('approved_noc_cc_letter/'.$request->applicationId)->with('success', 'Changes in NOC has been incorporated successfully.');
        }

        return redirect('generate_noc_cc/'.$request->applicationId);
    }

    public function uploadDraftNocforCC(Request $request,$applicationId){

        if ($request->file('noc_letter')) {
            $file = $request->file('noc_letter');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'_uploaded_noc_cc_'.$applicationId.'.'.$extension;
            $folder_name = "uploaded_noc_cc";

            if ($extension == "pdf") {

                $nocCCData = NocCCApplication::where('id',$applicationId)->first();
                if($nocCCData->draft_noc_text_path != null){
                    $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('noc_letter'),$file_name);

                    $draftNocPath = $folder_name."/".$file_name;
                    NocCCApplication::where('id',$applicationId)->update(["final_draft_noc_path" => $draftNocPath]);

                    return redirect()->back()->with('success', 'Copy of NOC-CC has been uploaded successfully.');
                }
                else{
                    return redirect()->back()->with('error', 'Draft copy of Noc CC has not been generated.');
                }

            } else {
                return redirect()->back()->with('error', 'Invalid format. pdf file only.');
            }
        }       
    }

    public function scrutinyRemarkNocforCCByREE($application_id)
    {
        $noc_application = $this->CommonController->getNocforCCApplication($application_id);
        $noc_application->status = $this->CommonController->getCurrentStatusNocforCC($application_id);

        $application_master_id = NocCCApplication::where('society_id', $noc_application->eeApplicationSociety->id)->value('application_master_id');

        $arrData['society_detail'] = NocCCApplication::with('eeApplicationSociety')->where('id', $application_id)->first();

        $arrData['get_last_status'] = NocCCApplicationStatus::where([
                'application_id' =>  $application_id,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id')
            ])->orderBy('id', 'desc')->first();

        return view('admin.REE_department.scrutiny-remark-noc-cc', compact('arrData','noc_application'));
    }

    public function uploadOfficeNoteNocforCCRee(Request $request){
        $applicationId   = $request->application_id;
        $uploadPath      = '/uploads/ree_office_note_noc_cc';
        $destinationPath = public_path($uploadPath);

        if ($request->file('ree_office_note_noc')){

            $file = $request->file('ree_office_note_noc');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'ree_office_note_noc_cc.'.$extension;
            $folder_name = "ree_office_note_noc_cc";
            $path = $folder_name."/".$file_name;

            if($extension == "pdf") {

                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('ree_office_note_noc'),$file_name);

                NocCCApplication::where('id',$applicationId)->update(["ree_office_note_noc" => $path]);

                return back()->with('success', 'Office Note has been uploaded successfully');
            }
            else
            {
                return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
            }
        }
    }

    public function forwardApplicationNocCC(Request $request, $applicationId){

        $noc_application = $this->CommonController->getNocforCCApplication($applicationId);
        $noc_application->model = NocCCApplication::with(['noc_application_master'])->where('id',$applicationId)->first();
        $applicationData = $this->CommonController->getForwardNocCCApplication($applicationId);

        $parentData = $this->CommonController->getForwardApplicationParentData();
        $arrData['parentData'] = $parentData['parentData'];
        $arrData['role_name'] = $parentData['role_name'];

        if(session()->get('role_name') != config('commanConfig.ree_junior'))
        $arrData['application_status'] = $this->CommonController->getCurrentLoggedInChildNocCC($applicationId);

        $arrData['get_current_status'] = $this->CommonController->getCurrentStatusNocCC($applicationId);

        // CO Forward Application

        $co_id = Role::where('name', '=', config('commanConfig.co_engineer'))->first();
        if($arrData['get_current_status']->status_id != config('commanConfig.applicationStatus.NOC_Issued'))
        {
            $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
            $layout_ids = array_column($layout_id_array, 'layout_id');
            $arrData['get_forward_co'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                                ->whereIn('lu.layout_id', $layout_ids)
                                ->where('role_id', $co_id->id)->groupBy('users.id')->get();
            $arrData['co_role_name'] = strtoupper(str_replace('_', ' ', $co_id->name));
        }

        //remark and history
        $reeLogs  = $this->CommonController->getLogsOfREEDepartmentForNOCforCC($applicationId); 
        $coLogs   = $this->CommonController->getLogsOfCODepartmentForNOCforCC($applicationId); 

          // dd($ol_application->offer_letter_document_path);
        return view('admin.REE_department.forward_application_noc_cc',compact('applicationData','arrData','noc_application','reeLogs','coLogs'));  
    }

    public function sendForwardNocforCCApplication(Request $request){

//        dd($request->all());
        $noc_application = $this->CommonController->getNocforCCApplication($request->applicationId);

        $arrData['get_current_status'] = $this->CommonController->getCurrentStatusNocCC($request->applicationId);

//dd($noc_application->noc_generation_status);
        if(session()->get('role_name') == config('commanConfig.ree_junior') && $noc_application->noc_generation_status == 0 && !empty($noc_application->final_draft_noc_path))
        {
            NocCCApplication::where('id',$request->applicationId)->update(["noc_generation_status" => config('commanConfig.applicationStatus.NOC_Generation')]);

            $noc_application = $this->CommonController->getNocforCCApplication($request->applicationId);
        }

//        if(($noc_application->noc_generation_status == '0' || $noc_application->noc_generation_status == '3') && (session()->get('role_name') == config('commanConfig.ree_branch_head')))
//        {
//            $this->CommonController->revertNocforCCApplicationToSociety($request);
//        }
        if($request->remarks_suggestion == 2){
            $this->CommonController->revertNocforCCApplicationToSociety($request);
        }

        elseif($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.NOC_Generation') || ($noc_application->noc_generation_status == config('commanConfig.applicationStatus.NOC_Generation') && session()->get('role_name') == config('commanConfig.ree_junior')))
        {
            $this->CommonController->generateNOCforCCREE($request);
        }
        elseif($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.NOC_Issued'))
        {
             $this->CommonController->forwardApprovedNocfoCCApplication($request);
        }
        else
        {
            $this->CommonController->forwardNocCCApplicationForm($request);
        }

        return redirect('/ree_noc_cc_applications')->with('success','Application send successfully.');

    }

    public function approvedNOCforCCletter(Request $request,$applicationId){

        $ree_head = session()->get('role_name') == config('commanConfig.ree_branch_head'); 
        $noc_application = $this->CommonController->getNocforCCApplication($applicationId);
        $noc_application->model = NocCCApplication::with(['noc_application_master'])->where('id',$applicationId)->first();
        $applicationData = NocCCApplication::with(['eeApplicationSociety'])
                ->where('id',$applicationId)->orderBy('id','DESC')->first();

        $applicationData->ree_Jr_id = (session()->get('role_name') == config('commanConfig.ree_junior'));

        $this->CommonController->getREEForwardRevertLogNocforCC($applicationData,$applicationId); 
       
       // get Co log
        $co = Role::where('name',config('commanConfig.co_engineer'))->value('id');
        $applicationData->coLog = NocCCApplicationStatus::where('application_id',$applicationId)->where('role_id',$co)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();   

        return view('admin.REE_department.approved_noc_cc_cert',compact('applicationData','noc_application','ree_head'));
    }

    public function sendissuedNOCforCCToSociety(Request $request){

        $this->CommonController->forwardNocCCApplicationToSociety($request);
        return redirect('/ree_noc_cc_applications')->with('success','Issued Noc has been successfully sent to society.');
        
    }


    /**
     * Show the offer letter dashboard.
     *
     * Author: Prajakta Sisale.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(){
        $role_id = session()->get('role_id');

        $user_id = Auth::id();

        // REE Roles
        $ree = $this->CommonController->getREERoles();

        $reeHeadId = Role::where('name',config('commanConfig.ree_branch_head'))->value('id');

        $offerLetterRoles = $this->CommonController->getOfferLetterRoles();

        //offer letter
        $ol_data = Null;
        $ol_data = $this->getApplicationData($role_id,$user_id);
        $ol_count = count($ol_data);

        //offer letter subordinate Pendency
        $ol_pending_data = NULL;
        if($role_id == $reeHeadId){
            $ol_pending_data = $this->CommonController->getTotalCountsOfApplicationsPending();
            $ol_pending_count = $ol_pending_data['Total Number of Applications Received to MHADA for Approval'];
        }

        //Tripartite Agreement
        $tripartite_data = Null;
        $tripartite_dashboard = new TripartiteDashboardController();
        $tripartite_data = $tripartite_dashboard->getApplicationData($role_id,$user_id);
        $tripartite_count = count($tripartite_data);

        //Tripartite Agreement Subordinate Pendency
        $tripartite_pending_data = Null;
        $tripartite_pending_data  = $tripartite_dashboard->getDashboardHeaders()->getData();
        $tripartite_pending_count = $tripartite_pending_data['dashboardData_head']['Total Number of Applications'];

        //Offer Letter Revalidation
        $ol_reval_data = Null;
        $ol_reval_data = $this->getRevalApplicationData($role_id,$user_id);
        $ol_reval_count = count($ol_reval_data);

        //Offer Letter Revalidation Subordinate Pendency
        $ol_reval_pending_data = NUll;
        $CommonController = new CommonController();
        $ol_reval_pending_data = $CommonController->getTotalCountsOfRevalApplicationsPending();
        $ol_reval_pending_count = $ol_reval_pending_data['Total Number of Applications'];

        //NOC
        $nocModuleController = new SocietyNocController();
        $nocApplication = $nocModuleController->getApplicationListDashboard('REE');
        $noc_data = $nocApplication['app_data'];
        $noc_count = $noc_data['Total Number of Applications'][0];

        //NOC Subordinate Pendency
        $noc_pending_data = $nocApplication['pending_data'];
        $noc_pending_count = $noc_pending_data['Total Number of Applications'];

        //NOC (CC)
        $nocforCCModuleController = new SocietyNocforCCController();
        $nocforCCApplication = $nocforCCModuleController->getApplicationListDashboard('REE');
        $noc_cc_data = $nocforCCApplication['app_data'];
        $noc_cc_count = $noc_cc_data['Total Number of Applications'][0];

        //NOC (CC) Subordinate Pendency
        $noc_cc_pending_data = $nocforCCApplication['pending_data'];
        $noc_cc_pending_count = $noc_cc_pending_data['Total Number of Applications'];
//        dd($noc_cc_pending_count);

        // Consent for oc
        $oc_dashboard = new OcDashboardController();
        $ocData = $oc_dashboard->getApplicationData($role_id,$user_id);
        $oc_count = count($ocData);

        // Consent for Oc Department Pendency
        $oc_pending_dashboard_data = $oc_dashboard->getTotalCountsOfApplicationsPending();
        $oc_pendency_count = $oc_pending_dashboard_data['Total Number of Applications'];

        //Revision in Layout
        $architect_layout_count = ArchitectLayout::all()->count();

        //Layout Approval

        //Layout Approval Subordinate Pendency

        return view('admin.REE_department.dashboard',compact('architect_layout_count','ol_count','ol_pending_count','oc_count','oc_pendency_count','tripartite_count','tripartite_pending_count','ol_reval_count','ol_reval_pending_count',
            'noc_count','noc_cc_count','noc_pending_count','noc_cc_pending_count','offerLetterRoles'));
    }

    /**
     * Show the offer letter dashboard using ajax.
     *
     * Author: Prajakta Sisale.
     *
     *  @return json response
     */
    public function ajaxdashboard(Request $request){

        if($request->ajax()){

            $role_id = session()->get('role_id');
            $user_id = Auth::id();
            // REE Roles
            $ree = $this->CommonController->getREERoles();

            $reeHeadId = Role::where('name',config('commanConfig.ree_branch_head'))->value('id');

            if($request->module_name == 'Offer Letter'){
                $applicationData = $this->getApplicationData($role_id,$user_id);

                $statusCount = $this->getApplicationStatusCount($applicationData);
                $dashboardData = $this->getREEDashboardData($role_id,$ree,$statusCount);

                return $dashboardData;
            }

            if($request->module_name == "Offer Letter Department Pendency"){
                if($role_id == $reeHeadId){
                    $dashboardData1 = $this->CommonController->getTotalCountsOfApplicationsPending();
                    return $dashboardData1;
                }
            }

            if($request->module_name == "Offer Letter Revalidation"){
                $revalApplicationData = $this->getRevalApplicationData($role_id,$user_id);

                $revalStatusCount = $this->getApplicationStatusCount($revalApplicationData);

                $revalDashboardData = $this->getREEDashboardData($role_id,$ree,$revalStatusCount);
                return $revalDashboardData;
            }

            if($request->module_name == "Offer Letter Revalidation Department Pendency") {
                $revalDashboardData1 = NULL;
                if($role_id == $reeHeadId){
                    $revalDashboardData1 = $this->CommonController->getTotalCountsOfRevalApplicationsPending();
                    return $revalDashboardData1;
                }
            }

            if($request->module_name == 'NOC'){
                $nocModuleController = new SocietyNocController();
                $nocApplication = $nocModuleController->getApplicationListDashboard('REE');

                return $nocApplication['app_data'];
            }

            if($request->module_name == 'NOC Department Pendency'){
                $nocModuleController = new SocietyNocController();
                $nocApplication = $nocModuleController->getApplicationListDashboard('REE');

                return $nocApplication['pending_data'];
            }

            if($request->module_name == 'NOC (CC)'){
                $nocforCCModuleController = new SocietyNocforCCController();
                $nocforCCApplication = $nocforCCModuleController->getApplicationListDashboard('REE');

                return $nocforCCApplication['app_data'];
            }

            if($request->module_name == 'NOC (CC) Department Pendency'){
                $nocforCCModuleController = new SocietyNocforCCController();
                $nocforCCApplication = $nocforCCModuleController->getApplicationListDashboard('REE');

                return $nocforCCApplication['pending_data'];
            }

            if($request->module_name == 'NOC (CC) Department Pendency'){
                if (in_array(session()->get('role_name'), array(config('commanConfig.ree_junior'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'), config('commanConfig.ree_branch_head')))) {
                    $data['total_no_of_appln_for_revision'] = $this->architect_dashboard->total_no_of_appln_for_revision();
                    $data['application_pending'] = $this->architect_dashboard->pending_layout_before_layout_and_excel();
                    $data['ree_forwarded_layouts'] = $this->architect_dashboard->forwarded_layout_before_layout_and_excel();
                    $data['appln_sent_for_arroval'] = $this->architect_dashboard->appln_sent_for_arroval();
                    $data['application_pending_after_layout_and_excel'] = $this->architect_dashboard->pending_layout_before_layout_and_excel(1);
                    $data['application_forwarded_after_layout_and_excel'] = $this->architect_dashboard->forwarded_layout_before_layout_and_excel(1);


                    if (session()->get('role_name') == config('commanConfig.ree_branch_head')) {
                        $data['jr_ree_pending'] = $this->architect_dashboard->ree_pending_at_role(config('commanConfig.ree_junior'));
                        $data['dy_ree_pending'] = $this->architect_dashboard->ree_pending_at_role(config('commanConfig.ree_deputy_engineer'));
                        $data['assistant_ree_pending'] = $this->architect_dashboard->ree_pending_at_role(config('commanConfig.ree_assistant_engineer'));
                        $data['head_ree_pending'] = $this->architect_dashboard->ree_pending_at_role(config('commanConfig.ree_branch_head'));
                    }
                }

            }

            if ($request->module_name == "Revision in Layout") {
                $this->architect_dashboard = new ArchitectLayoutDashboardController();

                if (in_array(session()->get('role_name'), array(config('commanConfig.ree_junior'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'), config('commanConfig.ree_branch_head')))) {
                    $data['Total No of Application Sent For Revision'] = $this->architect_dashboard->total_no_of_appln_for_revision();
                    $data['Application Pending'] = $this->architect_dashboard->pending_layout_before_layout_and_excel();
                    $data['Application Forwarded'] = $this->architect_dashboard->forwarded_layout_before_layout_and_excel();
                    return $data;
                }
            }

            if($request->module_name == 'Layout Approval'){
                $this->architect_dashboard = new ArchitectLayoutDashboardController();

                if (in_array(session()->get('role_name'), array(config('commanConfig.ree_junior'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'), config('commanConfig.ree_branch_head')))) {
                    $data['Total No of Application Sent For Approval'] = $this->architect_dashboard->appln_sent_for_arroval();
                    $data['Application Pending'] = $this->architect_dashboard->pending_layout_before_layout_and_excel(1);
                    $data['Application Forwarded'] = $this->architect_dashboard->forwarded_layout_before_layout_and_excel(1);
                    return $data;
                }
            }

            if($request->module_name == "Layout Approval Subordinate Pendency") {
                $this->architect_dashboard = new ArchitectLayoutDashboardController();

                if (session()->get('role_name') == config('commanConfig.ree_branch_head')) {
                    $jr_ree_pending = $this->architect_dashboard->ree_pending_at_role(config('commanConfig.ree_junior'));
                    $dy_ree_pending = $this->architect_dashboard->ree_pending_at_role(config('commanConfig.ree_deputy_engineer'));
                    $assistant_ree_pending = $this->architect_dashboard->ree_pending_at_role(config('commanConfig.ree_assistant_engineer'));
                    $head_ree_pending = $this->architect_dashboard->ree_pending_at_role(config('commanConfig.ree_branch_head'));

                    $data['Total No of Application Sent For Approval'] = $jr_ree_pending+ $dy_ree_pending+ $assistant_ree_pending+ $head_ree_pending;
                    $data['Pending at JE / SE'] = $jr_ree_pending;
                    $data['Pending at Deputy Engineer'] = $dy_ree_pending;
                    $data['Pending at Assistant REE'] = $assistant_ree_pending;
                    $data['Pending at REE'] = $head_ree_pending;

                    return $data;
                }
            }

            if($request->module_name == 'Tripartite Agreement'){

                $tripartite_dashboard = new TripartiteDashboardController();
                $data = $tripartite_dashboard->getDashboardHeaders()->getData();
                return $data['dashboardData'];

            }

            if($request->module_name == 'Tripartite Agreement Department Pendency'){
                $tripartite_dashboard = new TripartiteDashboardController();
                $data = $tripartite_dashboard->getDashboardHeaders()->getData();
                return $data['dashboardData_head'];
            }

            if($request->module_name == 'Consent for OC'){
                if (in_array(session()->get('role_name'), array(config('commanConfig.ree_junior'), config('commanConfig.ree_deputy_engineer'), config('commanConfig.ree_assistant_engineer'), config('commanConfig.ree_branch_head')))) {
                    $oc_dashboard = new OcDashboardController();
                    $applicationData = $oc_dashboard->getApplicationData($role_id,$user_id);
                    $statusCount = $oc_dashboard->getApplicationStatusCount($applicationData);
                    $oc_data = $oc_dashboard->getREEDashboardData($role_id,$ree,$statusCount);
                    return $oc_data;
                }
            }
            if($request->module_name == 'Consent for OC Department Pendency'){
                if (session()->get('role_name') == config('commanConfig.ree_branch_head')) {

                    $ocPendingDashboardData = NULL;
                    $oc_dashboard = new OcDashboardController();
                    $ocPendingDashboardData = $oc_dashboard->getTotalCountsOfApplicationsPending();
                    return $ocPendingDashboardData;
                }
            }
        }
    }

    public function getApplicationData($role_id,$user_id){

        $new_offer_letter_master_ids = config('commanConfig.new_offer_letter_master_ids');

        $applicationData = OlApplication::with([
            'olApplicationStatus' => function ($q) use ($role_id,$user_id) {
                $q->where('user_id', $user_id)
                    ->where('role_id', $role_id)
                    ->where('society_flag', 0)
                    ->where('is_active',1)
                    ->orderBy('id', 'desc');
            }])
            ->whereHas('olApplicationStatus', function ($q) use ($role_id,$user_id) {
                $q->where('user_id', $user_id)
                    ->where('role_id', $role_id)
                    ->where('society_flag', 0)
                    ->where('is_active',1)
                    ->orderBy('id', 'desc');
            })->whereIn('application_master_id',$new_offer_letter_master_ids)->get()->toArray();

        return $applicationData;
    }

    // reval application data
    public function getRevalApplicationData($role_id,$user_id){

        $reval_application_type_ids= config('commanConfig.revalidation_master_ids');

        $applicationData = OlApplication::with([
            'olApplicationStatus' => function ($q) use ($role_id,$user_id) {
                $q->where('user_id', $user_id)
                    ->where('role_id', $role_id)
                    ->where('society_flag', 0)
                    ->where('is_active',1)
                    ->orderBy('id', 'desc');
            }])
            ->whereHas('olApplicationStatus', function ($q) use ($role_id,$user_id) {
                $q->where('user_id', $user_id)
                    ->where('role_id', $role_id)
                    ->where('society_flag', 0)
                    ->where('is_active',1)
                    ->orderBy('id', 'desc');
            })->whereIn('application_master_id',$reval_application_type_ids)->get()->toArray();

        return $applicationData;
    }

    public function getApplicationStatusCount($applicationData){

        $totalForwarded = $totalReverted = $totalPending = $totalInProcess = $inProcess = 0 ;

        $totalDraftOfferLetterGenereated = $totalOfferLetterSentForApproval = $offerLetterGeneration = 0 ;

        $offerLetterApprovedNotIssuedToSociety = $offerLetterIssuedToSociety = $offerLetterForwardedForIssueingToSociety = 0;

        foreach ($applicationData as $application){
//            echo "<pre>";
//            print_r($application);

            $phase =  $application['ol_application_status'][0]['phase'];
            $status = $application['ol_application_status'][0]['status_id'];
//            print_r($status);
//            echo '=====';
            if($phase == 0){
                switch ( $status )
                {
                    case config('commanConfig.applicationStatus.in_process'): $totalPending += 1; $inProcess += 1; break;
                    case config('commanConfig.applicationStatus.forwarded'): $totalForwarded += 1; break;
                    case config('commanConfig.applicationStatus.reverted'): $totalReverted += 1 ; break;
                    default:
                        ; break;
                }
            }
            if($phase == 1){
//                dd($application);
                switch ( $status )
                {
                    case config('commanConfig.applicationStatus.offer_letter_generation'): $totalPending += 1; $offerLetterGeneration += 1; break;
                    case (config('commanConfig.applicationStatus.forwarded') /*&& $application['drafted_offer_letter']*/) : $totalOfferLetterSentForApproval += 1; break;
                    case config('commanConfig.applicationStatus.draft_offer_letter_generated') : $totalDraftOfferLetterGenereated += 1 ; break;
                    default:
                        ; break;
                }
            }
            if($phase == 2){
                switch ( $status )
                {

                case config('commanConfig.applicationStatus.forwarded'): $offerLetterForwardedForIssueingToSociety += 1; break;
                case config('commanConfig.applicationStatus.offer_letter_approved'): $offerLetterApprovedNotIssuedToSociety += 1; break;
                case config('commanConfig.applicationStatus.sent_to_society'): $offerLetterIssuedToSociety += 1; break;
                default:
                    ; break;
                }
            }

        }
//        dd('asdhash');
        $totalApplication = count($applicationData);

        $count = ['totalPending' => $totalPending,
            'totalForwarded' => $totalForwarded,
            'totalReverted' => $totalReverted,
            'totalApplication' => $totalApplication,
            'totalDraftOfferLetterGenereated' => $totalDraftOfferLetterGenereated,
            'totalOfferLetterSentForApproval' => $totalOfferLetterSentForApproval,
//            'offerLetterApproved' => $offerLetterApproved,
            'offerLetterApprovedNotIssuedToSociety' => $offerLetterApprovedNotIssuedToSociety,
            'offerLetterIssuedToSociety' => $offerLetterIssuedToSociety,
            'offerLetterForwardedForIssueingToSociety' => $offerLetterForwardedForIssueingToSociety,
            'sepeartion'=> ['Total Pending Applications'=> $inProcess + $offerLetterGeneration,
                    'Total Pending Proposals'=> $inProcess,
                    'Total Pending Drafted Offer Letter'=> $offerLetterGeneration],
            ];
        return $count;

    }

    public function getREEDashboardData($role_id,$ree,$statusCount)
    {

//        dd('perparing for dashboard data');
        switch ($role_id) {
            case ($ree['REE Junior Engineer']):
                $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total Number of Applications'][1] = '';

                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = 'pending';

                $dashboardData['Proposals Sent For Approval to REE Deputy'][0] = $statusCount['totalForwarded'];
                $dashboardData['Proposals Sent For Approval to REE Deputy'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['Draft Offer Letters Generated'][0] = $statusCount['totalDraftOfferLetterGenereated'];
                $dashboardData['Draft Offer Letters Generated'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.draft_offer_letter_generated');

                $dashboardData['Offer Letters Sent for Approval to REE Deputy'][0] = $statusCount['totalOfferLetterSentForApproval'];
//                $dashboardData['Offer Letter Approved'] = $statusCount['offerLetterApproved'];
                $dashboardData['Offer Letters Sent for Approval to REE Deputy'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                $dashboardData['Offer Letters Approved but Not Issued to Society'][0] = $statusCount['offerLetterApprovedNotIssuedToSociety'];
                $dashboardData['Offer Letters Approved but Not Issued to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.offer_letter_approved');

                $dashboardData['Offer Letters Forwarded for Issuing to Society'][0] = $statusCount['offerLetterForwardedForIssueingToSociety'];
                $dashboardData['Offer Letters Forwarded for Issuing to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

                break;
            case ($ree['ree_engineer']):
                $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total Number of Applications'][1] = '';

                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = 'pending';

                $dashboardData['Applications Sent for Compliance'][0] = $statusCount['totalReverted'];
                $dashboardData['Applications Sent for Compliance'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.reverted');


                $dashboardData['Proposals Sent For Approval to CO'][0] = $statusCount['totalForwarded'];
                $dashboardData['Proposals Sent For Approval to CO'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

//                $dashboardData['Draft Offer Letter Generated'] = $statusCount['totalDraftOfferLetterGenereated'];
                $dashboardData['Offer Letters Sent for Approval to CO'][0] = $statusCount['totalOfferLetterSentForApproval'];
                $dashboardData['Offer Letters Sent for Approval to CO'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');

//                $dashboardData['Offer Letter Approved'] = $statusCount['offerLetterApproved'];
                $dashboardData['Offer Letters Approved but Not Issued to Society'][0] = $statusCount['offerLetterApprovedNotIssuedToSociety'];
                $dashboardData['Offer Letters Approved but Not Issued to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.offer_letter_approved');

                $dashboardData['Offer Letters Sent to Society '][0] = $statusCount['offerLetterIssuedToSociety'];
                $dashboardData['Offer Letters Sent to Society '][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.sent_to_society');

                break;
            case ($ree['REE deputy Engineer']):
                $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total Number of Applications'][1] = '';

                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = 'pending';

                $dashboardData['Applications Sent for Compliance'][0] = $statusCount['totalReverted'];
                $dashboardData['Applications Sent for Compliance'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.reverted');

                $dashboardData['Proposals Sent For Approval to REE Assistant'][0] = $statusCount['totalForwarded'];
                $dashboardData['Proposals Sent For Approval to REE Assistant'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');
//                $dashboardData['Draft Offer Letter Generated'] = $statusCount['totalDraftOfferLetterGenereated'];

                $dashboardData['Offer Letters Sent for Approval to REE Assistant'][0] = $statusCount['totalOfferLetterSentForApproval'];
                $dashboardData['Offer Letters Sent for Approval to REE Assistant'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');
//                $dashboardData['Offer Letter Approved'] = $statusCount['offerLetterApproved'];

                $dashboardData['Offer Letters Approved but Not Issued to Society'][0] = $statusCount['offerLetterApprovedNotIssuedToSociety'];
                $dashboardData['Offer Letters Approved but Not Issued to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.offer_letter_approved');

                $dashboardData['Offer Letters Forwarded for Issuing to Society'][0] = $statusCount['offerLetterForwardedForIssueingToSociety'];
                $dashboardData['Offer Letters Forwarded for Issuing to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.sent_to_society');

                break;
            case ($ree['REE Assistant Engineer']):
                $dashboardData['Total Number of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total Number of Applications'][1] = '';

                $dashboardData['Applications Pending'][0] = $statusCount['totalPending'];
                $dashboardData['Applications Pending'][1] = 'pending';

                $dashboardData['Applications Sent for Compliance'][0] = $statusCount['totalReverted'];
                $dashboardData['Applications Sent for Compliance'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.reverted');

                $dashboardData['Proposals Sent for Approval to REE Head'][0] = $statusCount['totalForwarded'];
                $dashboardData['Proposals Sent for Approval to REE Head'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');
//                $dashboardData['Draft Offer Letter Generated'] = $statusCount['totalDraftOfferLetterGenereated'];

                $dashboardData['Offer Letters Sent for Approval to REE Head'][0] = $statusCount['totalOfferLetterSentForApproval'];
                $dashboardData['Offer Letters Sent for Approval to REE Head'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.forwarded');
//                $dashboardData['Offer Letter Approved'] = $statusCount['offerLetterApproved'];

                $dashboardData['Offer Letters Approved but Not Issued to Society'][0] = $statusCount['offerLetterApprovedNotIssuedToSociety'];
                $dashboardData['Offer Letters Approved but Not Issued to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.offer_letter_approved');

                $dashboardData['Offer Letters Forwarded for Issuing to Society'][0] = $statusCount['offerLetterForwardedForIssueingToSociety'];
                $dashboardData['Offer Letters Forwarded for Issuing to Society'][1] = '?submitted_at_from=&submitted_at_to=&update_status='.config('commanConfig.applicationStatus.sent_to_society');

                break;
            default:
                ;
                break;
        }

        $dashboardData = array($dashboardData,$statusCount['sepeartion']);
//dd($dashboardData);
        return $dashboardData;
    }

    public function consentforOCApplicationList(Request $request, Datatables $datatables)
    {
        $getData = $request->all();
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address','class' => 'datatable-address', 'searchable' => false],
            ['data' => 'Model','name' => 'Model','title' => 'Application Type'],
            ['data' => 'Status','name' => 'Status','title' => 'Status'],
            ['data' => 'radio','name' => 'radio','title' => 'Action','searchable' => false],

        ];

        if ($datatables->getRequest()->ajax()) {
            $oc_application_data = $this->CommonController->listApplicationDataOc($request);
              
            return $datatables->of($oc_application_data)
                ->editColumn('rownum', function ($listArray) {
                     static $i = 0; $i++; return $i;
                })
            ->editColumn('radio', function ($oc_application_data) {
                $url = route('ree.view_application_consent_oc', $oc_application_data->id);
                return '<div class="d-flex btn-icon-list"><a href="'.$url.'" onclick="geturl(this.value);" name="village_data_id" class="d-flex flex-column align-items-left"><span class="btn-icon btn-icon--view">
                        <img src="'. asset("img/view-icon.svg").'">
                    </span>View</span></a></div>';
            })
            ->editColumn('eeApplicationSociety.name', function ($oc_application_data) {
                return $oc_application_data->eeApplicationSociety->name;
            })
            ->editColumn('eeApplicationSociety.building_no', function ($oc_application_data) {
                return $oc_application_data->eeApplicationSociety->building_no;
            })
            ->editColumn('eeApplicationSociety.address', function ($oc_application_data) {
                return "<span>".$oc_application_data->eeApplicationSociety->address."</span>";
            })                
            ->editColumn('date', function ($oc_application_data) {
                return date(config('commanConfig.dateFormat'), strtotime($oc_application_data->submitted_at));
            })
            // ->editColumn('actions', function ($ree_application_data) use($request){
            //    return view('admin.REE_department.action', compact('ree_application_data', 'request'))->render();
            // }) 
            ->editColumn('Status', function ($listArray) use ($request) {
                $status = $listArray->ocApplicationStatusForLoginListing[0]->status_id;

                if ($request->update_status)
                {
                    if ($request->update_status == $status){
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
           ->editColumn('Model', function ($oc_application_data) {
               $application_type = '';
               $type = $oc_application_data->oc_application_master->ol_application_type[0]->title;
               if (strpos($type, 'Self') !== false) {
                   $application_type = 'Self';
               }elseif(strpos($type, 'Developer') !== false){
                   $application_type = 'Through Developer';
               }else{
                   $application_type = '-';
               }
               return $application_type."\n".'('.$oc_application_data->oc_application_master->model.')' ;

//                    return $oc_application_data->oc_application_master->model;
                })
            ->rawColumns(['radio','society_name', 'building_name', 'society_address','date','Status','eeApplicationSociety.address'])
            ->make(true);
        }        
            $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
            
        return view('admin.REE_department.oc_list', compact('html','header_data','getData')); 
    }

    public function viewApplicationConsentOc(Request $request, $applicationId)
    {
        $oc_application = $this->CommonController->downloadConsentforOc($applicationId);
        $oc_application->folder = 'REE_department';
        /*$oc_application->status = $this->comman->getCurrentStatus($applicationId);*/
        return view('admin.common.consent_for_oc', compact('oc_application'));
    }

    public function societyOcDocuments(Request $request,$applicationId)
    {
        $oc_application = $this->CommonController->getOcApplication($applicationId);    
        $oc_application->status = $this->CommonController->getCurrentStatusOc($applicationId);
        $comments = $this->CommonController->getOCApplicationComments($applicationId);
        $societyDocuments = $this->CommonController->getSocietyDocumentsforOC($applicationId);

        return view('admin.REE_department.society_documents_consent_oc', compact('societyDocuments','oc_application','comments'));
    }

    public function viewEMScrutinyOc($applicationId)
    {
        $oc_application = $this->CommonController->getOcApplication($applicationId);
        $oc_application->status = $this->CommonController->getCurrentStatusOc($applicationId);

        $application_master_id = OcApplication::where('society_id', $oc_application->eeApplicationSociety->id)->value('application_master_id');

        $arrData['society_detail'] = OcApplication::with('eeApplicationSociety')->where('id', $applicationId)->first();

        $arrData['get_last_status'] = OcApplicationStatusLog::where([
                'application_id' =>  $applicationId,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id')
            ])->orderBy('id', 'desc')->first();

        return view('admin.REE_department.view_em_scrutiny', compact('arrData','oc_application'));
    }

    public function viewEEScrutinyOc($applicationId)
    {
        $oc_application = $this->CommonController->getOcApplication($applicationId);
        $oc_application->status = $this->CommonController->getCurrentStatusOc($applicationId);

        $application_master_id = OcApplication::where('society_id', $oc_application->eeApplicationSociety->id)->value('application_master_id');

        $data = OcSrutinyQuestionMaster::with(['ocScrutinyAnswer' => function($q) use ($applicationId){
            $q->where('application_id',$applicationId);
        }])->where('is_deleted',0)->get();

        // $arrData['scrutiny_questions_oc'] = OcSrutinyQuestionMaster::all();

        // $arrData['scrutiny_answers_to_questions'] = OcEEScrutinyAnswer::where('application_id', $applicationId)->get()->keyBy('question_id')->toArray();
        $arrData['eeNote'] = OCEENote::where('application_id',$applicationId)->orderBy('id','DESC')->get();

        return view('admin.REE_department.ee_scrutiny_oc_ree', compact('arrData','oc_application','data'));
    }

    function generateOccertificate($applicationId)
    {
        $oc_application = $this->CommonController->getOcApplication($applicationId);
        $oc_application->model = OcApplication::with(['oc_application_master'])->where('id',$applicationId)->first();
        $applicationLog = $this->CommonController->getCurrentStatusOc($applicationId);
        $societyData = OcApplication::with(['eeApplicationSociety'])
                ->where('id',$applicationId)->orderBy('id','DESC')->first();

        $societyData->ree_Jr_id = (session()->get('role_name') == config('commanConfig.ree_junior')); 
        $societyData->ree_branch_head = (session()->get('role_name') == config('commanConfig.ree_branch_head')); 

        //$societyData->drafted_offer_letter = OlApplication::where('id',$applicationId)->value('drafted_offer_letter');   
        // dd($oc_application->oc_type);
        return view('admin.REE_department.generate-consent-oc',compact('societyData','oc_application','applicationLog'));
    }

    public function createEditConsentOc(Request $request){
        $applicatonId = $request->applicationId;
        $OcType = $request->oc_type;
        $application = OcApplication::where('id',$applicatonId)->update(['oc_type' => $OcType]);
        $model = OcApplication::with('oc_application_master','eeApplicationSociety','request_form')->where('id',$applicatonId)->first();

        $blade =  "oc_draft_copy";

        if($model->text_oc){

            $content = Storage::disk('ftp')->get($model->text_oc); 
                   
        }else{
           $content = ""; 
        }
        // dd($blade);
        $status = $this->CommonController->getCurrentStatusOc($applicatonId);
        return view('admin.REE_department.'.$blade,compact('applicatonId','content','model','OcType','application','status'));
    }

    public function saveDraftConsentOc(Request $request){
        $applicationId = $request->applicationId;
        $oc_application = $this->CommonController->getOcApplication($applicationId);
        $status = $this->CommonController->getCurrentStatusOc($applicationId);
        $id = $request->applicationId;
        $content = str_replace('_', "", $_POST['ckeditorText']);
        $folder_name = 'Draft_consent_oc';

        // get athorities name as per layout
        $authority = $this->getAuthorityNames($oc_application->layout_id); 
        $AuthoritySign = view('admin.REE_department.authority_sign',compact('authority','status'));
        $header_file = view('admin.REE_department.offer_letter_header');        
        $footer_file = view('admin.REE_department.offer_letter_footer');

        $pdf = new Mpdf();
        $pdf->autoScriptToLang = true;
        $pdf->autoLangToFont = true; 

        $pdf->WriteHTML($header_file.$content.$AuthoritySign.$footer_file);

        $fileName = time().'draft_consent_oc_'.$id.'.pdf';
        $filePath = $folder_name."/".$fileName;

        if (!(Storage::disk('ftp')->has($folder_name))) {            
            Storage::disk('ftp')->makeDirectory($folder_name, $mode = 0777, true, true);
        } 
        Storage::disk('ftp')->put($filePath, $pdf->Output($fileName, 'S'));
        //$file = $pdf->output();

        $folder_name1 = 'text_consent_oc';

        if (!(Storage::disk('ftp')->has($folder_name1))) {            
            Storage::disk('ftp')->makeDirectory($folder_name1, $mode = 0777, true, true);
        }        
        $file_nm =  time()."text_consent_oc".$id.'.txt';
        $filePath1 = $folder_name1."/".$file_nm;

        Storage::disk('ftp')->put($filePath1, $content);
        

        if ($status->status_id == config('commanConfig.applicationStatus.in_process')){
            OcApplication::where('id',$applicationId)->update(["drafted_oc" => $filePath, "text_oc" => $filePath1]);
        }else if($status->status_id == config('commanConfig.applicationStatus.OC_Approved')){
            OcApplication::where('id',$applicationId)->update(["final_oc_agreement" => $filePath, "text_oc" => $filePath1]);
        }

        \Session::flash('success_msg', 'Changes in OC draft has been saved successfully..');
        
        if((session()->get('role_name') == config('commanConfig.ree_junior')) && $status->status_id == config('commanConfig.applicationStatus.OC_Approved'))
        {
            return redirect('approved_consent_oc_letter/'.$request->applicationId)->with('success', 'Changes in OC has been incorporated successfully.');
        }else{
            
        return redirect('generate_oc_certificate/'.$request->applicationId);
        }
    }

    public function uploadDraftConsentforOc(Request $request,$applicationId){
        if ($request->file('oc_letter')) {
            $file = $request->file('oc_letter');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'_uploaded_oc_'.$applicationId.'.'.$extension;
            $folder_name = "uploaded_oc";
            $status = $this->CommonController->getCurrentStatusOc($applicationId);
            if ($extension == "pdf") {

                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('oc_letter'),$file_name);

                    $draftNocPath = $folder_name."/".$file_name;

                    if ($status->status_id == config('commanConfig.applicationStatus.OC_Approved')){
                        OcApplication::where('id',$applicationId)->update(["final_oc_agreement" => $draftNocPath]);
                    } else{
                        OcApplication::where('id',$applicationId)->update(["oc_path" => $draftNocPath]);
                    }

                    return redirect()->back()->with('success', 'Draft copy of OC has been uploaded successfully.');
            } else {
                return redirect()->back()->with('error', 'Invalid format. pdf file only.');
            }
        }       
    }

    public function uploadNoteConsentOC($application_id)
    {
        $oc_application = $this->CommonController->getOcApplication($application_id);
        $oc_application->status = $this->CommonController->getCurrentStatusOc($application_id);

        $application_master_id = OcApplication::where('society_id', $oc_application->eeApplicationSociety->id)->value('application_master_id');

        $arrData['society_detail'] = OcApplication::with('eeApplicationSociety')->where('id', $application_id)->first();

        $arrData['get_last_status'] = OcApplicationStatusLog::where([
                'application_id' =>  $application_id,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id')
            ])->orderBy('id', 'desc')->first();

        return view('admin.REE_department.ree-note_consent_oc', compact('arrData','oc_application'));
    }

    public function uploadOfficeNoteConsentOCRee(Request $request){
        $applicationId   = $request->application_id;
        $uploadPath      = '/uploads/ree_office_note_oc';
        $destinationPath = public_path($uploadPath);

        if ($request->file('ree_office_note_oc')){

            $file = $request->file('ree_office_note_oc');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'ree_office_note_oc.'.$extension;
            $folder_name = "ree_office_note_oc";
            $path = $folder_name."/".$file_name;

            if($extension == "pdf") {

                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('ree_office_note_oc'),$file_name);

                OcApplication::where('id',$applicationId)->update(["ree_office_note_oc" => $path]);

                return back()->with('success', 'Office Note has been uploaded successfully');
            }
            else
            {
                return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
            }
        }
    }

    public function forwardApplicationConsentOc(Request $request, $applicationId){

        $oc_application = $this->CommonController->getOcApplication($applicationId);
        $oc_application->model = OcApplication::with(['oc_application_master'])->where('id',$applicationId)->first();
        $applicationData = $this->CommonController->getForwardOcApplication($applicationId);

        $parentData = $this->CommonController->getForwardApplicationParentData();
        $arrData['parentData'] = $parentData['parentData'];
        $arrData['role_name'] = $parentData['role_name'];

        if(session()->get('role_name') != config('commanConfig.ree_junior'))
        $arrData['application_status'] = $this->CommonController->getCurrentLoggedInChildOc($applicationId);

        $arrData['get_current_status'] = $this->CommonController->getCurrentStatusOc($applicationId);

        // CO Forward Application

        $co_id = Role::where('name', '=', config('commanConfig.co_engineer'))->first();
        //dd($co_id);
        if($arrData['get_current_status']->status_id != config('commanConfig.applicationStatus.OC_Approved'))
        {
            $layout_id_array=LayoutUser::where(['user_id'=>auth()->user()->id])->get()->toArray();
            $layout_ids = array_column($layout_id_array, 'layout_id');
            $arrData['get_forward_co'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                                ->whereIn('lu.layout_id', $layout_ids)
                                ->where('role_id', $co_id->id)->groupBy('users.id')->get();
            $arrData['co_role_name'] = strtoupper(str_replace('_', ' ', $co_id->name));
        }
        //dd($arrData['get_forward_co']);

        //remark and history
        $eelogs   = $this->CommonController->getLogsOfEEDepartmentforOc($applicationId);
        $emlogs   = $this->CommonController->getLogsOfEMforOc($applicationId);
        $reeLogs  = $this->CommonController->getLogsOfREEDepartmentForOc($applicationId); 
        $coLogs   = $this->CommonController->getLogsOfCODepartmentForOc($applicationId);  

          // dd($ol_application->offer_letter_document_path);
        return view('admin.REE_department.forward_application_oc',compact('applicationData','arrData','oc_application','reeLogs','coLogs','eelogs','emlogs'));  
    }

    public function sendForwardConsentOcApplication(Request $request){

        $oc_application = $this->CommonController->getOcApplication($request->applicationId);

        $arrData['get_current_status'] = $this->CommonController->getCurrentStatusOc($request->applicationId);

        if(session()->get('role_name') == config('commanConfig.ree_junior') && $oc_application->OC_Generation_status == 0 && !empty($oc_application->oc_path))
        {
            OcApplication::where('id',$request->applicationId)->update(["OC_Generation_status" => config('commanConfig.applicationStatus.OC_Generation')]);

            $oc_application = $this->CommonController->getOcApplication($request->applicationId);
        }

        if($oc_application->OC_Generation_status == '0' && (session()->get('role_name') == config('commanConfig.ree_branch_head')) && empty($oc_application->final_draft_noc_path) && $request['remarks_suggestion'] == 1)
        {
            $this->CommonController->revertOcApplicationToSociety($request);
        }
        elseif($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.OC_Generation') || ($oc_application->OC_Generation_status == config('commanConfig.applicationStatus.OC_Generation') && session()->get('role_name') == config('commanConfig.ree_junior')))
        {
            $this->CommonController->generateOcREE($request);
        }
        elseif($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.OC_Approved'))
        {
             $this->CommonController->forwardApprovedOcApplication($request);
        }
        else
        {
            $this->CommonController->forwardOcApplicationForm($request);
        }

        return redirect('/ree_oc_applications')->with('success','Application send successfully.');

    }

    public function approvedConsentOcletter(Request $request,$applicationId){

        $ree_head = session()->get('role_name') == config('commanConfig.ree_branch_head'); 
        $oc_application = $this->CommonController->getOcApplication($applicationId);
        $oc_application->model = OcApplication::with(['oc_application_master'])->where('id',$applicationId)->first();
        $applicationData = OcApplication::with(['eeApplicationSociety'])
                ->where('id',$applicationId)->orderBy('id','DESC')->first();

        $applicationData->ree_Jr_id = (session()->get('role_name') == config('commanConfig.ree_junior'));
        $applicationData->ree_head = (session()->get('role_name') == config('commanConfig.ree_branch_head'));

        $this->CommonController->getREEForwardRevertLogOc($applicationData,$applicationId); 
       
       // get Co log
        $co = Role::where('name',config('commanConfig.co_engineer'))->value('id');
        $applicationData->coLog = OcApplicationStatusLog::where('application_id',$applicationId)->where('role_id',$co)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();
        $oc_application->status = $this->CommonController->getCurrentStatusOc($applicationId);   
        return view('admin.REE_department.approved_oc_cert',compact('applicationData','oc_application','ree_head'));
    }

    public function sendissuedOcToSociety(Request $request){

        $this->CommonController->forwardOcApplicationToSociety($request);
        return redirect('/ree_oc_applications')->with('success','Issued Consent for OC has been successfully sent to society.');
        
    } 

        //calculation sheet for 2.5 FSI
    public function fsiCalculationSheet(Request $request,$applicationId){

        $applicationId = decrypt($applicationId); 
        $user = Auth::user();
        $FSI = '2.5 FSI';
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $calculationSheetDetails = OlFsiCalculationSheet::where('application_id','=',$applicationId)->first();
        $dcr_rates = OlDcrRateMaster::all();
        $arrData['reeNote'] = REENote::where('application_id', $applicationId)->orderBy('id', 'desc')
                            ->first();
        
        $is_view = session()->get('role_name') == config('commanConfig.ree_junior'); 
        $status = $this->CommonController->getCurrentStatus($applicationId);  
        $folder = $this->getCurrentRoleFolderName();

        $custom = OlCustomCalculationSheet::where('application_id',$applicationId)->first();
        $premium = OlApplicationCalculationSheetDetails::where('application_id',$applicationId)->first(); 
        $fsiCalculation = OlFsiCalculationSheet::where('application_id',$applicationId)->first(); 

        $exists = 0;
        if (isset($custom) || isset($premium) || isset($fsiCalculation)){
            $exists = 1;
        }
        
        if ($is_view && $status->status_id != config('commanConfig.applicationStatus.forwarded') && $status->status_id != config('commanConfig.applicationStatus.reverted')) {
            $route = 'admin.REE_department.fsi_calculation_sheet';
        } else{
            $route = 'admin.REE_department.view_fsi_calculation_sheet';
        }
        $folder1;
         $master = OlApplicationMaster::where('id',$ol_application->application_master_id)->value('title');
        if ($master == 'New - Offer Letter'){
            $folder1 = 'REE_department.action';
            $action = '.action';
        }elseif($master = 'Revalidation Of Offer Letter'){
            $folder1 = 'REE_department.reval_action';
            $action = '.reval_action';
        } 

        $totalHouse = OlDemarcationVerificationDetails::where('application_id',$applicationId)
        ->whereNotNull('residential')->whereNotNull('non_residential')->select(DB::raw('sum(residential + non_residential) as total'))->value('total');

        $concessionData = $this->getConcessionDetails($applicationId);
        $landArea = OlDemarcationLandArea::where('application_id',$applicationId)->first();

        return view($route,compact('calculationSheetDetails','applicationId','user','dcr_rates','arrData','ol_application','folder','folder1','master','action','status','FSI','exists','totalHouse','concessionData','landArea'));                    
    }

    public function saveFsiCalculationData(Request $request){

        $applicationId = $request->get('application_id'); 
        $society_id = OlApplication::where('id',$applicationId)->value('society_id');
        $request->merge(['user_id' => Auth::Id()]);
        $request->merge(['society_id' => $society_id]);

        DB::beginTransaction();
        try {
            OlFsiCalculationSheet::updateOrCreate(['application_id'=>$applicationId],$request->all());
            OlApplication::where('id',$applicationId)->update(['drafted_offer_letter' => NULL, 'text_offer_letter' => NULL, 'offer_letter_document_path' => NULL]);
            OlApplicationCalculationSheetDetails::where('application_id',$applicationId)->delete();
            OlCustomCalculationSheet::where('application_id',$applicationId)->delete();
            DB::commit();
        }catch(\Exception $ex){
            DB::rollback();
        }
        $id = encrypt($request->get('application_id'));
        return redirect("fsi_calculation_application/" . $id."#".$request->get('redirect_tab'));
         
    }

    public function SaveNOCScrutiny(Request $request){
        
        $data = $request['area']; 
        NOCBuildupArea::updateOrCreate(['application_id'=>$request->applicationId],$data); 
        return back()->with('success', 'Data Saved successfully');
    }

    public function nocVariationReport($applicationId){
        $IvalidReport = $validReport = [];
        $nocData = NocReeScrutinyAnswer::where('application_id', $applicationId)->with('scrutinyQuestions')->get();
        if ($nocData){
            foreach($nocData as $data){
                if (isset($data->answer) && $data->answer == 1) {
                    $validReport [] = $data;
                }else{
                   $IvalidReport [] = $data;  
                }
            }  
        }
        $header_file = view('admin.REE_department.offer_letter_header');        
        $view =  view('admin.REE_department.noc_variation_report', compact('nocData','validReport','IvalidReport')); 
        $pdf = new Mpdf();
        $pdf->autoScriptToLang = true;
        $pdf->autoLangToFont = true;

        $pdf->WriteHTML($header_file.$view);  
        $pdf->Output('variation_report.pdf', 'D');
    }

    //revalidation calculations option with formula and custom
    public function displayRevalCalculationOptions(Request $request,$applicationId){

        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        return view('admin.REE_department.show_reval_calculation_options',compact('ol_application'));
    }

    // get user name for authority sign in agreement(NOC)
    public function getAuthorityNames($layoutId){
        $data = [];
        $data['reeJunior']=Role::where('name', '=', config('commanConfig.ree_junior'))->value('id');
        $data['reeDeputy']=Role::where('name', '=', config('commanConfig.ree_deputy_engineer'))->value('id');
        $data['reeAssistant']=Role::where('name', '=', config('commanConfig.ree_assistant_engineer'))->value('id');
        $data['reeHead']=Role::where('name', '=', config('commanConfig.ree_branch_head'))->value('id');
        $data['co']=Role::where('name', '=', config('commanConfig.co_engineer'))->value('id');
        return $this->getUserIds($data,$layoutId);
    }

    // get user id as per layout id for authority sign in agreement
    public function getUserIds($data,$layoutId){
        $result = [];
        if (isset($data)){
            foreach($data as $key=>$role){
                $headUser = User::where('role_id',$role)->with(['roleDetails','LayoutUser' => function($q) use($layoutId){
                    $q->where('layout_id',$layoutId);
                }])->whereHas('LayoutUser', function($q) use($layoutId) {
                   $q->where('layout_id',$layoutId);
                })->first();

                $result[$key] = $headUser;
            }
        }
        return $result;
    }

    public function getNOCApplicationStatus($application_id)
    {
        $status = NocApplicationStatus::where('application_id', $application_id)
            ->where('user_id', Auth::user()->id)->where('role_id', session()->get('role_id'))
            ->orderBy('id', 'desc')->first();
        return $status;    
    } 

    // save concession sheet details in REE
    public function saveConcessionDetails(Request $request){
        $data = $request->all();
        $route = $request->redirect_route;
        unset($data['_token']);
        unset($data['redirect_tab']);
        $data['user_id'] = Auth::Id();
        $applicationId = $request->application_id;
        OlApplicationConcessionSheetDetails::updateOrCreate(['application_id' => $applicationId],$data);
        $id = encrypt($applicationId);
        return redirect($route.$id."#".$request->get('redirect_tab'));
    }

    // get concession sheet details
    public function getConcessionDetails($applicationId){
        $data = OlApplicationConcessionSheetDetails::where('application_id',$applicationId)->first();
        return $data;   
    }

    //display noc sharing calculation sheet
    public function NOCSharingCalculationSheet($applicationId){

        $noc_application = $this->CommonController->getNocApplication($applicationId);
        
        $calculation=NOCSharingCalculationSheet::where('application_id',$applicationId)->first();
        $user = Auth::user();
        $status = $this->CommonController->getCurrentStatusNoc($applicationId);
        $readonly = $visible = '';
        if (session()->get('role_name') == config('commanConfig.ree_junior') && $status->status_id == config('commanConfig.applicationStatus.in_process')) {
            $readonly = '';
            $visible = true;
        }else{
            $readonly = 'readonly';
            $visible = false;
        }
        if (session()->get('role_name') == config('commanConfig.co_engineer')) {
            $folder = 'co_department';
        }else{
           $folder = 'REE_department'; 
        }
        return view('admin.REE_department.noc_sharing_calculation_sheet',compact('noc_application','calculation','user','readonly','visible','folder'));
    }

    // save NOC sharing calculation sheet details
    public function saveNOCSharingCalculationDetails(Request $request){
        $applicationId = $request->application_id;
        $data = $request->all();

        if ($request->file('ree_note')){

            $file = $request->file('ree_note');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'ree_note.'.$extension;
            $folder_name = "ree_note";
            $path = $folder_name."/".$file_name;

            if($extension == "pdf") {
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('ree_note'),$file_name);

                    $data['ree_note'] = $path;
            }
            else
            {
                return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
            }
        }
    
        NOCSharingCalculationSheet::updateOrCreate(['application_id'=> $applicationId],$data);
        $id = $request->get('application_id');

        NocApplication::where('id',$applicationId)->update(['draft_noc_path' => NULL, 
            'draft_noc_text_path' => NULL]);
        return redirect("noc_sharing_calculation_sheet/" . $id."#".$request->get('redirect_tab'));
    }
}
 