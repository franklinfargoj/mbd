<?php

use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = \App\District::select('id')->get();

        if(count($districts) == 0) {

            $districts_data = [
                [
                    'district_name' => 'Mumbai City',
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'district_name' => 'Mumbai Suburban',
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ]
            ];

            \App\District::insert($districts_data);

        }
    }
}
