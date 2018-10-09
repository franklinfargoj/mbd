<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchitectLayoutDetailPrCardDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('architect_layout_detail_pr_card_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('architect_layout_detail_id');
            $table->integer('architect_layout_detail_cts_plan_detail_id');
            $table->string('upload_pr_card')->nullable();
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
        Schema::dropIfExists('architect_layout_detail_pr_card_details');
    }
}
