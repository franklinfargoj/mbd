<?php

use Illuminate\Database\Seeder;
use App\conveyance\scApplicationType;

class SocietyConveyanceApplicationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $society = scApplicationType::all();

        $sc_applications = [
            [
                'application_type' => 'Conveyance'
            ],
            [
                'application_type' => 'Renewal'
            ],
            [
                'application_type' => 'Formation'
            ]
        ];

        if(count($society) == 0){
            scApplicationType::insert($sc_applications);
        }else{
            foreach($sc_applications as $sc_applications_key => $sc_applications_val){
                $sc_application = scApplicationType::where('application_type', $sc_applications_val['application_type'])->first();
                if($sc_application){
                    continue;
                }else{
                    scApplicationType::insert($sc_applications_val);
                }
            }
        }
    }
}
