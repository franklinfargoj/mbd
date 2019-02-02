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
                'application_type' => 'Conveyance',
                'preview_route' => 'society_conveyance.show'
            ],
            [
                'application_type' => 'Renewal',
                'preview_route' => 'society_renewal.show'
            ],
            [
                'application_type' => 'Formation',
                'preview_route' => 'society_formation.view_application'
            ]
        ];

        if(count($society) == 0){
            scApplicationType::insert($sc_applications);
        }else{
            foreach($sc_applications as $sc_applications_key => $sc_applications_val){
                $sc_application = scApplicationType::where('application_type', $sc_applications_val['application_type'])->first();
                if($sc_application){
                    if($sc_application->preview_route == null){
                        scApplicationType::where('id', $sc_application->id)->update($sc_applications_val);
                    }else{
                        continue;
                    }
                }else{
                    scApplicationType::insert($sc_applications_val);
                }
            }
        }
    }
}
