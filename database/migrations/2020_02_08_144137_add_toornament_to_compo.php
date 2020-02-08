<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToornamentToCompo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('compo', function (Blueprint $table) {
            $table->bigInteger('toornament_id')->nullable()->after('challonge_url');
            $table->bigInteger('toornament_stage_id')->nullable()->after('toornament_id');
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
