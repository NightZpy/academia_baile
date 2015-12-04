<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_participants', function (Blueprint $table) {
            $table->boolean('active')->default(false);
            $table->string('bank_reference', 64)->nullable();
            $table->string('activation_code', 64);
            $table->integer('academie_participant_id')->unsigned()->index();
            $table->foreign('academie_participant_id')->references('id')->on('academies_participants')->onDelete('cascade');
            $table->integer('event_edition_id')->unsigned()->index();
            $table->foreign('event_edition_id')->references('id')->on('event_editions')->onDelete('cascade');
            $table->primary(['academie_participant_id', 'event_edition_id'], 'academies_participant_event_edition_primary');
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
        Schema::drop('event_participants');
    }
}
