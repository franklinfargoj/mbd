<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRenameResidentialNonResidentialScApplicationFormRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sc_application_form_request', function (Blueprint $table) {
            $table->renameColumn('residential_flat', 'no_of_residential_flat');
            $table->renameColumn('non_residential_flat', 'no_of_non_residential_flat');
            $table->renameColumn('total_flat', 'total_no_of_flat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sc_application_form_request', function (Blueprint $table) {
            $table->dropColumn(['residential_flat', 'non_residential_flat', 'total_flat']);
        });
    }
}
