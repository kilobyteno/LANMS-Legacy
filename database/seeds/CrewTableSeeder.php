<?php

use Illuminate\Database\Seeder;
use LANMS\Crew;
use LANMS\CrewCategory;
use LANMS\CrewSkill;
use LANMS\CrewSkillAttached;

class CrewTableSeeder extends Seeder  {

	public function run() {

		Crew::create([
			'user_id' 		=> 1,
			'category_id' 	=> 1,
		]);

		Crew::create([
			'user_id' 		=> 2,
			'category_id' 	=> 2,
		]);

		Crew::create([
			'user_id' 		=> 3,
			'category_id' 	=> 2,
		]);

		CrewCategory::create([
			'title' 	=> 'Core',
			'slug' 		=> 'core',
		]);

		CrewCategory::create([
			'title' 	=> 'Crew',
			'slug' 		=> 'crew',
		]);

		CrewSkill::create([
			'title' 	=> 'Admin',
			'slug' 		=> 'admin',
			'icon' 		=> 'fa fa-user-secret',
			'label' 	=> 'label label-primary',
		]);

		CrewSkill::create([
			'title' 	=> 'Network',
			'slug' 		=> 'network',
			'icon' 		=> 'fa fa-wifi',
			'label' 	=> 'label label-success',
		]);

		CrewSkill::create([
			'title' 	=> 'Security',
			'slug' 		=> 'security',
			'icon' 		=> 'fa fa-lock',
			'label' 	=> 'label label-warning',
		]);

		CrewSkillAttached::create([
			'user_id' 	=> 1,
			'skill_id' 	=> 1,
		]);

		CrewSkillAttached::create([
			'user_id' 	=> 1,
			'skill_id' 	=> 2,
		]);

		CrewSkillAttached::create([
			'user_id' 	=> 1,
			'skill_id' 	=> 3,
		]);

		CrewSkillAttached::create([
			'user_id' 	=> 2,
			'skill_id' 	=> 2,
		]);

		CrewSkillAttached::create([
			'user_id' 	=> 2,
			'skill_id' 	=> 3,
		]);

		CrewSkillAttached::create([
			'user_id' 	=> 3,
			'skill_id' 	=> 3,
		]);

	}
}