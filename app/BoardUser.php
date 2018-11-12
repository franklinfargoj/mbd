<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardUser extends Model
{
    protected $table = "board_user";

    protected $fillable = [
        'board_id',
        'user_id'
    ];
}
