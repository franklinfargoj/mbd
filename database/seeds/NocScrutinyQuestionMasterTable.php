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
                    'question' => "Receipts of payment according to offer letter",
                    'remarks_applicable' => 1,
                ],
                [
                    'language_id'   => 1,
                    'question' => "Offer letter conditions are fulfilled or not",
                    'remarks_applicable' => 1,
                ],                 [
                    'language_id'   => 1,
                    'question' => "No dues certificate provided?",
                    'remarks_applicable' => 1,
                ],                 [
                    'language_id'   => 1,
                    'question' => "Is Undertaking /Indemnity bond provided?",
                    'remarks_applicable' => 1,
                ],                 [
                    'language_id'   => 1,
                    'question' => "Society resolution",
                    'remarks_applicable' => 1
                ]
            ];
            NocSrutinyQuestionMaster::insert($questionArr);   
        }          
    }
}
