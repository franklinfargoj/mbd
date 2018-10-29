<?php

use Illuminate\Database\Seeder;
use App\LanguageMaster;
use App\conveyance\ScChecklistMaster;

class sc_checklist_master extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$language_id = LanguageMaster::select('id')->where(['language'=>'marathi'])->value('id');
		$data 	  = ScChecklistMaster::where(['type_id'=>'1'])->get();

		if (count($data) == 0) {
            $checklist= [
                [
                    'language_id' => $language_id,
                    'type_id'     => '1',
                    'name' 		  => "सह गृह संस्थेचे नाव",
                    'is_date'     => '0'
                ],                
                [
                    'language_id' => $language_id,
                    'type_id'     => '1',
                    'name' 		  => "संस्था नोंदणी दिनांक",
                    'is_date'     => '1'
                ],                
                [
                    'language_id' => $language_id,
                    'type_id'     => '1',
                    'name' 		  => "चाळ क्र",
                    'is_date'     => '0'
                ],                
                [
                    'language_id' => $language_id,
                    'type_id'     => '1',
                    'name' 		  => "वसाहतीचे नाव",
                    'is_date'     => '0'
                ],                
                [
                    'language_id' => $language_id,
                    'type_id'     => '1',
                    'name' 		  => "मिळकत व्यवस्थापक यांचे ना डे प्रमाण पत्रं",
                    'is_date'     => '0'
                ],                
                [
                    'language_id' => $language_id,
                    'type_id'     => '1',
                    'name' 		  => "सदनिकाधारकांच्या विहित नमुन्यातील यादी",
                    'is_date'     => '0'
                ],                
                [
                    'language_id' => $language_id,
                    'type_id'     => '1',
                    'name' 		  => "दिनांक",
                    'is_date'     => '1'
                ],                
                [
                    'language_id' => $language_id,
                    'type_id'     => '1',
                    'name' 		  => "योजनेचा उत्पन्न गट",
                    'is_date'     => '0'
                ],                
                [
                    'language_id' => $language_id,
                    'type_id'     => '1',
                    'name' 		  => "सदनिकां ची एकूण संख्या",
                    'is_date'     => '0'
                ],                
                [
                    'language_id' => $language_id,
                    'type_id'     => '1',
                    'name' 		  => "प्रथम सदनिका वितरणाची दिनांक",
                    'is_date'     => '1'
                ],                
                [
                    'language_id' => $language_id,
                    'type_id'     => '1',
                    'name' 		  => "वितरण वैयक्तिक आहे का",
                    'is_date'     => '0'
                ],                
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "सदनिका वितरणाची पद्धत",
					'is_date'     => '0'
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "HPS असल्यास हफ्त्यांचा कालावधी",
					'is_date'     => '0'
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "HPS असल्यास पूर्ण झाल्याची दिनांक",
					'is_date'     => '1'
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "अंतिम विक्री किंमत",
					'is_date'     => '0'
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "बांधकाम किंमत",
					'is_date'     => '0'
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "जमिनीचे अधिमूल्य",
					'is_date'     => '0'
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "संपूर्ण विक्री किंमत भरणा केली आहे काय",
					'is_date'     => '0'
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "जमिनीचे अधिमूल्य भरले आहे काय",
					'is_date'     => '0'
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "संस्थेने भरायायचा भुभाडे चा वार्षिक दर",
					'is_date'     => '0'
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "संस्थेने भुभाडे कोणत्या तारिखे पर्यंत भरलेले आहे",
					'is_date'     => '1'
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "सेवा शुल्क भरणा केल्याची दिनांक",
					'is_date'     => '1'
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "संस्थेने भरावयाचा सेवा शुल्काचा दर",
					'is_date'     => '0'
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "कार्य अभि यांच्या नकाशा नुसार",
					'is_date'     => '0'
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "संस्थेचे एकूण क्षेत्रफळ",
					'is_date'     => '0'
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "नकाशामध्ये चतुर्सिमा, सर्व्हे नं सी ती एस नं इ तपशील दिला आहे का",
					'is_date'     => '0'
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "संस्थेस सेवा हस्तांतरीत केले आहेत काय",
					'is_date'     => '0'
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "पंप हाऊस भूमिगत टाकी",
					'is_date'     => '0'
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "मालमत्ता कर",
					'is_date'     => '0'
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "पाणी कर",
					'is_date'     => '0'
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "इमारत चाळीच्या बांधकामाची पूर्णत्वाची तारीख",
					'is_date'     => '1'
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "सह गृह संस्थेने विक्री कारनामा व भाडे पट्टा कारनाम्याचे मसुदे मान्य केलेल्या सर्वसाधारण सभेच्या ठरावाचा दिनांक",
					'is_date'     => '1'
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "पदाधिकाऱ्यांची नावे",
					'is_date'     => '0'
				],
            ];    
			ScChecklistMaster::insert($checklist);
		}
    } 
}
