<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeletedResolution extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'resolution_id',
        'resolution_type_id',
        'title',
        'description',
        'filepath',
        'filename',
        'reason_for_delete',
    ];
}
