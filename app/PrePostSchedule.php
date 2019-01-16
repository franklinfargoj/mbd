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
        'user_id',
    ];

    public function userDetails(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }     
}
