<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDancersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dancers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128);
            $table->string('last_name', 128);
            $table->string('ci', 16);
            $table->date('bird_date');
            $table->string('photo', 128)->nullable();
            $table->boolean('independent')->default(false);
            $table->boolean('director')->default(false);
            $table->integer('academy_id')->nullable();
            //$table->foreign('academy_id')->references('id')->on('academies_participants');
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
        Schema::drop('dancers');
    }
}
