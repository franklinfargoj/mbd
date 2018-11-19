<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnFromScApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::table('sc_application', function (Blueprint $table) {
            $table->dropColumn('draft_conveyance_application');
            $table->dropColumn('stamp_conveyance_application');
            $table->dropColumn('resolution');
            $table->dropColumn('undertaking');
            $table->dropColumn('sale_sub_register_name');
            $table->dropColumn('sale_registeration_year');
            $table->dropColumn('sale_registeration_no');
            $table->dropColumn('lease_sub_register_name');
            $table->dropColumn('lease_registeration_year');
            $table->dropColumn('lease_registeration_no');
            $table->dropColumn('service_charge_receipt');
            $table->dropColumn('drafted_no_dues_certificate');
            $table->dropColumn('text_no_dues_certificate');
            $table->dropColumn('uploaded_no_dues_certificate');
            $table->dropColumn('em_covering_letter');
            $table->dropColumn('bonafide_list');
            $table->dropColumn('noc_conveyance');
            $table->dropColumn('architect_conveyance_map');
            $table->dropColumn('is_allotement_available');
            $table->dropColumn('is_society_resolution');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sc_application', function (Blueprint $table) {
            $table->string('draft_conveyance_application');
            $table->string('stamp_conveyance_application');
            $table->string('resolution');
            $table->string('undertaking');
            $table->string('sale_sub_register_name');
            $table->string('sale_registeration_year');
            $table->string('sale_registeration_no');
            $table->string('lease_sub_register_name');
            $table->string('lease_registeration_year');
            $table->string('lease_registeration_no');
            $table->string('service_charge_receipt');
            $table->string('drafted_no_dues_certificate');
            $table->string('text_no_dues_certificate');
            $table->string('uploaded_no_dues_certificate');
            $table->string('em_covering_letter');
            $table->string('bonafide_list');
            $table->string('noc_conveyance');
            $table->string('architect_conveyance_map');
            $table->string('is_allotement_available');
            $table->string('is_society_resolution');
        });
    }
}
