<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('song', 128)->nullable();
            $table->string('song_name', 128)->nullable();
            $table->integer('academy_id')->unsigned();
            $table->integer('competition_category_id')->unsigned();
            $table->integer('event_edition_id')->unsigned();
            $table->unique(['academy_id', 'competition_category_id', 'event_edition_id', 'name'], 'competitors_unique_key');
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
        Schema::drop('competitors');
    }
}
