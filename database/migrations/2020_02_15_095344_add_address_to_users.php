<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('address_street')->nullable()->after('clothing_size');
            $table->string('address_postalcode')->nullable()->after('address_street');
            $table->string('address_city')->nullable()->after('address_postalcode');
            $table->string('address_county')->nullable()->after('address_city');
            $table->string('address_country')->nullable()->after('address_county');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
