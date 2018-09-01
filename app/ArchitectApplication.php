<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class ArchitectApplication extends Model
{


    protected $table = "architect_application";

    public function marks()
    {
        return $this->hasMany(ArchitectApplicationMark::class);
    }

    public function statusLog()
    {
        return $this->hasMany(ArchitectApplicationStatusLog::class);
    }

    public function getMarksGrandTotal()
    {

    }
}
