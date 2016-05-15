<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class CrewSkillAttached extends Model {

	protected $table = 'crew_skill_attached';

	protected $fillable = [
		'user_id',
		'skill_id',
	];

	function skill() {
		return $this->hasMany('CrewSkill', 'id', 'skill_id');
	}

}
