<?php

namespace App\Http\Controllers\conveyance\DYCODepartment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\conveyance\conveyanceCommonController;
use App\Http\Controllers\Common\CommonController;
use App\conveyance\ConveyanceChecklistScrutiny;
use App\conveyance\scApplication;
use App\conveyance\ScApplicationAgreements;
use App\conveyance\ScAgreementComments;
use Config;
use Yajra\DataTables\DataTables;
use Storage;
use Auth;

class DYCOController extends Controller
{
    public function __construct()
    {
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
        $this->common = new conveyanceCommonController();
        $this->CommonController = new CommonController();
    }	
	public function index(Request $request, Datatables $datatables){

        $data = $this->common->listApplicationData($request);

        $columns = [
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'societyApplication.name','name' => 'societyApplication.name','title' => 'Society Name'],
            ['data' => 'societyApplication.building_no','name' => 'societyApplication.building_no','title' => 'building No'],
            ['data' => 'societyApplication.address','name' => 'societyApplication.address','title' => 'Address', 'class' => 'datatable-address'],
             ['data' => 'Status','name' => 'Status','title' => 'Status'],
        ];

        if ($datatables->getRequest()->ajax()) {
            return $datatables->of($data)
                ->editColumn('rownum', function ($data) {
                    static $i = 0; $i++; return $i;
                })
                ->editColumn('radio', function ($data) {
                    $url = route('dyco.conveyance_application', $data->id);
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" name="application_id" onclick="geturl(this.value);" value="'.$url.'" ><span></span></label>';
                })                              
                ->editColumn('societyApplication.name', function ($data) {
                    return $data->societyApplication->name;
                })
                ->editColumn('societyApplication.building_no', function ($data) {
                    return $data->societyApplication->building_no;
                })
                ->editColumn('societyApplication.address', function ($data) {
                    return '<span>'.$data->societyApplication->address.'</span>';
                })                
                ->editColumn('date', function ($data) {
                    return date(config('commanConfig.dateFormat'), strtotime($data->created_at));
                })

                ->editColumn('Status', function ($data) use ($request) {
                    $status = $data->scApplicationLog->status_id;

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
                ->rawColumns(['radio','society_name', 'Status', 'building_name', 'society_address','date','eeApplicationSociety.address'])
                ->make(true);
        }                                    

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());    
        return view('admin.conveyance.dyco_department.index', compact('html','header_data','getData'));    		

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

    public function ViewApplication(Request $request,$applicationId){
        
        $data = $this->common->listApplicationData($request);
        $data->folder = 'dyco_department';
        $data->id = $applicationId;
        return view('admin.conveyance.dyco_department.view_application',compact('data'));
    } 

    //display checklist and office note page
    public function showChecklist(Request $request,$applicationId){

        $data = scApplication::where('id',$applicationId)->first();
        $checklist = ConveyanceChecklistScrutiny::where('application_id',$applicationId)
        ->first();
    	return view('admin.conveyance.dyco_department.checklist_office_note',compact('data','checklist'));
    }

    // save/update checklist data
    public function storeChecklistData(Request $request){

        $applicationId = $request->application_id;
        $arrData = $request->all();
        unset($arrData['_token'],$arrData['registration_date'], $arrData['date'], $arrData['first_flat_issue_date'], $arrData['hps_installement_date'], $arrData['last_date_of_rent'], $arrData['service_tax_date'],$arrData['contruction_competion_date'], $arrData['resolution_meeting_date']);

            ConveyanceChecklistScrutiny::updateOrCreate(['application_id'=>$applicationId],$arrData);        
            ConveyanceChecklistScrutiny::where('application_id',$applicationId)->update([
                'registration_date'          => date('Y-m-d',strtotime($request->registration_date)),
                'date'                       => date('Y-m-d',strtotime($request->date)),
                'first_flat_issue_date'      => date('Y-m-d',strtotime($request->first_flat_issue_date)),
                'hps_installement_date'      => date('Y-m-d',strtotime($request->hps_installement_date)),
                'last_date_of_rent'          => date('Y-m-d',strtotime($request->last_date_of_rent)),
                'service_tax_date'           => date('Y-m-d',strtotime($request->service_tax_date)),
                'contruction_competion_date' => date('Y-m-d',strtotime($request->contruction_competion_date)),
                'resolution_meeting_date'    => date('Y-m-d',strtotime($request->resolution_meeting_date)),
            ]);

        return back()->with('success','data save Successfully.');
    }

    public function uploadNote(Request $request){
    
        $applicationId = $request->application_id;
        if ($request->file('dycdo_note')){

            $file = $request->file('dycdo_note');
            $file_name = time().'_dycdo_note'.'.'.$file->getClientOriginalExtension();

            $extension = $file->getClientOriginalExtension();
            $folder_name = "conveyance_dycdo_note";

            if ($extension == "pdf"){
                $path = $folder_name.'/'.$file_name;
                $delete = Storage::disk('ftp')->delete($request->old_file_name);
                $fileUpload = $this->CommonController->ftpFileUpload($folder_name,$request->file('dycdo_note'),$file_name);

                $note = ConveyanceChecklistScrutiny::where('application_id',$applicationId)
                ->update(['dyco_note' => $path]);
                   
                return back()->with('success','Note uploaded successfully.');                         
            } else {
                return back()->with('pdf_error', 'Invalid type of file uploaded (only pdf allowed).');
            }
        }         
    }

    public function saleLeaseAgreement(Request $request,$applicationId){

        $data = scApplication::with(['scApplicationAgreement','scApplicationLog'])->where('id',$applicationId)->first();
        // dd($data);
        return view('admin.conveyance.dyco_department.sale_lease_agreement',compact('data'));
    }

    public function saveAgreement(Request $request){
 
        $applicationId   = $request->applicationId;
        $sale_agreement  = $request->file('sale_agreement');   
        $lease_agreement = $request->file('lease_agreement'); 
        
        $sale_file_name  = time().'_sale_'.'.'.$sale_agreement->getClientOriginalExtension();  
        $lease_file_name = time().'_lease_'.'.'.$lease_agreement->getClientOriginalExtension();
        
        $sale_extension  = $sale_agreement->getClientOriginalExtension(); 
        $lease_extension = $lease_agreement->getClientOriginalExtension(); 
        
        $sale_folder_name  = "sale_deed_agreement";
        $lease_folder_name = "lease_deed_agreement";
        
        $sale_file_path  = $sale_folder_name.'/'.$sale_file_name;
        $lease_file_path = $lease_folder_name.'/'.$lease_file_name;

        if ($sale_agreement && $lease_agreement) {
            
            if ($sale_extension = $lease_extension == "pdf"){

                $sale_upload = $this->CommonController->ftpFileUpload($sale_folder_name,$request->file('sale_agreement'),$sale_file_name);    

                $lease_upload = $this->CommonController->ftpFileUpload($lease_folder_name,$request->file('lease_agreement'),$lease_file_name);

                    $fileData[] = array('draft_sale_agreement'  => $sale_file_path, 
                                        'draft_lease_agreement' => $lease_file_path,
                                        'application_id'        => $applicationId,
                                        'user_id'               => Auth::Id()); 

                    $comments[] = array('application_id' => $applicationId,
                                        'user_id'        => Auth::Id(),
                                        'role_id'        => session()->get('role_id'),
                                        'remark'         => $request->remark);

                    $data   = ScApplicationAgreements::insert($fileData); 
                    $remark = ScAgreementComments::insert($comments);

                    return back()->with('success', 'Agreements uploaded successfully.');         
            }else{
                return back()->with('error', 'Invalid type of file uploaded (only pdf allowed).');
            }
        }
    }

    public function displayForwardApplication(Request $request,$applicationId){
      
      $data = scApplication::with(['societyApplication','scApplicationLog'])->where('id',$applicationId)->first();
      $parentData = $this->common->getForwardApplicationChildData();
      return view('admin.conveyance.dyco_department.forward_application',compact('data','parentData'));          
    }

    public function saveForwardApplication(Request $request){
    
        $forwardData = $this->common->forwardApplication($request); 
        return redirect('/dyco')->with('success','Application send successfully..');
    }
}
