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

    public function getStatusAttribute($value)
    {
        switch ($value) {
            case '1':
                return "New Application";
                break;
            case '2':
                return "Scrutiny Pending";
                break;
            case '3':
                return "ShortListed";
                break;
            case '4':
                return "Final";
                break;

            default:
                return "New Application";
                break;
        }
    }
}
