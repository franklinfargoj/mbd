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
		$status=[
			[
	        	'status_title' => 'Send RTI Officer',
	        	'created_at' => \Carbon\Carbon::now(),
	        	'updated_at' => \Carbon\Carbon::now()
			],
			[
	        	'status_title' => 'In Process/Waiting for Meeting Schedule Time',
	        	'created_at' => \Carbon\Carbon::now(),
	        	'updated_at' => \Carbon\Carbon::now()
			],
			[
	        	'status_title' => 'Meeting is Scheduled',
	        	'created_at' => \Carbon\Carbon::now(),
	        	'updated_at' => \Carbon\Carbon::now()
			],
			[
	        	'status_title' => 'Closed',
	        	'created_at' => \Carbon\Carbon::now(),
	        	'updated_at' => \Carbon\Carbon::now()
	        ],
			[
	        	'status_title' => 'Forwarded',
	        	'created_at' => \Carbon\Carbon::now(),
	        	'updated_at' => \Carbon\Carbon::now()
			],
			[
				'status_title'=>'Sent To Appellate',
	        	'created_at' => \Carbon\Carbon::now(),
	        	'updated_at' => \Carbon\Carbon::now()
			]
		];
		
		
		foreach($status as $stat)
		{
			$rti_status = MasterRtiStatus::where(['status_title'=>$stat['status_title']])->first();
			if($rti_status){

			}else
			{
				MasterRtiStatus::create($stat);
			}
		}
    	// if(count($rti_status)==0)
    	// {
    	// 	MasterRtiStatus::create([
	    //     	'status_title' => 'Send RTI Officer',
	    //     	'created_at' => \Carbon\Carbon::now(),
	    //     	'updated_at' => \Carbon\Carbon::now()
	    //     ]);

	    //     MasterRtiStatus::create([
	    //     	'status_title' => 'In Process/Waiting for Meeting Schedule Time',
	    //     	'created_at' => \Carbon\Carbon::now(),
	    //     	'updated_at' => \Carbon\Carbon::now()
	    //     ]);

	    //     MasterRtiStatus::create([
	    //     	'status_title' => 'Meeting is Scheduled',
	    //     	'created_at' => \Carbon\Carbon::now(),
	    //     	'updated_at' => \Carbon\Carbon::now()
	    //     ]);

	    //     MasterRtiStatus::create([
	    //     	'status_title' => 'Closed',
	    //     	'created_at' => \Carbon\Carbon::now(),
	    //     	'updated_at' => \Carbon\Carbon::now()
	    //     ]);
    	// }
    }
}
