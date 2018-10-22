<?php

namespace App\Http\Controllers\EMDepartment;

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
use App\ArrearsChargesRate;
use App\ArrearTenantPayment;

class ArreasCalculationController extends Controller
{
    public function __construct()
    {
        $this->comman = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    public function index(Request $request, Datatables $datatables) {
    	if($request->has('society_id') && $request->has('building_id') && !empty($request->society_id) && !empty($request->building_id)) {

    		$society = MasterSociety::find($request->society_id);
	        $building = MasterBuilding::where('society_id', $request->society_id)->find($request->building_id);
	        $years = ArrearsChargesRate::selectRaw('Distinct(year) as years')->where('society_id',$request->society_i)->where('building_id',$request->building_id)->pluck('years','years')->toArray();

	        $columns = [
	            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
	            ['data' => 'year','name' => 'year','title' => 'Years'],
	            ['data' => 'tenant_type', 'name' => 'tenant_type','title' => 'Tenant Type'],
	            ['data' => 'old_rate', 'name' => 'old_rate','title' => 'Old Rate'],
	            ['data' => 'revise_rate', 'name' => 'revise_rate','title' => 'Revise Rate'],
	            ['data' => 'interest_on_old_rate', 'name' => 'interest_on_old_rate','title' => 'Interest On Old Rate'],
	            ['data' => 'interest_on_differance', 'name' => 'interest_on_differance','title' => 'Interest On Difference'],
	            ['data' => 'payment_status', 'name' => 'payment_status','title' => 'Payment Status'],
            	['data' => 'final_rent_amount', 'name' => 'final_rent_amount','title' => 'Final Rent Amount'],
	        ];

	        if ($datatables->getRequest()->ajax()) {
	            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
	            $arrears_charges = ArrearsChargesRate::selectRaw('@rownum  := @rownum  + 1 AS rownum,arrears_charges_rates.*')->where('society_id',$request->society_id)->where('building_id',$request->building_id);
	            return $datatables->of($arrears_charges)
	            // ->editColumn('actions', function ($arrears_charges){
	            //     return "<a href='".url('arrears_charges/'.$arrears_charges->id.'/edit')."' class='btn m-btn--pill m-btn--custom btn-primary'>Update</a>";
	                
	            // })
	            if ($request->has('year') && '' != $request->get('year')) {
					$query->where('year',$request->year);
				}
	            // ->rawColumns(['actions'])
	            ->make(true);
	        }
	        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

	        return view('admin.em_department.arrears_calculations', compact('html','society','building'));
    	}
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
}
