<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompoSignUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compo_sign_ups', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('compo_id');
            $table->integer('user_id');
            $table->integer('team_id')->nullable();

            $table->integer('year')->default(1970);

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
        Schema::dropIfExists('compo_sign_ups');
    }
}
