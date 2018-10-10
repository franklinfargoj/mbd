<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resolution extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
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
        'keyword',
    ];

    public function board()
    {
        return $this->belongsTo('App\Board');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function resolutionType()
    {
        return $this->belongsTo('App\ResolutionType');
    }
}
