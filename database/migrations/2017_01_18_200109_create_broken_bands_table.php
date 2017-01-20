<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrokenBandsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('broken_bands', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('checkin_id');
			$table->integer('previous_bandnumber');
			$table->integer('new_bandnumber');
			$table->integer('year');

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
		Schema::drop('broken_bands');
	}

}
