<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingTenantBillAssociationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_tenant_bill_association', function (Blueprint $table) {
            $table->increments('id');
            $table->string('building_id');
            $table->string('bill_id');
            $table->string('bill_month');
            $table->string('bill_year');
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
        Schema::dropIfExists('building_tenant_bill_association');
    }
}
