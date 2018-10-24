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
          $master_colony = factory(App\MasterColony::class, 10)->create();
          $master_society = factory(App\MasterSociety::class, 10)->create();
          $master_building = factory(App\MasterBuilding::class, 10)->create();
          $master_tenant = factory(App\MasterTenant::class, 10)->create();

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
    }
}
