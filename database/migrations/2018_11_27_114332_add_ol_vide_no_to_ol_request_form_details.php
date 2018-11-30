<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOlVideNoToOlRequestFormDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_request_form_details', function (Blueprint $table) {
            $table->string('ol_vide_no');
            $table->date('ol_issue_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ol_request_form_details', function (Blueprint $table) {
            $table->dropColumn('ol_vide_no');
            $table->dropColumn('ol_issue_date');
        });
    }
}
