<?php

namespace App\Http\Controllers\EMDepartment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\CommonController;
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
use App\ServiceChargesRate;

class BillingDetailController extends Controller
{
    public function __construct()
    {
        $this->comman = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    public function index(Request $request, Datatables $datatables) {
    	
    	if($request->has('society_id') && $request->has('building_id') && !empty($request->society_id) && !empty($request->building_id)) {

    		$society  = MasterSociety::find($request->society_id);
	        $building = MasterBuilding::where('society_id', $request->society_id)->find($request->building_id);
	        $years 	  = ServiceChargesRate::selectRaw('Distinct(year) as years')->where('society_id',$request->society_id)->where('building_id',$request->building_id)->pluck('years','years')->toArray();

	        $select_year = '';
	        if($request->has('year') && '' != $request->year) {
	        	$select_year = $request->year;
	        }
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
	            ['data' => 'total', 'name' => 'total','title' => 'Total'],
            	['data' => 'balance_amount', 'name' => 'balance_amount','title' => 'Balance Amount'],
            	['data' => 'interest_amount', 'name' => 'interest_amount','title' => 'Interest Amount'],
            	['data' => 'grand_total', 'name' => 'grand_total','title' => 'Grand Total'],
            	['data' => 'amount_paid', 'name' => 'amount_paid','title' => 'Amount Paid'],
	        ];

	        if ($datatables->getRequest()->ajax()) {
	            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
	            $service_charges = ServiceChargesRate::selectRaw('@rownum  := @rownum  + 1 AS rownum,arrears_charges_rates.*')->where('society_id',$request->society_id)->where('building_id',$request->building_id);
	            return $datatables->of($service_charges)
	            // ->editColumn('actions', function ($arrears_charges){
	            //     return "<a href='".url('arrears_charges/'.$arrears_charges->id.'/edit')."' class='btn m-btn--pill m-btn--custom btn-primary'>Update</a>";
	                
	            // })
	            ->filter(function ($query) use ($request) {
		            if ($request->has('year') && '' != $request->get('year')) {
						$query->where('year',$request->year);
					}
				})
	            // ->rawColumns(['actions'])
	            ->make(true);
	        }
	        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

	        return view('admin.em_department.billing_calculations', compact('html','society','building','years','select_year'));
    	}
    }

    protected function getParameters() {
        return [
        	'searching'  => false,
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"      => [1, "asc" ],
            "pageLength" => $this->list_num_of_records_per_page
        ];
    }
}
