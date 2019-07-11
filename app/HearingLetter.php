<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HearingLetter extends Model
{

    protected $table = 'hearing_letter_documents';

    protected $primaryKey = 'id';

    protected $fillable = [
        'hearing_id',
        'document_path',
        'letter_type',
        'status_id',
        'user_id'
    ];
}