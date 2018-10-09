<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchitectLayoutDetailCourtMattersOrDisputesOnLand extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('architect_layout_detail_court_matters_or_disputes_on_land', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('architect_layout_detail_id');
            $table->string('document_name')->nullable();
            $table->string('document_file')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('architect_layout_detail_court_matters_or_disputes_on_land');
    }
}
