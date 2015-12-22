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
            $table->char('gender', 1)->default('f');
            $table->string('ci', 16);
            $table->date('birth_date');
            $table->string('email', 128)->nullable()->unique();
            $table->string('phone', 24)->nullable();
            $table->string('photo', 128)->nullable();
            $table->string('facebook', 128)->nullable()->unique();
            $table->string('twitter', 128)->nullable()->unique();
            $table->string('instagram', 128)->nullable()->unique();
            $table->boolean('independent')->default(false);
            $table->boolean('director')->default(false);
            $table->integer('academy_id')->nullable();
            //$table->foreign('academy_id')->references('id')->on('academies');
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
