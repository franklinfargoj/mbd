<?php

use Illuminate\Database\Seeder;
use App\MasterLayout;
use App\MasterWard;
use App\MasterColony;
use App\MasterBuilding;
use App\MasterTenant;
use App\MasterTenantType;

class MasterTables extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //coded by shrikant sabne
        // $wards = MasterWard::select('id')->get();
        // if(count($wards)==0) {
        //   $master_ward = factory(App\MasterWard::class, 10)->create();
        // }
        
        // $colony = MasterColony::select('id')->get();
        // if(count($colony)==0) {
        //   $master_colony = factory(App\MasterColony::class, 30)->create();
        // }

        /*$wards=[
            [
                'layout_id'=>1,
                'name'=>'ward1',
                'description'=>'ward1'
            ],
            [
                'layout_id'=>1,
                'name'=>'ward2',
                'description'=>'ward2'
            ],
            [
                'layout_id'=>1,
                'name'=>'ward3',
                'description'=>'ward3'
            ],
        ];
        foreach($wards as $ward)
        {
            $ward_chek = MasterWard::where(['name'=>$ward['name'],'layout_id'=>1])->first();
            if($ward_chek)
            {
                $ward_id=$ward_chek->id;
            }else
            {
                $ward_id = MasterWard::insertGetId($ward);
            }

            $colonies=[
                [
                    'ward_id'=>$ward_id,
                    'name'=>'colony1_of_'.$ward['name'],
                    'description'=>'colony1_of_'.$ward['name']
                ],
                [
                    'ward_id'=>$ward_id,
                    'name'=>'colony2_of_'.$ward['name'],
                    'description'=>'colony3_of_'.$ward['name']
                ]
                ,
                [
                    'ward_id'=>$ward_id,
                    'name'=>'colony3_of_'.$ward['name'],
                    'description'=>'colony3_of_'.$ward['name']
                ]
            ];

            foreach($colonies as $colony)
            {
                $colony_check = MasterColony::where(['name'=>$ward['name'],'ward_id'=>$ward_id])->first();
                if($colony_check)
                {
                    $colony_id=$colony_check->id;
                }else
                {
                    $colony_id = MasterColony::insertGetId($colony);
                }
            }
        }*/
        /*
        $building = MasterBuilding::select('id')->get();
        if(count($building)==0) {
          $master_building = factory(App\MasterBuilding::class, 90)->create();
        }

        $tenant = MasterTenant::select('id')->get();
        if(count($tenant)==0) {
          $master_tenant = factory(App\MasterTenant::class, 100)->create(); 
        }*/

        $tenant = [
                [
                    'name' => 'LIG',
                    'description' => 'LIG'
                ],
                [
                    'name' => 'EWS',
                    'description' => 'EWS'
                ],
                [
                    'name' => 'MIG',
                    'description' => 'MIG'
                ],
                [
                    'name' => 'HIG',
                    'description' => 'HIG'
                ]
        ];

        $tenant_type = MasterTenantType::select('id')->get();

        if(count($tenant_type) <= 0) {
           App\MasterTenantType::insert($tenant);
        }


        $billing_type = [
                [
                   'name' => 'Society Level Billing',
                   'description' => 'Society Level Billing'
                ],
                [
                    'name' => 'Tenant Level Billing',
                    'description' => 'Tenant Level Billing'
                ]
        ];

        $master_society_bill_level = DB::table('master_society_bill_level')->get();

        if(count($master_society_bill_level) == 0){ 

          DB::table('master_society_bill_level')->insert($billing_type);

        }

    }
    
}
