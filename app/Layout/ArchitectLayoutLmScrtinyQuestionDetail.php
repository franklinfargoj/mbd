<?php

namespace App\Layout;

use Illuminate\Database\Eloquent\Model;

class ArchitectLayoutLmScrtinyQuestionDetail extends Model
{
    protected $table="architect_layout_lm_scrunity_question_details";

    public function question()
    {
    return $this->belongsTo(\App\Layout\ArchitectLayoutLmScrtinyQuestionMaster::class,'architect_layout_lm_scrunity_question_master_id','id');
    }
}
