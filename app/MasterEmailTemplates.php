<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterEmailTemplates extends Model
{
    protected $fillable = [
    	'type','body'
    ];
}
