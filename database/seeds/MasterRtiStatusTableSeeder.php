<?php

use Illuminate\Database\Seeder;
use App\MasterRtiStatus;

class MasterRtiStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rti_status = MasterRtiStatus::select('id')->get();
    	if(count($rti_status)==0)
    	{
    		MasterRtiStatus::create([
	        	'status_title' => 'Send RTI Officer',
	        	'created_at' => \Carbon\Carbon::now(),
	        	'updated_at' => \Carbon\Carbon::now()
	        ]);

	        MasterRtiStatus::create([
	        	'status_title' => 'In Process/Waiting for Meeting Schedule Time',
	        	'created_at' => \Carbon\Carbon::now(),
	        	'updated_at' => \Carbon\Carbon::now()
	        ]);

	        MasterRtiStatus::create([
	        	'status_title' => 'Meeting is Scheduled',
	        	'created_at' => \Carbon\Carbon::now(),
	        	'updated_at' => \Carbon\Carbon::now()
	        ]);

	        MasterRtiStatus::create([
	        	'status_title' => 'Closed',
	        	'created_at' => \Carbon\Carbon::now(),
	        	'updated_at' => \Carbon\Carbon::now()
	        ]);
    	}
    }
}
