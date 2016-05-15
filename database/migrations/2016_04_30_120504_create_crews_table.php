<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('crew', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('user_id');
			$table->integer('crewcategory_id');

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
		Schema::drop('crew');
	}

}
