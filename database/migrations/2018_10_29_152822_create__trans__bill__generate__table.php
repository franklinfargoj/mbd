<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransBillGenerateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_bill_generate', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tenant_id');
            $table->string('building_id');
            $table->string('society_id');
            $table->string('bill_date');
            $table->string('due_date');
            $table->string('bill_from');
            $table->string('bill_to');
            $table->string('bill_month');
            $table->string('bill_year');
            $table->string('monthly_bill');
            $table->string('arrear_bill');
            $table->string('total_bill');
             $table->softDeletes();            
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
        Schema::dropIfExists('trans_bill_generate');
    }
}
