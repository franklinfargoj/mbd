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
use App\SocietyDetail;
use App\MasterBuilding;
use App\MasterTenant;
use App\ArrearsChargesRate;
use App\ArrearCalculation;

class ArrearsCalculationController extends Controller
{
    public function __construct()
    {
        $this->comman = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    public function index(Request $request, Datatables $datatables) {

    	if($request->has('society_id') && $request->has('building_id') && !empty($request->society_id) && !empty($request->building_id)) {

    		$society  = SocietyDetail::find($request->society_id);
	        $building = MasterBuilding::where('society_id', $request->society_id)->find($request->building_id);
	        $years 	  = ArrearsChargesRate::selectRaw('Distinct(year) as years')->where('society_id',$request->society_id)->where('building_id',$request->building_id)->pluck('years','years')->toArray();

	        $select_year = date('Y') . '-' . (date('y') + 1);
	        if($request->has('year') && '' != $request->year) {
	        	$select_year = $request->year;
	        }
	        $tenant = '';
	        $columns = [
	            ['data' => 'rownum','name' => 'rownum','title' => 'Sr No.','searchable' => false],
	            ['data' => 'month','name' => 'month','title' => 'Month'],
	            ['data' => 'year','name' => 'year','title' => 'Years'],
	            ['data' => 'tenant_type', 'name' => 'tenant_type','title' => 'Tenant Type'],
	            ['data' => 'old_rate', 'name' => 'old_rate','title' => 'Old Rate'],
	            ['data' => 'revise_rate', 'name' => 'revise_rate','title' => 'Revise Rate'],
	            ['data' => 'interest_on_old_rate', 'name' => 'interest_on_old_rate','title' => 'Interest On Old Rate'],
	            ['data' => 'interest_on_differance', 'name' => 'interest_on_differance','title' => 'Interest On Difference'],
	            ['data' => 'payment_status', 'name' => 'payment_status','title' => 'Payment Status'],
            	['data' => 'total_amount', 'name' => 'final_rent_amount','title' => 'Final Rent Amount'],
	        ];

	        if($request->has('tenant_id') && !empty($request->tenant_id)) {
	            $tenant = MasterTenant::find($request->tenant_id);
	        }  
	        if ($datatables->getRequest()->ajax()) {
	            DB::statement(DB::raw('set @rownum='. (isset($request->start) ? $request->start : 0) ));
	            $arrear_calculations = ArrearCalculation::selectRaw('@rownum  := @rownum  + 1 AS rownum,arrear_calculation.*')->where('society_id',$request->society_id)->where('building_id',$request->building_id);

	            $arrear_charges = ArrearsChargesRate::Where('year',$select_year)->where('society_id',$request->society_id)->where('building_id',$request->building_id)->first();

	            if($request->has('tenant_id') && !empty($request->tenant_id)) {
	            	$arrear_calculations = $arrear_calculations->where('tenant_id', $request->tenant_id);
	            }  

	            return $datatables->of($arrear_calculations)
	            ->editColumn('tenant_type', function ($arrear_calculations) use ($arrear_charges){
	                return $arrear_charges->tenant_type;
	                
	            })
	            ->editColumn('old_rate', function ($arrear_calculations) use ($arrear_charges){
	                return $arrear_charges->old_rate;
	                
	            })
	            ->editColumn('revise_rate', function ($arrear_calculations) use ($arrear_charges){
	                return $arrear_charges->revise_rate;
	                
	            })
	            ->editColumn('interest_on_old_rate', function ($arrear_calculations) use ($arrear_charges){
	                return $arrear_charges->interest_on_old_rate;
	                
	            })
	            ->editColumn('interest_on_differance', function ($arrear_calculations) use ($arrear_charges){
	                return $arrear_charges->interest_on_differance;
	                
	            })
	            ->editColumn('month', function ($arrear_calculations){
	                return date("M", strtotime("2001-" . $arrear_calculations->month . "-01"));
	                
	            })
	            ->editColumn('payment_status', function ($arrear_calculations){
	                switch ($arrear_calculations->payment_status) {
	                	case PAYMENT_STATUS_NOT_PAID:
	                		return 'Not Paid';
	                		break;
	                	
	                	case PAYMENT_STATUS_PAID:
	                		return 'Paid';
	                		break;

	                	default:
	                		return 'Not Paid';
	                		break;
	                }
	                
	            })
	            ->filter(function ($query) use ($request) {
		            if ($request->has('year') && '' != $request->get('year')) {
						$query->where('year',$request->year);
					}
				})
	            // ->rawColumns(['actions'])
	            ->make(true);
	        }
	        
	        $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());

	        return view('admin.em_department.arrears_calculations', compact('html','society','building','years','select_year','tenant'));
    	}
    }

    protected function getParameters() {
        return [
        	'searching'  => false,
            'serverSide' => true,
            'processing' => true,
            'ordering'   =>'isSorted',
            "order"      => [1, "asc" ],
            "pageLength" => $this->list_num_of_records_per_page,
            "dom" => 'Bfrtip',
            "buttons" => ['csv', 'excel', 'pdf', 'print'],
        ];
    }
}
