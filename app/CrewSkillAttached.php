<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CrewSkillAttached extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $table = 'crew_skill_attached';

	protected $fillable = [
		'user_id',
		'skill_id',
		'year',
		'author_id',
		'editor_id',
	];

	function skill() {
		return $this->hasMany('CrewSkill', 'id', 'skill_id');
	}

	function author() {
		return $this->hasOne('User', 'id', 'author_id');
	}

	function editor() {
		return $this->hasOne('User', 'id', 'editor_id');
	}

}
