<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsCategory extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'slug',
        'creator_id',
    ];
    protected $table = 'news_categories';

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
