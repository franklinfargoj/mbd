<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchitectApplicationStatusLog extends Model
{
    protected $table = "architect_application_status_logs";

    public function architectApplication()
    {
        return $this->belongsTo(ArchitectApplication::class);
    }
}
