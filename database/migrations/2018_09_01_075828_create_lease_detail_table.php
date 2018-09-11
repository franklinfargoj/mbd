<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaseDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lm_lease_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lease_rule_16_other')->nullable();
            $table->string('lease_basis')->nullable();
            $table->string('area')->nullable();
            $table->string('lease_period')->nullable();
            $table->string('lease_start_date')->nullable();
            $table->string('lease_rent')->nullable();
            $table->string('lease_rent_start_month')->nullable();
            $table->string('interest_per_lease_agreement')->nullable();
            $table->string('lease_renewal_date')->nullable();
            $table->string('lease_renewed_period')->nullable();
            $table->string('rent_per_renewed_lease')->nullable();
            $table->string('interest_per_renewed_lease_agreement')->nullable();
            $table->string('month_rent_per_renewed_lease')->nullable();
            $table->string('payment_detail')->nullable();

            $table->unsignedInteger('society_id');
            $table->foreign('society_id')->references('id')->on('lm_society_detail')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lease_detail');
    }
}
