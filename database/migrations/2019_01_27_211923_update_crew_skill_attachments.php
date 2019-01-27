<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCrewSkillAttachments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('crew_skill_attached');
        
        Schema::create('crew_crew_skill', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('crew_id')->unsigned();
            $table->integer('crew_skill_id')->unsigned();
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
