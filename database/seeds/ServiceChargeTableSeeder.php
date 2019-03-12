<?php

use Illuminate\Database\Seeder;
use App\ServiceCharge;

class ServiceChargeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            [
                'name' => 'Per tenant'
            ],
            [
                'name' => 'Society'
            ]
        ];

        $service_charge_names = ServiceCharge::all();

        if(count($service_charge_names) == 0){
            ServiceCharge::insert($names);
        }else{
            foreach ($names as $name){
                foreach ($service_charge_names as $service_charge_name){
                    if($name['name'] == $service_charge_name->name){
                        continue;
                    }else{
                        ServiceCharge::insert($name);
                    }
                }
            }
        }
    }
}
