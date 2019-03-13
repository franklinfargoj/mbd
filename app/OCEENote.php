<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OCEENote extends Model
{
    protected $table = 'oc_ee_note';

    protected $fillable = [
        'user_id',
        'application_no',
        'document_path',
    ];
}
