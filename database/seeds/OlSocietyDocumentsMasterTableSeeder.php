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
        $dcrRateArr= [
            [
                'application_id'   => $application[0]['id'],
                'language_id'   => $language[0]['id'],
                'name' => "संस्थेचा अर्ज परिशिष्ट अ प्रमाणे"
            ]
        ];

        foreach ($dcrRateArr as $rate) {
            $society_documents = OlSocietyDocumentsMaster::create($rate);
        }
    }

}
