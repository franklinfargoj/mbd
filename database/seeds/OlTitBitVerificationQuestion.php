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
        $count = OlTitBitVerificationQuestionMaster::select('id')->count();
		$languageId = LanguageMaster::where(['language'=>'marathi'])
        							 ->value('id');
		$questionArr = [
            // [
            //     'language_id'   => $languageId,
            //     'question' => "संस्थेच्या वापरात असलेल्या एकूण भूखंडाचे क्षेत्रफळ किती आहे ?"
            // ],
            // [
            //     'language_id'   => $languageId,
            //     'question' => "संस्थेचे भाडेपट्टा करारनामा नुसार भूखंडाचे एकूण क्षेत्रफळ किती आहे ?"
            // ],                 
            [
                'language_id'   => $languageId,
                'question' => "सिमांकन नकाशानुसार फुटकळ भूखंड असल्यास ठराव क्र। ५९९८ मधील मुद्दा क्र। १० मध्ये नमुद केलेल्या कुठल्या प्रकारामध्ये सदर  भूखंड मोडतो.",
                'is_compulsory' => 1
            ],                 
            [
                'language_id'   => $languageId,
                'question' => "फुटकळ भूखंडाचे एकूण क्षेत्रफळ किती ?",
                'is_compulsory' => 1
            ],
            // [
            //     'language_id'   => $languageId,
            //     'question' => "संस्थेचे भाडेपट्टा करारनामा नुसार भूखंडाचे एकूण क्षेत्रफळ किती आहे ?",
            //     'is_compulsory' => 1
            // ],                 
            [
                'language_id'   => $languageId,
                'question' => "संस्थेच्या भाडेपट्यानुसार असलेल्या भूखंडाव्यतीरिक्त लगत भूखंड/जागा शिल्लक राहत आहे काय ?",
                'is_compulsory' => 0
            ], 
            [                
            'language_id'   => $languageId,
                'question' => "असल्यास अशी जागा स्वतंत्रपणे विकास करता येण्यासारखी आहे काय ?",
                'is_compulsory' => 0
            ], 
            [               
            'language_id'   => $languageId,
                'question' => "नसल्यास सदर जागा फुटकळ भूखंडाच्या  परिभाषेनुसार असल्यास त्याचे क्षेत्रफळ व मोजमापे नमुद करावीत.",
                'is_compulsory' => 1
            ],
             [           
            'language_id'   => $languageId,
                'question' => "सदर फुटकळ भूखंडालगतच्या इतर संस्थांची नावे नमुद करावीत.",
                'is_compulsory' => 1,
            ],                                 
            [
                'language_id'   => $languageId,
                'question' => "सदर फुटकळ भूखंडा पैकी काही भागालगत इतर संस्थांची सिमा असल्यास त्यानुसार समान विभागणी करून त्यानुसार सिमांकन नकाशात नमुद केले आहेत काय ?",
                'is_compulsory' => 0
            ],                 
            // [
            //     'language_id'   => $languageId,
            //     'question' => "सिमांकन नकाशा, अभिन्यास व  भाडेपट्टा करारनाम्यानुसार संस्थेच्या एकूण क्षेत्रफळात तफावत असल्यास त्याचा तपशिल नमुद करावा."
            // ], 
            [               
            'language_id'   => $languageId,
                'question' => "संस्थेलगत म्हाडाचा मोकळा भूखंड असल्यास  त्यासोबत फुटकळ भूखंडाचे एकत्रिकरण करणे शक्य आहे काय ?",
                'is_compulsory' => 0
            ], 
            [               
            'language_id'   => $languageId,
                'question' => "फुटकळ भूखंड क्षेत्रफळाचे एकूण भूखंड क्षेत्रफळाच्या प्रमाणात टक्केवारी किती आहे ?",
                'is_compulsory' => 1
            ]             
        ];
        if ($count == 0){
            OlTitBitVerificationQuestionMaster::insert($questionArr);
        }
        
        if($count != count($questionArr)){
            DB::table('ol_tit_bit_question_master')->truncate();
            OlTitBitVerificationQuestionMaster::insert($questionArr);
        }

        //add compulsory remark 
        $compulsoryRemark = array('संस्थेच्या वापरात असलेल्या एकूण भूखंडाचे क्षेत्रफळ किती आहे ?','संस्थेचे भाडेपट्टा करारनामा नुसार भूखंडाचे एकूण क्षेत्रफळ किती आहे ?','सिमांकन नकाशानुसार फुटकळ भूखंड असल्यास ठराव क्र। ५९९८ मधील मुद्दा क्र। १० मध्ये नमुद केलेल्या कुठल्या प्रकारामध्ये सदर  भूखंड मोडतो.','फुटकळ भूखंडाचे एकूण क्षेत्रफळ किती ?','सिमांकन नकाशा, अभिन्यास व  भाडेपट्टा करारनाम्यानुसार संस्थेच्या एकूण क्षेत्रफळात तफावत असल्यास त्याचा तपशिल नमुद करावा.','फुटकळ भूखंड क्षेत्रफळाचे एकूण भूखंड क्षेत्रफळाच्या प्रमाणात टक्केवारी किती आहे ?');

        OlTitBitVerificationQuestionMaster::whereIn('question',$compulsoryRemark)->update(['is_compulsory' => '1']);        
    }
}
