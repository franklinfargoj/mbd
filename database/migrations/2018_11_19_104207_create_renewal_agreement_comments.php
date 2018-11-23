<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRenewalAgreementComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renewal_agreement_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id');
            $table->integer('user_id')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('agreement_type_id')->nullable();
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('renewal_agreement_comments');
    }
}
