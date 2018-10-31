<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableArrearsChargesRate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE  `arrears_charges_rates` CHANGE  `year`  `year` VARCHAR( 40 ) NULL DEFAULT NULL ;');
        DB::statement('ALTER TABLE  `service_charges_rates` CHANGE  `year`  `year` VARCHAR( 40 ) NULL DEFAULT NULL ;');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
