<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterLayout extends Model
{
    protected $table = 'master_layout';

    public function layoutuser(){
        return $this->hasMany('App\LayoutUser', 'layout_id','id');
    }
}
