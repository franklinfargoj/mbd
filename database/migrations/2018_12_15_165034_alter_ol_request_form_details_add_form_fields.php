<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOlRequestFormDetailsAddFormFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_request_form_details', function (Blueprint $table) {
            $table->string('offer_letter_number')->nullable();
            $table->string('offer_letter_date')->nullable();
            $table->string('revised_offer_letter_number')->nullable();
            $table->string('revised_offer_letter_date')->nullable();
            $table->string('noc_for_iod_purpose_number')->nullable();
            $table->string('noc_for_iod_purpose_date')->nullable();
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
            $table->dropColumn(['offer_letter_number', 'offer_letter_date', 'revised_offer_letter_number', 'revised_offer_letter_date', 'noc_for_iod_purpose_number', 'noc_for_iod_purpose_date']);
        });
    }
}
