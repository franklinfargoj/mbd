<?php

use Illuminate\Database\Seeder;
use App\SocietyConveyanceApplicationType;

class SocietyConveyanceApplicationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $society = SocietyConveyanceApplicationType::all();

        $sc_applications = [
            [
                'application_type' => 'Conveyance'
            ],
            [
                'application_type' => 'Renewal'
            ],
        ];

        if(count($society) == 0){
            SocietyConveyanceApplicationType::insert($sc_applications);
        }else{
            foreach($sc_applications as $sc_applications_key => $sc_applications_val){
                $sc_application = SocietyConveyanceApplicationType::where('application_type', $sc_applications_val['application_type'])->first();
                if($sc_application){
                    continue;
                }else{
                    SocietyConveyanceApplicationType::insert($sc_applications_val);
                }
            }
        }
    }
}
