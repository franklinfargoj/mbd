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
        $data = OlConsentVerificationQuestionMaster::all();
        $languageId = LanguageMaster::where(['language'=>'marathi'])
        							 ->value('id');

		$questionArr = [
            [
                'language_id'   => $languageId,
                'question' => "५१ % सभासदांनी पुनर्विकासास सहमती दर्शविली आहे काय ?",
                'expected_answer'   => 1
            ],
            [
                'language_id'   => $languageId,
                'question' => "या सभासदांनी पुनर्विकासास सहमती दर्शविली आहे ते त्या सोसायटीचे अधिकृत मान्यता प्राप्त सदस्य आहेत काय ?",
                'expected_answer'   => 1,
            ],                 [
                'language_id'   => $languageId,
                'question' => "नसल्यास एकूण मान्यता प्राप्त ५१ % सभासदांची पुनर्विकासास सहमती आहे काय ?",
                'expected_answer'   => 0,
            ],                 [
                'language_id'   => $languageId,
                'question' => "सर्व मान्यता प्राप्त सभासदांनी ओळखपत्र, भागधारक प्रमाणपत्र इत्यादी कागदपत्रे सादर केलेले आहेत काय ?",
                'expected_answer'   => 1,
            ],                 [
                'language_id'   => $languageId,
                'question' => "संस्थेने वास्तुशास्त्रज्ञ नेमणूकीबाबत ठराव केला आहे काय ?",
                'expected_answer'   => 1,
            ],                 [
                'language_id'   => $languageId,
                'question' => "संस्थेने विकासक नेमणूकीबाबत ठराव केला आहे काय ?",
                'expected_answer'   => 1,
            ]             
        ];
        if (count($data) == 0){
            OlConsentVerificationQuestionMaster::insert($questionArr);   
        }else{
            
            foreach($data as $question){
                if ($question->id != 3){
                    OlConsentVerificationQuestionMaster::where('id',$question->id)
                    ->update(['expected_answer' => 1]);
                }
            }                      
        }
    }
}
