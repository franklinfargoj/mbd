<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HearingSupportDocuments extends Model
{

    protected $table = 'hearing_support_documents';

    protected $primaryKey = 'id';

    protected $fillable = [
        'hearing_id',
        'document_path',
        'hearing_user_id',
        'document_name'
    ];
}