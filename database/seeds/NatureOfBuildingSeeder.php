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

        $building_natures = NatureOfBuilding::pluck('name')->toArray();
        
        if(count($building_natures) == 0){
            NatureOfBuilding::insert($names);
        }else{
            foreach($names as $name){
                if(!in_array($name['name'],$building_natures)){
                    NatureOfBuilding::insert($name);
                }
            }
        }
    }
}
