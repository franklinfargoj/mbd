<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConstructionDetailsToRequestForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_request_form_details', function (Blueprint $table) {
            $table->string('construction_details')->nullable();
            $table->boolean('is_full_oc')->default(0);
            $table->string('date_of_meeting')->nullable()->change();
            $table->string('resolution_no')->nullable()->change();
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
            $table->dropColumn('construction_details');
            $table->dropColumn('is_full_oc');
            $table->string('date_of_meeting')->change();
            $table->string('resolution_no')->change();
        });
    }
}
