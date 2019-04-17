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
        OcSrutinyQuestionMaster::truncate();
        $count = OcSrutinyQuestionMaster::select('id')->count();
        if ($count == 0){

    		$questionArr = [
                [
                    'language_id'   => 1,
                    'question' => "As per condition of the NOC the applicant needs to construct proposed building on  plot lease to the applicant.  Kindly submit your report along with plan showing plot area as per lease & now in possession with position of existing & proposed bldg. With referance to the open spaces and the area of plot",
                    'remarks_applicable' => 1,
                    'is_compulsory' => 1,
                    'group' => 1,
                    'sort_by' => NULL,
                    'is_upload' => 1
                ],
                [
                    'language_id'   => 1,
                    'question' => "You are also requested to inform whether the society has constructed compound wall as per the plot lease to them showing the dimension of periphery of compound wall and the area of plot in applicant possession",
                    'remarks_applicable' => 1,
                    'is_compulsory' => 1,
                    'group' => 2,
                    'sort_by' => NULL,
                    'is_upload' => 1
                ],                 
                [
                    'language_id'   => 1,
                    'question' => "You are also requested to inform whether  the applicant has constructed building with in the land leased to them or not.",
                    'remarks_applicable' => 1,
                    'is_compulsory' => 1,
                    'group' => 3,
                    'sort_by' => 1,
                    'is_upload' => 0
                ],
                [
                    'language_id'   => 1,
                    'question' => "You are also requested to inform whether the applicant has carried out any additional work beyond the work for which the NOC was issued.",
                    'remarks_applicable' => 1,
                    'is_compulsory' => 1,
                    'group' => 3,
                    'sort_by' => 2,
                    'is_upload' => 0
                ],
                // [
                //     'language_id'   => 1,
                //     'question' => "You are also requested to inform whether  the applicant has constructed building with in the land leased to them or not. you are also requested to inform whether the applicant has carried out any additional work beyond the work for which the NOC was issued.",
                //     'remarks_applicable' => 1,
                //     'is_upload' => 0
                // ],                 
                [
                    'language_id'   => 1,
                    'question' => "You are also requested to infrom whether the applicant has relacated R G as per VP/A's approval, whether license to enter upon the leased is complied with whether the rectification to lease deed & compiled with",
                    'remarks_applicable' => 1,
                    'is_compulsory' => 1,
                    'group' => 4,
                    'sort_by' => NULL,
                    'is_upload' => 0
                ],                 
                [
                    'language_id'   => 1,
                    'question' => "whether the applicant has constructed building for residential & non residential purpose as the NOC was issued.",
                    'remarks_applicable' => 1,
                    'is_compulsory' => 1,
                    'group' => 5,
                    'sort_by' => NULL,
                    'is_upload' => 0
                ], 
                [
                    'language_id'   => 1,
                    'question' => "whether the society has constructed seperate under ground & overhead water storage tank to meet the requirement of existing + proposed development  work as per MCGM / EE, BP Cell, Greater Mumbai/MHADA sanction",
                    'remarks_applicable' => 1,
                    'is_compulsory' => 1,
                    'group' => 6,
                    'sort_by' => NULL,
                    'is_upload' => 0
                ],
                [
                    'language_id'   => 1,
                    'question' => "whether the applicant has taken seperate water connection with a seperate water meter directly from MCGM or whether the applicant is using MH & AD board's water for construction purpose",
                    'remarks_applicable' => 1,
                    'is_compulsory' => 1,
                    'group' => 7,
                    'sort_by' => NULL,
                    'is_upload' => 0
                ],
                // [
                //     'language_id'   => 1,
                //     'question' => "whether the applicant has connected the sewerage to the municipal sewer with prior permission  or whether the applicant has constructed septic tank to meet the requirement of the applicant",
                //     'remarks_applicable' => 1,
                //     'is_upload' => 0
                // ],
                [
                    'language_id'   => 1,
                    'question' => "whether the entire premium as intimateed are paid by the applicant. the lease rent is received and whether any other dues are pending whether NA assessment charges are paid, whether the applicant has compiled the supplymentary lease deed for additional land",
                    'remarks_applicable' => 1,
                    'is_compulsory' => 1,
                    'group' => 8,
                    'sort_by' => NULL,
                    'is_upload' => 0
                ],
                [
                    'language_id'   => 1,
                    'question' => "You are requested to recover the water charges as intimated by CE-II/A and intimate this office regarding receipt of payment so as to enable this office to process the consent of OC case with referance to this letter",
                    'remarks_applicable' => 1,
                    'is_compulsory' => 1,
                    'group' => 9,
                    'sort_by' => NULL,
                    'is_upload' => 0
                ],
                [
                    'language_id'   => 1,
                    'question' => "Whether the applicant has complied all the terms & conditions mentioned in the NOC & Offer letters issued to him & the constructed bldg. is as per the approved plan. The report of it may please be submitted stating therein that all the terms & conditions of Offer Letter & NOC Letter have been complied by the society",
                    'remarks_applicable' => 1,
                    'is_compulsory' => 1,
                    'group' => 10,
                    'sort_by' => NULL,
                    'is_upload' => 0
                ],
                [
                    'language_id'  => 1,
                    'question' => "Details of rehab component",
                    'group' => 11,
                    'remarks_applicable' => 1,
                    'is_compulsory' => 1,
                    'sort_by' => 1,
                    'is_upload' => 0
                ],
                [
                    'language_id'   => 1,
                    'question' => "Details of sale component",
                    'group' => 11,
                    'remarks_applicable' => 1,
                    'is_compulsory' => 1,
                    'sort_by' => 2,
                    'is_upload' => 0
                ],
                [
                    'language_id'   => 1,
                    'question' => "Details of comestial component, if any",
                    'group' => 11,
                    'remarks_applicable' => 1,
                    'is_compulsory' => 0,
                    'sort_by' => 3,
                    'is_upload' => 0
                ],
                [
                    'language_id'   => 1,
                    'question' => "Details of MHADA share",
                    'group' => 11,
                    'remarks_applicable' => 1,
                    'is_compulsory' => 0,
                    'sort_by' => 4,
                    'is_upload' => 0
                ],
                // [
                //     'language_id'   => 1,
                //     'question' => "As per condition of the NOC the applicant needs to construct proposed building on  plot lease to the applicant.  Kindly submit your report along with plan showing plot area as per lease & now in possession with position of existing & proposed bldg. With referance to the open spaces and the area of plot",
                //     'remarks_applicable' => 1,
                //     'is_upload' => 0
                // ],
                [
                    'language_id'   => 1,
                    'question' => "Whether applicant has submitted list installation NOC ?",
                    'remarks_applicable' => 1,
                    'is_compulsory' => 1,
                    'group' => 12,
                    'sort_by' => NULL,
                    'is_upload' => 1
                ]
            ];
            OcSrutinyQuestionMaster::insert($questionArr);   
        }          
    }
}
