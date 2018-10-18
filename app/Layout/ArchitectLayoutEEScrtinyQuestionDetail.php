<?php

namespace App\Layout;

use Illuminate\Database\Eloquent\Model;

class ArchitectLayoutEEScrtinyQuestionDetail extends Model
{
    protected $table = "architect_layout_ee_scrunity_question_details";

    public function question()
    {
        return $this->belongsTo(\App\Layout\ArchitectLayoutEEScrtinyQuestionMaster::class, 'architect_layout_ee_scrunity_question_master_id', 'id');
    }
}
