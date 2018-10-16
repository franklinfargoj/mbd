<?php

namespace App\Http\Controllers\EMDepartment;

use App\EENote;
use App\Http\Controllers\Common\CommonController;
use App\OlApplication;
use App\OlApplicationStatus;
use App\OlChecklistScrutiny;
use App\OlConsentVerificationDetails;
use App\OlConsentVerificationQuestionMaster;
use App\OlDemarcationVerificationDetails;
use App\OlDemarcationVerificationQuestionMaster;
use App\OlRelocationVerificationDetails;
use App\OlRgRelocationVerificationQuestionMaster;
use App\OlSocietyDocumentsMaster;
use App\OlSocietyDocumentsStatus;
use App\OlTitBitVerificationDetails;
use App\OlTitBitVerificationQuestionMaster;
use App\Role;
use App\SocietyOfferLetter;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;
use Config;
use DB;
use File;
use Storage;
use App\MasterLayout;
use App\MasterWard;
use App\MasterColony;
use App\MasterSociety;
use App\MasterBuilding;
use App\MasterTenant;

class EMController extends Controller
{
    public function __construct()
    {
        $this->comman = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Datatables $datatables)
    {
        $getData = $request->all();

        //dd(session()->get('layout_id'));
        
        $columns = [
            ['data' => 'radio','name' => 'radio','title' => '','searchable' => false],
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'application_no','name' => 'application_no','title' => 'Application Number'],
            ['data' => 'submitted_at','name' => 'submitted_at','title' => 'Date', 'class' => 'datatable-date'],
            ['data' => 'eeApplicationSociety.name','name' => 'eeApplicationSociety.name','title' => 'Society Name'],
            ['data' => 'eeApplicationSociety.building_no', 'name' => 'eeApplicationSociety.building_no', 'title' => 'Building No'],
            ['data' => 'eeApplicationSociety.address','name' => 'eeApplicationSociety.address','title' => 'Address','class' => 'datatable-address'],
//            ['data' => 'model','name' => 'model','title' => 'Model'],
            ['data' => 'Status','name' => 'current_status_id','title' => 'Status'],
            // ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {

            $ee_application_data =  $this->comman->listApplicationData($request);

            return $datatables->of($ee_application_data)
                ->editColumn('rownum', function ($listArray) {
                    static $i = 0; $i++; return $i;
                })
                ->editColumn('radio', function ($ee_application_data) {
                    $url = route('ee.view_application', $ee_application_data->id);
                    return '<label class="m-radio m-radio--primary m-radio--link"><input type="radio" onclick="geturl(this.value);" value="'.$url.'" name="village_data_id"><span></span></label>';
                })                
                ->editColumn('eeApplicationSociety.name', function ($listArray) {
                    return $listArray->eeApplicationSociety->name;
                })
                ->editColumn('eeApplicationSociety.building_no', function ($listArray) {
                    return $listArray->eeApplicationSociety->building_no;
                })
                ->editColumn('eeApplicationSociety.address', function ($listArray) {
                    return "<span>".$listArray->eeApplicationSociety->address."</span>";
                })
                ->editColumn('Status', function ($listArray) use ($request) {
                    $status = $listArray->olApplicationStatusForLoginListing[0]->status_id;
                    // dd(config('commanConfig.applicationStatusColor.'.$status));
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
                ->editColumn('submitted_at', function ($listArray) {
                    return date(config('commanConfig.dateFormat'), strtotime($listArray->submitted_at));
                })
                // ->editColumn('actions', function ($ee_application_data) use($request) {
                //     return view('admin.ee_department.actions', compact('ee_application_data', 'request'))->render();
                // })
                ->rawColumns(['radio','society_name', 'society_building_no', 'society_address', 'Status', 'submitted_at','eeApplicationSociety.address'])
                ->make(true);
        }
 
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.em_department.index', compact('html','header_data','getData'));
    }

    public function getsocieties(){
        $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
        $layout_data = MasterLayout::whereIn('id', $layouts)->get();
       // dd($layout_data);
        $wards = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
        //dd($wards);
        $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');
        //dd($colonies);
        $societies = MasterSociety::whereIn('colony_id', $colonies)->get();
        //dd($societies);
        return view('admin.em_department.society', compact('layout_data','societies'));
    }

    public function getbuildings($id){
        //$societies = MasterSociety::whereIn('colony_id', $colonies)->get();
       // dd($id);
        $society_id = $id;
        $buildings = MasterBuilding::where('society_id', '=', $id)->get();
        //dd($buildings);
        return view('admin.em_department.building', compact('buildings', 'society_id'));
    }

    public function gettenants($id){
        //$societies = MasterSociety::whereIn('colony_id', $colonies)->get();
       // dd($id);
        $buildings = MasterTenant::where('building_id', '=', $id)->get();
        //dd($buildings);
        return view('admin.em_department.tenant', compact('buildings'));
    }

    public function soc_bill_level($id){
        $society = MasterSociety::where('id','=',$id)->get();
        //dd($society);
        $soc_bill_level = DB::table('master_society_bill_level')->get();
       // dd($soc_bill_level);
        return view('admin.em_department.soc_bill_level', compact('society','soc_bill_level'));
    }

    public function soc_ward_colony($id){
        $society = MasterSociety::where('id','=',$id)->get();
        //dd($society);
        $soc_colony = MasterColony::where('id', '=', $society[0]->colony_id)->first();
        //dd($soc_colony);
        $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
        $layout_data = MasterLayout::whereIn('id', $layouts)->get();
       // dd($layout_data);
        $wards = MasterWard::whereIn('layout_id', $layouts)->get();
        
        $wards_id = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
       
        $colonies = MasterColony::whereIn('ward_id', $wards_id)->get();
        // dd($colonies);
       return view('admin.em_department.soc_ward_colony', compact('society','wards','colonies', 'soc_colony'));
    }

    public function get_colonies(Request $request){
    
        if($request->input('id')){
        $colonies = MasterColony::where('ward_id', '=', $request->input('id'))->get();

        $html = '<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="colony" name="colony">';
        $html .= '<option value="" style="font-weight: normal;">Select Colony</option>';

            foreach($colonies as $key => $value){
                $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
            }   
        $html .= '</select>';         

        return $html;
        }
    }

    public function update_soc_ward_colony(Request $request){

        $temp = array(       
            'id' => 'required',
            'colony' => 'required' 
        );

        $this->validate($request, $temp);
        
        $society = MasterSociety::find($request->input('id'));
        $society->colony_id = $request->input('colony');
        $society->save();

        return redirect()->back()->with('success', 'Society Ward & Colony Details Updated Successfully.');
    }

    public function update_soc_bill_level(Request $request){
        //dd($request->all());
        $temp = array(       
        'id' => 'required',
        'soc_bill_level' => 'required' 
        );
        // validate the Grievances form data.
        $this->validate($request, $temp);

        $society = MasterSociety::find($request->input('id'));
        $society->society_bill_level = $request->input('soc_bill_level');
        $society->save();

        return redirect()->back()->with('success', 'Society billing level Updated Successfully.');
    }
    
    public function add_building($id){
        return view('admin.em_department.add_building')->with('society_id', $id);
    }

    public function create_building(Request $request){
        //return $request->all();
         $temp = array(       
        'society_id' => 'required',
        'name' => 'required',
        'building_no' => 'required' 
        );
        // validate the Grievances form data.
        $this->validate($request, $temp);

        $building =  new MasterBuilding;
        $building->society_id = $request->input('society_id');
        $building->name = $request->input('name');
        $building->building_no = $request->input('building_no');
        $building->description = $request->input('name');
        $building->save();

        return redirect()->back()->with('success', 'Building added Successfully.');
    }

    public function edit_building($id){
        $building = MasterBuilding::where('id', '=', $id)->first();
        return view('admin.em_department.edit_building')->with('building', $building);
        //return $building;
    }

    public function update_building(Request $request){
       // return $request->all();
        $temp = array( 
        'id' => 'required',      
        'society_id' => 'required',
        'name' => 'required',
        'building_no' => 'required' 
        );
        // validate the Grievances form data.
        $this->validate($request, $temp);

        $building = MasterBuilding::find($request->input('id'));
        $building->society_id = $request->input('society_id');
        $building->name = $request->input('name');
        $building->building_no = $request->input('building_no');
        $building->description = $request->input('name');
        $building->save();

        return redirect()->back()->with('success', 'Building Details Updated Successfully.');
    }

}
