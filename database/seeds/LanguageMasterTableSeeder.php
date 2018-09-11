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

        foreach ($languageArr as $language) {
            $lang = LanguageMaster::create($language);
        }

    }
}
