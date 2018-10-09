<?php

namespace App\Layout;

use Illuminate\Database\Eloquent\Model;

class ArchitectLayoutCourtMatterDispute extends Model
{
    protected $table="architect_layout_detail_court_matters_or_disputes_on_land";

    public function architect_layout()
    {
        return $this->belongsTo(\App\Layout\ArchitectLayoutDetail::class,'architect_layout_detail_id','id');
    }
}
