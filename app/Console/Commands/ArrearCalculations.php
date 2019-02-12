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
use File;

class ArrearCalculations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'arrearCalculation:monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the arrear calculation month wise';

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
        $this->generateArrearCalculationMonthWise();
    }

    public function generateArrearCalculationMonthWise() {
        
        $tenants   =  MasterTenant::all();

        if(empty($tenants) || is_null($tenants)){
           $this->info('Tenants are not present.');
        }

        $bill_month = date('m');

        if($bill_month == 1) {
            $ida_month = $ior_month = 12;
            $ida_year = $ior_year = date('Y') -1;
            $bill_year = date('Y');
            $year = date('Y') -1 ;
        } elseif($bill_month > 1 && $bill_month < 4) {
            $ida_month = $ior_month = $bill_month -1;
            $bill_year = $ida_year = $ior_year = date('Y');
            $year = date('Y') -1 ;
        } else {
            $ida_month = $ior_month = $bill_month -1;
            $bill_year = $ida_year = $ior_year = date('Y');
            $year = date('Y');
        }

        $strTxnData = '';
        foreach($tenants as $tenant) {
            $rate_card = ArrearsChargesRate::where('building_id', '=', $tenant->building_id)
                        ->where('year', '=', $year)
                        ->first();
            if(empty($rate_card) || is_null($rate_card)){          
               $this->info('Arrear charges are not defined for the tenant id '.$tenant->id .' named as '.$tenant->first_name);
            } else {
                $ior      = $rate_card->interest_on_old_rate;
                $old_rate = $rate_card->old_rate;
                
                $iod       = $rate_card->interest_on_differance;
                $rate_diff = $rate_card->revise_rate - $rate_card->old_rate;
                
                $ior_per = $ior / 100;
                $iod_per = $iod / 100;

                $old_intrest_amount = $old_rate * $ior_per;
                $intrest_on_difference = $rate_diff * $iod_per;

                $total = $old_rate + $old_intrest_amount + $rate_diff + $intrest_on_difference;

                $building = MasterBuilding::find($tenant->building_id);
                $society = SocietyDetail::find($building->society_id);

                $arrear_calculation = ArrearCalculation::where('tenant_id',$tenant->id)->where('building_id',$building->id)->where('society_id',$society->id)->where('month',$ior_month)->where('year',$bill_year)->first();

                if(empty($arrear_calculation)) {
                    $arrear_calculation = new ArrearCalculation;
                } 
                
                $arrear_calculation->tenant_id       = $tenant->id;
                $arrear_calculation->building_id     = $building->id;
                $arrear_calculation->society_id      = $society->id;
                $arrear_calculation->year            = $bill_year;
                $arrear_calculation->month           = $ior_month;
                $arrear_calculation->oir_year        = $ior_year;
                $arrear_calculation->oir_month       = $ior_month;
                $arrear_calculation->ida_year        = $ida_year;
                $arrear_calculation->ida_month       = $ida_month;
                $arrear_calculation->payment_status  = '0';
                $arrear_calculation->total_amount    = $total;
                $arrear_calculation->difference_amount         = $rate_diff;
                $arrear_calculation->old_intrest_amount        = $old_intrest_amount;
                $arrear_calculation->difference_intrest_amount = $intrest_on_difference;
                $arrear_calculation->save();

                $strTxnData .= 'Arrear Calculation is done for tenant name => '.$tenant->first_name.' tenant id => '.$tenant->id.' Form building => '.$building->name.' For society => '.$society->society_name."\n";
            }            
        }

        $file = 'monthly_arrear_calculation_file.txt';
        $destinationPath = public_path().'/uploads/';

        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($destinationPath.'/'.$file,$strTxnData);

        $this->info('Arrear Calculations added successfully.');
    }
}
