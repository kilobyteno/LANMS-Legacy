<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsCategory extends Model
{
    use SoftDeletes, LogsActivity;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'slug',
        'creator_id',
    ];
    protected $table = 'news_categories';

    protected static $logName = 'news_category';
    protected static $logOnlyDirty = true;
    protected static $logAttributes = [
        'name',
        'slug',
    ];

    public function categories()
    {
        return $this->hasMany('News', 'category_id');
    }

    public function articles()
    {
        return $this->hasMany('News', 'category_id');
    }

    public function author()
    {
        return $this->hasOne('User', 'id', 'author_id')->withTrashed();
    }

    public function editor()
    {
        return $this->hasOne('User', 'id', 'editor_id')->withTrashed();
    }
}
