<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class ConveyanceArchitectNote extends Model
{
    protected $table = 'conveyance_architect_note';
	public $timestamps = true;
    protected $fillable = [
        'application_id',
        'user_id',
        'id',
        'document_path'
    ];
}
