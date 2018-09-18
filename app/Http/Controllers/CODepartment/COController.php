<?php

namespace App\Http\Controllers\CODepartment;

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

class COController extends Controller
{
    public function __construct()
    {
        $this->CommonController = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');        
    }	

    public function index(Request $request, Datatables $datatables){
		
		$getData = $request->all();
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date'],
            ['data' => 'society_name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'building_name','name' => 'eeApplicationSociety.building_no','title' => 'building No'],
            ['data' => 'society_address','name' => 'eeApplicationSociety.address','title' => 'Address'],
            // ['data' => 'model','name' => 'model','title' => 'Model'],
            // ['data' => 'status','name' => 'status','title' => 'Status'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {

            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));          

            $co_application_data = OlApplication::with(['olApplicationStatus' => function($q){
                $q->where('user_id', Auth::id())
                    ->where('role_id', Auth::user()->role_id);
            }, 'eeApplicationSociety'])
            ->whereHas('olApplicationStatus', function($q){
                $q->where('user_id', Auth::id())
                    ->where('role_id', Auth::user()->role_id);
            });

            $co_application_data = $co_application_data->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').', application_no, ol_applications.id as id, submitted_at, society_id, current_status_id');

            return $datatables->of($co_application_data)

                ->editColumn('society_name', function ($co_application_data) {
                    return $co_application_data->eeApplicationSociety->name;
                })
                ->editColumn('building_name', function ($co_application_data) {
                    return $co_application_data->eeApplicationSociety->building_no;
                })
                ->editColumn('society_address', function ($co_application_data) {
                    return $co_application_data->eeApplicationSociety->address;
                })                
                ->editColumn('date', function ($co_application_data) {
                    return $co_application_data->submitted_at;
                })
                ->editColumn('actions', function ($co_application_data) {
                   return view('admin.co_department.action', compact('co_application_data'))->render();
                })                
                ->rawColumns(['society_name', 'building_name', 'society_address','date','actions'])
                ->make(true);
        }        
    	        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
            
            return view('admin.co_department.index', compact('html','header_data','getData'));    
   	
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"      => [6, "desc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    } 

    // society and EE documents
    public function societyEEDocuments(Request $request,$applicationId){
       
        $societyDocuments = $this->CommonController->getSocietyEEDocuments($applicationId);
       return view('admin.co_department.society_EE_documents',compact('societyDocuments'));
    }

    // EE - Scrutiny & Remark page
    public function eeScrutinyRemark(Request $request,$applicationId){

        $eeScrutinyData = $this->CommonController->getEEScrutinyRemark($applicationId);
        return view('admin.co_department.EE_Scrunity_Remark',compact('eeScrutinyData'));
    }

    // DyCE Scrutiny & Remark page
    public function dyceScrutinyRemark(Request $request,$applicationId){

        $applicationData = $this->CommonController->getDyceScrutinyRemark($applicationId);
        return view('admin.co_department.dyce_scrunity_remark',compact('applicationData'));
    }

    // Forward Application page
    public function forwardApplication(Request $request, $applicationId){

        $applicationData = $this->CommonController->getForwardApplication($applicationId);
        return view('admin.co_department.forward_application',compact('applicationData'));  
    }


}
