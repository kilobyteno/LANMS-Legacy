<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compo', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('name');
            $table->string('slug');
            $table->string('description');
            $table->integer('page_id')->default(0);
            $table->string('challonge_subdomain');
            $table->string('challonge_url');
            $table->integer('year')->default(1970);

            $table->integer('type')->default(1); // 1;Brackets, 2;Submissions
            $table->integer('signup_type')->default(1); // 1;Team, 2;User
            $table->integer('signup_size')->default(1); // Max players per team (or invidual)

            $table->integer('author_id')->default(0); //who created it?
            $table->integer('editor_id')->default(0); //who updated it?

            $table->dateTime('start_at')->nullable();
            $table->dateTime('last_sign_up_at')->nullable();
            $table->dateTime('end_at')->nullable();
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
        Schema::dropIfExists('compo');
    }
}
