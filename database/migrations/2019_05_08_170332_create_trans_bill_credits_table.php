<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransBillCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_bill_credits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trans_bill_generate_id');
            $table->integer('trans_payment_id');
            $table->decimal('amount',10,2)->default('0.00');
            $table->tinyInteger('used')->default(0);
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
        Schema::dropIfExists('trans_bill_credits');
    }
}
