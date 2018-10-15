<?php

use App\Layout\ArchitectLayoutStatusLog;

function getArchitectApplicationStatus()
{

}

function converNumberToWord($number){
	$numberToWords = new \NumberToWords\NumberToWords();
	$numberTransformer = $numberToWords->getNumberTransformer('en');
	return $numberTransformer->toWords($number);
}


function getLastStatusIdArchitectLayout($layout_id)
{
	return ArchitectLayoutStatusLog::where(['user_id'=>Auth::user()->id,'role_id'=>session()->get('role_id'),'architect_layout_id'=>$layout_id])->orderBy('id', 'desc')->first();
}

?>
