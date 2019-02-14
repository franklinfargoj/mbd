<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mailMsgSentDetails extends Model
{
	protected $table = 'mail_msg_sent_details';
	public $timestamps = true;
    protected $fillable = [
        'id',
        'user_id',
        'mobile_no',
        'mail_id',
        'msg_content',
        'mail_content',
        'is_delivered',
        'status',
    ];
}
