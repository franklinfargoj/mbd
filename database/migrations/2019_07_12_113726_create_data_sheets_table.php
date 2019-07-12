<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_sheets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name')->nullable();
            $table->string('permanant_address')->nullable();
            $table->string('address_present')->nullable();
            $table->tinyInteger('residing_in_staff_quarter')->nullable();
            $table->string('post')->nullable();
            $table->string('class')->nullable();
            $table->string('pay_scale')->nullable();
            $table->string('income_category_group')->nullable();
            $table->string('dob')->nullable();
            $table->string('date_of_appoinment_in_mhada')->nullable();
            $table->tinyInteger('received_house_from_mhada')->nullable();
            $table->string('under_which_provosion')->nullable();
            $table->tinyInteger('you_or_your_spouse_own_house')->nullable();
            $table->string('if_yes_name_of_the_city')->nullable();
            $table->tinyInteger('requirement_of_house_by_mhada')->nullable();
            $table->string('preferable_city_1')->nullable();
            $table->string('preferable_city_2')->nullable();
            $table->string('preferable_city_3')->nullable();
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
        Schema::dropIfExists('data_sheets');
    }
}
