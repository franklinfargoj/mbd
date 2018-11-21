<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApplicationMasterIdToSfApplicationStatusLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sf_application_status_logs', function (Blueprint $table) {
            $table->dropColumn('society_flag');
        });
        Schema::table('sf_application_status_logs', function (Blueprint $table) {
            $table->integer('application_master_id')->nullable();
            $table->integer('application_id')->nullable()->change();
            $table->tinyInteger('society_flag')->default(0);
            $table->integer('user_id')->nullable()->change();
            $table->integer('role_id')->nullable()->change();
            $table->integer('status_id')->nullable()->change();
            $table->integer('to_user_id')->nullable()->change();
            $table->integer('to_role_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sf_application_status_logs', function (Blueprint $table) {
            $table->tinyInteger('society_flag')->default(0);
        });
        Schema::table('sf_application_status_logs', function (Blueprint $table) {
            $table->dropColumn('application_master_id');
            $table->integer('application_id')->nullable(false)->change();
            $table->dropColumn('society_flag');
            $table->integer('user_id')->nullable(false)->change();
            $table->integer('role_id')->nullable(false)->change();
            $table->integer('status_id')->nullable(false)->change();
            $table->integer('to_user_id')->nullable(false)->change();
            $table->integer('to_role_id')->nullable(false)->change();
        });
    }
}
