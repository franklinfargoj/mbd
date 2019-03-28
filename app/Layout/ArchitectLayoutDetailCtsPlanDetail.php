<?php

namespace App\Layout;

use Illuminate\Database\Eloquent\Model;

class ArchitectLayoutDetailCtsPlanDetail extends Model
{
    protected $table="architect_layout_detail_cts_plan_details";

    public function pr_cards()
    {
        return $this->hasOne(\App\Layout\ArchitectLayoutDetailPrCardDetail::class,'architect_layout_detail_cts_plan_detail_id','id');
    }
}
