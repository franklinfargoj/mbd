<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeletedHearing extends Model
{
    protected $table = "deleted_hearing";
    protected $primaryKey = 'id';
    protected $fillable = [
        'hearing_id',
        'case_number',
        'case_year',
        'appellant_name',
        'description',
        'final_judgement',
        'delete_reason'
    ];
}
