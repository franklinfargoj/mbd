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
use App\ArrearsChargesRate;
use App\TransBillGenerate;
use App\BuildingTenantBillAssociation;
use App\TransPayment;

class BillingDetailController extends Controller
{
    public function __construct()
    {
        $this->comman = new CommonController();
        $this->list_num_of_records_per_page = Config::get('commanConfig.list_num_of_records_per_page');
    }

    public function index(Request $request, Datatables $datatables) {
	
    	// $data['months'] = [
    	// 	'3'  => 'Mar',
    	// 	'4'  => 'Apr',
    	// 	'5'  => 'May',
    	// 	'6'  => 'Jun',
    	// 	'7'  => 'Jul',
    	// 	'8'  => 'Aug',
    	// 	'9'  => 'Sep',
    	// 	'10' => 'Oct',
    	// 	'11' => 'Nov',
    	// 	'12' => 'Dec',
    	// 	'1'  => 'Jan',
    	// 	'2'  => 'Feb',
    	// ];
    	$years = [];
    	$select_year = $data['arrear_year']  = date('Y');
    	// $data['select_month'] = [date('m')];
    	// $data['real_select_month'] = date('m');
    	$society  = '';
    	$building = '';
    	$tenant = '';
    	$service_charges     = '';
    	$arreas_calculations = '';
    	// if($request->has('month') && '' != $request->month) {
     //    	$data['select_month'] = [$request->month];
     //    	$data['real_select_month'] = $request->month;
     //    }

        // switch ($data['select_month']) {
        // 	case '3':
        // 		$data['select_month'] = ['3'];
        // 		break;
        	
        // 	case '2':
        // 		$data['select_month'] = ['2','1','12'];
        // 		break;

        // 	case '1':
        // 		$data['select_month'] = ['1','11','12'];
        // 		break;

        // 	case '4':
        // 		$data['select_month'] = ['4','3'];
        // 		break;

        // 	default:
        // 		if($data['select_month'] >= 5 && $data['select_month'] <= 12) {
        // 			$data['select_month'] = [$data['select_month'],$data['select_month']-1,$data['select_month']-2];
        // 		} else {
        // 			$data['select_month'] = $data['select_month'];
        // 		} 

        // 		break;
        // }
    	if($request->has('building_id') && $request->has('society_id') && '' != $request->building_id && '' != $request->society_id) {
    		$request->society_id = decrypt($request->society_id);
            $request->building_id = decrypt($request->building_id);

            $society = SocietyDetail::find($request->society_id);
    		$building = MasterBuilding::with('tenant_count')->find($request->building_id);

	    	$years = ServiceChargesRate::selectRaw('Distinct(year) as years')->where('society_id',$request->society_id)->where('building_id',$request->building_id)->pluck('years','years')->toArray();

	        if($request->has('year') && '' != $request->year) {
	        	$select_year = $data['arrear_year']  = $request->year;
	        }

	        $service_charges = ServiceChargesRate::where('society_id',$request->society_id)->where('building_id',$request->building_id)->where('year',$select_year)->first();

            $arrear_charges =ArrearsChargesRate::where('society_id',$request->society_id)->where('building_id', '=', $request->building_id)
                        ->where('year', '=', $data['arrear_year'])
                        ->first();

            // if($data['select_month'] <= 3){
            //     $data['arrear_year'] = '20'.explode("-", $data['select_year'])[1];
            // } else {
            //     $data['arrear_year'] = explode("-", $data['select_year'])[0];
            // }
            $data['bills'] = [];
            if($request->has('tenant_id') && !empty($request->tenant_id)) {
                
                $data['bills'] = TransBillGenerate::selectRaw('Distinct(bill_month) as bill_month,id')->where('building_id',$request->building_id)->where('tenant_id', '=', decrypt($request->tenant_id))
                                ->where('bill_year', '=', $data['arrear_year'])
                                ->pluck('bill_month','id')->toArray();
            } else {
                $data['bills'] = BuildingTenantBillAssociation::selectRaw('Distinct(bill_month) as bill_month,bill_id')->where('building_id',$request->building_id)
                                ->where('bill_year', '=', $data['arrear_year'])->orderBy('id','DESC')->limit('1')->pluck('bill_month','bill_id')->toArray();
            }

            $data['billIds'] = [];
            if(!empty( $data['bills'])) {
                if($request->has('tenant_id') && !empty($request->tenant_id)) {
                    $data['billIds'] = array_keys( $data['bills']);
                } else {

                    $data['billIds'] = explode(',',array_keys($data['bills'])['0']);
                }
            }

            $reciepts = [];
            $data['bill_no'] = [];
            if($request->has('tenant_id') && !empty($request->tenant_id) && !empty($data['billIds'])) {
                $reciepts = TransPayment::whereIn('bill_no',$data['billIds'])->where('building_id',$request->building_id)->where('tenant_id', '=', decrypt($request->tenant_id))->pluck('bill_no','tenant_id')->toArray();


            } else {
                $reciepts = TransPayment::whereIn('bill_no',$data['billIds'])->where('building_id',$request->building_id)->pluck('id','building_id')->toArray();
                $data['bill_no'] = BuildingTenantBillAssociation::where('building_id',$request->building_id)->pluck('bill_id','building_id')->toArray();

            }
// echo'<pre>';
//             print_r($data['billIds']);
//             print_r($data['bill_no']);
//             exit;
            $amount_paid = [];
            if(!empty($data['billIds'])) {
                if($request->has('tenant_id') && !empty($request->tenant_id)) {
                    $amount_paid = TransBillGenerate::selectRaw('sum(total_bill) as total_bill,tenant_id')->whereIn('id',$data['billIds'])->where('status','paid')->groupBy('building_id')->pluck('total_bill','tenant_id')->toArray();
                } else {
                    $amount_paid = TransBillGenerate::selectRaw('sum(total_bill) as total_bill,building_id')->whereIn('id',$data['billIds'])->where('status','paid')->groupBy('building_id')->pluck('total_bill','building_id')->toArray();
                }
            }

             $columns = [
                ['data' => 'Month,Year','name' => 'Month,Year','title' => 'Month,Year','orderable'=>false],
                ['data' => 'water_charges','name' => 'water_charges','title' => 'Water charges','orderable'=>false],
                ['data' => 'electric_city_charge','name' => 'electric_city_charge','title' => 'Electricity charges','orderable'=>false],
                ['data' => 'pump_man_and_repair_charges','name' => 'pump_man_and_repair_charges','title' => 'Pumpman & Repair charges','orderable'=>false],
                ['data' => 'external_expender_charge','name' => 'external_expender_charge','title' => 'External expender','orderable'=>false],
                ['data' => 'administrative_charge','name' => 'administrative_charge','title' => 'Administrative Charge','orderable'=>false],
                ['data' => 'lease_rent','name' => 'lease_rent','title' => 'Lease rent','orderable'=>false],
                ['data' => 'na_assessment','name' => 'na_assessment','title' => 'N. A. Assessment','orderable'=>false],
                ['data' => 'other','name' => 'other','title' => 'Other Charges','orderable'=>false],
                ['data' => 'total_service_charges','name' => 'total_service_charges','title' => 'Total','orderable'=>false],
                ['data' => 'balance_amount','name' => 'balance_amount','title' => 'Balance amount'],
                ['data' => 'interest_amount','name' => 'interest_amount','title' => 'Interest amount'],
                ['data' => 'grand_total','name' => 'grand_total','title' => 'Grand Total'],
                ['data' => 'amount_paid','name' => 'amount_paid','title' => 'Amount paid'],
                ['data' => 'action','name' => 'action','title' => 'Files (bill & receipt)','orderable'=>false]
            ];
            
	        $arreas_calculations = ArrearCalculation::where('society_id',$request->society_id)
	        	->where('building_id',$request->building_id)
	        	->where('year',  $data['arrear_year'])
                ->whereIn('month', $data['bills']);
                    $total_service_charges = '0';
            if(!empty($service_charges)) {
                $total_service_charges = $service_charges->water_charges + $service_charges->electric_city_charge+$service_charges->pump_man_and_repair_charges+$service_charges->external_expender_charge+$service_charges->administrative_charge+$service_charges->lease_rent+$service_charges->na_assessment+$service_charges->other;
            }

            if($request->has('tenant_id') && !empty($request->tenant_id)) {
                $request->tenant_id = decrypt($request->tenant_id);
                $tenant = MasterTenant::find($request->tenant_id);
                $arreas_calculations =  $arreas_calculations->where('tenant_id', $request->tenant_id);
            }

        	if ($datatables->getRequest()->ajax()) {

                $arreas_calculations = $arreas_calculations->selectRaw('Sum(old_intrest_amount) as old_intrest_amount,Sum(difference_amount) as difference_amount, Sum(difference_intrest_amount) as difference_intrest_amount,tenant_id,building_id,oir_year,oir_month,ida_year,ida_month,month,year')->orderBy('id','DESC')->get();
                return $datatables->of($arreas_calculations)
                    ->editColumn('Month,Year', function ($arreas_calculations) {
                        if(isset($arreas_calculations->month)) {
                            return date("M", mktime(0, 0, 0, $arreas_calculations->month, 10)).','.$arreas_calculations->year;
                        }
                    })
                    ->editColumn('water_charges', function ($arreas_calculations) use($service_charges,$tenant,$building){
                        if(isset($service_charges)) {
                            if(!empty($tenant)&& !empty($service_charges)) {
                                return $service_charges->water_charges;
                            } else {
                                return $service_charges->water_charges*$building->tenant_count()->first()->count;
                            }  
                        }
                    })
                    ->editColumn('electric_city_charge', function ($arreas_calculations) use($service_charges,$tenant,$building){
                        if(isset($service_charges)) {
                            if(!empty($tenant)&& !empty($service_charges)) {
                                return $service_charges->electric_city_charge;
                            } else {
                                return $service_charges->electric_city_charge*$building->tenant_count()->first()->count;
                            }  
                        }
                    })
                    ->editColumn('pump_man_and_repair_charges', function ($arreas_calculations) use($service_charges,$tenant,$building){
                        if(isset($service_charges)) {
                            if(!empty($tenant)&& !empty($service_charges)) {
                                return $service_charges->pump_man_and_repair_charges;
                            } else {
                                return $service_charges->pump_man_and_repair_charges*$building->tenant_count()->first()->count;
                            }
                        }  
                    })
                    ->editColumn('external_expender_charge', function ($arreas_calculations) use($service_charges,$tenant,$building){
                        if(isset($service_charges)) {
                            if(!empty($tenant)&& !empty($service_charges)) {
                                return $service_charges->external_expender_charge;
                            } else {
                                return $service_charges->external_expender_charge*$building->tenant_count()->first()->count;
                            }
                        }  
                    })
                    ->editColumn('administrative_charge', function ($arreas_calculations) use($service_charges,$tenant,$building){
                        if(isset($service_charges)) {
                            if(!empty($tenant)&& !empty($service_charges)) {
                                return $service_charges->administrative_charge;
                            } else {
                                return $service_charges->administrative_charge*$building->tenant_count()->first()->count;
                            }
                        }
                    })
                    ->editColumn('lease_rent', function ($arreas_calculations) use($service_charges,$tenant,$building){
                        if(isset($service_charges)) {
                            if(!empty($tenant)&& !empty($service_charges)) {
                                return $service_charges->lease_rent;
                            } else {
                                return $service_charges->lease_rent*$building->tenant_count()->first()->count;
                            }
                        }  
                    })
                    ->editColumn('na_assessment', function ($arreas_calculations) use($service_charges,$tenant,$building){
                        if(isset($service_charges)) {
                            if(!empty($tenant)&& !empty($service_charges)) {
                                return $service_charges->na_assessment;
                            } else{
                                return $service_charges->na_assessment*$building->tenant_count()->first()->count;
                            }
                        }
                    })
                    ->editColumn('other', function ($arreas_calculations) use($service_charges,$tenant,$building){
                        if(isset($service_charges)) {
                            if(!empty($tenant)&& !empty($service_charges)) {
                                return $service_charges->other;
                            } else {
                                return $service_charges->other*$building->tenant_count()->first()->count;
                            } 
                        }
                    })
                    ->editColumn('total_service_charges', function ($arreas_calculations) use($service_charges,$tenant,$total_service_charges,$building){
                        if(isset($service_charges)) {
                            if(!empty($tenant)&& !empty($service_charges)) {
                                return $total_service_charges;
                            } else {
                                return $total_service_charges*$building->tenant_count()->first()->count;
                            }  
                        }
                    })
                    ->editColumn('balance_amount', function ($arreas_calculations) use($arrear_charges){
                        if(isset($arreas_calculations->month) && isset($arreas_calculations->year)) {
                            $date1 = new \DateTime($arreas_calculations->year.'-'.$arreas_calculations->month.'-1');
                            $date2 = new \DateTime($arreas_calculations->oir_year.'-'.$arreas_calculations->oir_month.'-1');

                            $monthDiff = $date1->diff($date2);
                            $monthDiff = ($monthDiff->format('%y') * 12) + $monthDiff->format('%m');
                       
                            if($monthDiff>0){
                                return $arrear_charges->old_rate * $monthDiff + $arreas_calculations->difference_amount* $monthDiff;
                            } else {
                                return $arrear_charges->old_rate + $arreas_calculations->difference_amount;
                            }
                         }
                    })
                    ->editColumn('interest_amount', function ($arreas_calculations) {
                        if(isset($arreas_calculations->old_intrest_amount) && isset($arreas_calculations->difference_intrest_amount)) {
                            return $arreas_calculations->old_intrest_amount + $arreas_calculations->difference_intrest_amount;
                        }
                    })
                    ->editColumn('grand_total', function ($arreas_calculations) use($tenant,$total_service_charges,$building,$arrear_charges) {
                        if(isset($arreas_calculations->month) && isset($arreas_calculations->year)) {
                            $date1 = new \DateTime($arreas_calculations->year.'-'.$arreas_calculations->month.'-1');
                            $date2 = new \DateTime($arreas_calculations->oir_year.'-'.$arreas_calculations->oir_month.'-1');

                            $monthDiff = $date1->diff($date2);
                            $monthDiff = ($monthDiff->format('%y') * 12) + $monthDiff->format('%m');

                            if($monthDiff>0) {
                                if(!empty($tenant)) {
                                    return ($total_service_charges*$building->tenant_count()->first()->count)+($arrear_charges->old_rate * $monthDiff) + ($arreas_calculations->difference_amount* $monthDiff )+ $arreas_calculations->old_intrest_amount + $arreas_calculations->difference_intrest_amount;
                                } else {
                                    return $total_service_charges+($arrear_charges->old_rate  * $monthDiff) + ($arreas_calculations->difference_amount* $monthDiff)+$arreas_calculations->old_intrest_amount + $arreas_calculations->difference_intrest_amount;
                                }
                            } else {
                                return $total_service_charges+$arrear_charges->old_rate + $arreas_calculations->difference_amount+$arreas_calculations->old_intrest_amount + $arreas_calculations->difference_intrest_amount;
                            }
                        }
                    })
                    ->editColumn('amount_paid', function ($arreas_calculations) use($tenant,$amount_paid) {
                        if(isset($arreas_calculations->tenant_id) || isset($arreas_calculations->building_id) ) {
                            if(!empty($amount_paid) && array_key_exists($arreas_calculations->tenant_id, $amount_paid) && !empty($tenant)){
                                return $amount_paid[$arreas_calculations->tenant_id];
                            } else if(!empty($amount_paid) && array_key_exists($arreas_calculations->building_id, $amount_paid)) {
                                return $amount_paid[$arreas_calculations->building_id];
                            } else {
                                return 0;
                            }
                        }
                     })
                    ->editColumn('action', function ($arreas_calculations) use($tenant,$amount_paid,$building,$reciepts,$society) {
                        if(isset($arreas_calculations->tenant_id) || isset($arreas_calculations->building_id)) {
                            $url = (!empty($tenant))?
                            route('downloadBill', ['building_id'=>encrypt($building->id),
                                        'society_id'=>encrypt($society->id),'month'=> $arreas_calculations->month,'year'=> $arreas_calculations->year,'tenant_id'=>encrypt($tenant->id)]):
                            route('downloadBill', ['building_id'=>encrypt($building->id),
                                        'society_id'=>encrypt($society->id),'month'=> $arreas_calculations->month,'year'=> $arreas_calculations->year]);

                            $button = "<div class='d-flex btn-icon-list'>
                                <a href='".$url."' class='d-flex flex-column align-items-center ' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/view-arrears-calculation-icon.svg')."'></span>Donwload Receipt</a>";
                            if(!empty($reciepts) && array_key_exists($arreas_calculations->tenant_id, $reciepts) && !empty($tenant)) {
                                $url = (!empty($tenant))?
                                    route('downloadReceipt', ['building_id'=>encrypt($building->id),'bill_no'=>encrypt($reciepts[$arreas_calculations->tenant_id]),'tenant_id'=> encrypt($tenant->id)])
                                    :route('downloadReceipt', ['building_id'=>encrypt($building->id),'society_id'=>encrypt($building->society_id),
                                        'bill_no'=>encrypt($reciepts[$arreas_calculations->tenant_id])]);
                                $button.= "<a href='".$url."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/generate-bill-icon.svg')."'></span>View Billing Details</a></div>";

                            } else if(!empty($reciepts) && array_key_exists($arreas_calculations->building_id, $reciepts) && !empty($tenant)) {
                                    $url = (!empty($tenant))?
                                        route('downloadReceipt', ['building_id'=>encrypt($building->id),'bill_no'=>encrypt($reciepts[$arreas_calculations->building_id]),'tenant_id'=> encrypt($tenant->id)])
                                        :route('downloadReceipt', ['building_id'=>encrypt($building->id),'society_id'=>encrypt($building->society_id),'bill_no'=>encrypt($reciepts[$arreas_calculations->building_id])]);

                                     $button.= "<a href='".$url."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/generate-bill-icon.svg')."'></span>View Billing Details</a></div>";
                            }
                            return $button;
                        }
                        
                    })
                    ->rawColumns(['Month,Year','water_charges','electric_city_charge','pump_man_and_repair_charges','external_expender_charge','administrative_charge','lease_rent','na_assessment','other','total_service_charges','balance_amount','interest_amount','grand_total','amount_paid','action'])
                    ->make(true);
                  
            }
            // echo '<pre>';
            // print_r($data['arreas_calculations']);exit;
            $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
    	}

        return view('admin.em_department.billing_calculations', compact('html','data','select_year','years','society','building','tenant'));
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
