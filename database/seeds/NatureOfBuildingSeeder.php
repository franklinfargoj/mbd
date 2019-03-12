<?php

use Illuminate\Database\Seeder;
use App\NatureOfBuilding;

class NatureOfBuildingSeeder extends Seeder
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
                'name' => 'Chawl',
            ],
            [
                'name' => 'Building',
            ],
            [
                'name' => 'Office Building',
            ]
        ];

        $building_natures = NatureOfBuilding::all();
        
        if(count($building_natures) == 0){
            NatureOfBuilding::insert($names);
        }else{
            foreach($names as $name){
                foreach($building_natures as $building_nature){
                    if($building_nature->name == $name['name']){
                        continue;
                    }else{
                        NatureOfBuilding::insert($name);
                    }
                }
            }
        }
    }
}
