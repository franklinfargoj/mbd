<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DiscardNocphaseapp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $to_discard_tables = array('noc_applications','noc_application_status_log','noc_cc_applications','noc_cc_application_status_log','noc_cc_request_form_details','noc_cc_society_document_comment','noc_cc_society_document_status','noc_request_form_details','noc_scrutiny_answers','noc_society_document_comment');
        foreach($to_discard_tables as $table) {
            DB::table($table)->truncate();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
