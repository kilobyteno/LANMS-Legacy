<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('addresses', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('address1')->nullable();
			$table->string('address2')->nullable();
			$table->string('postalcode')->nullable();
			$table->string('city')->nullable();
			$table->string('county')->nullable();
			$table->string('country')->nullable();
			$table->boolean('main_address')->default(0);

			$table->integer('user_id')->default(0);

			$table->softDeletes();
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
		Schema::drop('addresses');
	}

}
