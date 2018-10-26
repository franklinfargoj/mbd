<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScChecklistMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sc_checklist_master', function (Blueprint $table){
            $table->increments('id');
             $table->integer('language_id')->nullable();
             $table->integer('type_id')->nullable();
            $table->string('name')->nullable();
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
        Schema::dropIfExists('sc_checklist_master');
    }
}
