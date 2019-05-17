<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAddServiceChargeToTypeScApplicationFormRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sc_application_form_request', function (Blueprint $table) {
            if(!Schema::hasColumn('sc_application_form_request', 'service_charge_type')){
                $table->string('service_charge_type')->after('tax_paid_to_MHADA_or_BMC')->nullable();
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
            if(Schema::hasColumn('sc_application_form_request', 'service_charge_type')){
                $table->dropColumn('service_charge_type');
            }
        });
    }
}
