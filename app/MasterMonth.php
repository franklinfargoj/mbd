<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterMonth extends Model
{
    public $table = "master_month";
    protected $fillable = [
    	'month_name'
    ];
}
