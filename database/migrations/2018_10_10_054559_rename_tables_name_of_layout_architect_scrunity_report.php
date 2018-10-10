<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTablesNameOfLayoutArchitectScrunityReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('architect_layout_detail_ee_scrutiny_reports', 'architect_layout_ee_scrutiny_reports');
        Schema::rename('architect_layout_detail_em_scrutiny_reports', 'architect_layout_em_scrutiny_reports');
        Schema::rename('architect_layout_detail_land_scrutiny_reports', 'architect_layout_land_scrutiny_reports');
        Schema::rename('architect_layout_detail_ree_scrutiny_reports', 'architect_layout_ree_scrutiny_reports');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('architect_layout_ee_scrutiny_reports', 'architect_layout_detail_ee_scrutiny_reports');
        Schema::rename('architect_layout_em_scrutiny_reports', 'architect_layout_detail_em_scrutiny_reports');
        Schema::rename('architect_layout_land_scrutiny_reports', 'architect_layout_detail_land_scrutiny_reports');
        Schema::rename('architect_layout_ree_scrutiny_reports', 'architect_layout_detail_ree_scrutiny_reports');
    }
}
