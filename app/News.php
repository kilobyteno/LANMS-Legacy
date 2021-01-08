<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class News extends Model
{
    use SoftDeletes, LogsActivity;

    protected $dates = ['deleted_at', 'published_at'];
    protected $fillable = [
        'title',
        'content',
        'slug',
        'published_at',
        'category_id',
        'creator_id',
        'editor_id',
        'active',
    ];
    protected $table = 'news';

    protected static $logName = 'article';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'title',
        'content',
        'slug',
        'published_at',
        'category_id',
        'active',
    ];

    public function category()
    {
        return $this->hasOne('NewsCategory', 'id', 'category_id');
    }

    public function author()
    {
        return $this->hasOne('User', 'id', 'author_id')->withTrashed();
    }

    public function editor()
    {
        return $this->hasOne('User', 'id', 'editor_id')->withTrashed();
    }

    public function scopeIsPublished($query)
    {
        return $query->where('published_at', '<', DB::raw('now()'))->orderBy('published_at', 'desc');
    }

    public function scopeIsActive($query)
    {
        return $query->where('active', '=', true)->orderBy('published_at', 'desc');
    }
}
