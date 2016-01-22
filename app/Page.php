<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

	protected $table = 'pages';

	protected $fillable = [
		'title',
		'slug',
		'content',
	];

}
