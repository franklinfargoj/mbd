<?php

use Illuminate\Database\Seeder;
use App\RtiForm;

class RtiFormTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rti_form = RtiForm::select('id')->get();
    	if(count($rti_form)==0)
    	{
    		RtiForm::create([
	        	'board_id' => '1',
	        	'frontend_user_id' => '1',
	        	'applicant_name' => 'Test',
	        	'applicant_addr' => 'test',
	        	'info_subject' => 'test',
	        	'info_period_from' => '2018-08-21',
	        	'info_period_to' => '2018-08-21',
	        	'info_descr' => 'This is a test!!!!',
	        	'info_post_or_person' => '0',
	        	'info_post_type' => '0',
	        	'applicant_below_poverty_line' => '0',
	        	'poverty_line_proof' => '0',
	        	'created_at' => \Carbon\Carbon::now(),
	        	'updated_at' => \Carbon\Carbon::now(),
	        	'department_id' => '1',
	        	'unique_id' => '201808291535538158',
	        	'status' => '1',
	        	'user_id' => '2'
	        ]);
    	}
    }
}
