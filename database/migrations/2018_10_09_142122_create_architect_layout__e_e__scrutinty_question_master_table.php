<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchitectLayoutEEScrutintyQuestionMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('architect_layout_ee_scrunity_question_master', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('language_id');
            $table->string('title');
            $table->tinyInteger('is_options')->default(0);
            $table->string('label1')->nullable();
            $table->string('label2')->nullable();
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
        Schema::dropIfExists('architect_layout_ee_scrunity_question_master');
    }
}
