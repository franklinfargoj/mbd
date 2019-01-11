<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoaRegistrationNoColumnInEoaApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eoa_applications', function (Blueprint $table) {
            $table->string('reg_with_council_of_architecture_coa_registration_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eoa_applications', function (Blueprint $table) {
            $table->dropColumn('reg_with_council_of_architecture_coa_registration_no');
        });
    }
}
