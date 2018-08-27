<?php

use Illuminate\Database\Seeder;
use App\HearingStatus;

class HearingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hearing_status = HearingStatus::select('id')->get();

        if(count($hearing_status)==0) {
            $create_hearing_status = [
                [
                    'status_title' => 'Document submitted',
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'status_title' => 'On board',
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'status_title' => 'Case Closed',
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'status_title' => 'Pending',
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'status_title' => 'Ordered for Next Hearing',
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
            ];

            HearingStatus::insert($create_hearing_status);
        }
    }
}
