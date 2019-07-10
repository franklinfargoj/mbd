<?php

namespace App\Console\Commands;

use App\Http\Requests\GenerateBillRequest;
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
use DB,File;
use App\TransBillServiceCharge;

class GenerateBills extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:bills {year?} {month?} ';
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
        $year = $this->argument('year');
        $month = $this->argument('month');
        if(($this->argument('year') != null) || ($this->argument('month') != null)){

            $data = array(
                'year' => $year,
                'month'  => $month
            );

            $rules = array(
                'year' => 'digits:4|numeric',
                'month' => 'digits_between:1,2|numeric',
            );

            $validator = \Validator::make($data, $rules);

            if ($validator->fails()) {
                $messages = $validator->messages();
                $this->info($this->error($messages));
            }else{

                $this->generateSocityLevelBills($year, $month);
                $this->generateTenantLevelBills($year, $month);

            }
        }else{
            $this->generateSocityLevelBills($year, $month);
            $this->generateTenantLevelBills($year, $month);
        }



    }

    public function generateSocityLevelBills($year, $month) {
        if($year != null){
            $year_for_bill = $year;
        }else{
            $year_for_bill = date('Y') ;
        }
        if($month != null){
            $month_for_bill = $month;
        }else{
            $month_for_bill = date('m');
        }


//        dd($month_for_bill);
        $societies = SocietyDetail::where('society_bill_level', '=', '1')->pluck('id')->toArray();
        $buildings = MasterBuilding::whereIn('society_id',$societies)->get();
        $strTxnData = '';

        if(!empty($buildings)) {
            foreach($buildings as $building) {
                //dump($building);
                $society = SocietyDetail::find($building->society_id);
                $number_of_tenants = MasterBuilding::with('tenant_count')->where('id',$building->id)->first();

                if(($society->is_conveyanced == 1) && ($society->conveyanced_type == 'Full')){
                    $interest_charge = ((float)$society->lease_and_na_charges_in_per / 12);
                }else{
                    $interest_charge = 0.015;
                }

                if(!$number_of_tenants->tenant_count()->first()) {
                    $this->info('Number of Tenants Is zero.');
                }

                $currentMonth = $month_for_bill;
                if($currentMonth < 4) {
                    $year = $year_for_bill -1;
                } else {
                    $year = $year_for_bill;
                }

                $serviceChargesRate = ServiceChargesRate::selectRaw('Sum(water_charges) as water_charges,sum(electric_city_charge) as electric_city_charge,sum(pump_man_and_repair_charges) as  pump_man_and_repair_charges,sum(external_expender_charge) as external_expender_charge,sum(administrative_charge) as administrative_charge, sum(lease_rent) as lease_rent, sum(property_tax) as property_tax,sum(na_assessment) as na_assessment, sum(other) as other')->where('building_id',$building->id)->where('year',$year)->first();
                //dd($serviceChargesRate);
                if($serviceChargesRate==null){
                    $this->info('Service charge Rates Not added into system.');
                } else {

                    $total_service = $serviceChargesRate->water_charges + $serviceChargesRate->electric_city_charge + $serviceChargesRate->pump_man_and_repair_charges + $serviceChargesRate->external_expender_charge + $serviceChargesRate->administrative_charge + $serviceChargesRate->lease_rent + $serviceChargesRate->na_assessment + $serviceChargesRate->other+$serviceChargesRate->property_tax; 
                    //$monthly_bill = $total_service = $total_service * $number_of_tenants->tenant_count()->first()->count;
                    $monthly_bill = $total_service;

                    $currentMonth = $month_for_bill;
                    if($currentMonth < 4) {
                        if($currentMonth == 1) {
                            $data['month'] = 12;
                            $data['year'] = $year_for_bill -1;
                            $bill_year = $year_for_bill -1;
                        } else {
                            $data['month'] = $month_for_bill - 1;
                            $data['year'] = $year_for_bill -1;
                            $bill_year = $year_for_bill;
                        }
                    } else {
                        $data['month'] = $month_for_bill - 1;
                        $data['year'] = $year_for_bill;
                        $bill_year = $year_for_bill;
                    }

                    if($data['month'] == 1) {
                        $lastBillMonth = 12;
                    } else {
                        $lastBillMonth = $data['month']-1;
                    }

                    if($year != null && $month != null){

                        $dateObj   = \DateTime::createFromFormat('!m', $data['month']);
                        $month_name = $dateObj->format('F');
                        $timestamp    = strtotime($month_name.' '.$bill_year );
                        $bill_from = date('01-m-Y', $timestamp);
                        $bill_to  = date('t-m-Y', $timestamp);

                        $dateObj1   = \DateTime::createFromFormat('!m', $month);
                        $month_name1 = $dateObj1->format('F');
                        $timestamp1    = strtotime($month_name1.' '.$bill_year );
                        $bill_date = date('01-m-Y', $timestamp1);
                        $due_date = date('d-m-Y', strtotime($bill_date. ' + 10 days'));

                    }else{
                        $bill_from  = date('01-m-Y', strtotime('-1 month'));
                        $bill_to    = date('t-m-Y', strtotime('-1 month'));
                        $bill_date = date('01-m-Y');
                        $due_date = date('d-m-Y', strtotime($bill_date. ' + 10 days'));

                    }


                    $bill_month = $data['month'];
//                    $no_of_tenant = $number_of_tenants->tenant_count()->first()->count;



                    $check = TransBillGenerate::where('building_id', '=', $building->id)
                        ->where('society_id', '=', $building->society_id)
                        ->where('bill_month', '=', $bill_month)
                        ->where('bill_year', '=', $bill_year)
                        ->first();
                    }
                    if(is_null($check) || $check == '') {
                        $tenants = MasterTenant::where('building_id',$building->id)->get();
                        //$monthly_bill = $monthly_bill / $no_of_tenant;
                        $monthly_bill = $monthly_bill;

                        $currentMonth = $month_for_bill;
                        if($currentMonth < 4) {
                            $year = $year_for_bill -1;
                        } else {
                            $year = $year_for_bill;
                        }
                        
                        $start    = new \DateTime($year.'-4-01');
                        $start->modify('first day of this month');
                        $end      = new \DateTime($year_for_bill.'-'.$month_for_bill.'-06');
                        $end->modify('first day of next month');
                        $interval = \DateInterval::createFromDateString('1 month');
                        $period   = new \DatePeriod($start, $interval, $end);

                        $months = [];
                        $years = [];
                        foreach ($period as $dt) {
                            $years[$dt->format("Y")] = $dt->format("Y");
                            $months[$dt->format("n")] = $dt->format("n");
                        }
                        unset($months[count($months)-1]);
                        $bill = [];
                        if($tenants){
                            //foreach($tenants as $row => $key){
                                $lastBillMonth =$currentMonth;
                                $lastBillYear = $year;
                                if($data['month'] ==1) {
                                    $lastBillMonth = 12;
                                    $lastBillYear = $year -1;
                                } else {
                                    $lastBillMonth = $data['month'] -1;
                                }
//                                dd($lastBillMonth." ".$lastBillYear);
                                $lastBill = TransBillGenerate::where('building_id', '=', $building->id)
                                    ->where('bill_month', '=', $lastBillMonth)
                                    ->where('bill_year', '=', $lastBillYear)
                                    ->orderBy('id','DESC')
                                    ->first();
                                //$consumer_number = 'BL-'.substr(sprintf('%08d', $building->id),0,8).'|'.substr(sprintf('%08d', $key->id),0,8);
                                $consumer_number = 'BL-'.substr(sprintf('%08d', $building->id),0,8);
                                $arrear_bill = 0;
                                $total_bill = 0;
                                $arrear_id = '';
                                $arrearID = [];
                                $arrear_balance=$arrear_interest_balance=0;
                                if($lastBill==null)
                                {
//                                $arreasCalculation = ArrearCalculation::where('building_id',$building->id)->where('payment_status','0')->whereIn('year',$years)->whereIn('month',$months)->get();
                                  $arreasCalculation = ArrearCalculation::where('building_id',$building->id)->where('payment_status','0')->get();
                                
                                if(!$arreasCalculation->isEmpty()){ 
                                        foreach($arreasCalculation as $calculation){
                                            $arrear_bill = $arrear_bill + $calculation->total_amount;
                                            $arrearID[] = $calculation->id; 
                                        }
                                        $arrear_id = implode(",",$arrearID);                      
                                    }  
                                    if(!$arreasCalculation->isEmpty())
                                    {
                                        foreach($arreasCalculation as $arreasCalculations)
                                        {
                                            $arrear_balance+=($arreasCalculations->total_amount - $arreasCalculations->old_intrest_amount -
                                                        $arreasCalculations->difference_intrest_amount);
                                            $arrear_interest_balance+=($arreasCalculations->old_intrest_amount +
                                                $arreasCalculations->difference_intrest_amount);
                                        }
                                    }
                                }
                                
                                $total_bill  = $monthly_bill + $arrear_bill;
                                $total_after_due = $total_bill * 0.015; 
                                $total_service_after_due = $total_bill + $total_after_due; 

                                $data =  [
                                    'tenant_id'       => null,
                                    'building_id'     => $building->id,
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
                                    'late_fee_charge' => ceil($total_after_due),
                                    'status'          => 'Generated',
                                    'balance_amount'  => $total_bill,
                                    'total_bill_after_due_date'=>ceil($total_service_after_due),
                                    'total_service_after_due' => ceil($total_after_due+$monthly_bill),
                                    'created_at'=>date('Y-m-d H:i:s'),
                                    'updated_at'=>date('Y-m-d H:i:s'),
                                    'arrear_balance'=>$arrear_bill,
                                    'arrear_interest_balance'=>$arrear_interest_balance,
                                    'prev_arrear_balance'=>$arrear_bill,
                                    'prev_arrear_interest_balance'=>$arrear_interest_balance,
                                    'service_charge_balance'=>$monthly_bill
                                ];
                                if($lastBill)
                              {
                                $data['arrear_balance']=$lastBill->arrear_balance;
                                $data['arrear_interest_balance']=$lastBill->arrear_interest_balance;
                                  //for credit amount
                                  if($lastBill->credit_amount>0)
                                  {
                                      $data['prev_credit']=$lastBill->credit_amount;
                                      if($lastBill->credit_amount>=$monthly_bill)
                                      {
                                          $lastBill->credit_amount=$lastBill->credit_amount-$monthly_bill;
                                          $data['service_charge_balance'] = 0;
                                          if($lastBill->credit_amount>0)
                                          {
                                              if($lastBill->credit_amount>=$data['arrear_balance'])
                                              {
                                                  $lastBill->credit_amount= $lastBill->credit_amount-$data['arrear_balance'];
                                                $data['arrear_balance']=0;
                                                if($lastBill->credit_amount>=$lastBill->arrear_interest_balance)
                                                {
                                                    $lastBill->credit_amount= $lastBill->credit_amount-$data['arrear_interest_balance'];
                                                    $data['credit_amount']=$lastBill->credit_amount;
                                                }else
                                                {
                                                    $data['arrear_interest_balance']=$data['arrear_interest_balance']-$lastBill->credit_amount;
                                                    $data['credit_amount']=0;
                                                }
                                              }else
                                              {
                                                  $data['arrear_balance']=$data['arrear_balance']-$lastBill->credit_amount;
                                                  $data['credit_amount']=0;
                                              }
                                          }
                                      }else
                                      {
                                          $data['service_charge_balance']=$data['service_charge_balance']-$lastBill->credit_amount;
                                          $data['credit_amount']= 0;
                                      }
                                      $data['balance_amount']=$data['arrear_balance']+$data['service_charge_balance'];
                                  }else
                                  {
                                      $data['credit_amount']= 0;
                                  }

                                  //for balance amounty
                                  if($lastBill->balance_amount>0)
                                  {
                                      $data['prev_service_charge_balance']=0;
                                      $data['prev_arrear_balance']=0;
                                      $data['prev_arrear_interest_balance']=0;
                                      if($lastBill->service_charge_balance>0)
                                      {
                                          $lastBill->service_charge_balance=$lastBill->service_charge_balance+($lastBill->service_charge_balance*$interest_charge);
                                          $data['prev_service_charge_balance']=$lastBill->service_charge_balance;
                                          
                                      }
                                      
                                      $data['service_charge_balance']=$data['service_charge_balance']+$lastBill->service_charge_balance;
                                      
                                      if($lastBill->arrear_balance>0)
                                      {
                                          //dd($lastBill);
                                          $arrear_interest=0;
                                          $arrear_data=ArrearsChargesRate::where(['society_id'=>$lastBill->society_id,'building_id'=>$lastBill->building_id])->first();
                                          //dd($arrer_data);
                                          if($arrear_data)
                                            {
                                                $arrear_interest=($arrear_data->old_rate*($arrear_data->interest_on_old_rate/100))+(($arrear_data->revise_rate-$arrear_data->old_rate)*($arrear_data->interest_on_differance/100));
                                            }
                                          //$lastBill->arrear_balance=$lastBill->arrear_balance+$arrear_interest;
                                          $lastBill->arrear_balance=$lastBill->arrear_balance;
                                          $lastBill->arrear_interest_balance=$lastBill->arrear_interest_balance+$arrear_interest;
                                          //dd($lastBill->arrear_balance);
                                          $data['prev_arrear_balance']=$lastBill->arrear_balance;
                                          $data['prev_arrear_interest_balance']=$lastBill->arrear_interest_balance;
                                      }
                                      $data['arrear_balance']+$lastBill->arrear_balance;
                                      $data['arrear_interest_balance']=$lastBill->arrear_interest_balance;
                                  }
                                  
                                  $data['balance_amount']=ceil($data['arrear_balance']+$data['arrear_interest_balance']+$data['service_charge_balance']);
                                  
                                  $data['total_bill']=ceil($data['arrear_balance']+$data['arrear_interest_balance']+$data['service_charge_balance']);
                                  
                              }else
                              {
                                  $data['balance_amount'] = ceil($total_bill);
                                  $data['credit_amount']= 0;    
                              }
                                // if($lastBill)
                                // {
                                //     if($lastBill->credit_amount>0)
                                //     {
                                //         $data['prev_credit']=$lastBill->credit_amount;
                                //         if($lastBill->credit_amount>=$monthly_bill)
                                //         {
                                //             $lastBill->credit_amount=$lastBill->credit_amount-$monthly_bill;
                                //             $data['service_charge_balance'] = 0;
                                //             if($lastBill->credit_amount>0)
                                //             {
                                //                 if($lastBill->credit_amount>=$arrear_bill)
                                //                 {
                                //                     $lastBill->credit_amount= $lastBill->credit_amount-$arrear_bill;
                                //                     $data['arrear_balance']=0;
                                //                 }else
                                //                 {
                                //                     $data['arrear_balance']=$data['arrear_balance']-$lastBill->credit_amount;
                                //                 }
                                //             }
                                //         }else
                                //         {
                                //             $data['service_charge_balance']=$data['service_charge_balance']-$lastBill->credit_amount;
                                //             $data['credit_amount']= 0;
                                //         }
                                //         $data['balance_amount']=$data['arrear_balance']+$data['service_charge_balance'];
                                //     }else
                                //     {
                                //         $data['credit_amount']= 0;
                                //     }
                                //     if($lastBill->balance_amount>0)
                                //     {
                                //         $data['prev_service_charge_balance']=0;
                                //         $data['prev_arrear_balance']=0;
                                //         if($lastBill->service_charge_balance>0)
                                //         {
                                //             $lastBill->service_charge_balance=$lastBill->service_charge_balance+($lastBill->service_charge_balance*0.015);
                                //             $data['prev_service_charge_balance']=$lastBill->service_charge_balance;
                                //         }
                                        
                                //         $data['service_charge_balance']=$data['service_charge_balance']+$lastBill->service_charge_balance;
                                //         if($lastBill->arrear_balance>0)
                                //         {
                                //             $lastBill->arrear_balance=$lastBill->arrear_balance+($lastBill->arrear_balance*0.015);
                                //             $data['prev_arrear_balance']=$lastBill->arrear_balance;
                                //         }
                                //         $data['arrear_balance']=$data['arrear_balance']+$lastBill->arrear_balance;
                                //         $data['service_charge_balance']=$data['service_charge_balance']+$lastBill->service_charge_balance;
                                //         $data['arrear_balance']=$data['arrear_balance']+$lastBill->arrear_balance;
                                        
                                //     }
                                //     $data['balance_amount']=$data['arrear_balance']+$data['service_charge_balance'];
                                // }else
                                // {
                                //     $data['balance_amount'] = round($total_bill,2);
                                //     $data['credit_amount']= 0;    
                                // }
                                
                                $bill[] = TransBillGenerate::insertGetId($data);
                           // }
                            // dd($building->id);
                            // dd($data);
                        }
                        $strTxnData .= 'Bill generated for building => '.$building->name.' For society => '.$society->society_name."\n";
                        if(isset($bill)){
                            $ids = implode(",",$bill);
                            $lastBillGenerated = DB::table('building_tenant_bill_association')->orderBy('id','DESC')->first();
                            $lastGeneratedNumber = '';
                            $increNumber = '';
                            $bill_number = '';

                            if($lastBillGenerated) {
                                $lastGeneratedNumber = substr($lastBillGenerated->bill_number,-7);
                                $increNumber = $lastGeneratedNumber + 1;
                                $bill_number = $building->id.str_pad($increNumber, 7, "0", STR_PAD_LEFT);
                                
                            } else {
                                $bill_number = $building->id.'0000001';
                            }
                            TransBillGenerate::where(['id'=>$ids])->update(['bill_number'=>$bill_number]);
                            $this->insertServiceChrargeForBill($ids,$serviceChargesRate);
                            $ids = implode(",",$bill);
                            $association = DB::table('building_tenant_bill_association')->insert(['building_id' => $building->id, 'bill_id' => $ids, 'bill_month' => $bill_month, 'bill_year' => $bill_year,'bill_number'=>$bill_number]);
                        }   
                        
                }  else {
                    $this->info(' Bill Already Generated on '.$check->bill_date);
                }
            }

            $file = 'monthly_building_bill_file.txt';
            $destinationPath = public_path().'/uploads/';

            if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
            File::put($destinationPath.'/'.$file,$strTxnData);
        }    
    }
    
    public function generateTenantLevelBills($year, $month) {
        if($year != null){
            $year_for_bill = $year;
        }else{
            $year_for_bill = date('Y') ;
        }
        if($month != null){
            $month_for_bill = $month;
        }else{
            $month_for_bill = date('m');
        }


        $societies = SocietyDetail::where('society_bill_level', '=', '2')->pluck('id');
        $buildings = MasterBuilding::whereIn('society_id',$societies)->pluck('id');
        $tenants   = MasterTenant::whereIn('building_id',$buildings)->get();
        
        $currentMonth = $month_for_bill;
        if($currentMonth < 4) {
            if($currentMonth == 1) {
                $data['month'] = 12;
                $data['year'] = $year_for_bill -1;
                $bill_year = $year_for_bill;
            } else {
                $data['month'] = $month_for_bill -1;
                $data['year'] = $year_for_bill -1;
                $bill_year = $year_for_bill;
            }
        } else {
            $data['month'] = $month_for_bill - 1;
            $data['year'] = $year_for_bill;
            $bill_year = $year_for_bill;
        }

        $strTxnData = '';
        if(!empty($tenants)) {
            foreach ($tenants as $tenant) {
                // echo 'tenant id'.$tenant->id;
                $building = MasterBuilding::find($tenant->building_id);
                $society = SocietyDetail::find($building->society_id);
                $currentMonth = $month_for_bill;
                if($currentMonth < 4) {
                    $year = $year_for_bill -1;
                } else {
                    $year = $year_for_bill;
                }
                $serviceChargesRate = ServiceChargesRate::selectRaw('Sum(water_charges) as water_charges,sum(electric_city_charge) as electric_city_charge,sum(pump_man_and_repair_charges) as  pump_man_and_repair_charges,sum(external_expender_charge) as external_expender_charge,sum(administrative_charge) as administrative_charge, sum(lease_rent) as lease_rent,sum(na_assessment) as na_assessment,sum(property_tax) as property_tax, sum(other) as other')->where('building_id',$tenant->building_id)->where('year',$year )->first();

                if(!$serviceChargesRate){
                    $this->info('Service charge Rates Not added into system.');
                } else {
                    $realMonth = $month_for_bill;
                    if($realMonth == 1) {
                        $realMonth = 12;
                    } else {
                        $realMonth = $realMonth - 1;
                    }

                    $arreasCalculation = ArrearCalculation::where('tenant_id',$tenant->id)->where('payment_status','0')->get();
//                    $arreasCalculation = ArrearCalculation::where('tenant_id',$tenant->id)->where('month',$realMonth)->where('payment_status','0')->get();
                    
                    $arrear_ids = [];
                    $arrear_id  = '';

                    $total ='0';

                    if($year != null && $month != null){

                        $dateObj   = \DateTime::createFromFormat('!m', $data['month']);
                        $month_name = $dateObj->format('F');
                        $timestamp    = strtotime($month_name.' '.$bill_year );
                        $bill_from = date('01-m-Y', $timestamp);
                        $bill_to  = date('t-m-Y', $timestamp);

                        $dateObj1   = \DateTime::createFromFormat('!m', $month);
                        $month_name1 = $dateObj1->format('F');
                        $timestamp1    = strtotime($month_name1.' '.$bill_year );
                        $bill_date = date('01-m-Y', $timestamp1);
                        $due_date = date('d-m-Y', strtotime($bill_date. ' + 10 days'));

                    }else{
                        $bill_from  = date('1-m-Y', strtotime('-1 month'));
                        $bill_to    = date('t-m-Y', strtotime('-1 month'));
                        $bill_date = date('01-m-Y');
                        $due_date  = date('d-m-Y', strtotime($bill_date. ' + 10 days'));

                    }

//                    $bill_from = date('1-m-Y', strtotime('-1 month'));
//                    $bill_to   = date('1-m-Y');
//                    $bill_month= $data['month'];
                    $bill_month = $data['month'];

//                    $bill_date = date('04-m-Y');
//                    $due_date  = date('d-m-Y', strtotime(date('Y-m-d'). ' + 5 days'));

                    $lastBillMonth = $bill_month;
                    $lastBillYear = $bill_year;

                    if($bill_month ==1) {
                        $lastBillMonth = 12;
                        $lastBillYear = $bill_year -1;
                    } else {
                        $lastBillMonth = $bill_month -1;
                    }
                    $lastBill = TransBillGenerate::where('tenant_id', '=', $tenant->id)
                    ->where('bill_month', '=', $lastBillMonth)
                    ->where('bill_year', '=', $lastBillYear)
                    ->orderBy('id','DESC')
                    ->first();
                    $check = TransBillGenerate::where('tenant_id', '=', $tenant->id)
                                    ->where('bill_month', '=', $bill_month)
                                    ->where('bill_year', '=', $bill_year)
                                    ->orderBy('id','DESC')
                                    ->first();
                    $arrear_balance=$arrear_interest_balance=0;
                    if(count($arreasCalculation)>0)
                    {
                        foreach($arreasCalculation as $arreasCalculations)
                        {
                            $arrear_balance+=($arreasCalculations->total_amount - $arreasCalculations->old_intrest_amount -
                                        $arreasCalculations->difference_intrest_amount);
                            $arrear_interest_balance+=($arreasCalculations->old_intrest_amount +
                                $arreasCalculations->difference_intrest_amount);
                        }
                    }
                    if($lastBill==null)
                    {
                        if(!$arreasCalculation->isEmpty())  {
                            foreach($arreasCalculation as $calculation) {
                                $total = $total + $calculation->total_amount;
                                $arrear_ids[] = $calculation->id;
                            }
                            $arrear_id = implode(",",$arrear_ids);
                        }
                    }

                    if(is_null($check) || $check == ''){
                        $bill = new TransBillGenerate;
                        $bill->tenant_id   = $tenant->id;
                        $bill->building_id = $tenant->building_id;
                        $bill->society_id  = $society->id;
                        $bill->bill_from   = $bill_from;
                        $bill->bill_to     = $bill_to;
                        $bill->bill_month  = $bill_month;
                        $bill->bill_year   = $bill_year;
                        $bill->arrear_balance=$arrear_balance;
                        $bill->arrear_interest_balance=$arrear_interest_balance;
                        $bill->prev_arrear_balance=$arrear_balance;
                        $bill->prev_arrear_interest_balance=$arrear_interest_balance;
                        

                        $total_service = $serviceChargesRate->water_charges + $serviceChargesRate->electric_city_charge + $serviceChargesRate->pump_man_and_repair_charges + $serviceChargesRate->external_expender_charge + $serviceChargesRate->administrative_charge + $serviceChargesRate->lease_rent + $serviceChargesRate->na_assessment + $serviceChargesRate->other+$serviceChargesRate->property_tax; 
                        $total_after_due = $total_service * 0.015; 
                        $total_service_after_due = $total_service + $total_after_due;     
                        // $total ='0';  
                        $bill->service_charge_balance=$total_service;

                        $bill->monthly_bill = $total_service;
                        
                        if($data['month'] == 1) {
                            $lastBillMonth = 12;
                        } else {
                            $lastBillMonth = $data['month']-1;
                        }

                        $bill->arrear_bill = $total;
                        
                        $bill->arrear_id = $arrear_id;

                        $total_bill = $bill->arrear_balance+$total_service+$bill->arrear_interest_balance;
                        $bill->total_bill = $total_bill;
                        $bill->bill_date  = $bill_date;
                        $bill->due_date   = $due_date;
                        $bill->consumer_number = 'TN-'.substr(sprintf('%08d', $tenant->building_id),0,8).'|'.substr(sprintf('%08d', $tenant->id),0,8);
                        $bill->total_service_after_due = $total_service_after_due;
                        $bill->late_fee_charge = $total_after_due;
                        $bill->total_bill_after_due_date = ceil($total_bill + $total_after_due);

                        

                        $lastBillGenerated = TransBillGenerate::orderBy('id','DESC')->first();
                        $lastGeneratedNumber = '0';
                        $increNumber = '0';
                        if(($lastBillGenerated != null) && !empty($lastBillGenerated->bill_number) ) {
                            $lastGeneratedNumber = substr($lastBillGenerated->bill_number,-7);
                            
                            $increNumber = $lastGeneratedNumber + 1;

                            $bill->bill_number = $tenant->id.str_pad($increNumber, 7, "0", STR_PAD_LEFT);
                        } else {
                            $bill->bill_number = $tenant->id.'0000001';
                        }
                        $bill->status = 'Generated';

                        
                        if($lastBill)
                        {
                            $bill->arrear_balance=$lastBill->arrear_balance;
                            $bill->arrear_interest_balance=$lastBill->arrear_interest_balance;
                            if($lastBill->credit_amount>0)
                            {
                                $bill->prev_credit=$lastBill->credit_amount;
                                if($lastBill->credit_amount>=$bill->monthly_bill)
                                {
                                    $lastBill->credit_amount=$lastBill->credit_amount-$bill->monthly_bill;
                                    $bill->service_charge_balance = 0;
                                    if($lastBill->credit_amount>0)
                                    {
                                        if($lastBill->credit_amount>=$bill->arrear_balance)
                                        {
                                            $lastBill->credit_amount= $lastBill->credit_amount-$bill->arrear_balance;
                                            $bill->arrear_balance=0;
                                            if($lastBill->credit_amount>=$lastBill->arrear_interest_balance)
                                            {
                                                $lastBill->credit_amount= $lastBill->credit_amount-$bill->arrear_interest_balance;
                                                $bill->credit_amount=$lastBill->credit_amount;
                                            }else
                                            {
                                                $bill->arrear_interest_balance=$bill->arrear_interest_balance-$lastBill->credit_amount;
                                                $bill->credit_amount=0;
                                            }
                                           
                                        }else
                                        {
                                            $bill->arrear_balance=$bill->arrear_balance-$lastBill->credit_amount;
                                            $bill->credit_amount=0;
                                        }
                                    }
                                }else
                                {
                                    $bill->service_charge_balance=$bill->service_charge_balance-$lastBill->credit_amount;
                                    $bill->credit_amount= 0;
                                }
                                $bill->balance_amount=$bill->arrear_balance+$bill->service_charge_balance;
                            }else
                            {
                                $bill->credit_amount= 0;
                            }
            
                            //for balance amounty
                            if($lastBill->balance_amount>0)
                            {
                                $bill->prev_service_charge_balance=0;
                                $bill->prev_arrear_balance=0;
                                $bill->prev_arrear_interest_balance=0;
                                if($lastBill->service_charge_balance>0)
                                {
                                    $lastBill->service_charge_balance=$lastBill->service_charge_balance+($lastBill->service_charge_balance*0.015);
                                    $bill->prev_service_charge_balance=$lastBill->service_charge_balance;
                                    
                                }
                                
                                $bill->service_charge_balance=$bill->service_charge_balance+$lastBill->service_charge_balance;
                                
                                if($lastBill->arrear_balance>0)
                                {
                                    //dd($lastBill);
                                    $arrear_interest=0;
                                    $arrear_data=ArrearsChargesRate::where(['society_id'=>$lastBill->society_id,'building_id'=>$lastBill->building_id])->first();
                                    //dd($arrer_data);
                                    if($arrear_data)
                                        {
                                            $arrear_interest=($arrear_data->old_rate*($arrear_data->interest_on_old_rate/100))+(($arrear_data->revise_rate-$arrear_data->old_rate)*($arrear_data->interest_on_differance/100));
                                        }
                                    $lastBill->arrear_balance=$lastBill->arrear_balance;
                                    $lastBill->arrear_interest_balance=$lastBill->arrear_interest_balance+$arrear_interest;
                                    //dd($lastBill->arrear_balance);
                                    $bill->prev_arrear_balance=$lastBill->arrear_balance;
                                    $bill->prev_arrear_interest_balance=$lastBill->arrear_interest_balance;
                                }
                                $bill->arrear_balance=$lastBill->arrear_balance;
                                $bill->arrear_interest_balance=$lastBill->arrear_interest_balance;
                                
                            }
                            
                            $bill->balance_amount=ceil($bill->arrear_balance+$bill->arrear_interest_balance+$bill->service_charge_balance);
                            
                            $bill->total_bill=ceil($bill->arrear_balance+$bill->arrear_interest_balance+$bill->service_charge_balance);
                            
                        }else
                        {
                            $bill->balance_amount = ceil($bill->total_bill);
                            $bill->credit_amount= 0;    
                        }
                        // if($lastBill)
                        // {
                        //     if($lastBill->credit_amount>0)
                        //     {
                        //         $bill->prev_credit=$lastBill->credit_amount;
                        //         if($lastBill->credit_amount>=$bill->monthly_bill)
                        //         {
                        //             $lastBill->credit_amount=$lastBill->credit_amount-$bill->monthly_bill;
                        //             $bill->service_charge_balance = 0;
                        //             if($lastBill->credit_amount>0)
                        //             {
                        //                 if($lastBill->credit_amount>=$bill->arrear_bill)
                        //                 {
                        //                     $lastBill->credit_amount= $lastBill->credit_amount-$bill->arrear_bill;
                        //                     $bill->arrear_balance=0;
                        //                 }else
                        //                 {
                        //                     $bill->arrear_balance=$bill->arrear_balance-$lastBill->credit_amount;
                        //                 }
                        //             }else
                        //             {
                        //                 $bill->credit_amount=0;
                        //             }
                        //         }else
                        //         {
                        //             $bill->service_charge_balance=$bill->service_charge_balance-$lastBill->credit_amount;
                        //             $bill->credit_amount=0;
                        //         }
                        //         $bill->balance_amount=$bill->arrear_balance+$bill->service_charge_balance;
                        //     }else
                        //     {
                        //         $bill->credit_amount=0;
                        //     }
                        //     if($lastBill->balance_amount>0)
                        //     {
                        //         $bill->prev_service_charge_balance=0;
                        //         $bill->prev_arrear_balance=0;
                        //         if($lastBill->service_charge_balance>0)
                        //         {
                        //             $lastBill->service_charge_balance=$lastBill->service_charge_balance+($lastBill->service_charge_balance*0.015);
                        //             $bill->prev_service_charge_balance=$lastBill->service_charge_balance;
                        //         }
                                
                        //         $bill->service_charge_balance=$bill->service_charge_balance+$lastBill->service_charge_balance;
                        //         if($lastBill->arrear_balance>0)
                        //         {
                        //             $lastBill->arrear_balance=$lastBill->arrear_balance+($lastBill->arrear_balance*0.015);
                        //             $bill->prev_arrear_balance=$lastBill->arrear_balance;
                        //         }
                        //         $bill->arrear_balance=$bill->arrear_balance+$lastBill->arrear_balance;
                        //     }
                        //     $bill->balance_amount=$bill->arrear_balance+$bill->service_charge_balance;
                        //     $bill->total_bill=$bill->balance_amount;
                        // }else
                        // {
                        //     $bill->balance_amount = round($total_bill,2);
                        //     $bill->credit_amount= 0;    
                        // }
                        // if(!empty($lastBill)) {
                        //     if($lastBill->balance_amount >= 0) {
                        //         $bill->total_bill_after_due_date = round($total_bill + $total_after_due,2);
                        //         $bill->balance_amount = round($total_bill,2);
                        //     }

                        //     if($lastBill->credit_amount > 0 && $lastBill->credit_amount > $total_bill) {
                        //         $bill->credit_amount = round($lastBill->credit_amount - $monthly_bill,2);
                        //         $bill->total_bill_after_due_date = 0;
                        //         $bill->status = 'paid';
                        //     }

                        //     if($lastBill->credit_amount > 0 && $lastBill->credit_amount < $total_bill) {
                        //         $bill->total_bill = round($monthly_bill - $lastBill->credit_amount,2);
                        //         $bill->balance_amount = $bill->total_bill_after_due_date = round($total_service_after_due - $lastBill->credit_amount,2);
                        //         $bill->credit_amount = 0;
                        //     }
                        // } else {
                        //     $bill->balance_amount = round($total_bill,2);
                        //     $bill->credit_amount = 0;    
                        // }
                        //dd($bill);
                        $bill->save();
                        if($bill)
                        {
                            $this->insertServiceChrargeForBill($bill->id,$serviceChargesRate);
                        }
                        
                        $strTxnData .= 'Bill generated for tenant name => '.$tenant->first_name.' tenant id => '.$tenant->id.' Form building => '.$building->name.' For society => '.$society->society_name."\n";

                        $this->info('Bill Generated Successfully');
                    } else {
                        $this->info('Bill Already Generated on '.$check->bill_date); 
                    }
                }
            }

            $file = 'monthly_tenant_bill_file.txt';
            $destinationPath = public_path().'/uploads/';

            if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
            File::put($destinationPath.'/'.$file,$strTxnData);
        }
    }

    //Enter service charges against bill
    public function insertServiceChrargeForBill($bill_id,$serviceChargesRate)
    {
        $TransBillServiceCharge=TransBillServiceCharge::where(['trans_bill_generate_id'=>$bill_id])->first();
        if($TransBillServiceCharge==null)
        {
            $TransBillServiceCharge=new TransBillServiceCharge;
        }
        $TransBillServiceCharge->trans_bill_generate_id=$bill_id;
        $TransBillServiceCharge->water_charges=$serviceChargesRate->water_charges!=null?$serviceChargesRate->water_charges:0.00;
        $TransBillServiceCharge->electric_city_charge=$serviceChargesRate->electric_city_charge!=null?$serviceChargesRate->electric_city_charge:0.00;
        $TransBillServiceCharge->pump_man_and_repair_charges=$serviceChargesRate->pump_man_and_repair_charges!=null?$serviceChargesRate->pump_man_and_repair_charges:0.00;
        $TransBillServiceCharge->external_expender_charge=$serviceChargesRate->external_expender_charge!=null?$serviceChargesRate->external_expender_charge:0.00;
        $TransBillServiceCharge->administrative_charge=$serviceChargesRate->administrative_charge!=null?$serviceChargesRate->administrative_charge:0.00;
        $TransBillServiceCharge->lease_rent=$serviceChargesRate->lease_rent!=null?$serviceChargesRate->lease_rent:0.00;
        $TransBillServiceCharge->na_assessment=$serviceChargesRate->na_assessment!=null?$serviceChargesRate->na_assessment:0.00;
        $TransBillServiceCharge->property_tax=$serviceChargesRate->property_tax!=null?$serviceChargesRate->property_tax:0.00;
        $TransBillServiceCharge->other=$serviceChargesRate->other!=null?$serviceChargesRate->other:0.00;
        $TransBillServiceCharge->save();
        return $TransBillServiceCharge;
    }
}
