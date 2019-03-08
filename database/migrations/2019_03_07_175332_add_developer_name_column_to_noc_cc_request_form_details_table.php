<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeveloperNameColumnToNocCcRequestFormDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('noc_cc_request_form_details', function (Blueprint $table) {
            $table->string('developer_name')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('noc_cc_request_form_details', function (Blueprint $table) {
            $table->dropColumn('developer_name');
        });
    }
}
