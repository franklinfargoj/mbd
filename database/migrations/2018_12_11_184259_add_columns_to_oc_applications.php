<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToOcApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('oc_applications', function (Blueprint $table) {
            $table->integer('request_form_id')->after('society_id');
            $table->unsignedInteger('user_id')->after('id');
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
            $table->dropColumn('request_form_id');
            $table->dropColumn('user_id');
        });
    }
}
