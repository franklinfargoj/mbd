<?php

use Illuminate\Database\Seeder;
use App\LanguageMaster;
use App\OlTitBitVerificationQuestionMaster;

class OlTitBitVerificationQuestion extends Seeder
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
                'question' => "संस्थेच्या वापरात असलेल्या एकूण भूखंडाचे क्षेत्रफळ किती आहे ?"
            ],
            [
                'language_id'   => $languageId,
                'question' => "संस्थेचे भाडेपट्टा करारनामा नुसार भूखंडाचे एकूण क्षेत्रफळ किती आहे ?"
            ],                 
            [
                'language_id'   => $languageId,
                'question' => "सिमांकन नकाशानुसार फुटकळ भूखंड असल्यास ठराव क्र। ५९९८ मधील मुद्दा क्र। १० मध्ये नमुद केलेल्या कुठल्या प्रकारामध्ये सदर  भूखंड मोडतो."
            ],                 
            [
                'language_id'   => $languageId,
                'question' => "फुटकळ भूखंडाचे एकूण क्षेत्रफळ किती ?"
            ],                 
            [
                'language_id'   => $languageId,
                'question' => "सदर फुटकळ भूखंडा पैकी काही भागालगत इतर संस्थांची सिमा असल्यास त्यानुसार समान विभागणी करून त्यानुसार सिमांकन नकाशात नमुद केले आहेत काय ?"
            ],                 
            [
                'language_id'   => $languageId,
                'question' => "सिमांकन नकाशा, अभिन्यास व  भाडेपट्टा करारनाम्यानुसार संस्थेच्या एकूण क्षेत्रफळात तफावत असल्यास त्याचा तपशिल नमुद करावा."
            ], 
            [               
            'language_id'   => $languageId,
                'question' => "संस्थेलगत म्हाडाचा मोकळा भूखंड असल्यास  त्यासोबत फुटकळ भूखंडाचे एकत्रिकरण करणे शक्य आहे काय ?"
            ], 
            [               
            'language_id'   => $languageId,
                'question' => "फुटकळ भूखंड क्षेत्रफळाचे एकूण भूखंड क्षेत्रफळाच्या प्रमाणात टक्केवारी किती आहे ?"
            ]             
        ];
        OlTitBitVerificationQuestionMaster::insert($questionArr);
    }
}
