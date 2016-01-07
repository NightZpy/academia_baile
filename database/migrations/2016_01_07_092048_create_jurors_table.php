<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJurorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128);
            $table->string('last_name', 128);
            $table->enum('gender', ['m', 'f'])->default('f');
            $table->string('ci', 10);
            $table->date('birth_date');
            $table->string('email', 128)->nullable()->unique();
            $table->string('phone', 24)->nullable();
            $table->string('photo', 128)->nullable();
            $table->string('facebook', 128)->nullable()->unique();
            $table->string('twitter', 128)->nullable()->unique();
            $table->string('instagram', 128)->nullable()->unique();
            $table->text('biography');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('jurors');
    }
}
