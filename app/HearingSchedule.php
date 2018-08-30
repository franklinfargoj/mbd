<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HearingSchedule extends Model
{
    protected $table = "hearing_schedule";
    protected $primaryKey = 'id';
    protected $fillable = [
        'preceding_number',
        'preceding_time',
        'preceding_date',
        'description',
        'case_template',
        'update_status',
        'update_supporting_documents',
        'hearing_id'
    ];
}
