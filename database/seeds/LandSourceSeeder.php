<?php

use Illuminate\Database\Seeder;
use App\LandSource;

class LandSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $land_source = LandSource::select('id')->get();

        if(count($land_source)==0) {
            $create_land_source = [
                [
                    'source_name' => 'Acquired land',
                    'status' => 1,
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'source_name' => 'Government Land',
                    'status' => 1,
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'source_name' => 'Purchased Land',
                    'status' => 1,
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'source_name' => 'Other land',
                    'status' => 1,
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
            ];

            LandSource::insert($create_land_source);
        }
    }
}
