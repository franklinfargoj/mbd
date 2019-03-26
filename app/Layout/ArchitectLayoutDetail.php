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

    public function pr_card_details()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutDetailPrCardDetail::class,'architect_layout_detail_id','id');
    }

    public function ee_scrutiny_reports()
    {
        return $this->hasOne(\App\Layout\ArchitectLayoutEEScrtinyQuestionDetail::class,'architect_layout_detail_id','id');
    }

    public function ee_reports()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutDetailEEReport::class,'architect_layout_detail_id','id');
    }

    public function em_scrutiny_reports()
    {
        return $this->hasOne(\App\Layout\ArchitectLayoutEmScrtinyQuestionDetail::class,'architect_layout_detail_id','id');
    }

    public function em_reports()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutDetailEmReport::class,'architect_layout_detail_id','id');
    }

    public function land_scrutiny_reports()
    {
        return $this->hasOne(\App\Layout\ArchitectLayoutLmScrtinyQuestionDetail::class,'architect_layout_detail_id','id');
    }

    public function land_reports()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutDetailLandReport::class,'architect_layout_detail_id','id');
    }

    public function ree_scrutiny_reports()
    {
        return $this->hasOne(\App\Layout\ArchitectLayoutReeScrtinyQuestionDetail::class,'architect_layout_detail_id','id');
    }

    public function ree_reports()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutDetailREEReport::class,'architect_layout_detail_id','id');
    }

    public function ArchitectLayoutDetailDpRemark()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutDetailDpRemark::class,'architect_layout_detail_id','id');
    }

    public function ArchitectLayoutDetailCrzRemark()
    {
        return $this->hasMany(\App\Layout\ArchitectLayoutDetailCrzRemark::class,'architect_layout_detail_id','id');
    }

    public function layout_excel_and_note()
    {
        return $this->hasOne(\App\Layout\PrepareLayoutExcelLog::class,'architect_layout_detail_id','id');
    }
}
