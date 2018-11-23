<?php

use Illuminate\Database\Seeder;
use App\conveyance\SfScrtinyByEmMaster;

class SfScrtinyByEmMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            ['language_id' => 1,
                'title' => 'Recent receipt of service charge paid',
                'is_options' => 0,
                'label1' => '',
                'label2' => '',
            ],
            ['language_id' => 1,
                'title' => 'Allotement letters are avilable for all house owners or not?',
                'is_options' => 1,
                'label1' => 'Yes',
                'label2' => 'No',
            ],
            ['language_id' => 1,
                'title' => 'Society has uploaded society resolution or not ?',
                'is_options' => 1,
                'label1' => 'Yes',
                'label2' => 'No',
            ]
        ];
        foreach ($questions as $question) {
            $SfScrtinyByEmMaster = SfScrtinyByEmMaster::where(['title' => $question['title']])->first();
            if ($SfScrtinyByEmMaster) {

            } else {
                $SfScrtinyByEmMaster = new SfScrtinyByEmMaster;
                $SfScrtinyByEmMaster->language_id = $question['language_id'];
                $SfScrtinyByEmMaster->title = $question['title'];
                $SfScrtinyByEmMaster->is_options = $question['is_options'];
                $SfScrtinyByEmMaster->label1 = $question['label1'];
                $SfScrtinyByEmMaster->label2 = $question['label2'];
                $SfScrtinyByEmMaster->save();
            }

        }
    }
}
