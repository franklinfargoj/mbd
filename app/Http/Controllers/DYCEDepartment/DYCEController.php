<?php

namespace App\Http\Controllers\DYCEDepartment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

class DYCEController extends Controller
{
    public function __construct()
    {
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

            $dyce_application_data = OlApplication::with(['olApplicationStatus' => function($q){
                $q->where('user_id', '1')
                    ->where('role_id', '2');
            }, 'eeApplicationSociety'])
            ->whereHas('olApplicationStatus', function($q){
                $q->where('user_id', '1')
                    ->where('role_id', '2');
            });

            $dyce_application_data = $dyce_application_data->selectRaw( DB::raw('@rownum  := @rownum  + 1 AS rownum').', application_no, ol_applications.id as id, submitted_at, society_id, current_status_id');
            // dd($dyce_application_data);


            return $datatables->of($dyce_application_data)

                ->editColumn('society_name', function ($dyce_application_data) {
                    return $dyce_application_data->eeApplicationSociety->name;
                })
                ->editColumn('building_name', function ($dyce_application_data) {
                    return $dyce_application_data->eeApplicationSociety->building_no;
                })
                ->editColumn('society_address', function ($dyce_application_data) {
                    return $dyce_application_data->eeApplicationSociety->address;
                })                
                ->editColumn('date', function ($dyce_application_data) {
                    return $dyce_application_data->submitted_at;
                })
                ->editColumn('actions', function ($dyce_application_data) {
                   return view('admin.DYCE_department.action', compact('dyce_application_data'))->render();
                })                
                ->rawColumns(['society_name', 'building_name', 'society_address','date','actions'])
                ->make(true);
         }                                    

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
        return view('admin.DYCE_department.index', compact('html','header_data','getData'));    	
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [6, "desc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    } 

    // function used to DyCE Scrutiny & Remark page
    public function dyceScrutinyRemark(Request $request,$applicationId){

        $applicationDocuments = OlApplication::join('ol_site_visit_documents','ol_site_visit_documents.application_id','ol_applications.id')->where('ol_applications.id',$applicationId)->get(); 
                   
        $applicationData = OlApplication::with(['eeApplicationSociety'])
                            ->where('id',$applicationId)->first();


        if(isset($applicationData))                   
        $applicationData->SiteVisitorOfficers = explode(",",$applicationData->site_visit_officers);                                      
       
        return view('admin.DYCE_department.scrutiny_remark',compact('applicationData','applicationDocuments'));
    } 

    // function used to update details and upload documents by DYCE 
    public function store(Request $request){

        $applicationId = $request->applicationId;

        if (isset($request->documentId))
            $removeDocument = olSiteVisitDocuments::where('application_id',$applicationId)->whereNotIn('id',$request->documentId)->delete();
        else
            $removeDocument = olSiteVisitDocuments::where('application_id',$applicationId)->delete();

        $olApplication = OlApplication::find($applicationId);                           
        $olApplication->update([
            'demarkation_verification_comment' => $request->demarkation_comments,
            'date_of_site_visit'               => $request->visit_date,
            'site_visit_officers'              => implode(",",$request->officer_name),
            'is_encrochment'                   => $request->encrochment,
            'encrochment_verification_comment' => $request->encrochment_comments
            ]);

        $uploadPath      = '/uploads/dyceDocuments';
        $destinationPath = public_path($uploadPath);

        if ($request->file('document')){
            foreach ($request->file('document') as $file){

                $file_name = time().$file->getFileName().'.'.$file->getClientOriginalExtension();

                if($file->move($destinationPath, $file_name))
                {
                    $fileData[] = array('document_path' => $uploadPath.'/'.$file_name, 'application_id' => $applicationId);
                }
            }
            olSiteVisitDocuments::insert($fileData);  
            // return Redirect::route('/dyce_scrutiny_remark/{{$applicationId}}');             
        }
    } 

    // society and EE documents
    public function societyEEDocuments(Request $request,$applicationId){

        $societyId = OlApplication::where('id',$applicationId)->value('society_id');       
        $societyDocuments = SocietyOfferLetter::with(['societyDocuments.documents_Name'])->where('id',$societyId)->get();

       return view('admin.DYCE_department.society_EE_documents',compact('societyDocuments')); 
    }

    // EE - Scrutiny & Remark page
    public function eeScrutinyRemark(Request $request,$applicationId){

        $eeScrutinyData = OlApplication::with(['eeApplicationSociety.societyDocuments.documents_Name'])
                ->where('id',$applicationId)->first();
         
        $this->getVerificationDetails($eeScrutinyData,$applicationId);         
        $this->getChecklistDetails($eeScrutinyData,$applicationId);                  

        return view('admin.DYCE_department.EE_Scrutiny_Remark',compact('eeScrutinyData'));
    }

    //get all verifivation details submitted by EE
    protected function getVerificationDetails($eeScrutinyData,$applicationId){
        
        $eeScrutinyData ->consentQuetions = OlConsentVerificationDetails::with('consentQuestions')->where('application_id',$applicationId)->get();

        $eeScrutinyData->DemarkQuetions = OlDemarcationVerificationDetails::with('DemarkQuestions')->where('application_id',$applicationId)->get(); 

        $eeScrutinyData->TitBitQuetions = OlTitBitVerificationDetails::with('TitBitQuestions')->where('application_id',$applicationId)->get(); 

        $eeScrutinyData->relocationQuetions = OlRelocationVerificationDetails::with('relocationQuestions')->where('application_id',$applicationId)->get();  
    }

    // get all checklist details submitted by EE
    protected function getChecklistDetails($eeScrutinyData,$applicationId){

        $eeScrutinyData->Consent_checklist = OlChecklistScrutiny::where('application_id',$applicationId)->where('verification_type','CONSENT VERIFICATION')->first(); 

        $eeScrutinyData->Demark_checklist = OlChecklistScrutiny::where('application_id',$applicationId)->where('verification_type','DEMARCATION')->first(); 

        $eeScrutinyData->TitBit_checklist = OlChecklistScrutiny::where('application_id',$applicationId)->where('verification_type','TIT BIT')->first(); 

        $eeScrutinyData->Relocation_checklist = OlChecklistScrutiny::where('application_id',$applicationId)->where('verification_type','RG RELOCATION')->first(); 
        
    }

    // Forward Application page
    public function forwardApplication(Request $request, $applicationId){

        // $role = User::with(['roles.parent.parentUser'])->where('id', '2')->first();
        // dd($role);
        $applicationData = OlApplication::with(['eeApplicationSociety'])
                ->where('id',$applicationId)->first();  
             
        return view('admin.DYCE_department.forward_application',compact('applicationData'));  
    }

    // forward or revert forward Application
    public function sendForwardApplication(Request $request){

        dd($request);
        if ($request->remarks_suggestion == '0'){
            $data = [
                'application_id' => $request->applicationId,
                'user_id'        => $request->remarks_suggestion,
                'role_id'        => $request->to_role_id,
                'status_id'      => $request->remarks_suggestion,
                'to_user_id'     => $request->to_user_id,
                'remark'         => $request->remark,
            ];  
        }else{
            $data = [
                'application_id' => $request->applicationId,
                'user_id'        => $request->remarks_suggestion,
                'role_id'        => $request->remarks_suggestion,
                'status_id'      => $request->remarks_suggestion,
                'to_user_id'     => $request->remarks_suggestion,
                'remark'         => $request->remark,
            ];
        }
        // OlApplicationStatus::insert($data);
    }
}


