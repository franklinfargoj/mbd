<?php

use Illuminate\Database\Seeder;
use App\MasterMonth;

class MasterMonthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $month = MasterMonth::select('id')->get();
        if(count($month)==0){
            $month_data = [
                [
                  'month_name' => 'January',
                  'created_at' => \Carbon\Carbon::now(),
                  'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'month_name' => 'February',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],

                [
                  'month_name' => 'March',
                  'created_at' => \Carbon\Carbon::now(),
                  'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'month_name' => 'April',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],

                [
                  'month_name' => 'May',
                  'created_at' => \Carbon\Carbon::now(),
                  'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'month_name' => 'June',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],

                [
                  'month_name' => 'July',
                  'created_at' => \Carbon\Carbon::now(),
                  'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'month_name' => 'August',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],

                [
                  'month_name' => 'September',
                  'created_at' => \Carbon\Carbon::now(),
                  'updated_at' => \Carbon\Carbon::now()
                ],
                [
                    'month_name' => 'October',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ],

                [
                  'month_name' => 'November',
                  'created_at' => \Carbon\Carbon::now(),
                  'updated_at' => \Carbon\Carbon::now()
                ],
                [
                   'month_name' => 'December',
                   'created_at' => \Carbon\Carbon::now(),
                   'updated_at' => \Carbon\Carbon::now()
                ],
            ];

            MasterMonth::insert($month_data);
        }
    }
}
