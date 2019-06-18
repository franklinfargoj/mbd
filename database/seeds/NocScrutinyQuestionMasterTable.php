<?php

use Illuminate\Database\Seeder;
use App\LanguageMaster;
use App\NocSrutinyQuestionMaster;

class NocScrutinyQuestionMasterTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        NocSrutinyQuestionMaster::truncate();
        $count = NocSrutinyQuestionMaster::select('id')->count();
        if ($count == 0){

    		$questionArr = [
                [
                    'language_id'   => 1,
                    'question' => "Receipts of premium amount and offsite infrastructure charges paid to Mumbai board ?",
                    'remarks_applicable' => 1,
                ], 
                // [
                //     'language_id'   => 1,
                //     'question' => "Receipts of payment according to offer letter",
                //     'remarks_applicable' => 1,
                // ],

                // newly added
                [
                    'language_id'   => 1,
                    'question' => "Receipts of offsite infrastructure charges paid to planning Authority, MHADA",
                    'remarks_applicable' => 1,
                ],
                [
                    'language_id'   => 1,
                    'question' => "Offer letter conditions are fulfilled or not ?",
                    'remarks_applicable' => 1,
                ],                 
                [
                    'language_id'   => 1,
                    'question' => "No dues certificate provided ?",
                    'remarks_applicable' => 1,
                ],                 
                [
                    'language_id'   => 1,
                    'question' => "Is Undertaking /Indemnity bond provided ?",
                    'remarks_applicable' => 1,
                ],                 
                [
                    'language_id'   => 1,
                    'question' => "Society resolution provided ?",
                    'remarks_applicable' => 1
                ],
                [
                    'language_id'   => 1,
                    'question' => "Water charges receipt provided ?",
                    'remarks_applicable' => 1
                ],
                [
                    'language_id'   => 1,
                    'question' => "Undertaking form 5 provided ?",
                    'remarks_applicable' => 1
                ],
                [
                    'language_id'   => 1,
                    'question' => "Undertaking for acceptance of offer letter provided ?",
                    'remarks_applicable' => 1
                ],
                [
                    'language_id'   => 1,
                    'question' => "Undertaking first time duty (form 7) provided ?",
                    'remarks_applicable' => 1
                ],
                [
                    'language_id'   => 1,
                    'question' => "Indemnity bond for legal proceding (form 5) provided ?",
                    'remarks_applicable' => 1
                ],
                [
                    'language_id'   => 1,
                    'question' => "Proposed building plan showing MHADA share on it provided ?",
                    'remarks_applicable' => 1
                ],
            ];
            NocSrutinyQuestionMaster::insert($questionArr);   
        }          
    }
}
