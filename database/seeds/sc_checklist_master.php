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
                    'name' 		  => "सह गृह संस्थेचे नाव"
                ],                
                [
                    'language_id' => $language_id,
                    'type_id'     => '1',
                    'name' 		  => "संस्था नोंदणी दिनांक"
                ],                
                [
                    'language_id' => $language_id,
                    'type_id'     => '1',
                    'name' 		  => "चाळ क्र"
                ],                
                [
                    'language_id' => $language_id,
                    'type_id'     => '1',
                    'name' 		  => "वसाहतीचे नाव"
                ],                
                [
                    'language_id' => $language_id,
                    'type_id'     => '1',
                    'name' 		  => "मिळकत व्यवस्थापक यांचे ना डे प्रमाण पत्रं"
                ],                
                [
                    'language_id' => $language_id,
                    'type_id'     => '1',
                    'name' 		  => "सदनिकाधारकांच्या विहित नमुन्यातील यादी"
                ],                
                [
                    'language_id' => $language_id,
                    'type_id'     => '1',
                    'name' 		  => "दिनांक"
                ],                
                [
                    'language_id' => $language_id,
                    'type_id'     => '1',
                    'name' 		  => "योजनेचा उत्पन्न गट"
                ],                
                [
                    'language_id' => $language_id,
                    'type_id'     => '1',
                    'name' 		  => "सदनिकां ची एकूण संख्या"
                ],                
                [
                    'language_id' => $language_id,
                    'type_id'     => '1',
                    'name' 		  => "प्रथम सदनिका वितरणाची दिनांक"
                ],                
                [
                    'language_id' => $language_id,
                    'type_id'     => '1',
                    'name' 		  => "वितरण वैयक्तिक आहे का"
                ],                
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "सदनिका वितरणाची पद्धत"
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "HPS असल्यास हफ्त्यांचा कालावधी"
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "HPS असल्यास पूर्ण झाल्याची दिनांक"
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "अंतिम विक्री किंमत"
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "बांधकाम किंमत"
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "जमिनीचे अधिमूल्य"
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "संपूर्ण विक्री किंमत भरणा केली आहे काय"
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "जमिनीचे अधिमूल्य भरले आहे काय"
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "संस्थेने भरायायचा भुभाडे चा वार्षिक दर"
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "संस्थेने भुभाडे कोणत्या तारिखे पर्यंत भरलेले आहे"
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "सेवा शुल्क भरणा केल्याची दिनांक"
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "संस्थेने भरावयाचा सेवा शुल्काचा दर"
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "कार्य अभि यांच्या नकाशा नुसार"
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "संस्थेचे एकूण क्षेत्रफळ"
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "नकाशामध्ये चतुर्सिमा, सर्व्हे नं सी ती एस नं इ तपशील दिला आहे का"
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "संस्थेस सेवा हस्तांतरीत केले आहेत काय"
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "पंप हाऊस भूमिगत टाकी"
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "मालमत्ता कर"
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "पाणी कर"
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "इमारत चाळीच्या बांधकामाची पूर्णत्वाची तारीख"
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "सह गृह संस्थेने विक्री कारनामा व भाडे पट्टा कारनाम्याचे मसुदे मान्य केलेल्या सर्वसाधारण सभेच्या ठरावाचा दिनांक"
				],				
				[
					'language_id' => $language_id,
					'type_id'     => '1',
					'name' 		  => "पदाधिकाऱ्यांची नावे"
				],
            ];    
			ScChecklistMaster::insert($checklist);
		}
    } 
}
