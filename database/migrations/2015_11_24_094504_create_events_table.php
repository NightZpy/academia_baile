<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 128);
            $table->string('slogan', 256)->nullable();
            $table->text('description')->nullable();
            $table->string('logo', 128);
            $table->string('phone', 128);
            $table->string('email', 128);
            $table->text('address');
            $table->string('facebook', 128)->unique();
            $table->string('twitter', 128)->unique();
            $table->string('instagram', 128)->unique();
            
            $table->integer('estate_id')->length(11)->unsigned();
            // $table->foreign('estate_id')->references('id')->on('estates')->onUpdate('cascade')->onDelete('cascade');
            
            $table->integer('municipality_id')->length(11)->unsigned();
            // $table->foreign('municipality_id')->references('id')->on('municipalities')->onUpdate('cascade')->onDelete('cascade');
            
            $table->integer('parish_id')->length(11)->unsigned()->nullable();
            // $table->foreign('parish_id')->references('id')->on('parishes')->onUpdate('cascade')->onDelete('cascade');
            
            $table->integer('city_id')->length(11)->unsigned()->nullable();
            // $table->foreign('city_id')->references('id')->on('cities')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::drop('events');
    }
}
