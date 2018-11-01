<?php

namespace App\Http\Controllers\EEDepartment;

use App\Http\Controllers\Common\CommonController;
use App\MasterBuilding;
use App\SocietyDetail;
use App\ArrearsChargesRate;
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

class ArrearsServiceController extends Controller
{
	public function __construct()
    {
        $this->comman = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    public function arrersChargesRate($society_id,$building_id,Request $request,Datatables $datatables) {
        $society = SocietyDetail::find($society_id);
        $building = MasterBuilding::where('society_id', $society_id)->find($building_id);

        $columns = [
            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
            ['data' => 'year','name' => 'year','title' => 'Years'],
            ['data' => 'tenant_type', 'name' => 'tenant_type','title' => 'Tenant Type'],
            ['data' => 'old_rate', 'name' => 'old_rate','title' => 'Old Rate'],
            ['data' => 'revise_rate', 'name' => 'revise_rate','title' => 'Revise Rate'],
            ['data' => 'interest_on_old_rate', 'name' => 'interest_on_old_rate','title' => 'Interest On Old Rate'],
            ['data' => 'interest_on_differance', 'name' => 'interest_on_differance','title' => 'Interest On Difference'],
            ['data' => 'actions','name' => 'actions','title' => 'Actions','searchable' => false,'orderable'=>false],
        ];

        if ($datatables->getRequest()->ajax()) {
            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
            $arrears_charges = ArrearsChargesRate::selectRaw('@rownum  := @rownum  + 1 AS rownum,arrears_charges_rates.*')->where('society_id',$society->id)->where('building_id',$building->id);
            return $datatables->of($arrears_charges)
            ->editColumn('actions', function ($arrears_charges){
                
                return "<div class='d-flex btn-icon-list'><a href='".url('arrears_charges/'.$arrears_charges->id.'/edit')."' class='d-flex flex-column align-items-center'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/edit-icon.svg')."'></span>Update</a></div>";

            })
            ->rawColumns(['actions'])
            ->make(true);
        }
        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

        return view('admin.arrears_charges.index', compact('html','society','building'));
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
    	$data['tenant_types'] = MasterTenantType::pluck('name','name')->toArray();
    	$data['society'] = SocietyDetail::find($society_id);
        $data['building'] = MasterBuilding::where('society_id', $society_id)->find($building_id);
    	return view('admin.arrears_charges.create',$data);
    }

    public function store($society_id,$building_id,Request $request) {
    	$rules = [
    		'year' => 'required',
    		'tenant_type' => 'required',
    	];
    	$messages = [
    		'tenant_type.required' => 'Select Tenant Type.'
    	];
    	$validator = Validator::make($request->all(),$rules,$messages);

    	if ($validator->fails()) {
            return redirect('arrears_charges/'.$society_id.'/'.$building_id.'/create')->withErrors($validator)->withInput();
        }

        $society = SocietyDetail::find($society_id);
        $building = MasterBuilding::where('society_id', $society_id)->find($building_id);

        $arrears_charge = new ArrearsChargesRate;
        $arrears_charge->society_id = $society->id;
        $arrears_charge->building_id = $building->id;
        $arrears_charge->year = $request->year;
        $arrears_charge->tenant_type = $request->tenant_type;
        $arrears_charge->old_rate = $request->old_rate;
        $arrears_charge->revise_rate = $request->revise_rate;
        $arrears_charge->interest_on_old_rate = $request->interest_on_old_rate;
        $arrears_charge->interest_on_differance = $request->interest_on_differance;
        $arrears_charge->save();

        $request->session()->flash('success', 'Service rate added successfully!');
        return redirect('arrears_charges/'.$society_id.'/'.$building_id);
    }

    public function edit($id) {
    	$data['tenant_types'] = MasterTenantType::pluck('name','name')->toArray();
    	$data['arrears_charge'] = ArrearsChargesRate::find($id);
    	$data['society'] = SocietyDetail::find($data['arrears_charge']->society_id);
        $data['building'] = MasterBuilding::where('society_id', $data['arrears_charge']->society_id)->find($data['arrears_charge']->building_id);
    	return view('admin.arrears_charges.edit',$data);
    }

    public function update($id, Request $request) {
    	$rules = [
    		'year' => 'required',
    		'tenant_type' => 'required',
    	];
    	$messages = [
    		'tenant_type.required' => 'Select Tenant Type.'
    	];
    	$validator = Validator::make($request->all(),$rules,$messages);

    	if ($validator->fails()) {
            return redirect('arrears_charges/'.$id.'/edit')->withErrors($validator)->withInput();
        }

        $arrears_charge = ArrearsChargesRate::find($id);
        $arrears_charge->year = $request->year;
        $arrears_charge->tenant_type = $request->tenant_type;
        $arrears_charge->old_rate = $request->old_rate;
        $arrears_charge->revise_rate = $request->revise_rate;
        $arrears_charge->interest_on_old_rate = $request->interest_on_old_rate;
        $arrears_charge->interest_on_differance = $request->interest_on_differance;
        $arrears_charge->save();

        $request->session()->flash('success', 'Service rate updated successfully!');
        return redirect('arrears_charges/'.$arrears_charge->society_id.'/'.$arrears_charge->building_id);
    }
}
