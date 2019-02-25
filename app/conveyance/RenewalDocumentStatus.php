<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class RenewalDocumentStatus extends Model
{
	protected $table = 'renewal_document_status';
	public $timestamps = true;
    protected $fillable = [
        'application_id',
        'user_id',
        'society_flag',
        'status_id',
        'document_id',
        'document_path',
        'other_document_name',
    ];
}
