<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddisactivetoNOCforCCtable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('noc_cc_application_status_log', function (Blueprint $table) {
            $table->boolean('is_active')->nullable()->after('remark');
            $table->integer('phase')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('noc_cc_application_status_log', function (Blueprint $table) {
            $table->dropColumn('is_active');
             $table->dropColumn('phase');
        });
    }
}
