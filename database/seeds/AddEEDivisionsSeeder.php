<?php

use Illuminate\Database\Seeder;
use App\EEDivision;

class AddEEDivisionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $divisions=[
            [
                'division'=>'EE - Borivali Division'
            ],
            [
                'division'=>'EE - Goregaon Division'
            ],
            [
                'division'=>'EE - Bandra Division'
            ],
            [
                'division'=>'EE - Kurla Division'
            ],
            [
                'division'=>'EE - PPD Division'
            ],
            [
                'division'=>'EE - City Division'
            ],
            [
                'division'=>'EE - BBD Division'
            ]
        ];

        foreach($divisions as $division)
        {
            $ee_division=EEDivision::where(['division'=>$division['division']])->first();
            if($ee_division==null)
            {
                EEDivision::insert($division);
            }
        }
    }
}
