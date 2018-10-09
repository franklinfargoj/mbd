<?php

namespace App\Layout;

use Illuminate\Database\Eloquent\Model;

class ArchitectLayout extends Model
{
    protected $table="architect_layouts";

    public function layout_details()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutDetail::class,'architect_layout_id','id');
    }

    public function ee_scrutiny_reports()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutDetailScrutinyEEReport::class,'architect_layout_id','id');
    }

    public function em_scrutiny_reports()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutDetailEmReport::class,'architect_layout_id','id');
    }
    
}
