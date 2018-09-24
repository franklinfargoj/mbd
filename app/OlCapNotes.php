<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlCapNotes extends Model
{
	public $timestamps = true;
    protected $table = "ol_cap_notes";
    protected $fillable = [
        'application_id',
        'user_id',
        'document_path'
    ];
}
