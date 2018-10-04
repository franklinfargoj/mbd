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
            case '1':
                return "New Application";
                break;
            case '2':
                return "Scrutiny Pending";
                break;
            case '3':
                return "Forward";
                break;
            case '4':
                return "ShortListed";
                break;
            case '5':
                return "Final";
                break;
            default:
                return "New Application";
                break;
        }
    }

    public function ArchitectApplicationStatusForLoginListing()
    {
        return $this->hasMany('App\ArchitectApplicationStatusLog', 'architect_application_id', 'id');
    }
}
