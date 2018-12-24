<?php

use Illuminate\Database\Seeder;
use App\LanguageMaster;
use App\OcSrutinyQuestionMaster;

class OcScrutinyQuestionMasterTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = OcSrutinyQuestionMaster::select('id')->count();
        if ($count == 0){

    		$questionArr = [
                [
                    'language_id'   => 1,
                    'question' => "As per condition of the NOC the applicant needs to construct proposed building on  plot lease to the applicant.  Kindly submit your report along with plan showing plot area as per lease & now in possession with position of existing & proposed bldg. With referance to the open spaces and the area of plot",
                    'remarks_applicable' => 1,
                ],
                [
                    'language_id'   => 1,
                    'question' => "As per condition of the NOC the applicant needs to construct proposed building on  plot lease to the applicant.  Kindly submit your report along with plan showing plot area as per lease & now in possession with position of existing & proposed bldg. With referance to the open spaces and the area of plot",
                    'remarks_applicable' => 1,
                ],                 [
                    'language_id'   => 1,
                    'question' => "You are also requested to inform whether  the applicant has constructed building with in the land leased to them or not. you are also requested to inform whether the applicant has carried out any additional work beyond the work for which the NOC was issued.",
                    'remarks_applicable' => 1,
                ],                 [
                    'language_id'   => 1,
                    'question' => "You are also requested to infrom whether the applicant has relacated R G as per VP/A's approval, whether license to enter upon the leased is complied with whether the rectification to lease deed & compiled with",
                    'remarks_applicable' => 1,
                ],                 [
                    'language_id'   => 1,
                    'question' => "whether the applicant has constructed building for residential & non residential purpose as the NOC was issued.",
                    'remarks_applicable' => 1
                ], 
                [
                    'language_id'   => 1,
                    'question' => "whether the society has constructed seperate under ground & overhead water storage tank to meet the requirement of existing + proposed development  work as per MCGM sanction",
                    'remarks_applicable' => 1
                ],
                [
                    'language_id'   => 1,
                    'question' => "whether the applicant has taken seperate water connection with a seperate water meter directly from MCGM or whether the applicant is using MH & AD board's water, whether the applicant has used board's water for construction purpose",
                    'remarks_applicable' => 1
                ],
                [
                    'language_id'   => 1,
                    'question' => "whether the applicant has connected the sewerage to the municipal sewer with prior permission  or whether the applicant has constructed septic tank to meet the requirement of the applicant",
                    'remarks_applicable' => 1
                ],
                [
                    'language_id'   => 1,
                    'question' => "whether the entire premium as intimateed are paid by the applicant. the lease rent is received and whether any other dues are pending whether NA assessment charges are paid, whether the applicant has compiled the supplymentary lease deed for additional land",
                    'remarks_applicable' => 1
                ],
                [
                    'language_id'   => 1,
                    'question' => "You are requested to recover the water charges as intimated by CE-II/A and intimate this office regarding receipt of payment so as to enable this office to process the consent of OC case with referance to this letter",
                    'remarks_applicable' => 1
                ],
                [
                    'language_id'   => 1,
                    'question' => "You are also required to issue your no objection as regards to the proposed development so as to enable this office to process finally consent letter for grant of part/full occupation certification for the proposed work",
                    'remarks_applicable' => 1
                ],
                [
                    'language_id'   => 1,
                    'question' => "As per condition of the NOC the applicant needs to construct proposed building on  plot lease to the applicant.  Kindly submit your report along with plan showing plot area as per lease & now in possession with position of existing & proposed bldg. With referance to the open spaces and the area of plot",
                    'remarks_applicable' => 1
                ],
                [
                    'language_id'   => 1,
                    'question' => "As per condition of the NOC the applicant needs to construct proposed building on  plot lease to the applicant.  Kindly submit your report along with plan showing plot area as per lease & now in possession with position of existing & proposed bldg. With referance to the open spaces and the area of plot",
                    'remarks_applicable' => 1
                ]
            ];
            OcSrutinyQuestionMaster::insert($questionArr);   
        }          
    }
}
