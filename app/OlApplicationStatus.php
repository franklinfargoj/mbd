<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlApplicationStatus extends Model
{
    protected $table = 'ol_application_status_log';
    protected $fillable = [
    	'application_id',
        'user_id',
        'role_id',
        'status_id',
        'to_user_id',
        'to_role_id',
        'remark'
    ];
}
