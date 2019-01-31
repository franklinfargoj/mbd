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

        OlApplicationMaster::truncate(); // To prevent duplicate entries,truncate master table & add all entries again.


        // SELF REDEVELOPMENT ======================================

            $application = OlApplicationMaster::create($applicationArr[0]);

            OlApplicationMaster::create([
                'parent_id'       =>  $application->id,
                'title'   => "New - Offer Letter",
                'route_name' => 'show_form_self',
                'model'   => "Premium",
                'preview_route' => 'society_offer_letter_preview'
            ]);
            OlApplicationMaster::create([
                'parent_id'       =>  $application->id,
                'route_name' => 'show_reval_self',
                'title'   => "Revalidation Of Offer Letter",
                'model'   => "Premium",
                'preview_route' => 'society_reval_offer_letter_preview'
            ]);
            OlApplicationMaster::create([
                'parent_id'       =>  $application->id,
                'route_name' => 'show_form_self_noc',
                'title'   => "Application for NOC",
                'model'   => "Premium",
                'preview_route' => 'society_noc_preview'
            ]);
            OlApplicationMaster::create([
                'parent_id'       =>  $application->id,
                'route_name' => 'show_oc_self',
                'title'   => "Consent for OC",
                'model'   => "Premium",
                'preview_route' => 'society_oc_preview'
            ]);

            // Sharing

            OlApplicationMaster::create([
                'parent_id'       =>  $application->id,
                'title'   => "New - Offer Letter",
                'route_name' => 'show_form_self',
                'model'   => "Sharing",
                'preview_route' => 'society_offer_letter_preview'
            ]);
            OlApplicationMaster::create([
                'parent_id'       =>  $application->id,
                'route_name' => 'show_reval_self',
                'title'   => "Revalidation Of Offer Letter",
                'model'   => "Sharing",
                'preview_route' => 'society_reval_offer_letter_preview'
            ]);
            OlApplicationMaster::create([
                'parent_id'       =>  $application->id,
                'title'   => "Application for NOC - IOD",
                'route_name' => 'show_form_self_noc',
                'model'   => "Sharing",
                'preview_route' => 'society_noc_preview'
            ]);
            OlApplicationMaster::create([
                'parent_id'       =>  $application->id,
                'route_name' => 'show_tripatite_self',
                'title'   => "Tripartite Agreement",
                'model'   => "Sharing",
                'preview_route' => 'tripartite_application_form_preview'
            ]);
            OlApplicationMaster::create([
                'parent_id'       =>  $application->id,
                'route_name' => 'show_form_self_noc_cc',
                'title'   => "Application for CC",
                'model'   => "Sharing",
                'preview_route' => 'society_noc_cc_preview'
            ]);
            OlApplicationMaster::create([
                'parent_id'       =>  $application->id,
                'route_name' => 'show_oc_self',
                'title'   => "Consent for OC",
                'model'   => "Sharing",
                'preview_route' => 'society_oc_preview'
            ]);

        // SELF REDEVELOPMENT END ======================================


        // REDEVELOPMENT THROUGH DEVELOPER ======================================

        $application = OlApplicationMaster::create($applicationArr[1]);

        OlApplicationMaster::create([
            'parent_id'       =>  $application->id,
            'title'   => "New - Offer Letter",
            'route_name' => 'show_form_dev',
            'model'   => "Premium",
            'preview_route' => 'society_offer_letter_preview'
        ]);
        OlApplicationMaster::create([
            'parent_id'       =>  $application->id,
            'route_name' => 'show_reval_dev',
            'title'   => "Revalidation Of Offer Letter",
            'model'   => "Premium",
            'preview_route' => 'society_reval_offer_letter_preview'
        ]);
        OlApplicationMaster::create([
            'parent_id'       =>  $application->id,
            'route_name' => 'show_form_self_noc',
            'title'   => "Application for NOC",
            'model'   => "Premium",
            'preview_route' => 'society_noc_preview'
        ]);
        OlApplicationMaster::create([
            'parent_id'       =>  $application->id,
            'route_name' => 'show_oc_dev',
            'title'   => "Consent for OC",
            'model'   => "Premium",
            'preview_route' => 'society_oc_preview'
        ]);

        // Sharing

        OlApplicationMaster::create([
            'parent_id'       =>  $application->id,
            'title'   => "New - Offer Letter",
            'route_name' => 'show_form_dev',
            'model'   => "Sharing",
            'preview_route' => 'society_offer_letter_preview'
        ]);
        OlApplicationMaster::create([
            'parent_id'       =>  $application->id,
            'route_name' => 'show_reval_dev',
            'title'   => "Revalidation Of Offer Letter",
            'model'   => "Sharing",
            'preview_route' => 'society_reval_offer_letter_preview'
        ]);
        OlApplicationMaster::create([
            'parent_id'       =>  $application->id,
            'title'   => "Application for NOC - IOD",
            'route_name' => 'show_form_self_noc',
            'model'   => "Sharing",
            'preview_route' => 'society_noc_preview'
        ]);
        OlApplicationMaster::create([
            'parent_id'       =>  $application->id,
            'route_name' => 'show_tripatite_dev',
            'title'   => "Tripartite Agreement",
            'model'   => "Sharing",
            'preview_route' => 'tripartite_application_form_preview'
        ]);
        OlApplicationMaster::create([
            'parent_id'       =>  $application->id,
            'route_name' => 'show_form_self_noc_cc',
            'title'   => "Application for CC",
            'model'   => "Sharing",
            'preview_route' => 'society_noc_cc_preview'
        ]);
        OlApplicationMaster::create([
            'parent_id'       =>  $application->id,
            'route_name' => 'show_oc_dev',
            'title'   => "Consent for OC",
            'model'   => "Sharing",
            'preview_route' => 'society_oc_preview'
        ]);

        // REDEVELOPMENT THROUGH DEVELOPER END ======================================


    }
}
