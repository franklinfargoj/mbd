<?php

use Illuminate\Database\Seeder;
use App\ApplicationType;

class ApplicationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $application_type = ApplicationType::select('id')->get();

        if(count($application_type)==0) {
            $create_application_type = [
                [
                    'application_type' => 'Application or claim',
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'application_type' => 'Appeal',
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'application_type' => 'Redressal',
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ]
            ];

            ApplicationType::insert($create_application_type);
        }
    }
}
