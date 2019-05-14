<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlNoDueCertificateDetails extends Model
{
    protected $table = 'ol_no_due_certificate_details';
    protected $fillable = [
        'application_id',
        'user_id',
        'question_id',
        'answer',
        'remark',
        'no_due_certificate',
    ];
}
