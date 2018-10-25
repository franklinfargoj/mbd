<?php

use Illuminate\Database\Seeder;
use App\MasterLayout;
use App\MasterWard;
use App\MasterColony;
use App\MasterSociety;
use App\MasterBuilding;
use App\MasterTenant;

class MasterTables extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $master_ward = factory(App\MasterWard::class, 10)->create();
          $master_colony = factory(App\MasterColony::class, 30)->create();
          $master_society = factory(App\MasterSociety::class, 60)->create();
          $master_building = factory(App\MasterBuilding::class, 90)->create();
          $master_tenant = factory(App\MasterTenant::class, 100)->create();

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

           App\MasterTenantType::insert($tenant_type);

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
