<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScApplicationAgreements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sc_application_agreements', function (Blueprint $table){
            $table->increments('id');
             $table->integer('application_id');
            $table->string('draft_sale_agreement')->nullable();
            $table->string('draft_lease_agreement')->nullable();
            $table->string('approve_sale_agreement')->nullable();
            $table->string('approve_lease_agreement')->nullable();
            $table->string('stamp_sale_agreement')->nullable();
            $table->string('stamp_lease_agreement')->nullable();
            $table->string('sign_sale_agreement')->nullable();
            $table->string('sign_lease_agreement')->nullable();
            $table->string('register_sale_agreement')->nullable();
            $table->string('register_lease_agreement')->nullable();
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
       Schema::dropIfExists('sc_application_agreements');
    }
}
