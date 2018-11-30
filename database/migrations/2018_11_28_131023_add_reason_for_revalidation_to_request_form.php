<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReasonForRevalidationToRequestForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_request_form_details', function (Blueprint $table) {
            $table->string('reason_for_revalidation')->nullable();
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
            $table->dropColumn('reason_for_revalidation');
        });
    }
}
