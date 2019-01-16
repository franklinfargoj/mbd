<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForwardCase extends Model
{
    protected $table = "forward_case";
    protected $primaryKey = 'id';
    protected $fillable = [
        'board_id',
        'department_id',
        'description',
        'hearing_id',
        'user_id'
    ];
}
