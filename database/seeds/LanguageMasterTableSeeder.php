<?php

use Illuminate\Database\Seeder;
use App\LanguageMaster;

class LanguageMasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languageArr =[];

        $languageArr[] = [
            'language'   => "English",
        ];

        $languageArr[] = [
            'language'   => "marathi",
        ];

        $language = LanguageMaster::all();
        
        if (count($language) == '0'){
            $lang = LanguageMaster::insert($languageArr);
        }else{
            foreach ($languageArr as $data) {
                $languageData = LanguageMaster::where('language',$data['language'])->first();
                
                if(!$languageData){
                    $LanguageMaster = new LanguageMaster();
                    $LanguageMaster->language = $data['language'];
                    $LanguageMaster->save();
                }   
            }

        }

    }
}
