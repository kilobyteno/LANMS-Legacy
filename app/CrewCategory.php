<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class CrewCategory extends Model {

	protected $table = 'crew_categories';

	protected $fillable = [
		'title',
		'slug',
		'crew_id',
		'active',
	];

	function crew() {
		return $this->hasMany('Crew', 'crewcategory_id', 'id');
	}

}
