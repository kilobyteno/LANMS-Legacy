<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class CrewSkill extends Model {

	protected $table = 'crew_skills';

	protected $fillable = [
		'title',
		'slug',
		'icon',
		'label',
	];

}
