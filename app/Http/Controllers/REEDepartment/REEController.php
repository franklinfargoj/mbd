<?php

namespace App\Http\Controllers\REEDepartment;

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
            ->editColumn('actions', function ($ree_application_data) {
               return view('admin.REE_department.action', compact('ree_application_data'))->render();
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
        return view('admin.REE_department.forward_application',compact('applicationData'));  
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
}
