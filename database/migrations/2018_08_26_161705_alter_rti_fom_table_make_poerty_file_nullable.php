<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRtiFomTableMakePoertyFileNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('rti_form', function (Blueprint $table) {
        //     $table->string('poverty_line_proof',50)->nullable()->change();
        // });
        \DB::statement('ALTER TABLE rti_form MODIFY poverty_line_proof varchar(50) NULL ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('rti_form', function (Blueprint $table) {
        //     $table->string('poverty_line_proof',255)->change();
        // });

        \DB::statement('ALTER TABLE rti_form MODIFY poverty_line_proof varchar(255) NOT NULL ');
    }
}
