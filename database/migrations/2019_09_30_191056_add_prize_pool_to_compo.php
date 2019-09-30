<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrizePoolToCompo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('compo', function (Blueprint $table) {
            $table->integer('prize_pool_total')->nullable()->after('signup_size');
            $table->string('prize_pool_first')->nullable()->after('prize_pool_total');
            $table->string('prize_pool_second')->nullable()->after('prize_pool_first');
            $table->string('prize_pool_third')->nullable()->after('prize_pool_second');
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
