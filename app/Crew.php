<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class Crew extends Model {

	protected $table = 'crew';

	protected $fillable = [
		'user_id',
		'active',
	];

	function category() {
		return $this->hasOne('CrewCategory', 'id', 'crewcategory_id');
	}

	function user() {
		return $this->hasOne('User', 'id', 'user_id');
	}

	function skillattached() {
		return $this->hasMany('CrewSkillAttached', 'user_id', 'id');
	}

}
