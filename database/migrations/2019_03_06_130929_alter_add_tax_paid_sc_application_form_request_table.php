<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAddTaxPaidScApplicationFormRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sc_application_form_request', function (Blueprint $table) {
            if (!Schema::hasColumn('sc_application_form_request', 'tax_paid_to_MHADA_or_BMC')){
                $table->string('tax_paid_to_MHADA_or_BMC')->nullable();
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
            if (Schema::hasColumn('sc_application_form_request', 'tax_paid_to_MHADA_or_BMC')){
                $table->dropColumn('tax_paid_to_MHADA_or_BMC');
            }
        });
    }
}
