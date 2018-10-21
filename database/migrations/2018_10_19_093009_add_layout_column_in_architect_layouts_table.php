<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLayoutColumnInArchitectLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('architect_layouts', function (Blueprint $table) {
            $table->string('upload_layout_in_pdf_format')->nullable();
            $table->string('upload_layout_in_excel_format')->nullable();
            $table->string('upload_architect_note')->nullable();
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
            $table->dropColumn('upload_layout_in_pdf_format');
            $table->dropColumn('upload_layout_in_excel_format');
            $table->dropColumn('upload_architect_note');
        });
    }
}
