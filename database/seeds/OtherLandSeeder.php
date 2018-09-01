<?php

use Illuminate\Database\Seeder;
use \App\OtherLand;

class OtherLandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $other_land = OtherLand::select('id')->get();

        if(count($other_land)==0) {
            $create_other_land = [
                [
                    'land_name' => 'SRA',
                    'status' => 1,
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'land_name' => 'Amenity plot',
                    'status' => 1,
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'land_name' => 'Plot handed over BMC or others',
                    'status' => 1,
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'land_name' => 'Vacant plots',
                    'status' => 1,
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'land_name' => 'Office building',
                    'status' => 1,
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ]
            ];

            OtherLand::insert($create_other_land);
        }
    }
}
