<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSfSrutinyMasterByEmDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sf_scrutiny_master_by_em_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('sf_application');
            $table->integer('sf_scrutiny_master_by_em_id');
            $table->text('remark')->nullable();
            $table->tinyInteger('label1')->default(0);
            $table->tinyInteger('label2')->default(0);
            $table->string('file')->nullable();
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
        Schema::dropIfExists('sf_scrutiny_master_by_em_details');
    }
}
