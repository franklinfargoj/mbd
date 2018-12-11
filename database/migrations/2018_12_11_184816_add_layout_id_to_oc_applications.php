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
        Schema::disableForeignKeyConstraints();
        Schema::table('oc_applications', function (Blueprint $table) {
            $table->unsignedInteger('layout_id')->after('society_id');
            $table->foreign('layout_id')->references('id')->on('master_layout')->onDelete('cascade');
        });
        Schema::enableForeignKeyConstraints();
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
