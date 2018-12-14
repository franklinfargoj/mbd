<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripartiteAgreementRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tripartite_agreement_remarks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('role_id')->nullable();
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('tripartite_agreement_remarks');
    }
}
