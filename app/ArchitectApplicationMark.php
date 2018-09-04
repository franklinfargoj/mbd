<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchitectApplicationMark extends Model
{
    protected $table = "architect_application_marks";

    protected $fillable = array('id','architect_application_id','document_name','document_path','marks','remark','final_certificate');

    public function architectApplication()
    {
        return $this->belongsTo(ArchitectApplication::class);
    }
}
