<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAddNatureOfBuildingScApplicationFormRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sc_application_form_request', function (Blueprint $table) {
            if (!Schema::hasColumn('sc_application_form_request', 'nature_of_building')){
                $table->string('nature_of_building')->nullable();
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
            if (Schema::hasColumn('sc_application_form_request', 'nature_of_building')){
                $table->dropColumn('nature_of_building');
            }
        });
    }
}
