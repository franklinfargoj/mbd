<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFieldNullableScApplicationLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sc_application_log', function (Blueprint $table) {
            $table->integer('society_flag')->nullable()->change();
            $table->integer('application_id')->nullable()->change();
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
        //
    }
}
