<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApplnMasterIdAlterScRegistrationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sc_registration_details', function (Blueprint $table) {
            $table->integer('application_type_id')->nullable()->after('registration_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sc_registration_details', function (Blueprint $table) {
            $table->dropColumn('application_type_id');
        });
    }
}
