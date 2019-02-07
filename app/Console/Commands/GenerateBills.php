<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\MasterLayout;
use App\MasterWard;
use App\MasterColony;
use App\SocietyDetail;
use App\MasterBuilding;
use App\MasterTenant;
use App\ArrearsChargesRate;
use App\ArrearTenantPayment;
use App\ArrearCalculation;
use App\ServiceChargesRate;
use App\TransBillGenerate;
use DB;

class GenerateBills extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:bills';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate bills of society and tenant level monthly.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->generateSocityLevelBills();
        $this->generateTenantLevelBills();
    }

    public function generateSocityLevelBills() {
        
        $societies = SocietyDetail::where('society_bill_level', '=', '1')->pluck('id')->toArray();
        $buildings = MasterBuilding::whereIn('society_id',$societies)->get();

        if(!empty($buildings)) {
            foreach($buildings as $building) {
                    
                $number_of_tenants = MasterBuilding::with('tenant_count')->where('id',$building->id)->first();
                 
                if(!$number_of_tenants->tenant_count()->first()) {
                    $this->info('Number of Tenants Is zero.');
                }

                $currentMonth = date('m');
                if($currentMonth < 4) {
                    $year = date('Y') -1;
                } else {
                    $year = date('Y');
                }

                $serviceChargesRate = ServiceChargesRate::selectRaw('Sum(water_charges) as water_charges,sum(electric_city_charge) as electric_city_charge,sum(pump_man_and_repair_charges) as  pump_man_and_repair_charges,sum(external_expender_charge) as external_expender_charge,sum(administrative_charge) as administrative_charge, sum(lease_rent) as lease_rent,sum(na_assessment) as na_assessment, sum(other) as other')->where('building_id',$building->id)->where('year',$year)->first();

                if(!$serviceChargesRate){
                    $this->info('Service charge Rates Not added into system.');
                } else {

                    $total_service = $serviceChargesRate->water_charges + $serviceChargesRate->electric_city_charge + $serviceChargesRate->pump_man_and_repair_charges + $serviceChargesRate->external_expender_charge + $serviceChargesRate->administrative_charge + $serviceChargesRate->lease_rent + $serviceChargesRate->na_assessment + $serviceChargesRate->other; 
                    $monthly_bill = $total_service = $total_service * $number_of_tenants->tenant_count()->first()->count;

                    $currentMonth = date('m');
                    if($currentMonth < 4) {
                        if($currentMonth == 1) {
                            $data['month'] = 12;
                            $data['year'] = date('Y') -1;
                        } else {
                            $data['month'] = date('m') -1;
                            $data['year'] = date('Y') -1;
                        }
                    } else {
                        $data['month'] = date('m');
                        $data['year'] = date('Y');
                    }

                    if($data['month'] == 1) {
                        $lastBillMonth = 12;
                    } else {
                        $lastBillMonth = $data['month']-1;
                    }

                    $bill_from  = date('1-m-Y', strtotime('-1 month'));
                    $bill_to    = date('1-m-Y');
                    $bill_month = $data['month'];
                    $bill_year  = $data['year'];
                    $no_of_tenant = $number_of_tenants->tenant_count()->first()->count;
                    $bill_date = date('d-m-Y');
                    $due_date = date('d-m-Y', strtotime(date('Y-m-d'). ' + 5 days'));

                    $check = TransBillGenerate::where('building_id', '=', $building->id)
                        ->where('society_id', '=', $building->society_id)
                        ->where('bill_month', '=', $bill_month)
                        ->where('bill_year', '=', $bill_year)
                        ->first();
                    }
                    if(is_null($check) || $check == '') {
                        $tenants = MasterTenant::where('building_id',$building->id)->get();
                        $monthly_bill = $monthly_bill / $no_of_tenant;


                        $currentMonth = date('m');
                        if($currentMonth < 4) {
                            $year = date('Y') -1;
                        } else {
                            $year = date('Y');
                        }
                        
                        $start    = new \DateTime($year.'-4-01');
                        $start->modify('first day of this month');
                        $end      = new \DateTime(date('Y').'-'.date('m').'-06');
                        $end->modify('first day of next month');
                        $interval = \DateInterval::createFromDateString('1 month');
                        $period   = new \DatePeriod($start, $interval, $end);

                        $months = [];
                        $years = [];
                        foreach ($period as $dt) {
                            $years[$dt->format("Y")] = $dt->format("Y");
                            $months[$dt->format("m")] = $dt->format("m");
                        }
                        unset($months[count($months)-1]);
                        $bill = [];
                        if($tenants){
                            foreach($tenants as $row => $key){

                                $consumer_number = 'BL-'.substr(sprintf('%08d', $building->id),0,8).'|'.substr(sprintf('%08d', $key->id),0,8);
                                $arreasCalculation = ArrearCalculation::where('tenant_id',$key->id)->where('payment_status','0')->whereIn('year',$years)->whereIn('month',$months)->get();
                                $arrear_bill = 0;
                                $total_bill = 0;
                                $arrear_id = '';
                                $arrearID = [];
                                if(!$arreasCalculation->isEmpty()){ 
                                    foreach($arreasCalculation as $calculation){
                                        $arrear_bill = $arrear_bill + $calculation->total_amount;
                                        $arrearID[] = $calculation->id; 
                                    }
                                    $arrear_id = implode(",",$arrearID);                      
                                }  
                                
                                $total_bill  = $monthly_bill + $arrear_bill;
                                $total_after_due = $total_bill * 0.02; 
                                $total_service_after_due = $total_bill + $total_after_due; 

                                $data =  [
                                    'tenant_id'       => $key->id,
                                    'building_id'     => $key->building_id,
                                    'society_id'      => $building->society_id,
                                    'bill_from'       => $bill_from,
                                    'bill_to'         => $bill_to,
                                    'bill_month'      => $bill_month,
                                    'bill_year'       => $bill_year,
                                    'monthly_bill'    => $monthly_bill,
                                    'arrear_bill'     => $arrear_bill,
                                    'arrear_id'       => $arrear_id,
                                    'total_bill'      => $total_bill,
                                    'bill_date'       => $bill_date,
                                    'due_date'        => $due_date,
                                    'consumer_number' => $consumer_number,
                                    'late_fee_charge' => $total_after_due,
                                    'status'          => 'Generated',
                                    'balance_amount'  => $total_bill,
                                    'total_service_after_due' => $total_service_after_due,
                                ];
                                $bill[] = TransBillGenerate::insertGetId($data);
                            }
                        }
                        if(isset($bill)){
                            $ids = implode(",",$bill);
                            $association = DB::table('building_tenant_bill_association')->insert(['building_id' => $building->id, 'bill_id' => $ids, 'bill_month' => $bill_month, 'bill_year' => $bill_year]);
                        }   
                }  else {
                    $this->info(' Bill Already Generated on '.$check->bill_date);
                }
            }
        }    
    }
    
    public function generateTenantLevelBills() {
        $societies = SocietyDetail::where('society_bill_level', '=', '2')->pluck('id');
        $buildings = MasterBuilding::whereIn('society_id',$societies)->pluck('id');
        $tenants   = MasterTenant::whereIn('building_id',[4])->get();

        $currentMonth = date('m');
        if($currentMonth < 4) {
            if($currentMonth == 1) {
                $data['month'] = 12;
                $data['year'] = date('Y') -1;
            } else {
                $data['month'] = date('m') -1;
                $data['year'] = date('Y') -1;
            }
        } else {
            $data['month'] = date('m');
            $data['year'] = date('Y');
        }


        if(!empty($tenants)) {
            foreach ($tenants as $tenant) {
                echo 'tenant id'.$tenant->id;
                $building = MasterBuilding::find($tenant->building_id);
                $society = SocietyDetail::find($building->society_id);
                $currentMonth = date('m');
                if($currentMonth < 4) {
                    $year = date('Y') -1;
                } else {
                    $year = date('Y');
                }
                $serviceChargesRate = ServiceChargesRate::selectRaw('Sum(water_charges) as water_charges,sum(electric_city_charge) as electric_city_charge,sum(pump_man_and_repair_charges) as  pump_man_and_repair_charges,sum(external_expender_charge) as external_expender_charge,sum(administrative_charge) as administrative_charge, sum(lease_rent) as lease_rent,sum(na_assessment) as na_assessment, sum(other) as other')->where('building_id',$tenant->building_id)->where('year',$year )->first();

                if(!$serviceChargesRate){
                    $this->info('Service charge Rates Not added into system.');
                } else {

                    $arreasCalculation = ArrearCalculation::where('tenant_id',$tenant->id)->where('payment_status','0')->get();
                    $arrear_ids = [];
                    $arrear_id  = '';

                    $total ='0';
                    if(!$arreasCalculation->isEmpty())  {
                        foreach($arreasCalculation as $calculation) {
                            $total = $total + $calculation->total_amount;
                            $arrear_ids[] = $calculation->id;
                        }
                        $arrear_id = implode(",",$arrear_ids);
                    }

                    $bill_from = date('d-m-Y',strtotime(date('1-'.$data['month'].'-'.$data['year'])));
                    $bill_to   = date('d-m-Y',strtotime("+1 month", strtotime(date('1-'.$data['month'].'-'.$data['year']))));
                    $bill_month= $data['month'];
                    $bill_year = $data['year'];
                    $bill_date = date('d-m-Y');
                    $due_date  = date('d-m-Y', strtotime(date('Y-m-d'). ' + 5 days'));

                    $check = TransBillGenerate::where('tenant_id', '=', $tenant->id)
                                    ->where('bill_month', '=', $bill_month)
                                    ->where('bill_year', '=', $bill_year)
                                    ->orderBy('id','DESC')
                                    ->first();

                    if(is_null($check) || $check == ''){
                        $bill = new TransBillGenerate;
                        $bill->tenant_id   = $tenant->id;
                        $bill->building_id = $tenant->building_id;
                        $bill->society_id  = $society->id;
                        $bill->bill_from   = $bill_from;
                        $bill->bill_to     = $bill_to;
                        $bill->bill_month  = $bill_month;
                        $bill->bill_year   = $bill_year;
                        

                        $total_service = $serviceChargesRate->water_charges + $serviceChargesRate->electric_city_charge + $serviceChargesRate->pump_man_and_repair_charges + $serviceChargesRate->external_expender_charge + $serviceChargesRate->administrative_charge + $serviceChargesRate->lease_rent + $serviceChargesRate->na_assessment + $serviceChargesRate->other; 
                        $total_after_due = $total_service * 0.02; 
                        $total_service_after_due = $total_service + $total_after_due;     
                        // $total ='0';  

                        $bill->monthly_bill = $total_service;
                        
                        if($data['month'] == 1) {
                            $lastBillMonth = 12;
                        } else {
                            $lastBillMonth = $data['month']-1;
                        }

                        $lastBill = TransBillGenerate::where('tenant_id', '=', $tenant->id)
                                    ->where('bill_month', '=', $lastBillMonth)
                                    ->where('bill_year', '=', $data['year'])
                                    ->orderBy('id','DESC')
                                    ->first();

                        $tempBalance = $total;
                        if($lastBill && !empty($lastBill) && 0 < $lastBill->balance_amount) {
                            $tempBalance = $lastBill->balance_amount;
                        }

                        $bill->arrear_bill = $total;
                        $bill->arrear_id = $arrear_id;

                        $totalTemp = $total + $total_service;
                        if($lastBill && !empty($lastBill) && 0 < $lastBill->credit_amount) {
                            if($total + $total_service > $lastBill->credit_amount) {
                                $totalTemp =  ($total + $total_service) - $lastBill->credit_amount;  
                            } else {
                                $totalTemp =  0;    
                            }
                        }
                        if($lastBill && !empty($lastBill) && 0 < $lastBill->balance_amount) {
                            $totalTemp = $total+ $total_service + $lastBill->balance_amount;
                        }
                        $total_bill = $totalTemp;

                        $bill->total_bill = $totalTemp;
                        $bill->bill_date  = $bill_date;
                        $bill->due_date   = $due_date;
                        $bill->consumer_number = 'TN-'.substr(sprintf('%08d', $tenant->building_id),0,8).'|'.substr(sprintf('%08d', $tenant->id),0,8);
                        $bill->total_service_after_due = $total_service_after_due;
                        $bill->late_fee_charge = $total_after_due;
                        $bill->total_bill_after_due_date = round($totalTemp + $total_after_due,2);

                        $lastBillMonth = $bill_month;
                        $lastBillYear = $bill_year;

                        if($bill_month ==1) {
                            $lastBillMonth = 12;
                            $lastBillYear = $bill_year -1;
                        } else {
                            $lastBillMonth = $bill_month -1;
                        }
                        $bill->status = 'Generated';

                        $lastBill = TransBillGenerate::where('tenant_id', '=', $tenant->id)
                                                ->where('bill_month', '=', $lastBillMonth)
                                                ->where('bill_year', '=', $lastBillYear)
                                                ->orderBy('id','DESC')
                                                ->first();
                        if(!empty($lastBill)) {

                            if($lastBill->balance_amount > 0) {
                                $bill->total_bill_after_due_date = round($total_bill + $total_after_duee +$lastBill->balance_amount,2);
                                $bill->balance_amount = round($lastBill->total_bill_after_due_date,2);
                            }

                            if($lastBill->credit_amount > 0 && $lastBill->credit_amount > $total_bill) {
                                $bill->credit_amount = round($lastBill->credit_amount - $monthly_bill,2);
                                $bill->total_bill_after_due_date = 0;
                                $bill->status = 'paid';
                            }

                            if($lastBill->credit_amount > 0 && $lastBill->credit_amount < $total_bill) {
                                $bill->total_bill = round($monthly_bill - $lastBill->credit_amount,2);
                                $bill->balance_amount = $bill->total_bill_after_due_date = round($total_service_after_due - $lastBill->credit_amount,2);
                                $bill->credit_amount = 0;
                            }
                        } else {
                            $bill->balance_amount = round($total_bill + $total_after_due,2);
                            $bill->credit_amount = 0;    
                        }
                        
                        $bill->save();
                        $this->info('Bill Generated Successfully');
                    } else {
                        $this->info('Bill Already Generated on '.$check->bill_date); 
                    }
                }
            }
        }
    }
}
