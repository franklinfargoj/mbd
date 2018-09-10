<?php

use Illuminate\Database\Seeder;
use App\ResolutionType;

class ResolutionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$resolutions = ResolutionType::select('id')->get();
    	if(count($resolutions)==0)
    	{
    		ResolutionType::create([
	        	'name' => 'MHADA Resolutions'
	        ]);

	        ResolutionType::create([
	        	'name' => 'M.B.R & Resolutions'
	        ]);

	        ResolutionType::create([
	        	'name' => 'Government Resolutions'
	        ]);
    	}
    }
}
