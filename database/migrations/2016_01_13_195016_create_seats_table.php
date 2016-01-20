<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seats', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->string('name');
			$table->string('slug');
			$table->integer('row_id');
			$table->integer('status_id')->default(0);

			$table->integer('used_by'); //who sits here?
            $table->integer('reserved_by'); //who reserved this seat?
            $table->integer('paid_by'); //who paid it?

            $table->integer('creator_id'); //who created it?
			$table->integer('author_id'); //who updated it?
			
			$table->timestamp('reserved_at'); //when was it reserved?
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
		Schema::drop('seats');
	}

}
