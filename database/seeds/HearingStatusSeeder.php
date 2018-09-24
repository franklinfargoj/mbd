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
                    'status_title' => 'Pending',
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'status_title' => 'Scheduled Meeting',
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'status_title' => 'Case Under Judgement',
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'status_title' => 'Forwarded',
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'status_title' => 'Notice Send',
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
                [
                    'status_title' => 'Case Closed',
                    'Created_At' => \Carbon\Carbon::now(),
                    'Updated_At' => \Carbon\Carbon::now()
                ],
            ];

            HearingStatus::insert($create_hearing_status);
        }
    }
}
