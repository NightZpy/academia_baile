<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDancerExhibitionPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dancer_exhibition', function (Blueprint $table) {
            $table->integer('dancer_id')->unsigned()->index();
            $table->foreign('dancer_id')->references('id')->on('dancers')->onDelete('cascade');
            $table->integer('exhibition_id')->unsigned()->index();
            $table->foreign('exhibition_id')->references('id')->on('exhibitions')->onDelete('cascade');
            $table->primary(['dancer_id', 'exhibition_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dancer_exhibition');
    }
}
