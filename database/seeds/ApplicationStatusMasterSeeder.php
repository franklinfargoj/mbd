<?php

use Illuminate\Database\Seeder;
use App\ApplicationStatusMaster;

class ApplicationStatusMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void  
     */
    public function run()
    {
    	$status = [
    	['status_name' => 'in_process'],
    	['status_name' => 'forwarded'],
    	['status_name' => 'reverted'],
        ['status_name' => 'pending'],
        ['status_name' => 'offer_letter_generation'],
        ['status_name' => 'offer_letter_approved'],
        ['status_name' => 'sent_to_society'],
    	['status_name' => 'Draft sale and lease deed'],
    	['status_name' => 'Aproved sale and lease'],
    	['status_name' => 'Sent society to pay stamp duety'],
    	['status_name' => 'Stamped sale and lease deed'],
    	['status_name' => 'Stamped signed sale and lease deed'],
    	['status_name' => 'Sent society for registration of sale and lease'],
    	['status_name' => 'Registered sale and lease deed'],
        ['status_name' => 'NOC issued'],
        ['status_name' => 'Draft'],
        ['status_name' => 'Approved'],
        ['status_name' => 'Stamped'],
        ['status_name' => 'Stamped_Signed'],
        ['status_name' => 'Register'],
        ['status_name' => 'Draft_Sign']
    	];
     	$applicationStatus = ApplicationStatusMaster::pluck('status_name');
 		 if (count($applicationStatus) > '0') {

 		 	foreach($status as $data){

 		 		$ApplicationStatusMaster = ApplicationStatusMaster::where('status_name',$data['status_name'])->first();
 		 		
 		 		if(!$ApplicationStatusMaster){

 		 			$ApplicationStatusMaster = new ApplicationStatusMaster();	
 		 			$ApplicationStatusMaster->status_name = $data['status_name'];
 		 			$ApplicationStatusMaster->save();
 		 		}else{
 		 			
 		 		}
 		 	}
 		 }else {
 		 	ApplicationStatusMaster::insert($status);
 		 }

    }
}
