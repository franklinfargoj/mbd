<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchitectLayoutPrepareLayoutExcelLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('architect_layout_prepare_layout_excel_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('architect_layout_id');
            $table->string('upload_layout_in_pdf_format')->nullable();
            $table->string('upload_layout_in_excel_format')->nullable();
            $table->string('upload_architect_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('architect_layout_prepare_layout_excel_logs');
    }
}
