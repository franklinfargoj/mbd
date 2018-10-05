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

    public function getApplicationStatusAttribute($value)
    {
        switch ($value) {
            case 0:
                return "None";
                break;
            case 1:
                return "Shortlisted";
                break;
            case 2:
                return "Final";
                break;
            default:
                return "None";
                break;
        }
    }

    public function ArchitectApplicationStatusForLoginListing()
    {
        return $this->hasMany('App\ArchitectApplicationStatusLog', 'architect_application_id', 'id');
    }
}
