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
}
