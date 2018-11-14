<?php

use Illuminate\Database\Seeder;
use App\OlCustomCalculationMasterModel;

class OlCustomCalculationMaster extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
	        ['name' => 'Calculation_Table-A'],
	        ['name' => 'Part_Payment'],
	        ['name' => '1st_Installment'],
	        ['name' => 'remaining_Installment'],
	        ['name' => 'Summary']
        ];  

        $masterData =  OlCustomCalculationMasterModel::all();
        if (count($masterData) == 0){
        	OlCustomCalculationMasterModel::insert($data);
        } else{
        	foreach($data as $value){
        		$tableData = OlCustomCalculationMasterModel::where('name',$value['name'])->first();
        		
        		if ($tableData){

        		}else{
        			$tableValue = new OlCustomCalculationMasterModel();
        			$tableValue->name = $value['name'];
        			$tableValue->save();
        		}
        	}
        }
    }
} 

                