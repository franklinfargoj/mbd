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
	
    	$years = [];
        $search_year = '';
        $currentMonth = date('m');
        if($currentMonth < 4) {
            $years = [date('Y') -1,date('Y')];
        } else {
            $years = [date('Y'),date('Y')+1];
        }

    	$select_year = $years;
    
    	$society  = '';
    	$building = '';
    	$tenant = '';
    	$service_charges     = '';
    	$arreas_calculations = '';
    	
    	if($request->has('building_id') && $request->has('society_id') && '' != $request->building_id && '' != $request->society_id) {
    		$request->society_id = decrypt($request->society_id);
            $request->building_id = decrypt($request->building_id);

            $society = SocietyDetail::find($request->society_id);
    		$building = MasterBuilding::with('tenant_count')->find($request->building_id);

	    	$years = ServiceChargesRate::selectRaw('Distinct(year) as years')->where('society_id',$request->society_id)->where('building_id',$request->building_id)->pluck('years','years')->toArray();

	        if($request->has('year') && '' != $request->year) {
	        	$select_year = [$request->year];
                $search_year = $request->year;
	        }

	        // $service_charges = ServiceChargesRate::where('society_id',$request->society_id)->where('building_id',$request->building_id)->where('year',$select_year)->first();

         //    $arrear_charges =ArrearsChargesRate::where('society_id',$request->society_id)->where('building_id', '=', $request->building_id)
         //                ->where('year', '=', $data['arrear_year'])
         //                ->first();

            // $data['bills'] = [];
            // if($request->has('tenant_id') && !empty($request->tenant_id)) {
                
            //     $data['bills'] = TransBillGenerate::selectRaw('Distinct(bill_month) as bill_month,id')->where('building_id',$request->building_id)->where('tenant_id', '=', decrypt($request->tenant_id))
            //                     ->where('bill_year', '=', $data['arrear_year'])
            //                     ->pluck('bill_month','id')->toArray();
            // } else {
            //     $data['bills'] = BuildingTenantBillAssociation::selectRaw('Distinct(bill_month) as bill_month,bill_id')->where('building_id',$request->building_id)
            //                     ->where('bill_year', '=', $data['arrear_year'])->orderBy('id','DESC')->limit('1')->pluck('bill_month','bill_id')->toArray();
            // }

            // $data['billIds'] = [];
            // if(!empty( $data['bills'])) {
            //     if($request->has('tenant_id') && !empty($request->tenant_id)) {
            //         $data['billIds'] = array_keys( $data['bills']);
            //     } else {

            //         $data['billIds'] = explode(',',array_keys($data['bills'])['0']);
            //     }
            // }

            // $reciepts = [];
            // $data['bill_no'] = [];
            // if($request->has('tenant_id') && !empty($request->tenant_id) && !empty($data['billIds'])) {
            //     $reciepts = TransPayment::whereIn('bill_no',$data['billIds'])->where('building_id',$request->building_id)->where('tenant_id', '=', decrypt($request->tenant_id))->pluck('bill_no','tenant_id')->toArray();


            // } else {
            //     $reciepts = TransPayment::whereIn('bill_no',$data['billIds'])->where('building_id',$request->building_id)->pluck('id','building_id')->toArray();
            //     $data['bill_no'] = BuildingTenantBillAssociation::where('building_id',$request->building_id)->pluck('bill_id','building_id')->toArray();

            // }
// echo'<pre>';
            // print_r($data['bills']);
            // print_r($data['billIds']);
            // exit;
            // $amount_paid = [];
            // if(!empty($data['billIds'])) {
            //     if($request->has('tenant_id') && !empty($request->tenant_id)) {
            //         $amount_paid = TransBillGenerate::Join('trans_payment', 'trans_payment.bill_no', '=', 'trans_bill_generate.id')->selectRaw('sum(amount_paid) as total_bill,trans_bill_generate.tenant_id as tenant_id')->whereIn('trans_bill_generate.id',$data['billIds'])->where('status','paid')->groupBy('trans_bill_generate.building_id')->pluck('total_bill','tenant_id')->toArray();
            //     } else {
            //         $amount_paid = TransBillGenerate::Join('trans_payment', 'trans_payment.bill_no', '=', 'trans_bill_generate.id')->selectRaw('sum(trans_payment.amount_paid) as total_bill,trans_payment.building_id as building_id')->whereIn('trans_bill_generate.id',$data['billIds'])->groupBy('trans_payment.building_id')->pluck('total_bill','building_id')->toArray();
            //     }
            // }
 // print_r($amount_paid);
 //            exit;

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
            
	        // $arreas_calculations = ArrearCalculation::where('society_id',$request->society_id)
	        // 	->where('building_id',$request->building_id)
	        // 	->where('year',  $data['arrear_year'])
         //        ->whereIn('month', $data['bills']);
            //         $total_service_charges = '0';
            // if(!empty($service_charges)) {
            //     $total_service_charges = $service_charges->water_charges + $service_charges->electric_city_charge+$service_charges->pump_man_and_repair_charges+$service_charges->external_expender_charge+$service_charges->administrative_charge+$service_charges->lease_rent+$service_charges->na_assessment+$service_charges->other;
            // }

            if($request->has('tenant_id') && !empty($request->tenant_id)) {
                $request->tenant_id = decrypt($request->tenant_id);
                $tenant = MasterTenant::find($request->tenant_id);
                // $arreas_calculations =  $arreas_calculations->where('tenant_id', $request->tenant_id);
            }

        	if ($datatables->getRequest()->ajax()) {
                if($request->has('tenant_id') && !empty($request->tenant_id)) {
                    $arreas_calculations = TransBillGenerate::with('trans_payment')->where('trans_bill_generate.society_id',$request->society_id)
                    ->where('trans_bill_generate.building_id',$request->building_id)->join('service_charges_rates', function($join)
                        {
                            $join->on('service_charges_rates.building_id', '=', 'trans_bill_generate.building_id');
                            $join->on('service_charges_rates.society_id','=', 'trans_bill_generate.society_id');
                            $join->on('service_charges_rates.year','=', 'trans_bill_generate.bill_year');
                        })->join('arrear_calculation', function($join)
                        {
                            $join->on('arrear_calculation.building_id', '=', 'trans_bill_generate.building_id');
                            $join->on('arrear_calculation.society_id','=', 'trans_bill_generate.society_id');
                            $join->on('arrear_calculation.year','=', 'trans_bill_generate.bill_year');
                            $join->on('arrear_calculation.month','=', 'trans_bill_generate.bill_month');
                        })
                        ->join('arrears_charges_rates', function($join)
                        {
                            $join->on('arrears_charges_rates.building_id', '=', 'trans_bill_generate.building_id');
                            $join->on('arrears_charges_rates.society_id','=', 'trans_bill_generate.society_id');
                            $join->on('arrears_charges_rates.year','=', 'trans_bill_generate.bill_year');
                        })->selectRaw('trans_bill_generate.*,service_charges_rates.water_charges,service_charges_rates.electric_city_charge,service_charges_rates.pump_man_and_repair_charges,service_charges_rates.external_expender_charge,service_charges_rates.administrative_charge,service_charges_rates.lease_rent,service_charges_rates.na_assessment,service_charges_rates.other,arrear_calculation.old_intrest_amount,arrear_calculation.difference_intrest_amount,arrear_calculation.year as ac_year,arrear_calculation.month as ac_month,arrear_calculation.oir_year,arrear_calculation.oir_month,arrears_charges_rates.old_rate')->whereIn('bill_year',$select_year)->where('trans_bill_generate.tenant_id', $request->tenant_id);
                } else {
                    $arreas_calculations = DB::select('select 
                            sum(balance_amount) as balance_amount,
                            sum(amount_paid) as amount_paid,
                            sum(total_bill) as total_bill,
                            building_id,
                            society_id,
                            water_charges,
                            electric_city_charge,
                            pump_man_and_repair_charges,
                            external_expender_charge,
                            administrative_charge,
                            lease_rent,
                            na_assessment,
                            other,
                            sum(arrear_bill) as arrear_bill,
                            old_intrest_amount,
                            difference_intrest_amount,
                            bill_month,
                            bill_year,
                            bill_no
                            from (SELECT
                                DISTINCT(trans_bill_generate.tenant_id),
                                service_charges_rates.water_charges,
                                service_charges_rates.electric_city_charge,
                                service_charges_rates.pump_man_and_repair_charges,
                                service_charges_rates.external_expender_charge,
                                service_charges_rates.administrative_charge,
                                service_charges_rates.lease_rent,
                                service_charges_rates.na_assessment,
                                service_charges_rates.other,
                                arrear_calculation.old_intrest_amount,
                                arrear_calculation.difference_intrest_amount,
                                arrear_calculation.year AS ac_year,
                                arrear_calculation.month AS ac_month,
                                arrear_calculation.oir_year,
                                arrear_calculation.oir_month,
                                arrears_charges_rates.old_rate,
                                trans_bill_generate.balance_amount,
                                trans_bill_generate.building_id,
                                trans_bill_generate.society_id,
                                trans_payment.amount_paid,
                                trans_bill_generate.arrear_bill,
                                trans_bill_generate.total_bill,
                                trans_bill_generate.bill_month,
                                trans_bill_generate.bill_year,
                                group_concat(trans_payment.bill_no separator ",") as bill_no
                            FROM
                                `trans_bill_generate`
                            INNER JOIN
                                `service_charges_rates`
                            ON
                                `service_charges_rates`.`building_id` = `trans_bill_generate`.`building_id` AND `service_charges_rates`.`society_id` = `trans_bill_generate`.`society_id` AND `service_charges_rates`.`year` = `trans_bill_generate`.`bill_year`
                            INNER JOIN
                                `arrear_calculation`
                            ON
                                `arrear_calculation`.`building_id` = `trans_bill_generate`.`building_id` AND `arrear_calculation`.`society_id` = `trans_bill_generate`.`society_id` AND `arrear_calculation`.`year` = `trans_bill_generate`.`bill_year` AND `arrear_calculation`.`month` = `trans_bill_generate`.`bill_month`
                            INNER JOIN
                                `arrears_charges_rates`
                            ON
                                `arrears_charges_rates`.`building_id` = `trans_bill_generate`.`building_id` AND `arrears_charges_rates`.`society_id` = `trans_bill_generate`.`society_id` AND `arrears_charges_rates`.`year` = `trans_bill_generate`.`bill_year`
                            LEFT JOIN
                                `trans_payment`
                            ON
                                `trans_payment`.`building_id` = `trans_bill_generate`.`building_id` AND `trans_payment`.`society_id` = `trans_bill_generate`.`society_id`
                            WHERE
                                `trans_bill_generate`.`society_id` = '.$request->society_id.' AND `trans_bill_generate`.`building_id` = '.$request->building_id.' AND `bill_year` IN ('.implode(',',$select_year).') AND `trans_bill_generate`.`deleted_at` IS NULL
                            GROUP BY trans_bill_generate.tenant_id
                            ) l');
                }
                 // $arreas_calculations = $arreas_calculations->toSql();   

                // echo '<pre>';
                // print_r($arreas_calculations);exit;
                // $service_charges = '';
                return $datatables->of($arreas_calculations)
                    ->editColumn('Month,Year', function ($arreas_calculations) {
                        if(isset($arreas_calculations->bill_month)) {
                            return date("M", mktime(0, 0, 0, $arreas_calculations->bill_month, 10)).','.$arreas_calculations->bill_year;
                        }
                    })
                    ->editColumn('water_charges', function ($arreas_calculations) use($building,$request){
                        if(isset($arreas_calculations)) {
                            if($request->has('tenant_id') && !empty($arreas_calculations)) {
                                return $arreas_calculations->water_charges;
                            } else {
                                return $arreas_calculations->water_charges*$building->tenant_count()->first()->count;
                            }  
                        }
                    })
                    ->editColumn('electric_city_charge', function ($arreas_calculations) use($service_charges,$building,$request){
                        if(isset($arreas_calculations)) {
                            if($request->has('tenant_id')&& !empty($arreas_calculations)) {
                                return $arreas_calculations->electric_city_charge;
                            } else {
                                return $arreas_calculations->electric_city_charge*$building->tenant_count()->first()->count;
                            }  
                        }
                    })
                    ->editColumn('pump_man_and_repair_charges', function ($arreas_calculations) use($building,$request){
                        if(isset($arreas_calculations)) {
                            if($request->has('tenant_id')&& !empty($arreas_calculations)) {
                                return $arreas_calculations->pump_man_and_repair_charges;
                            } else {
                                return $arreas_calculations->pump_man_and_repair_charges*$building->tenant_count()->first()->count;
                            }
                        }  
                    })
                    ->editColumn('external_expender_charge', function ($arreas_calculations) use($building,$request){
                        if(isset($arreas_calculations)) {
                            if($request->has('tenant_id')&& !empty($arreas_calculations)) {
                                return $arreas_calculations->external_expender_charge;
                            } else {
                                return $arreas_calculations->external_expender_charge*$building->tenant_count()->first()->count;
                            }
                        }  
                    })
                    ->editColumn('administrative_charge', function ($arreas_calculations) use($building,$request){
                        if(isset($arreas_calculations)) {
                            if($request->has('tenant_id')&& !empty($arreas_calculations)) {
                                return $arreas_calculations->administrative_charge;
                            } else {
                                return $arreas_calculations->administrative_charge*$building->tenant_count()->first()->count;
                            }
                        }
                    })
                    ->editColumn('lease_rent', function ($arreas_calculations) use($building,$request){
                        if(isset($arreas_calculations)) {
                            if($request->has('tenant_id')&& !empty($arreas_calculations)) {
                                return $arreas_calculations->lease_rent;
                            } else {
                                return $arreas_calculations->lease_rent*$building->tenant_count()->first()->count;
                            }
                        }  
                    })
                    ->editColumn('na_assessment', function ($arreas_calculations) use($building,$request){
                        if(isset($arreas_calculations)) {
                            if($request->has('tenant_id')&& !empty($arreas_calculations)) {
                                return $arreas_calculations->na_assessment;
                            } else{
                                return $arreas_calculations->na_assessment*$building->tenant_count()->first()->count;
                            }
                        }
                    })
                    ->editColumn('other', function ($arreas_calculations) use($building,$request){
                        if(isset($arreas_calculations)) {
                            if($request->has('tenant_id')&& !empty($arreas_calculations)) {
                                return $arreas_calculations->other;
                            } else {
                                return $arreas_calculations->other*$building->tenant_count()->first()->count;
                            } 
                        }
                    })
                    ->editColumn('total_service_charges', function ($arreas_calculations) use($building,$request){
                        $total_service_charges = '';
                        if(isset($arreas_calculations)) {
                            if($request->has('tenant_id')&& !empty($arreas_calculations)) {
                                $total_service_charges = $arreas_calculations->other+$arreas_calculations->na_assessment+$arreas_calculations->lease_rent+$arreas_calculations->administrative_charge+$arreas_calculations->external_expender_charge+$arreas_calculations->pump_man_and_repair_charges+$arreas_calculations->electric_city_charge+$arreas_calculations->water_charges;
                            } else {
                                $total_service_charges = ($arreas_calculations->other+$arreas_calculations->na_assessment+$arreas_calculations->lease_rent+$arreas_calculations->administrative_charge+$arreas_calculations->external_expender_charge+$arreas_calculations->pump_man_and_repair_charges+$arreas_calculations->electric_city_charge+$arreas_calculations->water_charges)*$building->tenant_count()->first()->count;
                            }  
                        }
                        if($total_service_charges > 0 ) {
                            return $total_service_charges;
                        } else {
                            return NULL;
                        }
                    })
                    ->editColumn('balance_amount', function ($arreas_calculations) use($building,$request){
                        if($request->has('tenant_id') && !empty($request->tenant_id)) {

                            if(!count($arreas_calculations->trans_payment)) {
                                return $arreas_calculations->arrear_bill-($arreas_calculations->old_intrest_amount+ $arreas_calculations->difference_intrest_amount);
                            } elseif(count($arreas_calculations->trans_payment)) {
                                return $arreas_calculations->balance_amount;
                            }
                        } else {
                            if($arreas_calculations->total_bill == $arreas_calculations->balance_amount) {
                                return $arreas_calculations->arrear_bill;
                            } else {
                                return $arreas_calculations->balance_amount;
                            }
                        }
                        // if(isset($arreas_calculations->month) && isset($arreas_calculations->year)) {
                         //    $date1 = new \DateTime($arreas_calculations->year.'-'.$arreas_calculations->month.'-1');
                         //    $date2 = new \DateTime($arreas_calculations->oir_year.'-'.$arreas_calculations->oir_month.'-1');

                         //    $monthDiff = $date1->diff($date2);
                         //    $monthDiff = ($monthDiff->format('%y') * 12) + $monthDiff->format('%m');
                            
                         //    if($monthDiff>0){
                         //        if(empty($tenant)) {
                         //            return $arrear_charges->old_rate *$building->tenant_count()->first()->count + $arreas_calculations->difference_amount* $monthDiff*$building->tenant_count()->first()->count;
                         //        } else {
                         //            return $arrear_charges->old_rate * $monthDiff + $arreas_calculations->difference_amount* $monthDiff;
                         //        }
                         //    } else {
                         //        if(empty($tenant)) {
                         //            // return $arreas_calculations->difference_amount;
                         //            return $arrear_charges->old_rate*$building->tenant_count()->first()->count + $arreas_calculations->difference_amount;
                         //        } else {
                         //            return $arrear_charges->old_rate + $arreas_calculations->difference_amount;
                         //        }
                         //    }
                         // }
                    })
                    ->editColumn('interest_amount', function ($arreas_calculations) use($building,$request){
                        if(isset($arreas_calculations->old_intrest_amount) && isset($arreas_calculations->difference_intrest_amount)) {
                            if($request->has('tenant_id') && !empty($request->tenant_id)) {
                                return ($arreas_calculations->old_intrest_amount+ $arreas_calculations->difference_intrest_amount);
                            } else {
                                return $arreas_calculations->old_intrest_amount+ $arreas_calculations->difference_intrest_amount;
                            }
                        }
                    })
                    ->editColumn('grand_total', function ($arreas_calculations) use($building,$request) {
                        $grand_total = '';
                        if($request->has('tenant_id') && !empty($request->tenant_id)) {
                            if(!count($arreas_calculations->trans_payment)) {
                                $grand_total = ($arreas_calculations->other+$arreas_calculations->na_assessment+$arreas_calculations->lease_rent+$arreas_calculations->administrative_charge+$arreas_calculations->external_expender_charge+$arreas_calculations->pump_man_and_repair_charges+$arreas_calculations->electric_city_charge+$arreas_calculations->water_charges)
                                +($arreas_calculations->arrear_bill-($arreas_calculations->old_intrest_amount+ $arreas_calculations->difference_intrest_amount)) + ($arreas_calculations->old_intrest_amount+ $arreas_calculations->difference_intrest_amount);
                            } else {
                                $grand_total = ($arreas_calculations->other+$arreas_calculations->na_assessment+$arreas_calculations->lease_rent+$arreas_calculations->administrative_charge+$arreas_calculations->external_expender_charge+$arreas_calculations->pump_man_and_repair_charges+$arreas_calculations->electric_city_charge+$arreas_calculations->water_charges)
                                +($arreas_calculations->balance_amount-($arreas_calculations->old_intrest_amount+ $arreas_calculations->difference_intrest_amount)) + ($arreas_calculations->old_intrest_amount+ $arreas_calculations->difference_intrest_amount);
                            }

                        } else {
                            if($arreas_calculations->total_bill == $arreas_calculations->balance_amount) {
                                $grand_total = ($arreas_calculations->other+$arreas_calculations->na_assessment+$arreas_calculations->lease_rent+$arreas_calculations->administrative_charge+$arreas_calculations->external_expender_charge+$arreas_calculations->pump_man_and_repair_charges+$arreas_calculations->electric_city_charge+$arreas_calculations->water_charges)*$building->tenant_count()->first()->count
                                +($arreas_calculations->arrear_bill-($arreas_calculations->old_intrest_amount+ $arreas_calculations->difference_intrest_amount)) + ($arreas_calculations->old_intrest_amount+ $arreas_calculations->difference_intrest_amount);
                            } else {
                                $grand_total = ($arreas_calculations->other+$arreas_calculations->na_assessment+$arreas_calculations->lease_rent+$arreas_calculations->administrative_charge+$arreas_calculations->external_expender_charge+$arreas_calculations->pump_man_and_repair_charges+$arreas_calculations->electric_city_charge+$arreas_calculations->water_charges)*$building->tenant_count()->first()->count
                                +($arreas_calculations->balance_amount-($arreas_calculations->old_intrest_amount+ $arreas_calculations->difference_intrest_amount)) + ($arreas_calculations->old_intrest_amount+ $arreas_calculations->difference_intrest_amount);
                            }
                        }

                        if( 0 < $grand_total ) {
                            return $grand_total;
                        } else {
                            return '';
                        }

                        // if(!count($arreas_calculations->trans_payment)) {
                        //     if(!empty($tenant)) {
                        //     return (
                        //         ($arreas_calculations->other+$arreas_calculations->na_assessment+$arreas_calculations->lease_rent+$arreas_calculations->administrative_charge+$arreas_calculations->external_expender_charge+$arreas_calculations->pump_man_and_repair_charges+$arreas_calculations->electric_city_charge+$arreas_calculations->water_charges)
                        //         +($arreas_calculations->arrear_bill-($arreas_calculations->old_intrest_amount+ $arreas_calculations->difference_intrest_amount)) + ($arreas_calculations->old_intrest_amount+ $arreas_calculations->difference_intrest_amount));
                        //     } else {
                        //         return (
                        //         ($arreas_calculations->other+$arreas_calculations->na_assessment+$arreas_calculations->lease_rent+$arreas_calculations->administrative_charge+$arreas_calculations->external_expender_charge+$arreas_calculations->pump_man_and_repair_charges+$arreas_calculations->electric_city_charge+$arreas_calculations->water_charges)*$building->tenant_count()->first()
                        //         +($arreas_calculations->arrear_bill-($arreas_calculations->old_intrest_amount+ $arreas_calculations->difference_intrest_amount)) + ($arreas_calculations->old_intrest_amount+ $arreas_calculations->difference_intrest_amount));
                        //     }
                        // } else {
                        //     if(!empty($tenant)) {
                        //     return (
                        //         ($arreas_calculations->other+$arreas_calculations->na_assessment+$arreas_calculations->lease_rent+$arreas_calculations->administrative_charge+$arreas_calculations->external_expender_charge+$arreas_calculations->pump_man_and_repair_charges+$arreas_calculations->electric_city_charge+$arreas_calculations->water_charges)
                        //         +($arreas_calculations->balance_amount-($arreas_calculations->old_intrest_amount+ $arreas_calculations->difference_intrest_amount)) + ($arreas_calculations->old_intrest_amount+ $arreas_calculations->difference_intrest_amount));
                        //     } else {
                        //         return (
                        //         ($arreas_calculations->other+$arreas_calculations->na_assessment+$arreas_calculations->lease_rent+$arreas_calculations->administrative_charge+$arreas_calculations->external_expender_charge+$arreas_calculations->pump_man_and_repair_charges+$arreas_calculations->electric_city_charge+$arreas_calculations->water_charges)*$building->tenant_count()->first()
                        //         +($arreas_calculations->balance_amount-($arreas_calculations->old_intrest_amount+ $arreas_calculations->difference_intrest_amount)) + ($arreas_calculations->old_intrest_amount+ $arreas_calculations->difference_intrest_amount));
                        //     }
                        // }

                        // if(isset($arreas_calculations->ac_month) && isset($arreas_calculations->ac_year)) {
                        //     $date1 = new \DateTime($arreas_calculations->ac_year.'-'.$arreas_calculations->ac_month.'-1');
                        //     $date2 = new \DateTime($arreas_calculations->oir_year.'-'.$arreas_calculations->oir_month.'-1');

                        //     $monthDiff = $date1->diff($date2);
                        //     $monthDiff = ($monthDiff->format('%y') * 12) + $monthDiff->format('%m');

                        //     if($monthDiff>0) {
                        //         if(empty($tenant)) {
                        //             return (($arreas_calculations->other+$arreas_calculations->na_assessment+$arreas_calculations->lease_rent+$arreas_calculations->administrative_charge+$arreas_calculations->external_expender_charge+$arreas_calculations->pump_man_and_repair_charges+$arreas_calculations->electric_city_charge+$arreas_calculations->water_charges)*$building->tenant_count()->first()->count)+($arreas_calculations->old_rate * $monthDiff*$building->tenant_count()->first()->count) + ($arreas_calculations->difference_amount* $monthDiff )+ ($arreas_calculations->old_intrest_amount+ $arreas_calculations->difference_intrest_amount);
                        //         } else {
                        //             return ($arreas_calculations->other+$arreas_calculations->na_assessment+$arreas_calculations->lease_rent+$arreas_calculations->administrative_charge+$arreas_calculations->external_expender_charge+$arreas_calculations->pump_man_and_repair_charges+$arreas_calculations->electric_city_charge+$arreas_calculations->water_charges)+($arreas_calculations->old_rate  * $monthDiff) + ($arreas_calculations->difference_amount* $monthDiff)+$arreas_calculations->old_intrest_amount + $arreas_calculations->difference_intrest_amount;
                        //         }
                        //     } else {
                        //         if(empty($tenant)) {
                        //             return (($arreas_calculations->other+$arreas_calculations->na_assessment+$arreas_calculations->lease_rent+$arreas_calculations->administrative_charge+$arreas_calculations->external_expender_charge+$arreas_calculations->pump_man_and_repair_charges+$arreas_calculations->electric_city_charge+$arreas_calculations->water_charges)*$building->tenant_count()->first()->count)+($arreas_calculations->old_rate *$building->tenant_count()->first()->count)+ $arreas_calculations->difference_amount+($arreas_calculations->old_intrest_amount+ $arreas_calculations->difference_intrest_amount);
                        //         } else {
                        //             return ($arreas_calculations->other+$arreas_calculations->na_assessment+$arreas_calculations->lease_rent+$arreas_calculations->administrative_charge+$arreas_calculations->external_expender_charge+$arreas_calculations->pump_man_and_repair_charges+$arreas_calculations->electric_city_charge+$arreas_calculations->water_charges)+$arreas_calculations->old_rate + $arreas_calculations->difference_amount+$arreas_calculations->old_intrest_amount + $arreas_calculations->difference_intrest_amount;
                        //         }
                        //     }
                        // }
                    })
                    ->editColumn('amount_paid', function ($arreas_calculations) use($request) {
                        if($request->has('tenant_id') && !empty($request->tenant_id)) {
                            if(count($arreas_calculations->trans_payment)) {
                               return  $arreas_calculations->trans_payment->first()->amount_paid;
                            }
                        } else {
                            return $arreas_calculations->amount_paid;
                        }

                        // if(isset($arreas_calculations->tenant_id) || isset($arreas_calculations->building_id) ) {
                        //     if(!empty($amount_paid) && array_key_exists($arreas_calculations->tenant_id, $amount_paid) && !empty($tenant)){
                        //         return $amount_paid[$arreas_calculations->tenant_id];
                        //     } else if(!empty($amount_paid) && array_key_exists($arreas_calculations->building_id, $amount_paid)) {
                        //         return $amount_paid[$arreas_calculations->building_id];
                        //     } else {
                        //         return 0;
                        //     }
                        // }
                     })
                    ->editColumn('action', function ($arreas_calculations) use($building,$society,$request) {
                        $button = '';
                        if($request->has('tenant_id') && !empty($request->tenant_id)) {
                            $url = route('downloadBill', ['building_id'=>encrypt($building->id),
                                        'society_id'=>encrypt($society->id),'month'=> $arreas_calculations->bill_month,'year'=> $arreas_calculations->bill_year,'tenant_id'=>encrypt($request->tenant_id)]);
                            $button = "<div class='d-flex btn-icon-list'>
                                <a href='".$url."' class='d-flex flex-column align-items-center ' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/view-arrears-calculation-icon.svg')."'></span>Donwload Bill</a>";

                            if(count($arreas_calculations->trans_payment)) {

                                $url = route('downloadReceipt', ['building_id'=>encrypt($building->id),'bill_no'=>encrypt($arreas_calculations->trans_payment->first()->id),'tenant_id'=> encrypt($request->tenant_id)]);
                                $button.= "<a href='".$url."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/generate-bill-icon.svg')."'></span>Download Receipt</a></div>";
                            }
                        } else {
                            if(!empty($arreas_calculations->water_charges)) {
                                $url = route('downloadBill', ['building_id'=>encrypt($building->id),
                                            'society_id'=>encrypt($society->id),'month'=> $arreas_calculations->bill_month,'year'=> $arreas_calculations->bill_year]);
                                $button = "<div class='d-flex btn-icon-list'>
                                    <a href='".$url."' class='d-flex flex-column align-items-center ' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/view-arrears-calculation-icon.svg')."'></span>Donwload Bill</a>";
                                if($arreas_calculations->total_bill != $arreas_calculations->balance_amount) {
                                    $url = route('downloadReceipt', ['building_id'=>encrypt($building->id),'society_id'=>encrypt($building->society_id),'bill_no'=>encrypt($arreas_calculations->bill_no)]);   

                                    $button.= "<a href='".$url."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/generate-bill-icon.svg')."'></span>Download Receipt</a></div>";
                                }
                            }
                        }

                        return $button;
                        // if($request->has('tenant_id') || isset($arreas_calculations->building_id)) {
                        //     $url = (!$request->has('tenant_id'))?
                        //     route('downloadBill', ['building_id'=>encrypt($building->id),
                        //                 'society_id'=>encrypt($society->id),'month'=> $arreas_calculations->bill_month,'year'=> $arreas_calculations->bill_year,'tenant_id'=>encrypt($tenant->id)]):
                        //     route('downloadBill', ['building_id'=>encrypt($building->id),
                        //                 'society_id'=>encrypt($society->id),'month'=> $arreas_calculations->bill_month,'year'=> $arreas_calculations->bill_year]);

                        //     $button = "<div class='d-flex btn-icon-list'>
                        //         <a href='".$url."' class='d-flex flex-column align-items-center ' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/view-arrears-calculation-icon.svg')."'></span>Donwload Bill</a>";
                        //     if(!empty($reciepts) && array_key_exists($arreas_calculations->tenant_id, $reciepts) && !empty($tenant)) {
                        //         $transBill = TransBillGenerate::find($reciepts[$arreas_calculations->tenant_id]);
                                
                        //         if(!empty($transBill) && $transBill->bill_month == $arreas_calculations->month) {

                        //         $url = (!$request->has('tenant_id'))?
                        //             route('downloadReceipt', ['building_id'=>encrypt($building->id),'bill_no'=>encrypt($reciepts[$arreas_calculations->tenant_id]),'tenant_id'=> encrypt($tenant->id)])
                        //             :route('downloadReceipt', ['building_id'=>encrypt($building->id),'society_id'=>encrypt($building->society_id),
                        //                 'bill_no'=>encrypt($reciepts[$arreas_calculations->tenant_id])]);
                        //         $button.= "<a href='".$url."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/generate-bill-icon.svg')."'></span>Download Receipt</a></div>";
                        //         }

                        //     } else if(!empty($reciepts) && array_key_exists($arreas_calculations->building_id, $reciepts) && !empty($tenant)) {
                        //             $url = (!$request->has('tenant_id'))?
                        //                 route('downloadReceipt', ['building_id'=>encrypt($building->id),'bill_no'=>encrypt($reciepts[$arreas_calculations->building_id]),'tenant_id'=> encrypt($tenant->id)])
                        //                 :route('downloadReceipt', ['building_id'=>encrypt($building->id),'society_id'=>encrypt($building->society_id),'bill_no'=>encrypt($reciepts[$arreas_calculations->building_id])]);

                        //              $button.= "<a href='".$url."' class='d-flex flex-column align-items-center' style='padding-left: 5px; padding-right: 5px; text-decoration: none; color: #212529; font-size:12px;'><span class='btn-icon btn-icon--edit'><img src='".asset('/img/generate-bill-icon.svg')."'></span>Download Receipt</a></div>";
                        //     }
                        //     return $button;
                        // }
                        
                    })
                    ->rawColumns(['Month,Year','water_charges','electric_city_charge','pump_man_and_repair_charges','external_expender_charge','administrative_charge','lease_rent','na_assessment','other','total_service_charges','balance_amount','interest_amount','grand_total','amount_paid','action'])
                    ->make(true);
                  
            }
            // echo '<pre>';
            // print_r($data['arreas_calculations']);exit;
            $html = $datatables->getHtmlBuilder()->columns($columns)->parameters($this->getParameters());
    	}

        return view('admin.em_department.billing_calculations', compact('html','data','select_year','years','society','building','tenant','search_year'));
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
