<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademiesParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academies_participants', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 64)->unique();
            $table->string('address', 256)->nullable();
            $table->text('description')->nullable();
            $table->date('foundation')->nullable();
            $table->string('logo', 128)->nullable();
            $table->string('email', 128)->unique();
            $table->string('phone', 24);
            $table->string('facebook', 128)->unique();
            $table->string('twitter', 128)->unique();
            $table->string('instagram', 128)->unique();
            
            $table->integer('estate_id')->length(11)->unsigned();
            // $table->foreign('estate_id')->references('id')->on('estates')->onDelete('cascade')->onUpdate('cascade');
            
            $table->integer('municipality_id')->length(11)->unsigned();
            // $table->foreign('municipality_id')->references('id')->on('municipalities')->onDelete('cascade')->onUpdate('cascade');
            
            $table->integer('parish_id')->length(11)->unsigned()->nullable();
            // $table->foreign('parish_id')->references('id')->on('parishes')->onDelete('cascade')->onUpdate('cascade');
            
            $table->integer('city_id')->length(11)->unsigned()->nullable();
            // $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');
            
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
        Schema::drop('academies_participants');
    }
}
