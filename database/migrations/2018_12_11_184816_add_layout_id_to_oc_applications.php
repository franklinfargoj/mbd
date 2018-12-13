<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLayoutIdToOcApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('oc_applications', function (Blueprint $table) {
            $table->unsignedInteger('layout_id')->after('society_id');
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
            $table->dropColumn('layout_id');
        });
    }
}
