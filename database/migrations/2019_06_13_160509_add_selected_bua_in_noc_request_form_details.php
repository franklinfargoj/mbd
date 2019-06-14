<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSelectedBuaInNocRequestFormDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('noc_request_form_details', function (Blueprint $table) {
            if (!Schema::hasColumn('noc_request_form_details', 'selected_bua')){
                $table->string('selected_bua')->after('percent_bua')->nullable();
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
        Schema::table('noc_request_form_details', function (Blueprint $table) {
            if (Schema::hasColumn('noc_request_form_details', 'selected_bua')){
                $table->dropColumn('selected_bua');
            }
        });
    }
}
