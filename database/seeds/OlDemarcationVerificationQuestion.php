<?php

use Illuminate\Database\Seeder;
use App\LanguageMaster;
use App\OlDemarcationVerificationQuestionMaster;

class OlDemarcationVerificationQuestion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = OlDemarcationVerificationQuestionMaster::select('id')->count();
        if ($count == 0){
            $languageId = LanguageMaster::where(['language'=>'marathi'])
            							 ->value('id');

    		$questionArr = [
                [
                    'language_id'   => $languageId,
                    'question' => "संस्थेच्या ताब्यातील भूखंड अतिक्रमणाने बाधित आहे काय ?"
                ],
                [
                    'language_id'   => $languageId,
                    'question' => "सदर भूखंड मंजूर विकास आराखड्यानुसार आरक्षणाने बाधित आहे काय ? असल्यास आरक्षणाचे स्वरूप नमुद करावेत."
                ],                 
                [
                    'language_id'   => $languageId,
                    'question' => "असल्यास अतिक्रमणाने बाधित क्षेत्रफळ किती आहे ? तसचे बाधित जागेवरील बांधकामाचा तपशिल तसेच वापर याबाबत शेरा द्यावा."
                ],                 
                [
                    'language_id'   => $languageId,
                    'question' => "संस्थेच्या वापरात असलेल्या एकूण भूखंडाचे क्षेत्रफळ किती आहे ?"
                ],                 
                [
                    'language_id'   => $languageId,
                    'question' => "संस्थेचे भाडेपट्टा करारनामा नुसार भूखंडाचे एकूण क्षेत्रफळ किती आहे ?"
                ],                 
                [
                    'language_id'   => $languageId,
                    'question' => "संस्थेच्या भाडेपट्यानुसार असलेल्या भूखंडाव्यतीरिक्त लगत भूखंड/जागा शिल्लक राहत आहे काय ?"
                ], 
                [                
                'language_id'   => $languageId,
                    'question' => "असल्यास अशी जागा स्वतंत्रपणे विकास करता येण्यासारखी आहे काय ?"
                ], 
                [               
                'language_id'   => $languageId,
                    'question' => "नसल्यास सदर जागा फुटकळ भूखंडाच्या  परिभाषेनुसार असल्यास त्याचे क्षेत्रफळ व मोजमापे नमुद करावीत."
                ],
                [           
                'language_id'   => $languageId,
                    'question' => "सदर फुटकळ भूखंडालगतच्या इतर संस्थांची नावे नमुद करावीत."
                ], 
                [           
                'language_id'   => $languageId,
                    'question' => "संस्थेच्या अस्तित्वातील इमारतीच्या मजल्यांची संख्या किती आहे ?"
                ], 
                [           
                'language_id'   => $languageId,
                    'question' => "संस्थेमध्ये एकूण निवासी व अनिवासी गाळ्यांची संख्या नमुद करावी"
                ],
                [           
                'language_id'   => $languageId,
                    'question' => "सदर इमारतीस संलग्न असलेल्या रोडची रूंदी नमुद करण्यात यावी."
                ]             
            ];
            OlDemarcationVerificationQuestionMaster::insert($questionArr);
        }
    }
}
