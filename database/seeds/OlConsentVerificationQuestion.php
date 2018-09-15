<?php

use Illuminate\Database\Seeder;
use App\LanguageMaster;
use App\OlConsentVerificationQuestionMaster;

class OlConsentVerificationQuestion extends Seeder
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
                'question' => "७० % सभासदांनी पुनर्विकासास सहमती दर्शविली आहे काय ?"
            ],
            [
                'language_id'   => $languageId,
                'question' => "या सभासदांनी पुनर्विकासास सहमती दर्शविली आहे ते त्या सोसायटीचे अधिकृत मान्यता प्राप्त सदस्य आहेत काय ?"
            ],                 [
                'language_id'   => $languageId,
                'question' => "नसल्यास एकूण मान्यता प्राप्त ७० % सभासदांची पुनर्विकासास सहमती आहे काय ?"
            ],                 [
                'language_id'   => $languageId,
                'question' => "सर्व मान्यता प्राप्त सभासदांनी ओळखपत्र, भागधारक प्रमाणपत्र इत्यादी कागदपत्रे सादर केलेले आहेत काय ?"
            ],                 [
                'language_id'   => $languageId,
                'question' => "संस्थेने वास्तुशास्त्रज्ञ नेमणूकीबाबत ठराव केला आहे काय ?"
            ],                 [
                'language_id'   => $languageId,
                'question' => "संस्थेने विकासक नेमणूकीबाबत ठराव केला आहे काय ?"
            ]             
        ];
        OlConsentVerificationQuestionMaster::insert($questionArr);             
    }
}
