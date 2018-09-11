<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrePostSchedule extends Model
{
    protected $table = "pre_post_schedule";
    protected $primaryKey = 'id';
    protected $fillable = [
        'hearing_id',
        'date',
        'description',
        'pre_post_status',
        'hearing_schedule_id',
    ];
}
