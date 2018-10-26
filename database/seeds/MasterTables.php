<?php

use Illuminate\Database\Seeder;
use App\MasterLayout;
use App\MasterWard;
use App\MasterColony;
use App\MasterSociety;
use App\MasterBuilding;
use App\MasterTenant;
use DB;

class MasterTables extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wards = MasterWard::select('id')->get();
        if(count($wards)==0) {
          $master_ward = factory(App\MasterWard::class, 10)->create();
        }
        
        $colony = MasterColony::select('id')->get();
        if(count($colony)==0) {
          $master_colony = factory(App\MasterColony::class, 30)->create();
        }
        
        $building = MasterBuilding::select('id')->get();
        if(count($building)==0) {
          $master_building = factory(App\MasterBuilding::class, 90)->create();
        }

        $tenant = MasterTenant::select('id')->get();
        if(count($tenant)==0) {
          $master_tenant = factory(App\MasterTenant::class, 100)->create();
        }

        $tenant_type = [
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

        if(count($tenant_type)==0) {
           App\MasterTenantType::insert($tenant_type);
        }

        $master_society_bill_level = DB::table('master_society_bill_level')->get();
        if(count($master_society_bill_level) == 0){ 
          DB::table('master_society_bill_level')->insert([
            'name' => 'Society Level Billing',
            'description' => 'Society Level Billing'
          ]);

          DB::table('master_society_bill_level')->insert([
            'name' => 'Tenant Level Billing',
            'description' => 'Tenant Level Billing'
          ]);
        }

    }
    
}
