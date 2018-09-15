<?php

use Illuminate\Database\Seeder;
use App\LanguageMaster;
use App\OlRgRelocationVerificationQuestionMaster;

class OlRgRelocationVerificationQuestion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $languageId = LanguageMaster::where(['language'=>'marathi'])
        							 ->value('id');
		$questionArr = [
            [
                'language_id'   => $languageId,
                'question' => "सिमांकन नकाशानुसार संस्थेच्या भूखंडाचे एकूण क्षेत्रफळ किती आहे ?"
            ],
            [
                'language_id'   => $languageId,
                'question' => "अभिन्यासानुसार सदर करमणूकीचे मैदान Sंheme R।G। आहे कि D।P। R।G। आहे याबाबत नमुद करावे."
            ],                 [
                'language_id'   => $languageId,
                'question' => "करमणूकीच्या मैदानाच्या प्रस्तावित स्थलांतरणाबाबत लगतच्या संस्थांची संमती घेतलेली आहे काय ?"
            ],                 [
                'language_id'   => $languageId,
                'question' => "प्रस्तावित स्थलांतरणामुळे सदर करमणूकीचे मैदान अभिन्यासातील सर्व गाळेधारकांकरीता खुले राहील याची खातरजमा केली आहे काय ?"
            ],                 [
                'language_id'   => $languageId,
                'question' => "एकूण करमणूकीच्या मैदानाच्या क्षेत्रफळापैकी सर्वच भूखंडाचे /भागशः भूखंडाचे स्थलांतरण प्रस्तावित  आहे किंवा कसे याबाबत नमुद करावे."
            ]             
        ];
        OlRgRelocationVerificationQuestionMaster::insert($questionArr);
    }
}
