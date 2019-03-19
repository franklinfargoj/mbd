<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArchitectLayoutDetailIdInArchitectLayoutPrepareLayoutExcelLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('architect_layout_prepare_layout_excel_logs', function (Blueprint $table) {
            $table->integer('architect_layout_detail_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('architect_layout_prepare_layout_excel_logs', function (Blueprint $table) {
            $table->dropColumn('architect_layout_detail_id');
        });
    }
}
