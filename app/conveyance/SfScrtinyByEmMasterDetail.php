<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class SfScrtinyByEmMasterDetail extends Model
{
    protected $table="sf_scrutiny_master_by_em_details";

    public function question()
    {
        return $this->belongsTo(\App\conveyance\SfScrtinyByEmMaster::class, 'sf_scrutiny_master_by_em_id', 'id');
    }
}
