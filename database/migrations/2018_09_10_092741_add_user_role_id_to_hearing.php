<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserRoleIdToHearing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hearing', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->after('application_type_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('role_id')->after('case_number');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

        });

        Schema::table('lm_village_detail', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->after('district');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('role_id')->after('land_source_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

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
