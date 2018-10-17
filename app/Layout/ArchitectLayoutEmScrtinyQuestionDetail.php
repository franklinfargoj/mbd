<?php

namespace App\Layout;

use Illuminate\Database\Eloquent\Model;

class ArchitectLayoutEmScrtinyQuestionDetail extends Model
{
    protected $table="architect_layout_em_scrunity_question_details";

    public function question()
    {
    return $this->belongsTo(\App\Layout\ArchitectLayoutEmScrtinyQuestionMaster::class,'architect_layout_em_scrunity_question_master_id','id');
    }
}
