<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class CrewCategory extends Model {

	protected $table = 'crew_categories';

	protected $fillable = [
		'title',
		'slug',
		'crew_id',
		'author_id',
		'editor_id',
		'active',
	];

	function crew() {
		return $this->hasMany('Crew', 'crewcategory_id', 'id');
	}

	function author() {
		return $this->hasOne('User', 'id', 'author_id');
	}

	function editor() {
		return $this->hasOne('User', 'id', 'editor_id');
	}

}
