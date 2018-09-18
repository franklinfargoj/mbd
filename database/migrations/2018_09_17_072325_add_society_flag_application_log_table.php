<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocietyFlagApplicationLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_application_status_log', function (Blueprint $table) {
            $table->boolean('society_flag')->default(0)->after('application_id')->comment("1= Is Society & 0 = Not Society");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ol_application_status_log', function (Blueprint $table) {
            $table->dropColumn('society_flag');
        });
    }
}
