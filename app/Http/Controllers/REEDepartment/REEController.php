<?php

namespace App\Http\Controllers\REEDepartment;

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
use App\OlDemarcationVerificationDetails;
use App\OlTitBitVerificationDetails;
use App\OlRelocationVerificationDetails;
use App\OlApplicationCalculationSheetDetails;
use App\OlCustomCalculationMasterModel;
use App\OlCustomCalculationSheet;
use App\OlChecklistScrutiny;
use App\OlApplicationStatus;
use App\NocApplicationStatus;
use App\NocCCApplicationStatus;
use App\NocSrutinyQuestionMaster;
use App\NocReeScrutinyAnswer;
use App\Http\Controllers\SocietyNocController;
use App\Http\Controllers\SocietyNocforCCController;
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
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address','class' => 'datatable-address', 'searchable' => false],
            // ['data' => 'model','name' => 'model','title' => 'Model'],
            ['data' => 'Status','name' => 'Status','title' => 'Status'],
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
                return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="village_data_id"><span></span></label>';
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
            "order"      => [1, "asc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    } 

    public function societyEEDocuments(Request $request,$applicationId){
        
        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $societyDocuments = $this->CommonController->getSocietyEEDocuments($applicationId);
       return view('admin.REE_department.society_EE_documents',compact('ol_application','societyDocuments'));
    }

    // EE - Scrutiny & Remark page
    public function eeScrutinyRemark(Request $request,$applicationId){

        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $eeScrutinyData = $this->CommonController->getEEScrutinyRemark($applicationId);
        return view('admin.REE_department.EE_Scrunity_Remark',compact('ol_application','eeScrutinyData'));
    }   

    // DyCE Scrutiny & Remark page
    public function dyceScrutinyRemark(Request $request,$applicationId){

        $applicationId = decrypt($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $applicationData = $this->CommonController->getDyceScrutinyRemark($applicationId);
        return view('admin.REE_department.dyce_scrunity_remark',compact('ol_application','applicationData'));
    }

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

        $co_id = Role::where('name', '=', config('commanConfig.co_engineer'))->first();
        if($arrData['get_current_status']->status_id != config('commanConfig.applicationStatus.offer_letter_approved'))
        {
            $arrData['get_forward_co'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                                ->where('lu.layout_id', session()->get('layout_id'))
                                ->where('role_id', $co_id->id)->get();
            $arrData['co_role_name'] = strtoupper(str_replace('_', ' ', $co_id->name));
        }

        //remark and history
        $eelogs   = $this->CommonController->getLogsOfEEDepartment($applicationId);
        $dyceLogs = $this->CommonController->getLogsOfDYCEDepartment($applicationId);
        $reeLogs  = $this->CommonController->getLogsOfREEDepartment($applicationId); 
        $coLogs   = $this->CommonController->getLogsOfCODepartment($applicationId); 
        $capLogs  = $this->CommonController->getLogsOfCAPDepartment($applicationId); 
        $vpLogs   = $this->CommonController->getLogsOfVPDepartment($applicationId); 

          // dd($ol_application->offer_letter_document_path);
        return view('admin.REE_department.forward_application',compact('applicationData','arrData','ol_application','eelogs','dyceLogs','reeLogs','coLogs','capLogs','vpLogs'));  
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

        $co_id = Role::where('name', '=', config('commanConfig.co_engineer'))->first();
        if($arrData['get_current_status']->status_id != config('commanConfig.applicationStatus.offer_letter_approved'))
        {
            $arrData['get_forward_co'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                ->where('lu.layout_id', session()->get('layout_id'))
                ->where('role_id', $co_id->id)->get();
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

//        dd($request->all());
        $arrData['get_current_status'] = $this->CommonController->getCurrentStatus($request->applicationId);

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

        if($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.offer_letter_generation'))
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
            
            $calculationData = OlApplication::with(['premiumCalculationSheet','eeApplicationSociety'])->where('id',$applicatonId)->first();  
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

        return view('admin.REE_department.'.$blade,compact('applicatonId','calculationData','content','table1','custom','summary'));
    }

    public function editRevalOfferLetter(Request $request,$applicatonId){

        $model = OlApplication::with('ol_application_master')->where('id',$applicatonId)->first();
        if ($model->ol_application_master->model == 'Premium'){

            $calculationData = OlApplication::with(['premiumCalculationSheet','eeApplicationSociety'])->where('id',$applicatonId)->first();
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

        return view('admin.REE_department.'.$blade,compact('applicatonId','calculationData','content','table1','custom','summary'));
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
        return redirect('generate_offer_letter/'.$applicationId)->with('success','Offer Letter generated successfully..');
    }

    public function saveRevalOfferLetter(Request $request){

        $id = $request->applicationId;
        $content = str_replace('_', "", $_POST['ckeditorText']);
        $folder_name = 'Draft_offer_letter';

        $header_file = view('admin.REE_department.offer_letter_header');
        $footer_file = view('admin.REE_department.offer_letter_footer');
        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadHTML($header_file.$content.$footer_file);

        $fileName = time().'draft_offer_letter_'.$id.'.pdf';
        $filePath = $folder_name."/".$fileName;

        if (!(Storage::disk('ftp')->has($folder_name))) {
            Storage::disk('ftp')->makeDirectory($folder_name, $mode = 0777, true, true);
        }
        Storage::disk('ftp')->put($filePath, $pdf->output());
        $file = $pdf->output();

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

        return redirect('generate_reval_offer_letter/'.$request->applicationId);
    }

    public function uploadOfferLetter(Request $request,$applicationId){
        
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

        $this->CommonController->getREEForwardRevertLog($applicationData,$applicationId); 
       
       // get Co log
        $co = Role::where('name',config('commanConfig.co_engineer'))->value('id');
        $applicationData->coLog = OlApplicationStatus::where('application_id',$applicationId)->where('role_id',$co)->where('status_id', config('commanConfig.applicationStatus.forwarded'))->orderBy('id', 'desc')->first();   

        return view('admin.REE_department.approved_offer_letter',compact('applicationData','ol_application','ree_head'));
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

        // dd($request->applicationId);
        $co_id = Role::where('name', '=', config('commanConfig.co_engineer'))->first();
        $get_forward_co = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                            ->where('lu.layout_id', session()->get('layout_id'))
                            ->where('role_id', $co_id->id)->first();   

        $this->CommonController->forwardApplicationToCoForOfferLetterGeneration($request,$get_forward_co);

        return redirect()->back();                 
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
        
        return view('admin.common.offer_letter', compact('ol_application'));
    }

    public function showCalculationSheet($id)
    {
        $applicationId = decrypt($id);
        // $applicationId = $id;
        $user = $this->CommonController->showCalculationSheet($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId); 
        $this->getCustomCalculationData($ol_application,$applicationId);
        $summary = $this->getSummaryData($applicationId);
        
        // $ol_application->folder = 'REE_department';
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $calculationSheetDetails = $user->calculationSheetDetails;
        $dcr_rates = $user->dcr_rates;
        $blade = $user->blade;
        $arrData['reeNote'] = $user->areeNote;

        //latest calculation data
        $custom = OlCustomCalculationSheet::where('application_id',$applicationId)->orderBy('updated_at','DESC')
        ->value('updated_at');
        $premium = OlApplicationCalculationSheetDetails::where('application_id',$applicationId)
        ->orderBy('updated_at','DESC')->value('updated_at');  

        if ($custom > $premium){
            $route = 'admin.REE_department.view_custom_premium_calculation_sheet';            
        }  else{
            $route = 'admin.common.'.$blade;
        }  
        $status = $this->CommonController->getCurrentStatus($applicationId); 
        $reeNote = REENote::where('application_id',$applicationId)->orderBy('id','DESC')->first(); 
        $ol_application->folder = $this->getCurrentRoleFolderName();
        $buldingNumber = OlCustomCalculationSheet::where('application_id',$applicationId)
            ->where('title','total_no_of_buildings')->value('amount');
       
        return view($route,compact('calculationSheetDetails','applicationId','user','dcr_rates','arrData','ol_application','summary','status','reeNote','folder','buldingNumber'));

    }


    public function showRevalCalculationSheet($id)
    {
        $applicationId = $id;
        $user = $this->CommonController->showCalculationSheet($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId); //echo "<pre>";print_r($ol_application);exit;
        $ol_application->folder = 'REE_department';
        $folder = 'REE_department';
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $calculationSheetDetails = $user->calculationSheetDetails;
        $dcr_rates = $user->dcr_rates;
        $blade = $user->blade;
        $arrData['reeNote'] = $user->areeNote;
        // dd($blade);
        return view('admin.common.'.$blade,compact('calculationSheetDetails','applicationId','user','dcr_rates','arrData','ol_application','folder'));

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
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address','class' => 'datatable-address', 'searchable' => false],
            // ['data' => 'model','name' => 'model','title' => 'Model'],
            ['data' => 'Status','name' => 'Status','title' => 'Status'],
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
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="village_data_id"><span></span></label>';
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
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        return view('admin.REE_department.show_calculation_sheet',compact('ol_application'));
    }
    // display custom calculation sheet for premium
    public function displayCustomCalculationSheet(Request $request,$applicationId){
        
        $user = Auth::user(); 
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
         
        if (session()->get('role_name') == config('commanConfig.ree_junior') && ($status->status_id == config('commanConfig.applicationStatus.offer_letter_generation') || ($status->status_id == config('commanConfig.applicationStatus.in_process')) || $status->status_id == config('commanConfig.applicationStatus.draft_offer_letter_generated'))) {
             $route = 'admin.REE_department.custom_premium_calculation_sheet';
        }  else{
            $route = 'admin.REE_department.view_custom_premium_calculation_sheet';
        }

        $folder = $this->getCurrentRoleFolderName();
        return view($route,compact('ol_application','user','summary','status','reeNote','buldingNumber','folder')); 
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
        
        if ($request->total_no_of_buildings){

            $buldingNumber = OlCustomCalculationSheet::where('application_id',$request->application_id)
            ->where('title','total_no_of_buildings')
            ->where('user_id',Auth::id())->first();    
            
            if(!isset($buldingNumber)){
                $buldingNumber = new OlCustomCalculationSheet();
            }

            $buldingNumber->application_id =  $request->application_id;      
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

                      $calculationData = OlCustomCalculationSheet::where('application_id',$request->application_id)
                        ->where('user_id',Auth::id())->where('parent_id',$parentId)
                        ->where('title',$data['title'])->first(); 
                    }
                    
                    else if(isset($data['hiddenId'])){

                        $calculationData = OlCustomCalculationSheet::where('id',$data['hiddenId'])
                        ->where('application_id',$request->application_id)
                        ->where('user_id',Auth::id())->where('parent_id',$parentId)->first();
                    
                    } 
                    else{
                         $calculationData = new OlCustomCalculationSheet();
                    }
                    if (!isset($calculationData)){
                        $calculationData = new OlCustomCalculationSheet();
                    }

                    $calculationData->application_id = $request->application_id;
                    $calculationData->user_id        = Auth::id();
                    $calculationData->parent_id      = $parentId;
                    $calculationData->title          = $data['title'];
                    $calculationData->amount         = $data['amount'];
                    $calculationData->save();                  
                }                
            }
        }
        return redirect("custom_calculation_sheet/" . $request->get('application_id')."#".$request->get('redirect_tab'));
    }

    public function nocApplicationList(Request $request, Datatables $datatables)
    {
        $getData = $request->all();
        $columns = [
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address','class' => 'datatable-address', 'searchable' => false],
            ['data' => 'Model','name' => 'Model','title' => 'Model'],
            ['data' => 'Status','name' => 'Status','title' => 'Status'],
        ];
        if ($datatables->getRequest()->ajax()) {
            $noc_application_data = $this->CommonController->listApplicationDataNoc($request);
              
            return $datatables->of($noc_application_data)
                ->editColumn('rownum', function ($listArray) {
                     static $i = 0; $i++; return $i;
                })
            ->editColumn('radio', function ($noc_application_data) {
                $url = route('ree.view_application_noc', $noc_application_data->id);
                return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="village_data_id"><span></span></label>';
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
                    return $noc_application_data->noc_application_master->model;
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

       return view('admin.REE_department.society_noc_documents',compact('noc_application','societyDocuments'));
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
        
        $model = NocApplication::with('noc_application_master','eeApplicationSociety','request_form')->where('id',$applicatonId)->first();

        if ($model->noc_application_master->model == 'Premium'){
            $blade =  "premum_noc_letter";
        }elseif($model->noc_application_master->model == 'Sharing'){
            $blade =  "sharing_iod_noc_letter";
        }

        if($model->draft_noc_text_path){

            $content = Storage::disk('ftp')->get($model->draft_noc_text_path); 
                   
        }else{
           $content = ""; 
        }

        return view('admin.REE_department.'.$blade,compact('applicatonId','content','model'));
    }

    public function saveDraftNoc(Request $request){

        $noc_application = $this->CommonController->getNocApplication($request->applicationId);

        $id = $request->applicationId;
        $content = str_replace('_', "", $_POST['ckeditorText']);
        $folder_name = 'Draft_noc';

        /*$header_file = view('admin.REE_department.offer_letter_header');        
        $footer_file = view('admin.REE_department.offer_letter_footer');*/
        $header_file = '';
        $footer_file = '';

        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadHTML($header_file.$content.$footer_file);

        $fileName = time().'draft_noc_'.$id.'.pdf';
        $filePath = $folder_name."/".$fileName;

        if (!(Storage::disk('ftp')->has($folder_name))) {            
            Storage::disk('ftp')->makeDirectory($folder_name, $mode = 0777, true, true);
        } 
        Storage::disk('ftp')->put($filePath, $pdf->output());
        $file = $pdf->output();

        $folder_name1 = 'text_noc';

        if (!(Storage::disk('ftp')->has($folder_name1))) {            
            Storage::disk('ftp')->makeDirectory($folder_name1, $mode = 0777, true, true);
        }        
        $file_nm =  time()."text_noc".$id.'.txt';
        $filePath1 = $folder_name1."/".$file_nm;

        Storage::disk('ftp')->put($filePath1, $content);

        NocApplication::where('id',$request->applicationId)->update(["draft_noc_path" => $filePath, "draft_noc_text_path" => $filePath1]);

        \Session::flash('success_msg', 'Changes in Noc draft has been saved successfully..');

        if((session()->get('role_name') == config('commanConfig.ree_junior')) && !empty($noc_application->final_draft_noc_path) && ($noc_application->noc_generation_status != config('commanConfig.applicationStatus.NOC_Issued')))
        {
            return redirect('approved_noc_letter/'.$request->applicationId)->with('success', 'Changes in NOC has been incorporated successfully.');
        }

        return redirect('generate_noc/'.$request->applicationId);
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
        $arrData['get_last_status'] = NocApplicationStatus::where([
                'application_id' =>  $application_id,
                'user_id' => Auth::user()->id,
                'role_id' => session()->get('role_id')
            ])->orderBy('id', 'desc')->first();

        return view('admin.REE_department.scrutiny-remark-noc', compact('arrData','noc_application'));
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
        if($arrData['get_current_status']->status_id != config('commanConfig.applicationStatus.NOC_Issued'))
        {
            $arrData['get_forward_co'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                                ->where('lu.layout_id', session()->get('layout_id'))
                                ->where('role_id', $co_id->id)->get();
            $arrData['co_role_name'] = strtoupper(str_replace('_', ' ', $co_id->name));
        }

        //remark and history
        $reeLogs  = $this->CommonController->getLogsOfREEDepartmentForNOC($applicationId); 
        $coLogs   = $this->CommonController->getLogsOfCODepartmentForNOC($applicationId); 

          // dd($ol_application->offer_letter_document_path);
        return view('admin.REE_department.forward_application_noc',compact('applicationData','arrData','noc_application','reeLogs','coLogs'));  
    }

    public function sendForwardNocApplication(Request $request){

        $noc_application = $this->CommonController->getNocApplication($request->applicationId);

        $arrData['get_current_status'] = $this->CommonController->getCurrentStatusNoc($request->applicationId);

        if(session()->get('role_name') == config('commanConfig.ree_junior') && $noc_application->noc_generation_status == 0 && !empty($noc_application->final_draft_noc_path))
        {
            NocApplication::where('id',$request->applicationId)->update(["noc_generation_status" => config('commanConfig.applicationStatus.NOC_Generation')]);

            $noc_application = $this->CommonController->getNocApplication($request->applicationId);
        }

        if($noc_application->noc_generation_status == '0' && (session()->get('role_name') == config('commanConfig.ree_branch_head')) && empty($noc_application->final_draft_noc_path))
        {
            $this->CommonController->revertNocApplicationToSociety($request);
        }
        elseif($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.NOC_Generation') || ($noc_application->noc_generation_status == config('commanConfig.applicationStatus.NOC_Generation') && session()->get('role_name') == config('commanConfig.ree_junior')))
        {
            $this->CommonController->generateNOCREE($request);
        }
        elseif($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.NOC_Issued'))
        {
             $this->CommonController->forwardApprovedNocApplication($request);
        }
        else
        {
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

        return view('admin.REE_department.approved_noc_cert',compact('applicationData','noc_application','ree_head'));
    }

    public function sendissuedNOCToSociety(Request $request){

        $this->CommonController->forwardNocApplicationToSociety($request);
        return redirect('/ree_noc_applications')->with('success','Issued Noc has been successfully sent to society.');
        
    }

    public function nocforCCApplicationList(Request $request, Datatables $datatables)
    {
        $getData = $request->all();
        $columns = [
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address','class' => 'datatable-address', 'searchable' => false],
            ['data' => 'Model','name' => 'Model','title' => 'Model'],
            ['data' => 'Status','name' => 'Status','title' => 'Status'],
        ];
        $noc_application_data = $this->CommonController->listApplicationDataNocforCC($request);
        if ($datatables->getRequest()->ajax()) {
            $noc_application_data = $this->CommonController->listApplicationDataNocforCC($request);
              
            return $datatables->of($noc_application_data)
                ->editColumn('rownum', function ($listArray) {
                     static $i = 0; $i++; return $i;
                })
            ->editColumn('radio', function ($noc_application_data) {
                $url = route('ree.view_application_noc_cc', $noc_application_data->id);
                return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="village_data_id"><span></span></label>';
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
                    return $noc_application_data->noc_application_master->model;
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
        $header_file = '';
        $footer_file = '';

        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadHTML($header_file.$content.$footer_file);

        $fileName = time().'draft_noc_cc_'.$id.'.pdf';
        $filePath = $folder_name."/".$fileName;

        if (!(Storage::disk('ftp')->has($folder_name))) {            
            Storage::disk('ftp')->makeDirectory($folder_name, $mode = 0777, true, true);
        } 
        Storage::disk('ftp')->put($filePath, $pdf->output());
        $file = $pdf->output();

        $folder_name1 = 'text_noc_cc';

        if (!(Storage::disk('ftp')->has($folder_name1))) {            
            Storage::disk('ftp')->makeDirectory($folder_name1, $mode = 0777, true, true);
        }        
        $file_nm =  time()."text_noc_cc".$id.'.txt';
        $filePath1 = $folder_name1."/".$file_nm;

        Storage::disk('ftp')->put($filePath1, $content);

        NocCCApplication::where('id',$request->applicationId)->update(["draft_noc_path" => $filePath, "draft_noc_text_path" => $filePath1]);

        \Session::flash('success_msg', 'Changes in Noc draft has been saved successfully..');

        if((session()->get('role_name') == config('commanConfig.ree_junior')) && !empty($noc_application->final_draft_noc_path) && ($noc_application->noc_generation_status != config('commanConfig.applicationStatus.NOC_Issued')))
        {
            return redirect('approved_noc_letter/'.$request->applicationId)->with('success', 'Changes in NOC has been incorporated successfully.');
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

                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('noc_letter'),$file_name);

                    $draftNocPath = $folder_name."/".$file_name; 
                    NocCCApplication::where('id',$applicationId)->update(["final_draft_noc_path" => $draftNocPath]);

                    return redirect()->back()->with('success', 'Draft copy of Noc has been uploaded successfully.');
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
            $arrData['get_forward_co'] = User::leftJoin('layout_user as lu', 'lu.user_id', '=', 'users.id')
                                ->where('lu.layout_id', session()->get('layout_id'))
                                ->where('role_id', $co_id->id)->get();
            $arrData['co_role_name'] = strtoupper(str_replace('_', ' ', $co_id->name));
        }

        //remark and history
        $reeLogs  = $this->CommonController->getLogsOfREEDepartmentForNOCforCC($applicationId); 
        $coLogs   = $this->CommonController->getLogsOfCODepartmentForNOCforCC($applicationId); 

          // dd($ol_application->offer_letter_document_path);
        return view('admin.REE_department.forward_application_noc_cc',compact('applicationData','arrData','noc_application','reeLogs','coLogs'));  
    }

    public function sendForwardNocforCCApplication(Request $request){

        $noc_application = $this->CommonController->getNocforCCApplication($request->applicationId);

        $arrData['get_current_status'] = $this->CommonController->getCurrentStatusNocCC($request->applicationId);

        if(session()->get('role_name') == config('commanConfig.ree_junior') && $noc_application->noc_generation_status == 0 && !empty($noc_application->final_draft_noc_path))
        {
            NocCCApplication::where('id',$request->applicationId)->update(["noc_generation_status" => config('commanConfig.applicationStatus.NOC_Generation')]);

            $noc_application = $this->CommonController->getNocforCCApplication($request->applicationId);
        }

        if($noc_application->noc_generation_status == '0' && (session()->get('role_name') == config('commanConfig.ree_branch_head')) && empty($noc_application->final_draft_noc_path))
        {
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

    public function dashboard(){
        $role_id = session()->get('role_id');

        $user_id = Auth::id();

        $applicationData = $this->getApplicationData($role_id,$user_id);

        $statusCount = $this->getApplicationStatusCount($applicationData);

        // REE Roles
        $ree = $this->CommonController->getREERoles();

        $dashboardData = $this->getREEDashboardData($role_id,$ree,$statusCount);

        $reeHeadId = Role::where('name',config('commanConfig.ree_branch_head'))->value('id');

        $dashboardData1 = NULL;
        if($role_id == $reeHeadId){
            $dashboardData1 = $this->CommonController->getTotalCountsOfApplicationsPending();
        }

        //Noc dashboard -- Sayan

        $nocModuleController = new SocietyNocController();
        $nocApplication = $nocModuleController->getApplicationListDashboard('REE');

        //Noc for CC dashboard -- Sayan

        $nocforCCModuleController = new SocietyNocforCCController();
        $nocforCCApplication = $nocforCCModuleController->getApplicationListDashboard('REE');

        return view('admin.REE_department.dashboard',compact('dashboardData','dashboardData1','nocApplication','nocforCCApplication'));
    }

    public function getApplicationData($role_id,$user_id){
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
            })->get()->toArray();

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
            'sepeartion'=> ['Total Pending Applications'=> $inProcess,
                    'Total Pending Proposals'=> $offerLetterGeneration],
            ];
        return $count;

    }

    public function getREEDashboardData($role_id,$ree,$statusCount)
    {

//        dd('perparing for dashboard data');
        switch ($role_id) {
            case ($ree['REE Junior Engineer']):
                $dashboardData['Total No of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total No of Applications'][1] = '';

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
                $dashboardData['Total No of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total No of Applications'][1] = '';

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
                $dashboardData['Total No of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total No of Applications'][1] = '';

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
                $dashboardData['Total No of Applications'][0] = $statusCount['totalApplication'];
                $dashboardData['Total No of Applications'][1] = '';

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



}
