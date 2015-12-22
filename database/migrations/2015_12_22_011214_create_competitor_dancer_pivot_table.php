<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitorDancerPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitor_dancer', function (Blueprint $table) {
            $table->integer('competitor_id')->unsigned()->index();
            // $table->foreign('competitor_id')->references('id')->on('competitors')->onDelete('cascade');
            $table->integer('dancer_id')->unsigned()->index();
            // $table->foreign('dancer_id')->references('id')->on('dancers')->onDelete('cascade');
            $table->primary(['competitor_id', 'dancer_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('competitor_dancer');
    }
}
