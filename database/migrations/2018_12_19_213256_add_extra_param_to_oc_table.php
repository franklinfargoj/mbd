<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraParamToOcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('oc_applications', function (Blueprint $table) {
            $table->integer('ee_scrutiny_completed')->nullable();
            $table->string('ee_office_note_oc')->nullable();
            $table->string('ee_additional_remarks')->nullable();
            $table->string('no_dues_certificate_draft')->nullable();
            $table->string('no_dues_certificate_text')->nullable();
            $table->string('em_office_note_oc')->nullable();
            $table->string('ree_office_note_oc')->nullable();
            $table->integer('OC_Generation_status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('oc_applications', function (Blueprint $table) {
            $table->dropColumn(['ee_scrutiny_completed','ee_office_note_oc','ee_additional_remarks','no_dues_certificate_text','no_dues_certificate_draft','em_office_note_oc','ree_office_note_oc','OC_Generation_status']);
        });
    }
}
