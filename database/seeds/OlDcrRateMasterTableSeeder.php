<?php

use Illuminate\Database\Seeder;
use App\OlDcrRateMaster;

class OlDcrRateMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dcrRateArr= [
            [
                'lr_val'   => "0 to 2",
                'lc_val'   => "EWS / LIG",
                'percentage_val' => 40
            ],[
                'lr_val'   => "0 to 2",
                'lc_val'   => "MIG",
                'percentage_val' => 60
            ],[
                'lr_val'   => "0 to 2",
                'lc_val'   => "HIG",
                'percentage_val' => 80
            ],[
                'lr_val'   => "2 to 4",
                'lc_val'   => "EWS / LIG",
                'percentage_val' => 45
            ],[
                'lr_val'   => "2 to 4",
                'lc_val'   => "MIG",
                'percentage_val' => 65
            ],[
                'lr_val'   => "2 to 4",
                'lc_val'   => "HIG",
                'percentage_val' => 85
            ],[
                'lr_val'   => "4 to 6",
                'lc_val'   => "EWS / LIG",
                'percentage_val' => 50
            ],[
                'lr_val'   => "4 to 6",
                'lc_val'   => "MIG",
                'percentage_val' => 70
            ],[
                'lr_val'   => "4 to 6",
                'lc_val'   => "HIG",
                'percentage_val' => 90
            ],[
                'lr_val'   => "above 6",
                'lc_val'   => "EWS / LIG",
                'percentage_val' => 55
            ],[
                'lr_val'   => "above 6",
                'lc_val'   => "MIG",
                'percentage_val' => 75
            ],[
                'lr_val'   => "above 6",
                'lc_val'   => "HIG",
                'percentage_val' => 95
            ]
        ];

        foreach ($dcrRateArr as $rate) {
            $dcrRate = OlDcrRateMaster::create($rate);
        }
        }
}
