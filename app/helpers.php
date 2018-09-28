<?php

function getArchitectApplicationStatus()
{

}

function converNumberToWord($number){
	$numberToWords = new \NumberToWords\NumberToWords();
	$numberTransformer = $numberToWords->getNumberTransformer('en');
	return $numberTransformer->toWords($number);
}

?>
