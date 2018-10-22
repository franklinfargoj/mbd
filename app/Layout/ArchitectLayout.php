<?php

namespace App\Layout;

use Illuminate\Database\Eloquent\Model;

class ArchitectLayout extends Model
{
    protected $table="architect_layouts";

    protected $fillable=['layout_no','layout_name','address','added_date'];

    public function layout_details()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutDetail::class,'architect_layout_id','id');
    }

    public function ee_scrutiny_reports()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutScrutinyEEReport::class,'architect_layout_id','id');
    }

    public function em_scrutiny_reports()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutScrutinyEMReport::class,'architect_layout_id','id');
    }

    public function land_scrutiny_reports()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutScrutinyLandReport::class,'architect_layout_id','id');
    }

    public function ree_scrutiny_reports()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutScrutinyREEReport::class,'architect_layout_id','id');
    }

    public function ArchitectLayoutStatusLog()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutStatusLog::class,'architect_layout_id');
    }

    public function ArchitectLayoutStatusLogInLiosting()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutStatusLog::class,'architect_layout_id');
    }
    
    public function ee_scrutiny_checklist_and_remarks()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutEEScrtinyQuestionDetail::class,'architect_layout_id','id');
    }

    public function land_scrutiny_checklist_and_remarks()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutLmScrtinyQuestionDetail::class,'architect_layout_id','id');
    }

    public function em_scrutiny_checklist_and_remarks()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutEmScrtinyQuestionDetail::class,'architect_layout_id','id');
    }

    public function ree_scrutiny_checklist_and_remarks()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutReeScrtinyQuestionDetail::class,'architect_layout_id','id');
    }
    
}
