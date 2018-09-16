<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoleIdToApplicationStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_application_status_log', function (Blueprint $table) {
            $table->integer('user_id')->nullable()->change();
            $table->integer('role_id')->nullable()->change();
            $table->integer('to_user_id')->nullable()->change();
            $table->integer('to_role_id')->after('to_user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ol_application_status_log', function (Blueprint $table) {
            //
        });
    }
}
