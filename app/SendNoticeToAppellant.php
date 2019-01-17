<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendNoticeToAppellant extends Model
{
    protected $table = "send_notice_to_appellant";
    protected $primaryKey = 'id';
    protected $fillable = [
        'hearing_id',
        'upload_notice',
        'comment',
        'user_id',
        'upload_notice_filename'
    ];

    public function userDetails(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
