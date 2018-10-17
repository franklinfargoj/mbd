<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnsInConveyanceSalePriceCalculationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conveyance_sale_price_calculation', function (Blueprint $table) {
            $table->renameColumn('north_diamention', 'north_dimension');
            $table->renameColumn('south_diamention', 'south_dimension');
            $table->renameColumn('west_diamention', 'west_dimension');
            $table->renameColumn('east_diamention', 'east_dimension');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conveyance_sale_price_calculation', function (Blueprint $table) {
            $table->renameColumn('north_dimension', 'north_diamention');
            $table->renameColumn('south_dimension', 'south_diamention');
            $table->renameColumn('west_dimension', 'west_diamention');
            $table->renameColumn('east_dimension', 'east_diamention');
        });
    }
}
