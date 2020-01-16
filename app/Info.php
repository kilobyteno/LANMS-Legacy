<?php

namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Info extends Model
{
    use SoftDeletes, LogsActivity;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'content',
        'description',
        'author_id',
        'editor_id',
    ];
    protected $table = 'info';

    protected static $logName = 'info';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'content',
    ];

    public function author()
    {
        return $this->hasOne('User', 'id', 'author_id');
    }

    public function editor()
    {
        return $this->hasOne('User', 'id', 'editor_id');
    }

    public function scopeGetContent($query, $name)
    {
        $info = $query->where('name', '=', $name)->first();
        return $info->content;
    }
}
