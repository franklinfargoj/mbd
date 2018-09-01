<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchitectApplicationMark extends Model
{
    protected $table = "architect_application_marks";

    public function architectApplication()
    {
        return $this->belongsTo(ArchitectApplication::class);
    }
}
