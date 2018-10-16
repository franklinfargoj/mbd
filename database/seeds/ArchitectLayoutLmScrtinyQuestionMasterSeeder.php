<?php

use Illuminate\Database\Seeder;
use App\Layout\ArchitectLayoutLmScrtinyQuestionMaster;

class ArchitectLayoutLmScrtinyQuestionMasterSeeder extends Seeder
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
                'title' => 'Submit report of availability of property cards of all CTS no of Colony, Area as per Property Card',
                'is_options'=>1,
                'label1'=>'Available',
                'label2'=>'Not Available'
            ],
            ['language_id' => 1,
                'title' => 'Plot boundary shown as per CTS',
                'is_options'=>1,
                'label1'=>'Yes',
                'label2'=>'No'
            ],
            ['language_id' => 1,
                'title' => 'Whether all property cards are in name of MHADA. if Property cards in name of different owner then whether any proposal for change of name in MHADA',
                'is_options'=>1,
                'label1'=>'Yes',
                'label2'=>'No'
            ],
            ['language_id' => 1,
                'title' => 'Whether Plot boundary of colony is correct as per possession plan / CTS plan.',
                'is_options'=>1,
                'label1'=>'Yes',
                'label2'=>'No'
            ],
        ];
        foreach($questions as $question)
        {
            $ArchitectLayoutLmScrtinyQuestionMaster =ArchitectLayoutLmScrtinyQuestionMaster::where(['title'=>$question['title']])->first();
            if($ArchitectLayoutLmScrtinyQuestionMaster)
            {

            }else
            {
                $ArchitectLayoutLmScrtinyQuestionMaster = new ArchitectLayoutLmScrtinyQuestionMaster;
                $ArchitectLayoutLmScrtinyQuestionMaster->language_id=$question['language_id'];
                $ArchitectLayoutLmScrtinyQuestionMaster->title=$question['title'];
                $ArchitectLayoutLmScrtinyQuestionMaster->is_options=$question['is_options'];
                $ArchitectLayoutLmScrtinyQuestionMaster->label1=$question['label1'];
                $ArchitectLayoutLmScrtinyQuestionMaster->label2=$question['label2'];
                $ArchitectLayoutLmScrtinyQuestionMaster->save();
            }
            
        }
    }
}
