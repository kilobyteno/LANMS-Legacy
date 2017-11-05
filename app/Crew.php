<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Crew extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $table = 'crew';

	protected $fillable = [
		'user_id',
		'category_id',
	];

	function category() {
		return $this->hasOne('CrewCategory', 'id', 'category_id');
	}

	function user() {
		return $this->hasOne('User', 'id', 'user_id');
	}

	function skillattached() {
		return $this->hasMany('CrewSkillAttached', 'user_id', 'id');
	}

}
