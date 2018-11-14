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
use App\ArrearCalculation;
use App\ServiceChargesRate;

class BillingDetailController extends Controller
{
    public function __construct()
    {
        $this->comman = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    public function index(Request $request, Datatables $datatables) {
	
    	$data['months'] = [
    		'3'  => 'Mar',
    		'4'  => 'Apr',
    		'5'  => 'May',
    		'6'  => 'Jun',
    		'7'  => 'Jul',
    		'8'  => 'Aug',
    		'9'  => 'Sep',
    		'10' => 'Oct',
    		'11' => 'Nov',
    		'12' => 'Dec',
    		'1'  => 'Jan',
    		'2'  => 'Feb',
    	];
    	$data['years'] = [];
    	$data['select_year'] = date('Y') . '-' . (date('y') + 1);
    	$data['select_month'] = [date('m')];
    	$data['real_select_month'] = date('m');
    	$data['society']  = '';
    	$data['building'] = '';
    	$data['tenant'] = '';
    	$data['service_charges']     = '';
    	$data['arreas_calculations'] = '';
    	if($request->has('month') && '' != $request->month) {
        	$data['select_month'] = [$request->month];
        	$data['real_select_month'] = $request->month;
        }

        switch ($data['select_month']) {
        	case '3':
        		$data['select_month'] = ['3'];
        		break;
        	
        	case '2':
        		$data['select_month'] = ['2','1','12'];
        		break;

        	case '1':
        		$data['select_month'] = ['1','11','12'];
        		break;

        	case '4':
        		$data['select_month'] = ['4','3'];
        		break;

        	default:
        		if($data['select_month'] >= 5 && $data['select_month'] <= 12) {
        			$data['select_month'] = [$data['select_month'],$data['select_month']-1,$data['select_month']-2];
        		} else {
        			$data['select_month'] = $data['select_month'];
        		} 

        		break;
        }
    	if($request->has('building_id') && $request->has('society_id') && '' != $request->building_id && '' != $request->society_id) {
    		$data['society'] = SocietyDetail::find($request->society_id);
    		$data['building'] = MasterBuilding::find($request->building_id);

	    	$data['years'] = ServiceChargesRate::selectRaw('Distinct(year) as years')->where('society_id',$request->society_id)->where('building_id',$request->building_id)->pluck('years','years')->toArray();

	        if($request->has('year') && '' != $request->year) {
	        	$data['select_year'] = $request->year;
	        }

	        $data['service_charges'] = ServiceChargesRate::where('society_id',$request->society_id)->where('building_id',$request->building_id)->where('year',$data['select_year'])->first();

            if($data['select_month'] <= 3){
                $data['arrear_year'] = '20'.explode("-", $data['select_year'])[1];
            } else {
                $data['arrear_year'] = explode("-", $data['select_year'])[0];
            }

	        $data['arreas_calculations'] = ArrearCalculation::selectRaw("
	        	sum(total_amount) as total_amount,
	        	sum(old_intrest_amount+difference_amount) as balance_amount,
	        	sum(old_intrest_amount+difference_intrest_amount)as interest_amount,
	        	month,
	        	year")
	        	->where('society_id',$request->society_id)
	        	->where('building_id',$request->building_id)
	        	->where('year',  $data['arrear_year'])
	        	->whereIn('month',$data['select_month']);

        	if($request->has('tenant_id') && !empty($request->tenant_id)) {
        		$data['tenant'] = MasterTenant::find($request->tenant_id);
            	$data['arreas_calculations'] =  $data['arreas_calculations']->where('tenant_id', $request->tenant_id)->groupBy('tenant_id','year','month');
            }  else {
            	$data['arreas_calculations'] = $data['arreas_calculations']->groupBy('year','month');
            }
                $data['arreas_calculations'] = $data['arreas_calculations']->get();
    	}

        return view('admin.em_department.billing_calculations', $data);
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
