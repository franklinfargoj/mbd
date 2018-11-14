<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLayoutExcelStatusToArchitectLayouts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('architect_layouts', function (Blueprint $table) {
            $table->tinyInteger('layout_excel_status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('architect_layouts', function (Blueprint $table) {
            $table->dropColumn('layout_excel_status');
        });
    }
}
