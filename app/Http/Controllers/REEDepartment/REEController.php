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
use App\OlChecklistScrutiny;
use App\OlApplicationStatus;
use App\User;
use Config;
use Auth;
use DB;

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
                return date(config('commanConfig.dateFormat', strtotime($ree_application_data->submitted_at)));
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

        $arrData['application_status'] = $this->CommonController->getCurrentApplicationStatus($applicationId);
        $arrData['get_current_status'] = $this->CommonController->getCurrentStatus($applicationId);

        // CO Forward Application

        $co_id = Role::where('name', '=', config('commanConfig.co_engineer'))->first();
        $arrData['get_forward_co'] = User::where('role_id', $co_id->id)->get();
        $arrData['co_role_name'] = strtoupper(str_replace('_', ' ', $co_id->name));

        return view('admin.REE_department.forward_application',compact('applicationData','arrData'));  
    }             

    public function sendForwardApplication(Request $request){

        $this->CommonController->forwardApplicationForm($request);

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
}
