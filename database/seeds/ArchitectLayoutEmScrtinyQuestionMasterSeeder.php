<?php

use App\Layout\ArchitectLayoutEmScrtinyQuestionMaster;
use Illuminate\Database\Seeder;

class ArchitectLayoutEmScrtinyQuestionMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            [
                'language_id' => 1,
                'title' => 'List of Societies',
                'rank' => 1,
                'group_in' => '',
            ],
            [
                'language_id' => 1,
                'title' => 'Lease deed & Convayance deed',
                'rank' => 2,
                'group_in' => '',
            ],
            [
                'language_id' => 1,
                'title' => 'Excel sheet with details; category of tenants, carpet area mensioned in sale deed, no of bldgs., Total no of t/s ',
                'rank' => 3,
                'group_in' => '',
            ],
            [
                'language_id' => 1,
                'title' => 'details of change of tenants, if any',
                'rank' => 4,
                'group_in' => '',
            ],
        ];
        foreach ($questions as $question) {
            $ArchitectLayoutEmScrtinyQuestionMaster = ArchitectLayoutEmScrtinyQuestionMaster::where(['title' => $question['title']])->first();
            if ($ArchitectLayoutEmScrtinyQuestionMaster) {

            } else {
                $ArchitectLayoutEmScrtinyQuestionMaster = new ArchitectLayoutEmScrtinyQuestionMaster;
                $ArchitectLayoutEmScrtinyQuestionMaster->language_id = $question['language_id'];
                $ArchitectLayoutEmScrtinyQuestionMaster->title = $question['title'];
                $ArchitectLayoutEmScrtinyQuestionMaster->rank = $question['rank'];
                $ArchitectLayoutEmScrtinyQuestionMaster->group_in = $question['group_in'];
                $ArchitectLayoutEmScrtinyQuestionMaster->save();
            }

        }

    }
}
