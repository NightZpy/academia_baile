<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSongFieldsToCompetitorsTable extends Migration {

    /**
     * Make changes to the table.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('competitors', function(Blueprint $table) {

            $table->string('song_file_name')->nullable();
            $table->integer('song_file_size')->nullable()->after('song_file_name');
            $table->string('song_content_type')->nullable()->after('song_file_size');
            $table->timestamp('song_updated_at')->nullable()->after('song_content_type');

        });

    }

    /**
     * Revert the changes to the table.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competitors', function(Blueprint $table) {

            $table->dropColumn('song_file_name');
            $table->dropColumn('song_file_size');
            $table->dropColumn('song_content_type');
            $table->dropColumn('song_updated_at');

        });
    }

}