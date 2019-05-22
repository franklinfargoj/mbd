<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransBillServiceChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_bill_service_charges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trans_bill_generate_id');
            $table->decimal('water_charges',10,2)->default(0.00);
            $table->decimal('electric_city_charge',10,2)->default(0.00);
            $table->decimal('pump_man_and_repair_charges',10,2)->default(0.00);
            $table->decimal('external_expender_charge',10,2)->default(0.00);
            $table->decimal('administrative_charge',10,2)->default(0.00);
            $table->decimal('lease_rent',10,2)->default(0.00);
            $table->decimal('na_assessment',10,2)->default(0.00);
            $table->decimal('property_tax',10,2)->default(0.00);
            $table->decimal('other',10,2)->default(0.00);
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
        Schema::dropIfExists('trans_bill_service_charges');
    }
}
