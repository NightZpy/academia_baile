<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddVoucherFieldsToPaymentsTable extends Migration {

    /**
     * Make changes to the table.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function(Blueprint $table) {

            $table->string('voucher_file_name')->nullable();
            $table->integer('voucher_file_size')->nullable()->after('voucher_file_name');
            $table->string('voucher_content_type')->nullable()->after('voucher_file_size');
            $table->timestamp('voucher_updated_at')->nullable()->after('voucher_content_type');

        });

    }

    /**
     * Revert the changes to the table.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function(Blueprint $table) {

            $table->dropColumn('voucher_file_name');
            $table->dropColumn('voucher_file_size');
            $table->dropColumn('voucher_content_type');
            $table->dropColumn('voucher_updated_at');

        });
    }

}