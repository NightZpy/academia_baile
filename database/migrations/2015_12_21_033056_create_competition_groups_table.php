<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dancer_id')->unsigned();
            $table->integer('competition_category_id')->unsigned();
            $table->integer('event_edition_id')->unsigned();
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
        Schema::drop('competition_groups');
    }
}
