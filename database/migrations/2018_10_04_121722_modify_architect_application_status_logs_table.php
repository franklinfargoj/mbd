<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyArchitectApplicationStatusLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('architect_application_status_logs', function (Blueprint $table) {
            $table->integer('user_id')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('status_id')->nullable();
            $table->integer('to_user_id')->nullable();
            $table->integer('to_role_id')->nullable();
            $table->string('remark')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('architect_application_status_logs', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('role_id');
            $table->dropColumn('status_id');
            $table->dropColumn('to_user_id');
            $table->dropColumn('to_role_id');
            $table->dropColumn('remark');
        });
    }
}
