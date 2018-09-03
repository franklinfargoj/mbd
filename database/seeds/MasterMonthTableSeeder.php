<?php

use Illuminate\Database\Seeder;

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
        	MasterMonth::create([
	        	'month_name' => 'January',
	        	'created_at' => \Carbon\Carbon::now(),
	        	'updated_at' => \Carbon\Carbon::now()
	        ]);
	        MasterMonth::create([
	        	'month_name' => 'February',
	        	'created_at' => \Carbon\Carbon::now(),
	        	'updated_at' => \Carbon\Carbon::now()
	        ]);
	        MasterMonth::create([
	        	'month_name' => 'March',
	        	'created_at' => \Carbon\Carbon::now(),
	        	'updated_at' => \Carbon\Carbon::now()
	        ]);
        }
    }
}
