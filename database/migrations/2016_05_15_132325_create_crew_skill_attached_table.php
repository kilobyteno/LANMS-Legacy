<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrewSkillAttachedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crew_skill_attached', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('user_id');
			$table->integer('skill_id');

			$table->integer('author_id'); //who created it?
			$table->integer('editor_id'); //who updated it?

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('crew_skill_attached');
	}

}
