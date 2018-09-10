<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HearingStatus extends Model
{
    protected $table = "hearing_status";
    protected $primaryKey = 'id';
    protected $fillable = [
        'status_title'
    ];
}
