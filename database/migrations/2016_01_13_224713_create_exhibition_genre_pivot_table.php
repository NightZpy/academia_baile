<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExhibitionGenrePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exhibition_genre', function (Blueprint $table) {
            $table->integer('exhibition_id')->unsigned()->index();
            $table->foreign('exhibition_id')->references('id')->on('exhibitions')->onDelete('cascade');
            $table->integer('genre_id')->unsigned()->index();
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
            $table->primary(['exhibition_id', 'genre_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('exhibition_genre');
    }
}
