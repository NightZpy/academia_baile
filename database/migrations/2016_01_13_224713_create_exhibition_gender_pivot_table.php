<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExhibitionGenderPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exhibition_gender', function (Blueprint $table) {
            $table->integer('exhibition_id')->unsigned()->index();
            $table->foreign('exhibition_id')->references('id')->on('exhibitions')->onDelete('cascade');
            $table->integer('gender_id')->unsigned()->index();
            $table->foreign('gender_id')->references('id')->on('categories')->onDelete('cascade');
            $table->primary(['exhibition_id', 'gender_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('exhibition_gender');
    }
}
