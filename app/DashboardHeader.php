<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

Class DashboardHeader extends Model
{
    protected $table = "dashboard_header";

    protected $fillable = [
        'header_name',
        'role_id',
        'is_top'
    ];
}
