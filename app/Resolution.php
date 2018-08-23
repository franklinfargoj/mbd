<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resolution extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'board_id',
        'department_id',
        'resolution_type_id',
        'resolution_code',
        'title',
        'description',
        'filepath',
        'filename',
        'language',
        'reference_link',
        'published_date',
        'revision_log_message',
    ];

    public function department()
    {
        return $this->belongsTo('App\Department');
    }
}
