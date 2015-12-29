<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('price', 10, 0)->default(0);
            $table->integer('min_quantity')->unsigned()->default(1);
            $table->integer('max_quantity')->unsigned()->default(100);
            $table->integer('category_id')->unsigned();
            $table->integer('level_id')->unsigned();
            $table->integer('competition_type_id')->unsigned();
            $table->unique(['category_id', 'level_id', 'competition_type_id'], 'competition_categories_unique_key');
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
	    Schema::dropUnique('competition_categories_unique_key');
        Schema::drop('competition_categories');
    }
}
