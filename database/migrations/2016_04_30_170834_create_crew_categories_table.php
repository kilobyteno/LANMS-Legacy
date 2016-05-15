<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrewCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crew_categories', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('title');
			$table->string('slug');

			$table->integer('author_id'); //who created it?
			$table->integer('editor_id'); //who updated it?
			$table->enum('active', array(0, 1))->default(1); //is it visible on the website?

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
		Schema::drop('crew_categories');
	}

}
