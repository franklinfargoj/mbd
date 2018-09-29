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
            ['data' => 'date','name' => 'date','title' => 'Date'],
            ['data' => 'society_name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'building_name','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'society_address','name' => 'eeApplicationSociety.address','title' => 'Address','searchable' => false],
            // ['data' => 'model','name' => 'model','title' => 'Model'],
            ['data' => 'Status','name' => 'status','title' => 'Status'],
            // ['data' => 'Model','name' => 'Model','title' => 'Model'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {

            $ree_application_data = $this->CommonController->listApplicationData($request);
            
            return $datatables->of($ree_application_data)
            ->editColumn('rownum', function ($listArray) {
                static $i = 0; $i++; return $i;
            })
            ->editColumn('society_name', function ($ree_application_data) {
                return $ree_application_data->eeApplicationSociety->name;
            })
            ->editColumn('building_name', function ($ree_application_data) {
                return $ree_application_data->eeApplicationSociety->building_no;
            })
            ->editColumn('society_address', function ($ree_application_data) {
                return $ree_application_data->eeApplicationSociety->address;
            })                
            ->editColumn('date', function ($ree_application_data) {
                return date(config('commanConfig.dateFormat'), strtotime($ree_application_data->submitted_at));
            })
            ->editColumn('actions', function ($ree_application_data) use($request){
               return view('admin.REE_department.action', compact('ree_application_data', 'request'))->render();
            }) 
            ->editColumn('Status', function ($listArray) use ($request) {
                $status = $listArray->olApplicationStatusForLoginListing[0]->status_id;

                if ($request->update_status)
                {
                    if ($request->update_status == $status){
                        $config_array = array_flip(config('commanConfig.applicationStatus'));
                        $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                        return $value;
                    }
                }else{
                    $config_array = array_flip(config('commanConfig.applicationStatus'));
                    $value = ucwords(str_replace('_', ' ', $config_array[$status]));
                    return $value;
                }

            })
           // ->editColumn('Model', function ($ree_application_data) {
           //          return $ree_application_data->ol_application_master->model;
           //      })
            ->rawColumns(['society_name', 'building_name', 'society_address','date','actions','Status'])
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
            "order"      => [7, "desc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    } 

    public function societyEEDocuments(Request $request,$applicationId){
       
        $societyDocuments = $this->CommonController->getSocietyEEDocuments($applicationId);
       return view('admin.REE_department.society_EE_documents',compact('societyDocuments'));
    }

    // EE - Scrutiny & Remark page
    public function eeScrutinyRemark(Request $request,$applicationId){

        $eeScrutinyData = $this->CommonController->getEEScrutinyRemark($applicationId);
        return view('admin.REE_department.EE_Scrunity_Remark',compact('eeScrutinyData'));
    }   

    // DyCE Scrutiny & Remark page
    public function dyceScrutinyRemark(Request $request,$applicationId){

        $applicationData = $this->CommonController->getDyceScrutinyRemark($applicationId);
        return view('admin.REE_department.dyce_scrunity_remark',compact('applicationData'));
    }

    // Forward Application page
    public function forwardApplication(Request $request, $applicationId){

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


        return view('admin.REE_department.forward_application',compact('applicationData','arrData'));  
    }             

    public function sendForwardApplication(Request $request){

//        dd($request->all());
        $arrData['get_current_status'] = $this->CommonController->getCurrentStatus($request->applicationId);

        if($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.offer_letter_generation'))
        {
            $this->CommonController->forwardApplicationToCoForOfferLetterGeneration($request);
        }
        elseif((session()->get('role_name') == config('commanConfig.ree_branch_head')) && $arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.offer_letter_approved'))
        {
            $this->CommonController->forwardApplicationToSociety($request);
        }
        elseif($arrData['get_current_status']->status_id == config('commanConfig.applicationStatus.offer_letter_approved'))
        {
            $this->CommonController->forwardApprovedApplication($request);
        }
        else
        {
            $this->CommonController->forwardApplicationForm($request);
        }

        return redirect('/ree_applications');

    }

    public function downloadCapNote(Request $request, $applicationId){

        $capNote = $this->CommonController->downloadCapNote($applicationId);
        return view('admin.REE_department.cap_note',compact('capNote'));
    }
    
    public function documentSubmittedBySociety()
    {
        // return view('admin.ee_department.documentSubmitted');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function uploadREENote(Request $request){
        $applicationId   = $request->application_id;
        $uploadPath      = '/uploads/ree_note';
        $destinationPath = public_path($uploadPath);

        if ($request->file('ree_note')){

            $file = $request->file('ree_note');
            $file_name = time().$file->getFileName().'.'.$file->getClientOriginalExtension();
            $extension = $file->getClientOriginalExtension();

            if($extension == "pdf") {
                if ($file->move($destinationPath, $file_name)) {
                    $fileData[] = array('document_path' => $uploadPath . '/' . $file_name,
                        'application_id' => $applicationId,
                        'user_id' => Auth::user()->id,
                        'role_id' => session()->get('role_id'));
                }
                $data = REENote::insert($fileData);
                return back()->with('success', 'REE Note uploaded successfully');
            }
            else
            {
                return back()->with('error', 'Only pdf allowed');
            }
        }
    }

    public function SharingCalculationSheet() {
        return view('admin.REE_department.sharing-calculation-sheet');
    }    

    public function GenerateOfferLetter(Request $request, $applicationId){
        
        $societyData = OlApplication::with(['eeApplicationSociety'])
                ->where('id',$applicationId)->orderBy('id','DESC')->first();

        $societyData->drafted_offer_letter = OlApplication::where('id',$applicationId)->value('drafted_offer_letter');   
        
        return view('admin.REE_department.generate-offer-letter',compact('societyData'));
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
        
        // $calculationData = $this->getPermiumCalculationSheetData($applicatonId);

        $calculationData = OlApplication::with(['premiumCalculationSheet','eeApplicationSociety'])->where('id',$applicatonId)->first();

        // dd($calculationData->eeApplicationSociety->name);

        return view('admin.REE_department.offer_letter_1',compact('applicatonId','calculationData'));
    }

    public function saveOfferLetter(Request $request){
       
        $uploadPath = '/uploads/Draft_offer_letter';
        $destination = public_path($uploadPath);
        $content = str_replace('_', "", $_POST['ckeditorText']);

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($content);
        $fileName = time().'draft_letter_'.$request->applicationId.'.pdf';
        $draftedOfferLetter = $uploadPath."/".$fileName;

        if ((!is_dir($destination))){
            File::makeDirectory($destination, $mode = 0777, true, true);
        }
        $pdf->save($destination."/".$fileName);

        OlApplication::where('id',$request->applicationId)->update(["drafted_offer_letter" => $draftedOfferLetter]);

        return redirect('generate_offer_letter/'.$request->applicationId);
    }

    public function uploadOfferLetter(Request $request,$applicationId){

        $uploadPath      = '/uploads/uploaded_offer_letter';
        $destinationPath = public_path($uploadPath); 
        
        if ($request->file('offer_letter')) {
            $file = $request->file('offer_letter');
            $file_name = time().$file->getFileName().'.'.$file->getClientOriginalExtension();
            $extension = $file->getClientOriginalExtension();

            if ($extension == "pdf") {

                if ($file->move($destinationPath, $file_name)) {

                    $offerLetterPath = $uploadPath."/".$file_name; 
                    OlApplication::where('id',$applicationId)->update(["offer_letter_document_path" => $offerLetterPath]);

                    return redirect()->back()->with('success', 'Successfully uploaded');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid format. pdf file only.');
            }
        }       
    }

    public function approvedOfferLetter(Request $request,$applicationId){

        $applicationData = OlApplication::with(['eeApplicationSociety'])
                ->where('id',$applicationId)->orderBy('id','DESC')->first();

        return view('admin.REE_department.approved_offer_letter',compact('applicationData'));
    }

    public function getPermiumCalculationSheetData($applicationId){
        
        $data = OlApplicationCalculationSheetDetails::where('application_id',$applicationId)->first()
        ;
        return $data;
    }
}
