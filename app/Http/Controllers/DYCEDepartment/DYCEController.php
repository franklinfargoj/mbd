<?php

namespace App\Http\Controllers\DYCEDepartment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\olSiteVisitDocuments;
use App\OlApplication;
use App\SocietyOfferLetter;
use Config;

class DYCEController extends Controller
{
    public function __construct()
    {
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }	
    public function index(Request $request, Datatables $datatables){

        $getData = $request->all();
        $applicationData = OlApplication::with(['eeApplicationSociety'])->get();
        // dd($applicationData);
        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'date','name' => 'date','title' => 'Date'],
            ['data' => 'society_name','name' => 'society_name','title' => 'Society Name'],
            ['data' => 'building_name','no' => 'building_o','title' => 'building No'],
            ['data' => 'society_address','name' => 'society_address','title' => 'Address'],
            ['data' => 'model','name' => 'model','title' => 'Model'],
            ['data' => 'status','name' => 'status','title' => 'Status'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
        return view('admin.DYCE_department.index', compact('html','getData'));    	
    }

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [8, "desc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    } 
    // function used to DyCE Scrutiny & Remark page
    public function dyceScrutinyRemark(Request $request){

        $applicationDocuments = OlApplication::join('ol_site_visit_documents','ol_site_visit_documents.application_id','ol_applications.id')->where('ol_applications.id','1')->get(); 

        // dd($applicationDocuments);  
                   
        $applicationId = '1';
        $applicationData = OlApplication::with(['eeApplicationSociety'])
                            ->where('id',$applicationId)->first();        

        if(isset($applicationData))                   
        $applicationData->SiteVisitorOfficers = explode(",",$applicationData->site_visit_officers);                    

        // dd($applicationData->SiteVisitorOfficers);                    
       
        return view('admin.DYCE_department.scrutiny_remark',compact('applicationData','applicationDocuments'));
    } 

    // function used to update details and upload documents by DYCE 
    public function store(Request $request){
        // dd($request->file('document'));
        $applicationId = '1';
        if(isset($request->documentId))
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

        $uploadPath = '/uploads/dyceDocuments';
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
        }
    } 

    public function societyEEDocuments(Request $request){
        $applicationId = 1;
        $societyDocuments = SocietyOfferLetter::with('societyDocuments')->get()->toArray();
        dd($societyDocuments);
        $documents = OlSocietyDocumentsMaster::where('application_id',$applicationId)->get();
       return view('admin.DYCE_department.society_EE_documents'); 
    }
}

