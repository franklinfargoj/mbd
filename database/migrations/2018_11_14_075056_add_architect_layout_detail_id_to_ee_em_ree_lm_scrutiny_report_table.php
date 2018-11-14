<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArchitectLayoutDetailIdToEeEmReeLmScrutinyReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('architect_layout_ee_scrutiny_reports', function (Blueprint $table) {
            $table->tinyInteger('architect_layout_detail_id')->default(0);
        });

        Schema::table('architect_layout_em_scrutiny_reports', function (Blueprint $table) {
            $table->tinyInteger('architect_layout_detail_id')->default(0);
        });

        Schema::table('architect_layout_land_scrutiny_reports', function (Blueprint $table) {
            $table->tinyInteger('architect_layout_detail_id')->default(0);
        });

        Schema::table('architect_layout_ree_scrutiny_reports', function (Blueprint $table) {
            $table->tinyInteger('architect_layout_detail_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('architect_layout_ee_scrutiny_reports', function (Blueprint $table) {
            $table->dropColumn('architect_layout_detail_id');
        });

        Schema::table('architect_layout_em_scrutiny_reports', function (Blueprint $table) {
            $table->dropColumn('architect_layout_detail_id');
        });

        Schema::table('architect_layout_land_scrutiny_reports', function (Blueprint $table) {
            $table->dropColumn('architect_layout_detail_id');
        });

        Schema::table('architect_layout_ree_scrutiny_reports', function (Blueprint $table) {
            $table->dropColumn('architect_layout_detail_id');
        });
    }
}
