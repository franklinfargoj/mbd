<?php

use Illuminate\Database\Seeder;
use App\LanguageMaster;
use App\OlNoDueCertificateQuestionMaster;

class OlNoDueCertificateQuestion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('ol_no_due_certificate_question_master')->truncate();
    	$languageId = LanguageMaster::where(['language'=>'English'])->value('id');
        $questionArr = [
                [
                    'language_id'   => $languageId,
                    'question' => "Is No Due Ceritificate provided by society ?",
                    'is_option' => 1,
                    'is_compulsory' => 1,
                    'hide' => 0,
                    'class' => 'deu_1'
                ],
                [
                    'language_id'   => $languageId,
                    'question' => "Upload undertaking for submission of No Due Ceritificate",
                    'is_option' => 0,
                    'is_compulsory' => 0,
                    'hide' => 1,
                    'class' => 'deu_1_hide'
                ],                 
            ];
            OlNoDueCertificateQuestionMaster::insert($questionArr);
    }
}
