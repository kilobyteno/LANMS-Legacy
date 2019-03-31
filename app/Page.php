<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Page extends Model
{
    use SoftDeletes, LogsActivity;

    protected $dates = ['deleted_at'];
    protected $table = 'pages';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'active',
    ];

    protected static $logName = 'page';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'title',
        'slug',
        'content',
        'active',
    ];

    public function author()
    {
        return $this->hasOne('User', 'id', 'author_id');
    }

    public function editor()
    {
        return $this->hasOne('User', 'id', 'editor_id');
    }

    public function scopeForMenu($query)
    {
        return $this->where('active', '=', 1)->where('showinmenu', '=', 1)->get();
    }
}
