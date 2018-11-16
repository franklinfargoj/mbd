<?php

namespace App\Http\Controllers\EEDepartment;

use App\Http\Controllers\Common\CommonController;
use App\MasterBuilding;
use App\SocietyDetail;
use App\ServiceChargesRate;
use App\MasterTenantType;
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
use Storage,Validator;

class ServiceChargesController extends Controller
{
    public function __construct()
    {
        $this->comman = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    public function serviceChargesRate($society_id,$building_id,Request $request,Datatables $datatables) {
       
        $society_id = decrypt($society_id);
        $building_id = decrypt($building_id);

        $society = SocietyDetail::find($society_id);
        $building = MasterBuilding::where('society_id', $society_id)->find($building_id);

        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'year','name' => 'year','title' => 'Years'],
            ['data' => 'tenant_type', 'name' => 'tenant_type','title' => 'Tenant Type'],
            ['data' => 'water_charges', 'name' => 'water_charges','title' => 'Water Charges'],
            ['data' => 'electric_city_charge', 'name' => 'electric_city_charge','title' => 'Electric City Charge'],
            ['data' => 'pump_man_and_repair_charges', 'name' => 'pump_man_and_repair_charges','title' => 'Pump Man & Repair Charges'],
            ['data' => 'external_expender_charge', 'name' => 'external_expender_charge','title' => 'External  Expender Charge'],
            ['data' => 'administrative_charge', 'name' => 'administrative_charge','title' => 'Administrative  Charge'],
            ['data' => 'lease_rent', 'name' => 'lease_rent','title' => 'Lease Rent.'],
            ['data' => 'na_assessment', 'name' => 'na_assessment','title' => 'N.A.Assessment'],
            ['data' => 'other', 'name' => 'other','title' => 'Other'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
            $service_charges = ServiceChargesRate::selectRaw('@rownum  := @rownum  + 1 AS rownum,service_charges_rates.*')->where('society_id',$society->id)->where('building_id',$building->id);
            return $datatables->of($service_charges)
            ->editColumn('actions', function ($service_charges){

               return "<div class='d-flex btn-icon-list'><a href='".url('service_charges/'.encrypt($service_charges->id).'/edit')."' class='d-flex flex-column align-items-center'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/edit-icon.svg')."'></span>Update</a></div>";

            })
            ->rawColumns(['actions'])
            ->make(true);
        }
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.service_charges.index', compact('html','society','building'));
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

    public function create($society_id,$building_id) {
        
        $society_id = decrypt($society_id);
        $building_id = decrypt($building_id);

    	$data['tenant_types'] = MasterTenantType::pluck('id','name');
       
        //dd($data['tenant_types']);

    	$data['society'] = SocietyDetail::find($society_id);
        $data['building'] = MasterBuilding::where('society_id', $society_id)->find($building_id);
    	return view('admin.service_charges.create',$data);
    }

    public function store($society_id,$building_id,Request $request) {

        $society_id = decrypt($society_id);
        $building_id = decrypt($building_id);

    	$rules = [
    		'year' => 'required',
            'tenant_type' => 'required',            
            'water_charges' => 'required|numeric',
            'electric_city_charge' => 'required|numeric',
            'pump_man_and_repair_charges' => 'required|numeric',
            'external_expender_charge' => 'required|numeric',
            'administrative_charge' => 'required|numeric',
            'lease_rent' => 'required|numeric',
            'na_assessment' => 'required|numeric',
    		'other' => 'required|numeric',
    	];
    	$messages = [
    		'tenant_type.required' => 'Select Tenant Type.'
    	];
    	$validator = Validator::make($request->all(),$rules,$messages);

    	if ($validator->fails()) {
            return redirect('service_charges/'.encrypt($society_id).'/'.encrypt($building_id).'/create')->withErrors($validator)->withInput();
        }

        $society = SocietyDetail::find($society_id);
        $building = MasterBuilding::where('society_id', $society_id)->find($building_id);

        $service_charge = new ServiceChargesRate;
        $service_charge->society_id = $society->id;
        $service_charge->building_id = $building->id;
        $service_charge->year = $request->year;
        $service_charge->tenant_type = $request->tenant_type;
        $service_charge->water_charges = $request->water_charges;
        $service_charge->electric_city_charge = $request->electric_city_charge;
        $service_charge->pump_man_and_repair_charges = $request->pump_man_and_repair_charges;
        $service_charge->external_expender_charge = $request->external_expender_charge;
        $service_charge->administrative_charge = $request->administrative_charge;
        $service_charge->lease_rent = $request->lease_rent;
        $service_charge->na_assessment = $request->na_assessment;
        $service_charge->other = $request->other;
        $service_charge->save();

        $request->session()->flash('success', 'Service rate added successfully!');
        return redirect('service_charges/'.encrypt($society_id).'/'.encrypt($building_id));
    }

    public function edit($id) {
        $id = decrypt($id);
    	$data['tenant_types'] = MasterTenantType::pluck('id','name');
        $data['service_charge'] = ServiceChargesRate::find($id);
    	$data['society'] = SocietyDetail::find($data['service_charge']->society_id);
        $data['building'] = MasterBuilding::where('society_id', $data['service_charge']->society_id)->find($data['service_charge']->building_id);
    	return view('admin.service_charges.edit',$data);
    }

    public function update($id, Request $request) {

        $id = decrypt($id);

    	$rules = [
    		'year' => 'required',
    		'tenant_type' => 'required',
            'water_charges' => 'required|numeric',
            'electric_city_charge' => 'required|numeric',
            'pump_man_and_repair_charges' => 'required|numeric',
            'external_expender_charge' => 'required|numeric',
            'administrative_charge' => 'required|numeric',
            'lease_rent' => 'required|numeric',
            'na_assessment' => 'required|numeric',
            'other' => 'required|numeric',
    	];
    	$messages = [
    		'tenant_type.required' => 'Select Tenant Type.'
    	];
    	$validator = Validator::make($request->all(),$rules,$messages);

    	if ($validator->fails()) {
            return redirect('service_charges/'.encrypt($id).'/edit')->withErrors($validator)->withInput();
        }

        $service_charge = ServiceChargesRate::find($id);
        $service_charge->year = $request->year;
        $service_charge->tenant_type = $request->tenant_type;
        $service_charge->water_charges = $request->water_charges;
        $service_charge->electric_city_charge = $request->electric_city_charge;
        $service_charge->pump_man_and_repair_charges = $request->pump_man_and_repair_charges;
        $service_charge->external_expender_charge = $request->external_expender_charge;
        $service_charge->administrative_charge = $request->administrative_charge;
        $service_charge->lease_rent = $request->lease_rent;
        $service_charge->na_assessment = $request->na_assessment;
        $service_charge->other = $request->other;
        $service_charge->save();

        $request->session()->flash('success', 'Service rate updated successfully!');
        return redirect('service_charges/'.encrypt($service_charge->society_id).'/'.encrypt($service_charge->building_id));
    }
}
