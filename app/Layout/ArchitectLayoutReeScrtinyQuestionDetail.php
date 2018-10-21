<?php

namespace App\Layout;

use Illuminate\Database\Eloquent\Model;

class ArchitectLayoutReeScrtinyQuestionDetail extends Model
{
    protected $table = "architect_layout_ree_scrunity_question_details";

    public function question()
    {
        return $this->belongsTo(\App\Layout\ArchitectLayoutReeScrtinyQuestionMaster::class, 'architect_layout_ree_scrunity_question_master_id', 'id');
    }
}
