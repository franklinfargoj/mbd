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
        ServiceCharge::truncate();
        $names = [
            [
                'name' => 'Per tenant'
            ],
            [
                'name' => 'Society'
            ]
        ];

        $service_charge_names = ServiceCharge::pluck('name')->toArray();

        if(count($service_charge_names) == 0){
            ServiceCharge::insert($names);
        }else{
            foreach ($names as $name){
                if(!in_array($name['name'],$service_charge_names)){
                    ServiceCharge::insert($name);   
                }
            }    
                // foreach ($service_charge_names as $service_charge_name){
                    // if($name['name'] == $service_charge_name->name){
                    //     continue;
                    // }else{
                    //     ServiceCharge::insert($name);
                    // }
                // }
            // }
        }
    }
}
