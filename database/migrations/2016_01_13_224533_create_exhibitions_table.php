<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExhibitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exhibitions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128);
            $table->string('song_name', 128)->nullable();
            $table->string('song', 128)->nullable();
            $table->integer('event_edition_id')->unsigned();
            $table->foreign('event_edition_id')->references('id')->on('event_editions');
            $table->integer('academy_id')->unsigned();
            $table->foreign('academy_id')->references('id')->on('academies');
            $table->unique(['academy_id', 'event_edition_id', 'name'], 'exhibitions_unique_key');
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
        Schema::drop('exhibitions');
    }
}
