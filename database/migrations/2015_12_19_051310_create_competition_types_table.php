<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128)->unique();
            $table->integer('quantity')->unsigned()->default(2);
            $table->integer('min_quantity')->unsigned()->default(1);
            $table->integer('max_quantity')->unsigned()->default(100);
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
        Schema::drop('competition_types');
    }
}
