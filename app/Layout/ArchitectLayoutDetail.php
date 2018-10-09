<?php

namespace App\Layout;

use Illuminate\Database\Eloquent\Model;

class ArchitectLayoutDetail extends Model
{
    protected $table="architect_layout_details";

    public function architect_layout()
    {
        return $this->belongsTo(\App\Layout\ArchitectLayout::class,'architect_layout_id','id');
    }

    public function layout_detail_court_matter_or_dispute()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutCourtMatterDispute::class,'architect_layout_detail_id','id');
    }

    public function cts_plan_details()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutDetailCtsPlanDetail::class,'architect_layout_detail_id','id');
    }

    public function ee_reports()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutDetailEEReport::class,'architect_layout_detail_id','id');
    }

    public function em_reports()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutDetailEmReport::class,'architect_layout_detail_id','id');
    }
}
