<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HearingStatusLog extends Model
{
    protected $table = "hearing_status_log";

    public function hearingStatus()
    {
        return $this->hasOne('App\HearingStatus', 'id', 'hearing_status_id');
    }
}
