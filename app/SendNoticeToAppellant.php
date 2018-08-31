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
        'comment'
    ];
}
