<?php

use Illuminate\Database\Seeder;
use App\OlSocietyDocumentsMaster;
use App\OlApplicationMaster;
use App\LanguageMaster;

class OlSocietyDocumentsMasterTableSeeder extends Seeder
{
    /**9
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OlSocietyDocumentsMaster::truncate(); // To prevent duplicate entries,truncate master table & add all entries again.

        $selfPremium = OlApplicationMaster::where(['title'=>'New - Offer Letter','model'=>'Premium', 'parent_id' => '1'])->value('id');
        $Englang = LanguageMaster::where(['language'=>'English'])->value('id');
        $Marathi = LanguageMaster::where(['language'=>'marathi'])->value('id');
        
        $data = OlSocietyDocumentsMaster::where(['application_id'=>'2'])->get();
        if(count($data) == 0){
            $dcrRateArr= [
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Marathi,
                    'name' => "संस्थेचा अर्ज",
                    'is_deleted' => 1
                ],
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Marathi,
                    'name' => "सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा ठराव",
                    'group' => 1,
                    'sort_by' => 1
                ],
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Marathi,
                    'name' => "सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची साक्षांकित प्रत",
                    'group' => 1,
                    'sort_by' => 2
                ],
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Marathi,
                    'name' => "संस्थेच्या सर्वसाधारण सभेच्या ठरावात विकासकाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत",
                    'group' => 1,
                    'sort_by' => 3
                ],
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Marathi,
                    'name' => "सर्वसाधारण सभेच्या ठरावात वास्तुशास्त्रज्ञाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत",
                    'group' => 1,
                    'sort_by' => 4
                ],
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Marathi,
                    'name' => "वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या अधिकाराचे मान्यता पत्र केलेल्या ठरावाची साक्षांकित प्रत",
                    'group' => 2,
                    'sort_by' => 1
                ],
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Marathi,
                    'name' => "वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत",
                    'group' => 2,
                    'sort_by' => 2
                ],
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Marathi,
                    'name' => "विकासकाबरोबर केलेल्या नोंदणीकृत करारनाम्याची साक्षांकित प्रत",
                    'group' => 5,   
                    'is_optional' => 1
                ],
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Marathi,
                    'name' => "५१ % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र",
                    'is_multiple' => 1,
                    'group' => 3,
                ],
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Marathi,
                    'name' => "अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत",
                    'group' => 4,
                    'sort_by' => 1
                ],
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Marathi,
                    'name' => "भाडेपट्टा करारनामा (लीज डिड)",
                    'group' => 4,
                    'sort_by' => 2
                ],
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Marathi,
                    'name' => "अभिहस्तांतरण नकाशा ची साक्षांकित प्रत",
                    'group' => 4,
                    'sort_by' => 3
                ],
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Marathi,
                    'name' => "कार्यकारी अभियंता / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा",
                    'is_optional' => 1,
                    'group' => 6,
                    'sort_by' => 1 
                ],
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Marathi,
                    'name' => "संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत",
                    'group' => 1,
                    'sort_by' => 5
                ],
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Marathi,
                    'name' => "मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र",
                    'is_optional' => 1,
                    'group' => 6,
                    'sort_by' => 2
                ],
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Marathi,
                    'name' => "नगरभुमापन नकाशे",
                    'group' => 6,
                    'sort_by' => 3
                ],
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Marathi,
                    'name' => "मिळकत पत्रिका (PR कार्ड )",
                    'group' => 6,
                    'sort_by' => 4
                ],
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Marathi,
                    'name' => "अस्तीत्वातील इमारतीचे फोटो",
                    'group' => 6,
                    'sort_by' => 5
                ],
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Marathi,
                    'name' => "प्रस्तावीत इमारतीचा नकाशा",
                    'group' => 7,
                ],
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Marathi,
                    'name' => "डी.पी.रिमार्क",
                    'group' => 6,
                    'sort_by' => 6
                ],
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Marathi,
                    'name' => "उपनिबंधक यांचेसमक्ष सर्वसाधारण सभेमध्ये विकासकाची नियुक्ती झाल्याबाबतचे पत्र",
                    'group' => 8,
                ],                
                [
                    'application_id'   => $selfPremium,
                    'language_id'   => $Englang,
                    'name' => "AGM Attendance Letter",
                    'group' => 1,
                    'sort_by' => 6
                ]
            ];

            foreach ($dcrRateArr as $rate) {
                $society_documents = OlSocietyDocumentsMaster::create($rate);
            }
        }
        $selfSharing = OlApplicationMaster::where(['title'=>'New - Offer Letter','model'=>'Sharing', 'parent_id' => '1'])->value('id');
        $data1 = OlSocietyDocumentsMaster::where(['application_id'=>'6'])->get();
        if(count($data1) == 0){
            $dcrRateArr1= [
                [
                    'application_id'   => $selfSharing,
                    'language_id'   => $Marathi,
                    'name' => "संस्थेचा अर्ज",
                    'is_deleted' => 1
                ],
                [
                    'application_id'   => $selfSharing,
                    'language_id'   => $Marathi,
                    'name' => "सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा ठराव",
                    'group' => 1,
                    'sort_by' => 1
                ],
                [
                    'application_id'   => $selfSharing,
                    'language_id'   => $Marathi,
                    'name' => "सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची साक्षांकित प्रत",
                    'group' => 1,
                    'sort_by' => 2
                ],
                [
                    'application_id'   => $selfSharing,
                    'language_id'   => $Marathi,
                    'name' => "सर्वसाधारण सभेच्या ठरावात वास्तुशास्त्रज्ञाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत",
                    'group' => 1,
                    'sort_by' => 3
                ],
                [
                    'application_id'   => $selfSharing,
                    'language_id'   => $Marathi,
                    'name' => "वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या अधिकाराचे मान्यता पत्र केलेल्या ठरावाची साक्षांकित प्रत",
                    'group' => 2,
                    'sort_by' => 1
                ],
                [
                    'application_id'   => $selfSharing,
                    'language_id'   => $Marathi,
                    'name' => "वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत",
                    'group' => 2,
                    'sort_by' => 2
                ],
                [
                    'application_id'   => $selfSharing,
                    'language_id'   => $Marathi,
                    'name' => "५१ % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र",
                    'is_multiple' => 1,
                    'group' => 3
                ],
                [
                    'application_id'   => $selfSharing,
                    'language_id'   => $Marathi,
                    'name' => "अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत",
                    'group' => 4,
                    'sort_by' => 1
                ],
                [
                    'application_id'   => $selfSharing,
                    'language_id'   => $Marathi,
                    'name' => "भाडेपट्टा करारनामा (लीज डिड)",
                    'group' => 4,
                    'sort_by' => 2
                ],
                [
                    'application_id'   => $selfSharing,
                    'language_id'   => $Marathi,
                    'name' => "अभिहस्तांतरण नकाशा ची साक्षांकित प्रत",
                    'group' => 4,
                    'sort_by' => 3
                ],
                [
                    'application_id'   => $selfSharing,
                    'language_id'   => $Marathi,
                    'name' => "कार्यकारी अभियंता / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा",
                    'is_optional' => 1,
                    'group' => 5,
                    'sort_by' => 1
                ],
                [
                    'application_id'   => $selfSharing,
                    'language_id'   => $Marathi,
                    'name' => "संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत",
                    'group' => 1,
                    'sort_by' => 4
                ],
                [
                    'application_id'   => $selfSharing,
                    'language_id'   => $Marathi,
                    'name' => "मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र",
                    'is_optional' => 1,
                    'group' => 5,
                    'sort_by' => 2
                ],
                [
                    'application_id'   => $selfSharing,
                    'language_id'   => $Marathi,
                    'name' => "नगरभुमापन नकाशे",
                    'group' => 5,
                    'sort_by' => 3
                ],
                [
                    'application_id'   => $selfSharing,
                    'language_id'   => $Marathi,
                    'name' => "मिळकत पत्रिका (PR कार्ड )",
                    'group' => 5,
                    'sort_by' => 4
                ],
                [
                    'application_id'   => $selfSharing,
                    'language_id'   => $Marathi,
                    'name' => "अस्तीत्वातील इमारतीचे फोटो",
                    'group' => 5,
                    'sort_by' => 5
                ],
                [
                    'application_id'   => $selfSharing,
                    'language_id'   => $Marathi,
                    'name' => "प्रस्तावीत इमारतीचा नकाशा",
                    'group' => 6
                ],
                [
                    'application_id'   => $selfSharing,
                    'language_id'   => $Marathi,
                    'name' => "डी.पी.रिमार्क",
                    'group' => 5,
                    'sort_by' => 6
                ],
                [
                    'application_id'   => $selfSharing,
                    'language_id'   => $Englang,
                    'name' => "AGM Attendance Letter",
                    'group' => 1,
                    'sort_by' => 5
                ]
            ];

            foreach ($dcrRateArr1 as $rate1) {
                $society_documents = OlSocietyDocumentsMaster::create($rate1);
            }
        }

        $redevPrem = OlApplicationMaster::where(['title'=>'New - Offer Letter','model'=>'Premium', 'parent_id' => '12'])->value('id');
        $data2 = OlSocietyDocumentsMaster::where(['application_id'=>'13'])->get();
        if(count($data2) == 0){
            $dcrRateArr2= [
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Marathi,
                    'name' => "संस्थेचा अर्ज",
                    'is_deleted' => 1
                ],
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Marathi,
                    'name' => "सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा ठराव",
                    'group' => 1,
                    'sort_by' => 1
                ],
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Marathi,
                    'name' => "सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची साक्षांकित प्रत",
                    'group' => 1,
                    'sort_by' => 2
                ],
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Marathi,
                    'name' => "संस्थेच्या सर्वसाधारण सभेच्या ठरावात विकासकाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत",
                    'group' => 1,
                    'sort_by' => 3
                ],
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Marathi,
                    'name' => "सर्वसाधारण सभेच्या ठरावात वास्तुशास्त्रज्ञाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत",
                    'group' => 1,
                    'sort_by' => 4
                ],
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Marathi,
                    'name' => "वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या अधिकाराचे मान्यता पत्र केलेल्या ठरावाची साक्षांकित प्रत",
                    'group' => 2,
                    'sort_by' => 1
                ],
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Marathi,
                    'name' => "वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत",
                    'group' => 2,
                    'sort_by' => 2
                ],
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Marathi,
                    'name' => "विकासकाबरोबर केलेल्या नोंदणीकृत करारनाम्याची साक्षांकित प्रत",
                    'is_optional' => 1,
                    'group' => 5
                ],
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Marathi,
                    'name' => "५१ % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र",
                    'is_multiple' => 1,
                    'group' => 3
                ],
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Marathi,
                    'name' => "अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत",
                    'group' => 4,
                    'sort_by' => 1
                ],
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Marathi,
                    'name' => "भाडेपट्टा करारनामा (लीज डिड)",
                    'group' => 4,
                    'sort_by' => 2
                ],
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Marathi,
                    'name' => "अभिहस्तांतरण नकाशा ची साक्षांकित प्रत",
                    'group' => 4,
                    'sort_by' => 3
                ],
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Marathi,
                    'name' => "कार्यकारी अभियंता / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा",
                    'is_optional' => 1,
                    'group' => 6,
                    'sort_by' => 1
                ],
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Marathi,
                    'name' => "संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत",
                    'group' => 1,
                    'sort_by' => 5
                ],
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Marathi,
                    'name' => "मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र",
                    'is_optional' => 1,
                    'group' => 6,
                    'sort_by' => 2
                ],
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Marathi,
                    'name' => "नगरभुमापन नकाशे",
                    'group' => 6,
                    'sort_by' => 3
                ],
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Marathi,
                    'name' => "मिळकत पत्रिका (PR कार्ड )",
                    'group' => 6,
                    'sort_by' => 4
                ],
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Marathi,
                    'name' => "अस्तीत्वातील इमारतीचे फोटो",
                    'group' => 6,
                    'sort_by' => 5
                ],
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Marathi,
                    'name' => "प्रस्तावीत इमारतीचा नकाशा",
                    'group' => 7,
                ],
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Marathi,
                    'name' => "डी.पी.रिमार्क",
                    'group' => 6,
                    'sort_by' => 6
                ],
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Marathi,
                    'name' => "उपनिबंधक यांचेसमक्ष सर्वसाधारण सभेमध्ये विकासकाची नियुक्ती झाल्याबाबतचे पत्र",
                    'group' => 8,
                ],
                [
                    'application_id'   => $redevPrem,
                    'language_id'   => $Englang,
                    'name' => "AGM Attendance Letter",
                    'group' => 1,
                    'sort_by' => 6
                ]
            ];

            foreach ($dcrRateArr2 as $rate2) {
                $society_documents = OlSocietyDocumentsMaster::create($rate2);
            }
        }

        $redevSharing = OlApplicationMaster::where(['title'=>'New - Offer Letter','model'=>'Sharing', 'parent_id' => '12'])->value('id');
        $data3 = OlSocietyDocumentsMaster::where(['application_id'=>'17'])->get();
        if(count($data3) == 0){
            $dcrRateArr3= [
                [
                    'application_id'   => $redevSharing,
                    'language_id'   => $Marathi,
                    'name' => "संस्थेचा अर्ज",
                    'is_deleted' => 1
                ],
                [
                    'application_id'   => $redevSharing,
                    'language_id'   => $Marathi,
                    'name' => "सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा ठराव",
                    'group' => 1,
                    'sort_by' => 1
                ],
                [
                    'application_id'   => $redevSharing,
                    'language_id'   => $Marathi,
                    'name' => "सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची साक्षांकित प्रत",
                    'group' => 1,
                    'sort_by' => 2
                ],
                [
                    'application_id'   => $redevSharing,
                    'language_id'   => $Marathi,
                    'name' => "सर्वसाधारण सभेच्या ठरावात वास्तुशास्त्रज्ञाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत",
                    'group' => 1,
                    'sort_by' => 3
                ],
                [
                    'application_id'   => $redevSharing,
                    'language_id'   => $Marathi,
                    'name' => "वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या अधिकाराचे मान्यता पत्र केलेल्या ठरावाची साक्षांकित प्रत",
                    'group' => 2,
                    'sort_by' => 1
                ],
                [
                    'application_id'   => $redevSharing,
                    'language_id'   => $Marathi,
                    'name' => "वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत",
                    'group' => 2,
                    'sort_by' => 2
                ],
                [
                    'application_id'   => $redevSharing,
                    'language_id'   => $Marathi,
                    'name' => "५१ % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र",
                    'group' => 3,
                    'is_multiple' => 1
                ],
                [
                    'application_id'   => $redevSharing,
                    'language_id'   => $Marathi,
                    'name' => "अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत",
                    'group' => 4,
                    'sort_by' => 1
                ],
                [
                    'application_id'   => $redevSharing,
                    'language_id'   => $Marathi,
                    'name' => "भाडेपट्टा करारनामा (लीज डिड)",
                    'group' => 4,
                    'sort_by' => 2
                ],
                [
                    'application_id'   => $redevSharing,
                    'language_id'   => $Marathi,
                    'name' => "अभिहस्तांतरण नकाशा ची साक्षांकित प्रत",
                    'group' => 4,
                    'sort_by' => 3
                ],
                [
                    'application_id'   => $redevSharing,
                    'language_id'   => $Marathi,
                    'name' => "कार्यकारी अभियंता / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा",
                    'is_optional' => 1,
                    'group' => 5,
                    'sort_by' => 1
                ],
                [
                    'application_id'   => $redevSharing,
                    'language_id'   => $Marathi,
                    'name' => "संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत",
                    'group' => 1,
                    'sort_by' => 4
                ],
                [
                    'application_id'   => $redevSharing,
                    'language_id'   => $Marathi,
                    'name' => "मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र",
                    'is_optional' => 1,
                    'group' => 5,
                    'sort_by' => 2
                ],
                [
                    'application_id'   => $redevSharing,
                    'language_id'   => $Marathi,
                    'name' => "नगरभुमापन नकाशे",
                    'group' => 5,
                    'sort_by' => 3
                ],
                [
                    'application_id'   => $redevSharing,
                    'language_id'   => $Marathi,
                    'name' => "मिळकत पत्रिका (PR कार्ड )",
                    'group' => 5,
                    'sort_by' => 4
                ],
                [
                    'application_id'   => $redevSharing,
                    'language_id'   => $Marathi,
                    'name' => "अस्तीत्वातील इमारतीचे फोटो",
                    'group' => 5,
                    'sort_by' => 5
                ],
                [
                    'application_id'   => $redevSharing,
                    'language_id'   => $Marathi,
                    'name' => "प्रस्तावीत इमारतीचा नकाशा",
                    'group' => 6
                ],
                [
                    'application_id'   => $redevSharing,
                    'language_id'   => $Marathi,
                    'name' => "डी.पी.रिमार्क",
                    'group' => 5,
                    'sort_by' => 6
                ],
                [
                    'application_id'   => $redevSharing,
                    'language_id'   => $Englang,
                    'name' => "AGM Attendance Letter",
                    'group' => 1,
                    'sort_by' => 5
                ]
            ];

            foreach ($dcrRateArr3 as $rate3) {
                $society_documents = OlSocietyDocumentsMaster::create($rate3);
            }
        }


        // Revalidation of offer letter - documents
        $english_lang = LanguageMaster::select('id')->where(['language'=>'English'])->get();
        $application4_arr=OlApplicationMaster::Where('title', 'like', '%Revalidation Of Offer Letter%')->pluck('id')->toArray();
        foreach($application4_arr as $app)
        {
            $app_insertArr= [
                [
                    'application_id'   => $app,
                    'language_id'   => $Marathi,
                    'name' => "संस्थेचा अर्ज परिशिष्ट अ प्रमाणे"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'name' => "Old Offer Letter"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'name' => "Society Resolution"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'name' => "Other"
                ]
                ];

            OlSocietyDocumentsMaster::insert($app_insertArr);
        }


        // Consent for OC - documents
        $english_lang = LanguageMaster::select('id')->where(['language'=>'English'])->get();
        $application5_arr=OlApplicationMaster::Where('title', 'like', '%Consent for OC%')->pluck('id')->toArray();
        foreach($application5_arr as $app)
        {
            $app_insertArr= [
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'is_optional'=>0,
                    'is_deleted' => 1,
                    'name' => "संस्थेचा अर्ज परिशिष्ट अ प्रमाणे "
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'is_optional'=>0,
                    'is_deleted' => 0,
                    'name' => "Latest Approved Drawings"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'is_optional'=>0,
                    'is_deleted' => 0,
                    'name' => "Matching statement"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'is_optional'=>0,
                    'is_deleted' => 0,
                    'name' => "Stability certificate from structure consultant"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'is_optional'=>0,
                    'is_deleted' => 0,
                    'name' => "Completion certificate from society architect"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'is_optional'=>0,
                    'is_deleted' => 0,
                    'name' => "Supplymentry lease deed"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'is_optional'=>0,
                    'is_deleted' => 0,
                    'name' => "Building photos from 4 sides - front side"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'is_optional'=>0,
                    'is_deleted' => 0,
                    'name' => "Building photos from 4 sides - side 2"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'is_optional'=>0,
                    'is_deleted' => 0,
                    'name' => "Building photos from 4 sides - side 3"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'is_optional'=>0,
                    'is_deleted' => 0,
                    'name' => "Building photos from 4 sides - side 4"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'is_optional'=>0,
                    'is_deleted' => 0,
                    'name' => "Google Image"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'is_optional'=>1,
                    'is_deleted' => 0,
                    'name' => "Other"
                ]
            ];

            OlSocietyDocumentsMaster::insert($app_insertArr);
        }

        $english_lang = LanguageMaster::select('id')->where(['language'=>'English'])->get();
        $application5_arr=OlApplicationMaster::Where('title', 'like', '%Tripartite Agreement%')->pluck('id')->toArray();
        //dd($application5_arr);
        foreach($application5_arr as $app)
        {
            $app_insertArr= [ 
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'name' => "text_tripartite_agreement",
                    'is_optional'=>0,
                    'is_admin'=>1
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'name' => "drafted_tripartite_agreement",
                    'is_optional'=>1,
                    'is_admin'=>1
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'name' => "drafted_signed_tripartite_agreement",
                    'is_optional'=>0,
                    'is_admin'=>1
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'name' => "tripartite_ree_note",
                    'is_optional'=>0,
                    'is_admin'=>1
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'name' => "Approved NOC - IOD",
                    'is_optional'=>0,
                    'is_admin' => 0
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'name' => "Draft of triprtite agreement if available",
                    'is_optional'=>1,
                    'is_admin' => 0
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'name' => "Other",
                    'is_optional'=>1,
                    'is_admin' => 0
                ]
            ];
            foreach($app_insertArr as $app_insertAr)
            { 
                $ol_doc_master=OlSocietyDocumentsMaster::where(['application_id'=>$app_insertAr['application_id'],'name'=>$app_insertAr['name']])->first();
                if($ol_doc_master)
                {

                }else
                {
                    OlSocietyDocumentsMaster::insert($app_insertArr);
                }
            }
            
        }

    }

}
