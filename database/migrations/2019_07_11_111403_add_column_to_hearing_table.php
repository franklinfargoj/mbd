<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToHearingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hearing', function (Blueprint $table) {
            $table->string('hearing_user_id')->after('user_id')->nullable();
            $table->string('hearing_role_id')->after('hearing_user_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hearing', function (Blueprint $table) {
            $table->dropColumn('hearing_user_id');
            $table->dropColumn('hearing_role_id');
        });
    }
}
