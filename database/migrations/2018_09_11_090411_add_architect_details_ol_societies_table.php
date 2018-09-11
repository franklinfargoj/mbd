<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArchitectDetailsOlSocietiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_societies', function (Blueprint $table) {
            $table->string('name_of_architect')->after('address');
            $table->string('architect_mobile_no')->after('name_of_architect');
            $table->string('architect_telephone_no')->after('architect_mobile_no');
            $table->string('architect_address')->after('architect_telephone_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ol_societies', function (Blueprint $table) {
            //
        });
    }
}
