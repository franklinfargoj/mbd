<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RtiSendInfo extends Model
{
    public $table = "rti_send_info";

    protected $fillable = [
    	'application_id',
    	'rti_status_id',
    	'comment',
    	'filepath',
        'filename',
        'user_id'
    ];
    public function status_title()
    {
    	return $this->belongsTo(MasterRtiStatus::class,'rti_status_id','id');
    }

    public function user()
	{
		return $this->belongsTo(\App\User::class,'user_id','id');
	}
}
