<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAddServiceChargeScApplicationFormRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sc_application_form_request', function (Blueprint $table) {
            if (!Schema::hasColumn('sc_application_form_request', 'service_charge')){
                $table->string('service_charge')->nullable();
            }
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
            if (Schema::hasColumn('sc_application_form_request', 'service_charge')){
                $table->dropColumn('service_charge');
            }
        });
    }
}
