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
                'rank'=>1,
                'group_in'=>''
            ],
            ['language_id' => 1,
                'title' => 'List of NOC letters issued to the societies',
                'rank'=>2,
                'group_in'=>''
            ],
             ['language_id' => 1,
                'title' => 'Demarcation per society/ R Plot/ OB etc.',
                'rank'=>3,
                'group_in'=>''
            ]
            // ['language_id' => 1,
            //     'title' => 'List of R.G. Open Spaces allotted to various Societies',
            //     'rank'=>1,
            //     'group_in'=>''
            // ],
            // ['language_id' => 1,
            //     'title' => 'Recovery if any from the society regarding additional FSI, R.G. etc.',
            //     'rank'=>1,
            //     'group_in'=>''
            // ]
        ];
        ArchitectLayoutReeScrtinyQuestionMaster::truncate();
        foreach ($questions as $question) {
            $ArchitectLayoutReeScrtinyQuestionMaster = ArchitectLayoutReeScrtinyQuestionMaster::where(['title' => $question['title']])->first();
            if ($ArchitectLayoutReeScrtinyQuestionMaster) {

            } else {
                $ArchitectLayoutReeScrtinyQuestionMaster = new ArchitectLayoutReeScrtinyQuestionMaster;
                $ArchitectLayoutReeScrtinyQuestionMaster->language_id = $question['language_id'];
                $ArchitectLayoutReeScrtinyQuestionMaster->title = $question['title'];
                $ArchitectLayoutReeScrtinyQuestionMaster->rank = $question['rank'];
                $ArchitectLayoutReeScrtinyQuestionMaster->group_in = $question['group_in'];
                $ArchitectLayoutReeScrtinyQuestionMaster->save();
            }

        }
    }
}
