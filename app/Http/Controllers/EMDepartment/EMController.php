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
use App\MasterBuilding;
use App\MasterTenant;
use App\SocietyDetail;
use App\ServiceChargesRate;
use App\ArrearCalculation;


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

    protected function getParameters() {
        return [
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"=> [1, "asc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    }

    public function getsocieties(Request $request){
        if($request->input('id')){            
            $wards = MasterWard::where('layout_id', '=', $request->input('id'))->pluck('id');
            $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');
            $societies = SocietyDetail::whereIn('colony_id', $colonies)->paginate(10);
            return view('admin.em_department.ajax_society', compact('societies'));

        } elseif(!empty($request->input('search'))) {

          $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
          $layout_data = MasterLayout::whereIn('id', $layouts)->get();
          $wards = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
          $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');
          $societies = SocietyDetail::whereIn('colony_id', $colonies)->where('society_name','like', '%'.$request->input('search').'%')->paginate(10);
          return view('admin.em_department.ajax_society', compact('societies'));
        
        } else {

        $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
        $layout_data = MasterLayout::whereIn('id', $layouts)->get();
       // dd($layout_data);
        $wards = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
        //dd($wards);
        $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');
        //dd($colonies);
        $societies = SocietyDetail::whereIn('colony_id', $colonies)->paginate(10);
        //dd($societies);
        if($request->has('search')) {
            return view('admin.em_department.ajax_society', compact('societies'));  
        } else {
            return view('admin.em_department.society', compact('layout_data','societies'));
        }
      }
        
    }

    public function getbuildings($id, Request $request){
        //$societies = SocietyDetail::whereIn('colony_id', $colonies)->get();
       // dd($id);

        if(!empty($request->input('search'))) {
            $society_id = $id;
            $buildings = MasterBuilding::with('tenant_count')->where('society_id', '=', $id)
                ->where(function ($query) use ($request) {
                  $query->orWhere('name', 'like', '%'.$request->input('search').'%')
                       ->orWhere('building_no', 'like', '%'.$request->input('search').'%');
                })
                ->paginate(10);
            //dd($buildings);
            return view('admin.em_department.ajax_building', compact('buildings', 'society_id'));
        } else {
            $society_id = $id;
            $buildings = MasterBuilding::with('tenant_count')->where('society_id', '=', $id)->paginate(10);
            //dd($buildings);
            if($request->has('search')) {
                return view('admin.em_department.ajax_building', compact('buildings', 'society_id'));  
            } else {
                return view('admin.em_department.building', compact('buildings', 'society_id'));
            }            
        }
        
    }

    public function gettenants($id, Request $request){
         $tenament = DB::table('master_tenant_type')->get();
        if(!empty($request->input('search'))) {
            $building_id = $id;
            $buildings = MasterTenant::where('building_id', '=', $id)
                 ->where(function ($query) use ($request) {
                   $query->orWhere('first_name', 'like', '%'.$request->input('search').'%')
                        ->orWhere('middle_name', 'like', '%'.$request->input('search').'%')
                        ->orWhere('flat_no', 'like', '%'.$request->input('search').'%')
                        ->orWhere('last_name', 'like', '%'.$request->input('search').'%');
                })->paginate(10);
            return view('admin.em_department.ajax_tenant', compact('tenament','buildings', 'building_id'));
        } else {
            $building_id = $id;
            $buildings = MasterTenant::where('building_id', '=', $id)->paginate(10);
            if($request->has('search')) {
                return view('admin.em_department.ajax_tenant', compact('tenament','buildings', 'building_id'));  
            } else {
                return view('admin.em_department.tenant', compact('tenament','buildings', 'building_id'));
            }
        }
        
    }

    public function soc_bill_level($id){
        $society = SocietyDetail::where('id','=',$id)->get();
        //dd($society);
        $soc_bill_level = DB::table('master_society_bill_level')->get();
       // dd($soc_bill_level);
        return view('admin.em_department.soc_bill_level', compact('society','soc_bill_level'));
    }

    public function soc_ward_colony($id){
        $society = SocietyDetail::where('id','=',$id)->get();
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

    public function get_wards(Request $request){
    
        if($request->input('id')){
        $wards = MasterWard::where('layout_id', '=', $request->input('id'))->get();

        $html = '<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="wards" name="wards">';
        $html .= '<option value="" style="font-weight: normal;">Select ward</option>';

            foreach($wards as $key => $value){
                $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
            }   
        $html .= '</select>';         

        return $html;
        }
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

    public function get_society_select(Request $request){
    
        if($request->input('id')){
        $society = SocietyDetail::where('colony_id', '=', $request->input('id'))->get();

        $html = '<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="society" name="society">';
        $html .= '<option value="" style="font-weight: normal;">Select Society</option>';

            foreach($society as $key => $value){
                $html .= '<option value="'.$value->id.'">'.$value->society_name.'</option>';
            }   
        $html .= '</select>';         

        return $html;
        }
    }

    public function get_building_ajax(Request $request){

            $society_id = $request->input('id');
            $buildings = MasterBuilding::with('tenant_count')->where('society_id', '=', $request->input('id'))
                        ->get();
            //return $buildings;
            return view('admin.em_department.ajax_building_bill_generation', compact('buildings', 'society_id'));
    }

    public function get_building_select(Request $request){
    
        if($request->input('id')){
        $building = MasterBuilding::where('society_id', '=', $request->input('id'))->get();

        $html = '<select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="building" name="building">';
        $html .= '<option value="" style="font-weight: normal;">Select Building</option>';

            foreach($building as $key => $value){
                $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
            }   
        $html .= '</select>';         

        return $html;
        }
    }

    public function get_tenant_ajax(Request $request){
         $tenament = DB::table('master_tenant_type')->get();
         $building_id = $request->input('id');
         $society_id = MasterBuilding::where('id', '=', $request->input('id'))->first()->society_id;
         $buildings = MasterTenant::where('building_id', '=', $request->input('id'))
                 ->get();
            return view('admin.em_department.ajax_tenant_bill_generation', compact('tenament','buildings', 'building_id', 'society_id'));
    }

    public function update_soc_ward_colony(Request $request){

        $temp = array(       
            'id' => 'required',
            'colony' => 'required' 
        );

        $this->validate($request, $temp);
        
        $society = SocietyDetail::find($request->input('id'));
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

        $society = SocietyDetail::find($request->input('id'));
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

        //return redirect()->back()->with('success', 'Building Added Successfully.');

        return redirect()->route('get_buildings', [$building->society_id])->with('success', 'Building Added Successfully.');
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

       // return redirect()->back()->with('success', 'Building Details Updated Successfully.');
        return redirect()->route('get_buildings', [$building->society_id])->with('success', 'Building Details Updated Successfully.');
    }

    /*
    * Add Tenant 
    * @ param    => Building ID 
    * @ Response => Return View with Building ID.
    */
    public function add_tenant($id){
        $tenament = DB::table('master_tenant_type')->get();
        return view('admin.em_department.add_tenant')->with('building_id', $id)->with('tenament',$tenament);
    }

    /*
    * Add Tenant 
    * @ param    => Request Data. 
    * @ Response => Return Success Message.
    */
    public function create_tenant(Request $request){
        //return $request->all();
         $temp = array(       
        'building_id' => 'required',
        'flat_no' => 'required',
        'salutation' => 'required|alpha',
        'first_name' => 'required|alpha',
        'middle_name' => 'required|alpha',
        'last_name' => 'required|alpha',
        'mobile' => 'required',
        'email_id' => 'required|email',
        'use' => 'required',
        'carpet_area' => 'required', 
        'tenant_type' => 'required'
        );
        // validate the Grievances form data.
        $this->validate($request, $temp);

        $tenant =  new MasterTenant;
        $tenant->building_id = $request->input('building_id');
        $tenant->flat_no = $request->input('flat_no');
        $tenant->salutation = $request->input('salutation');
        $tenant->first_name = $request->input('first_name');
        $tenant->middle_name = $request->input('middle_name');
        $tenant->last_name = $request->input('last_name');
        $tenant->mobile = $request->input('mobile');
        $tenant->email_id = $request->input('email_id');
        $tenant->use = $request->input('use');
        $tenant->carpet_area = $request->input('carpet_area');
        $tenant->tenant_type = $request->input('tenant_type');
        $tenant->save();

        //return redirect()->back()->with('success', 'Tenant Added Successfully.');
        return redirect()->route('get_tenants', [$tenant->building_id])->with('success', 'Tenant Added Successfully.');
    }

    /*
    * Edit Tenant 
    * @ param    => Request id. 
    * @ Response => Return view with tenant details.
    */
    public function edit_tenant($id){
        $tenant = MasterTenant::where('id', '=', $id)->first();
         $tenament = DB::table('master_tenant_type')->get();
        return view('admin.em_department.edit_tenant')->with('tenant', $tenant)->with('tenament',$tenament);
        //return $building;
    }

    /*
    * Update Tenant 
    * @ param    => Request Data. 
    * @ Response => Return view with Success Message.
    */
    public function update_tenant(Request $request){
       // return $request->all();
        $temp = array(       
            'id' => 'required',
        'building_id' => 'required',
        'flat_no' => 'required',
        'salutation' => 'required|alpha',
        'first_name' => 'required|alpha',
        'middle_name' => 'required|alpha',
        'last_name' => 'required|alpha',
        'mobile' => 'required',
        'email_id' => 'required|email',
        'use' => 'required',
        'carpet_area' => 'required', 
        'tenant_type' => 'required'
        );
        // validate the Grievances form data.
        $this->validate($request, $temp);

        $tenant = MasterTenant::find($request->input('id'));
        $tenant->building_id = $request->input('building_id');
        $tenant->flat_no = $request->input('flat_no');
        $tenant->salutation = $request->input('salutation');
        $tenant->first_name = $request->input('first_name');
        $tenant->middle_name = $request->input('middle_name');
        $tenant->last_name = $request->input('last_name');
        $tenant->mobile = $request->input('mobile');
        $tenant->email_id = $request->input('email_id');
        $tenant->use = $request->input('use');
        $tenant->carpet_area = $request->input('carpet_area');
        $tenant->tenant_type = $request->input('tenant_type');
        $tenant->save();

        //return redirect()->back()->with('success', 'Tenant Added Successfully.');
        return redirect()->route('get_tenants', [$tenant->building_id])->with('success', 'Tenant Updated Successfully.');
    }

    public function delete_tenant($id){
        $tenant = MasterTenant::find($id);
        $tenant->delete();
        return redirect()->back()->with('success', 'Tenant Removed Successfully.');
    }

    public function generate_soc_bill(Request $request){
        // return $id;
        $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
        $layout_data = MasterLayout::whereIn('id', $layouts)->get();
       // dd($layout_data);
        $wards = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
        $wards_data = MasterWard::whereIn('layout_id', $layouts)->get();

        //dd($wards);
        $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');

        $colonies_data = MasterColony::whereIn('ward_id', $wards)->get();

        //dd($colonies);
        $societies_data = SocietyDetail::where('society_bill_level', '=', '1')->whereIn('colony_id', $colonies)->get();

        //return $rate_card;
        return view('admin.em_department.generate_bill', compact('layout_data', 'wards_data', 'colonies_data','societies_data'));

    }

    public function generate_tenant_bill(Request $request){
            // return $id;
        $layouts = DB::table('layout_user')->where('user_id', '=', Auth::user()->id)->pluck('layout_id');
        $layout_data = MasterLayout::whereIn('id', $layouts)->get();
       // dd($layout_data);
        $wards = MasterWard::whereIn('layout_id', $layouts)->pluck('id');
        $wards_data = MasterWard::whereIn('layout_id', $layouts)->get();

        //dd($wards);
        $colonies = MasterColony::whereIn('ward_id', $wards)->pluck('id');

        $colonies_data = MasterColony::whereIn('ward_id', $wards)->get();

        //dd($colonies);
        $societies = SocietyDetail::whereIn('colony_id', $colonies)->pluck('id');
        $societies_data = SocietyDetail::where('society_bill_level', '=', '2')->whereIn('colony_id', $colonies)->get();

        $building_data = MasterBuilding::whereIn('society_id', $societies)->get();

        //return $rate_card;
        return view('admin.em_department.generate_bill_tenant_level', compact('layout_data', 'wards_data', 'colonies_data','societies_data', 'building_data'));

    }

    public function generateBuildingBill(Request $request) {

        if($request->has('building_id') && '' != $request->building_id) {
            $data['building'] = MasterBuilding::find($request->building_id);
            $data['society'] = SocietyDetail::find($data['building']->society_id);
            $data['serviceChargesRate'] = ServiceChargesRate::selectRaw('Sum(water_charges) as water_charges,sum(electric_city_charge) as electric_city_charge,sum(pump_man_and_repair_charges) as  pump_man_and_repair_charges,sum(external_expender_charge) as external_expender_charge,sum(administrative_charge) as administrative_charge, sum(lease_rent) as lease_rent,sum(na_assessment) as na_assessment, sum(other) as other')->where('building_id',$request->building_id)->where('year',date('Y') . '-' . (date('y') + 1))->first();
            $data['arreasCalculation'] = ArrearCalculation::where('building_id',$request->building_id)->where('year',date('Y') . '-' . (date('y') + 1))->where('payment_status','0')->get();
            
            $data['number_of_tenants'] = MasterBuilding::with('tenant_count')->where('id',$request->building_id)->first();
            $data['month'] = date('m');
            $data['year'] = date('Y') . '-' . (date('y') + 1);
            $data['consumer_number'] = substr(sprintf('%08d', $data['building']->society_id),0,8).'|'.substr(sprintf('%08d', $data['building']->id),0,8);

            return view('admin.em_department.generate_building_bill',$data);
            
        }
    }

    public function generateTenantBill(Request $request) {

        if($request->has('building_id') && '' != $request->building_id && $request->has('tenant_id') && '' != $request->tenant_id) {
            $data['building'] = MasterBuilding::find($request->building_id);
            $data['society'] = SocietyDetail::find($data['building']->society_id);
            $data['tenant'] = MasterTenant::where('building_id',$data['building']->id)->where('id',$request->tenant_id)->first();

            $data['serviceChargesRate'] = ServiceChargesRate::selectRaw('Sum(water_charges) as water_charges,sum(electric_city_charge) as electric_city_charge,sum(pump_man_and_repair_charges) as  pump_man_and_repair_charges,sum(external_expender_charge) as external_expender_charge,sum(administrative_charge) as administrative_charge, sum(lease_rent) as lease_rent,sum(na_assessment) as na_assessment, sum(other) as other')->where('building_id',$request->building_id)->where('year',date('Y') . '-' . (date('y') + 1))->first();
            $data['arreasCalculation'] = ArrearCalculation::where('building_id',$request->building_id)->where('year',date('Y') . '-' . (date('y') + 1))->where('payment_status','0')->get();

            $data['month'] = date('m');
            $data['year'] = date('Y') . '-' . (date('y') + 1);
            $data['consumer_number'] = substr(sprintf('%08d', $data['building']->id),0,8).'|'.substr(sprintf('%08d', $data['tenant']->id),0,8);

            return view('admin.em_department.generate_tenant_bill',$data);

        }
    }
}
