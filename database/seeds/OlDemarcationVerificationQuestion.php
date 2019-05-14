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
        $parentId = '';
        $count = OlDemarcationVerificationQuestionMaster::where('parent',NULL)->count();

        $languageId = LanguageMaster::where(['language'=>'marathi'])
                                         ->value('id');        
		$questionArr = [                 
            [
                'language_id'   => $languageId,
                'question' => "संस्थेच्या ताब्यातील भूखंड अतिक्रमणाने बाधित आहे काय ?",
                'is_compulsory' => 0,
                'has_many' => 0,
                'is_number' => 0,
                'group' => 3,
                'sort_by' =>NULL,
                'hide' => 0,
                'class' => 'dem_3',
                'is_option' => 1,
                'is_deleted' => 0,
                'is_select' => 0,
                'is_table' => 0
            ],
            [
                'language_id'   => $languageId,
                'question' => "असल्यास अतिक्रमणाने बाधित जागेवरील बांधकामाचा तपशिल तसेच वापर याबाबत शेरा द्यावा.",
                'is_compulsory' => 0,
                'has_many' => 0,
                'is_number' => 0,
                'group' => 3,
                'sort_by' => 1,
                'hide' => 1,
                'class' => 'dem_3_hide',
                'is_option' => 0,
                'is_deleted' => 0,
                'is_select' => 0,
                'is_table' => 0
            ], 
            [
                'language_id'   => $languageId,
                'question' => "सदर भूखंड मंजूर विकास आराखड्यानुसार आरक्षणाने बाधित आहे काय ?",
                'is_compulsory' => 0,
                'has_many' => 0,
                'is_number' => 0,
                'group' => 4,
                'sort_by' => NULL,
                'hide' => 0,
                'class' => 'dem_4',
                'is_option' => 1,
                'is_deleted' => 0,
                'is_select' => 0,
                'is_table' => 0
            ],
            [
                'language_id'   => $languageId,
                'question' => "असल्यास आरक्षणाचे स्वरूप नमुद करावेत.",
                'is_compulsory' => 0,
                'has_many' => 0,
                'is_number' => 0,
                'group' => 4,
                'sort_by' => 1,
                'hide' => 1,
                'class' => 'dem_4_hide',
                'is_option' => 0,
                'is_deleted' => 0,
                'is_select' => 0,
                'is_table' => 0
            ],
            [
                'language_id'   => $languageId,
                'question' => "सदर भूखंड CRZ ने बाधित आहे काय ?",
                'is_compulsory' => 0,
                'has_many' => 0,
                'is_number' => 0,
                'group' => 5,
                'sort_by' => NULL,
                'hide' => 0,
                'class' => 'dem_5',
                'is_option' => 1,
                'is_deleted' => 0,
                'is_select' => 0,
                'is_table' => 0
            ],                 
            [           
            'language_id'   => $languageId,
                'question' => "संस्थेच्या अस्तित्वातील इमारतीच्या मजल्यांची संख्या किती आहे ?",
                'is_compulsory' => 1,
                'has_many' => 0,
                'is_number' => 0,
                'group' => 6,
                'sort_by' => NULL,
                'hide' => 0,
                'class' => 'dem_6',
                'is_option' => 0,
                'is_deleted' => 0,
                'is_select' => 1,
                'is_table' => 0 
            ], 
            [           
            'language_id'   => $languageId,
                'question' => "संस्थेमध्ये एकूण निवासी व अनिवासी गाळ्यांची संख्या नमुद करावी",
                'is_compulsory' => 1,
                'has_many' => 0,
                'is_number' => 0,
                'group' => 7,
                'sort_by' => NULL,
                'hide' => 0,
                'class' => 'dem_7',
                'is_option' => 0,
                'is_deleted' => 0,
                'is_select' => 0,
                'is_table' => 1
            ],
            [           
            'language_id'   => $languageId,
                'question' => "सदर इमारतीस संलग्न असलेल्या रोडची रूंदी नमुद करण्यात यावी.",
                'is_compulsory' => 1,
                'has_many' => 0,
                'is_number' => 0,
                'group' => 8,
                'sort_by' => NULL,
                'hide' => 0,
                'class' => 'dem_8',
                'is_option' => 0,
                'is_deleted' => 0,
                'is_select' => 0,
                'is_table' => 0
            ],
            [           
            'language_id'   => $languageId,
                'question' => "North Road Width",
                'is_compulsory' => 1,
                'has_many' => 0,
                'is_number' => 0,
                'group' => 8,
                'sort_by' => 1,
                'hide' => 0,
                'class' => 'dem_8',
                'is_option' => 0,
                'is_deleted' => 0,
                'is_select' => 0,
                'is_table' => 0
            ],
            [           
            'language_id'   => $languageId,
                'question' => "South Road Width",
                'is_compulsory' => 1,
                'has_many' => 0,
                'is_number' => 0,
                'group' => 8,
                'sort_by' => 2,
                'hide' => 0,
                'class' => 'dem_8',
                'is_option' => 0,
                'is_deleted' => 0,
                'is_select' => 0,
                'is_table' => 0
            ],
            [           
            'language_id'   => $languageId,
                'question' => "East Road Width",
                'is_compulsory' => 1,
                'has_many' => 0,
                'is_number' => 0,
                'group' => 8,
                'sort_by' => 3,
                'hide' => 0,
                'class' => 'dem_8',
                'is_option' => 0,
                'is_deleted' => 0,
                'is_select' => 0,
                'is_table' => 0
            ],
            [           
            'language_id'   => $languageId,
                'question' => "West Road Width",
                'is_compulsory' => 1,
                'has_many' => 0,
                'is_number' => 0,
                'group' => 8,
                'sort_by' => 4,
                'hide' => 0,
                'class' => 'dem_8',
                'is_option' => 0,
                'is_deleted' => 0,
                'is_select' => 0,
                'is_table' => 0
            ]             
        ];

        if ($count == 0){

            OlDemarcationVerificationQuestionMaster::insert($questionArr);
        }

        if($count != count($questionArr)){
            DB::table('ol_demarcation_question_master')->truncate();
            OlDemarcationVerificationQuestionMaster::insert($questionArr);
        }
        $parentId = OlDemarcationVerificationQuestionMaster::where('question','एकूण भूखंडाचे क्षेत्रफळ')->value('id');
        $parentData = OlDemarcationVerificationQuestionMaster::where('parent',$parentId)->count();
        
        $subQuestion = [
            [           
            'language_id'   => $languageId,
                'question' => "भाडेपट्टा करारनामा नुसार क्षेत्रफळ.",
                'is_compulsory' => 1,
                'parent' => $parentId,
                'is_number' => 1
            ],
            [           
            'language_id'   => $languageId,
                'question' => "टिट बिट भूखंडाचे क्षेत्रफळ.",
                'is_compulsory' => 1,
                'parent' => $parentId,
                'is_number' => 1
            ],
            [           
            'language_id'   => $languageId,
                'question' => "आर जी भूखंडाचे क्षेत्रफळ.",
                'is_compulsory' => 1,
                'parent' => $parentId,
                'is_number' => 1
            ],
            [           
            'language_id'   => $languageId,
                'question' => "पि जि भूखंडाचे क्षेत्रफळ.",
                'is_compulsory' => 1,
                'parent' => $parentId,
                'is_number' => 1
            ],
            [           
            'language_id'   => $languageId,
                'question' => "Road setback area.",
                'is_compulsory' => 1,
                'parent' => $parentId,
                'is_number' => 1
            ],
            [           
            'language_id'   => $languageId,
                'question' => "Encroachment area.",
                'is_compulsory' => 1,
                'parent' => $parentId,
                'is_number' => 1
            ],
            [           
            'language_id'   => $languageId,
                'question' => "O.B Building Area.",
                'is_compulsory' => 1,
                'parent' => $parentId,
                'is_number' => 1
            ],
            [           
            'language_id'   => $languageId,
                'question' => "इतर क्षेत्रफळ.",
                'is_compulsory' => 1,
                'parent' => $parentId,
                'is_number' => 1
            ]
        ];   

        if ($parentData == 0){
            // OlDemarcationVerificationQuestionMaster::insert($subQuestion);
        }


        //add compulsory remark 
        $compulsoryRemark = array('संस्थेच्या वापरात असलेल्या एकूण भूखंडाचे क्षेत्रफळ किती आहे ?','संस्थेचे भाडेपट्टा करारनामा नुसार भूखंडाचे एकूण क्षेत्रफळ किती आहे ?','नसल्यास सदर जागा फुटकळ भूखंडाच्या  परिभाषेनुसार असल्यास त्याचे क्षेत्रफळ व मोजमापे नमुद करावीत.','सदर फुटकळ भूखंडालगतच्या इतर संस्थांची नावे नमुद करावीत.','संस्थेच्या अस्तित्वातील इमारतीच्या मजल्यांची संख्या किती आहे ?','संस्थेमध्ये एकूण निवासी व अनिवासी गाळ्यांची संख्या नमुद करावी','सदर इमारतीस संलग्न असलेल्या रोडची रूंदी नमुद करण्यात यावी.');

        OlDemarcationVerificationQuestionMaster::whereIn('question',$compulsoryRemark)->update(['is_compulsory' => '1']);
    }
}

            // [
            //     'language_id'   => $languageId,
            //     'question' => "संस्थेच्या वापरात असलेल्या एकूण भूखंडाचे क्षेत्रफळ किती आहे ?",
            //     'is_compulsory' => 1
            // ],                 
            // [
            //     'language_id'   => $languageId,
            //     'question' => "संस्थेचे भाडेपट्टा करारनामा नुसार भूखंडाचे एकूण क्षेत्रफळ किती आहे ?",
            //     'is_compulsory' => 1
            // ],                 
            // [
            //     'language_id'   => $languageId,
            //     'question' => "संस्थेच्या भाडेपट्यानुसार असलेल्या भूखंडाव्यतीरिक्त लगत भूखंड/जागा शिल्लक राहत आहे काय ?",
            //     'is_compulsory' => 0
            // ], 
            // [                
            // 'language_id'   => $languageId,
            //     'question' => "असल्यास अशी जागा स्वतंत्रपणे विकास करता येण्यासारखी आहे काय ?",
            //     'is_compulsory' => 0
            // ], 
            // [               
            // 'language_id'   => $languageId,
            //     'question' => "नसल्यास सदर जागा फुटकळ भूखंडाच्या  परिभाषेनुसार असल्यास त्याचे क्षेत्रफळ व मोजमापे नमुद करावीत.",
            //     'is_compulsory' => 1
            // ],
            // [           
            // 'language_id'   => $languageId,
            //     'question' => "सदर फुटकळ भूखंडालगतच्या इतर संस्थांची नावे नमुद करावीत.",
            //     'is_compulsory' => 1,
            //     'has_many' => 0,
            //     'is_number' => 0
            // ], 
