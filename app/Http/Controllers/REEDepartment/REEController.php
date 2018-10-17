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
use App\SocietyOfferLetter;
use App\OlSocietyDocumentsStatus;
use App\OlConsentVerificationDetails;
use App\OlDemarcationVerificationDetails;
use App\OlTitBitVerificationDetails;
use App\OlRelocationVerificationDetails;
use App\OlApplicationCalculationSheetDetails;
use App\OlChecklistScrutiny;
use App\OlApplicationStatus;
use App\User;
use Config;
use Auth;
use DB;
use PDF;
use File;
use Storage;
use Illuminate\Support\Facades\Session;

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
                $url = route('ree.view_application', $ree_application_data->id);
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
        
        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $societyDocuments = $this->CommonController->getSocietyEEDocuments($applicationId);
       return view('admin.REE_department.society_EE_documents',compact('ol_application','societyDocuments'));
    }

    // EE - Scrutiny & Remark page
    public function eeScrutinyRemark(Request $request,$applicationId){

        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $eeScrutinyData = $this->CommonController->getEEScrutinyRemark($applicationId);
        return view('admin.REE_department.EE_Scrunity_Remark',compact('ol_application','eeScrutinyData'));
    }   

    // DyCE Scrutiny & Remark page
    public function dyceScrutinyRemark(Request $request,$applicationId){

        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $applicationData = $this->CommonController->getDyceScrutinyRemark($applicationId);
        return view('admin.REE_department.dyce_scrunity_remark',compact('ol_application','applicationData'));
    }

    // Forward Application page
    public function forwardApplication(Request $request, $applicationId){

        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $applicationData = $this->CommonController->getForwardApplication($applicationId);

        $this->CommonController->getEEForwardRevertLog($applicationData,$applicationId);
        $this->CommonController->getDyceForwardRevertLog($applicationData,$applicationId);

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
        $eelogs = $this->CommonController->getLogsOfEEDepartment($applicationId);
        $dyceLogs = $this->CommonController->getLogsOfDYCEDepartment($applicationId);

        return view('admin.REE_department.forward_application',compact('applicationData','arrData','ol_application','eelogs','dyceLogs'));  
    }             

    public function sendForwardApplication(Request $request){

//        dd($request->all());
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

        return redirect('/ree_applications')->with('success','Application send successfully.');

    }

    public function downloadCapNote(Request $request, $applicationId){

        $ol_application = $this->CommonController->getOlApplication($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $capNote = $this->CommonController->downloadCapNote($applicationId);
        return view('admin.REE_department.cap_note',compact('capNote','ol_application'));
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

        return view('admin.REE_department.'.$blade,compact('applicatonId','calculationData','content'));
    }

    public function saveOfferLetter(Request $request){

        $id = $request->applicationId;
        $content = str_replace('_', "", $_POST['ckeditorText']);
        $folder_name = 'Draft_offer_letter';

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($content);
        $fileName = time().'draft_offer_letter_'.$id.'.pdf';
        $filePath = $folder_name."/".$fileName;

        if (!(Storage::disk('ftp')->has($folder_name))) {            
            Storage::disk('ftp')->makeDirectory($folder_name, $mode = 0777, true, true);
        } 
        Storage::disk('ftp')->put($filePath, $pdf->output());

        //text offer letter

        $folder_name1 = 'text_offer_letter';

        if (!(Storage::disk('ftp')->has($folder_name1))) {            
            Storage::disk('ftp')->makeDirectory($folder_name1, $mode = 0777, true, true);
        }        
        $file_nm =  time()."text_offer_letter_".$id.'.txt';
        $filePath1 = $folder_name1."/".$file_nm;

        Storage::disk('ftp')->put($filePath1, $content);

        OlApplication::where('id',$request->applicationId)->update(["drafted_offer_letter" => $filePath, "text_offer_letter" => $filePath1]);

        return redirect('generate_offer_letter/'.$request->applicationId);
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

    public function approvedOfferLetter(Request $request,$applicationId){

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

    public function viewApplication(Request $request, $applicationId){

        $ol_application = $this->CommonController->downloadOfferLetter($applicationId);
        $ol_application->folder = 'REE_department';

        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        
        return view('admin.common.offer_letter', compact('ol_application'));
    }

    public function showCalculationSheet($id)
    {
        $applicationId = $id;
        $user = $this->CommonController->showCalculationSheet($applicationId);
        $ol_application = $this->CommonController->getOlApplication($applicationId); //echo "<pre>";print_r($ol_application);exit;
        $ol_application->folder = 'REE_department';
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();
        $calculationSheetDetails = $user->calculationSheetDetails;
        $dcr_rates = $user->dcr_rates;
        $blade = $user->blade;
        $arrData['reeNote'] = $user->areeNote;
        // dd($blade);
        return view('admin.common.'.$blade,compact('calculationSheetDetails','applicationId','user','dcr_rates','arrData','ol_application'));

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
        $societyDocument = $this->CommonController->getSocietyEEDocuments($applicationId);
        $ol_application->model = OlApplication::with(['ol_application_master'])->where('id',$applicationId)->first();

        $ol_application->status = $this->CommonController->getCurrentStatus($applicationId);
        return view('admin.REE_department.society_reval_documents', compact('societyDocument','ol_application'));
    }
}
