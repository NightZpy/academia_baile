<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRulesFieldsToConfigurationsTable extends Migration {

    /**
     * Make changes to the table.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configurations', function(Blueprint $table) {

            $table->string('rules_file_name')->nullable();
            $table->integer('rules_file_size')->nullable()->after('rules_file_name');
            $table->string('rules_content_type')->nullable()->after('rules_file_size');
            $table->timestamp('rules_updated_at')->nullable()->after('rules_content_type');

        });

    }

    /**
     * Revert the changes to the table.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('configurations', function(Blueprint $table) {

            $table->dropColumn('rules_file_name');
            $table->dropColumn('rules_file_size');
            $table->dropColumn('rules_content_type');
            $table->dropColumn('rules_updated_at');

        });
    }

}