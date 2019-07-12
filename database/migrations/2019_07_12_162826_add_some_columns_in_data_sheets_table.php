<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeColumnsInDataSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_sheets', function (Blueprint $table) {
            $table->string('phonenumber')->nullable();
            $table->string('email')->nullable();
            $table->string('staff_quarter_area')->nullable();
            $table->string('staff_quarter_address')->nullable();
            $table->string('date_of_allotment_of_staff_quarter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_sheets', function (Blueprint $table) {
            $table->dropColumn('phonenumber');
            $table->dropColumn('email');
            $table->dropColumn('staff_quarter_area');
            $table->dropColumn('staff_quarter_address');
            $table->dropColumn('date_of_allotment_of_staff_quarter');
        });
    }
}
