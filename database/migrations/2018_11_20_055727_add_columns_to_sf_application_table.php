<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToSfApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sf_applications', function (Blueprint $table) {
            $table->integer('sc_application_master_id')->nullable();
            $table->integer('layout_id')->nullable();
            $table->string('society_name')->nullable();
            $table->integer('building_no')->nullable();
            $table->string('proposed_society_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sf_applications', function (Blueprint $table) {
            $table->dropColumn('sc_application_master_id');
            $table->dropColumn('layout_id');
            $table->dropColumn('society_name');
            $table->dropColumn('building_no');
            $table->dropColumn('proposed_society_name');
        });
    }
}
