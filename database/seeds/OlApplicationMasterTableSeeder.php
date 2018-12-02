<?php

use Illuminate\Database\Seeder;
use App\OlApplicationMaster;

class OlApplicationMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $applicationArr= [
            [
                'title'   => "Self Redevelopment",
                'model'   => "null",
            ],
            [
                'title'   => "Redevelopment Through Developer",
                'model'   => "null",
            ]
        ];

        foreach ($applicationArr as $app) {
            $application = OlApplicationMaster::create($app);

            OlApplicationMaster::create([
                'parent_id'       =>  $application->id,
                'title'   => "New - Offer Letter",
                'route_name' => 'show_form_self',
                'model'   => "Premium",
            ]);
            OlApplicationMaster::create([
                'parent_id'       =>  $application->id,
                'route_name' => 'show_reval_dev',
                'title'   => "Revalidation Of Offer Letter",
                'model'   => "Premium",
            ]);
            OlApplicationMaster::create([
                'parent_id'       =>  $application->id,
                'route_name' => 'show_form_self_noc',
                'title'   => "Application for NOC",
                'model'   => "Premium",
            ]);
            OlApplicationMaster::create([
                'parent_id'       =>  $application->id,
                'route_name' => 'show_form_self',
                'title'   => "Consent for OC",
                'model'   => "Premium",
            ]);

            // Sharing model applications ============================================

            OlApplicationMaster::create([
                'parent_id'       =>  $application->id,
                'title'   => "New - Offer Letter",
                'route_name' => 'show_form_dev',
                'model'   => "Sharing",
            ]);
            OlApplicationMaster::create([
                'parent_id'       =>  $application->id,
                'route_name' => 'show_reval_dev',
                'title'   => "Revalidation Of Offer Letter",
                'model'   => "Sharing",
            ]);
            OlApplicationMaster::create([
                'parent_id'       =>  $application->id,
                'title'   => "Application for NOC - IOD",
                'route_name' => 'show_form_self_noc',
                'model'   => "Sharing",
            ]);
            OlApplicationMaster::create([
                'parent_id'       =>  $application->id,
                'route_name' => 'show_form_self',
                'title'   => "Tripartite Agreement",
                'model'   => "Sharing",
            ]);
            OlApplicationMaster::create([
                'parent_id'       =>  $application->id,
                'route_name' => 'show_form_self_noc_cc',
                'title'   => "Application for CC",
                'model'   => "Sharing",
            ]);
            OlApplicationMaster::create([
                'parent_id'       =>  $application->id,
                'route_name' => 'show_form_self',
                'title'   => "Consent for OC",
                'model'   => "Sharing",
            ]);

        }
    }
}
