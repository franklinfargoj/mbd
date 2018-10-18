<?php

use Illuminate\Database\Seeder;
use App\Layout\ArchitectLayoutReeScrtinyQuestionMaster;

class ArchitectLayoutReeScrtinyQuestionMasterSeeder extends Seeder
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
                'title' => 'List of Offer letters issued to the societies',
            ],
            ['language_id' => 1,
                'title' => 'List of NOC letters issued to the societies',
            ],
            ['language_id' => 1,
                'title' => 'List of R.G. Open Spaces allotted to various Societies',
            ],
            ['language_id' => 1,
                'title' => 'Recovery if any from the society regarding additional FSI, R.G. etc.',
            ]
        ];
        foreach ($questions as $question) {
            $ArchitectLayoutReeScrtinyQuestionMaster = ArchitectLayoutReeScrtinyQuestionMaster::where(['title' => $question['title']])->first();
            if ($ArchitectLayoutReeScrtinyQuestionMaster) {

            } else {
                $ArchitectLayoutReeScrtinyQuestionMaster = new ArchitectLayoutReeScrtinyQuestionMaster;
                $ArchitectLayoutReeScrtinyQuestionMaster->language_id = $question['language_id'];
                $ArchitectLayoutReeScrtinyQuestionMaster->title = $question['title'];
                $ArchitectLayoutReeScrtinyQuestionMaster->save();
            }

        }
    }
}
