<?php

use Illuminate\Database\Seeder;
use App\LanguageMaster;
use App\OlTitBitSimulationValuesMaster;

class OlTitBitSimulationMapValues extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ol_tit_bit_simulation_values_master')->truncate();
        $languageId = LanguageMaster::where(['language'=>'marathi'])->value('id');
        $values = [               
            [
                'language_id' => $languageId,
                'group' => "अ)",
                'values' => "प्रवेशमार्ग नसणारे व आजूबाजूच्या इमारतींनी बंधिस्त असणारे भूखंड",
                'is_deleted' => 0,
            ],
            [
                'language_id' => $languageId,
                'group' => "ब)",
                'values' => "दोन इमारतींमध्ये असणारे अतिरिक्त भूखंड",
                'is_deleted' => 0,
            ],
            [
                'language_id' => $languageId,
                'group' => "क)",
                'values' => "रस्ता, आरक्षित भूखंड/ नाला व लगतच्या इमारतींमधील बंधिस्त भूखंड",
                'is_deleted' => 0,
            ],
            [
                'language_id' => $languageId,
                'group' => "ड)",
                'values' => "इमारतींना द्यावयाच्या अनुलग्न जागेपलीकडे अभिन्यासाची सीमा किंवा रस्त्यामध्ये निर्माण झालेले भूखंड ",
                'is_deleted' => 0
            ]
        ];                         
    	OlTitBitSimulationValuesMaster::Insert($values);
    } 
}
