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
        $application = OlApplicationMaster::select('id')->where(['title'=>'New - Offer Letter','model'=>'Premium'])->get();
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
                    'name' => "सर्वसाधारण सभेच्या ठरावात विकासकाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत"
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
                    'name' => "विकासकाबरोबर केलेल्या नोंदणीकृत करारनाम्याची साक्षांकित प्रत"
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
                    'name' => "कार्यकारी अभियंता / कुर्ला विभाग / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा"
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत"
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र"
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "नगरभुमापन नकाशे"
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "मिळकत पत्रिका (PR कार्ड )"
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "अस्तीत्वातील इमारतीचे फोटो"
                ],
                [
                    'application_id'   => $application[0]['id'],
                    'language_id'   => $language[0]['id'],
                    'name' => "प्रस्तावीत इमारतीचा नकाशा"
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
    }

}
