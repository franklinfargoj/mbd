<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\DashboardHeader;

class DashboardHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // EE Dashboard Headers
        // EE Head
        $ee_head = Role::where('name',config('commanConfig.ee_branch_head'))->value('id');

        $ee_head_labels = ['Total No of Application',
            'Application Pending',
            'Application Sent for Compliance',
            'Application Forwarded to DyCE',
            ];
        $ee_header = DashboardHeader::where('role_id',$ee_head)->get();

        $ee_head_header_arr = array();
        foreach ($ee_header as $eehead){
            $ee_head_header_arr[] = $eehead->header_name;
        }

        $ee_head_header_data = array();
        foreach($ee_head_labels as $label)
        {
            if(!(in_array($label,$ee_head_header_arr)))
            {
                $ee_head_header_data[] =[
                    'header_name' => $label,
                    'role_id' => $ee_head,
                    'is_top' =>  1
                ];

            }
        }

        // EE Deputy
        $ee_deputy = Role::where('name',config('commanConfig.ee_deputy_engineer'))->value('id');

        $ee_deputy_labels = ['Total No of Application',
            'Application Pending',
            'Application Sent for Compliance',
            'Application Forwarded to EE Head'
        ];

        $ee_deputy_header = DashboardHeader::where('role_id',$ee_deputy)->get();

        $ee_deputy_header_arr = array();
        foreach ($ee_deputy_header as $eedeputy){
            $ee_deputy_header_arr[] = $eedeputy->header_name;
        }

        $ee_deputy_header_data = array();
        foreach($ee_deputy_labels as $label)
        {
            if(!(in_array($label,$ee_deputy_header_arr)))
            {
                $ee_deputy_header_data[] =[
                    'header_name' => $label,
                    'role_id' => $ee_deputy,
                    'is_top' =>  1
                ];

            }
        }

        // EE Junior
        $ee_junior = Role::where('name',config('commanConfig.ee_junior_engineer'))->value('id');

        $ee_junior_labels = ['Total No of Application',
            'Application Pending',
            'Application Forwarded to EE Deputy'
        ];

        $ee_junior_header = DashboardHeader::where('role_id',$ee_junior)->get();

        $ee_junior_header_arr = array();

        foreach ($ee_junior_header as $eejunior){
            $ee_junior_header_arr[] = $eejunior->header_name;
        }

        $ee_junior_header_data = array();

        foreach($ee_junior_labels as $label)
        {
            if(!(in_array($label,$ee_junior_header_arr)))
            {
                $ee_junior_header_data[] =[
                    'header_name' => $label,
                    'role_id' => $ee_junior,
                    'is_top' =>  1
                ];

            }
        }

        $ee_header_data = array_merge($ee_head_header_data,$ee_deputy_header_data,$ee_junior_header_data);

        DashboardHeader::insert($ee_header_data);

        // DYCE Dashboard Headers
        // DYCE Head
        $dyce_head = Role::where('name',config('commanConfig.dyce_branch_head'))->value('id');

        $dyce_head_labels = ['Total No of Application',
            'Application Pending',
            'Application Sent for Compliance',
            'Application Forwarded to REE',
        ];
        $dyce_header = DashboardHeader::where('role_id',$dyce_head)->get();

        $dyce_head_header_arr = array();
        foreach ($dyce_header as $dycehead){
            $dyce_head_header_arr[] = $dycehead->header_name;
        }

        $dyce_head_header_data = array();
        foreach($dyce_head_labels as $label)
        {
            if(!(in_array($label,$dyce_head_header_arr)))
            {
                $dyce_head_header_data[] =[
                    'header_name' => $label,
                    'role_id' => $dyce_head,
                    'is_top' =>  1
                ];

            }
        }

        // DYCE Deputy
        $dyce_deputy = Role::where('name',config('commanConfig.dyce_deputy_engineer'))->value('id');

        $dyce_deputy_labels = ['Total No of Application',
            'Application Pending',
            'Application Sent for Compliance',
            'Application Forwarded to DYCE Head'
        ];

        $dyce_deputy_header = DashboardHeader::where('role_id',$dyce_deputy)->get();

        $dyce_deputy_header_arr = array();
        foreach ($dyce_deputy_header as $dycedeputy){
            $dyce_deputy_header_arr[] = $dycedeputy->header_name;
        }

        $dyce_deputy_header_data = array();
        foreach($dyce_deputy_labels as $label)
        {
            if(!(in_array($label,$dyce_deputy_header_arr)))
            {
                $dyce_deputy_header_data[] =[
                    'header_name' => $label,
                    'role_id' => $dyce_deputy,
                    'is_top' =>  1
                ];

            }
        }

        // DYCE Junior
        $dyce_junior = Role::where('name',config('commanConfig.dyce_jr_user'))->value('id');

        $dyce_junior_labels = ['Total No of Application',
            'Application Pending',
            'Application Forwarded to DYCE Deputy'
        ];

        $dyce_junior_header = DashboardHeader::where('role_id',$dyce_junior)->get();

        $dyce_junior_header_arr = array();

        foreach ($dyce_junior_header as $dycejunior){
            $dyce_junior_header_arr[] = $dycejunior->header_name;
        }

        $dyce_junior_header_data = array();

        foreach($dyce_junior_labels as $label)
        {
            if(!(in_array($label,$dyce_junior_header_arr)))
            {
                $dyce_junior_header_data[] =[
                    'header_name' => $label,
                    'role_id' => $dyce_junior,
                    'is_top' =>  1
                ];

            }
        }

        $dyce_header_data = array_merge($dyce_head_header_data,$dyce_deputy_header_data,$dyce_junior_header_data);
        DashboardHeader::insert($dyce_header_data);



    }
}
