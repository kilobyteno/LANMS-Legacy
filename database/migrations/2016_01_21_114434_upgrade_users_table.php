<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpgradeUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			/*$table->dropColumn(['password_temp', 'code', 'arrived', 'reservedcount', 'address', 'active', 'ismod', 'isadmin', 'issuperadmin', 'remember_token', 'arrived', 'author_id']);

			// SENTINEL DB
			$table->text('permissions')->nullable();
			$table->timestamp('last_login')->nullable();
			$table->string('firstname')->nullable()->change();
			$table->string('lastname')->nullable()->change();

			$table->date('birthdate')->default('1970-01-01'); //YYYY-MM-DD
			$table->timestamp('last_activity')->nullable()->change();

			$table->string('profilepicture')->nullable()->change();
			$table->string('profilepicturesmall')->nullable()->change();
			$table->string('profilecover')->nullable();
			$table->string('referral')->nullable()->change();
			$table->string('referral_code');

			$table->string('userdateformat')->default('d. M Y')->change();
			$table->string('usertimeformat')->default('H:i')->change();

			$table->unique('email');*/

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			//
		});
	}

}
