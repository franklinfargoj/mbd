<?php

namespace App\Layout;

use Illuminate\Database\Eloquent\Model;

class ArchitectLayoutEEScrtinyQuestionMaster extends Model
{
    protected $table = "architect_layout_ee_scrunity_question_master";

    public function details()
    {
        return $this->hasOne(ArchitectLayoutEEScrtinyQuestionDetail::class,'architect_layout_ee_scrunity_question_master_id','id');
    }
}
