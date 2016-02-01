<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatReservationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seat_reservations', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('seat_id');
			$table->integer('reservedby_id');
			$table->integer('reservedfor_id');
			$table->integer('payment_id');
			$table->integer('ticket_id');
			$table->integer('status_id');

			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('seat_reservations');
	}

}
