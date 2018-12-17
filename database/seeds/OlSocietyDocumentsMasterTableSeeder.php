<?php

use Illuminate\Database\Seeder;
use App\OlSocietyDocumentsMaster;
use App\OlApplicationMaster;
use App\LanguageMaster;

class OlSocietyDocumentsMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OlSocietyDocumentsMaster::truncate(); // To prevent duplicate entries,truncate master table & add all entries again.

        $application = OlApplicationMaster::select('id')->where(['title'=>'New - Offer Letter','model'=>'Premium', 'parent_id' => '1'])->get();
        $language = LanguageMaster::select('id')->where(['language'=>'marathi'])->get();
        $data = OlSocietyDocumentsMaster::where(['application_id'=>'2'])->get();
        if(count($data) == 0){
            $dcrRateArr= [
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "संस्थेचा अर्ज"
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा ठराव"
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "संस्थेच्या सर्वसाधारण सभेच्या ठरावात विकासकाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "सर्वसाधारण सभेच्या ठरावात वास्तुशास्त्रज्ञाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या अधिकाराचे मान्यता पत्र केलेल्या ठरावाची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "विकासकाबरोबर केलेल्या नोंदणीकृत करारनाम्याची साक्षांकित प्रत",
                    'is_optional' => '1'
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "७० % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र"
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "भाडेपट्टा करारनामा (लीज डिड)"
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "अभिहस्तांतरण नकाशा ची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "कार्यकारी अभियंता / कुर्ला विभाग / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा",
                    'is_optional' => '1'
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र",
                    'is_optional' => '1'
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "नगरभुमापन नकाशे"
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "मिळकत पत्रिका (PR कार्ड )",
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "अस्तीत्वातील इमारतीचे फोटो"
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "प्रस्तावीत इमारतीचा नकाशा",
                    'is_optional' => '1'
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "डी.पी.रिमार्क"
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "उपनिबंधक यांचेसमक्ष सर्वसाधारण सभेमध्ये विकासकाची नियुक्ती झाल्याबाबतचे पत्र"
                ]
            ];

            foreach ($dcrRateArr as $rate) {
                $society_documents = OlSocietyDocumentsMaster::create($rate);
            }
        }
        $application1 = OlApplicationMaster::select('id')->where(['title'=>'New - Offer Letter','model'=>'Sharing', 'parent_id' => '1'])->get();
        $language1 = LanguageMaster::select('id')->where(['language'=>'marathi'])->get();
        $data1 = OlSocietyDocumentsMaster::where(['application_id'=>'6'])->get();
        if(count($data1) == 0){
            $dcrRateArr1= [
                [
                    'application_id'   => $application1[0]['id'],
                    'language_id'   => $language1[0]['id'],
                    'name' => "संस्थेचा अर्ज"
                ],
                [
                    'application_id'   => $application1[0]['id'],
                    'language_id'   => $language1[0]['id'],
                    'name' => "सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा ठराव"
                ],
                [
                    'application_id'   => $application1[0]['id'],
                    'language_id'   => $language1[0]['id'],
                    'name' => "सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application1[0]['id'],
                    'language_id'   => $language1[0]['id'],
                    'name' => "सर्वसाधारण सभेच्या ठरावात वास्तुशास्त्रज्ञाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application1[0]['id'],
                    'language_id'   => $language1[0]['id'],
                    'name' => "वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या अधिकाराचे मान्यता पत्र केलेल्या ठरावाची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application1[0]['id'],
                    'language_id'   => $language1[0]['id'],
                    'name' => "वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application1[0]['id'],
                    'language_id'   => $language1[0]['id'],
                    'name' => "५१ % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र"
                ],
                [
                    'application_id'   => $application1[0]['id'],
                    'language_id'   => $language1[0]['id'],
                    'name' => "अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application1[0]['id'],
                    'language_id'   => $language1[0]['id'],
                    'name' => "भाडेपट्टा करारनामा (लीज डिड)"
                ],
                [
                    'application_id'   => $application1[0]['id'],
                    'language_id'   => $language1[0]['id'],
                    'name' => "अभिहस्तांतरण नकाशा ची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application1[0]['id'],
                    'language_id'   => $language1[0]['id'],
                    'name' => "कार्यकारी अभियंता / कुर्ला विभाग / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा",
                    'is_optional' => '1'
                ],
                [
                    'application_id'   => $application1[0]['id'],
                    'language_id'   => $language1[0]['id'],
                    'name' => "संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application1[0]['id'],
                    'language_id'   => $language1[0]['id'],
                    'name' => "मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र",
                    'is_optional' => '1'
                ],
                [
                    'application_id'   => $application1[0]['id'],
                    'language_id'   => $language1[0]['id'],
                    'name' => "नगरभुमापन नकाशे"
                ],
                [
                    'application_id'   => $application1[0]['id'],
                    'language_id'   => $language1[0]['id'],
                    'name' => "मिळकत पत्रिका (PR कार्ड )"
                ],
                [
                    'application_id'   => $application1[0]['id'],
                    'language_id'   => $language1[0]['id'],
                    'name' => "अस्तीत्वातील इमारतीचे फोटो"
                ],
                [
                    'application_id'   => $application1[0]['id'],
                    'language_id'   => $language1[0]['id'],
                    'name' => "प्रस्तावीत इमारतीचा नकाशा",
                    'is_optional' => '1'
                ],
                [
                    'application_id'   => $application1[0]['id'],
                    'language_id'   => $language1[0]['id'],
                    'name' => "डी.पी.रिमार्क"
                ]
            ];

            foreach ($dcrRateArr1 as $rate1) {
                $society_documents = OlSocietyDocumentsMaster::create($rate1);
            }
        }

        $application2 = OlApplicationMaster::select('id')->where(['title'=>'New - Offer Letter','model'=>'Premium', 'parent_id' => '12'])->get();
        $language2 = LanguageMaster::select('id')->where(['language'=>'marathi'])->get();
        $data2 = OlSocietyDocumentsMaster::where(['application_id'=>'13'])->get();
        if(count($data2) == 0){
            $dcrRateArr2= [
                [
                    'application_id'   => $application2[0]['id'],
                    'language_id'   => $language2[0]['id'],
                    'name' => "संस्थेचा अर्ज"
                ],
                [
                    'application_id'   => $application2[0]['id'],
                    'language_id'   => $language2[0]['id'],
                    'name' => "सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा ठराव"
                ],
                [
                    'application_id'   => $application2[0]['id'],
                    'language_id'   => $language2[0]['id'],
                    'name' => "सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application2[0]['id'],
                    'language_id'   => $language2[0]['id'],
                    'name' => "संस्थेच्या सर्वसाधारण सभेच्या ठरावात विकासकाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application2[0]['id'],
                    'language_id'   => $language2[0]['id'],
                    'name' => "सर्वसाधारण सभेच्या ठरावात वास्तुशास्त्रज्ञाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application2[0]['id'],
                    'language_id'   => $language2[0]['id'],
                    'name' => "वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या अधिकाराचे मान्यता पत्र केलेल्या ठरावाची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application2[0]['id'],
                    'language_id'   => $language2[0]['id'],
                    'name' => "वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application2[0]['id'],
                    'language_id'   => $language2[0]['id'],
                    'name' => "विकासकाबरोबर केलेल्या नोंदणीकृत करारनाम्याची साक्षांकित प्रत",
                    'is_optional' => '1'

                ],
                [
                    'application_id'   => $application2[0]['id'],
                    'language_id'   => $language2[0]['id'],
                    'name' => "५१ % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र"
                ],
                [
                    'application_id'   => $application2[0]['id'],
                    'language_id'   => $language2[0]['id'],
                    'name' => "अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application2[0]['id'],
                    'language_id'   => $language2[0]['id'],
                    'name' => "भाडेपट्टा करारनामा (लीज डिड)"
                ],
                [
                    'application_id'   => $application2[0]['id'],
                    'language_id'   => $language2[0]['id'],
                    'name' => "अभिहस्तांतरण नकाशा ची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application2[0]['id'],
                    'language_id'   => $language2[0]['id'],
                    'name' => "कार्यकारी अभियंता / कुर्ला विभाग / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा",
                    'is_optional' => '1'
                ],
                [
                    'application_id'   => $application2[0]['id'],
                    'language_id'   => $language2[0]['id'],
                    'name' => "संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application2[0]['id'],
                    'language_id'   => $language2[0]['id'],
                    'name' => "मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र",
                    'is_optional' => '1'
                ],
                [
                    'application_id'   => $application2[0]['id'],
                    'language_id'   => $language2[0]['id'],
                    'name' => "नगरभुमापन नकाशे"
                ],
                [
                    'application_id'   => $application2[0]['id'],
                    'language_id'   => $language2[0]['id'],
                    'name' => "मिळकत पत्रिका (PR कार्ड )"
                ],
                [
                    'application_id'   => $application2[0]['id'],
                    'language_id'   => $language2[0]['id'],
                    'name' => "अस्तीत्वातील इमारतीचे फोटो"
                ],
                [
                    'application_id'   => $application2[0]['id'],
                    'language_id'   => $language2[0]['id'],
                    'name' => "प्रस्तावीत इमारतीचा नकाशा",
                    'is_optional' => '1'
                ],
                [
                    'application_id'   => $application2[0]['id'],
                    'language_id'   => $language2[0]['id'],
                    'name' => "डी.पी.रिमार्क"
                ],
                [
                    'application_id'   => $application2[0]['id'],
                    'language_id'   => $language2[0]['id'],
                    'name' => "उपनिबंधक यांचेसमक्ष सर्वसाधारण सभेमध्ये विकासकाची नियुक्ती झाल्याबाबतचे पत्र"
                ]
            ];

            foreach ($dcrRateArr2 as $rate2) {
                $society_documents = OlSocietyDocumentsMaster::create($rate2);
            }
        }

        $application3 = OlApplicationMaster::select('id')->where(['title'=>'New - Offer Letter','model'=>'Sharing', 'parent_id' => '12'])->get();
        $language3 = LanguageMaster::select('id')->where(['language'=>'marathi'])->get();
        $data3 = OlSocietyDocumentsMaster::where(['application_id'=>'17'])->get();
        if(count($data3) == 0){
            $dcrRateArr3= [
                [
                    'application_id'   => $application3[0]['id'],
                    'language_id'   => $language3[0]['id'],
                    'name' => "संस्थेचा अर्ज"
                ],
                [
                    'application_id'   => $application3[0]['id'],
                    'language_id'   => $language3[0]['id'],
                    'name' => "सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा ठराव"
                ],
                [
                    'application_id'   => $application3[0]['id'],
                    'language_id'   => $language3[0]['id'],
                    'name' => "सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application3[0]['id'],
                    'language_id'   => $language3[0]['id'],
                    'name' => "सर्वसाधारण सभेच्या ठरावात वास्तुशास्त्रज्ञाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application3[0]['id'],
                    'language_id'   => $language3[0]['id'],
                    'name' => "वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या अधिकाराचे मान्यता पत्र केलेल्या ठरावाची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application3[0]['id'],
                    'language_id'   => $language3[0]['id'],
                    'name' => "वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application3[0]['id'],
                    'language_id'   => $language3[0]['id'],
                    'name' => "७० % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र"
                ],
                [
                    'application_id'   => $application3[0]['id'],
                    'language_id'   => $language3[0]['id'],
                    'name' => "अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application3[0]['id'],
                    'language_id'   => $language3[0]['id'],
                    'name' => "भाडेपट्टा करारनामा (लीज डिड)"
                ],
                [
                    'application_id'   => $application3[0]['id'],
                    'language_id'   => $language3[0]['id'],
                    'name' => "अभिहस्तांतरण नकाशा ची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application3[0]['id'],
                    'language_id'   => $language3[0]['id'],
                    'name' => "कार्यकारी अभियंता / कुर्ला विभाग / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा",
                    'is_optional' => '1'
                ],
                [
                    'application_id'   => $application3[0]['id'],
                    'language_id'   => $language3[0]['id'],
                    'name' => "संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application3[0]['id'],
                    'language_id'   => $language3[0]['id'],
                    'name' => "मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र",
                    'is_optional' => '1'
                ],
                [
                    'application_id'   => $application3[0]['id'],
                    'language_id'   => $language3[0]['id'],
                    'name' => "नगरभुमापन नकाशे"
                ],
                [
                    'application_id'   => $application3[0]['id'],
                    'language_id'   => $language3[0]['id'],
                    'name' => "मिळकत पत्रिका (PR कार्ड )"
                ],
                [
                    'application_id'   => $application3[0]['id'],
                    'language_id'   => $language3[0]['id'],
                    'name' => "अस्तीत्वातील इमारतीचे फोटो"
                ],
                [
                    'application_id'   => $application3[0]['id'],
                    'language_id'   => $language3[0]['id'],
                    'name' => "प्रस्तावीत इमारतीचा नकाशा",
                    'is_optional' => '1'
                ],
                [
                    'application_id'   => $application3[0]['id'],
                    'language_id'   => $language3[0]['id'],
                    'name' => "डी.पी.रिमार्क"
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
                    'language_id'   => $language3[0]['id'],
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
                    'name' => "संस्थेचा अर्ज परिशिष्ट अ प्रमाणे "
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'name' => "Latest Approved Drawings"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'name' => "Matching statement"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'name' => "Stability certificate from structure consultant"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'name' => "Completion certificate from society architect"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'name' => "Supplymentry lease deed"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'name' => "Building photos from 4 sides - front side"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'name' => "Building photos from 4 sides - side 2"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'name' => "Building photos from 4 sides - side 3"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'name' => "Building photos from 4 sides - side 4"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
                    'name' => "Google Image"
                ],
                [
                    'application_id'   => $app,
                    'language_id'   => $english_lang[0]['id'],
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
                    'is_optional'=>0,
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
                    'name' => "other",
                    'is_optional'=>0,
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
