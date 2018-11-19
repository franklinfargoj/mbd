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


        // REE Dashboard Headers
        // REE Head
        $ree_head = Role::where('name',config('commanConfig.ree_branch_head'))->value('id');

        $ree_head_labels = ['Total No of Application',
            'Application Pending',
            'Application Sent for Revision',
            'Proposal Sent for Approval to CO',
            'Draft Offer Letter Generated',
            'Offer Letter sent for Approval to CO',
            'Offer Letter Approved',
        ];
        $ree_header = DashboardHeader::where('role_id',$ree_head)->get();

        $ree_head_header_arr = array();
        foreach ($ree_header as $reehead){
            $ree_head_header_arr[] = $reehead->header_name;
        }

        $ree_head_header_data = array();
        foreach($ree_head_labels as $label)
        {
            if(!(in_array($label,$ree_head_header_arr)))
            {
                $ree_head_header_data[] =[
                    'header_name' => $label,
                    'role_id' => $ree_head,
                    'is_top' =>  1
                ];

            }
        }

        // REE Assistant
        $ree_ass = Role::where('name',config('commanConfig.ree_assistant_engineer'))->value('id');

        $ree_ass_labels = ['Total No of Application',
            'Application Pending',
            'Application Sent for Revision',
            'Proposal Sent for Approval to REE Head',
            'Draft Offer Letter Generated',
            'Offer Letter sent for Approval to CO',
            'Offer Letter Approved',
        ];

        $ree_ass_header = DashboardHeader::where('role_id',$ree_ass)->get();

        $ree_ass_header_arr = array();

        foreach ($ree_ass_header as $reeass){
            $ree_ass_header_arr[] = $reeass->header_name;
        }

        $ree_ass_header_data = array();

        foreach($ree_ass_labels as $label)
        {
            if(!(in_array($label,$ree_ass_header_arr)))
            {
                $ree_ass_header_data[] =[
                    'header_name' => $label,
                    'role_id' => $ree_ass,
                    'is_top' =>  1
                ];

            }
        }

        // REE Deputy
        $ree_deputy = Role::where('name',config('commanConfig.ree_deputy_engineer'))->value('id');

        $ree_deputy_labels = ['Total No of Application',
            'Application Pending',
            'Application Sent for Revision',
            'Proposal Sent for Approval to REE Assistant',
            'Draft Offer Letter Generated',
            'Offer Letter sent for Approval to CO',
            'Offer Letter Approved',
        ];

        $ree_deputy_header = DashboardHeader::where('role_id',$ree_deputy)->get();

        $ree_deputy_header_arr = array();
        foreach ($ree_deputy_header as $reedeputy){
            $ree_deputy_header_arr[] = $reedeputy->header_name;
        }

        $ree_deputy_header_data = array();
        foreach($ree_deputy_labels as $label)
        {
            if(!(in_array($label,$ree_deputy_header_arr)))
            {
                $ree_deputy_header_data[] =[
                    'header_name' => $label,
                    'role_id' => $ree_deputy,
                    'is_top' =>  1
                ];

            }
        }

        // REE Junior
        $ree_junior = Role::where('name',config('commanConfig.ree_junior'))->value('id');

        $ree_junior_labels = ['Total No of Application',
            'Application Pending',
            'Application Sent for Revision',
            'Proposal Sent for Approval to REE Deputy',
            'Draft Offer Letter Generated',
            'Offer Letter sent for Approval to CO',
            'Offer Letter Approved',
        ];

        $ree_junior_header = DashboardHeader::where('role_id',$ree_junior)->get();

        $ree_junior_header_arr = array();

        foreach ($ree_junior_header as $reejunior){
            $ree_junior_header_arr[] = $reejunior->header_name;
        }

        $ree_junior_header_data = array();

        foreach($ree_junior_labels as $label)
        {
            if(!(in_array($label,$ree_junior_header_arr)))
            {
                $ree_junior_header_data[] =[
                    'header_name' => $label,
                    'role_id' => $ree_junior,
                    'is_top' =>  1
                ];

            }
        }

        //Total application at all department
        // REE Head
        $ree_head_labels1 = ['Total number of Application Pending',
            'Applications pending at EE Dept.',
            'Application Pending at DyCE Dept.',
            'Applications pending at REE Dept.',
            'Applications pending at CO',
            'Applications pending at CAP',
            'Applications pending at VP',
        ];

        $ree_head_header_arr1 = array();
        foreach ($ree_header as $reehead){
            $ree_head_header_arr1[] = $reehead->header_name;
        }

        $ree_head_header_data1 = array();
        foreach($ree_head_labels1 as $label)
        {
            if(!(in_array($label,$ree_head_header_arr1)))
            {
                $ree_head_header_data1[] =[
                    'header_name' => $label,
                    'role_id' => $ree_head,
                    'is_top' =>  2
                ];

            }
        }

        $ree_header_data = array_merge($ree_head_header_data,$ree_deputy_header_data,$ree_junior_header_data,$ree_ass_header_data,$ree_head_header_data1);

        DashboardHeader::insert($ree_header_data);

        // CO

        $co_engineer = Role::where('name',config('commanConfig.co_engineer'))->value('id');

        $co_labels = ['Total No of Application',
            'Application Pending',
            'Application Sent for Revision to REE',
            'Application Forwarded to CAP',
            'Offer Letter Pending for Approval',
            'Offer Letter Approved',
            'Offer Letter Approved but not issued to Society',
        ];

        $co_header = DashboardHeader::where('role_id',$co_engineer)->get();

        $co_header_arr = array();

        foreach ($co_header as $co){
            $co_header_arr[] = $co->header_name;
        }

        $co_header_data = array();

        foreach($co_labels as $label)
        {
            if(!(in_array($label,$co_header_arr)))
            {
                $co_header_data[] =[
                    'header_name' => $label,
                    'role_id' => $co_engineer,
                    'is_top' =>  1
                ];

            }
        }
        //Total application at all department
        // Co
        $co_labels1 = ['Total number of Application Pending',
            'Applications pending at EE Dept.',
            'Application Pending at DyCE Dept.',
            'Applications pending at REE Dept.',
            'Applications pending at CO',
            'Applications pending at CAP',
            'Applications pending at VP',
        ];

        $co_header_arr1 = array();
        foreach ($co_header as $co){
            $co_header_arr1[] = $co->header_name;
        }

        $co_header_data1 = array();
        foreach($co_labels1 as $label)
        {
            if(!(in_array($label,$co_header_arr1)))
            {
                $co_header_data1[] =[
                    'header_name' => $label,
                    'role_id' => $co_engineer,
                    'is_top' =>  2
                ];

            }
        }

        $co_en_header_data = array_merge($co_header_data,$co_header_data1);
        DashboardHeader::insert($co_en_header_data);

        // CAP
        $cap_engineer = Role::where('name',config('commanConfig.cap_engineer'))->value('id');

        $cap_labels = ['Total No of Application',
            'Application Pending',
            'Application Sent for Revision to CO',
            'Application Forwarded to CAP'
        ];

        $cap_header = DashboardHeader::where('role_id',$cap_engineer)->get();

        $cap_header_arr = array();

        foreach ($cap_header as $cap){
            $cap_header_arr[] = $cap->header_name;
        }

        $cap_en_header_data = array();

        foreach($cap_labels as $label)
        {
            if(!(in_array($label,$cap_header_arr)))
            {
                $cap_en_header_data[] =[
                    'header_name' => $label,
                    'role_id' => $cap_engineer,
                    'is_top' =>  1
                ];

            }
        }
        DashboardHeader::insert($cap_en_header_data);

        // VP
        $vp_engineer = Role::where('name',config('commanConfig.vp_engineer'))->value('id');

        $vp_labels = ['Total No of Application',
            'Application Pending',
            'Application Sent for Revision',
            'Application Forwarded'
        ];

        $vp_header = DashboardHeader::where('role_id',$vp_engineer)->get();

        $vp_header_arr = array();

        foreach ($vp_header as $vp){
            $vp_header_arr[] = $vp->header_name;
        }

        $vp_en_header_data = array();

        foreach($vp_labels as $label)
        {
            if(!(in_array($label,$vp_header_arr)))
            {
                $vp_en_header_data[] =[
                    'header_name' => $label,
                    'role_id' => $vp_engineer,
                    'is_top' =>  1
                ];

            }
        }
        DashboardHeader::insert($vp_en_header_data);

    }
}
