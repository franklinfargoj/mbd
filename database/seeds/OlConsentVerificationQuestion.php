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
        OlConsentVerificationQuestionMaster::truncate();
        $data = OlConsentVerificationQuestionMaster::all();
        $languageId = LanguageMaster::where(['language'=>'marathi'])
        							 ->value('id');

		$questionArr = [
            [
                'language_id'   => $languageId,
                'question' => "५१ % सभासदांनी पुनर्विकासास सहमती दर्शविली आहे काय ?",
                'expected_answer'   => 1,
                'is_option'   => 1,
                'group' => 1,
                'sort_by' => NULL,
                'hide' => 0,
                'class' => 'con_1'
            ],
            [
                'language_id'   => $languageId,
                'question' => "एकूण सभासदांची संख्या",
                'expected_answer'   => 1,
                'is_option'   => 0,
                'group' => 2,
                'sort_by' => 1,
                'hide' => 0,
                'class' => 'con_2'
            ],
            [
                'language_id'   => $languageId,
                'question' => "मान्यता प्राप्त सभासदांची संख्या",
                'expected_answer'   => 1,
                'is_option'   => 0,
                'group' => 2,
                'sort_by' => 2,
                'hide' => 0,
                'class' => 'con_2'
            ],
            [
                'language_id'   => $languageId,
                'question' => "या सभासदांनी पुनर्विकासास सहमती दर्शविली आहे ते त्या सोसायटीचे अधिकृत मान्यता प्राप्त सदस्य आहेत काय ?",
                'expected_answer'   => 1,
                'is_option'   => 1,
                'group' => 3,
                'sort_by' => NULL,
                'hide' => 0,
                'class' => 'con_3'
            ],                 
            [
                'language_id'   => $languageId,
                'question' => "एकूण मान्यता प्राप्त ५१ % सभासदांची पुनर्विकासास सहमती आहे काय ?",
                'expected_answer'   => 1,
                'is_option'   => 1,
                'group' => 3,
                'sort_by' => 1,
                'hide' => 1,
                'class' => 'con_3_hide'
            ],                 
            [
                'language_id'   => $languageId,
                'question' => "सर्व मान्यता प्राप्त सभासदांनी ओळखपत्र, भागधारक प्रमाणपत्र इत्यादी कागदपत्रे सादर केलेले आहेत काय ?",
                'expected_answer'   => 1,
                'is_option'   => 1,
                'group' => 4,
                'sort_by' => NULL,
                'hide' => 0,
                'class' => 'con_5'
            ],                 
            [
                'language_id'   => $languageId,
                'question' => "संस्थेने वास्तुशास्त्रज्ञ नेमणूकीबाबत ठराव केला आहे काय ?",
                'expected_answer'   => 1,
                'is_option'   => 1,
                'group' => 5,
                'sort_by' => NULL,
                'hide' => 0,
                'class' => 'con_6'
            ],                 
            [
                'language_id'   => $languageId,
                'question' => "संस्थेने विकासक नेमणूकीबाबत ठराव केला आहे काय ?",
                'expected_answer'   => 1,
                'is_option'   => 1,
                'group' => 6,
                'sort_by' => NULL,
                'hide' => 0,
                'class' => 'con_7'
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
