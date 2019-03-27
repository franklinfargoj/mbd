<?php

use Illuminate\Database\Seeder;

class TalukaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $talukas = \App\Taluka::get();

        $mumbai_city_district_id = \App\District::where('district_name','Mumbai City')->value('id');

        $mumbai_suburban_district_id = \App\District::where('district_name','Mumbai Suburban')->value('id');

        if(count($talukas) == 0) {

            $talukas_data = [
                [
                    'taluka_name' => 'Kurla',
                    'district_id' => $mumbai_suburban_district_id,
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'taluka_name' => 'Mulund',
                    'district_id' => $mumbai_suburban_district_id,
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'taluka_name' => 'Andheri',
                    'district_id' => $mumbai_suburban_district_id,
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'taluka_name' => 'Borivali',
                    'district_id' => $mumbai_suburban_district_id,
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'taluka_name' => 'Mumbai City',
                    'district_id' => $mumbai_city_district_id,
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ]
            ];

            \App\District::insert($talukas_data);

        }
    }
}
