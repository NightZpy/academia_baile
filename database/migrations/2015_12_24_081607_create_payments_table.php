<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount', 10, 2)->default(0.0);
            $table->string('reference_code', 128)->nullable();
            $table->datetime('date')->default(DB::raw('NOW()'));
            $table->string('voucher', 128)->nullable();
            $table->enum('status', ['accept', 'refuse', 'pending'])->default('pending');
            $table->integer('academy_id')->unsigned();
            $table->foreign('academy_id')->references('id')->on('academies');
            $table->integer('competitor_id')->nullable()->unsigned();
            $table->foreign('competitor_id')->references('id')->on('competitors');
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
        Schema::drop('payments');
    }
}
