<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFlatDeliveryMethodToConveyanceChecklistScrutiny extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conveyance_checklist_scrutiny', function (Blueprint $table) {
            $table->string('flat_delivery_method')->after('individual_destribution')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conveyance_checklist_scrutiny', function (Blueprint $table) {
            $table->dropColumn('flat_delivery_method');
        });
    }
}
